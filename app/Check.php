<?php

namespace App;

use App\Purses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Check extends Model
{
    protected $fillable = ['category_id', 'title', 'purse_id', 'user_id', 'price'];

    public static function get_by_user($user_id = false) {
        if (!$user_id) $user_id = Auth::id();
        return Check::where([
            ['user_id', $user_id],
        ])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public static function edit($id, $fields) {
        $object = Check::find($id);

        $old_price = floatval($object->price);
        $new_price = floatval($fields['price']);

        $object->fill($fields);
        $object->save();

        $purse = Purses::find($fields['purse_id']);
        $purse->cash = floatval($purse->cash) + $old_price - $new_price;
        $purse->save();
    }

    public static function add($fields) {

        $object = new static;
        $object->fill($fields);
        $object->save();

        $purse = Purses::find($fields['purse_id']);
        $purse->cash = floatval($purse->cash) - floatval($fields['price']);
        $purse->save();
    }

    public static function remove_check($id) {
        $object = Check::find($id);

        $purse = Purses::find($object->purse_id);
        $purse->cash = floatval($purse->cash) + $object->price;
        $purse->save();

        Check::destroy($id);
    }
}
