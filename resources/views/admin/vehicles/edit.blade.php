@extends('adminlte::page')

@section('title', 'Editar Veículo')

@section('content_header')
    <h1>Editar Veículo</h1>
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
            <form action="{{route('vehicle.update', ['vehicle'=>$vehicle->id])}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Imagem</label>
                    <div class="col-sm-10">
                        <img class="user-image elevation-2" src="/media/images/{{strtolower(str_replace(" ", "", $vehicle['plate']))}}.jpg" alt="Veículo" width=300 height=200><br/><br/>
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Placa</label>
                    <div class="col-sm-10">
                        <input type="text" name="plate" value="{{$vehicle->plate}}" class="form-control @error('plate') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Marca</label>
                    <div class="col-sm-10">
                        <input type="text" name="brand" value="{{$vehicle->brand}}" class="form-control @error('brand') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Modelo</label>
                    <div class="col-sm-10">
                        <input type="text" name="model" value="{{$vehicle->model}}" class="form-control @error('model') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tipo</label>
                    <div class="col-sm-10">
                        <input type="text" name="type" value="{{$vehicle->type}}" class="form-control @error('type') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Ano</label>
                    <div class="col-sm-10">
                        <input type="number" name="year" value="{{$vehicle->year}}" class="form-control @error('year') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">KM</label>
                    <div class="col-sm-10">
                        <input type="number" name="km" value="{{$vehicle->km}}" class="form-control @error('km') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lubrificação</label>
                    <div class="col-sm-10">
                        <input type="date" name="lubrication" value="{{$vehicle->lubrication}}" class="form-control @error('lubrication') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="form-check">
                        @if($vehicle->status === 0)
                        <input type="radio" name="status" value="0" checked class="form-control-input @error('status') is-invalid @enderror"/> <label class="form-check-label">Em Operação</label></br>
                        <input type="radio" name="status" value="1" class="form-control-input @error('status') is-invalid @enderror"/> <label class="form-check-label">Em Manutenção</label>
                        @else
                        <input type="radio" name="status" value="0" class="form-control-input @error('status') is-invalid @enderror"/> <label class="form-check-label">Em Operação</label></br>
                        <input type="radio" name="status" value="1" checked class="form-control-input @error('status') is-invalid @enderror"/> <label class="form-check-label">Em Manutenção</label>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Observações</label>
                    <div class="col-sm-10">
                        <textarea name="observation" class="form-control @error('observation') is-invalid @enderror">{{$vehicle->observation}}</textarea>
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