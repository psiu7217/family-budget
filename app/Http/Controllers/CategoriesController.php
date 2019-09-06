<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

//        $data['categories'] = Category::get_by_user(Auth::id());
        $data['categories'] = [];
        $parents = Category::get_parent_by_user(Auth::id());
        foreach ($parents as $parent) {
            $child = Category::get_parent_by_user(Auth::id(), $parent->id);

            $data['categories'][] = [
                'id'        => $parent->id,
                'title'     => $parent->title,
                'plan'      => Category::get_parent_sum_by_user(Auth::id(), $parent->id),
                'children'  => $child,
            ];
        }

        return view('categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        $data['categories'] = Category::get_parent_by_user(Auth::id());

//        $data['categories']->put('', 'Нету');

        $data['user_id'] = Auth::id();

        return view('categories.create', $data);
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

        Category::add($request->all());

        return redirect()->route('categories.index');
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

        $data['category_info'] = Category::find($id);
        $data['categories'] = Category::get_parent_by_user(Auth::id());

        $data['user_id'] = Auth::id();

        return view('categories.edit', $data);
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
        Category::edit($id, $request->all());
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::archive($id);
//        Category::destroy($id);
        return redirect()->route('categories.index');
    }
}
