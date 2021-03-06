@extends('globalprint.wkhtml')
@section('subtitle')
@if($economic_complement->old_eco_com)
  {{-- <center><strong>(RECALIFICACION)</strong></center> --}}
	@endif
@endsection
@section('content')
<style type="text/css">
    .number{
      text-align: right;
    }
    td{
      font-size:10px;
    }
</style>
<div class="title2"><strong class="code">{!! $title_inline !!}</strong><strong class="code">DOC - {!! $doc_number !!} </strong><strong class="code">Trámite Nº: {!! $economic_complement->code !!} </strong></div>
  <div id="project">
    @include('economic_complements.info.applicant_info',['eco_com_applicant'=>$eco_com_applicant])

    @if($economic_complement->has_legal_guardian)
    @include('economic_complements.info.legal_guardian',['economic_complement_legal_guardian'=>$economic_complement_legal_guardian])
    @endif

    @include('economic_complements.info.simple_info',['economic_complement'=>$economic_complement])
    <table>
      <tr>
        <td colspan="3" class="grand service info_title" ><strong>CÁLCULO DEL COMPLEMENTO ECONÓMICO</strong></td>
      </tr>
      <tr>
        <td class="grand service info_title" rowspan="2" style="vertical-align: middle;"><strong>DETALLE</strong></td>
        <td class="grand service info_title" colspan="2"><b style="text-align: center">MONTO CALCULADO</strong></td>
        </tr>
        <tr>
          <td class="grand service"><strong>A FAVOR</strong></td><td class="grand service"><strong>DESCUENTO</strong></td>
        </tr>
        <tr>
          <td><strong>BOLETA TOTAL</strong></td><td class="number"><strong>{{$total_rent}}</strong></td><td></td>
        </tr>
        <tr>
          <td>RENTA O PENSIÓN (PASIVO NETO)</td><td class="number">{{$total_rent_calc}}</td><td></td>
        </tr>
        <tr>
          <td>REFERENTE SALARIO DEL ACTIVO</td><td class="number">{{$salary_reference}}</td><td></td>
        </tr>
        <tr>
          <td>ANTIGÜEDAD (SEGÚN CATEGORÍA)</td><td class="number">{{$seniority}}</td><td></td>
        </tr>
        <tr>
          <td>SALARIO COTIZABLE (SALARIO DEL ACTIVO + ANTIGÜEDAD)</td><td class="number">{{$salary_quotable}}</td><td></td>
        </tr>
        <tr>
          <td>DIFERENCIA (SALARIO ACTIVO - RENTA PASIVO)</td><td class="number">{{$difference}}</td><td></td>
        </tr>
        <tr>
          <td>TOTAL SEMESTRE (DIFERENCIA SE MULTIPLICA POR 6 MESES)</td><td class="number">{{$total_amount_semester}}</td><td></td>
        </tr>
        <tr>
          <td>FACTOR DE COMPLEMENTACIÓN</td><td class="number">{{ $factor_complement }} %</td><td></td>
        </tr>
        @if($economic_complement->amount_loan  > 0 || $economic_complement->amount_accounting > 0|| $economic_complement->amount_replacement >0 )
        <tr>
          <td class="grand service text-left"><strong>TOTAL COMPLEMENTO ECONÓMICO EN BS. ({{ $economic_complement->old_eco_com ? 'RECALIFICADO':'CALIFICADO' }})</strong></td><td class="number"><strong>{{$temp_total}}</strong></td><td></td>
        </tr>
        @endif
        @if($economic_complement->amount_loan)
        <tr>
          <td> – AMORTIZACIÓN POR PRESTAMOS EN MORA</td><td></td><td class="number" >{{Util::formatMoney($economic_complement->amount_loan)}}</td>
        </tr>
        @endif
        @if($economic_complement->amount_accounting)
        <tr>
          <td> – AMORTIZACIÓN POR CUENTAS POR COBRAR</td><td></td><td class="number" >{{Util::formatMoney($economic_complement->amount_accounting)}}</td>
        </tr>
        @endif
        @if($economic_complement->amount_replacement)
        <tr>
          <td> – AMORTIZACIÓN POR REPOSICIÓN DE FONDOS</td><td></td><td class="number" >{{Util::formatMoney($economic_complement->amount_replacement)}}</td>
        </tr>
        @endif
        <tr>
          @if($economic_complement->amount_loan  > 0 || $economic_complement->amount_accounting > 0|| $economic_complement->amount_replacement >0 )
          <td class="grand service text-left"><strong>TOTAL LIQUIDO A PAGAR EN BS.</strong></td><td class="number"><strong>{{$total}}</strong></td><td></td>
          @else
          <td class="grand service text-left"><strong>TOTAL COMPLEMENTO ECONÓMICO EN BS.</strong></td><td class="number"><strong>{{$total}}</strong></td><td></td>
          @endif
        </tr>
        @if($economic_complement->old_eco_com)
        <tr>
          <td>TOTAL COMP. ECO. PAGADO</td>
          <td></td><td class="number">{!! Util::formatMoney($old_eco_com_total_calificate) !!}</td>
        </tr>
        <tr style="font-size: 1.1em">
          <td  class="grand service text-left">TOTAL REINTEGRO</td>
          <td class="number"><strong>{!! Util::formatMoney($economic_complement->total_repay) !!}</strong></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="3"><strong>Son: </strong> {{ Util::convertir($economic_complement->total_repay) }} BOLIVIANOS</td>
        </tr>
        @else
        <tr>
          <td colspan="3"><strong>Son: </strong> {{ $total_literal }} BOLIVIANOS</td>
        </tr>
        @endif
        </table>
        <table>
        <tr>
          <td style="width:30px;" class="grand service text-left">NOTA:</td>
          <td ><strong> </strong>{!!$economic_complement->comment!!}</td>
        </tr>
      </table>
      <table>
        <tr>
          <td class="padding-top"><strong>Elaborado y Revisado por:</strong></td>
          <td class="padding-top"><strong>Aprobado por:</strong></td>
          <td class="padding-top"><strong>Aprobado por:</strong></td>
        </tr>
      </table>
  </div>
  <br>
  <div class="hr-line"></div>
{{-- backrest --}}
<table class="tableh">
  <tr>
    <th style="width: 25%;border: 0px;">
      <div id="logo">
        <img src="{{ asset('img/logo.jpg') }}" >
      </div>
    </th>
    <th style="width: 50%;border: 0px">
      <h4><b>MUTUAL DE SERVICIOS AL POLICÍA<br>
        {!! $header1 !!}<br>{!! $header2 !!}
        @yield('title')
      </b></h4>
    </th>
    <th style="width: 25%;border: 0px">
      <div id="logo2">
        <img src="{{ asset('img/escudo.jpg') }}" >
      </div>
    </th>
  </tr>
