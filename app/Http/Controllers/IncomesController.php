<?php

namespace App\Http\Controllers;

use App\Category;
use App\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Purses;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['incomes'] = Income::get_by_user(Auth::id());


        return view('incomes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        $data['purses'] = Purses::get_by_user(Auth::id());

        $data['user_id'] = Auth::id();

        return view('incomes.create', $data);
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

        Income::add($request->all());

        return redirect()->route('incomes.index');
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

        $data['income_info'] = Income::find($id);
        $data['purses'] = Purses::get_by_user(Auth::id());

        $data['user_id'] = Auth::id();

        return view('incomes.edit', $data);
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
        Income::edit($id, $request->all());
        return redirect()->route('incomes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Income::destroy($id);
        return redirect()->route('incomes.index');
    }
}
