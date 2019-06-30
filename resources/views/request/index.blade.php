@extends('layouts.app')
@section('title', 'Solicitar Chave')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-10">
            <h2>Solicitar Chave</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li>
                    <a href="{{route('key.index')}}">Chaves</a>
                </li>
                <li class="active">
                    <strong>Solicitar</strong>
                </li>
            </ol>
        </div>

    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Solicitar Chave</h5>
                                </div>
                                <div class="ibox-content">
                                    <form action="{{route('request.store')}}" class="forrm-horizontal" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="cpf" class="control-label">CPF do Solicitante:</label>
                                                <input type="text" name="cpf" class="form-control" id="cpf" placeholder="Digite o Cpf do solicitante">
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <div class="col-xs-6">
                                                    <label for="inputEmail3" class="control-label">Usuário:</label>
                                                    <input type="text" name="username" class="form-control" id="username"readonly>
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="inputEmail3" class="control-label"> Telefone:</label>
                                                    <input type="text" class="form-control" name="phone" id="phone"
                                                           readonly>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="inputEmail3" class="control-label">Código da Chave:</label>
                                                <input type="number" name="barcode" class="form-control" id="barcode" placeholder="Digite o código da chave">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <div class="col-xs-6">
                                                    <label for="inputEmail3" class="control-label"> Chave:</label>
                                                    <input type="text" class="form-control" name="key" id="key"
                                                           readonly>
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="inputEmail3" class="control-label"> Tipo de
                                                        Chave:</label>
                                                    <input type="text" class="form-control" name="type" id="type"
                                                           readonly>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6">

                                            </div>

                                            <div class="form-group col-sm-6">
                                                <div class="col-xs-6">
                                                    <label for="inputEmail3" class="control-label">Serviço a ser Realizado:</label>
                                                    <input type="text" class="form-control" name="service" required>
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="inputEmail3" class="control-label">Empresa:</label>
                                                    <input type="text" class="form-control" name="company" required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6">

                                            </div>

                                            <div class="form-group col-sm-6">
                                                <div class="col-xs-6">
                                                    <label for="inputEmail3" class="control-label">Gestor:</label>
                                                    <input type="text" class="form-control" name="manager" required>
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="inputEmail3" class="control-label">Portaria:</label>
                                                    <input type="text" class="form-control" name="concierge"
                                                           value="{{auth()->user()->name}}" readonly>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="hr-line-dashed"></div>

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="col-sm-offset-2 pull-right">
                                                    <button id="btn-acessar" type="submit" class="btn btn-success">Solicitar</button>
                                                </div>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection

@push('scripts')
    <script>



        /*
         Busca de Dados do Banco com o retorno em ajax
        */
        $(document).ready(function() {

            $('#telefone').mask("(00)00000-0000", {placeholder: "(00)00000-0000"});
            $('#cpf').mask("000.000.000-00", {placeholder: "000.000.000-00"});

            $("#barcode").blur(function(){
                var barcode = $(this).val().replace(/\D/g, '');
                if(barcode !== ""){
                    var validator = /^[0-9]{12}$/;

                    if(validator.test(barcode)){
                        //Preenche os campos com "..." até achar os dados
                        $("#nome").val("Buscando...");
                        $("#type").val("Buscando...");

                        $.ajax({
                            url: "{{url('/chaves/info/')}}/"+barcode,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data){
                                if(data.error){
                                    swal(
                                        data.title,
                                        data.message,
                                        data.status
                                    );
                                    setTimeout(function(){ location.reload(); }, 3000);
                                } else {
                                    $('#key').val(data['data'][0].name);
                                    $('#type').val(data['data'][0].type);
                                }

                            }
                        });

                    } else {
                        swal("Erro!", "Código de barras inválido", "warning");
                        setTimeout(function(){ location.reload(); }, 2000);
                    }
                }
            });

            $("#cpf").blur(function(){
                var cpf = $(this).val().replace(/\D/g, '');
                if(cpf !== ""){
                    var validator = /^([0-9]){3}([0-9]){3}([0-9]){3}([0-9]){2}$/;

                    if(validator.test(cpf)){
                        //Preenche os campos com "..." até achar os dados
                        $("#user_nome").val("Buscando...");
                        $("#telefone").val("Buscando...");

                        //Instância do AJAX
                        $.ajax({
                            url: "{{url('/solicitantes/info/')}}/"+cpf,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data){
                                if(data.error === true){
                                    swal(
                                        data.title,
                                        data.message,
                                        data.status
                                    );
                                    setTimeout(function(){ location.reload(); }, 2000);
                                } else {
                                    console.log(data)
                                    $('#username').val(data['data'][0].name);
                                    $('#phone').val(data['data'][0].phone1);
                                }

                            }
                        });

                    } else {
                        swal("Erro!", "CPF Inválido, Favor, verifique os dados inseridos", "warning");
                        setTimeout(function(){ location.reload(); }, 2000);
                    }
                }
            })
        });


    </script>
@endpush