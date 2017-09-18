@extends('site.templates.template1')

@section('content')
  <h1>Home Page do Site!</h1>
  {{$var1 or 'Nao Existe'}}
  {!!$xss!!}
  @if($var1 == '1234')
  <p>É igual</p>
  @else
  <p>É diferente</p>
  @endif

  @unless(@$ar == 1234)
  <p>NÃO É IGUAL... unless</p>
  @endunless

  @for($i = 0; $i < 10; $i++)
    <p>For: {{$i}}</p>
  @endfor

{{--
  @if( count($arrayData) > 0)
    @foreach($arrayData as $array)
      <p>Foreach: {{$array}}</p>
    @endforeach
    @else
      <p>Não exixte itens para serem impressos</p>
    @endif
--}}
  @forelse($arrayData as $array)
    <p>Forelse: {{$array}}</p>
  @empty
    <p>Não existe itens para serem impressos</p>
  @endforelse

@php

@endphp

@include('site.includes.sidebar')
@endsection
