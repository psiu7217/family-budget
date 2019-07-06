@extends('layouts.app')

@section('content')
    <div class="container purses">
        <div class="row justify-content-center">

            @if (session('status'))
                <div class="col-sm-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            @endif


            @foreach($purses as $item)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">{{$item->title}} <a href="{{route('purses.edit', $item->id)}}" class="btn btn-warning"><i class="far fa-edit"></i></a></div>

                        <div class="card-body">
                           Текущий остаток: <strong>{{$item->cash}}</strong>

                            {{Form::open(['route'=>['purses.destroy', $item->id], 'method'=>'delete', 'class'=>'inline_block'])}}
                            <button type="submit" class="btn btn-danger" data-attr="delete"><i class="fas fa-trash-alt"></i></button>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            @endforeach


            <div class="col-sm-12 margin_top_50">
                <a href="{{route('purses.create')}}" class="btn btn-success display_block">Добавить новый</a>
            </div>

        </div>
    </div>
@endsection
