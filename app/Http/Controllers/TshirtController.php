<?php

namespace App\Http\Controllers;

use App\Carrinho;
use App\Models\Tshirt;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TshirtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$tshirts = Tshirt::all();
        //return view('tshirt.index', ['tshirts' => $tshirts]);
        $selectedTamanho = $request->tamanho ?? '';
        $qry = Tshirt::query();
        if ($selectedTamanho) {
            $qry->where('tamanho', $selectedTamanho);
        }
        $tshirts = $qry->paginate(10);
        return view('tshirt.index', compact('tshirts', 'selectedTamanho'));
    }

    public function admin_index(Request $request)
    {
        $selectedTamanho = $request->tamanho ?? '';
        $qry = Tshirt::query();
        if ($selectedTamanho) {
            $qry->where('tamanho', $selectedTamanho);
        }
        $tshirts = $qry->paginate(10);
        return view('tshirt.admin', compact('tshirts', 'selectedTamanho'));
    }

    public function getAddToCart(Request $request, $id)
    {
        $tshirt = Tshirt::find($id);
        $oldCarrinho = Session::has('carrinho') ? Session::get('carrinho') : null;
        $carrinho = new Carrinho($oldCarrinho);
        $carrinho->add($tshirt, $tshirt->id);

        $request->session()->put('carrinho', $carrinho);
        dd($request->session()->get('carrinho'));
        return redirect()->route('tshirt.index');
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
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tshirt  $tshirt
     * @return \Illuminate\Http\Response
     */
    public function edit(Tshirt $tshirt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tshirt  $tshirt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tshirt $tshirt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tshirt  $tshirt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tshirt $tshirt)
    {
        //
    }
}
