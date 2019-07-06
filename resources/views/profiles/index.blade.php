@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Это твой профиль <strong>{{$profile->name}}</strong></div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{Form::open([
                                'route' => ['profile.update', $profile->id],
                                'files' => true,
                                'method'  => 'put',
                                'class' => 'form-horizontal'
                            ])}}


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" readonly class="form-control form-control-plaintext" value="{{$profile->email}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Login</label>
                            <div class="col-sm-10">
                                <input type="text" name="login" class="form-control" value="{{$profile->login}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Имя</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="{{$profile->name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Заменить пароль</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="new_password" placeholder="Пароль">
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Обновить</button>
                        </div>

                        {{ Form::close() }}

                    </div>
                </div>
            </div>


            <div class="col-md-12" style="margin-top: 30px">
                <div class="card">
                    <div class="card-header">Список друзей</div>

                    <div class="card-body">

                        <table class="table friends_table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Имя/Логин</th>
                                <th scope="col">Статус</th>
                                <th scope="col" style="width: 200px;">Действия</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $item)
                                <tr @if ($item['status'] != 'Не в друзьях') class="{{$item['status']}}" @endif >
                                    <th scope="row">{{$item['id']}}</th>
                                    <td>{{$item['name']}} ({{$item['login']}})</td>
                                    <td>
                                    {{$item['status']}}
                                    </td>
                                    <td>
                                        @if ($item['status'] == 'Не в друзьях')
                                            <a href="/add_friend/{{$item['id']}}" class="btn btn-success"><i class="fas fa-user-plus"></i></a>
                                        @endif
                                        @if ($item['status'] == 'wait')
                                            <a href="/delete_friend/{{$item['id']}}" class="btn btn-danger"><i class="fas fa-user-times"></i></a>
                                        @endif
                                            @if ($item['status'] == 'success')
                                                <a href="/delete_friend/{{$item['id']}}" class="btn btn-danger"><i class="fas fa-user-times"></i></a>
                                            @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
