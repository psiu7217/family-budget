@extends('layouts.app')

@section('content')
    <div class="container categories">
        <div class="row justify-content-center">

            @if (session('status'))
                <div class="col-sm-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            @endif


            @foreach($categories as $item)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('categories.edit', $item['id'])}}">{{$item['title']}} (План: {{$item['plan']}})</a>
                            <div class="btn_group">
                                <a href="{{route('categories.edit', $item['id'])}}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                {{Form::open(['route'=>['categories.destroy', $item['id']], 'method'=>'delete', 'class'=>'inline_block'])}}
                                <button type="submit" class="btn btn-danger" data-attr="delete"><i class="fas fa-trash-alt"></i></button>
                                {{Form::close()}}
                            </div>
                        </div>

                        <div class="card-body">

                            @foreach($item['children'] as $child)
                                <div class="item">
                                    <a href="{{route('categories.edit', $child->id)}}">{{$child->title}} (План: {{$child->plan}})</a>
                                    <div class="btn_group">
                                        <a href="{{route('categories.edit', $child->id)}}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                        {{Form::open(['route'=>['categories.destroy', $child->id], 'method'=>'delete', 'class'=>'inline_block'])}}
                                        <button type="submit" class="btn btn-danger" data-attr="delete"><i class="fas fa-trash-alt"></i></button>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endforeach


            <div class="col-sm-12 margin_top_50">
                <a href="{{route('categories.create')}}" class="btn btn-success display_block">Добавить новую категорию</a>
            </div>


        </div>
    </div>

@endsection
