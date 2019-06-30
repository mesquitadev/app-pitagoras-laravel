@extends('layouts.app')
@section('title', 'Chaves Cadastradas')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Chaves Cadastradas</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li>
                    <a href="{{route('key.index')}}">Chaves</a>
                </li>
                <li class="active">
                    <strong>Listar</strong>
                </li>
        </div>
        <div class="col-lg-2">
            <div class="text-center btn-add">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addChave">
                    <i class="fa fa-plus"></i> Adicionar Chave
                </button>
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Chaves</h5>
                    </div>
                    <div class="ibox-content">

                        <table class="footable table table-stripped toggle-arrow-tiny">
                            <thead>
                            <tr>

                                <th>Código</th>
                                <th>Chave</th>
                                <th>Setor</th>
                                <th>Código de Barras:</th>
                                <th>Status</th>
                                <th>Tipo</th>
                                <th>Data de Cadastro:</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($keys as $k)
                            <tr>
                                <td class="over">{{$k->id}}</td>
                                <td class="over">{{$k->name}}</td>
                                <td class="over">{{$k->sector}}</td>
                                <td class="over">{{$k->barcode}}</td>

                                <td>
                                    @if($k->status === 'D')
                                        <span class="label label-primary">Disponível</span>
                                    @else
                                        <span class="label label-danger">Indisponível</span>
                                    @endif
                                </td>
                                <td class="over" >{{$k->type}}</td>

                                <td>{{$k->created_at}}</td>

                                <td>
                                    <div class="btn-group">
                                        <a class="btn-success btn btn-xs"  href="#">Cartão</a>
                                        <a class="btn-warning btn btn-xs" href="" >Editar</a>
                                        <button id="" data-id="{{$k->id}}" class="btn btn-danger btn-xs deleteKey">Apagar</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="12">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modais-->
    <!--Modal Adicionar Chave-->
    <div class="modal inmodal fade" id="addChave" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Adicionar Chave</h4>
                </div>

                <div class="modal-body">

                    <form action="{{route('key.store')}}" id="addKey" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Identificação da Chave</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Código de Barras</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="barcode" value="{{date( 'dmYHi') + 50}}"
                                       required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sector_id" class="col-sm-2 control-label">Setor</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="sector_id" required>
                                    <option value="Selecione Um Setor" selected>Selecione um Setor</option>
                                   @foreach($sector as $s)
                                    <option value="{{$s->id}}" >{{$s->name}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="type_id" class="col-sm-2 control-label">Tipo de Chave:</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="type_id" required>
                                    <option>Selecione o Tipo de Chave</option>
                                    @foreach($types as $t)
                                    <option value="{{$t->id}}">{{$t->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <svg class="barcode"
                                     jsbarcode-format="CODE128"
                                     jsbarcode-value="{{date( 'dmYHi') +50}}"
                                     jsbarcode-textmargin="0"
                                     jsbarcode-fontoptions="bold">
                                </svg>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-white" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Encerra modal-->
@endsection