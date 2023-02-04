@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> 
                    <h2> Sistema de clientes y servicios </h2> <br>
                    <h4> <u> Editar cliente </u> </h4> 
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

                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-body">

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="">Nombre completo</label>
                                <input name="nombre" type="text" value="{{ $cliente->nombre }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Cedula</label>
                                <input name="cedula" type="text" value="{{ $cliente->cedula }}" class="form-control" minlength="7" maxlength="10" onkeypress="return valideKey(event);" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Telefono</label>
                                <input name="telefono" type="text" value="{{ $cliente->telefono }}" class="form-control" minlength="7" maxlength="10" onkeypress="return valideKey(event);" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Correo</label>
                                <input name="correo" type="email" value="{{ $cliente->correo }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Observaciones</label>
                                <textarea name="observaciones" value="" class="form-control" required> {{ $cliente->observaciones }} </textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">Imagen</label>
                                <img width="70px" class="img-thumbnail img-fluid" src="{{ asset('imagenes/clientes'). '/' .$cliente->imagen }}" alt="">
                                <input type="hidden" value="{{ $cliente->imagen }}" name="imagen">
                                
                                <a href="javascript:mostrar();" class="btn btn-outline-warning btn-sm"> Cambiar img</a>
                                
                                <div id="flotante" style="display:none;">

                                    <input id="" name="imagen" value="{{ $cliente->imagen }}" type="file" accept="image/png, image/jpeg" class="form-control">
                                    <a href="javascript:cerrar();" class="btn btn-outline-warning btn-sm"> Cerrar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <div class="row">
                        <div class=" offset-3 col-md-3 d-grid gap-2">
                            <a href="{{ route('clientes.index') }}" class="btn btn-outline-danger btn-lg" style="font-size: 0.8rem" > Volver </a>
                        </div>
                        
                        <div class=" col-md-3 d-grid gap-2">
                            <button type="submit" class="btn btn-outline-success btn-lg" style="font-size: 0.8rem" > Guardar </button>
                        </div>
                    </div>
                    <br>
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

    @if(Session::has('duplicado')){{
        Session::get('') 
    }}
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'error',
        title: 'Verifique la informacion, hay datos duplicados'
        })
    </script>   

    @endif

@endsection