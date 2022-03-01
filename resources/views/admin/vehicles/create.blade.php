@extends('adminlte::page')

@section('title', 'Novo Veículo')

@section('content_header')
    <h1>Novo Veículo</h1>
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
            <form action="{{route('vehicle.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Imagem</label>
                    <div class="col-sm-10">
                        <input type="file" name="image" value="{{old('image')}}" class="form-control-file @error('image') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Placa *</label>
                    <div class="col-sm-10">
                        <input type="text" name="plate" value="{{old('plate')}}" class="form-control @error('plate') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Marca</label>
                    <div class="col-sm-10">
                        <input type="text" name="brand" value="{{old('brand')}}" class="form-control @error('brand') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Modelo</label>
                    <div class="col-sm-10">
                        <input type="text" name="model" value="{{old('model')}}" class="form-control @error('model') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tipo</label>
                    <div class="col-sm-10">
                        <input type="text" name="type" value="{{old('type')}}" class="form-control @error('type') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Ano</label>
                    <div class="col-sm-10">
                        <input type="number" name="year" value="{{old('year')}}" class="form-control @error('year') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">KM *</label>
                    <div class="col-sm-10">
                        <input type="number" name="km" value="{{old('km')}}" class="form-control @error('km') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lubrificação</label>
                    <div class="col-sm-10">
                        <input type="date" name="lubrication" value="{{old('lubrication')}}" class="form-control @error('lubrication') is-invalid @enderror"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status *</label>
                    <div class="form-check">
                        <input type="radio" name="status" value="0" checked class="form-control-input @error('status') is-invalid @enderror"/> <label class="form-check-label">Em Operação</label></br>
                        <input type="radio" name="status" value="1" class="form-control-input @error('status') is-invalid @enderror"/> <label class="form-check-label">Em Manutenção</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Observações</label>
                    <div class="col-sm-10">
                        <textarea name="observation" value="{{old('observation')}}" class="form-control @error('observation') is-invalid @enderror"> </textarea>
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