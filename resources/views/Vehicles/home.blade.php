@extends('layouts.app')

@section('title')
Home Veículos
@endsection

@section('content')
<home-vehicle message="{{ session('message') }}" />
@endsection