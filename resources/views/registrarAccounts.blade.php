<x-app-layout>
    <x-slot name="header">
        <div style="display: flex;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="line-height: 42px; height: 42px; margin: 0px;">
                {{ __(' Registrar Accounts Table') }}
            </h2>
            <!-- Create Account Form -->
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
                        <h5 class="modal-title" id="exampleModalLabel">Add New Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add offer -->
                        <form id="add-account-form" action="{{ route('dashboard.accountsListPost') }}" method="POST">
                            @csrf

                            <div class="mb-3 pb-2 new-checklist">
                                <div class="form-check form-check-inline" onclick="proxy()">
                                    <input class="form-check-input" id="proxy" type="radio" name="inlineRadioOptions" value="option1" checked>
                                    <label class="form-check-label" for="inlineRadio1">Proxy</label>
                                </div>
                                <div class="form-check form-check-inline" onclick="ssh()">
                                    <input class="form-check-input" id="ssh" type="radio" name="inlineRadioOptions" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">SSH</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="account_type" class="form-label">Account Type</label>
                                <select class="form-select" id="account_type" name="account_type" required>
                                    <option value="" selected disabled>Select Account Status</option>
                                    <option value="L">L</option>
                                    <option value="S">S</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="country_code" class="form-label">Country Code</label>
                                <select class="form-select" id="country_code" name="country_code" aria-label="Default select example" onchange='enableStateFunc()'>
                                    <option selected>Choose country</option>
                                    <option value='France'>France</option>
                                    <option value='Spain'>Spain</option>
                                    <option value='United States of America'>United States of America</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <select style="pointer-events: none; background: #EFF1F3;" class="form-select" id="state" name="state">
                                    <option selected value="N/A">N/A</option>
                                    @foreach($allStates as $state)
                                        <option value="{{$state}}">{{$state}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="account_login" class="form-label">Account Login</label>
                                <input type="text" class="form-control" id="account_login" name="account_login" required>
                                <p style="color: red;"> @error('account_login') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="account_pwd" class="form-label">Account PWD</label>
                                <input type="text" class="form-control" id="account_pwd" name="account_pwd" required>
                                <p style="color: red;"> @error('account_pwd') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="ssh_ip" class="form-label">SSH IP</label>
                                <input type="text" class="form-control" id="ssh_ip" name="ssh_ip" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$" value="" disabled  />
                                <p style="color: red;"> @error('ssh_ip') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="ssh_port" class="form-label">SSH PORT</label>
                                <input type="number" class="form-control" id="ssh_port" name="ssh_port" value="" disabled>
                                <p style="color: red;"> @error('ssh_port') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="ssh_login" class="form-label">SSH LOGIN</label>
                                <input type="text" class="form-control" id="ssh_login" name="ssh_login" value="" disabled>
                                <p style="color: red;"> @error('ssh_login') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="ssh_pwd" class="form-label">SSH PWD</label>
                                <input type="text" class="form-control" id="ssh_pwd" name="ssh_pwd" value="" disabled>
                                <p style="color: red;"> @error('ssh_pwd') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                                <p style="color: red;"> @error('city') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="number" class="form-control" id="zip" name="zip" required>
                                <p style="color: red;"> @error('zip') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <!-- <input type="date" class="form-control" id="account_login" name="account_login"> -->
                                <textarea class="form-control" id="comment" name="comment"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary" form="add-account-form">Add</button>
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
                    <table class="table account-table mt-3">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center">ID</th>
                                <th scope="col" style="text-align: center">Account</th>
                                <th scope="col" style="text-align: center">Account Login</th>
                                <th scope="col" style="text-align: center">Account PWD</th>
                                <th scope="col" style="text-align: center">SSH IP</th>
                                <th scope="col" style="text-align: center">SSH PORT</th>
                                <th scope="col" style="text-align: center">SSH LOGIN</th>
                                <th scope="col" style="text-align: center">SSH PWD</th>
                                <th scope="col" style="text-align: center">Country</th>
                                <th scope="col" style="text-align: center">State</th>
                                <th scope="col" style="text-align: center">City</th>
                                <th scope="col" style="text-align: center">Zip</th>
                                <th scope="col" style="text-align: center">Comment</th>

                                <th scope="col" style="text-align: center">Status</th>
                                <th scope="col" style="text-align: center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div style="display: flex; position: relative;">
                                
                                <form action="{{ route('dashboard.numberOfRows') }}" method="POST">
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
                                    <form action="{{ route('dashboard.accountsList') }}" method="GET">
                                        @csrf
                                            <input type="text" id="account_search" name="account_search" class="form-control" style="height: 40px;" placeholder="{{ $search_item_text }}">
                                            <button class="btn btn-outline-secondary ml-2" type="submit" id="button-addon2" style="height: 40px;">Search</button>
                                    </form>
                                </div>
                            </div>
                               
                            @foreach($auth_user_accounts as $key => $account)
                                <!-- @if($account->status == 'in progress') -->
                                    <tr>
                                        <td> {{ $account->id }} </td>
                                        <td>
                                            <div style="min-width: 90px !important">
                                                {{ $account->account_name }}
                                            </div>
                                        </td>
                                        <td> {{ $account->account_login }} </td>
                                        <td> {{ $account->account_pwd }} </td>
                                        <td> 
                                            @if($account->ssh_ip) {{ $account->ssh_ip}} 
                                            @else <i>null</i>
                                            @endif
                                        </td>
                                        <td> 
                                            @if($account->ssh_port) {{ $account->ssh_port}} 
                                            @else <i>null</i>
                                            @endif
                                        </td>
                                        <td> 
                                            @if($account->ssh_login) {{ $account->ssh_login}} 
                                            @else <i>null</i>
                                            @endif
                                        </td>
                                        <td>
                                            @if($account->ssh_pwd) {{ $account->ssh_pwd}} 
                                            @else <i>null</i>
                                            @endif
                                        </td>
                                        <td> {{ $account->country}} </td>
                                        <td> {{ $account->state}} </td>
                                        <td> {{ $account->city}} </td>
                                        <td> {{ $account->zip}} </td>
                                        <td> <div class="Comment"> {{ $account->comment }} </div> </td>
                                        <td>
                                            <!-- Ready modal -->
                                            <button class="btn btn-outline-success" style="margin-top: 35% !important;" id="{{ $key + 1 }}" onclick="modalReady(this.id)"  style="width: 100%;">Ready</button>
                                            
                                            <div id="myModalReady{{ $key + 1 }}" class="modalnew">
                                                <div class="modal-contentnew" style="margin-top: 10%;">
                                                    <div class="modal-header" style="width: 100% !important;">
                                                        <h5 class="modal-title" style="color: red;">Change account status</h5>
                                                        <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeReadyModalX(this.id)"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                    <p style="font-size: 24px;">Are you sure you want to change account status?</p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <form action="{{ route('dashboard.accountStatus', $account->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="PUT">
                                                            @method('PUT')
                                                            <button class="btn btn-outline-success">Ready</button>
                                                        </form>
                                                        <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeReadyModal(this.id)">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Ready modal -->
                                        </td>
                                        <td>
                                            <div style="width: 100%; max-width: 80px; height: 100%;">
                                            <!-- Delete modal -->
                                            <button class="btn btn-outline-danger" id="{{ $key + 1 }}" onclick="modalDelete(this.id)"  style="width: 100%;">Delete</button>
                                            
                                            <div id="myModalDelete{{ $key + 1 }}" class="modalnew">
                                                <div class="modal-contentnew" style="margin-top: 10%;">
                                                    <div class="modal-header" style="width: 100% !important;">
                                                        <h5 class="modal-title" style="color: red;">Delete Account</h5>
                                                        <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeDeleteModalX(this.id)"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                    <p style="font-size: 24px;">Are you sure you want to delete account?</p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <form action="{{ route('dashboard.accountDestroy', $account->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-outline-danger" style="width: 100%;">Delete</button>
                                                        </form>
                                                        <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeDeleteModal(this.id)">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Delete modal -->
                                            
                                            <button class="btn btn-outline-info mt-1" id="{{ $key + 1 }}" onclick="modalAccount(this.id)"  style="width: 100%;">Edit</button>

                                            <!-- The Modal -->
                                            <div id="myModalAc{{ $key + 1 }}" class="modalnew">

                                                <!-- Modal content -->
                                                <div class="modal-contentnew">
                                                    <div class="modal-header" style="width: 100% !important;">
                                                        <h5 class="modal-title">Edit Account</h5>
                                                        <button type="button" class="btn-close" id="{{ $key + 1 }}" onclick="closeAccountModal(this.id)"></button>
                                                    </div>
                                                    
                                                    <form id="add-account-form{{$key}}" action="{{ route('dashboard.accountEdit', $account->id) }}" method="POST" style="margin: 20px;">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        @method('PATCH')

                                                        <div class="mb-3 pb-2 new-checklist">
                                                            @if($account->ssh_ip == null)
                                                            <div class="form-check form-check-inline" onclick="editProxy({{$key}})">
                                                                <input class="form-check-input edit-label" id="edit_proxy{{$key}}" type="radio" name="inlineRadioOptions" value="option1" checked>
                                                                <label class="form-check-label edit-label" for="inlineRadio1">Proxy</label>
                                                            </div>
                                                            <div class="form-check form-check-inline" onclick="editSsh({{$key}})">
                                                                <input class="form-check-input edit-label" id="edit_ssh{{$key}}" type="radio" name="inlineRadioOptions" value="option2">
                                                                <label class="form-check-label edit-label" for="inlineRadio2">SSH</label>
                                                            </div>
                                                            @else
                                                            <div class="form-check form-check-inline" onclick="editProxy({{$key}})">
                                                                <input class="form-check-input edit-label" id="edit_proxy{{$key}}" type="radio" name="inlineRadioOptions" value="option1">
                                                                <label class="form-check-label edit-label" for="inlineRadio1">Proxy</label>
                                                            </div>
                                                            <div class="form-check form-check-inline" onclick="editSsh({{$key}})">
                                                                <input class="form-check-input edit-label" id="edit_ssh{{$key}}" type="radio" name="inlineRadioOptions" value="option2" checked>
                                                                <label class="form-check-label edit-label" for="inlineRadio2">SSH</label>
                                                            </div>
                                                            @endif
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="account_type" class="form-label edit-label">Account Type</label>
                                                            <select class="form-select" id="edit_account_type" name="account_type">
                                                                <!-- <option value="{{ $account->account_type }}">{{ $account->account_type }}</option>
                                                                <option value="L">L</option>
                                                                <option value="S">S</option> -->
                                                            @if($account->account_type == 'L')
                                                                <option value="{{ $account->account_type }}">{{ $account->account_type }}</option>
                                                                <option value="S">S</option>
                                                            @else
                                                                <option value="{{ $account->account_type }}">{{ $account->account_type }}</option>
                                                                <option value="L">L</option>
                                                            @endif
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="country_code" class="form-label edit-label">Country Code</label>
                                                            <select class="form-select" id="edit_country_code{{$key}}" name="country_code" onchange="enableEditStateFunc({{$key}})">
                                                                <option selected value="{{ $account->country_code }}">{{ $account->country_code }}</option>
                                                                <option value='France'>France</option>
                                                                <option value='Spain'>Spain</option>
                                                                <option value='United States of America'>United States of America</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="state" class="form-label edit-label">State</label>
                                                            @if($account->state == 'N/A')
                                                                <select style="pointer-events: none; background: #EFF1F3;" class="form-select" id="state{{ $key }}" name="state" aria-label="Default select example">
                                                            @else
                                                                <select class="form-select" id="state{{ $key }}" name="state" aria-label="Default select example">
                                                            @endif
                                                                <option selected id="selected{{$key}}" value="{{ $account->state }}">{{ $account->state }}</option>
                                                                @foreach($allStates as $state)
                                                                    <option value="{{$state}}">{{$state}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label for="account_login" class="form-label edit-label">Account Login</label>
                                                            <input type="text" class="form-control" id="edit_account_login" name="account_login" value="{{ $account->account_login }}" required>
                                                            <p style="color: red;"> @error('account_login') {{ $message }} @enderror </p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="account_pwd" class="form-label edit-label">Account PWD</label>
                                                            <input type="text" class="form-control" id="edit_account_pwd" name="account_pwd" value="{{ $account->account_pwd }}" required>
                                                            <p style="color: red;"> @error('account_pwd') {{ $message }} @enderror </p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="ssh_ip" class="form-label edit-label">SSH IP</label>
                                                            @if($account->ssh_ip == null) <input type="text" class="form-control" id="edit_ssh_ip{{$key}}" name="ssh_ip" value="{{ $account->ssh_ip }}" disabled>
                                                            @else <input type="text" class="form-control" id="edit_ssh_ip{{$key}}" name="ssh_ip" value="{{ $account->ssh_ip }}">
                                                            @endif
                                                            <p style="color: red;"> @error('ssh_ip') {{ $message }} @enderror </p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="ssh_port" class="form-label edit-label">SSH PORT</label>
                                                            @if($account->ssh_port == null) <input type="number" class="form-control" id="edit_ssh_port{{$key}}" name="ssh_port" value="{{ $account->ssh_port }}" disabled>
                                                            @else <input type="number" class="form-control" id="edit_ssh_port{{$key}}" name="ssh_port" value="{{ $account->ssh_port }}">
                                                            @endif
                                                            <p style="color: red;"> @error('ssh_port') {{ $message }} @enderror </p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="ssh_login" class="form-label edit-label">SSH LOGIN</label>
                                                            @if($account->ssh_login == null) <input type="text" class="form-control" id="edit_ssh_login{{$key}}" name="ssh_login" value="{{ $account->ssh_login }}" disabled>
                                                            @else <input type="text" class="form-control" id="edit_ssh_login{{$key}}" name="ssh_login" value="{{ $account->ssh_login }}">
                                                            @endif
                                                            <p style="color: red;"> @error('ssh_login') {{ $message }} @enderror </p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="ssh_pwd" class="form-label edit-label">SSH PWD</label>
                                                            @if($account->ssh_pwd == null) <input type="text" class="form-control" id="edit_ssh_pwd{{$key}}" name="ssh_pwd" value="{{ $account->ssh_pwd }}" disabled>
                                                            @else <input type="text" class="form-control" id="edit_ssh_pwd{{$key}}" name="ssh_pwd" value="{{ $account->ssh_pwd }}">
                                                            @endif
                                                            <p style="color: red;"> @error('ssh_pwd') {{ $message }} @enderror </p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="city" class="form-label edit-label">City</label>
                                                            <input type="text" class="form-control" id="edit_city" name="city" value="{{ $account->city }}" required>
                                                            <p style="color: red;"> @error('city') {{ $message }} @enderror </p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="zip" class="form-label edit-label">Zip</label>
                                                            <input type="text" class="form-control" id="edit_zip" name="zip" value="{{ $account->zip }}" required>
                                                            <p style="color: red;"> @error('zip') {{ $message }} @enderror </p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="comment" class="form-label edit-label">Comment</label>
                                                            <textarea class="form-control" id="edit_comment" name="comment"> {{ $account->comment }} </textarea>
                                                        </div>

                                                        <!-- <button type="submit" class="btn btn-primary">Update</button> -->
                                                    </form>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-outline-primary" form="add-account-form{{$key}}">Update</button>
                                                        <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeModal(this.id)">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                <!-- @endif -->
                            @endforeach
                        </tbody>
                    </table>
                    <span> {{ $auth_user_accounts->links() }} </span>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
