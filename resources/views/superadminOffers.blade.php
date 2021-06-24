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
                                        <!-- <input type="text" class="form-control" id="adds_text" name="adds_text" required> -->
                                        <textarea class="form-control" id="adds_text" name="adds_text" required></textarea>
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
                
                    <livewire:superadmin-offers />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
