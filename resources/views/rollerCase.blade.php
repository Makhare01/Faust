<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roller Cases') }}

            <div style="float: right;">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    New
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin: 0;">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="dropdown mt-2" style="margin-left: 55px; width: 190px;">
                                <select class="form-select" id="regar_select" aria-label="Default select example" onchange="initial_filter()">
                                    <option value="all" selected>All</option>
                                    @foreach($registrar_accounts as $registrar_account)
                                        <option id="{{ $registrar_account->id }}" onclick="initial_filter(this.id)" value="{{ $registrar_account->id }}"> {{ $registrar_account->initials }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-body">
                                <div class="rollerModalTables" style="display: flex;">
                                    <div class="rollerModalTablesDiv" style="width: 50%; max-height: 300px; overflow-y: scroll;" class="mr-1">
                                        <!-- Accounts Table -->
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" id="new">№</th>
                                                    <th scope="col">Account</th>
                                                    <th scope="col">Account ready date</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($accounts_ready as $key => $account)
                                                    @if($account->status == 'elected')
                                                    <tr style="opacity: 0.5;" class="account{{$account->user_created_id}} allCaseAccount">
                                                    @else
                                                    <tr class="account{{$account->user_created_id}} allCaseAccount">
                                                    @endif
                                                        <th scope="row"> {{ $key + 1 }} </th>
                                                        <td id="accountId{{ $key + 1 }}" style="display: none;"> {{ $account->id }} </td>
                                                        <td id="account{{ $key + 1 }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Account ID: {{ $account->id }}, Account Number: {{ $account->account_number }}, Account Type: {{ $account->account_type }}, Country: {{ $account->country_code }}, State: {{ $account->state }}, User Id: {{ $account->user_created_id }}, Account PWD: {{ $account->account_pwd }}, SSH IP: {{ $account->ssh_ip }}, SSH PORT: {{ $account->ssh_port }}, SSH LOGIN: {{ $account->ssh_login }}, SSH PWD: {{ $account->ssh_pwd }}, City: {{ $account->city }}, Zip: {{ $account->zip }}, Status: {{ $account->status }}, Comment: {{ $account->comment }}">
                                                            {{ $account->account_name }}
                                                        </td>
                                                        <td scope="row"> {{ $account->company_created_date }} </td>
                                                        <td clas="TD">
                                                            @if($account->status == 'elected')
                                                                <button id="{{ $key + 1 }}" type="button"  class="btn btn-outline-success" onclick="addAccount(this.id)" disabled >
                                                                    Add
                                                                </button>
                                                            @else
                                                                <button id="{{ $key + 1 }}" type="button"  class="btn btn-outline-success" onclick="addAccount(this.id)" >
                                                                    Add
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="rollerModalTablesDiv1" style="width: 50%; max-height: 300px; overflow-y: scroll;" class="ml-1">
                                        <!-- Offers Table -->
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">№</th>
                                                    <!-- <th scope="col">id</th> -->
                                                    <th scope="col">Offer</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($offers_valid as $key => $offer)
                                                    <tr>
                                                        <th scope="row"> {{ $key + 1 }} </th>
                                                        <td id="offerId{{ $key + 1 }}" style="display: none;">
                                                            <pre>
                                                                {{ $offer->offer_id }}
                                                            <pre>
                                                        </td>
                                                        <td id="offer{{ $key + 1 }}" data-toggle="tooltip" data-placement="left" title="Offer ID: {{ $offer->offer_id }}, Key: {{ $offer->key }}, Adds Text: {{ $offer->adds_text }}, Bid: {{ $offer->bid }}, Status: {{ $offer->status }}, Comment: {{ $offer->comment }}"> {{ $offer->adds_text }} </td>
                                                        <td>
                                                            <button id="{{ $key + 1 }}" type="button" class="btn btn-outline-success" onclick="addOffer(this.id)" >
                                                                Add
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <form action="{{ route('dashboard.createCase') }}" id="create_case_form" class="mt-4" method="POST">
                                    <h4 style="text-align: center;"> Case </h4>
                                    @csrf
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 50%;">Account</th>
                                                <th scope="col" style="width: 50%;">Offer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input id="choosenAccount" name="choosenAccount" type="text" style="border: none;" onkeypress="return false;" required>
                                                    <input type="hidden" id="account_id" name="account_id" style="border: none;" required>
                                                </td>
                                                <td>
                                                    <textarea id="choosenOffer" name="choosenOffer" type="text" style="border: none; width: 100%;" onkeypress="return false;" required></textarea>
                                                    <input type="hidden" id="offer_id" name="offer_id" style="border: none;" required>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success" form="create_case_form">OK</button>
                                <button type="button" class="btn btn-outline-secondary" onclick="Clear()">Clear</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="width: 100%; overflow-x: auto;">
                    

                    <livewire:roller-table />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
