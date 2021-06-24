<div>
    <table class="table">
        <thead>
            <tr>
                <!-- <th scope="col" style="width: 4%;">№</th> -->
                <th wire:click="sort()" scope="col" style="text-align: center; height: 50px; display: flex; cursor: pointer;">
                    №
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
                <th scope="col" style="width: 250px; !important">Account</th>
                <th scope="col" style="width: 20% !important;">Info</th>
                <th scope="col" style="width: 15%;">Offer</th>
                <th scope="col" style="width: 15% !important;">Info</th>
                <!-- <th scope="col" style="width: 16%;">Status</th> -->
            </tr>
        </thead>
        <tbody>
            <div style="display: flex; position: relative;" class="mb-3">
                <form action="{{ route('dashboard.suspendCasesRow') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                        <label class="pagination_labbel mr-2" for="Pages" class="rows-label" style="line-height: 38px !important;">Show </label>
                        <select id="suspendPages" class="form-select" name="suspendPages" onchange="this.form.submit()" style="width: 80px; height: 40px;">
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
                    <form action="{{ route('dashboard.suspendCases') }}" method="GET">
                        @csrf
                        <input type="text" id="suspendCase_search" name="suspendCase_search" class="form-control" style="height: 40px;" placeholder="{{ $search_item_text }}">
                        <button class="btn btn-outline-secondary ml-2" type="submit" id="button-addon2" style="height: 40px;">Search</button>
                    </form>
                </div>
            </div>
            @foreach($suspendCases as $key => $suspendCase)
                <tr style="border-bottom: solid 20px #DF4755;">
                    <th scope="row"> {{ $key + 1 }} </th>

                    <td style="width: 190px;">
                        {{ $suspendCase->account }}
                    </td>
                    @foreach($accounts as $account)
                        @if($account->id == $suspendCase->account_id)
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
                            {{ $suspendCase->offer }}
                        </pre>
                    </td>

                    @foreach($offers as $offer)
                        @if($offer->offer_id == $suspendCase->offer_id)
                            {{ $existCase = false }}
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
                    @if($existCase) 
                        <td>Null</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <span> {{ $suspendCases->links() }} </span>
</div>
