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
                                <select style="pointer-events: none; background: #EFF1F3;" class="form-select" id="state" name="state" required>
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
                                <textarea class="form-control" id="comment" name="comment"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary" form="add-account-form">Add</button>
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
                    <livewire:registrar-table />
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
