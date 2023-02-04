@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> <h2> Sistema de clientes y servicios </h2> </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 iconhome">
                            <img src="/img/iconos/clients.png" width="100" height="100" alt="Clientes" srcset=""> <br>
                            <a href="{{ route('clientes.index') }}" class="btn btn-outline-success">Clientes</a>
                        </div>
                        <div class="col-md-6 iconhome">
                            <img src="/img/iconos/service.png" width="100" height="100" alt="Servicios" srcset=""><br>
                            <a href="{{ route('servicios.index') }}" class="btn btn-outline-success">Servicios</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
