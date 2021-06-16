<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class ReciboController extends Controller
{
    /* public function sendemail(){
        // SEND EMAIL WITH USER MODEL
        $invoice = null;
        // Send to user:
        $user = User::findOrFail(2);
        $user->notify(new InvoicePaid($invoice));
    } */

    public function pdfview(Request $request)
    {
        $user=auth()->user();
        //$users = DB::table("users")->get();
        view()->share('user',$user);
        if($request->has('download')){
        $pdf = PDF::loadView('pdfview');
        return $pdf->download('pdfview.pdf');
    }
    return view('pdfview');
    }
}