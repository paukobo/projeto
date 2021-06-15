<?php

namespace App\Http\Controllers;

use App\Http\Requests\TshirtPost;
use App\Models\Carrinho;
use App\Models\Tshirt;
use App\Models\Encomenda;
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
        $selectedCategoria = $request->categoria ?? '';
        $qry = Tshirt::query();
        if ($selectedCategoria) {
            $qry->where('categoria', $selectedCategoria);
        }
        $tshirts = $qry->paginate(10);
        return view('tshirt.index', compact('tshirts', 'selectedCategoria'));
    }

    public function admin_index(Request $request)
    {

        $tshirt = $request->encomenda_id ?? '';
        $search = $request->search ?? '';

        $qry = Tshirt::query();

        if (auth()->check() && auth()->user()->tipo == 'C') {

            if ($search) {
                $qry = $qry->where('id', 'like', $search)->orwhere('id', 'like', $search);
            }

            if ($tshirt) {
                $qry =  $qry->where([['encomenda_id', $tshirt]]);
            }

            $tshirts = $qry->paginate(10);

            return view('tshirts.admin', compact('tshirts', 'tshirt'));
        }

        if (auth()->check() && auth()->user()->tipo == 'A') {

            if ($search) {
                $qry = $qry->where('id', 'like', $search)->orwhere('id', 'like', $search);
            }

            $tshirts = $qry->paginate(10);
            return view('tshirts.admin', compact('tshirts', 'tshirt'));
        }
    }

    // public function getAddToCart(Request $request, $id)
    // {
    //     $tshirt = Tshirt::find($id);
    //     $oldCarrinho = Session::has('carrinho') ? Session::get('carrinho') : null;
    //     $carrinho = new Carrinho($oldCarrinho);
    //     $carrinho->add($tshirt, $tshirt->id);

    //     $request->session()->put('carrinho', $carrinho);
    //     dd($request->session()->get('carrinho'));
    //     return redirect()->route('tshirt.index');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tshirt = new Tshirt();
        return view('tshirts.create', compact('tshirt'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TshirtPost $request)
    {
        //criar tshirt
        $tshirt = new Tshirt;
        $tshirt->fill($request->validated());
        $tshirt->save();

        return redirect()->route('admin.tshirts')
            ->with('alert-msg', 'Tshirt nº "' . $tshirt->id . '" foi criada com sucesso!')
            ->with('alert-type', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tshirt  $tshirt
     * @return \Illuminate\Http\Response
     */
    public function edit(Tshirt $tshirt)
    {
        return view('tshirts.edit', compact('tshirt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tshirt  $tshirt
     * @return \Illuminate\Http\Response
     */
    public function update(TshirtPost $request, Tshirt $tshirt)
    {
        $tshirt->fill($request->validated());
        $tshirt->save();
        return redirect()->route('admin.tshirts')
            ->with('alert-msg', 'Tshirt nº"' . $tshirt->id . '" foi alterada com sucesso!')
            ->with('alert-type', 'success');
    }
}
