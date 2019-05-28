<?php
namespace app\models;
use core\Model;

class RatingModel extends Model
{
    public $item_id, $customer_id, $rating;

    public function __construct()
    {
        $table = 'ratings';
        $model_name = 'RatingModel';
        parent::__construct($table, $model_name);
    }

    public function find_by_item_id_customer_id($item_id, $customer_id)
    {
        $conditions = [
            'conditions' => 'item_id=? AND customer_id=?',
            'bind' => [$item_id, $customer_id]
        ];
        return $this->find_first($conditions);
    }

    public function rate($item, $rating)
    {
        $customer_id = UserModel::current_user()->id;

        $new_rating = null;
        $effective_rating = 0;
        $rating_num = 0;

        if ($new_rating = $this->find_by_item_id_customer_id($item->id, $customer_id)) {
            $prev_rating = $new_rating->rating;
            $new_rating->rating = $rating;

            $effective_rating = $rating - $prev_rating;
        } else {
            $new_rating = new RatingModel();
            $new_rating->item_id = $item->id;
            $new_rating->customer_id = $customer_id;
            $new_rating->rating =  $rating;

            $effective_rating = $rating;
            $rating_num = 1;
        }
        $new_rating->save();
        $item->rating = ($item->rating*$item->rating_num + $effective_rating)/($item->rating_num + $rating_num);
        $item->rating_num += $rating_num;
        return $new_rating->save()? $item : null;
    }
}