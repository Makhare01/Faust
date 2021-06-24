<div>
    <table class="table mt-3">
        <thead>
            <tr>
                <th wire:click="sort()" scope="col" style="text-align: center; height: 50px; display: flex; cursor: pointer;">
                    ID
                    @if($sort == 'ASC')
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            width="8px" height="8px" viewBox="0 0 292.362 292.362" style="enable-background:new 0 0 292.362 292.362; margin-top: 3px; margin-left: 3px;"
                            xml:space="preserve">
                            <g>
                                <path d="M286.935,197.286L159.028,69.379c-3.613-3.617-7.895-5.424-12.847-5.424s-9.233,1.807-12.85,5.424L5.424,197.286
                                    C1.807,200.9,0,205.184,0,210.132s1.807,9.233,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428h255.813
                                    c4.949,0,9.233-1.811,12.848-5.428c3.613-3.613,5.427-7.898,5.427-12.847S290.548,200.9,286.935,197.286z"/>
                            </g>
                        </svg>
                    @else
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            width="8px" height="8px" viewBox="0 0 292.362 292.362" style="enable-background:new 0 0 292.362 292.362; margin-top: 3px; margin-left: 3px;"
                            xml:space="preserve">
                            <g>
                                <path d="M286.935,69.377c-3.614-3.617-7.898-5.424-12.848-5.424H18.274c-4.952,0-9.233,1.807-12.85,5.424
                                    C1.807,72.998,0,77.279,0,82.228c0,4.948,1.807,9.229,5.424,12.847l127.907,127.907c3.621,3.617,7.902,5.428,12.85,5.428
                                    s9.233-1.811,12.847-5.428L286.935,95.074c3.613-3.617,5.427-7.898,5.427-12.847C292.362,77.279,290.548,72.998,286.935,69.377z"/>
                            </g>
                        </svg>
                    @endif
                </th>
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
                    <tr style="border-bottom: solid 8px #198754;">
                @elseif($offer->status == 'work')
                    <tr style="border-bottom: solid 8px #6C757D;">
                @else <tr style="border-bottom: solid 8px #6C757D;">
                @endif

                        <td> {{ $offer->offer_id }} </td>
                        <td> {{ $offer->key  }} </td>
                        <td> <div style="max-width: 100$ !important;"> <pre class="adds_text_pre" style="font-size: 12pt;">{{ $offer->adds_text }} </pre> </div> </td>
                        <td> {{ $offer->bid }} </td>
                        <td> <pre style="font-size: 12pt;">{{ $offer->comment }} </pre> </td>

                        <td>
                            <div style="display: flex; width: 100%; height: 100%;">
                                <!-- Valid modal -->
                                @if($offer->status == 'valid')
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#offerValidModal{{$key}}" disabled>  Active </button>
                                @else <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#offerValidModal{{$key}}">  Active </button>
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
                                                <p style="font-size: 24px;">Are you sure you want to change status (Active)? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('dashboard.offerStatus', $offer->offer_id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PUT">
                                                    @method('PUT')

                                                    <div>
                                                        <input type="hidden" class="form-control" id="status" name="status" value="valid">
                                                    </div>
                                                    <button type="submit" class="btn btn-outline-success">Active</button>
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
                                    <button type="button" class="btn btn-outline-secondary ml-2" data-bs-toggle="modal" data-bs-target="#offerWorkModal{{$key}}" disabled> Inactive </button>
                                @else <button type="button" class="btn btn-outline-secondary ml-2" data-bs-toggle="modal" data-bs-target="#offerWorkModal{{$key}}"> Inactive </button>
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
                                        <p style="font-size: 24px;">Are you sure you want to change status (Inactive)? </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('dashboard.offerStatus', $offer->offer_id) }}" method="POST" class="ml-2">
                                            @csrf
                                            <input type="hidden" name="_method" value="PUT">
                                            @method('PUT')

                                            <div>
                                                <input type="hidden" class="form-control" id="status" name="status" value="work">
                                            </div>
                                            <button type="submit" class="btn btn-outline-secondary">Inactive</button>
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
                                                        <textarea class="form-control" id="adds_text" name="adds_text" value="{{ $offer->adds_text }}" required>{{ $offer->adds_text }}</textarea>
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
