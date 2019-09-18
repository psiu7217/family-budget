<?php

namespace App\Http\Controllers;

use App\Category;
use App\Check;
use App\Purses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['checks'] = Check::get_by_user();


        return view('checks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        $data['purses'] = Purses::get_by_user();
//        $data['categories'] = Category::get_child_by_user();

        $data['categories'] = Category::get_all_category_by_user();

        $data['user_id'] = Auth::id();

        return view('checks.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        Check::add($request->all());

        return redirect()->route('checks.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];

        $data['check_info'] = Check::find($id);
        $data['purses'] = Purses::get_by_user(Auth::id());
        $data['categories'] = Category::get_all_category_by_user();

        $data['user_id'] = Auth::id();

        return view('checks.edit', $data);
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
        Check::edit($id, $request->all());
        return redirect()->route('checks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Check::remove_check($id);
        return redirect()->route('checks.index');
    }
}
