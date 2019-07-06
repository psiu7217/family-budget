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
                    <div class="card-header">Редактировать кошелек</div>
                    <div class="card-body">


                        {{Form::open([
                                'route' => ['purses.update', $purse->id],
                                'files' => true,
                                'method'  => 'put',
                                'class' => 'form-horizontal'
                            ])}}

                        <input type="hidden" name="user_id" value="{{$user_id}}">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" placeholder="Название" value="{{$purse->title}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Остаток</label>
                            <div class="col-sm-10">
                                <input type="number" name="cash" step="0.01" class="form-control" placeholder="Название" value="{{$purse->cash}}">
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
