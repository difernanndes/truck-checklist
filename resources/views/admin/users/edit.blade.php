@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <h1>Editar Usuário</h1><br/>
@endsection

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h5><i class="icon fas fa-ban"></i>Atenção</h5>

                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{route('users.update', ['user'=>$user->id])}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Imagem</label>
                    <div class="col-sm-10">
                        <img class="user-image elevation-2" src="/media/images/profile/{{strtolower(str_replace(" ", "", $user['name']))}}.jpg" alt="Usuário" width=160 height=160><br/><br/>
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Matrícula</label>
                    <div class="col-sm-10">
                        <input type="text" name="registration" value="{{$user->registration}}" class="form-control @error('registration') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nova Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirmação da Senha</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Perfil ADM</label>
                    <div class="col-sm-1">
                        @if($user->admin === 0)
                        <input type="checkbox" name="admin" class="form-control @error('admin') is-invalid @enderror"/>
                        @else
                        <input type="checkbox" name="admin" checked="checked" class="form-control @error('admin') is-invalid @enderror"/>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Motorista</label>
                    <div class="col-sm-1">
                        @if($user->driver === 0)
                        <input type="checkbox" name="driver" class="form-control @error('admin') is-invalid @enderror"/>
                        @else
                        <input type="checkbox" name="driver" checked="checked" class="form-control @error('driver') is-invalid @enderror"/>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Salvar" class="btn btn-success"/>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
