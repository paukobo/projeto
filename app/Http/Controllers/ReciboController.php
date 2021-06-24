<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use App\Models\User;
use App\Http\Requests;
use App\Models\Encomenda;
use App\Models\Tshirt;
use Illuminate\Http\Request;

class ReciboController extends Controller
{
    public function pdfview(Request $request, Encomenda $encomenda)
    {
        $user = auth()->user();
        //$users = DB::table("users")->get();
        $tshirts = Tshirt::query()->where('encomenda_id', $encomenda->id);
        view()->share('user',$user);
        if($request->has('download')){
        $pdf = PDF::loadView('pdfview');
        return $pdf->download('pdfview.pdf', compact('tshirts'));
        }
    return view('pdfview');
    }
}
