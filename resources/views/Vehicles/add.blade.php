@extends('layouts.app')
@section('title')
Registro
@endsection

@section('content')
<Register-vehicle user-id="{{ Auth::user()->id }}" />
@endsection