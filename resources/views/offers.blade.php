<?php
    function converter($countryName) {
        $fullNames = "Afghanistan,Albania,Algeria,American Samoa,Andorra,Angola,Anguilla,Antarctica,Antigua and Barbuda,Argentina,Armenia,Aruba,Australia,Austria,Azerbaijan,Bahamas,Bahrain,Bangladesh,Barbados,Belarus,Belgium,Belize,Benin,Bermuda,Bhutan,Bolivia,Bonaire,Bosnia and Herzegovina,Botswana,Bouvet Island,Brazil,British Indian Ocean Territory,Brunei Darussalam,Bulgaria,Burkina Faso,Burundi,Cabo Verde,Cambodia,Cameroon,Canada,Cayman Islands,Central African Republic,Chad,Chile,China,Christmas Island,Cocos (Keeling) Islands,Colombia,Comoros,Congo,Congo,Cook Islands,Costa Rica,Croatia,Cuba,Curaçao,Cyprus,Czechia,Côte d'Ivoire,Denmark,Djibouti,Dominica,Dominican Republic,Ecuador,Egypt,El Salvador,Equatorial Guinea,Eritrea,Estonia,Eswatini,Ethiopia,Falkland Islands,Faroe Islands,Fiji,Finland,France,French Guiana,French Polynesia,French Southern Territories,Gabon,Gambia,Georgia,Germany,Ghana,Gibraltar,Greece,Greenland,Grenada,Guadeloupe,Guam,Guatemala,Guernsey,Guinea,Guinea-Bissau,Guyana,Haiti,Heard Island and McDonald Islands,Holy See,Honduras,Hong Kong,Hungary,Iceland,India,Indonesia,Iran,Iraq,Ireland,Isle of Man,Israel,Italy,Jamaica,Japan,Jersey,Jordan,Kazakhstan,Kenya,Kiribati,Korea (the Democratic Peoples Republic of),Korea (the Republic of),Kuwait,Kyrgyzstan,Lao People's Democratic Republic,Latvia,Lebanon,Lesotho,Liberia,Libya,Liechtenstein,Lithuania,Luxembourg,Macao,Madagascar,Malawi,Malaysia,Maldives,Mali,Malta,Marshall Islands,Martinique,Mauritania,Mauritius,Mayotte,Mexico,Micronesia (Federated States of),Moldova (the Republic of),Monaco,Mongolia,Montenegro,Montserrat,Morocco,Mozambique,Myanmar,Namibia,Nauru,Nepal,Netherlands,New Caledonia,New Zealand,Nicaragua,Niger,Nigeria,Niue,Norfolk Island,Northern Mariana Islands,Norway,Oman,Pakistan,Palau,Palestine,Panama,Papua New Guinea,Paraguay,Peru,Philippines,Pitcairn,Poland,Portugal,Puerto Rico,Qatar,Republic of North Macedonia,Romania,Russian Federation,Rwanda,Réunion,Saint Barthélemy,Saint Helena,Saint Kitts and Nevis,Saint Lucia,Saint Martin (French part),Saint Pierre and Miquelon,Saint Vincent and the Grenadines,Samoa,San Marino,Sao Tome and Principe,Saudi Arabia,Senegal,Serbia,Seychelles,Sierra Leone,Singapore,Sint Maarten (Dutch part),Slovakia,Slovenia,Solomon Islands,Somalia,South Africa,South Georgia and the South Sandwich Islands,South Sudan,Spain,Sri Lanka,Sudan,Suriname,Svalbard and Jan Mayen,Sweden,Switzerland,Syrian Arab Republic,Taiwan,Tajikistan,Tanzania,Thailand,Timor-Leste,Togo,Tokelau,Tonga,Trinidad and Tobago,Tunisia,Turkey,Turkmenistan,Turks and Caicos Islands,Tuvalu,Uganda,Ukraine,United Arab Emirates,United Kingdom of Great Britain and Northern Ireland,United States Minor Outlying Islands,United States of America,Uruguay,Uzbekistan,Vanuatu,Venezuela (Bolivarian Republic of),Viet Nam,Virgin Islands (British),Virgin Islands (U.S.),Wallis and Futuna, Western Sahara,Yemen,Zambia,Zimbabwe,Åland Islands";

        $abbrNames = "AF,AL,DZ,AS,AD,AO,AI,AQ,AG,AR,AM,AW,AU,AT,AZ,BS,BH,BD,BB,BY,BE,BZ,BJ,BM,BT,BO,BQ,BA,BW,BV,BR,IO,BN,BG,BF,BI,CV,KH,CM,CA,KY,CF,TD,CL,CN,CX,CC,CO,KM,CD,CG,CK,CR,HR,CU,CW,CY,CZ,CI,DK,DJ,DM,DO,EC,EG,SV,GQ,ER,EE,SZ,ET,FK,FO,FJ,FI,FR,GF,PF,TF,GA,GM,GE,DE,GH,GI,GR,GL,GD,GP,GU,GT,GG,GN,GW,GY,HT,HM,VA,HN,HK,HU,IS,IN,ID,IR,IQ,IE,IM,IL,IT,JM,JP,JE,JO,KZ,KE,KI,KP,KR,KW,KG,LA,LV,LB,LS,LR,LY,LI,LT,LU,MO,MG,MW,MY,MV,ML,MT,MH,MQ,MR,MU,YT,MX,FM,MD,MC,MN,ME,MS,MA,MZ,MM,NA,NR,NP,NL,NC,NZ,NI,NE,NG,NU,NF,MP,NO,OM,PK,PW,PS,PA,PG,PY,PE,PH,PN,PL,PT,PR,QA,MK,RO,RU,RW,RE,BL,SH,KN,LC,MF,PM,VC,WS,SM,ST,SA,SN,RS,SC,SL,SG,SX,SK,SI,SB,SO,ZA,GS,SS,ES,LK,SD,SR,SJ,SE,CH,SY,TW,TJ,TZ,TH,TL,TG,TK,TO,TT,TN,TR,TM,TC,TV,UG,UA,AE,GB,UM,US,UY,UZ,VU,VE,VN,VG,VI,WF,EH,YE,ZM,ZW,AX";

        // // Full names
        $countryFullNames = explode(",", $fullNames);

        // Abbr names
        $countryAbbrNames = explode(",", $abbrNames);

        $COUNTRY = array_combine($countryFullNames, $countryAbbrNames);
        foreach ($COUNTRY as $key => $value) {
            if($countryName == $key) return $value;
        }
    }
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roller Cases') }}

            <div style="float: right;">
                <!-- Button trigger modal -->
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <a >
                        <img src="/img/add.png" alt="Add image" width = "20">
                    </a>                   
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div style="display: flex;">
                                    <div style="width: 50%;">
                                        <!-- Accounts Table -->
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" id="new">№</th>
                                                    <th scope="col">Account</th>
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
                                                    
                                                        <tr>
                                                            @if($account->status == 'ready')
                                                                <th scope="row"> {{ $key + 1 }} </th>
                                                                <td id="accountId{{ $key + 1 }}" style="display: none;"> {{ $account->id }} </td>
                                                                <td id="account{{ $key + 1 }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Account ID: {{ $account->id }}, Account Number: {{ $account->account_number }}, Account Type: {{ $account->account_type }}, Country: {{ $account->country_code }}, User Id: {{ $account->user_created_id }}, Account PWD: {{ $account->account_pwd }}, SSH IP: {{ $account->ssh_ip }}, SSH PORT: {{ $account->ssh_port }}, City: {{ $account->city }}, Zip: {{ $account->zip }}, Status: {{ $account->status }}, Comment: {{ $account->comment }}">
                                                                    <!-- {{ $country[$key] }} -  -->
                                                                    {{ converter($account->country_code) }} - 

                                                                    @foreach($users as $user)
                                                                        @if($user->id == $account->user_created_id) 

                                                                            {{ $user->first_name[0] }}{{ $user->last_name[0] }} -  

                                                                            @break
                                                                        @endif
                                                                    @endforeach

                                                                    @if(intval($dates[$key]['day']) < 10) 0{{ $dates[$key]['day'] }}
                                                                    @else {{ $dates[$key]['day'] }}

                                                                    @endif

                                                                    @if(intval($dates[$key]['month']) < 10) 0{{ $dates[$key]['month'] }}
                                                                    @else {{ $dates[$key]['month'] }}
                                                                    @endif

                                                                    - {{ $account->account_number }}/{{ $account->account_type }}
                                                                </td>
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

                                    <div style="width: 50%;">
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
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 3%;">№</th>
                                <th scope="col" style="width: 15%;">Account</th>
                                <th scope="col">Info</th>
                                <th scope="col" style="width: 15%;">Offer</th>
                                <th scope="col">Info</th>
                                <th scope="col" style="width: 20%;">Status</th>
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
                                                    <pre> Account ID: <b>{{ $account->id }}</b> <br> Account Number: <b>{{ $account->account_number }}</b> <br> Account Type: <b>{{ $account->account_type }}</b> <br> Country: <b>{{ $account->country_code }}</b> <br> city: <b>{{ $account->city }}</b> <br> zip: <b>{{ $account->zip }}</b> <br> User ID: <b>{{ $account->user_created_id }}</b> <br> Account PWD: <b>{{ $account->account_pwd }}</b> <br> SSH IP: <b>{{ $account->ssh_ip }}</b> <br> SSH PORT: <b>{{ $account->ssh_port }}</b> <br> Status: <b>{{ $account->status }}</b> <br> Coment: <b>{{ $account->comment }}</b> </pre>
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
                                                    <pre> Offer ID: <b>{{ $offer->offer_id }}</b> <br> Key: <b>{{ $offer->key }}</b> <br> Adds Text: <b>{{ $offer->adds_text }}</b> <br> Bid: <b>{{ $offer->bid }}</b> <br> Status: <b>{{ $offer->status }}</b> <br> Comment: <b>{{ $offer->comment }}</b></pre>
                                                </td>
                                                @break
                                            @endif
                                        @endforeach

                                        <td>
                                            <div style="width: 100%; display: flex;">
                                                <form action="{{ route('dashboard.status', $accountOffer->accountoffer_id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PATCH">
                                                    @method('PATCH')

                                                    <div>
                                                        <input type="hidden" class="form-control" id="status" name="status" value="work">
                                                    </div>
                                                    <button type="submit" class="btn btn-outline-secondary mr-1" style="width: 90px;">Work</button>
                                                </form>
        
                                                <form action="{{ route('dashboard.status', $accountOffer->accountoffer_id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PATCH">
                                                    @method('PATCH')

                                                    <div>
                                                        <input type="hidden" class="form-control" id="status" name="status" value="review">
                                                    </div>
                                                    <button type="sumbit" class="btn btn-outline-warning ml-1" style="width: 90px;">Review</button> <br>
                                                </form>
                                            </div>

                                            <div style="width: 100%; display: flex;" >
                                                <form action="{{ route('dashboard.status', $accountOffer->accountoffer_id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PATCH">
                                                    @method('PATCH')

                                                    <div>
                                                        <input type="hidden" class="form-control" id="status" name="status" value="billing">
                                                    </div>
                                                    <button type="submit" class="btn btn-outline-success mt-2 mr-1" style="width: 90px;">Billing</button>
                                                </form>

                                                <form action="{{ route('dashboard.suspend', $accountOffer->accountoffer_id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PUT">
                                                    @method('PUT')

                                                    <div>
                                                        <input type="hidden" class="form-control" id="status" name="status" value="suspend">
                                                    </div>
                                                    <button type="submit" class="btn btn-outline-danger mt-2 ml-1" style="width: 90px;">Suspend</button>
                                                </form>
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
