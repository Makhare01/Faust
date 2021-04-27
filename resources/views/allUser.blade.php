<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All user') }}
        </h2>
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
                                            <button class="btn btn-outline-danger ml-1" id="{{ $key + 1 }}" onclick="modalUserDelete(this.id)">Delete</button>
                                                    
                                            <div id="myModalUserDelete{{ $key + 1 }}" class="modalnew">
                                                <div class="modal-contentnew" style="margin-top: 10%;">
                                                    <div class="modal-header" style="width: 100% !important;">
                                                        <h5 class="modal-title" style="color: red;">Delete Offer</h5>
                                                        <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeUserDeleteModalX(this.id)"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                    <p style="font-size: 24px;">Are you sure you want to delete offer? </p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <form action="{{ route('dashboard.destroyUser', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            @if($user->role_id == 'admin')
                                                                <button class="btn btn-outline-danger" disabled>Delete</button>
                                                            @else <button class="btn btn-outline-danger">Delete</button>
                                                            @endif
                                                        </form>
                                                        <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeUserDeleteModal(this.id)">Close</button>
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
