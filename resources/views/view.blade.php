
@extends('base')

@section('title', $publication->title . ' - TWGroup')

@section('contenido')
@section('h1', $publication->title . ' -TWGroup')

<div class="card bg-light col-md-7 mt-5 p-3 mx-auto">

            <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">{{$publication->title}}</h4>
            </div>
            <div class="alert alert-success" role="alert">

                <p>{{$publication->content}}</p>
                <hr>
                <p class="mb-0">Nota creada por: {{$publication->user_id}}.</p>
            </div>
</div>


<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="d-flex flex-column comment-section">
            @if(count($comments)<=0)
                <tr><td colspan="7">Todavía no hay comentarios. Sea el primero en comentar!</td></tr>
            @else
            @foreach($comments as $comment)
            <!-- @if($comment->status = "APROBADO") -->
                <div class="bg-white p-2">
                    <div class="d-flex flex-row user-info">
                        <!-- <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"> -->
                        <div class="d-flex flex-column justify-content-start ml-2">
                            <span class="d-block font-weight-bold name">
                            Comentario escrito por: {{$comment->user_id}}
                            </span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="comment-text">
                            {{$comment->content}}
                        </p>
                    </div>
                </div>
            <!-- @endif -->
            @endforeach
            @endif

            @if(count($commentsByUser)<1)
                <div class="bg-white">
                    <div class="d-flex flex-row fs-12">
                        <div class="like p-2 cursor"><i class="fa fa-commenting-o"></i><span class="ml-1">Comenta</span></div>
                    </div>
                </div>
                <div class="bg-light p-2">

                <form action="/addComentario" method="post" >
                @csrf
                    <input type="hidden" name="idPublicacion" value="{{$publication->id}}">
                    <!-- <div class="d-flex flex-row user-info">
                        <div class="d-flex flex-column justify-content-start ml-2">
                            <span class="d-block font-weight-bold name">
                                <input type="text" class="form-control" name="cUserId"  id="cUserId" placeholder="usuario">
                            </span>
                        </div>
                    </div> -->
                    <br>
                    <div class="d-flex flex-row align-items-start">
                        <textarea class="form-control ml-1 shadow-none textarea" name="cContent"  id="cContent"></textarea>
                    </div>
                    <div class="mt-2 text-right">
                        <button type="submit" class="btn btn-outline-primary ml-3">
                            <i class="far fa-plus-square fa-lg mr-2"></i>
                            Subir comentario
                        </button>
                        <a href="/" class="btn btn-outline-secondary ml-3">
                             volver al panel de publicaciones
                        </a>
                    </div>
                </form>
                </div>
                @else
                <a href="/" class="btn btn-outline-secondary ml-3">
                             volver al panel de publicaciones
                </a>
            @endif
            </div>
        </div>
    </div>
</div>

@endsection







