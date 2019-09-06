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


            <div class="col-sm-3"><strong>Название</strong></div>
            <div class="col-sm-2"><strong>Сумма</strong></div>
            <div class="col-sm-3"><strong>Кошелек</strong></div>
            <div class="col-sm-2"><strong>Дата</strong></div>
            <div class="col-sm-2"><strong></strong></div>
                <div class="col-sm-12" style="margin-bottom: 30px"><hr></div>
            @foreach($incomes as $item)
                    <div class="col-sm-3">{{$item['title']}}</div>
                    <div class="col-sm-2">{{$item['cash']}}</div>
                    <div class="col-sm-3">{{$item['purse_id']}}</div>
                    <div class="col-sm-2">{{$item['updated_at']}}</div>
                    <div class="col-sm-2">
                        <div class="btn_group" style=" display: flex; ">
                            <a href="{{route('incomes.edit', $item['id'])}}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                            {{Form::open(['route'=>['incomes.destroy', $item['id']], 'method'=>'delete', 'class'=>'inline_block'])}}
                            <button type="submit" class="btn btn-danger" data-attr="delete"><i class="fas fa-trash-alt"></i></button>
                            {{Form::close()}}
                        </div>
                    </div>
                <div class="col-sm-12"><hr></div>
            @endforeach


            <div class="col-sm-12 margin_top_50">
                <a href="{{route('incomes.create')}}" class="btn btn-success display_block">Добавить доход</a>
            </div>


        </div>
    </div>

@endsection
