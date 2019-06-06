<?php

namespace App;

use Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Util
{
    const GESTOR = 1;

    /**
     * Busca as buildings selecionadas pelo usuário para exibição
     *
     * Filtra as buildings para os quais o usuário logado no sistema terá acesso aos dados. 
     *
     * @return array Array com as buildings as quais o usuário tem acesso aos dados
     **/
    public static function filtraEmpresas()
    {
        $buildings = [];
        /* Verifica se o usuário é GESTOR */
        if (intval(Auth()->user()->access_level) == self::GESTOR) {
            /* Busca as buildings permitidas ao usuário */
            $buildings = Session::get('buildings');
        }
        $buildings[] = Auth()->user()->building_id;

        return $buildings;
    }

    /**
     * Insere na lista os meses ausentes
     *
     * Função que verifica os meses ausentes na lista e insere a quantidade necessária com os atributos zerados
     *
     * @param array $array Lista com os objetos (Meses)
     * @return array Lista com os objetos ordenados
     **/
    public static function preencheMeses($array, $building, $year, $add = 0)
    {
        
        if(count($array) == 0){
            /* Caso a busca do BD não tenha retornado nenhum item, cria um array com 12 posições (12 meses) */
            for ($i=0; $i < (12 + $add); $i++) {
                $array[] = ['month' => $i + 1];
            }
        } else {
            /* Busca atributos do objeto */
            $obj = self::createEmptyObj($array[0]);

            /* Insere x objetos até completar 12 items (12 meses) */
            while (count($array) < 12+$add) {
                array_push($array, clone $obj);
            }

            // Define o mês inicial. 1 = Janeiro
            $mesAtual = 1;

            /* Para cada mês */
            foreach ($array as $item) {
                /* Verifica se o mês está vazio */
                if($item->month == "0") {
                    while ($item->month == "0") {
                        /* Busca o $mesAtual na lista. Caso encontrado, devolve a posição de forma numérica.
                         * Caso encontre, incrementa e realiza novamente a busca
                         * Caso não encontre, utiliza o mês e incrementa
                         */
                        if(is_numeric(array_search(strval($mesAtual), array_column($array, 'month')))){
                            $mesAtual++;
                        } else {
                            $item->month = strval($mesAtual++);
                            $item->year = $year;
                            $item->emp = $building;
                        }
                    }
                }
            }
            /* Ordena a lista pelo ano depois mês */
            foreach($array as $k=>$v) {
                $sort->year[$k] = $v->year;
                $sort->month[$k] = $v->month;
            }

            /* array_multisort($sort->year, SORT_ASC, $sort->month, SORT_ASC, $array); */

            return collect($array);
        }
    }

    public static function mergeCollections($collections)
    {
        $aux = new Collection;
        foreach ($collections as $collect) {
            $aux = $aux->merge($collect);
        }

        $aux = $aux->sortBy('month')->values();

        return $aux;
    }

    public static function mergeArrays($array)
    {
        $aux = array_fill(0, 12, 0);
        
        /* Realiza a soma dos valores */
        for ($i=0; $i < 12; $i++) { 
            foreach ($array as $item) {
                $aux[$i] += $item[$i];
            }
        }

        return $aux;
    }
    
    /**
     * Cria um objeto igual ao da lista porém com valores zerados
     *
     * Pega os atributos de um elemento da lista e cria um novo objeto com os valores zerados
     *
     * @param object $obj Objeto que será utilizado como base
     * @return object Retorna o objeto vazio
     **/
    public static function createEmptyObj($obj) {
        $attr = array_keys((get_object_vars($obj)));
        $newObject = new \stdClass();

        foreach ($attr as $item) {
            $newObject->{$item} = 0;
        }

        return $newObject;
    }

    public static function formatNumberBD($num)
    {
         return preg_replace('/,/', '.', preg_replace('/[^0-9\,\-]/', '', preg_replace('/\(/', '-',$num)));
    }

    public static function NivelUsuario($nivel)
    {
        $niveis = ['Super Admin', 'Gestor', 'Administrador', 'Usuário'];

        return $niveis[$nivel];
    }
    
    public static function MesExtenso($mes)
    {
        $meses = ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

        return $meses[$mes];
    }

 
    public static function formatNumber($num)
    {
        $num = preg_replace('/[^0-9\.\-]/', '', $num);
        if(empty($num) || is_null($num) || $num == 0){
            return '-';
        } else {
            $num= number_format($num, 0, '', '.');
        }
        if($num<0)
            $num= '('.str_replace('-','',$num).')';
        return $num;
    }

    public static function formatNumber2($num)
    {
        $num = str_replace('/[^0-9\.\-]/', '', $num);
        if(empty($num) || is_null($num)|| $num == 0){
            return '-';
        } else {
            $num= number_format($num, 0, '', '.');
        }
        if($num<0)
            $num= '('.str_replace('-','',$num).')';
        return $num;
    }
    

    public static function formatNumber2d($num)
    {
        $num = str_replace('/[^0-9\.\-]/', '', $num);
        if(empty($num) || is_null($num)|| $num == 0){
            return '-';
        } else {
            $num= number_format($num, 2, ',', '.');
        }
        if($num<0)
            $num= '('.str_replace('-','',$num).')';
        return $num;
    }
    

    public static function formatPercent($num)
    {
        if(empty($num) || is_null($num)|| $num == 0){
            return '-';
        } else {
        $num = ((float)$num) * 100;
        
        return number_format($num, 2, ',', '') . '%';
        }
    }

    public static function formatOther($num)
    {
        if(empty($num) || is_null($num)|| $num == 0){
            return '-';
        } else {
        return number_format($num, 2, ',', '');
        }
    }
    
    public static function format4dec($num)
    {
        if(empty($num) || is_null($num)|| $num == 0){
            return '-';
        } else {
        return number_format($num, 4, ',', '');
        }
    }

    public static function getDefaultYear($year)
    {
        if(is_null($year))
        {
            /* Se não existir ANO na sessão, busca do BD !!!!! A ser implementado !!!!!!! */
            if (!Session::has('year')) {
                /* $year = Settings::get().... */
                $year = is_null($year) ? date("Y") : $year;
            } else { /* Se existir ANO na sessão, recupera o valor */
                $year = Session::get('year');
            }
        }
        /* session(['year' => $year]); */
        Session::put('year', $year);

        return $year;
    }

    public static function addAcumulado($vet, $keys, $offset = 0)
    {
        $acumulado = new \StdClass();
        foreach ($keys as $key => $value)
        {
            $acumulado->{$value} = 0;
            if (($value != 'month') && ($value != 'year') && ($value != 'emp')) {
                for ($i = 0 + $offset; $i < count($vet); $i++) {
                    $acumulado->{$value} = $vet[$i]->{$value}+$acumulado->{$value};
                }
            }
        }
        return ($acumulado);
    }

    public static function somatorioGestor($collection, $acumulado = 12)
    {
        $aux = [];

        /* Ordena a lista pelo mês: 1 -> 12 */
        /* usort($collection, function($a, $b)
        {
            return strnatcasecmp($a->month, $b->month);
        }); */
        /* $collection = $collection->sortBy('month'); */

        /* Verify if array have items */
        if(!is_null($collection) && count($collection) > 0)
        {
            /* Identifica qual collection possui mais atributos */
            $attributes = [];
            foreach ($collection as $item) {
                $attr = array_keys((get_object_vars(self::createEmptyObj($item))));
                if (count($attr) > count($attributes)) {
                    $attributes = $attr;
                }
            }

            /* Verifica se todas as contas possuem todos os atributos, se algum não existir, cria vazio */
            foreach ($collection as $linha) {               
                foreach($attributes as $attr)
                {
                    if($attr != 'month' && $attr != 'year' && $attr != 'emp') 
                    {
                        if(property_exists($linha, $attr)){
                            $linha->{$attr} = is_null($linha->{$attr}) ? 0.00 : floatval($linha->{$attr});
                        } else {
                            $linha->{$attr} = 0.00;
                        }
                    }
                }
            }
            
            /* Cria os meses do ano sem valores */
            $obj = new \StdClass();
            foreach ($attributes as $attr) {
                $obj->{$attr} = 0;
            }

            for ($i = 0; $i < $acumulado; $i++) {
                $obj->year = self::getDefaultYear(null);
                $obj->month = $i + 1;
                $obj->emp = Auth()->user()->building_id;

                $aux[] = clone $obj;
            }

            /* Realiza a soma dos valores */
            foreach ($collection as $item) {
                foreach($attributes as $attr)
                {
                    if($attr != 'month' && $attr != 'year' && $attr != 'emp') {
                        if($item->month != 0) {
                            $aux[($item->month-1)]->{$attr} += $item->{$attr};
                        } else {
                            $aux[12]->{$attr} += $item->{$attr};
                        }
                    }
                }
            }
        }
        
        return $aux;
    }
}

