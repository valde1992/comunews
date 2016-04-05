<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use App\Noticias;

use App\User;

class NoticiasController extends Controller
{

	public function mis_noticias() {

		$usuarioid = Auth::user();
        $user = User::find($usuarioid->id);

        $miContenido = Noticias::where('autor', '=', "$user->id")->get();

        return view('perfil.mis_noticias',compact('miContenido'));
	}
	
	public function nueva_noticia(Request $req) {

		/*
		$this->validate($request, [
            'editor1'    => 'min:150|max:1500',
        ]);
		*/

		$usuarioid = Auth::user();
        $user = User::find($usuarioid->id);

        $noticia = new Noticias;

        $noticia->titulo		= $req->input('titulo');
        $noticia->autor 		= $user->id;
        $noticia->descripcion	= $req->input('descripcion');
        $noticia->contenido 	= $req->input('contenido');

        $noticia->save();

        return redirect('/mis_noticias');
	}

}
