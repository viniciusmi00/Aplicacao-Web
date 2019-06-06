@extends('adminlte::page')
@section('content_header')
    <h1>Usuário</h1>
@endsection

@section('content')
<div class="box">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12">
               
                <div class="box-header">
                    <h3 class="box-title">Usuário</h3>
                </div>
                @if($usuario->id > 0)
                    {!! Form::model($usuario, ['method' => 'PATCH', 'url'=> 'usuario/'. $usuario->id]) !!}
                @else
                    {!! Form::open(['url' => 'usuario']) !!}
                @endif

                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            {!! Form::label('nome', 'Nome') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                {!! Form::input('text', 'nome', $usuario->name, ['class' => 'form-control', 'id' =>'nome', 'placeholder' => 'Nome do usuário', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            {!! Form::label('email', 'E-mail') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-at"></i>
                                </div>
                                {!! Form::input('email', 'email', $usuario->email, ['class' => 'form-control', 'id' =>'email', 'placeholder' => 'E-mail', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            {!! Form::label('senha', 'Senha') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </div>
                                {!! Form::input('password', 'senha', $usuario->password, ['class' => 'form-control', 'id' =>'senha', 'placeholder' => 'Senha', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            {!! Form::label('access_level', 'Nível do Usuário') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-gavel"></i>
                                </div>
                                {!! Form::select('access_level', ['2' => 'Adminstrador', '3' => 'Usuário'], is_null($usuario->access_level) ? '3' : $usuario->access_level, ['class' => 'form-control', 'id' => 'access_level']) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                                {!! Form::label('telefone1', 'Telefone 1') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    {!! Form::input('text', 'telefone1', $usuario->telefone1, ['class' => 'form-control telefone', 'id' => 'telefone1', 'placeholder' => 'Telefone 1', 'maxlength' => 15, 'pattern' => '\([0-9]{2}\)[\s][0-9]{4,5}-[0-9]{4}', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {!! Form::label('telefone2', 'Telefone 2') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    {!! Form::input('text', 'telefone2', $usuario->telefone2, ['class' => 'form-control telefone', 'id' => 'telefone2', 'placeholder' => 'Telefone 2', 'maxlength' => 15, 'pattern' => '\([0-9]{2}\)[\s][0-9]{4,5}-[0-9]{4}']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                {!! Form::label('num_apartamento', 'Numero do Apartamento') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-building "></i>
                                    </div>
                                    {!! Form::input('text', 'num_apartamento', $usuario->num_apartamento, ['class' => 'form-control', 'id' => 'num_apartamento', 'placeholder' => '000', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                    {!! Form::label('qnt_pessoas', 'Quantidade de Pessoas') !!}
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        {!! Form::input('text', 'qnt_pessoas',  $usuario->qnt_pessoas, ['class' => 'form-control', 'id' => 'qnt_pessoas', 'placeholder' => '0', 'required']) !!}
                                    </div>
                                </div>
                 
                        </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {!! Form::label('building', 'Edíficio') !!}
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </div>
                                <select class="form-control building" id="building" name="building" required>
                                    @foreach ($buildings as $building)
                                        <option value="{{ $building->id }}">{{ $building->nomePredio }}</option>
                                    @endforeach
                                </select>
                                {{-- {!! Form::select('building', null, is_null($usuario->predio_id) ? Auth()->user()->predio_id : $usuario->predio_id, ['class' => 'form-control selectBuilding', 'id' => 'building']) !!} --}}
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('usuarios') }}" class="btn btn-flat btn-default"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;Voltar</a>
                {!! Form::button('Salvar&nbsp;&nbsp;&nbsp;<i class="fa fa-save"></i>', ['type' => 'submit', 'class' => 'btn btn-flat btn-success pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
            @if($usuario->access_level == "1")
                <div class="col-xs-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Acessos do usuário</h3>
                            @if( Auth()->user()->access_level == "0")
                                <div class="box-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_vincular"><i class="fa fa-chain" aria-hidden="true"></i>&nbsp;&nbsp;Vincular Building</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
						@desktop
						<div class="box-body table-responsive no-padding">
						@elsedesktop
						<div class="box-body table-responsive-sm no-padding">
						@enddesktop
                            <table id="tabela" name="tabela" class="table table-hover table-bordered" data-toggle="dataTable" data-form="deleteForm">
                                <thead>
                                    <tr>
                                    <th>Building</th>
                                        @if( Auth()->user()->access_level == "0")
                                            <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuario->buildings as $building)
                                        <tr>
                                            <td>{{ $building->nomePredio }}</td>
                                            @if( Auth()->user()->access_level == "0")
                                                <td>
                                                    <center>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    {!! Form::open(['method' => 'DELETE', 'url' => ['usuario/' . $usuario->id . '/building/' . $building->id], 'class' => 'form-inline form-delete']) !!}
                                                                    {!! Form::button('<i class="fa fa-chain-broken" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-flat btn-danger delete', 'title' => 'Excluir', 'name' => 'delete_modal']) !!}
                                                                    {!! Form::close() !!}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </center>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@if(Auth()->user()->access_level == 0)
{{-- Modal de inclusão de building para visualização do Gestor --}}
{!! Form::open(['url' => $usuario->id, 'id' => 'formUsuarioBuilding']) !!}
    <div class="modal modal-default fade" id="modal_vincular" role="dialog" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Inclusão de vínculo de gestor</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="predio_id">Buildings</label>
                        <select class="form-control selectBuilding" id="predio_id" name="predio_id" required>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>&nbsp;&nbsp;
                    <span class="pull-right">
                        <button type="button" class="btn btn-flat btn-success" id="vincula-btn">Salvar&nbsp;&nbsp;<i class="glyphicon glyphicon-floppy-disk"></i></button>
                    </span>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}

{{-- Modal para remover o vínculo do Gestor --}}
<div class="modal modal-danger fade" id="modal_removeVinculo" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Exclusão de vínculo de gestor</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-dismissible">
                    <h4><i class="icon fa fa-ban"></i>ATENÇÃO! Tem certeza que deseja remover esse vínculo de gestor?</h4>
                    Essa ação não poderá ser desfeita.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-flat btn-outline pull-left" data-dismiss="modal"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;Cancelar</button>
                <button type="button" class="btn btn-flat btn-default" id="delete-btn"><strong>Confirmar</strong>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('other_js')


<script src="{{ asset('../assets/js/MascaraValidacao.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        var sMascara = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        sOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(sMascara.apply({}, arguments), options);
            }
        };

        $('.telefone').mask(sMascara, sOptions);
    });
</script>

<script>
    $(document).ready(function () {
        $.fn.select2.defaults.set( "width", "100%" );

        $(.select
        $('.selectBuilding').select2({
            minimumResultsForSearch: Infinity,
            ajax: {
                url: '/api/buildings',
                dataType: 'json',
                type: 'GET',
                delay: 250,
            },
            placeholder: 'Selecione a building',
            language: 'pt-BR',
        });

		var table = $('#tabela').DataTable({
			iDisplayLength: 10,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json",
			}
		});
    });

    // Adiciona building no gestor
    $("#vincula-btn").click(function () {
        var user_id = {{ $usuario->id }};
        var predio_id = $('#predio_id').val();

        relacionaUsuarioBuilding(user_id, predio_id);
    });

    // Evento AJAX que relaciona Building com Usuário
    function relacionaUsuarioBuilding(user_id, predio_id) {
        if (user_id > 0 && predio_id > 0) {
            var url = '/usuario/' + user_id + '/building/' + predio_id;
            $.ajax({
                type: 'GET',
                url: url,
                success: function (msg) {
                    location.reload();
                }
            });
        } else {
            $('#predio_id').select2('open');
        }
    }

    $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
        e.preventDefault();
        var $form=$(this);
        $('#modal_removeVinculo').modal({ backdrop: 'static', keyboard: false })
            .on('click', '#delete-btn', function() {
                $form.submit();
            });
    });

</script>
@endpush