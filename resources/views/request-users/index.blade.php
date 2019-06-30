@extends('layouts.app')
@section('title', 'Chaves Cadastradas')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Usuários Cadastrados</h2>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-request-user">
                    <i class="fa fa-plus"></i> Adicionar Requisitante
                </button>
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Usuários Solicitantes</h5>
                    </div>
                    <div class="ibox-content">

                        <table class="footable table table-stripped toggle-arrow-tiny">
                            <thead>
                            <tr>

                                <th>#</th>
                                <th>Nome</th>
                                <th>Cpf</th>
                                <th>Telefone 1</th>
                                <th>Telefone 2</th>
                                <th>Data de Criação</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reqUsers as $r)
                                <tr>
                                    <td>{{$r->id}}</td>
                                    <td>{{$r->name}}</td>
                                    <td>{{$r->cpf}}</td>
                                    <td>{{$r->phone1}}</td>
                                    <td>{{$r->phone2}}</td>
                                    <td>{{\Carbon\Carbon::parse($r->created_at )->format('d/m/Y  H:i:s') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="" class="btn btn-primary btn-sm">Editar</a>
                                            <a href="" class="btn btn-info btn-sm">Visualizar</a>
                                            <a href="" class="btn btn-danger btn-sm">Deletar</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Sem items Cadastrados.</td>
                                    <td></td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="10">
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
    <!--Modal Adicionar Solicitante-->
    <div class="modal inmodal fade" id="add-request-user" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Adicionar Requisitante</h4>
                </div>

                <div class="modal-body">

                    <form id="addRequestUser" action="{{route('request-user.store')}}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="cpf" class="col-sm-2 control-label">CPF:</label>
                            <div class="col-sm-10">
                                <input type="text" name="cpf" id="cpf" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nome Completo:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone1" class="col-sm-2 control-label">Telefone 1:</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone1" id="phone1" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone2" class="col-sm-2 control-label">Telefone 2:</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone2"  id="phone2" class="form-control">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="reset" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Encerra modal-->



@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#phone1').mask("(00) 00000-0000", {placeholder: "(00)00000-0000"});
            $('#phone2').mask("(00) 00000-0000", {placeholder: "(00)00000-0000"});
            $('#cpf').mask("000.000.000-00", {placeholder: "000.000.000.00"});
        });
    </script>
@endpush