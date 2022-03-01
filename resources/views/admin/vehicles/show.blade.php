@extends('adminlte::page')

@section('title', 'Veículo')

@section('content_header')
    <h1>Veículo  - {{$vehicle->plate}}</h1><br/>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <img class="user-image" src="/media/images/{{strtolower(str_replace(" ", "", $vehicle['plate']))}}.jpg" width=100% height=100%/>
            </div><br/>
            <div class="invoice p-3 mb-3" style="font-size: 20px"><h4>Observações:</h4> {{$vehicle['observation']}}</div>  
        </div>
    </div>

@endsection