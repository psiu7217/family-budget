<?php

namespace App\Http\Controllers;

use App\User;
use App\UserFriend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function index($success_update = false)
    {
        $data = [];
        $data['users'] = [];
        $data['friends'] = [];

        $data['profile'] = Auth::user();

        $users = User::all();
        foreach ($users as $user) {
            $status = UserFriend::get_status($data['profile']->id, $user->id);
            if ($status) {
                $status = $status->status;
            }else {
                $status = 'Не в друзьях';
            }
            //Не учитываем текущего
            if ($user->id != $data['profile']->id) {
                $data['users'][] = [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'login' => $user->login,
                    'status'=> $status,
                ];
            }
        }

        return view('profiles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [];

        if (User::edit($id, $request->all()))
            $data['status'] = 'Профиль обновлен!';

        return redirect()->route('profile.index')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function add_friend($id) {

        UserFriend::add_friend(Auth::id(), $id);

        return redirect()->back();
    }

    public static function delete_friend($id) {

        UserFriend::remove_friend(Auth::id(), $id);

        return redirect()->back();
    }
}
