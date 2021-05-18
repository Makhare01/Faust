<x-app-layout>
    <x-slot name="header">
        <div style="display: flex;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="line-height: 42px; height: 42px; margin: 0px;">
                {{ __('All user') }}
            </h2>

            <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex" style="margin-left: auto;">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ route('register') }}" id="add_user_form">
                                @csrf

                                <!-- First Name -->
                                <div class="mt-4">
                                    <x-label for="first_name" :value="__('First name')" />

                                    <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
                                </div>

                                <!-- Last Name -->
                                <div class="mt-4">
                                    <x-label for="last_name" :value="__('Last name')" />

                                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
                                </div>

                                <!-- Name -->
                                <div class="mt-4">
                                    <x-label for="name" :value="__('Name')" />

                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                </div>

                                <!-- Select Option Rol type -->
                                <div class="mt-4">
                                    <x-label for="role_id" value="{{ __('Role') }}" />
                                    <select name="role_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                        <option value="registrar">registrar</option>
                                        <option value="superadmin">superadmin</option>
                                        <option value="roller">roller</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>

                                <!-- Email Address
                                <div class="mt-4">
                                    <x-label for="email" :value="__('Email')" />

                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                </div> -->

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-label for="password" :value="__('Password')" />

                                    <x-input id="password" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="new-password" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password_confirmation" required />
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-success" form="add_user_form">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="width: 100%; overflow-x: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">№</th>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <!-- <th scope="col">Initials</th> -->
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <th scope="row"> {{ $key + 1 }} </th>
                                    <td> {{ $user->id }} </td>
                                    <td> {{ $user->first_name }} </td>
                                    <td> {{ $user->last_name  }} </td>
                                    <!-- <td> {{ strtoupper($user->first_name[0]) }}{{ strtoupper($user->last_name[0])   }} </td> -->
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->role_id }} </td>
                                    <td>
                                        <div style="display: frex;">
                                            <!-- Delete modal -->
                                            @if($user->role_id == 'admin')
                                                <button type="button" class="btn btn-outline-danger ml-1" data-bs-toggle="modal" data-bs-target="#adminDeleteModal{{$key}}" disabled> Delete </button>
                                            @else <button type="button" class="btn btn-outline-danger ml-1" data-bs-toggle="modal" data-bs-target="#adminDeleteModal{{$key}}"> Delete </button>
                                            @endif
                                            <!-- Modal -->
                                            <div class="modal fade" id="adminDeleteModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="font-size: 24px;">Are you sure you want to delete offer? </p>
                                                    <form action="{{ route('dashboard.destroyUser', $user->id) }}" id="admin_delete_user_form{{$key}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-outline-danger" form="admin_delete_user_form{{$key}}">Delete</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- End Delete modal -->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
