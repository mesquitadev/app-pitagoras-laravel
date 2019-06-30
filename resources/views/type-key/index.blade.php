@extends('layouts.app')
@section('title', 'Chaves Cadastradas')

@section('content')
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Tipo</th>
                <th>Data Criação</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @forelse($types as $t)
                <tr>
                    <td>{{$t->id}}</td>
                    <td>{{$t->name}}</td>
                    <td>{{\Carbon\Carbon::parse($t->created_at )->format('d/m/Y  H:i:s') }}</td>
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
                    <td>Sem items Cadastrados.</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
        </table>

    </div>

@endsection