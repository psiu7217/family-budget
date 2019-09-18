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
                    <div class="card-header">Добавить Чек</div>
                    <div class="card-body">


                        {{Form::open([
                        'route' => 'checks.store',
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
                            <label class="col-sm-3 col-form-label">Кошелек</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="purse_id">
                                    @foreach ($purses as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Категория</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="category_id">
                                    @foreach ($categories as $item)
                                        <optgroup label="{{$item['main']->title}}">
                                            @foreach($item['child'] as $child)
                                                <option value="{{$child->id}}">{{$child->title}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Сумма</label>
                            <div class="col-sm-9">
                                <input type="number" name="price" step="0.01" min="0" class="form-control" placeholder="План" value="0">
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
