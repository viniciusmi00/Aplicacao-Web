
@extends('adminlte::page')
@section('content_header')
    <h1>
        Edíficios
    </h1>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Edíficios</h3>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <div class="input-group-btn">
                            <a class="btn btn-success pull-right" href="{{ url('building') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Novo Cadastro</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-hover table-bordered" data-toggle="dataTable" data-form="deleteForm">
                    <thead>
                        <tr>
                            <th>Nome do Edíficio</th>
                            <th>Logradouro</th>
                            <th>Numero</th>
                            <th>Bairro</th>
                            <th>Cidade</th>
                            <th>UF</th>
                            <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buildings as $building)
                            <tr>
                                <td>{{ $building->nomePredio }}</td>
                                <td>{{ $building->logradouro }}</td>
                                <td>{{ $building->numero }}</td>
                                <td>{{ $building->bairro }}</td>
                                <td>{{ $building->municipio }}</td>
                                <td>{{ $building->uf }}</td>
                                <td>
                                    <center>
                                        <table>
                                            <tr>
                                                <td>
                                                    <a href="building/{{ $building->id }}" title="Editar" class ="btn btn-sm btn-flat btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;
                                                </td>
                                                <td>
                                                    {!! Form::model($building, ['method' => 'DELETE', 'url' => ['building/' . $building->id], 'class' => 'form-inline form-delete']) !!}
                                                    {!! Form::hidden('id', $building->id) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-flat btn-danger delete', 'title' => 'Excluir', 'name' => 'delete_modal']) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        </table>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-danger fade" id="modal_removeEmpresa" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Exclusão de building</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-dismissible">
                    <h4><i class="icon fa fa-ban"></i>ATENÇÃO! Tem certeza que deseja excluir esta building?</h4>
                    Essa ação não poderá ser desfeita.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-flat btn-outline pull-left" data-dismiss="modal"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;Cancelar</button>
                <button type="button" class="btn btn-flat btn-default" id="delete-btn"><strong>Confirmar</strong>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash"></i></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@push('other_js')
<script>
    $(document).ready(function () {
		var table = $('#tabela').DataTable({
			iDisplayLength: 10,
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json",
				select: {
					rows: {
						_: '%d itens selecionados',
						0: 'Nenhum item selecionado',
						1: '1 item selecionado'
					}
				}
			}
		});
    });

    $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
        e.preventDefault();
        var $form=$(this);
        $('#modal_removeEmpresa').modal({ backdrop: 'static', keyboard: false })
            .on('click', '#delete-btn', function(){
                $form.submit();
            });
    });
</script>
@endpush