@extends('layouts.app')

@section('title')
Manutenções
@endsection

@section('content')
<home-maintenance message="{{ session('message') }}" />
@endsection