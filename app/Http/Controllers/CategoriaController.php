<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaPost;


class CategoriaController extends Controller
{
    public function admin(Request $request)
    {
        $selectedNome = $request->nome ?? '';
        $qry = Categoria::query();
        if ($selectedNome) {
            $qry->where('nome', $selectedNome);
        }
        $categorias = $qry->paginate(7);
        return view('categorias.admin', compact('categorias', 'selectedNome'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = new Categoria();
        return view('categorias.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaPost $request)
    {
        $categoria = new Categoria();
        $categoria->fill($request->validated());
        $categoria->save();
        return redirect()->route('admin.categorias')
            ->with('alert-msg', 'Categoria "' . $categoria->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaPost $request, Categoria $categoria)
    {
        $categoria->fill($request->validated());
        $categoria->save();
        return redirect()->route('admin.categorias')
            ->with('alert-msg', 'Categoria "' . $categoria->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Categoria $categoria)
    {
        $oldName = $categoria->nome;

        $categoria->delete();
        return redirect()->route('admin.categorias')
            ->with('alert-msg', 'Categoria "' . $oldName . '" foi apagada com sucesso!')
            ->with('alert-type', 'success');
    }
}
