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
}
