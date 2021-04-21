<x-app-layout>
    <x-slot name="header">
        <div style="display: flex;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="line-height: 42px; height: 42px; margin: 0px;">
                {{ __(' Superadmin Offers Table') }}
            </h2>

            <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex" style="margin-left: auto;">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    New
                </button>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin: 0;">
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
                                        <p style="color: red;"> @error('key') {{ $message }} @enderror </p>
                                    </div>

                                    <div class="mb-3">
                                        <label for="adds_text" class="form-label">Adds text</label>
                                        <input type="text" class="form-control" id="adds_text" name="adds_text" required>
                                        <p style="color: red;"> @error('adds_text') {{ $message }} @enderror </p>
                                    </div>

                                    <div class="mb-3">
                                        <label for="bid" class="form-label">Bid</label>
                                        <input type="number" class="form-control" id="bid" name="bid" required>
                                        <p style="color: red;"> @error('bid') {{ $message }} @enderror </p>
                                    </div>

                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Comment</label>
                                        <!-- <input type="date" class="form-control" id="account_login" name="account_login"> -->
                                        <textarea class="form-control" id="comment" name="comment" required></textarea>
                                        <p style="color: red;"> @error('comment') {{ $message }} @enderror </p>
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
                <div class="p-6 bg-white border-b border-gray-200" style="width: 100%; overflow-x: auto;">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" style="width: 15%;">Keys</th>
                                <th scope="col">Adds Text</th>
                                <th scope="col">Bid</th>
                                <th scope="col" style="max-width: 15%;">Comment</th>
                                <th scope="col" style="width: 15%;">Status</th>
                                <th scope="col" style="width: 17%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($offers as $key => $offer)
                                @if($offer->status == 'valid')
                                    <tr style="border-bottom: solid 4px #198754;">
                                @elseif($offer->status == 'work')
                                    <tr style="border-bottom: solid 4px #6C757D;">
                                @else <tr style="border-bottom: solid 4px #6C757D;">
                                @endif

                                        <td> {{ $offer->offer_id }} </td>
                                        <td> {{ $offer->key  }} </td>
                                        <td> {{ $offer->adds_text }} </td>
                                        <td> {{ $offer->bid }} </td>
                                        <td> {{ $offer->comment }} </td>

                                        <td>
                                            <div style="display: flex; width: 100%; height: 100%;">
                                                <!-- Valid modal -->
                                                @if($offer->status == 'valid')
                                                    <button class="btn btn-outline-success" disabled>Valid</button>
                                                @else <button class="btn btn-outline-success" id="{{ $key + 1 }}" onclick="modalSupValid(this.id)">Valid</button>
                                                @endif

                                                <div id="myModalSupValid{{ $key + 1 }}" class="modalnew">
                                                    <div class="modal-contentnew" style="margin-top: 10%;">
                                                        <div class="modal-header" style="width: 100% !important;">
                                                            <h5 class="modal-title">Change status</h5>
                                                            <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeSupValidModalX(this.id)"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                        <p style="font-size: 24px;">Are you sure you want to change status (valid)? </p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <form action="{{ route('dashboard.offerStatus', $offer->offer_id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PUT">
                                                                @method('PUT')

                                                                <div>
                                                                    <input type="hidden" class="form-control" id="status" name="status" value="valid">
                                                                </div>
                                                                <button type="submit" class="btn btn-outline-success">Valid</button>
                                                            </form>
                                                            <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeSupValidModal(this.id)">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Valid modal -->

                                                <!-- Work modal -->
                                                @if($offer->status == 'work')
                                                    <button class="btn btn-outline-secondary ml-2" disabled>Work</button>
                                                @else <button class="btn btn-outline-secondary ml-2" id="{{ $key + 1 }}" onclick="modalSupWork(this.id)">Work</button>
                                                @endif

                                                <div id="myModalSupWork{{ $key + 1 }}" class="modalnew">
                                                    <div class="modal-contentnew" style="margin-top: 10%;">
                                                        <div class="modal-header" style="width: 100% !important;">
                                                            <h5 class="modal-title">Change status</h5>
                                                            <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeSupWorkModalX(this.id)"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                        <p style="font-size: 24px;">Are you sure you want to change status (work)? </p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <form action="{{ route('dashboard.offerStatus', $offer->offer_id) }}" method="POST" class="ml-2">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PUT">
                                                                @method('PUT')

                                                                <div>
                                                                    <input type="hidden" class="form-control" id="status" name="status" value="work">
                                                                </div>
                                                                <button type="submit" class="btn btn-outline-secondary">Work</button>
                                                            </form>
                                                            <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeSupWorkModal(this.id)">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Delete modal -->
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; width: 100%; height: 100%;">

                                                <!-- Delete modal -->
                                                <button class="btn btn-outline-danger ml-1" id="{{ $key + 1 }}" onclick="modalSupDelete(this.id)">Delete</button>
                                                    
                                                <div id="myModalSupDelete{{ $key + 1 }}" class="modalnew">
                                                    <div class="modal-contentnew" style="margin-top: 10%;">
                                                        <div class="modal-header" style="width: 100% !important;">
                                                            <h5 class="modal-title" style="color: red;">Delete Offer</h5>
                                                            <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeSupDeleteModalX(this.id)"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                        <p style="font-size: 24px;">Are you sure you want to delete offer? </p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <form action="{{ route('dashboard.offerDestroy', $offer->offer_id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-outline-danger">Delete</button>
                                                            </form>
                                                            <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeSupDeleteModal(this.id)">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Delete modal -->

                                                <button class="btn btn-outline-info ml-2" id="{{ $key + 1 }}" onclick="modal(this.id)">Edit</button>

                                                <!-- The Modal -->
                                                <div id="myModal{{ $key + 1 }}" class="modalnew">

                                                    <!-- Modal content -->
                                                    <div class="modal-contentnew">
                                                        <div class="modal-header" style="width: 100% !important;">
                                                            <h5 class="modal-title">Edit Offer</h5>
                                                            <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeModalO(this.id)"></button>
                                                        </div>
                                                        
                                                        <form action="{{ route('dashboard.offerEdit', $offer->offer_id) }}" method="POST" style="margin: 20px;">  
                                                            @csrf
                                                            <input type="hidden" name="_method" value="PUT">
                                                            @method('PATCH')

                                                            <div class="mb-3 mt-2">
                                                                <label for="key" class="form-label">Key</label>
                                                                <input type="text" class="form-control" id="key" name="key" value="{{ $offer->key }}" required>
                                                                <p style="color: red;"> @error('key') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="adds_text" class="form-label">Adds text</label>
                                                                <input type="text" class="form-control" id="adds_text" name="adds_text" value="{{ $offer->adds_text }}" required>
                                                                <p style="color: red;"> @error('adds_text') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="bid" class="form-label">Bid</label>
                                                                <input type="number" class="form-control" id="bid" name="bid" value="{{ $offer->bid }}" required>
                                                                <p style="color: red;"> @error('bid') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="comment" class="form-label">Comment</label>
                                                                <textarea class="form-control" id="comment" name="comment" required>{{ $offer->comment }}</textarea>
                                                                <p style="color: red;"> @error('comment') {{ $message }} @enderror </p>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
