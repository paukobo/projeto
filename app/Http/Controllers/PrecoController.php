<?php

namespace App\Http\Controllers;

use App\Models\Preco;
use Illuminate\Http\Request;
use App\Http\Requests\PrecoPost;

class PrecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precos = Preco::all();
        return view('precos.index', compact('precos'));
    }

    public function admin(Request $request)
    {
        $selectedId = $request->id ?? '';
        $qry = Preco::query();
        if ($selectedId) {
            $qry->where('id', $selectedId);
        }
        $precos = $qry->paginate(7);
        return view('precos.admin', compact('precos', 'selectedId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Preco  $preco
     * @return \Illuminate\Http\Response
     */
    public function edit(Preco $preco)
    {
        return view('precos.edit', compact('preco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preco  $preco
     * @return \Illuminate\Http\Response
     */
    public function update(PrecoPost $request, Preco $preco)
    {
        $preco->fill($request->validated());
        $preco->save();
        return redirect()->route('admin.precos')
            ->with('alert-msg', 'Preço "' . $preco->id . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }
}
