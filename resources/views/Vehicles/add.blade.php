@extends('layouts.app')
@section('title')
Registro
@endsection

@section('content')
<add-vehicle user-id="{{ Auth::user()->id }}" />
@endsection