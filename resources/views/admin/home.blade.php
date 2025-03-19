@extends('layouts.admin')

@section('header')
    Dashboard
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-medium text-gray-900">Welcome to Admin Dashboard</h3>
            <p class="mt-1 text-sm text-gray-600">
                You're logged in as an administrator.
            </p>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Statistics Card -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h4 class="text-lg font-medium text-gray-900">Total Admin</h4>
                <p class="mt-2 text-3xl font-bold text-gray-900">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="px-6 pb-6">
                <div>
                    <h1 class="text-lg font-medium text-gray-900">List Admin :</h1>
                    @foreach ($listadmin as $list)
                        <p class="text-base font-normal text-gray-900">{{ $list->name }}</p>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- More statistics cards can be added here -->
    </div>
@endsection 