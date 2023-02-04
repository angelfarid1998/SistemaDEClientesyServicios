@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> 
                    <h2> Sistema de clientes y servicios </h2> <br>
                    <h4> <u> Ver cliente </u> </h4> 
                </div>

                <div class="card-body">
                    <h4> <u> Datos personales </u> </h4>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="">Nombre completo</label>
                            <input value="{{ $cliente->nombre }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="">Cedula</label>
                            <input value="{{ $cliente->cedula }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="">Correo</label>
                            <input value="{{ $cliente->correo }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="">telefono</label>
                            <input value="{{ $cliente->telefono }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="">Observaciones</label>
                            <textarea value="" class="form-control" disabled> {{ $cliente->observaciones }} </textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="">Imagen</label>
                            <img width="30%" class="img-thumbnail img-fluid" src="{{ asset('imagenes/clientes'). '/' .$cliente->imagen }}" alt="">
                        </div>
                    </div>
                    <br>
                    <h4> <u> Servicios vinculados </u> </h4>
                    <table id="myTable1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Fecha inicio</th>
                            <th scope="col">Fecha fin</th>
                            <th scope="col">Observaciones</th>
                            {{-- <th scope="col"></th> --}}
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($serviciosAsignados as $serviciosAsignado)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>                           
                                    <td> {{ $serviciosAsignado->nombre}} </td>
                                    <td> 
                                        <img width="60px" class="img-thumbnail img-fluid" src="{{ asset('imagenes/servicios'). '/' .$serviciosAsignado->imagen }}" alt="">
                                    </td>
                                    <td> {{ $serviciosAsignado->tipo}} </td>
                                    <td> {{ $serviciosAsignado->fecha_ini}} </td>
                                    <td> {{ $serviciosAsignado->fecha_fin}} </td>
                                    <td> {{ $serviciosAsignado->observaciones}} </td>
                                </tr>
                            @endforeach 
                        </tbody>      
                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Fecha inicio</th>
                                <th scope="col">Fecha fin</th>
                                <th scope="col">Observaciones</th>
                            </tr>
                        </tfoot>                      
                    </table>
                    
                    <br>

                    <h4> <u> Servicios totales </u> </h4>
                    <form action="{{ route('clientes.AsignarServicios') }}" class="d-inline" method="post">
                        @csrf
                        <table id="myTable" class="table table2 table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Fecha inicio</th>
                                <th scope="col">Fecha fin</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col"> </th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($servicios as $servicio)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>                           
                                        <td> {{ $servicio->nombre }} </td>
                                        <td> 
                                            <img width="60px" class="img-thumbnail img-fluid" src="{{ asset('imagenes/servicios'). '/' .$servicio->imagen }}" alt="">
                                        </td>
                                        <td> {{ $servicio->tipo }} </td>
                                        <td> {{ $servicio->fecha_ini }} </td>
                                        <td> {{ $servicio->fecha_fin }} </td>
                                        <td> {{ $servicio->observaciones }} </td>
                                        <td>
                                            <input type="hidden" value="{{ $cliente->id }}" name="cliente_id" id="cliente_id">
                                            <input type="checkbox" name="servicio_id[]" id="asignada" value="{{ $servicio->id }}">                                        
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Fecha inicio</th>
                                    <th scope="col">Fecha fin</th>
                                    <th scope="col">Observaciones</th>
                                </tr>
                            </tfoot> 
                                
                        </table> 
                        <br>
                        <div class="row">
                            <div class=" offset-3 col-md-3 d-grid gap-2">
                                <a href="{{ route('clientes.index') }}" class="btn btn-outline-danger btn-lg" style="font-size: 0.8rem" > Volver </a>
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


    @if(Session::has('guardado')){{
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
        icon: 'success',
        title: 'Registro guardado exitosamente'
        })
    </script>    

    @endif

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

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

    @endif


@endsection