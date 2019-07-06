<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFriend extends Model
{
    protected $fillable = ['user_id', 'friend_id', 'status'];

    public static function get_friends_status($user_id)
    {
        return UserFriend::where('user_id', $user_id)->get();
    }

    public static function get_status($user_id, $friend_id)
    {
        $result = UserFriend::where([
            ['user_id', '=', $user_id],
            ['friend_id', '=', $friend_id],
        ])->first();

        if ($result) {
            return $result;
        }else {
            return false;
        }
    }

    public static function add_friend($user_id, $friend_id)
    {
        $object = new static;
        $object->user_id = $user_id;
        $object->friend_id = $friend_id;
        $object->save();

        self::update_status($user_id,$friend_id);
    }

    public static function remove_friend($user_id, $friend_id) {
        UserFriend::where([
            ['user_id', '=', $user_id],
            ['friend_id', '=', $friend_id],
        ])->delete();

        self::update_status($user_id,$friend_id);
    }

    public static function update_status($user_id, $friend_id) {
        $result_1 = UserFriend::where([
            ['user_id', '=', $user_id],
            ['friend_id', '=', $friend_id],
        ])->first();

        $result_2 = UserFriend::where([
            ['user_id', '=', $friend_id],
            ['friend_id', '=', $user_id],
        ])->first();

        if ($result_1 && $result_2) {
            $result_1->status = 'success';
            $result_2->status = 'success';
            $result_1->save();
            $result_2->save();
        }else {
            if ($result_1) {
                $result_1->status = 'wait';
                $result_1->save();
            }
            if ($result_2) {
                $result_2->status = 'wait';
                $result_2->save();
            }
        }
    }
}
