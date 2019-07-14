<?php
namespace app\models;
use core\Model;
use core\validators\MaxValidator;
use core\validators\RequiredValidator;
use core\validators\NumericValidator;
use core\H;
use app\interfaces\SearchAlgo;

class RestaurantModel extends Model implements SearchAlgo
{
    public $restaurant_name, $owner_id, $address, $telephone, $email, $lng, $lat, $image_url=DEFUALT_RESTAURANT_IMAGE, $verified=0, $deleted = 0;
    private $items_per_page = 9;

    public function __construct(){
        $table = 'restaurants';
        $model_name = 'RestaurantModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }

    public function find_all($params=[])
    {
        $conditions = [
            'conditions' => 'verified=?',
            'bind' => [1]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);
    }

    public function find_all_unverified()
    {
        $conditions = [
            'conditions' => 'verified=?',
            'bind' => [0]
        ];
        $conditions = array_merge($conditions);
        return $this->find($conditions);
    }
    
    public function find_unverified_by_id($id)
    {
        $conditions = [
            'conditions' => 'id=? AND verified=?',
            'bind' => [$id, 0]
        ];
        return $this->find_first($conditions);
    }

    public function find_verified_by_id($id)
    {
        $conditions = [
            'conditions' => 'id=? AND verified=?',
            'bind' => [$id, 1]
        ];
        return $this->find_first($conditions);
    }

    public function find_by_owner_id($owner_id)
    {
        $conditions = [
            'conditions' => 'owner_id=?',
            'bind' => [$owner_id]
        ];

        return $this->find_first($conditions);
    }
    public function save_image($data)
    {
        $image = H::decode_image($data);
        $path = SROOT.'img/items/'.time().'.png';
        if(file_put_contents($path, $image))
        {
            $this->image_url = $path;
            return $path;
        }
        $this->image_url = DEFUALT_ITEM_IMAGE;
        return false;
    }

    public function auto_complete($data)
    {
        $results = [];
        if($items = $this->search('restaurant_name', $data))
        {
            foreach($items as $item)
            {
                $results[] = $item->restaurant_name;
            }
        }
        return array_unique($results);
    }

    public function search($field, $data)
    {
        $items = $this->find([
            'conditions' => $field.' LIKE ?',
            'bind' => ['%'.$data.'%']
        ]);
        return ($items)? $items : [];
    }

    public function filter($filter, $page=0)
    {
        // H::dnd($filter);
        $sort_by = ['distance ASC', 'restaurant_name ASC', 'restaurant_name DESC'];
        $search_by = ['restaurant_name LIKE ?', 'address LIKE ?'];
        $search_str = '%'.$filter['search'].'%';


        $conditions = [
            'conditions' => $search_by[$filter['search_by']],
            'bind' => [$search_str], 
            'limit' => ($page * $this->items_per_page) . ',' . $this->items_per_page,
            'order' => $sort_by[$filter['sort_by']]
        ];
       
        // H::dnd(UserModel::current_user());
        if($filter['sort_by']==0) {
            $conditions['special'] = 'ASIN(SQRT( POWER(SIN(('.
            $filter['location_lat'].
            ' - lat) * pi()/180 / 2), 2) +COS('.
            $filter['location_lat'].
            '* pi()/180) * COS(lat * pi()/180) *POWER(SIN(('.
            $filter['location_lng'].
            ' -lng) * pi()/180 / 2), 2) )) as distance';
        }
        $restaurants = $this->find($conditions);

        // H::dnd($restaurants);

        $end_of_results = ($this->_db->count() < $this->items_per_page) ? true : false;

        $params = [
            'order' => 'rating DESC',
            'limit' => '0, 3'
        ];
        $item_model = new ItemsModel();
        foreach ($restaurants as $restaurant) {
            $restaurant->items = $item_model->find_all_by_restaurant_id($restaurant->id, $params);
        }

        // H::dnd($restaurants[0]->items);

        $result = $restaurants ? H::create_restaurant_card_list($restaurants) . H::create_pagination_tabs($page, $end_of_results) : null;
        if($restaurants) {
            $result = H::create_restaurant_card_list($restaurants) . H::create_pagination_tabs($page, $end_of_results);
        } elseif(!$restaurants && $page > 0) {
            $result = H::create_pagination_tabs($page, $end_of_results);
        } else {
            $result = null;
        }
        return $result;
    }

    public function validator(){
        $this->run_validation(new RequiredValidator($this, ['field'=>'restaurant_name', 'rule'=>true, 'msg'=>'Restaurant Name is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'address', 'rule'=>true, 'msg'=>'Restaurant Address is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'telephone', 'rule'=>true, 'msg'=>'Telephone Number is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'email', 'rule'=>true, 'msg'=>'Email is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'lng', 'rule'=>true, 'msg'=>'Location Latitude is not set!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'lat', 'rule'=>true, 'msg'=>'Location Longitude is not set!']));


        $this->run_validation(new MaxValidator($this, ['field'=>'restaurant_name', 'rule'=>50, 'msg'=>'Restaurant Name must be maximum of 50 characters']));
        $this->run_validation(new MaxValidator($this, ['field'=>'email', 'rule'=>50, 'msg'=>'Email must be maximum of 50 characters']));
        $this->run_validation(new MaxValidator($this, ['field'=>'telephone', 'rule'=>10, 'msg'=>'Phone number must be maximum of 10 characters']));
        $this->run_validation(new MaxValidator($this, ['field'=>'address', 'rule'=>50, 'msg'=>'Email must be maximum of 50 characters']));



    }
}

// set @orig_lat=121.9763;
// set @orig_lon=37.40445;
// set @dist=10;

// SELECT *,
// 3956 * 2 * ASIN(SQRT( POWER(SIN((@orig_lat - places.lat) *
// pi()/180 / 2), 2) +
// COS(@orig_lat * pi()/180) * COS(places.lat * pi()/180) *
// POWER(SIN((@orig_lon -places.lon) * pi()/180 / 2), 2) )) as
// distance
// FROM places
// having distance < @dist
// ORDER BY distance