@extends('layouts.admin')

@block('content')
@stop @section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard Metrics</h1>
    <p class="text-sm text-gray-500">Real-time status overview of the platform metrics.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Mobile Users</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] }}</p>
    </div>
    
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Pending Approvals</p>
        <p class="text-3xl font-bold text-amber-600 mt-2">{{ $stats['pending_users'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Categories</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_categories'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Showcase Products</p>
        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_products'] }}</p>
    </div>
</div>
@endsection