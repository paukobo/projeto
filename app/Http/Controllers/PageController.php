<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $estampas = Estampa::query()->whereNull('cliente_id')->pluck('id');

        $qry = DB::table('tshirts')
        ->groupBy('estampa_id')->whereIn('estampa_id',$estampas)
        ->orderBy(DB::raw('count(estampa_id)'), 'DESC')
        ->take(4)
        ->pluck('estampa_id');

        $estampas = Estampa::query()->whereIn('id', $qry)->take(4)->get();
        return view('pages.index', compact('estampas'));
    }
}
