@extends('layouts.app')

@section('title')
Home Veículos
@endsection

@section('content')
<home-vehicle user-id="{{ Auth::user()->id }}" />
@endsection