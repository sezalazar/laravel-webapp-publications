
@extends('base')

@section('title', 'Editar Publicación')

@section('contenido')
@section('h1', 'Editar Publicación')

<div class="card bg-light col-md-7 mt-5 p-3 mx-auto">
        <form action="/publication/{{$publication->id}}" method="post" >
        @csrf
        <!-- @method('PUT') -->
            <input type="hidden" name="id" value="{{$publication->id}}">
            <div class="form-group">
                <label for="pTitle">Publicación:</label>
                <input type="text" class="form-control" name="pTitle"  id="pTitle" placeholder="Título de la publicación" value="{{$publication->title}}">
            </div>
            <div class="form-group">
                <label for="pContent">Contenido:</label>
                <textarea class="form-control" name="pContent"  id="pContent" rows="3" placeholder="Contenido de la publicación" >{{$publication->content}}</textarea>
            </div>
            <!-- <div class="form-group">
                <label for="pUser">Id Usuario:</label>
                <input type="text" class="form-control" name="pUser"  id="pUser" placeholder="ID Creador" value="{{$publication->user_id}}">
            </div> -->
            <br>
            <button type="submit" class="btn btn-dark px-4">
                <i class="fas fa-edit"></i>
                Modificar
            </button>
            <a href="/" class="btn btn-outline-secondary ml-3">
                volver al panel de publicaciones
            </a>


        </form>
</div>


@endsection



