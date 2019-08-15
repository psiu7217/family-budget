<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'parent_id', 'user_id', 'sort', 'status', 'plan'];

    public static function get_by_user($user_id) {
        return Category::where('user_id', $user_id)->get();
    }

    public static function get_parent_by_user($user_id, $category_id = NULL) {
        return Category::where([
            ['user_id', $user_id],
            ['parent_id', $category_id],
        ])->get();
    }
    public static function get_parent_sum_by_user($user_id, $category_id = NULL) {
        return Category::where([
            ['user_id', $user_id],
            ['parent_id', $category_id],
        ])->sum('plan');
    }


    public static function edit($id, $fields) {
        $object = Category::find($id);
        $object->fill($fields);
        $object->save();
    }

    public static function add($fields) {

        $object = new static;
        $object->fill($fields);
        $object->save();

    }
}
