<?php
namespace app\models;
use core\Model;
use core\validators\MaxValidator;
use core\validators\RequiredValidator;
use core\validators\NumericValidator;
use core\H;


class ItemsModel extends Model
{
    public $restaurant_id, $name, $description, $price, $image_url=DEFUALT_ITEM_IMAGE, $rating=0 , $tags='', $deleted = 0;

    public function __construct(){
        $table = 'items';
        $model_name = 'ItemsModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }

    public function find_all_by_restaurant_id($restaurant_id, $params=[])
    {
        $conditions = [
            'conditions' => 'restaurant_id=?',
            'bind' => [$restaurant_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find($conditions);
    }

    public function find_by_id_restaurant_id($item_id, $restaurant_id, $params=[])
    {
        $conditions = [
            'conditions' => 'id=? AND restaurant_id=?',
            'bind' => [$item_id, $restaurant_id]
        ];

        $conditions = array_merge($conditions, $params);
        return $this->find_first($conditions);
    }

    public function validator()
    {
        $this->run_validation(new RequiredValidator($this, ['field'=>'name', 'rule'=>true, 'msg'=>'Name is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'description', 'rule'=>true, 'msg'=>'Name is required!']));
        $this->run_validation(new RequiredValidator($this, ['field'=>'price', 'rule'=>true, 'msg'=>'Name is required!']));

        $this->run_validation(new MaxValidator($this, ['field'=>'description', 'rule'=>255, 'msg'=>'Description should be maximum of 255 characters!']));
        $this->run_validation(new NumericValidator($this, ['field'=>'price', 'rule'=>true, 'msg'=>'Price should be numeric!']));
    }

    public function auto_complete($field, $data)
    {
        $results = [];
        if($items = $this->search($field, $data))
        {
            foreach($items as $item)
            {
                $results[] = $item->name;
            }
        }
        return array_unique($results);
    }

    public function search($field, $data)
    {
        $items = $this->find([
            'conditions' => $field.' LIKE ?',
            'bind' => [$data.'%']
        ]);
        return ($items)? $items : [];
    }

    private function _create_card($item)
    {
        $html = '';
        $html .= '<div class="card block span3">';
        $html .= '<div class="product"><img src="'.$item->image_url.'"></div>';
        $html .= '<div class="info"><h4>'.$item->name.'</h4>';
        $html .= '<span class="description">'.$item->description.'</span>';
        $html .= '<span class="price">LKR.'.$item->price.'</span>';
        $html .= '<a class="btn btn-info pull-right" href="#"><i class="icon-shopping-cart"></i>Add to Order</a></div>';
        $html .= '<div class="details"><span class="time"><i class="icon-time"></i> 12 hours ago</span>
            <span class="rating pull-right">
            <span class="star"></span>
            <span class="star"></span>
            <span class="star"></span>
            <span class="star"></span>
            <span class="star"></span>
            </span></div></div>';
        return $html;
    }

    public function create_list($items){
        if(empty($items)){
            return '';
        }
        $html = '<div class="card-columns container">';
        foreach($items as $item)
        {
            $html .= $this->_create_card($item);
        }
        $html .= '</div>';
        return $html;
    }

}