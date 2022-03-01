@extends('adminlte::page')

@section('title', 'Novo Usuário')

@section('content_header')
    <h1>Novo Usuário</h1>
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
            <form action="{{route('users.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Imagem</label>
                    <div class="col-sm-10">
                        <input type="file" name="image" value="{{old('image')}}" class="form-control-file @error('image') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Matrícula</label>
                    <div class="col-sm-10">
                        <input type="number" name="registration" value="{{old('registration')}}" class="form-control @error('registration') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Senha</label>
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
                        <input type="checkbox" name="admin" class="form-control @error('admin') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Motorista</label>
                    <div class="col-sm-1">
                        <input type="checkbox" name="driver" class="form-control @error('driver') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Cadastrar" class="btn btn-success"/>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
