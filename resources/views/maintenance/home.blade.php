@extends('layouts.app')

@section('title')
Manutenções
@endsection

@section('content')
<home-maintenance user-id="{{ Auth::user()->id }}" />
@endsection