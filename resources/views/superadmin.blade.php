<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard For Superadmin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>ID: <b> {{ Auth::user()->id }} </b> </p>
                    <p>First Name: <b> {{ Auth::user()->first_name }} </b> </p>
                    <p>Last Name: <b> {{ Auth::user()->last_name }} </b> </p>
                    <p>Name: <b> {{ Auth::user()->name }} </b> </p>
                    <p>Role: <b> {{ Auth::user()->role_id }} </b> </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
