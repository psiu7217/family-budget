<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Purses;

class Income extends Model
{
    protected $fillable = ['title', 'purse_id', 'user_id', 'cash'];

    public static function get_by_user($user_id) {
        return Income::where([
            ['user_id', $user_id],
        ])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public static function edit($id, $fields) {
        $object = Income::find($id);
        $object->fill($fields);
        $object->save();
    }

    public static function add($fields) {
        $object = new static;
        $object->fill($fields);
        $object->save();

        $purse = Purses::find($fields['purse_id']);
        $purse->cash = floatval($purse->cash) + floatval($fields['cash']);
        $purse->save();
    }
}