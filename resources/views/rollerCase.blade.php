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
                            <div style="display: flex; position: relative;" class="mb-3">
                                <form action="{{ route('dashboard.rows') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                        <label class="pagination_labbel mr-2" for="Pages" class="rows-label" style="line-height: 38px !important;">Show </label>
                                        <select id="pages" class="form-select" name="pages" onchange="this.form.submit()" style="width: 80px; height: 40px;">
                                            <option class="testtest" value="{{ $paginate_row }}" selected>{{ $paginate_row }}</option>
                                            <option value="5">5</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="70">70</option>
                                            <option value="100">100</option>
                                        </select>
                                        <label class="pagination_labbel ml-2" for="Pages" class="rows-label mr-4" style="line-height: 38px !important;">Entries</label>
                                    
                                </form>
                                <div class="search_div" style="max-width: 300px; display: flex; position: absolute; right: 0;">
                                    <form action="{{ route('dashboard.cases') }}" method="GET">
                                        @csrf
                                        <input type="text" id="case_search" name="case_search" class="form-control" style="height: 40px;" placeholder="{{ $search_item_text }}">
                                        <button class="btn btn-outline-secondary ml-2" type="submit" id="button-addon2" style="height: 40px;">Search</button>
                                    </form>
                                </div>
                            </div>
                            @foreach($accountOffers as $key => $accountOffer)
                                @if($accountOffer->status == "work")                
                                    <tr style="border-bottom: solid 20px #198754;" >
                                @elseif($accountOffer->status == "review")
                                    <tr style="border-bottom: solid 20px #FFC107;">
                                @elseif($accountOffer->status == "billing")
                                    <tr style="border-bottom: solid 20px #0D6EFD;">
                                @else <tr>
                                @endif
                                    <th scope="row"> {{ $key + 1 }} </th>

                                    <td style="width: 190px;">
                                        {{ $accountOffer->account }}
                                    </td>
                                    @foreach($accounts as $account)
                                        @if($account->id == $accountOffer->account_id)
                                            <td>
                                                <pre>User ID: <b>{{ $account->user_created_id }}</b> <br>Country: <b>{{ $account->country_code }}</b> <br>State: <b>{{ $account->state }}</b> <br>city: <b>{{ $account->city }}</b> <br>Zip: <b>{{ $account->zip }}</b> <br>Account Login: <b>{{ $account->account_login }}</b> <br>Account PWD: <b>{{ $account->account_pwd }}</b> <br>SSH LOGIN: <b>@if($account->ssh_login) {{ $account->ssh_login }} @else null @endif</b> <br>SSH PWD: <b>@if($account->ssh_pwd) {{ $account->ssh_pwd }} @else null @endif</b> <br>SSH IP: <b>@if($account->ssh_ip) {{ $account->ssh_ip }} @else null @endif</b> <br>SSH PORT: <b>@if($account->ssh_port) {{ $account->ssh_port }} @else null @endif</b><br>ACCOUNT READY DATE: <b>{{ $account->company_created_date }}</b></pre>
                                                <div style="width: 250px; font-size: .875em;">
                                                    <p> Coment: <b>{{ $account->comment }}</b> </p>
                                                </div>
                                            </td>
                                            @break
                                        @endif
                                    @endforeach
                                    
                                    <td style="max-width: 200px;">
                                        <pre>
                                            {{ $accountOffer->offer }}
                                        </pre>
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
                                            <button type="button" class="btn btn-outline-success ml-1" style="width: 90px;" data-bs-toggle="modal" data-bs-target="#caseWorkModal{{$key}}">
                                                Work
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="caseWorkModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Change ststus</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p style="font-size: 24px;">Are you sure you want to change ststus (Work)? </p>
                                                            <form action="{{ route('dashboard.status', $accountOffer->accountoffer_id) }}" id="case_work_form{{$key}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                @method('PATCH')

                                                                <div>
                                                                    <input type="hidden" class="form-control" id="status" name="status" value="work">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-outline-success" style="width: 90px;" form="case_work_form{{$key}}">Work</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Work modal -->

                                            <!-- Review modal -->
                                            <button type="button" class="btn btn-outline-warning ml-1" style="width: 90px;" data-bs-toggle="modal" data-bs-target="#caseReviewModal{{$key}}">
                                                Review
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="caseReviewModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Change ststus</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p style="font-size: 24px;">Are you sure you want to change ststus (Rewiew)? </p>
                                                            <form action="{{ route('dashboard.status', $accountOffer->accountoffer_id) }}" id="case_review_form{{$key}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                @method('PATCH')

                                                                <div>
                                                                    <input type="hidden" class="form-control" id="status" name="status" value="review">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="sumbit" class="btn btn-outline-warning ml-1" style="width: 90px;" form="case_review_form{{$key}}">Review</button> <br>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Review modal -->
                                        </div>

                                        <div style="width: 100%; display: flex;" >

                                            <!-- Billing modal -->
                                            <button type="button" class="btn btn-outline-primary mt-2 ml-1" style="width: 90px;" data-bs-toggle="modal" data-bs-target="#caseBillingModal{{$key}}">
                                                Billing
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="caseBillingModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Change ststus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="font-size: 24px;">Are you sure you want to change ststus (Billing)? </p>
                                                    <form action="{{ route('dashboard.status', $accountOffer->accountoffer_id) }}" id="case_billing_form{{$key}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PATCH">
                                                        @method('PATCH')

                                                        <div>
                                                            <input type="hidden" class="form-control" id="status" name="status" value="billing">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-outline-primary mr-1" style="width: 90px;" form="case_billing_form{{$key}}">Billing</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- End Billing modal -->

                                            <!-- Suspend modal -->
                                            <button type="button" class="btn btn-outline-danger mt-2 ml-1"  style="width: 90px;" data-bs-toggle="modal" data-bs-target="#caseSuspendModal{{$key}}">
                                                Suspend
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="caseSuspendModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suspend</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="font-size: 24px;">Are you sure you want to suspend account?</p>
                                                    <form action="{{ route('dashboard.suspend', $accountOffer->accountoffer_id) }}" id="case_suspend_form{{$key}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        @method('PUT')

                                                        <div>
                                                            <input type="hidden" class="form-control" id="status" name="status" value="suspend">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-outline-danger" form="case_suspend_form{{$key}}">Suspend</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- End Suspend modal -->
                                        </div>
                                        
                                    </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span> {{ $accountOffers->links() }} </span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
