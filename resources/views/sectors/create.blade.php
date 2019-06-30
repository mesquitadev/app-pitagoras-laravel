@extends('layouts.app')
@section('title', 'Cadastrar Chave')

@section('content')
    <form method="POST" action="{{ route('sector.store') }}">
        @csrf
        <label for="name">Chave</label>
        <input type="text" name="name">
        <button type="submit" >Salvar</button>
    </form>


@endsection