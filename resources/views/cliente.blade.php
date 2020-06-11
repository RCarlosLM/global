@extends('layouts.app')
@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">
        {{$user->name}} {{$user->lastname}}
    </li>
  </ol>
</nav>
@endsection
@section('content')

    <div class="container mt-2">
        <cliente
            :user="{{$user}}">
        </cliente>
    </div>
    
@endsection