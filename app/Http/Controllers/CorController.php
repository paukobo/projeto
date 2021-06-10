<?php

namespace App\Http\Controllers;

use App\Http\Requests\CorPost;
use App\Models\Cor;
use Illuminate\Http\Request;

class CorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cores = Cor::all();
        return view('cores.index', compact('cores'));

    }

    public function admin(Request $request)
    {
        $selectedCor = $request->codigo ?? '';
        $qry = Cor::query();
        if ($selectedCor) {
            $qry->where('codigo', $selectedCor);
        }
        $cores = $qry->paginate(10);
        return view('cores.admin', compact('cores', 'selectedCor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cor = new Cor();
        return view('cores.create', compact('cor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CorPost $request)
    {
        $cor = new Cor();
        $cor->fill($request->validated());

        $cor->save();
        return redirect()->route('admin.cores')
            ->with('alert-msg', 'A Cor "' . $cor->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Http\Response
     */
    public function edit(Cor $cor)
    {
        return view('cores.edit', compact('cor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Http\Response
     */
    public function update(CorPost $request, Cor $cor)
    {
        $cor->fill($request->validated());
        $cor->save();
        return redirect()->route('admin.cores')
            ->with('alert-msg', 'A Cor "' . $cor->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cor $cor)
    {
        $oldName = $cor->nome;
        $cor->delete();
        return redirect()->route('admin.cores')
            ->with('alert-msg', 'Cor "' . $oldName . '" foi apagada com sucesso!')
            ->with('alert-type', 'success');
    }
}
