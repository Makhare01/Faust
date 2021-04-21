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
                        <form action="{{ route('dashboard.accountsListPost') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="account_number" class="form-label">Account Number</label> <input type="checkbox" class="ml-3 mt-1" id="account_numbercheck" name="account_numbercheck" onclick="checkBox()">
                                <input style="pointer-events: none; background: #EFF1F3;" type="number" class="form-control" id="account_number" name="account_number" placeholder="automatically" value="automatically">
                                <p style="color: red;"> @error('account_number') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="account_type" class="form-label">Account Type</label>
                                <select class="form-select" id="account_type" name="account_type">
                                    <option value="Select Account Status">Select Account Status</option>
                                    <option value="L">L</option>
                                    <option value="S">S</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="country_code" class="form-label">Country Code</label>
                                <!-- <input type="text" class="form-control" id="country_code" name="country_code"> -->
                                <select class="form-select" id="country_code" name="country_code" aria-label="Default select example" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                    <option selected>Choose country</option>
                                    <option value='France'>France</option>
                                    <option value='Spain'>Spain</option>
                                    <option value='United States of America' onclick="enableState()">United States of America</option>
                                    <option value='Afghanistan'>Afghanistan</option><option value='Albania'>Albania</option><option value='Algeria'>Algeria</option><option value='American Samoa'>American Samoa</option><option value='Andorra'>Andorra</option><option value='Angola'>Angola</option><option value='Anguilla'>Anguilla</option><option value='Antarctica'>Antarctica</option><option value='Antigua and Barbuda'>Antigua and Barbuda</option><option value='Argentina'>Argentina</option><option value='Armenia'>Armenia</option><option value='Aruba'>Aruba</option><option value='Australia'>Australia</option><option value='Austria'>Austria</option><option value='Azerbaijan'>Azerbaijan</option><option value='Bahamas'>Bahamas</option><option value='Bahrain'>Bahrain</option><option value='Bangladesh'>Bangladesh</option><option value='Barbados'>Barbados</option><option value='Belarus'>Belarus</option><option value='Belgium'>Belgium</option><option value='Belize'>Belize</option><option value='Benin'>Benin</option><option value='Bermuda'>Bermuda</option><option value='Bhutan'>Bhutan</option><option value='Bolivia'>Bolivia</option><option value='Bonaire'>Bonaire</option><option value='Bosnia and Herzegovina'>Bosnia and Herzegovina</option><option value='Botswana'>Botswana</option><option value='Bouvet Island'>Bouvet Island</option><option value='Brazil'>Brazil</option><option value='British Indian Ocean Territory'>British Indian Ocean Territory</option><option value='Brunei Darussalam'>Brunei Darussalam</option><option value='Bulgaria'>Bulgaria</option><option value='Burkina Faso'>Burkina Faso</option><option value='Burundi'>Burundi</option><option value='Cabo Verde'>Cabo Verde</option><option value='Cambodia'>Cambodia</option><option value='Cameroon'>Cameroon</option><option value='Canada'>Canada</option><option value='Cayman Islands'>Cayman Islands</option><option value='Central African Republic'>Central African Republic</option><option value='Chad'>Chad</option><option value='Chile'>Chile</option><option value='China'>China</option><option value='Christmas Island'>Christmas Island</option><option value='Cocos (Keeling) Islands '>Cocos (Keeling) Islands </option><option value='Colombia'>Colombia</option><option value='Comoros'>Comoros</option><option value='Congo'>Congo</option><option value='Congo'>Congo</option><option value='Cook Islands'>Cook Islands</option><option value='Costa Rica'>Costa Rica</option><option value='Croatia'>Croatia</option><option value='Cuba'>Cuba</option><option value='Curaçao'>Curaçao</option><option value='Cyprus'>Cyprus</option><option value='Czechia'>Czechia</option><option value='Côte d'Ivoire'>Côte d'Ivoire</option><option value='Denmark'>Denmark</option><option value='Djibouti'>Djibouti</option><option value='Dominica'>Dominica</option><option value='Dominican Republic'>Dominican Republic</option><option value='Ecuador'>Ecuador</option><option value='Egypt'>Egypt</option><option value='El Salvador'>El Salvador</option><option value='Equatorial Guinea'>Equatorial Guinea</option><option value='Eritrea'>Eritrea</option><option value='Estonia'>Estonia</option><option value='Eswatini'>Eswatini</option><option value='Ethiopia'>Ethiopia</option><option value='Falkland Islands'>Falkland Islands</option><option value='Faroe Islands'>Faroe Islands</option><option value='Fiji'>Fiji</option><option value='Finland'>Finland</option><option value='French Guiana'>French Guiana</option><option value='French Polynesia'>French Polynesia</option><option value='French Southern Territories'>French Southern Territories</option><option value='Gabon'>Gabon</option><option value='Gambia'>Gambia</option><option value='Georgia'>Georgia</option><option value='Germany'>Germany</option><option value='Ghana'>Ghana</option><option value='Gibraltar'>Gibraltar</option><option value='Greece'>Greece</option><option value='Greenland'>Greenland</option><option value='Grenada'>Grenada</option><option value='Guadeloupe'>Guadeloupe</option><option value='Guam'>Guam</option><option value='Guatemala'>Guatemala</option><option value='Guernsey'>Guernsey</option><option value='Guinea'>Guinea</option><option value='Guinea-Bissau'>Guinea-Bissau</option><option value='Guyana'>Guyana</option><option value='Haiti'>Haiti</option><option value='Heard Island and McDonald Islands'>Heard Island and McDonald Islands</option><option value='Holy See'>Holy See</option><option value='Honduras'>Honduras</option><option value='Hong Kong'>Hong Kong</option><option value='Hungary'>Hungary</option><option value='Iceland'>Iceland</option><option value='India'>India</option><option value='Indonesia'>Indonesia</option><option value='Iran'>Iran</option><option value='Iraq'>Iraq</option><option value='Ireland'>Ireland</option><option value='Isle of Man'>Isle of Man</option><option value='Israel'>Israel</option><option value='Italy'>Italy</option><option value='Jamaica'>Jamaica</option><option value='Japan'>Japan</option><option value='Jersey'>Jersey</option><option value='Jordan'>Jordan</option><option value='Kazakhstan'>Kazakhstan</option><option value='Kenya'>Kenya</option><option value='Kiribati'>Kiribati</option><option value='Korea (the Democratic Peoples Republic of)'>Korea (the Democratic People's Republic of)</option><option value='Korea (the Republic of)'>Korea (the Republic of)</option><option value='Kuwait'>Kuwait</option><option value='Kyrgyzstan'>Kyrgyzstan</option><option value='Lao People's Democratic Republic'>Lao People's Democratic Republic</option><option value='Latvia'>Latvia</option><option value='Lebanon'>Lebanon</option><option value='Lesotho'>Lesotho</option><option value='Liberia'>Liberia</option><option value='Libya'>Libya</option><option value='Liechtenstein'>Liechtenstein</option><option value='Lithuania'>Lithuania</option><option value='Luxembourg'>Luxembourg</option><option value='Macao'>Macao</option><option value='Madagascar'>Madagascar</option><option value='Malawi'>Malawi</option><option value='Malaysia'>Malaysia</option><option value='Maldives'>Maldives</option><option value='Mali'>Mali</option><option value='Malta'>Malta</option><option value='Marshall Islands'>Marshall Islands</option><option value='Martinique'>Martinique</option><option value='Mauritania'>Mauritania</option><option value='Mauritius'>Mauritius</option><option value='Mayotte'>Mayotte</option><option value='Mexico'>Mexico</option><option value='Micronesia (Federated States of)'>Micronesia (Federated States of)</option><option value='Moldova (the Republic of)'>Moldova (the Republic of)</option><option value='Monaco'>Monaco</option><option value='Mongolia'>Mongolia</option><option value='Montenegro'>Montenegro</option><option value='Montserrat'>Montserrat</option><option value='Morocco'>Morocco</option><option value='Mozambique'>Mozambique</option><option value='Myanmar'>Myanmar</option><option value='Namibia'>Namibia</option><option value='Nauru'>Nauru</option><option value='Nepal'>Nepal</option><option value='Netherlands'>Netherlands</option><option value='New Caledonia'>New Caledonia</option><option value='New Zealand'>New Zealand</option><option value='Nicaragua'>Nicaragua</option><option value='Niger'>Niger</option><option value='Nigeria'>Nigeria</option><option value='Niue'>Niue</option><option value='Norfolk Island'>Norfolk Island</option><option value='Northern Mariana Islands'>Northern Mariana Islands</option><option value='Norway'>Norway</option><option value='Oman'>Oman</option><option value='Pakistan'>Pakistan</option><option value='Palau'>Palau</option><option value='Palestine'>Palestine</option><option value='Panama'>Panama</option><option value='Papua New Guinea'>Papua New Guinea</option><option value='Paraguay'>Paraguay</option><option value='Peru'>Peru</option><option value='Philippines'>Philippines</option><option value='Pitcairn'>Pitcairn</option><option value='Poland'>Poland</option><option value='Portugal'>Portugal</option><option value='Puerto Rico'>Puerto Rico</option><option value='Qatar'>Qatar</option><option value='Republic of North Macedonia'>Republic of North Macedonia</option><option value='Romania'>Romania</option><option value='Russian Federation'>Russian Federation</option><option value='Rwanda'>Rwanda</option><option value='Réunion'>Réunion</option><option value='Saint Barthélemy'>Saint Barthélemy</option><option value='Saint Helena'>Saint Helena</option><option value='Saint Kitts and Nevis'>Saint Kitts and Nevis</option><option value='Saint Lucia'>Saint Lucia</option><option value='Saint Martin (French part)'>Saint Martin (French part)</option><option value='Saint Pierre and Miquelon'>Saint Pierre and Miquelon</option><option value='Saint Vincent and the Grenadines'>Saint Vincent and the Grenadines</option><option value='Samoa'>Samoa</option><option value='San Marino'>San Marino</option><option value='Sao Tome and Principe'>Sao Tome and Principe</option><option value='Saudi Arabia'>Saudi Arabia</option><option value='Senegal'>Senegal</option><option value='Serbia'>Serbia</option><option value='Seychelles'>Seychelles</option><option value='Sierra Leone'>Sierra Leone</option><option value='Singapore'>Singapore</option><option value='Sint Maarten (Dutch part)'>Sint Maarten (Dutch part)</option><option value='Slovakia'>Slovakia</option><option value='Slovenia'>Slovenia</option><option value='Solomon Islands'>Solomon Islands</option><option value='Somalia'>Somalia</option><option value='South Africa'>South Africa</option><option value='South Georgia and the South Sandwich Islands'>South Georgia and the South Sandwich Islands</option><option value='South Sudan'>South Sudan</option><option value='Sri Lanka'>Sri Lanka</option><option value='Sudan'>Sudan</option><option value='Suriname'>Suriname</option><option value='Svalbard and Jan Mayen'>Svalbard and Jan Mayen</option><option value='Sweden'>Sweden</option><option value='Switzerland'>Switzerland</option><option value='Syrian Arab Republic'>Syrian Arab Republic</option><option value='Taiwan'>Taiwan</option><option value='Tajikistan'>Tajikistan</option><option value='Tanzania'>Tanzania</option><option value='Thailand'>Thailand</option><option value='Timor-Leste'>Timor-Leste</option><option value='Togo'>Togo</option><option value='Tokelau'>Tokelau</option><option value='Tonga'>Tonga</option><option value='Trinidad and Tobago'>Trinidad and Tobago</option><option value='Tunisia'>Tunisia</option><option value='Turkey'>Turkey</option><option value='Turkmenistan'>Turkmenistan</option><option value='Turks and Caicos Islands'>Turks and Caicos Islands</option><option value='Tuvalu'>Tuvalu</option><option value='Uganda'>Uganda</option><option value='Ukraine'>Ukraine</option><option value='United Arab Emirates'>United Arab Emirates</option><option value='United Kingdom of Great Britain and Northern Ireland'>United Kingdom of Great Britain and Northern Ireland</option><option value='United States Minor Outlying Islands'>United States Minor Outlying Islands</option>
                                    <option value='Uruguay'>Uruguay</option><option value='Uzbekistan'>Uzbekistan</option><option value='Vanuatu'>Vanuatu</option><option value='Venezuela (Bolivarian Republic of)'>Venezuela (Bolivarian Republic of)</option><option value='Viet Nam'>Viet Nam</option><option value='Virgin Islands (British)'>Virgin Islands (British)</option><option value='Virgin Islands (U.S.)'>Virgin Islands (U.S.)</option><option value='Wallis and Futuna'>Wallis and Futuna</option><option value=' Western Sahara'> Western Sahara</option><option value='Yemen'>Yemen</option><option value='Zambia'>Zambia</option><option value='Zimbabwe'>Zimbabwe</option><option value='Åland Islands'>Åland Islands</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <select style="pointer-events: none; background: #EFF1F3;" class="form-select" id="state" name="state" aria-label="Default select example" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                    <option selected value="N/A">N/A</option>
                                    <option value="Alabama">Alabama</option>
                                    <option value="Alaska">Alaska</option>
                                    <option value="Arizona">Arizona</option>
                                    <option value="Arkansas">Arkansas</option>
                                    <option value="California">California</option>
                                    <option value="Colorado">Colorado</option>
                                    <option value="Connecticut">Connecticut</option>
                                    <option value="Delaware">Delaware</option>
                                    <option value="Florida">Florida</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Hawaii">Hawaii</option>
                                    <option value="Idaho">Idaho</option>
                                    <option value="Illinois">Illinois</option>
                                    <option value="Indiana">Indiana</option>
                                    <option value="Iowa">Iowa</option>
                                    <option value="Kansas">Kansas</option>
                                    <option value="Kentucky">Kentucky</option>
                                    <option value="Louisiana">Louisiana</option>
                                    <option value="Maine">Maine</option>
                                    <option value="Maryland">Maryland</option>
                                    <option value="Massachusetts">Massachusetts</option>
                                    <option value="Michigan">Michigan</option>
                                    <option value="Minnesota">Minnesota</option>
                                    <option value="Mississippi">Mississippi</option>
                                    <option value="Missouri">Missouri</option>
                                    <option value="Montana">Montana</option>
                                    <option value="Nebraska">Nebraska</option>
                                    <option value="Nevada">Nevada</option>
                                    <option value="New Hampshire">New Hampshire</option>
                                    <option value="New Jersey">New Jersey</option>
                                    <option value="New Mexico">New Mexico</option>
                                    <option value="New York">New York</option>
                                    <option value="North Carolina">North Carolina</option>
                                    <option value="North Dakota">North Dakota</option>
                                    <option value="Ohio">Ohio</option>
                                    <option value="Oklahoma">Oklahoma</option>
                                    <option value="Oregon">Oregon</option>
                                    <option value="Pennsylvania">Pennsylvania</option>
                                    <option value="Rhode Island">Rhode Island</option>
                                    <option value="South Carolina">South Carolina</option>
                                    <option value="South Dakota">South Dakota</option>
                                    <option value="Tennessee">Tennessee</option>
                                    <option value="Texas">Texas</option>
                                    <option value="Utah">Utah</option>
                                    <option value="Vermont">Vermont</option>
                                    <option value="Virginia">Virginia</option>
                                    <option value="Washington">Washington</option>
                                    <option value="Washington DC">Washington DC</option>
                                    <option value="West Virginia">West Virginia</option>
                                    <option value="Wisconsin">Wisconsin</option>
                                    <option value="Wyoming">Wyoming</option>
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
                                <input type="text" class="form-control" id="ssh_ip" name="ssh_ip" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$" required />
                                <p style="color: red;"> @error('ssh_ip') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="ssh_port" class="form-label">SSH PORT</label>
                                <input type="number" class="form-control" id="ssh_port" name="ssh_port" required>
                                <p style="color: red;"> @error('ssh_port') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="ssh_login" class="form-label">SSH LOGIN</label>
                                <input type="text" class="form-control" id="ssh_login" name="ssh_login" required>
                                <p style="color: red;"> @error('ssh_login') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="ssh_pwd" class="form-label">SSH PWD</label>
                                <input type="text" class="form-control" id="ssh_pwd" name="ssh_pwd" required>
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                                <p style="color: red;"> @error('city') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="zip" name="zip" required>
                                <p style="color: red;"> @error('zip') {{ $message }} @enderror </p>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <!-- <input type="date" class="form-control" id="account_login" name="account_login"> -->
                                <textarea class="form-control" id="comment" name="comment"></textarea>
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
                            @foreach($accounts as $key => $account)
                                @if($account->status == 'in progress')
                                    @if(Auth::user()->id == $account->user_created_id)
                                        <tr>
                                            <td> {{ $account->id }} </td>
                                            <td style="width: 180px;">
                                                {{ $country[$key] }}-{{ $userShortNames[$key] }}-{{ $createdDates[$key] }}-{{ $account->account_number }}/{{ $account->account_type }}
                                            </td>
                                            <td> {{ $account->account_login }} </td>
                                            <td> {{ $account->account_pwd }} </td>
                                            <td> {{ $account->ssh_ip}} </td>
                                            <td> {{ $account->ssh_port}} </td>
                                            <td> {{ $account->ssh_login}} </td>
                                            <td> {{ $account->ssh_pwd}} </td>
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
                                                <div style="width: 100%; height: 100%;">
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
                                                        
                                                        <form action="{{ route('dashboard.accountEdit', $account->id) }}" method="POST" style="margin: 20px;">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="PUT">
                                                            @method('PATCH')

                                                            <div class="mb-3">
                                                                <label for="account_number" class="form-label edit-label">Account Number</label> <input type="checkbox" class="ml-3" id="number{{ $key }}" onclick="checkBoxEdit(this.id)">
                                                                <input type="number" style="pointer-events: none; background: #EFF1F3;" class="form-control" id="account_number{{$key}}" name="account_number" placeholder="{{ $account->account_number }}">
                                                                <p style="color: red;"> @error('account_number') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="account_type" class="form-label edit-label">Account Type</label>
                                                                <select class="form-select" id="account_type" name="account_type">
                                                                    <option value="{{ $account->account_type }}">{{ $account->account_type }}</option>
                                                                    <option value="L">L</option>
                                                                    <option value="S">S</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="country_code" class="form-label">Country Code</label>
                                                                <select class="form-select" id="country_code" name="country_code" aria-label="Default select example" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                                    <option selected value="{{ $account->country_code }}">{{ $account->country_code }}</option>
                                                                    <option value='France'>France</option>
                                                                    <option value='Spain'>Spain</option>
                                                                    <option value='United States of America' id="{{ $key + 1 }}" onclick="enableStateEdit(this.id)">United States of America</option>
                                                                    <option value='Afghanistan'>Afghanistan</option><option value='Albania'>Albania</option><option value='Algeria'>Algeria</option><option value='American Samoa'>American Samoa</option><option value='Andorra'>Andorra</option><option value='Angola'>Angola</option><option value='Anguilla'>Anguilla</option><option value='Antarctica'>Antarctica</option><option value='Antigua and Barbuda'>Antigua and Barbuda</option><option value='Argentina'>Argentina</option><option value='Armenia'>Armenia</option><option value='Aruba'>Aruba</option><option value='Australia'>Australia</option><option value='Austria'>Austria</option><option value='Azerbaijan'>Azerbaijan</option><option value='Bahamas'>Bahamas</option><option value='Bahrain'>Bahrain</option><option value='Bangladesh'>Bangladesh</option><option value='Barbados'>Barbados</option><option value='Belarus'>Belarus</option><option value='Belgium'>Belgium</option><option value='Belize'>Belize</option><option value='Benin'>Benin</option><option value='Bermuda'>Bermuda</option><option value='Bhutan'>Bhutan</option><option value='Bolivia'>Bolivia</option><option value='Bonaire'>Bonaire</option><option value='Bosnia and Herzegovina'>Bosnia and Herzegovina</option><option value='Botswana'>Botswana</option><option value='Bouvet Island'>Bouvet Island</option><option value='Brazil'>Brazil</option><option value='British Indian Ocean Territory'>British Indian Ocean Territory</option><option value='Brunei Darussalam'>Brunei Darussalam</option><option value='Bulgaria'>Bulgaria</option><option value='Burkina Faso'>Burkina Faso</option><option value='Burundi'>Burundi</option><option value='Cabo Verde'>Cabo Verde</option><option value='Cambodia'>Cambodia</option><option value='Cameroon'>Cameroon</option><option value='Canada'>Canada</option><option value='Cayman Islands'>Cayman Islands</option><option value='Central African Republic'>Central African Republic</option><option value='Chad'>Chad</option><option value='Chile'>Chile</option><option value='China'>China</option><option value='Christmas Island'>Christmas Island</option><option value='Cocos (Keeling) Islands '>Cocos (Keeling) Islands </option><option value='Colombia'>Colombia</option><option value='Comoros'>Comoros</option><option value='Congo'>Congo</option><option value='Congo'>Congo</option><option value='Cook Islands'>Cook Islands</option><option value='Costa Rica'>Costa Rica</option><option value='Croatia'>Croatia</option><option value='Cuba'>Cuba</option><option value='Curaçao'>Curaçao</option><option value='Cyprus'>Cyprus</option><option value='Czechia'>Czechia</option><option value='Côte d'Ivoire'>Côte d'Ivoire</option><option value='Denmark'>Denmark</option><option value='Djibouti'>Djibouti</option><option value='Dominica'>Dominica</option><option value='Dominican Republic'>Dominican Republic</option><option value='Ecuador'>Ecuador</option><option value='Egypt'>Egypt</option><option value='El Salvador'>El Salvador</option><option value='Equatorial Guinea'>Equatorial Guinea</option><option value='Eritrea'>Eritrea</option><option value='Estonia'>Estonia</option><option value='Eswatini'>Eswatini</option><option value='Ethiopia'>Ethiopia</option><option value='Falkland Islands'>Falkland Islands</option><option value='Faroe Islands'>Faroe Islands</option><option value='Fiji'>Fiji</option><option value='Finland'>Finland</option><option value='French Guiana'>French Guiana</option><option value='French Polynesia'>French Polynesia</option><option value='French Southern Territories'>French Southern Territories</option><option value='Gabon'>Gabon</option><option value='Gambia'>Gambia</option><option value='Georgia'>Georgia</option><option value='Germany'>Germany</option><option value='Ghana'>Ghana</option><option value='Gibraltar'>Gibraltar</option><option value='Greece'>Greece</option><option value='Greenland'>Greenland</option><option value='Grenada'>Grenada</option><option value='Guadeloupe'>Guadeloupe</option><option value='Guam'>Guam</option><option value='Guatemala'>Guatemala</option><option value='Guernsey'>Guernsey</option><option value='Guinea'>Guinea</option><option value='Guinea-Bissau'>Guinea-Bissau</option><option value='Guyana'>Guyana</option><option value='Haiti'>Haiti</option><option value='Heard Island and McDonald Islands'>Heard Island and McDonald Islands</option><option value='Holy See'>Holy See</option><option value='Honduras'>Honduras</option><option value='Hong Kong'>Hong Kong</option><option value='Hungary'>Hungary</option><option value='Iceland'>Iceland</option><option value='India'>India</option><option value='Indonesia'>Indonesia</option><option value='Iran'>Iran</option><option value='Iraq'>Iraq</option><option value='Ireland'>Ireland</option><option value='Isle of Man'>Isle of Man</option><option value='Israel'>Israel</option><option value='Italy'>Italy</option><option value='Jamaica'>Jamaica</option><option value='Japan'>Japan</option><option value='Jersey'>Jersey</option><option value='Jordan'>Jordan</option><option value='Kazakhstan'>Kazakhstan</option><option value='Kenya'>Kenya</option><option value='Kiribati'>Kiribati</option><option value='Korea (the Democratic Peoples Republic of)'>Korea (the Democratic People's Republic of)</option><option value='Korea (the Republic of)'>Korea (the Republic of)</option><option value='Kuwait'>Kuwait</option><option value='Kyrgyzstan'>Kyrgyzstan</option><option value='Lao People's Democratic Republic'>Lao People's Democratic Republic</option><option value='Latvia'>Latvia</option><option value='Lebanon'>Lebanon</option><option value='Lesotho'>Lesotho</option><option value='Liberia'>Liberia</option><option value='Libya'>Libya</option><option value='Liechtenstein'>Liechtenstein</option><option value='Lithuania'>Lithuania</option><option value='Luxembourg'>Luxembourg</option><option value='Macao'>Macao</option><option value='Madagascar'>Madagascar</option><option value='Malawi'>Malawi</option><option value='Malaysia'>Malaysia</option><option value='Maldives'>Maldives</option><option value='Mali'>Mali</option><option value='Malta'>Malta</option><option value='Marshall Islands'>Marshall Islands</option><option value='Martinique'>Martinique</option><option value='Mauritania'>Mauritania</option><option value='Mauritius'>Mauritius</option><option value='Mayotte'>Mayotte</option><option value='Mexico'>Mexico</option><option value='Micronesia (Federated States of)'>Micronesia (Federated States of)</option><option value='Moldova (the Republic of)'>Moldova (the Republic of)</option><option value='Monaco'>Monaco</option><option value='Mongolia'>Mongolia</option><option value='Montenegro'>Montenegro</option><option value='Montserrat'>Montserrat</option><option value='Morocco'>Morocco</option><option value='Mozambique'>Mozambique</option><option value='Myanmar'>Myanmar</option><option value='Namibia'>Namibia</option><option value='Nauru'>Nauru</option><option value='Nepal'>Nepal</option><option value='Netherlands'>Netherlands</option><option value='New Caledonia'>New Caledonia</option><option value='New Zealand'>New Zealand</option><option value='Nicaragua'>Nicaragua</option><option value='Niger'>Niger</option><option value='Nigeria'>Nigeria</option><option value='Niue'>Niue</option><option value='Norfolk Island'>Norfolk Island</option><option value='Northern Mariana Islands'>Northern Mariana Islands</option><option value='Norway'>Norway</option><option value='Oman'>Oman</option><option value='Pakistan'>Pakistan</option><option value='Palau'>Palau</option><option value='Palestine'>Palestine</option><option value='Panama'>Panama</option><option value='Papua New Guinea'>Papua New Guinea</option><option value='Paraguay'>Paraguay</option><option value='Peru'>Peru</option><option value='Philippines'>Philippines</option><option value='Pitcairn'>Pitcairn</option><option value='Poland'>Poland</option><option value='Portugal'>Portugal</option><option value='Puerto Rico'>Puerto Rico</option><option value='Qatar'>Qatar</option><option value='Republic of North Macedonia'>Republic of North Macedonia</option><option value='Romania'>Romania</option><option value='Russian Federation'>Russian Federation</option><option value='Rwanda'>Rwanda</option><option value='Réunion'>Réunion</option><option value='Saint Barthélemy'>Saint Barthélemy</option><option value='Saint Helena'>Saint Helena</option><option value='Saint Kitts and Nevis'>Saint Kitts and Nevis</option><option value='Saint Lucia'>Saint Lucia</option><option value='Saint Martin (French part)'>Saint Martin (French part)</option><option value='Saint Pierre and Miquelon'>Saint Pierre and Miquelon</option><option value='Saint Vincent and the Grenadines'>Saint Vincent and the Grenadines</option><option value='Samoa'>Samoa</option><option value='San Marino'>San Marino</option><option value='Sao Tome and Principe'>Sao Tome and Principe</option><option value='Saudi Arabia'>Saudi Arabia</option><option value='Senegal'>Senegal</option><option value='Serbia'>Serbia</option><option value='Seychelles'>Seychelles</option><option value='Sierra Leone'>Sierra Leone</option><option value='Singapore'>Singapore</option><option value='Sint Maarten (Dutch part)'>Sint Maarten (Dutch part)</option><option value='Slovakia'>Slovakia</option><option value='Slovenia'>Slovenia</option><option value='Solomon Islands'>Solomon Islands</option><option value='Somalia'>Somalia</option><option value='South Africa'>South Africa</option><option value='South Georgia and the South Sandwich Islands'>South Georgia and the South Sandwich Islands</option><option value='South Sudan'>South Sudan</option><option value='Sri Lanka'>Sri Lanka</option><option value='Sudan'>Sudan</option><option value='Suriname'>Suriname</option><option value='Svalbard and Jan Mayen'>Svalbard and Jan Mayen</option><option value='Sweden'>Sweden</option><option value='Switzerland'>Switzerland</option><option value='Syrian Arab Republic'>Syrian Arab Republic</option><option value='Taiwan'>Taiwan</option><option value='Tajikistan'>Tajikistan</option><option value='Tanzania'>Tanzania</option><option value='Thailand'>Thailand</option><option value='Timor-Leste'>Timor-Leste</option><option value='Togo'>Togo</option><option value='Tokelau'>Tokelau</option><option value='Tonga'>Tonga</option><option value='Trinidad and Tobago'>Trinidad and Tobago</option><option value='Tunisia'>Tunisia</option><option value='Turkey'>Turkey</option><option value='Turkmenistan'>Turkmenistan</option><option value='Turks and Caicos Islands'>Turks and Caicos Islands</option><option value='Tuvalu'>Tuvalu</option><option value='Uganda'>Uganda</option><option value='Ukraine'>Ukraine</option><option value='United Arab Emirates'>United Arab Emirates</option><option value='United Kingdom of Great Britain and Northern Ireland'>United Kingdom of Great Britain and Northern Ireland</option><option value='United States Minor Outlying Islands'>United States Minor Outlying Islands</option>
                                                                    <option value='Uruguay'>Uruguay</option><option value='Uzbekistan'>Uzbekistan</option><option value='Vanuatu'>Vanuatu</option><option value='Venezuela (Bolivarian Republic of)'>Venezuela (Bolivarian Republic of)</option><option value='Viet Nam'>Viet Nam</option><option value='Virgin Islands (British)'>Virgin Islands (British)</option><option value='Virgin Islands (U.S.)'>Virgin Islands (U.S.)</option><option value='Wallis and Futuna'>Wallis and Futuna</option><option value=' Western Sahara'> Western Sahara</option><option value='Yemen'>Yemen</option><option value='Zambia'>Zambia</option><option value='Zimbabwe'>Zimbabwe</option><option value='Åland Islands'>Åland Islands</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="state" class="form-label edit-label">State</label>
                                                                @if($account->state == 'N/A')
                                                                <select style="pointer-events: none; background: #EFF1F3;" class="form-select" id="state{{ $key + 1 }}" name="state" aria-label="Default select example" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                                @else
                                                                <select class="form-select" id="state{{ $key + 1 }}" name="state" aria-label="Default select example" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                                @endif
                                                                    <option selected value="{{ $account->state }}">{{ $account->state }}</option>
                                                                    <option value="Alabama">Alabama</option>
                                                                    <option value="Alaska">Alaska</option>
                                                                    <option value="Arizona">Arizona</option>
                                                                    <option value="Arkansas">Arkansas</option>
                                                                    <option value="California">California</option>
                                                                    <option value="Colorado">Colorado</option>
                                                                    <option value="Connecticut">Connecticut</option>
                                                                    <option value="Delaware">Delaware</option>
                                                                    <option value="Florida">Florida</option>
                                                                    <option value="Georgia">Georgia</option>
                                                                    <option value="Hawaii">Hawaii</option>
                                                                    <option value="Idaho">Idaho</option>
                                                                    <option value="Illinois">Illinois</option>
                                                                    <option value="Indiana">Indiana</option>
                                                                    <option value="Iowa">Iowa</option>
                                                                    <option value="Kansas">Kansas</option>
                                                                    <option value="Kentucky">Kentucky</option>
                                                                    <option value="Louisiana">Louisiana</option>
                                                                    <option value="Maine">Maine</option>
                                                                    <option value="Maryland">Maryland</option>
                                                                    <option value="Massachusetts">Massachusetts</option>
                                                                    <option value="Michigan">Michigan</option>
                                                                    <option value="Minnesota">Minnesota</option>
                                                                    <option value="Mississippi">Mississippi</option>
                                                                    <option value="Missouri">Missouri</option>
                                                                    <option value="Montana">Montana</option>
                                                                    <option value="Nebraska">Nebraska</option>
                                                                    <option value="Nevada">Nevada</option>
                                                                    <option value="New Hampshire">New Hampshire</option>
                                                                    <option value="New Jersey">New Jersey</option>
                                                                    <option value="New Mexico">New Mexico</option>
                                                                    <option value="New York">New York</option>
                                                                    <option value="North Carolina">North Carolina</option>
                                                                    <option value="North Dakota">North Dakota</option>
                                                                    <option value="Ohio">Ohio</option>
                                                                    <option value="Oklahoma">Oklahoma</option>
                                                                    <option value="Oregon">Oregon</option>
                                                                    <option value="Pennsylvania">Pennsylvania</option>
                                                                    <option value="Rhode Island">Rhode Island</option>
                                                                    <option value="South Carolina">South Carolina</option>
                                                                    <option value="South Dakota">South Dakota</option>
                                                                    <option value="Tennessee">Tennessee</option>
                                                                    <option value="Texas">Texas</option>
                                                                    <option value="Utah">Utah</option>
                                                                    <option value="Vermont">Vermont</option>
                                                                    <option value="Virginia">Virginia</option>
                                                                    <option value="Washington">Washington</option>
                                                                    <option value="Washington DC">Washington DC</option>
                                                                    <option value="West Virginia">West Virginia</option>
                                                                    <option value="Wisconsin">Wisconsin</option>
                                                                    <option value="Wyoming">Wyoming</option>
                                                                </select>
                                                            </div>
                                                            

                                                            <div class="mb-3">
                                                                <label for="account_login" class="form-label edit-label">Account Login</label>
                                                                <input type="text" class="form-control" id="account_login" name="account_login" value="{{ $account->account_login }}" required>
                                                                <p style="color: red;"> @error('account_login') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="account_pwd" class="form-label edit-label">Account PWD</label>
                                                                <input type="text" class="form-control" id="account_pwd" name="account_pwd" value="{{ $account->account_pwd }}" required>
                                                                <p style="color: red;"> @error('account_pwd') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="ssh_ip" class="form-label edit-label">SSH IP</label>
                                                                <input type="text" class="form-control" id="ssh_ip" name="ssh_ip" value="{{ $account->ssh_ip }}" required>
                                                                <p style="color: red;"> @error('ssh_ip') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="ssh_port" class="form-label edit-label">SSH PORT</label>
                                                                <input type="number" class="form-control" id="ssh_port" name="ssh_port" value="{{ $account->ssh_port }}" required>
                                                                <p style="color: red;"> @error('ssh_port') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="ssh_login" class="form-label edit-label">SSH LOGIN</label>
                                                                <input type="text" class="form-control" id="ssh_login" name="ssh_login" value="{{ $account->ssh_login }}" required>
                                                                <p style="color: red;"> @error('ssh_login') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="ssh_pwd" class="form-label edit-label">SSH PWD</label>
                                                                <input type="text" class="form-control" id="ssh_pwd" name="ssh_pwd" value="{{ $account->ssh_pwd }}" required>
                                                                <p style="color: red;"> @error('ssh_pwd') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="city" class="form-label edit-label">City</label>
                                                                <input type="text" class="form-control" id="city" name="city" value="{{ $account->city }}" required>
                                                                <p style="color: red;"> @error('city') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="zip" class="form-label edit-label">Zip</label>
                                                                <input type="text" class="form-control" id="zip" name="zip" value="{{ $account->zip }}" required>
                                                                <p style="color: red;"> @error('zip') {{ $message }} @enderror </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="comment" class="form-label edit-label">Comment</label>
                                                                <textarea class="form-control" id="comment" name="comment"> {{ $account->comment }} </textarea>
                                                                <!-- <p style="color: red;"> @error('comment') {{ $message }} @enderror </p> -->
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </form>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" id="{{ $key + 1 }}" onclick="closeModal(this.id)">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
