@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> 
                    <h2> Sistema de clientes y servicios </h2> <br>
                    <h4> <u> Nuevo servicio </u> </h4> 
                </div>

                @if(count($errors)>0)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('servicios.stores') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="">Nombre completo</label>
                                <input name="nombre" type="text" class="form-control" placeholder="Nombre completo" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Imagen</label>
                                <input name="imagen" type="file" accept="image/png, image/jpeg" class="form-control" placeholder="Seleccione imagen" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Tipo</label>
                                <select name="tipo" class="form-control" id="" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Basico">Basico </option>
                                    <option value="Avanzado">Avanzado </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Fecha inicio</label>
                                <input name="fecha_ini" type="text" id="entrada" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Fecha fin</label>
                                <input name="fecha_fin" type="text" id="salida" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Observaciones</label>
                                <textarea class="form-control" name="observaciones" rows="5" cols="50" placeholder="Observaciones..." required></textarea>

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
<script type="text/javascript">
    function valideKey(evt){
        
        // code is the decimal ASCII representation of the pressed key.
        var code = (evt.which) ? evt.which : evt.keyCode;
        
        if(code==8) { // backspace.
          return true;
        } else if(code>=48 && code<=57) { // is a number.
          return true;
        } else{ // other keys.
          return false;
        }
    }
    </script> 

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
        var getDate = function (input) {
    return new Date(input.date.valueOf());
    }

    $('#entrada, #salida').datepicker({
        format: "dd/mm/yyyy",
        language: 'es'
    });

    $('#entrada').datepicker({
        startDate: '+5d',
        endDate: '+35d',
    }).on('changeDate',
        function (selected) {
            $('#salida').datepicker('setStartDate', getDate(selected));
        });

    $('#salida').datepicker({
        startDate: '+6d',
        endDate: '+36d',
    }).on('changeDate',
        function (selected) {
            $('#entrada').datepicker('setEndDate', getDate(selected));
        });
    </script>

@endsection