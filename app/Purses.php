<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purses extends Model
{
    protected $fillable = ['title', 'user_id', 'cash'];


    public static function get_by_user($user_id) {
        return Purses::where('user_id', $user_id)->get();
    }

    public static function add($fields) {

        $object = new static;
        $object->fill($fields);
        $object->save();

    }

    public static function edit($id, $fields) {
        $object = Purses::find($id);
        $object->fill($fields);
        $object->save();
    }

    public static function transfer($fields) {

        $object = Purses::find($fields['before']);
        $object->cash = $object->cash - $fields['cash'];
        $object->save();

        $object = Purses::find($fields['after']);
        $object->cash = $object->cash + $fields['cash'];
        $object->save();
    }
}
