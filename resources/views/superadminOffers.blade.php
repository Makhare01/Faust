<x-app-layout>
    <x-slot name="header">
        <div style="display: flex;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="line-height: 42px; height: 42px; margin: 0px;">
                {{ __(' Superadmin Offers Table') }}
            </h2>

            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex" style="margin-left: auto;">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    New
                </button>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Offer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Add offer -->
                                <form action="/dashboard/offersList" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="key" class="form-label">Key</label>
                                        <input type="text" class="form-control" id="key" name="key" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="adds_text" class="form-label">Adds text</label>
                                        <input type="text" class="form-control" id="adds_text" name="adds_text" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="bid" class="form-label">Bid</label>
                                        <input type="number" class="form-control" id="bid" name="bid" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Comment</label>
                                        <!-- <input type="date" class="form-control" id="account_login" name="account_login"> -->
                                        <textarea class="form-control" id="comment" name="comment" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add</button>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- <button type="button" class="btn btn-outline-success">Save changes</button> -->
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
                <div class="p-6 bg-white border-b border-gray-200">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" style="width: 15%;">Keys</th>
                            <th scope="col">Adds Text</th>
                            <th scope="col">Bid</th>
                            <th scope="col">Comment</th>
                            <!-- <th scope="col">Date Created</th>
                            <th scope="col">Date Updated</th> -->
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($offers as $key => $offer)
                            @if($offer->status == 'in progress')
                                <tr>
                                    <td> {{ $offer->offer_id }} </td>
                                    <td> {{ $offer->key  }} </td>
                                    <td> {{ $offer->adds_text }} </td>
                                    <td> {{ $offer->bid }} </td>
                                    <td> {{ $offer->comment }} </td>

                                    <td>
                                        <form action="{{ route('dashboard.offerStatus', $offer->offer_id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="PUT">
                                            @method('PUT')
                                            <button class="btn btn-outline-success">Valid</button>
                                        </form>
                                    </td>
                                    <td>
                                        <div style="display: flex; width: 100%; height: 100%;">
                                            <form action="{{ route('dashboard.offerDestroy', $offer->offer_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger">Delete</button>
                                            </form>

                                            <button class="btn btn-outline-info ml-2" id="{{ $key + 1 }}" onclick="modal(this.id)">Edit</button>

                                            <!-- The Modal -->
                                            <div id="myModal{{ $key + 1 }}" class="modalnew">

                                                <!-- Modal content -->
                                                <div class="modal-contentnew">
                                                    <div class="modal-header" style="width: 100% !important;">
                                                        <h5 class="modal-title">Edit Offer</h5>
                                                        <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeModal(this.id)"></button>
                                                    </div>
                                                    
                                                    <form action="{{ route('dashboard.offerEdit', $offer->offer_id) }}" method="POST" style="margin: 20px;">  
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        @method('PATCH')

                                                        <div class="mb-3 mt-2">
                                                            <label for="key" class="form-label">Key</label>
                                                            <input type="text" class="form-control" id="key" name="key" value="{{ $offer->key }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="adds_text" class="form-label">Adds text</label>
                                                            <input type="text" class="form-control" id="adds_text" name="adds_text" value="{{ $offer->adds_text }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="bid" class="form-label">Bid</label>
                                                            <input type="number" class="form-control" id="bid" name="bid" value="{{ $offer->bid }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="comment" class="form-label">Comment</label>
                                                            <textarea class="form-control" id="comment" name="comment" required>{{ $offer->comment }}</textarea>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeM(this.id)">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
