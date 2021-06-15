<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chart;
use App\Models\Tshirt;
use App\Models\Cliente;
use App\Models\Encomenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{

    public function index()
    {
        return view('charts.index');
    }

    public function index_encomendas()
    {
        $year = ['2017','2018','2019','2020', '2021'];

        $encomendas = [];
        foreach ($year as $key => $value) {
            $encomendas[] = Encomenda::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $value)->count();
        }

    	return view('charts.index_encomendas')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('encomendas',json_encode($encomendas,JSON_NUMERIC_CHECK));
    }

    public function numbers_encomendas(){

        $year = ['2017','2018','2019','2020', '2021'];

        $encomendas = [];
        foreach ($year as $key => $value) {
            $encomendas[] = Encomenda::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $value)->count();
        }

        $numClientes = Cliente::count();
        $numEncomendas = Encomenda::count();
        $mediaEncomendas = number_format($numEncomendas / $numClientes, 2);

        return view('charts.numbers_encomendas', compact('numClientes', 'numEncomendas', 'encomendas', 'mediaEncomendas'))
            ->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('encomendas',json_encode($encomendas,JSON_NUMERIC_CHECK));
    }

}
