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
        return $items[0];
    }

    public function search($field, $data, $extra = '')
    {

        $sql = '
            SELECT I.*, R.restaurant_name,  GROUP_CONCAT(T.tag_name) as tags
            FROM items as I
            INNER JOIN restaurants R ON I.restaurant_id=R.id
            LEFT JOIN item_tags IT ON I.id=IT.item_id
            LEFT JOIN tags T ON IT.tag_id=T.id
            WHERE ' . $field . ' LIKE ? ' . $extra . '
            GROUP by I.id ORDER by item_name;';

        $items = $this->query($sql, ['%' . $data . '%'], get_class($this));

        if ($items) {
            foreach ($items as $item) {
                $item->tags = ($item->tags) ? explode(',', $item->tags) : false;
            }
        }
        // H::dnd($items);
        return ($items) ? $items : [];
    }

    public function filter($filters)
    {
        if (strpos($filters['sort_by'], 'name') !== false) {
            $filters['sort_by'] = 'item_' . $filters['sort_by'];
        }
        $sql = '
            SELECT I.*, R.restaurant_name,  GROUP_CONCAT(T.tag_name) as tags
            FROM items as I
            INNER JOIN restaurants R ON I.restaurant_id=R.id
            LEFT JOIN item_tags IT ON I.id=IT.item_id
            LEFT JOIN tags T ON IT.tag_id=T.id
            WHERE item_name LIKE "%' . $filters['search'] . '%" AND I.price <= ' . $filters['price_filter'] . '
            GROUP by I.id  ORDER BY ' . $filters['sort_by'] . ';';


        $items = $this->query(
            $sql,
            ['%' . $filters['search'] . '%', $filters['price_filter'], $filters['sort_by']],
            get_class($this)
        );
        if ($items) {
            foreach ($items as $item) {
                $item->tags = ($item->tags) ? explode(',', $item->tags) : false;
            }
        }
        // H::dnd($items);
        return ($items) ? $items : [];
    }
}
