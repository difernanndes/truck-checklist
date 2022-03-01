@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Meus Usuários</h1>
@endsection

@section('content')

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <div class="card-header">
                    <a href="{{route('users.create')}}" class="btn btn-sm btn-success">Novo Usuário</a>
                    <div class="card-tools">
                        <div class="card-tools" style="margin-top: 5px">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                    <form action="/users" method="GET">
                                        <input type="text" name="user_search" value="{{$search}}" class="form-control float-right" placeholder="Buscar">
                                            <div class="input-group-append">
                                                <button type="submit"  class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                    </form>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Matrícula</th>
                                        <th>Perfil ADM</th>
                                        <th>Motorista</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->registration}}</td>
                                        <td>{{$user->admin === 1 ? 'Sim':'Não'}}</td>
                                        <td>{{$user->driver === 1 ? 'Sim':'Não'}}</td>
                                        <td>
                                            <a href="{{route('users.edit', ['user' => $user->id])}}" class="btn btn-sm btn-primary">Editar</a>
                                            @if($loggedId !== intval($user->id))
                                                <form class="d-inline" method="POST" action="{{route('users.destroy', ['user' => $user->id])}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button  class="btn btn-sm btn-danger">Excluir</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </table>
        </div>
    </div>

    {{$users->links('pagination::bootstrap-4')}}

@endsection