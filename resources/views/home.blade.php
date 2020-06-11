@extends('layouts.app')
@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">
        Panel del Administrador
    </li>
  </ol>
</nav>
@endsection
@section('content')

    <div class="container mt-2">
        <admin
            :user="{{$user}}"
            :users="{{$users}}">
        </admin>
    </div>

@endsection