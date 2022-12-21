@extends('layouts.app')
@section('title')
Registro
@endsection

@section('content')
<add-maintenance user-id="{{ Auth::user()->id }}" />
@endsection