@extends('layouts.app')
@section('title')
Edição de Manutenção
@endsection

@section('content')
<edit-maintenance maintenance-id="{{ $id }}" user-id="{{ Auth::user()->id }}" />
@endsection