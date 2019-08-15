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
                <a href="{{route('purses.create')}}" class="btn btn-success display_block">Добавить новый кошелек</a>
            </div>

                {{--                Перевод денег               --}}
                <div class="col-sm-12 margin_top_50">
                    <div class="card">
                        <div class="card-header">Перевод денег</div>
                        <div class="card-body">


                            {{Form::open([
                                    'url' => 'transfer',
                                    'method'  => 'post',
                                    'class' => 'form-horizontal'
                                ])}}

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label text-right">С </label>
                                <div class="col-sm-4">
                                    <select name="before" class="form-control">
                                        @foreach($purses as $item)
                                            <option value="{{$item->id}}" data-cash="{{$item->cash}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label text-right">На </label>
                                <div class="col-sm-4">
                                    <select name="after" class="form-control">
                                        @foreach($purses as $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Сумма</label>
                                <div class="col-sm-10">
                                    <input type="number" name="cash" step="0.01" min="0" max="{{$purses[0]->cash }}" class="form-control" placeholder="Сумма" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="btn-create text-right col-sm-12">
                                    <p class="max_sum">Максимальная сумма: <strong>{{$purses[0]->cash }}</strong></p>
                                    <button type="submit" class="btn btn-success" title="Перевод">Перевод</button>
                                </div>
                            </div>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>


        </div>
    </div>

    <script>
        $('select[name="before"]').change(function () {
            var cash = parseFloat($('select[name="before"] option[value = "'+$(this).val()+'"]').data('cash'));
            $('.purses .max_sum strong').text(cash);
            $('input[name="cash"]').attr('max', cash);
        });
    </script>
@endsection
