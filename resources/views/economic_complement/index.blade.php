@extends('app')

@section('contentheader_title')

    {!! Breadcrumbs::render('economic_complements') !!}

@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><span class="glyphicon glyphicon-search"></span> Búsqueda</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <form method="POST" id="search-form" role="form" class="form-horizontal">
                            <div class="col-md-11">
                                <div class="row"><br>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('code', 'Número Trámite', ['class' => 'col-md-5 control-label']) !!}
                                            <div class="col-md-7">
                                                {!! Form::text('code', '', ['class'=> 'form-control']) !!}
                                                <span class="help-block">Escriba el Número Trámite</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                                {!! Form::label('creation_date', 'Fecha de Emisión', ['class' => 'col-md-5 control-label']) !!}
                                            <div class="col-md-7">
                                    			<div class="input-group">
                                                    <input type="text" class="form-control datepicker" name="creation_date" value="">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('eco_com_type', 'Tipo', ['class' => 'col-md-5 control-label']) !!}
        									<div class="col-md-7">
        										{!! Form::select('eco_com_type', $eco_com_types_list, null, ['class' => 'form-control']) !!}
        										<span class="help-block">Selecione el tipo de Proceso</span>
        									</div>
    									</div>
                                    </div>
                                </div>
                                <div class="row"><br>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('affiliate_identitycard', 'Número Carnet', ['class' => 'col-md-5 control-label']) !!}
                                            <div class="col-md-7">
                                                {!! Form::text('affiliate_identitycard', '', ['class'=> 'form-control', 'onkeyup' => 'this.value=this.value.toUpperCase()']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                                {!! Form::label('eco_com_state_id', 'Estado', ['class' => 'col-md-5 control-label']) !!}
                                            <div class="col-md-7">
                                                {!! Form::select('eco_com_state_id', $eco_com_states_list, '', ['class' => 'combobox form-control']) !!}
                                                <span class="help-block">Seleccione Estado</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
        									{!! Form::label('eco_com_modality_id', 'Modalidad', ['class' => 'col-md-5 control-label']) !!}
        									<div class="col-md-7">
        										{!! Form::select('eco_com_modality_id', ['clear' => ''], null, ['class' => 'form-control']) !!}

        										<span class="help-block">Selecione la Modalidad</span>
        									</div>
        								</div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <div class="row text-center">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="reset" class="btn btn-raised btn-warning" data-toggle="tooltip" data-placement="bottom" data-original-title="Limpiar">&nbsp;<span class="glyphicon glyphicon-erase"></span>&nbsp;</button>
                                            &nbsp;&nbsp;<button type="submit" class="btn btn-raised btn-success" data-toggle="tooltip" data-placement="bottom" data-original-title="Buscar">&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover" id="economic_complements-table">
                                <thead>
                                    <tr class="success">
                                        <th class="text-center"><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Número de Trámite">Número</div></th>
                                        <th class="text-left"><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Nombre de Afiliado">Nombre de Afiliado</div></th>
                                        <th class="text-left"><div data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Total a Pagar">Total a Pagar</div></th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>

        $(document).ready(function(){
            $('select[name="eco_com_type"]').on('change', function() {
                var moduleID = $(this).val();
                if(moduleID) {
                    $.ajax({
                        url: '{!! url('get_economic_complement_type') !!}/'+moduleID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="eco_com_modality_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="eco_com_modality_id"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                    });
                }
                else{
                    $('select[name="eco_com_modality_id"]').empty();
                }
            });
        });

        $(document).ready(function(){
           $('.combobox').combobox();
        });

        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            orientation: "bottom right",
            daysOfWeekDisabled: "0,6",
            autoclose: true
        });

        var oTable = $('#economic_complements-table').DataTable({
            "dom": '<"top">t<"bottom"p>',
            processing: true,
            serverSide: true,
            pageLength: 8,
            order: [0, "desc"],
            ajax: {
                url: '{!! route('get_retirement_fund') !!}',
                data: function (d) {
                    d.code = $('input[name=code]').val();
                    d.affiliate_name = $('input[name=affiliate_name]').val();
                    d.creation_date = $('input[name=creation_date]').val();
                    d.voucher_type = $('input[name=voucher_type]').val();
                    d.payment_date = $('input[name=payment_date]').val();
                    d.post = $('input[name=post]').val();
                }
            },
            columns: [
                { data: 'code', sClass: "text-center" },
                { data: 'affiliate_name', bSortable: false },
                { data: 'total', bSortable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false, bSortable: false, sClass: "text-center" }
            ]
        });

        $('#search-form').on('submit', function(e) {
            oTable.draw();
            e.preventDefault();
        });

    </script>
@endpush