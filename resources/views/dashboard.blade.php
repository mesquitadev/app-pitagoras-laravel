@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Total de Chaves</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$allKeys}}</h1>
                    </div>
                </div>

            </div>
            <div class="col-lg-3">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Chaves Emprestadas</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$loanKeys}}</h1>
                    </div>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Ultimas Retiradas</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-hover no-margins">
                                    <thead>
                                    <tr>
                                        <th>Chave:</th>
                                        <th>Usuário Retirada:</th>
                                        <th>Retirada:</th>
                                        <th>Entrega:</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach($requests as $r)
                                            <td>{{$r->key}}</td>
                                            <td>{{$r->username}}</td>
                                            <td>
                                                <span class="label label-danger"> Saída </span>
                                                {{\Carbon\Carbon::parse($r->loan_date )->format(' d/m/Y  H:i:s ')}}
                                            </td>

                                                @if ($r->devolution_date == null)
                                                    <td>
                                                        <span class="label label-danger">Não Entregue</span>
                                                    </td>
                                                @elseif ($r->devolution_date != null)
                                                    <td>
                                                        <span class="label label-primary"></span>
                                                        {{\Carbon\Carbon::parse($r->loan_date)->format('d/m/Y')}}
                                                    </td>
                                                @endif
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
