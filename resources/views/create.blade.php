
@extends('base')

@section('title', 'Agregar Publicación')

@section('contenido')
@section('h1', 'Agregar Publicación')

<div class="card bg-light col-md-7 mt-5 p-3 mx-auto">
        <form action="/addPublication" method="post" >
        @csrf
            <div class="form-group">
                <label for="pTitle">Publicación:</label>
                <input type="text" class="form-control" name="pTitle"  id="pTitle" placeholder="Título de la publicación">
            </div>
            <div class="form-group">
                <label for="pContent">Contenido:</label>
                <textarea class="form-control" name="pContent"  id="pContent" rows="3" placeholder="Contenido de la publicación"></textarea>
            </div>
            <input type="hidden" class="form-control" name="pUser"  id="pUser" placeholder="ID Creador" value="{{auth()->user()->name}}">
            <br>
            <button type="submit" class="btn btn-dark px-4">
                <i class="far fa-plus-square fa-lg mr-2"></i>
                Agregar Publicación
            </button>
            <a href="/" class="btn btn-outline-secondary ml-3">
                volver al panel de publicaciones
            </a>



        </form>
        </div>


@endsection

