@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center font-weight-bold"> 
                    <h2> Sistema de clientes y servicios </h2> <br>
                    <h4> <u> Clientes </u> </h4> 
                </div>

                <table id="myTable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        {{-- 'nombre','imagen','cedula','correo','telefono','observaciones' --}}
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th width="10%" class="img-thumbnail img-fluid" scope="col">Imagen</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                        <tr>
                            <td> {{ $loop->iteration }}</td>                          
                            <td> {{ $cliente->nombre }} </td>
                            <td> 
                                <img width="60px" class="img-thumbnail img-fluid" src="{{ asset('imagenes/clientes'). '/' .$cliente->imagen }}" alt="">
                            </td>
                            <td> {{ $cliente->cedula }} </td>
                            <td> {{ $cliente->correo }} </td>
                            <td> {{ $cliente->telefono }} </td>
                            <td> {{ $cliente->observaciones }} </td>
                            <td>
                                <a href="{{ url('clientes/show/'.$cliente->id) }}" title="Ver Estudiante" class="btn btn-outline-info btn-sm">
                                    <img src="/img/iconos/show.png" alt="Ver" width="15" >
                                </a>
                                <a href="{{ route('clientes.edit',$cliente->id) }}" title="Editar" class="btn btn-outline-primary btn-sm">
                                    <img src="/img/iconos/edit.png" alt="Editar" width="15" > 
                                </a>
                                <button id="eliminarObjetivo" onclick="eliminarObjetivo({{$cliente->id}})" title="Eliminar" class="btn btn-outline-danger btn-sm">
                                    <img src="/img/iconos/delete.png" alt="Eliminar" width="15">
                                </button>

                            </td>
                        </tr>
                        @endforeach
                  </table>
                  
                </div>
                <br>
                <div class="row">
                    <div class=" offset-3 col-md-3 d-grid gap-2">
                        <a href="{{ route('home') }}" class="btn btn-outline-danger" style="font-size: 0.8rem" > Volver </a>
                    </div>
                    
                    <div class=" col-md-3 d-grid gap-2">
                        <a href="{{ route('clientes.create') }}" class="btn btn-outline-info " style="font-size: 0.8rem" > Agregar cliente</a>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('JavaScript')

    <script>
        function eliminarObjetivo(id) {
            $.ajax({
                url: '/eliminarCliente/' + id,
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
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
                    title: 'Registro eliminado exitosamente'
                    }),
                    
                    $(document).ready(function () {
                    setTimeout(function () {
                        // alert('Reloading Page');
                        location.reload(true);
                    }, 3000);
                    });
                }
            });
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

    @if(Session::has('actualizado')){{
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
            title: 'Registro actualizado exitosamente'
            })
        </script>    

    @endif

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

@endsection