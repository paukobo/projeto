<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Estampa;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        $categoria = $request->categoria ?? '';
        $search = $request->search ?? '';

        $qry = Estampa::query();

        if($search){
           $qry = $qry->where('nome','like', $search)->orwhere('descricao','like', $search);
        }


        if(auth()-> check() && auth()->user()->tipo=='c'){
            $qry = $qry->where('cliente_id', auth()->user()->id)->orwhere('cliente_id', null);
        }else{
            $qry = $qry->where('cliente_id', null);
        }


        if($categoria){
            $qry =  $qry->where('categoria_id',$categoria);
        }

        $estampas = $qry->paginate(20);
        $categorias = Categoria::pluck('nome','id');
        return view('catalogo.index',compact('estampas', 'categorias', 'categoria'));
    }

    public function imagemEstampa(Estampa $estampa){
        return response()->file(storage_path('app/estampas_privadas/'.$estampa->imagem_url));
    }
}
