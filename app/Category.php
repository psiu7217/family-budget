<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'parent_id', 'user_id', 'sort', 'status', 'plan'];

    public static function get_by_user($user_id) {
        return Category::where([
            ['user_id', $user_id],
            ['status', 1],
        ])->get();
    }

    public static function get_parent_by_user($user_id, $category_id = NULL) {
        return Category::where([
            ['user_id', $user_id],
            ['parent_id', $category_id],
            ['status', 1],
        ])->get();
    }
    public static function get_parent_sum_by_user($user_id, $category_id = NULL) {
        return Category::where([
            ['user_id', $user_id],
            ['parent_id', $category_id],
            ['status', 1],
        ])->sum('plan');
    }


    public static function edit($id, $fields) {
        $object = Category::find($id);
        $object->fill($fields);
        $object->save();
    }

    public static function add($fields) {

        //Пытаемся найти категорию в архиве
        $object = Category::where([
            ['title', $fields['title']],
            ['user_id', $fields['user_id']],
            ['parent_id', $fields['parent_id']],
            ['status', 0],
        ])->first();

        //Если наши, вынимаем из архива, иначе создаем новую
        if ($object) {
            $object->status = 1;
            $object->plan = $fields['plan'];
            $object->save();
        }else {
            $object = new static;
            $object->fill($fields);
            $object->save();
        }

    }

    public static function archive($id) {
        $object = Category::find($id);
        $object->status = 0;
        $object->save();
    }
}
