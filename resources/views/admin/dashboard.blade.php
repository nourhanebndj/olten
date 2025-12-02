@extends('admin.layouts.app')

@section('title', 'Tableau de bord')

@section('page-title', 'Tableau de bord')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="metric-card bg-white p-6 rounded-xl shadow-lg border-l-4 border-primary-light">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-primary-light uppercase">Total Utilisateurs</p>
                <p class="text-3xl font-extrabold text-gray-900 mt-1">1,254</p>
            </div>
            <i class="bi bi-people text-4xl text-gray-300"></i>
        </div>
        <a href="#" class="text-xs text-primary-light hover:underline mt-2 block">Voir la liste des utilisateurs</a>
    </div>
</div>

@endsection


