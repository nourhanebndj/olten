@extends('layouts.connected')
@section('title', 'Portefeuille | ' . config('app.name'))

@section('content')
    <div class="breadcrumb">
        <a href="#">Accueil</a>
        <span>></span>
        <span>Portefeuille</span>
    </div>
    
    <h1 class="page-title">Portefeuille</h1>

    <div>
        <div class="removed"></div>
        <div class="gains"></div>
    </div>
@endsection
