@extends('layouts.app')
@section('title')
Edição
@endsection

@section('content')
<edit-vehicle car-id="{{ $id }}" />
@endsection