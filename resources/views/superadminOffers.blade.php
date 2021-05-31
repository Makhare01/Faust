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
                                <form action="/dashboard/offersList" method="POST" id="offer_new_form">
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
                                        <textarea class="form-control" id="comment" name="comment" ></textarea>
                                        <p style="color: red;"> @error('comment') {{ $message }} @enderror </p>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary" form="offer_new_form">Add</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
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
                            <div style="display: flex; position: relative;" class="mb-3">
                                <form action="{{ route('dashboard.changeRows') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <label class="pagination_labbel mr-2" for="Pages" class="rows-label" style="line-height: 38px !important;">Show </label>
                                    <select id="pages" class="form-select" name="pages" onchange="this.form.submit()" style="width: 80px; height: 40px;">
                                        <option value="{{ $paginate_row }}" selected>{{ $paginate_row }}</option>
                                        <option value="5">5</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="70">70</option>
                                        <option value="100">100</option>
                                    </select>
                                    <label class="pagination_labbel ml-2" for="Pages" class="rows-label mr-4" style="line-height: 38px !important;">Entries</label>
                                </form>
                                <div class="search_div" style="max-width: 300px; display: flex; position: absolute; right: 0;">
                                    <form action="{{ route('dashboard.offersList') }}" method="GET">
                                        @csrf
                                        <input type="text" id="offer_search" name="offer_search" class="form-control" style="height: 40px;" placeholder="{{ $search_item_text }}">
                                        <button class="btn btn-outline-secondary ml-2" type="submit" id="button-addon2" style="height: 40px;">Search</button>
                                    </form>
                                </div>
                            </div>
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
                                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#offerValidModal{{$key}}" disabled>  Valid </button>
                                                @else <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#offerValidModal{{$key}}">  Valid </button>
                                                @endif
                                                

                                                <!-- Modal -->
                                                <div class="modal fade" id="offerValidModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Change status</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Valid modal -->

                                                <!-- Work modal -->
                                                @if($offer->status == 'work')
                                                    <button type="button" class="btn btn-outline-secondary ml-2" data-bs-toggle="modal" data-bs-target="#offerWorkModal{{$key}}" disabled> Work </button>
                                                @else <button type="button" class="btn btn-outline-secondary ml-2" data-bs-toggle="modal" data-bs-target="#offerWorkModal{{$key}}"> Work </button>
                                                @endif                                                

                                                <!-- Modal -->
                                                <div class="modal fade" id="offerWorkModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Change status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <!-- End Delete modal -->
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; width: 100%; height: 100%;">

                                                <!-- Delete modal -->
                                                <button type="button" class="btn btn-outline-danger ml-1" data-bs-toggle="modal" data-bs-target="#offerDeleteModal{{$key}}">
                                                    Delete
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="offerDeleteModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Offer</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Delete modal -->

                                                <!-- Edit Modal -->
                                                <button type="button" class="btn btn-outline-info ml-2" data-bs-toggle="modal" data-bs-target="#offerEditModal{{$key}}">
                                                    Edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="offerEditModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Offer</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('dashboard.offerEdit', $offer->offer_id) }}" method="POST" id="offer_edit_form{{$key}}"> 
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
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-outline-primary" form="offer_edit_form{{$key}}">Update</button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span> {{ $offers->links() }} </span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
