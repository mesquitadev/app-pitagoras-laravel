@extends('layouts.app')
@section('title', 'Setores')
@section('content')

    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Chave</th>
                <th>Codigo de Barras</th>
                <th>Data Criação</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($keys as $k)
                <tr>
                    <td>{{$k->id}}</td>
                    <td>{{$k->name}}</td>
                    <td>{{$k->barcode}}</td>
                    @if($k->status == 'D')
                        <td>Disponível</td>
                    @else
                        <td>Indisponível</td>
                    @endif
                    <td>{{$k->sector}}</td>
                    <td>{{\Carbon\Carbon::parse($k->created_at )->format('d/m/Y  H:i:s') }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="" class="btn btn-primary btn-sm">Editar</a>
                            <a href="" class="btn btn-info btn-sm">Visualizar</a>
                            <a href="" class="btn btn-danger btn-sm">Deletar</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

    </div>


@endsection
