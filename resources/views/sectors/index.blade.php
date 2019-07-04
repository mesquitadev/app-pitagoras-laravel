@extends('layouts.app')
@section('title', 'Setores')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Chaves Cadastradas</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>s
                <li>
                    <a href="{{route('sector.index')}}">Setores</a>
                </li>
                <li class="active">
                    <strong>Listar</strong>
                </li>
        </div>
        <div class="col-lg-2">
            <div class="text-center btn-add">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-sector">
                    <i class="fa fa-plus"></i> Adicionar Setor
                </button>
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Setores Cadastrados</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="footable table table-stripped toggle-arrow-tiny" id="table-sector">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Setor</th>
                                <th>Data Criação</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sectors as $s)
                                <tr>
                                    <td class="over">{{$s->id}}</td>
                                    <td class="over">{{$s->name}}</td>
                                    <td class="over">{{\Carbon\Carbon::parse($s->created_at )->format('d/m/Y  H:i:s')
                                    }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn-warning btn btn-xs"
                                                    data-name="{{$s->name}}"
                                                    data-toggle="modal"
                                                    data-target="#edit-sector"
                                                    data-id="{{$s->id}}"
                                            >Editar</button>
                                            <button class="btn btn-danger btn-xs delete-sector" data-id="{{$s->id}}">Apagar</button>
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
    <!--Modal Adicionar Setor   -->
    <div class="modal inmodal fade" id="add-sector" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Adicionar Setor</h4>
                </div>

                <div class="modal-body">

                    <form action="{{route('sector.store')}}" id="addKey" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Identificação do Setor</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control">
                            </div>
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

    <!--Modal Editar Setor   -->
    <div class="modal inmodal fade" id="edit-sector" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar Setor</h4>
                </div>

                <div class="modal-body">

                    <form action="{{route('sector.update')}}" method="post" class="form-horizontal">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="sector_id" id="sector_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Identificação do Setor</label>
                            <div class="col-sm-10">
                                <input type="text" id="name" name="name" class="form-control">
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
    <script>
        $("#edit-sector").on('show.bs.modal',function(event) {
           var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var modal = $(this);
            modal.find('.modal-body #sector_id').val(id);
            modal.find('.modal-body #name').val(name);
        });

        $(".delete-sector").on('click', function(event){
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
                            text : "Seu registro está salvo!",
                            timer:2000
                        })
                    }
                });

        });
    </script>
@endpush
