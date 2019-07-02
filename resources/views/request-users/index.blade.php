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
                                            <button class="btn-warning btn btn-xs"
                                                    data-cpf="{{$r->cpf}}"
                                                    data-name="{{$r->name}}"
                                                    data-phone1="{{$r->phone1}}"
                                                    data-phone2="{{$r->phone2}}"
                                                    data-toggle="modal"
                                                    data-target="#edit-request-user"
                                                    data-id="{{$r->id}}"
                                            >Editar</button>
                                            <button class="btn btn-danger btn-xs" data-id="{{$r->id}}"
                                                    id="delete-request-user">Apagar</button>
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

                    <form action="{{route('request-user.store')}}" method="POST" class="form-horizontal">
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
                                <input type="text" name="name" id="name" class="form-control" required>
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
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Encerra modal-->

    <!--Modal Editar Setor   -->
    <div class="modal inmodal fade" id="edit-request-user" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar Solicitante</h4>
                </div>

                <div class="modal-body">

                    <form action="{{route('request-user.update')}}" method="post" class="form-horizontal">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="cpf" class="col-sm-2 control-label">CPF:</label>
                            <div class="col-sm-10">
                                <input type="text" name="cpf" id="cpf" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nome Completo:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control" required>
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
                            <button type="reset" class="btn btn-white" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Encerra modal-->


@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#phone1').mask("(00) 00000-0000", {placeholder: "(00)00000-0000"});
            $('#phone2').mask("(00) 00000-0000", {placeholder: "(00)00000-0000"});
            $('#cpf').mask("000.000.000-00", {placeholder: "000.000.000.00"});
        });

        $("#edit-request-user").on('show.bs.modal',function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var cpf = button.data('cpf');
            var name = button.data('name');
            var phone1 = button.data('phone1');
            var phone2 = button.data('phone2');
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #cpf').val(cpf).mask("000.000.000-00", cpf);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #phone1').val(phone1).mask("(00) 00000-0000", phone1);
            modal.find('.modal-body #phone2').val(phone2).mask("(00) 00000-0000", phone2);
        });

        $("#delete-request-user").on('click', function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            swal({
                    title: "Tem Certeza?",
                    text: "Uma vez deletado o registro não poderá ser restaurado!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sim, Deletar",
                    closeOnConfirm: false
                },
                function(isConfirm) {
                    if (isConfirm){
                        $.ajax({
                            headers:{
                                'X-CSRF-Token' : csrf_token
                            },
                            type: "POST",
                            url: "{{url('/setores/delete')}}",
                            data: {id:id},
                            success: function (data) {
                                console.log(data)
                                swal({
                                    type: 'success',
                                    title: 'Sucesso!',
                                    text: 'O Registro foi deletado com sucesso!',
                                    timer:2000
                                });
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            }
                        });
                    } else {
                        swal({
                            title : "Cancelado",
                            type : "error",
                            text : "Seu registro está salvo!"
                        })
                    }
                });

        });
    </script>
@endpush