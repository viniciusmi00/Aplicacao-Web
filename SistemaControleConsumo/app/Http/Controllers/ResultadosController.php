<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultadosController extends Controller
{
    public function meuConsumo($year = null, $month = null)
    {
        $predio_id = Auth()->user()->predio_id;
        $user_id = Auth()->user()->id;
       
		$month = is_null($month) ? date("m") : $month;
		$year = is_null($year) ? date("Y") : $year;

        $consumo = 0;
        $dias = 0;
        $media_consumo = 0;
        $pessoas = 0;
        $medio_pessoas = 0;
        $acumulado_consumo = 0;
        $acumulado_pessoa = 0;
        $acumulado_media = 0;
        $valor = 0;
        $total = 0;

        $accountAno =  DB::select(DB::raw("SELECT * FROM accounts WHERE year = $year AND month = $month AND user_id = " . Auth()->user()->id));
        $usuario =  DB::select(DB::raw("SELECT * FROM users WHERE id = " . Auth()->user()->id));
        $rates =  DB::select(DB::raw("SELECT * FROM rates WHERE id = " . Auth()->user()->predio_id));

        foreach($usuario as $item)
        {
            $pessoas = $item->qnt_pessoas;
        }

        foreach($rates as $item)
        {
            $valor = $item->valor;
        }

        foreach($accountAno as $item)
        {
            $consumo = $item->consumo;
            $dias = $item->dias_med;
            $media_consumo = $consumo / $dias;
            $medio_pessoas = $media_consumo / $pessoas;

            $total = (($consumo/1000)* $valor);

        }

        //dd($media_consumo);

        return view('admin.resultados.meuconsumo.index')->with(
            [
                'accountAno'                => $accountAno,
                'year'						=> $year,
                'month'						=> $month,
                'consumo'					=> $consumo,
                'dias'						=> $dias,
                'media_consumo'				=> $media_consumo,
                'medio_pessoas'			    => $medio_pessoas,
                'pessoas'			    => $pessoas,
                'total'			    => $total,

            ]);
    }

    public function consumoPredio ($year = null, $month = null)
    {
        $predio_id = Auth()->user()->predio_id;
        $user_id = Auth()->user()->id;
       
		$month = is_null($month) ? date("m") : $month;
		$year = is_null($year) ? date("Y") : $year;

        $consumo = 0;
        $dias = 0;
        $media_consumo = 0;
        $pessoas = 0;
        $medio_pessoas = 0;
        $acumulado_consumo = 0;
        $acumulado_pessoa = 0;
        $acumulado_media = 0;
        $valor = 0;
        $total = 0;

        $accountAno =  DB::select(DB::raw("SELECT * FROM accounts WHERE year = $year AND month = $month AND predio_id = " . Auth()->user()->predio_id));
        $predio =  DB::select(DB::raw("SELECT * FROM users WHERE id = " . Auth()->user()->predio_id));
        $rates =  DB::select(DB::raw("SELECT * FROM rates WHERE id = " . Auth()->user()->predio_id));

        
        foreach($predio as $item)
        {
            $pessoas = $item->qnt_pessoas;
        }
        foreach($accountAno as $item)
        {
            $consumo =+ $item->consumo;
            $dias =+ $item->dias_med;
            $media_consumo =+ $consumo / $dias;
            $medio_pessoas =+ $media_consumo / $pessoas;
            $total = (($consumo/1000)* $valor);
        }

        //dd($media_consumo);

        return view('admin.resultados.consumopredio.index')->with(
            [
                'accountAno'                => $accountAno,
                'year'						=> $year,
                'month'						=> $month,
                'consumo'					=> $consumo,
                'dias'						=> $dias,
                'media_consumo'				=> $media_consumo,
                'medio_pessoas'			    => $medio_pessoas,
                'pessoas'			        => $pessoas,
                'total'			    => $total,

            ]);
    }
}
