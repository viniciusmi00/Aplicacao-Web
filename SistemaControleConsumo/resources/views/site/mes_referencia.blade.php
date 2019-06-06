<div class="box-tools">
        <div class="input-group date input-group-append" style="width: 100%; padding-top: 5px;">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control" id="mes_referencia" name="mes_referencia" value="{{ $month . '/' . $year }}" required />
            <div class="input-group-btn">
                <a href="" class="btn btn-flat btn-primary" id="filtro" name="filtro"><i class="fa fa-search"></i>&nbsp;&nbsp;Buscar</a>
            </div>
        </div>
    </div>
    
    @push('other_js')
    <script>
        $('#mes_referencia').datepicker({
            autoclose: true,
            language: 'pt-BR',
            minViewMode: 1,
            todayHighlight: true,
            format: 'mm/yyyy',
            orientation: 'bottom',
        });
    
        $('#mes_referencia').mask('00/0000');
    </script>
    @endpush