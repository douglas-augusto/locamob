@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="col s8">
                        <h5 style="padding: 17px;" class="breadcrumbs-title">Mensalidades</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($monthly_payments as $m)
            <div class="col s12 m4">
                <div class="card @if($m->payed == 1) green @else white @endif  darken-1">
                    <div class="card-content @if($m->payed == 1) white-text @else black-text @endif">
                        <span class="card-title">{{date("d/m/Y", strtotime($m->pay_day))}}</span>
                        <p>VALOR: R$ {{number_format($m->pay_value,2,',','.')}}</p>
                    </div>
                    <div class="card-action" @if($m->payed == 1) style="border-color: #fff3e0" @endif>
                        <form id="monthly_form{{$m->id}}" action="{{route('admin.contracts.monthly_payments.update',['monthly' => $m->id,])}}" method="post">
                            @csrf
                            <div>
                                <input type="hidden" name="contract_id" value="{{$m->contract_id}}">
                                <input name="pay_check" @if($m->payed == 1) checked @endif onclick="return document.getElementById('monthly_form{{$m->id}}').submit();"
                                       type="checkbox" id="check{{$m->id}}">
                                <label for="check{{$m->id}}" style="color: @if($m->payed == 1) #fff @else #000 @endif">@if($m->payed == 1) PAGO @else MARCAR COMO PAGO @endif</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection
