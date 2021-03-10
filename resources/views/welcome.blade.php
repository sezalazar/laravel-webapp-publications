@extends('base')

@section('title', 'Panel de Publicaciones')




<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
              @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
             @endif

 @section('contenido')

@if (Route::has('login'))
@auth
@section('h1', 'Panel de administración de Publicaciones')
@if(session('mensaje'))
            <div class="alert alert-success">
                    {{session('mensaje')}}
            </div>
        @endif
 <table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Título</th>
            <th scope="col">Contenido</th>
            <th scope="col">ID Usuario</th>
            <th colspan="3" scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>

        @if(count($publications)<=0)
            <tr><td colspan="7">No hay resultados</td></tr>
        @else
        @foreach($publications as $publication)
        <tr>
            <td>{{$publication->id}}</td>
            <td>{{$publication->title}}</td>
            <td>{{$publication->content}}</td>
            <td>{{$publication->user_id}}</td>
            <td>
                <a href="/edit/{{$publication->id}}" class="btn btn-info">Editar</a>
                <a href="/view/{{$publication->id}}" class="btn btn-primary">Ver Publicación</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Borrar registro
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Eliminación de registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        Confima que desea eliminar el registro?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{route('publication.destroy', $publication->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        <input type="submit" class="btn btn-danger" value="Borrar">
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
{{$publications->links()}}
<a href="create" class="btn btn-primary">Crear</a>

@endif
@endauth
@endsection
