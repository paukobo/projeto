<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use Illuminate\Http\Request;
use App\Http\Requests\CorPost;


class CorController extends Controller
{
    public function index()
    {
        $cores = Cor::all();
        return view('cores.index', compact('cores'));
    }

    public function admin(Request $request)
    {
        $selectedCor = $request->cor_codigo ?? '';
        $qry = Cor::query();
        if ($selectedCor) {
            $qry->where('cor_codigo', $selectedCor);
        }
        $cores = $qry->paginate(10);
        return view('cores.admin', compact('cores', 'selectedCor'));
    }

    public function edit(Cor $cor)
    {
        return view('cores.edit', compact('cor'));
    }

    public function create()
    {
        $cor = new Cor;
        return view('cores.create', compact('cor'));
    }

    public function store(CorPost $request)
    {
        $cor = new Cor();
        $cor->fill($request->validated());
        $cor->save();
        return redirect()->route('admin.cores')
            ->with('alert-msg', 'Cor "' . $cor->nome . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function update(CorPost $request, Cor $cor)
    {
        $cor->fill($request->validated());
        $cor->save();
        return redirect()->route('admin.cores')
            ->with('alert-msg', 'Cor "' . $cor->nome . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }

    public function destroy(Cor $cor)
    {
        $oldName = $cor->nome;
        if (count($cor->codigo)) {
            return redirect()->route('admin.cores')
                ->with('alert-msg', 'Não foi possível apagar a Cor "' . $oldName . '", porque esta Cor está associada a códigos(s)!')
                ->with('alert-type', 'danger');
        }
        $cor->delete();
        return redirect()->route('admin.cores')
            ->with('alert-msg', 'Cor "' . $oldName . '" foi apagada com sucesso!')
            ->with('alert-type', 'success');
    }

}
