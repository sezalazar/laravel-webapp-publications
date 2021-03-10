<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $publication = Publication::find($id);

        $comments = Comment::join('publication', 'publication.id', '=', 'comments.publication_id')
        ->where('publication.id', '=' ,$publication->id)
        ->select('comments.content', 'comments.user_id')
        ->get();

        $commentsByUser = Comment::join('publication', 'publication.id', '=', 'comments.publication_id')
        ->where('publication.id', '=' ,$publication->id)
        ->where('comments.user_id', '=' ,auth()->user()->name)
        ->select('comments.content', 'publication.user_id')
        ->get();

        return view('view')
            ->with('publication', $publication)
            ->with('comments', $comments)
            ->with('commentsByUser', $commentsByUser);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pIdPublicacion = $request->input('idPublicacion');
        $cContent = $request->input('cContent');
        // $pUser = $request->input('pUser');
        $comment = new Comment;
        $comment->publication_id = $pIdPublicacion;
        $comment->content = $cContent;
        $comment->status = "APROBADO";
        $comment->user_id = auth()->user()->name;
        $comment->save();
        return redirect('/envioMail')
         ->with([ 'mensaje' , 'Comentario agregada correctamente' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
