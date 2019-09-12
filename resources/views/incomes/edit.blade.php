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
                    <div class="card-header">Редактировать доход</div>
                    <div class="card-body">


                        {{Form::open([
                                'route' => ['incomes.update', $income_info->id],
                                'files' => true,
                                'method'  => 'put',
                                'class' => 'form-horizontal'
                            ])}}

                        <input type="hidden" name="user_id" value="{{$user_id}}">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Название</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" placeholder="Название" value="{{$income_info->title}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Кошелек</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="parent_id">
                                    @foreach ($purses as $item)
                                        <option value="{{$item->id}}" @if($income_info->purse_id == $item->id) selected @endif>{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Сумма</label>
                            <div class="col-sm-9">
                                <input type="number" name="cash" step="0.01" class="form-control" placeholder="Сумма" value="{{$income_info->cash}}">
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
