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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-key">
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

                                <td>{{\Carbon\Carbon::parse($k->created_at)->format('d/m/Y H:i:s')}}</td>

                                <td>
                                    <div class="btn-group">
                                        <button class="btn-success btn btn-xs"
                                           data-name="{{$k->name}}"
                                           data-sector="{{$k->sector}}"
                                           data-type="{{$k->type}}"
                                           data-barcode="{{$k->barcode}}"
                                           data-toggle="modal"
                                           data-target="#key-card"
                                           data-id="{{$k->id}}"
                                        ><i class="fa fa-credit-card"></i> Cartão</button>
                                        <button class="btn-warning btn btn-xs"
                                                data-id="{{$k->id}}"
                                                data-name="{{$k->name}}"
                                                data-barcode="{{$k->barcode}}"
                                                data-sector="{{$k->sector}}"
                                                data-sector-id="{{$k->sector_id}}"
                                                data-type-id="{{$k->type_id}}"
                                                data-type="{{$k->type}}"
                                                data-toggle="modal"
                                                data-target="#edit-key"
                                        ><i class="fa fa-edit"></i> Editar</button>

                                        <button class="btn btn-danger btn-xs delete-key"
                                                data-id="{{$k->id}}"
                                        ><i class="fa fa-trash"></i> Apagar</button>
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
    <!--Modal Adicionar Chave OK-->
    <div class="modal inmodal fade" id="add-key" tabindex="-1" role="dialog"  aria-hidden="true">
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
                                <input type="text" class="form-control" name="barcode" value="{{date( 'dmYHis')}}"
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
                                     jsbarcode-value="{{date( 'dmYHi') + 50}}"
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

    <!--Modal Editar Chave-->
    <div class="modal inmodal fade" id="edit-key" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar Chave</h4>
                </div>

                <div class="modal-body">

                    <form action="{{route('key.update')}}" method="POST" class="form-horizontal">

                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Identificação da Chave</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Código de Barras</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="bar-code" name="barcode" required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sector_id" class="col-sm-2 control-label">Setor</label>
                            <div class="col-sm-10">
                                <select id="sector" class="form-control m-b" name="sector_id">
                                    <option value="" id="sectors" selected></option>
                                    @foreach($sector as $s)
                                        <option value="{{$s->id}}" data-id="{{$k->id}}" selected>{{$s->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="type_id" class="col-sm-2 control-label">Tipo de Chave:</label>
                            <div class="col-sm-10">
                                <select id="type"  class="form-control m-b" name="type_id">
                                        <option value="" id="types" selected></option>
                                    @foreach($types as $t)
                                        <option value="{{$t->id }}">{{$t->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <svg id="barcode" class="barcode">
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


    <!--Modal Gerar Cartão OK-->
    <div class="modal inmodal fade" id="key-card" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><i class="fa fa-credit-card"></i> Gerar Cartão</h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="col-sm-6">
                                    <img class="barcode" id="barcode">
                                </div>
                                <div class="col-sm-6">

                                    <div class="info">
                                        <h3>Chave: <span id="key"></span></h3>
                                        <h3>Setor: <span id="sector"></span></h3>
                                        <h3>Tipo: <span id="type"></span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="modal-footer" style="margin-top :10px">
                        <a class="btn btn-success"style="margin-top: 10px;" id="make-card"><i class="fa
                        fa-download"></i> Salvar Cartão
                            Gerado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Encerra Modal-->
@endsection
@push('scripts')
    <script type="text/javascript">
        /*
        * Pega as informações do servidor e manda pro modal de cartão
        * gerando o cartão
        */
        $("#key-card").on('show.bs.modal',function(event) {
            var button = $(event.relatedTarget);
            var name = button.data('name');
            var sector = button.data('sector');
            var type = button.data('type');
            var barcode = button.data('barcode');
            JsBarcode("#barcode", barcode, {
                format: "CODE128",
                height: 85,
                textPosition: "bottom",
                fontSize: 15,
                marginTop: 15

            });
            var modal = $(this);
            modal.find('.info #key').html(name);
            modal.find('.info #sector').html(sector);
            modal.find('.info #type').html(type);
        });
        /*
        Gera Cartão em Jpeg
        */
        $('#make-card').on('click', function(){
            html2canvas($(".card"), {
                onrendered: function(canvas) {
                    // document.body.appendChild(canvas);
                    return Canvas2Image.saveAsJPEG(canvas);
                }
            });
        });

        $("#edit-key").on('show.bs.modal',function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var barcode = button.data('barcode');

            var sector_id =button.data('sector-id');
            var sector = button.data('sector');

            var type_id =button.data('type-id');
            var type = button.data('type');

            JsBarcode("#barcode", barcode, {
                format: "CODE128",
                height: 85,
                textPosition: "bottom",
                fontSize: 15,
                marginTop: 15

            });
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #bar-code').val(barcode);
            //Setor
            modal.find('.modal-body #sector option:selected').val(sector_id);
            modal.find('.modal-body #sectors option:selected').text(sector);
            //Tipos
            modal.find('.modal-body #type option:selected').val(type_id);
            modal.find('.modal-body #types option:selected').text(type);
        });

        $(".delete-key").on('click', function(event){
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
                            url: "{{url('/chaves/delete')}}",
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