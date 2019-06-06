@extends('adminlte::page')
@section('content_header')
    <h1>
          Consumo Predio <small>Período:  {{$month}}/{{$year}}</small>
    </h1>

@endsection

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
<link rel="stylesheet" href="{{ asset('/assets/css/estiloarvore.css') }}" />
{!! Form::open(['url' => 'agregado/mensal', 'name' => 'formData', 'id' => 'formData']) !!}

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="col-xs-12">
                <div class="input-group pull-right calendario">
                    <label>Mês Referência:</label>
                    @include('site.mes_referencia')
                </div>
            </div>
            <div class="panel scroll" style="padding-left:10px">
                <div class="box-body palco">
                        Consumo no mês:  {{\App\Util::formatNumber(json_encode($consumo))}} <br>
                        Média Consumo por dia: {{\App\Util::formatNumber2d(json_encode($media_consumo))}} <br>
                        Dias medidos:  {{\App\Util::formatNumber(json_encode($dias))}}<br>
                        Média de consumo por dia por pessoas:   {{\App\Util::formatNumber2d(json_encode($medio_pessoas))}} <br>
                     
    
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::hidden('selectedData', null, ['id' => 'selectedData']) !!}
{!! Form::close() !!}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" />
@endsection

@push('other_js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>


    <script>
        $(document).ready(function () {
    
            $('#formData').submit(function(e) {
                var dataArr = [];
                var rowData = table.rows({ selected: true }).data();
                $.each($(rowData), function (key, value) {
                    dataArr.push({id: value[1]});
                });
                $('#selectedData').val(JSON.stringify(dataArr));
            });
    
            $('#filtro').click(function (e) {
                date = ($('#mes_referencia').val()).split(/\//g);
                url = "{{ url('consumo-predio') }}/" + date[1] + '/' + date[0];
                $(this).attr("href", url);
            });
        });
    </script>

@endpush