</table>
<table >
  <tr>
    <td class="izq no-border size-10">
      <strong>Fecha de Emisi&#243n: </strong> {!! $date !!} - {!! $hour !!}    
    </td>
    <td class="der no-border size-10">
      @if(isset($user))
        <strong>Usuario: </strong>{!! $user->username !!} - {!! $user_role !!}
      @endif
    </td>
  </tr>
</table>

<div class="title2 size-12"><strong class="code">COMPLEMENTO ECONÓMICO</strong><strong class="code">DOC - {!! $doc_number !!} </strong><strong class="code">Trámite Nº: {!! $economic_complement->code !!} </strong></div>
<div id="project">  
  @include('economic_complements.info.applicant_info',['eco_com_applicant'=>$eco_com_applicant])

  @if($economic_complement->has_legal_guardian)
  @include('economic_complements.info.legal_guardian',['economic_complement_legal_guardian'=>$economic_complement_legal_guardian])
  @endif

  @include('economic_complements.info.simple_info',['economic_complement'=>$economic_complement])

  <table>
    <tr>
      <td class="grand service text-left"><strong>TOTAL LIQUIDO A PAGAR EN BS.</strong></td><td class="number" rowspan="2"><strong class="size-16">{{$total}}</strong></td>
    </tr>
    <tr>
      <td><strong>Son: </strong> {{ $total_literal }} Bolivianos</td>
      
    </tr>
  </table>
</div>
@endsection