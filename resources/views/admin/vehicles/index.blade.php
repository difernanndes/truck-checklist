@extends('adminlte::page')

@section('title', 'Veículos')

@section('content_header')
    <h1>Meus Veículos</h1>
@endsection

@section('content')

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <div class="card-header">
                    <a href="{{route('vehicle.create')}}" class="btn btn-sm btn-success">Novo Veículo</a>
                    <div class="card-tools" style="margin-top: 5px">
                        <div class="input-group input-group-sm" style="width: 200px;">
                                <form action="/vehicle" method="GET">
                                    <input type="text" name="vehicle_search" value="{{$search}}" class="form-control float-right" placeholder="Buscar">
                                        <div class="input-group-append">
                                            <button type="submit"  class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                </form>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Tipo</th>
                                    <th>Ano</th>
                                    <th>KM</th>
                                    <th>LUB</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicles as $vehicle)
                                <tr>
                                    <td>{{$vehicle->id}}</td>
                                    <td>{{$vehicle->plate}}</td>
                                    <td>{{$vehicle->brand}}</td>
                                    <td>{{$vehicle->model}}</td>
                                    <td>{{$vehicle->type}}</td>
                                    <td>{{$vehicle->year}}</td>
                                    <td>{{number_format($vehicle->km, 0, ',','.')}}</td>
                                    <td>{{date("d/m/Y", strtotime($vehicle->lubrication))}}</td>
                                    <td>{{$vehicle->status === 0 ? 'Em Operação':'Em Manutenção'}}</td>
                                    <td>
                                        <a href="{{route('vehicle.show', ['vehicle' => $vehicle->id])}}" class="btn btn-sm btn-success">Ver</a>
                                        <a href="{{route('vehicle.edit', ['vehicle' => $vehicle->id])}}" class="btn btn-sm btn-primary">Editar</a>
                                        <form class="d-inline" method="POST" action="{{route('vehicle.destroy', ['vehicle' => $vehicle->id])}}" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                            @method('DELETE')
                                            @csrf
                                            <button  class="btn btn-sm btn-danger">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </div>
                    </div>
                </div>
            </table>
        </div>
    </div>

    {{$vehicles->links('pagination::bootstrap-4')}}

@endsection