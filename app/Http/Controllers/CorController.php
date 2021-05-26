<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use Illuminate\Http\Request;


class CorController extends Controller
{
    public function index()
    {
        $cores = Cor::all();
        return view('cores.index', compact('cores'));
    }

    public function admin()
    {
        $cores = Cor::all();
        return view('cores.admin', compact('cores'));
    }
}
