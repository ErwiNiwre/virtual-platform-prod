@extends('app')

@section('contentheader_title')

    <div class="row">
        <div class="col-md-8">
            {!! Breadcrumbs::render('contribution_rates') !!}
        </div>
        <div class="col-md-4 text-right">
            @can('manage')
                <a href="" data-target="#myModal-edit" class="btn btn-raised btn-success dropdown-toggle" data-toggle="modal">&nbsp;
                    <i class="glyphicon glyphicon-wrench"></i>&nbsp;
                </a>
            @endcan
        </div>
    </div>

@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="panel-title">Lista de Tasas de Aporte</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="contribution_rate-table">
                        <thead>
                            <tr class="success">
                                <th style="text-align:center;" rowspan="2">Año</th>
                                <th style="text-align:center;" rowspan="2">Mes</th>
                                <th style="text-align:center;" colspan="3">Sector Activo</th>
                                <th style="text-align:center;" colspan="4">Sector Pasivo</th>
                            </tr>
                            <tr class="success">
                                <th>Fondo de Retiro</th>
                                <th>Cuota mortuoria</th>
                                <th>Total Aporte</th>
                                <th>Auxilio Mortuorio</th>
                                <th>Total Aporte</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="box-header with-border">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Editar Tasas de Aporte - {!! $month_year !!}</h4>
                </div>
                <div class="modal-body">

                    {!! Form::model($last_contribution_rate, ['method' => 'PATCH', 'route' => ['contribution_rate.update', $last_contribution_rate->id], 'class' => 'form-horizontal']) !!}

                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="panel-title">Sector Activo</h3>
                                <div class="form-group">
                                        {!! Form::label('retirement_fund', 'Fondo de Retiro', ['class' => 'col-md-5 control-label']) !!}
                                    <div class="col-md-6">
                                        <input type="text" id="retirement_fund" class="form-control" required = "required" name="retirement_fund" value="{!! $last_contribution_rate->retirement_fund !!}"  data-inputmask="'mask': '9.99'" data-mask>
                                        <span class="help-block">Porcentaje de Fondo de Retiro</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                        {!! Form::label('mortuary_quota', 'Cuota mortuoria', ['class' => 'col-md-5 control-label']) !!}
                                    <div class="col-md-6">
                                        <input type="text" id="mortuary_quota" class="form-control" required = "required" name="mortuary_quota" value="{!! $last_contribution_rate->mortuary_quota !!}"  data-inputmask="'mask': '9.99'" data-mask>
                                        <span class="help-block">Porcentaje de Seguro de Vida</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="panel-title">Sector Pasivo</h3>
                                <div class="form-group">
                                        {!! Form::label('mortuary_aid', 'Auxilio Mortuorio', ['class' => 'col-md-5 control-label']) !!}
                                    <div class="col-md-6">
                                        <input type="text" id="mortuary_aid" class="form-control" required = "required" name="mortuary_aid" value="{!! $last_contribution_rate->mortuary_aid !!}"  data-inputmask="'mask': '9.99'" data-mask>
                                        <span class="help-block">Porcentaje de Auxilio Mortuorio</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row text-center">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <a href="{!! url('contribution_rate') !!}" class="btn btn-raised btn-warning" data-toggle="tooltip" data-placement="bottom" data-original-title="Cancelar">&nbsp;<i class="glyphicon glyphicon-remove"></i>&nbsp;</a>
                                    &nbsp;&nbsp;
                                    <button type="submit" class="btn btn-raised btn-success" data-toggle="tooltip" data-placement="bottom" data-original-title="Guardar">&nbsp;<i class="glyphicon glyphicon-floppy-disk"></i>&nbsp;</button>
                                </div>
                            </div>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script type="text/javascript">

        $(function() {
            $('#contribution_rate-table').DataTable({
                dom: '<"top">t<"bottom"p>',
                "order": [[ 0, "desc" ]],
                processing: true,
                serverSide: true,
                pageLength: 12,
                autoWidth: false,
                ajax: '{!! route('get_contribution_rate') !!}',
                columns: [
                    { data: 'year', sClass: "text-center", name: 'month_year' },
                    { data: 'month', sClass: "text-center", bSortable: false },
                    { data: 'retirement_fund', sClass: "text-center", bSortable: false },
                    { data: 'mortuary_quota', sClass: "text-center", bSortable: false },
                    { data: 'rate_active', sClass: "text-center", bSortable: false },
                    { data: 'mortuary_aid', sClass: "text-center", bSortable: false },
                    { data: 'rate_passive', sClass: "text-center", bSortable: false },
                ]
            });
        });

        $(document).ready(function(){
            $('.combobox').combobox();
            $('[data-toggle="tooltip"]').tooltip();
            $("#retirement_fund").inputmask();
            $("#mortuary_quota").inputmask();
            $("#mortuary_aid").inputmask();
        });

    </script>

@endpush
