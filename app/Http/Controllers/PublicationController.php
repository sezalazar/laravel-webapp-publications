<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Comment;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publications = Publication::paginate(10);
        return view('welcome', ['publications'=>$publications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function desafio()
    {

        $publications = Publication::join('comments', 'publication.id', '=', 'comments.publication_id')
        ->where('comments.content', 'like', '%Hola%')
        ->where('comments.status', '=', 'APROBADO')
        ->select('publication.id', 'publication.title', 'publication.content', 'publication.user_id')
        ->get();

        return view('publicationsHola'
            , ['publications'=>$publications]);
    }

    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $pTitle = $request->input('pTitle');
        $pContent = $request->input('pContent');
        $pUser = $request->input('pUser');
        $Publication = new Publication;
        $Publication->title = $pTitle;
        $Publication->content = $pContent;
        $Publication->user_id = $pUser;
        $Publication->save();
        return redirect('/')
         ->with([ 'mensaje' , 'Publicación '.$pTitle.' agregada correctamente' ]);
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
        $publication = Publication::find($id);
        return view('edit')
            ->with('publication', $publication)
            ->with([ 'mensaje' , 'Publicación editada correctamente' ]);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request/*, $id*/)
    {
        $publication = Publication::find($request->input('id'));

        $publication->title = $request->input('pTitle');
        $publication->content = $request->input('pContent');
        // $publication->user_id = $request->input('pUser');

        $publication->save();

        return redirect('/')
        ->with([ 'mensaje' , 'Publicación '.$request->input('pTitle').' modificada correctamente' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publication = Publication::find($id);
        $publication->delete();
        return redirect('/')
        ->with([ 'mensaje' , 'Publicación eliminada correctamente' ]);
    }
}
