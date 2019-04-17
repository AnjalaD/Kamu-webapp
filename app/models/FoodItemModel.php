<?php
namespace app\models;

use core\Model;
use core\H;


class FoodItemModel extends Model
{
    public $restaurant_id, $item_name, $description, $price, $image_url = DEFUALT_ITEM_IMAGE, $rating = 0, $tags = '', $deleted = 0;
    public $restaurant_name;

    public function __construct()
    {
        $table = 'items';
        $model_name = 'ItemsModel';
        parent::__construct($table, $model_name);
        $this->_soft_del = true;
    }


    public function find_by_item_id_restaurant_id($item_id, $restaurant_id)
    {
        $sql = '
            SELECT I.*, GROUP_CONCAT(T.tag_name) as tags
            FROM items as I
            LEFT JOIN item_tags IT ON I.id=IT.item_id
            LEFT JOIN tags T ON IT.tag_id=T.id
            WHERE I.id = ? AND I.restaurant_id = ?
            GROUP by I.id ;';

        $items = $this->query($sql, [$item_id, $restaurant_id], get_class($this));
        if ($items[0]) {
            $items[0]->tags = ($items[0]->tags) ? explode(',', $items[0]->tags) : false;
        }
        return $items[0];
    }

    // public function search($field, $data, $limit=0)
    // {

    //     $sql = '
    //         SELECT I.*, R.restaurant_name,  GROUP_CONCAT(T.tag_name) as tags
    //         FROM items as I
    //         INNER JOIN restaurants R ON I.restaurant_id=R.id
    //         LEFT JOIN item_tags IT ON I.id=IT.item_id
    //         LEFT JOIN tags T ON IT.tag_id=T.id
    //         WHERE ' . $field . ' LIKE ?
    //         GROUP by I.id ORDER by item_name LIMIT '.($limit*20).', 20;';

    //     $items = $this->query($sql, ['%' . $data . '%'], get_class($this));

    //     if ($items) {
    //         foreach ($items as $item) {
    //             $item->tags = ($item->tags) ? explode(',', $item->tags) : false;
    //         }
    //     }
    //     // H::dnd($items);
    //     return ($items) ? $items : [];
    // }

    public function filter($filters, $limit=0)
    {
        $sort_by = ['item_name ASC', 'item_name DESC', 'price ASC', 'price DESC'];

        $sql = '
            SELECT I.*, R.restaurant_name, GROUP_CONCAT(T.tag_name) as tags
            FROM items as I
            INNER JOIN restaurants R ON I.restaurant_id=R.id
            LEFT JOIN item_tags IT ON I.id=IT.item_id
            LEFT JOIN tags T ON IT.tag_id=T.id
            WHERE 
                I.id IN (SELECT item_tags.item_id FROM item_tags INNER JOIN tags ON tags.id=item_tags.tag_id WHERE tags.tag_name LIKE ?) 
                AND I.price <= ?
            GROUP by I.id ORDER BY ' . $sort_by[$filters['sort_by']] .' LIMIT '.($limit*20).', 20;';


        $items = $this->query(
            $sql,
            ['%' . $filters['search'] . '%', $filters['price_filter'] ],
            get_class($this)
        );

        if ($items) {
            foreach ($items as $item) {
                $item->tags = ($item->tags) ? explode(',', $item->tags) : false;
            }
        }

        return ($items) ? $items : [];
    }


    public function search_by_tag($tag, $limit=0)
    {
        $sql = '
            SELECT I.*, R.restaurant_name, GROUP_CONCAT(T.tag_name) as tags
            FROM items as I
            INNER JOIN restaurants R ON I.restaurant_id=R.id
            LEFT JOIN item_tags IT ON I.id=IT.item_id
            LEFT JOIN tags T ON IT.tag_id=T.id
            WHERE I.id IN (SELECT item_tags.item_id FROM item_tags INNER JOIN tags ON tags.id=item_tags.tag_id WHERE tags.tag_name =  ?)
            GROUP by I.id ORDER by item_name LIMIT '.($limit*20).', 20;';

        $items = $this->query($sql, [$tag], get_class($this));

        if ($items) {
            foreach ($items as $item) {
                $item->tags = ($item->tags) ? explode(',', $item->tags) : false;
            }
        }
        // H::dnd($items);
        return ($items) ? $items : [];
    }
}
