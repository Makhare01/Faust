<div>
    <table class="table account-table mt-3">
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
                <label class="pagination_labbel mr-2" for="Pages" class="rows-label" style="line-height: 38px !important;">Show </label>
                <select wire:change="changeRow($event.target.value)" id="pages" class="form-select" name="pages" style="width: 80px; height: 40px;">
                    <option class="testtest" value="{{ $paginate_row }}" selected>{{ $paginate_row }}</option>
                    <option value="5">5</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="70">70</option>
                    <option value="100">100</option>
                </select>
                <label class="pagination_labbel ml-2" for="Pages" class="rows-label mr-4" style="line-height: 38px !important;">Entries</label>

                <div class="search_div" style="max-width: 300px; display: flex; position: absolute; right: 0;">
                    <!-- <form wire:submit.prevent="searchFunc()">
                        <input wire:model="search" type="text" id="account_search" name="account_search" class="form-control" style="height: 40px;" placeholder="Search">
                        <button type='submit' class="btn btn-outline-secondary ml-2" id="button-addon2" style="height: 40px;">Search</button>
                    </form> -->
                    <form action="{{ route('dashboard.accountsList') }}" method="GET">
                        @csrf
                        <input type="text" id="account_search" name="account_search" class="form-control" style="height: 40px;" placeholder="{{ $search_item_text }}">
                        <button class="btn btn-outline-secondary ml-2" type="submit" id="button-addon2" style="height: 40px;">Search</button>
                    </form>
                </div>
            </div>
                
            @foreach($auth_user_accounts as $key => $account)
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
                        <button type="button" class="btn btn-outline-success" style="margin-top: 35% !important; width: 100%;" data-bs-toggle="modal" data-bs-target="#exampleReadyModal{{$key}}">
                            Ready
                        </button>

                        <div class="modal fade" id="exampleReadyModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Change account status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        <!-- End Ready modal -->
                    </td>
                    <td>
                        <div style="width: 100%; height: 100%;">
                            <button type="button" class="btn btn-outline-danger" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#exampleDeleteModal{{$key}}">
                                Delete
                            </button>

                            <div class="modal fade" id="exampleDeleteModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Account</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Delete modal -->

                        <!-- Edit Modal -->
                        <button type="button" class="btn btn-outline-info mt-1" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#exampleEditModal{{$key}}">
                            Edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleEditModal{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="add-account-form{{$key}}" action="{{ route('dashboard.accountEdit', $account->id) }}" method="POST">
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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-primary" form="add-account-form{{$key}}">Update</button>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Modal -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <span> {{ $auth_user_accounts->links() }} </span>
</div>

