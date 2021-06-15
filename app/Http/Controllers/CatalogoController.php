<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\EstampaPost;
use Illuminate\Support\Facades\Storage;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        $categoria = $request->categoria ?? '';
        $search = $request->search ?? '';

        $qry = Estampa::query();



        if(auth()->check() && auth()->user()->tipo=='C'){

            $qry = $qry->where('cliente_id', auth()->user()->id)->orwhere('cliente_id', null);
        }else{
            $qry = $qry->where('cliente_id', null);
        }



        if($categoria){
            $qry =  $qry->where([['categoria_id',$categoria]]);
        }
        if($search){
            $qry = $qry->where(function($query) use ($search) {$query->where('nome','like', $search)->orwhere('descricao','like', $search);});
         }


        $estampas = $qry->paginate(20);
        $categorias = Categoria::pluck('nome','id');
        return view('catalogo.index',compact('estampas', 'categorias', 'categoria'));
    }

    public function admin(Request $request){
        $categoria = $request->categoria ?? '';
        $search = $request->search ?? '';

        $qry = Estampa::query();

        if($search){
            $qry = $qry->where(function($query) use ($search) {$query->where('nome','like', $search)->orwhere('descricao','like', $search);});
        }

        if($categoria){
            $qry =  $qry->where('categoria_id',$categoria);
        }

        $estampas = $qry->paginate(20);
        $categorias = Categoria::pluck('nome','id');
        return view('catalogo.admin',compact('estampas', 'categorias', 'categoria'));
    }

    public function create(){
        $estampa = new Estampa;
        $categorias = Categoria::pluck('nome','id');
        return view('catalogo.estampas.create', compact('estampa', 'categorias'));
    }

    public function edit(Estampa $estampa){
        $categorias = Categoria::pluck('nome','id');
        return view('catalogo.estampas.edit', compact('estampa', 'categorias'));
    }

    public function store(EstampaPost $request){
        $estampa = new Estampa();
        $estampa->fill($request->validated());

        if(auth()->user()->tipo == 'C'){
            $path = $request->imagem_url->store('estampas_privadas');
            $estampa->categoria_id = null;
            $estampa->cliente_id = auth()->user()->id;
        }else{
            $path = $request->imagem_url->store('public/estampas');
        }

        $estampa->imagem_url = basename($path);
        $estampa->save();
        return redirect()->route('admin.catalogo')
            ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(EstampaPost $request, Estampa $estampa){
        $oldPath = $estampa->imagem_url;
        $estampa->fill($request->validated());

        if($request->hasFile('imagem_url')){
            if(auth()->user()->tipo == 'C'){


                Storage::delete('estampas_privadas/'.$oldPath);
                $path = $request->imagem_url->store('estampas_privadas');
                $estampa->categoria_id = null;
                $estampa->cliente_id = auth()->user()->id;
            }else{
                Storage::delete('public/estampas/'.$oldPath);
                $path = $request->imagem_url->store('public/estampas');
                //dd($estampa->imagem_url);
            }

            $estampa->imagem_url = basename($path);
        }

        $estampa->save();
        return redirect()->route('admin.catalogo')
            ->with('alert-msg', 'Estampa "' . $estampa->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Estampa $estampa){
        $oldName = $estampa->nome;
        if (count($estampa->tshirts)) {
            return redirect()->route('admin.catalogo')
                ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '", porque esta Estampa está associada a tshirt(s)!')
                ->with('alert-type', 'danger');
        }
        if ($estampa->cliente && $estampa->cliente->id != auth()->user()->id) {
            return redirect()->route('admin.catalogo')
                ->with('alert-msg', 'Não foi possível apagar a Estampa "' . $oldName . '", porque esta Estampa pertence a um cliente!')
                ->with('alert-type', 'danger');
        }

        if(auth()->user()->tipo == 'C'){
            Storage::delete('estampas_privadas/'.$estampa->imagem_url);
        }else{
            Storage::delete('public/estampas/'.$estampa->imagem_url);
        }

        $estampa->delete();
        return redirect()->route('admin.catalogo')
            ->with('alert-msg', 'Estampa "' . $oldName . '" foi apagada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function imagemEstampa(Estampa $estampa){
        return response()->file(storage_path('app/estampas_privadas/'.$estampa->imagem_url));
    }
}
