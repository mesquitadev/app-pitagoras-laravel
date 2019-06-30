@extends('layouts.app')
@section('title', 'Cadastrar Tipo de Chave')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('type-key.store') }}">
            @csrf
            <label for="name">Tipo de Chave</label>
            <input type="text" name="name"><br>


            <button type="submit" >Salvar</button>
        </form>
    </div>


@endsection