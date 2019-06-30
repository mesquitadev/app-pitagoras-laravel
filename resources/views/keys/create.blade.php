@extends('layouts.app')
@section('title', 'Cadastrar Chave')

@section('content')
   <div class="container">
       <form class="form-inline" method="POST" action="{{ route('key.store') }}">
           @csrf
           <label for="name">Chave</label>
           <input type="text" name="name"><br>
           <label for="barcode">Código de Barras</label>
           <input type="text" name="barcode" value="{{date('dmYHi')}}" readonly><br>

           <select name="sector_id" required>
               <option value="Selecione Um Setor" selected>Selecione um Setor</option>
               @foreach($sector as $s)
                   <option value="{{$s->id}}" >{{$s->name}}</option>
               @endforeach
           </select><br>


           <label for="type_id">Tipo de Chave</label>
           <select name="type_id" required>
               <option selected>Selecione um Tipo</option>
               @foreach($types as $t)
                   <option value="{{$t->id}}" >{{$t->name}}</option>
               @endforeach
           </select><br>

           <button type="submit" >Salvar</button>
       </form>
   </div>


@endsection