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
                            <div class="modal-body">
                                <div class="rollerModalTables" style="display: flex;">
                                    <div class="rollerModalTablesDiv" style="width: 50%; max-height: 170px; overflow-y: scroll;" class="mr-1">
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
                                                @foreach($accounts as $key => $account)
                                                
                                                    @foreach($accountOffers as $accountOffer)
                                                        @if($accountOffer->account_id === $account->id)
                                                            <p style="display: none;"> {{ $index++ }} </p>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                        @if($index == 0)
                                                            <tr>
                                                        @endif
                                                        @if($index == 1)
                                                            <tr style="opacity: 0.5;">
                                                        @endif

                                                            @if($account->status == 'ready')
                                                                <th scope="row"> {{ $key + 1 }} </th>
                                                                <td id="accountId{{ $key + 1 }}" style="display: none;"> {{ $account->id }} </td>
                                                                <td id="account{{ $key + 1 }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Account ID: {{ $account->id }}, Account Number: {{ $account->account_number }}, Account Type: {{ $account->account_type }}, Country: {{ $account->country_code }}, State: {{ $account->state }}, User Id: {{ $account->user_created_id }}, Account PWD: {{ $account->account_pwd }}, SSH IP: {{ $account->ssh_ip }}, SSH PORT: {{ $account->ssh_port }}, SSH LOGIN: {{ $account->ssh_login }}, SSH PWD: {{ $account->ssh_pwd }}, City: {{ $account->city }}, Zip: {{ $account->zip }}, Status: {{ $account->status }}, Comment: {{ $account->comment }}">
                                                                    {{ $country[$key] }}-{{ $userShortNames[$key] }}-{{ $createdDates[$key] }}-{{ $account->account_number }}/{{ $account->account_type }}                                                                    
                                                                </td>
                                                                <td scope="row"> {{ $account->company_created_date }} </td>
                                                                <td clas="TD">
                                                                    @if($index == 0)
                                                                        <button id="{{ $key + 1 }}" type="button"  class="btn btn-outline-success" onclick="addAccount(this.id)" >
                                                                            Add
                                                                        </button>
                                                                    @endif
                                                                    @if($index == 1)
                                                                        <button id="{{ $key + 1 }}" type="button"  class="btn btn-outline-success" onclick="addAccount(this.id)" disabled>
                                                                            Add
                                                                        </button>
                                                                        <p style="display: none;"> {{ $index-- }} </p>
                                                                    @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="rollerModalTablesDiv1" style="width: 50%; max-height: 170px; overflow-y: scroll;" class="ml-1">
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
                                                @foreach($offers as $key => $offer)
                                                    @if($offer->status == 'valid')
                                                        <tr>
                                                            <th scope="row"> {{ $key + 1 }} </th>
                                                            <td id="offerId{{ $key + 1 }}" style="display: none;"> {{ $offer->offer_id }} </td>
                                                            <td id="offer{{ $key + 1 }}" data-toggle="tooltip" data-placement="left" title="Offer ID: {{ $offer->offer_id }}, Key: {{ $offer->key }}, Adds Text: {{ $offer->adds_text }}, Bid: {{ $offer->bid }}, Status: {{ $offer->status }}, Comment: {{ $offer->comment }}"> {{ $offer->adds_text }} </td>
                                                            <td>
                                                                <button id="{{ $key + 1 }}" type="button" class="btn btn-outline-success" onclick="addOffer(this.id)" >
                                                                    Add
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- <div class="mt-4"> -->
                                <form action="{{ route('dashboard.offers') }}" class="mt-4" method="POST">
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
                                                    <input id="choosenAccount" name="choosenAccount" type="text" style="border: none;" required>
                                                    <input type="hidden" id="account_id" name="account_id" style="border: none;" required>
                                                </td>
                                                <td>
                                                    <input id="choosenOffer" name="choosenOffer" type="text" style="border: none;" required>
                                                    <input type="hidden" id="offer_id" name="offer_id" style="border: none;" required>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-outline-success">OK</button>
                                </form>
                                <!-- </div> -->
                            </div>
                            <div class="modal-footer">
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 4%;">№</th>
                                <th scope="col" style="width: 250px; !important">Account</th>
                                <th scope="col" style="width: 20% !important;">Info</th>
                                <th scope="col" style="width: 15%;">Offer</th>
                                <th scope="col" style="width: 15% !important;">Info</th>
                                <th scope="col" style="width: 16%;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accountOffers as $key => $accountOffer)
                                @if($accountOffer->status != "suspend")
                                    @if($accountOffer->status == "work")                
                                        <tr style="border-bottom: solid 6px #6C757D;">
                                    @elseif($accountOffer->status == "review")
                                        <tr style="border-bottom: solid 6px #FFC107;">
                                    @elseif($accountOffer->status == "billing")
                                        <tr style="border-bottom: solid 6px #198754;">
                                    @elseif($accountOffer->status == "suspend")
                                        <tr style="border-bottom: solid 6px #DF4755;">
                                    @else <tr>
                                    @endif
                                        <th scope="row"> {{ $key + 1 }} </th>

                                        <td>
                                            {{ $accountOffer->account }}
                                        </td>
                                        @foreach($accounts as $account)
                                            @if($account->id == $accountOffer->account_id)
                                                <td>
                                                    <pre>User ID: <b>{{ $account->user_created_id }}</b> <br>Country: <b>{{ $account->country_code }}</b> <br>State: <b>{{ $account->state }}</b> <br>city: <b>{{ $account->city }}</b> <br>Zip: <b>{{ $account->zip }}</b> <br>Account Login: <b>{{ $account->account_login }}</b> <br>Account PWD: <b>{{ $account->account_pwd }}</b> <br>SSH LOGIN: <b>{{ $account->ssh_login }}</b> <br>SSH PWD: <b>{{ $account->ssh_pwd }}</b> <br>SSH IP: <b>{{ $account->ssh_ip }}</b> <br>SSH PORT: <b>{{ $account->ssh_port }}</b><br>ACCOUNT READY DATE: <b>{{ $account->company_created_date }}</b></pre>
                                                    <div style="width: 250px; font-size: .875em;">
                                                       <p> Coment: <b>{{ $account->comment }}</b> </p>
                                                    </div>
                                                </td>
                                                @break
                                            @endif
                                        @endforeach
                                        
                                        <td>
                                            {{ $accountOffer->offer }}
                                        </td>

                                        @foreach($offers as $offer)
                                            @if($offer->offer_id == $accountOffer->offer_id)
                                                <td>
                                                    <pre>Offer ID: <b>{{ $offer->offer_id }}</b> <br>Bid: <b>{{ $offer->bid }}</b></pre>
                                                    
                                                    <div style="width: 250px; font-size: .875em;">
                                                        <p>Adds Text: <b>{{ $offer->adds_text }}</b> </p>
                                                        <p>Key: <b>{{ $offer->key }}</b></p>
                                                       <p> Coment: <b>{{ $offer->comment }}</b> </p>
                                                    </div>
                                                </td>
                                                @break
                                            @endif
                                        @endforeach

                                        <td>
                                            <div style="width: 100%; display: flex;">
                                                <!-- Work modal -->
                                                <button class="btn btn-outline-secondary ml-1" style="width: 90px;" id="{{ $key + 1 }}" onclick="modalCaseWork(this.id)">Work</button>
                                                
                                                <div id="myModalCaseWork{{ $key + 1 }}" class="modalnew">
                                                    <div class="modal-contentnew" style="margin-top: 10%;">
                                                        <div class="modal-header" style="width: 100% !important;">
                                                            <h5 class="modal-title" style="color: grey;">Change ststus</h5>
                                                            <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeCaseWorkModalX(this.id)"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                        <p style="font-size: 24px;">Are you sure you want to change ststus (Work)? </p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <form action="{{ route('dashboard.status', $accountOffer->accountoffer_id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                @method('PATCH')

                                                                <div>
                                                                    <input type="hidden" class="form-control" id="status" name="status" value="work">
                                                                </div>
                                                                <button type="submit" class="btn btn-outline-secondary" style="width: 90px;">Work</button>
                                                            </form>
                                                            <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeCaseWorkModal(this.id)">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Work modal -->

                                                <!-- Billing modal -->
                                                <button class="btn btn-outline-warning ml-1" style="width: 90px;" id="{{ $key + 1 }}" onclick="modalReview(this.id)">Review</button>
                                                
                                                <div id="myModalReview{{ $key + 1 }}" class="modalnew">
                                                    <div class="modal-contentnew" style="margin-top: 10%;">
                                                        <div class="modal-header" style="width: 100% !important;">
                                                            <h5 class="modal-title" style="color: #FFCA2C;">Change ststus</h5>
                                                            <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeReviewModalX(this.id)"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                        <p style="font-size: 24px;">Are you sure you want to change ststus (Rewiew)? </p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <form action="{{ route('dashboard.status', $accountOffer->accountoffer_id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                @method('PATCH')

                                                                <div>
                                                                    <input type="hidden" class="form-control" id="status" name="status" value="review">
                                                                </div>
                                                                <button type="sumbit" class="btn btn-outline-warning ml-1" style="width: 90px;">Review</button> <br>
                                                            </form>
                                                            <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeReviewModal(this.id)">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Billing modal -->
                                            </div>

                                            <div style="width: 100%; display: flex;" >
                                                <!-- Billing modal -->
                                                <button class="btn btn-outline-success mt-2 ml-1" style="width: 90px;" id="{{ $key + 1 }}" onclick="modalBilling(this.id)">Billing</button>
                                                
                                                <div id="myModalBilling{{ $key + 1 }}" class="modalnew">
                                                    <div class="modal-contentnew" style="margin-top: 10%;">
                                                        <div class="modal-header" style="width: 100% !important;">
                                                            <h5 class="modal-title" style="color: green;">Change ststus</h5>
                                                            <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeBillingModalX(this.id)"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                        <p style="font-size: 24px;">Are you sure you want to change ststus (Billing)? </p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <form action="{{ route('dashboard.status', $accountOffer->accountoffer_id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                @method('PATCH')

                                                                <div>
                                                                    <input type="hidden" class="form-control" id="status" name="status" value="billing">
                                                                </div>
                                                                <button type="submit" class="btn btn-outline-success mr-1" style="width: 90px;">Billing</button>
                                                            </form>
                                                            <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeBillingModal(this.id)">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Billing modal -->

                                                <!-- Suspend modal -->
                                                <button class="btn btn-outline-danger mt-2 ml-1" style="width: 90px;" id="{{ $key + 1 }}" onclick="modalSuspend(this.id)">Suspend</button>
                                                
                                                <div id="myModalSuspend{{ $key + 1 }}" class="modalnew">
                                                    <div class="modal-contentnew" style="margin-top: 10%;">
                                                        <div class="modal-header" style="width: 100% !important;">
                                                            <h5 class="modal-title" style="color: red;">Suspend</h5>
                                                            <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeSuspendModalX(this.id)"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                        <p style="font-size: 24px;">Are you sure you want to suspend account?</p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <form action="{{ route('dashboard.suspend', $accountOffer->accountoffer_id) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PUT">
                                                                @method('PUT')

                                                                <div>
                                                                    <input type="hidden" class="form-control" id="status" name="status" value="suspend">
                                                                </div>
                                                                <button type="submit" class="btn btn-outline-danger">Suspend</button>
                                                            </form>
                                                            <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeSuspendModal(this.id)">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Suspend modal -->
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
