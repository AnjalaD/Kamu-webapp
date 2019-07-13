<?php
namespace app\models;

use core\Model;
use core\H;
use app\interfaces\SearchAlgo;

class FoodItemModel extends Model implements SearchAlgo
{
    public $restaurant_id, $item_name, $description, $price, $image_url = DEFUALT_ITEM_IMAGE, $rating = 0, $tags = '', $deleted = 0, $hidden = 0;
    public $restaurant_name;
    private $items_per_page = 9;

    public function __construct()
    {
        $table = 'items';
        $model_name = 'ItemsModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }


    public function find_by_item_id_restaurant_id($item_id, $restaurant_id, $get_hidden = false)
    {
        $hidden_sql = !$get_hidden ? ' AND I.hidden=? ' : ' ';

        $sql = '
            SELECT I.*, GROUP_CONCAT(T.tag_name) as tags
            FROM items as I
            LEFT JOIN item_tags IT ON I.id=IT.item_id
            LEFT JOIN tags T ON IT.tag_id=T.id
            WHERE I.id = ? AND I.restaurant_id = ? AND I.deleted=?' . $hidden_sql .
            'GROUP by I.id ;';

        $bind_args = (!$get_hidden) ? [$item_id, $restaurant_id, 0, 0] : [$item_id, $restaurant_id, 0];

        $items = $this->query($sql, $bind_args, get_class($this));
        if (!empty($items[0])) {
            $items[0]->tags = ($items[0]->tags) ? explode(',', $items[0]->tags) : [];
        }
        return $items[0];
    }


    public function filter($filters, $page = 0)
    {
        $sort_by = ['item_name ASC', 'item_name DESC', 'price ASC', 'price DESC', 'rating DESC'];

        $sql = '
            SELECT I.*, R.restaurant_name, GROUP_CONCAT(T.tag_name) as tags
            FROM items as I
            INNER JOIN restaurants R ON I.restaurant_id=R.id
            LEFT JOIN item_tags IT ON I.id=IT.item_id
            LEFT JOIN tags T ON IT.tag_id=T.id
            WHERE I.price <= ? AND I.deleted=? AND I.hidden=?
            AND I.id IN (SELECT item_tags.item_id FROM item_tags INNER JOIN tags ON tags.id=item_tags.tag_id WHERE tags.tag_name LIKE ?)
            GROUP by I.id ORDER BY ' . $sort_by[$filters['sort_by']] . ' 
            LIMIT ' . ($page * $this->items_per_page) . ',' . $this->items_per_page . ';';


        $items = $this->query(
            $sql,
            [$filters['price_filter'], 0, 0, '%' . $filters['search'] . '%'],
            get_class($this)
        );

        if ($items) {
            foreach ($items as $item) {
                $item->tags = ($item->tags) ? explode(',', $item->tags) : false;
            }
        }
        $end_of_results = ($this->_db->count() < $this->items_per_page) ? true : false;

        $result = $items ? H::create_card_list($items) . H::create_pagination_tabs($page, $end_of_results) : null;
        if($items) {
            $result = H::create_card_list($items) . H::create_pagination_tabs($page, $end_of_results);
        } elseif(!$items && $page > 0) {
            $result = H::create_pagination_tabs($page, $end_of_results);
        } else {
            $result = null;
        }
        return $result;
    }

    public function auto_complete($data)
    {
        return [];
    }


    public function filter_by_restaurant($restaurant_id, $filters, $page = 0)
    {
        $sort_by = ['item_name ASC', 'item_name DESC', 'price ASC', 'price DESC', 'rating DESC'];

        $sql = '
            SELECT I.*, R.restaurant_name, GROUP_CONCAT(T.tag_name) as tags
            FROM items as I
            INNER JOIN restaurants R ON I.restaurant_id=R.id
            LEFT JOIN item_tags IT ON I.id=IT.item_id
            LEFT JOIN tags T ON IT.tag_id=T.id
            WHERE I.restaurant_id=? AND I.price <= ? AND I.deleted=? AND I.hidden=? 
            AND I.id IN (SELECT item_tags.item_id FROM item_tags INNER JOIN tags ON tags.id=item_tags.tag_id WHERE tags.tag_name LIKE ?) 
            GROUP by I.id ORDER BY ' . $sort_by[$filters['sort_by']] . ' 
            LIMIT ' . ($page * $this->items_per_page) . ',' . $this->items_per_page . ';';


        $items = $this->query(
            $sql,
            [$restaurant_id, $filters['price_filter'], 0, 0, '%' . $filters['search'] . '%'],
            get_class($this)
        );

        if ($items) {
            foreach ($items as $item) {
                $item->tags = ($item->tags) ? explode(',', $item->tags) : false;
            }
        }
        $end_of_results = ($this->_db->count() < $this->items_per_page) ? true : false;

        $result = $items ? H::create_card_list($items) . H::create_pagination_tabs($page, $end_of_results) : null;
        if($items) {
            $result = H::create_card_list($items) . H::create_pagination_tabs($page, $end_of_results);
        } elseif(!$items && $page > 0) {
            $result = H::create_pagination_tabs($page, $end_of_results);
        } else {
            $result = null;
        }
        return $result;
    }


}
