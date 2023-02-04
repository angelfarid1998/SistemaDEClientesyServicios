@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> 
                    <h2> Sistema de clientes y servicios </h2> <br>
                    <h4> <u> Editar asignatura </u> </h4> 
                </div>

                <form action="{{ route('servicios.update', $servicio->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-body">

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="">Nombre</label>
                                <input name="nombre" type="text" value="{{ $servicio->nombre }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Tipo</label>
                                <select name="tipo" class="form-control" name="" id="" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Basico" {{ $servicio->tipo == 'Basico' ? 'selected' : '' }}> Basico </option>
                                    <option value="Avanzado" {{ $servicio->tipo == 'Avanzado' ? 'selected' : '' }}> Avanzado </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Fecha inicio</label>
                                <input name="fecha_ini" value="{{ $servicio->fecha_ini }}" type="text" id="entrada" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Fecha fin</label>
                                <input name="fecha_fin" value="{{ $servicio->fecha_fin }}" type="text" id="salida" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Observaciones</label>
                                <textarea name="observaciones" value="" class="form-control" required> {{ $servicio->observaciones }} </textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">Imagen</label>
                                <img width="70px" class="img-thumbnail img-fluid" src="{{ asset('imagenes/servicios'). '/' .$servicio->imagen }}" alt="">
                                <input type="hidden" value="{{ $servicio->imagen }}" name="imagen">
                                
                                <a href="javascript:mostrar();" class="btn btn-outline-warning btn-sm"> Cambiar img</a>
                                
                                <div id="flotante" style="display:none;">

                                    <input id="" name="imagen" value="{{ $servicio->imagen }}" type="file" accept="image/png, image/jpeg" class="form-control">
                                    <a href="javascript:cerrar();" class="btn btn-outline-warning btn-sm"> Cerrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <div class="row">
                        <div class=" offset-3 col-md-3 d-grid gap-2">
                            <a href="{{ route('servicios.index') }}" class="btn btn-outline-danger btn-lg" style="font-size: 0.8rem" > Volver </a>
                        </div>
                        
                        <div class=" col-md-3 d-grid gap-2">
                            <button type="submit" class="btn btn-outline-success btn-lg" style="font-size: 0.8rem" > Guardar </button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('JavaScript')

    @if(Session::has('duplicado')){{
        Session::get('') 
    }}
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'error',
        title: 'Verifique la informacion, ya existe un registro con ese nombre.'
        })
    </script>    

    @endif

    <script>
        function mostrar() {
            div = document.getElementById('flotante');
            div.style.display = '';
        }

        function cerrar() {
            div = document.getElementById('flotante');
            div.style.display = 'none';
        }
    </script>

    <script>
        var getDate = function (input) {
        return new Date(input.date.valueOf());
        }

        $('#entrada, #salida').datepicker({
            format: "dd/mm/yyyy",
            language: 'es'
        });

        $('#salida').datepicker({
            startDate: '+6d',
            endDate: '+36d',
        });

        $('#entrada').datepicker({
            startDate: '+5d',
            endDate: '+35d',
        }).on('changeDate',
        function (selected) {
            $('#salida').datepicker('clearDates');
            $('#salida').datepicker('setStartDate', getDate(selected));
        });
    </script>

@endsection