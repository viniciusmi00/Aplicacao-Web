@extends('adminlte::page')

@section('content_header')
    <h1>Contas</h1>
@endsection

@section('content')
<style>
    .acoes{
        text-align: center;
    }
</style>
<div class="panel panel-default">   
    <div class="panel-body">
        <a class="pull-right btn btn-success btn-sm" href="{{url('accounts/novo')}}"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp; NOVO CADASTRO</a>
    </div>
    
    <div class="panel-body">
        @if(Session::has('mensagem_sucesso'))
        <div class="alert alert-success">{{Session::get('mensagem_sucesso')}}</div>
        @endif
        <div class="box-body table-responsive">
            <table id="tabela" name="tabela" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Período</th>
                        <th>Consumo total</th>
                        <th>Dias entre medições</th>
                        <th width="100px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                    <tr>
                        
                        <td>{{ $account->month }}/{{ $account->year }}</td>
                        <td>{{ $account->consumo }}</td>
                        <td>{{ $account->dias_med }}</td>
                        <td class="acoes">
                            <a href="accounts/{{$account->id}}/editar" class ="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'url' => '/accounts/'.$account->id, 'style' =>'display:inline;']) !!}
                            <button type="submit" class ="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<select id="valores_confinamento" class="form-control">
        @foreach($accounts as $account)
        <option value="{{ $account->id }}">{{ $account->name }}</option>
        @endforeach
    </select> 

        <span id="id_animal"></span>


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endsection


@push('other_js')   

<script>
    var select = document.getElementById('valores_confinamento'),
    output = document.getElementById('id_animal');
    select.addEventListener('change', function() {
        output.textContent =  'Valor: '    + this.value +
        ' / Texto: ' + select.options[select.selectedIndex].text;
    });
</script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>


<script>
$(document).ready(function() {
    $('#tabela').DataTable( {
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
});
</script>

@endpush