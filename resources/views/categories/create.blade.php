@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @if (session('status'))
                <div class="col-sm-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Добавить новую категорию</div>
                    <div class="card-body">


                        {{Form::open([
                        'route' => 'categories.store',
                        'files' => true,
                        'class' => 'form-horizontal'
                        ])}}

                        <input type="hidden" name="user_id" value="{{$user_id}}">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Название</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" placeholder="Название">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Родительская категория</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="parent_id">
                                    <option value="" selected="selected">Нету</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">План</label>
                            <div class="col-sm-9">
                                <input type="number" name="plan" step="0.01" class="form-control" placeholder="План" value="0">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Сортировка</label>
                            <div class="col-sm-9">
                                <input type="number" name="sort" class="form-control" placeholder="Сортировка" value="99">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="btn-create text-right col-sm-12">
                                <button type="submit" class="btn btn-success" title="Сохранить">Сохранить</button>
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
