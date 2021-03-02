<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Offer;
use App\Models\Account;
use App\Models\User;
use App\Models\Accountoffer;
use App\Models\Suspend;

class DashboardController extends Controller
{
    public function index() {
        // $user = User::findOrFail($id);
        if(Auth::user()->hasRole('registrar')) {
            return view('registrar');
        }
        elseif (Auth::user()->hasRole('superadmin')) {
            return view('superadmin');
        }
        elseif (Auth::user()->hasRole('roller')) {
            return view('roller');
        }
    }

    // roller functions

    public function offers() {
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

        $offers = Offer::all();
        $accounts = Account::all();
        $users = User::all();
        $accountOffers = Accountoffer::all();
        $date = Account::select('created_at')->get();
        $countryArr = Account::pluck('country_code');

        foreach($date as $key => $value) {
            $dates[] = date_parse($value['created_at']);
        }

        foreach($countryArr as $value) {
            $country[] = converter($value);
        }

        $index = 0;

        return view('offers', [
            'offers' => $offers,
            'accounts' => $accounts,
            'accountOffers' => $accountOffers,
            'users' => $users,
            'dates' => $dates,
            'country' => $country,
            'index' => $index,
        ]);
    }

    public function status($id) {
        Accountoffer::where("accountoffer_id", $id)->update([
            'status' => request('status'),
        ]);

        return redirect('/dashboard/offers');
    }

    public function suspend($id) {
        Accountoffer::where("accountoffer_id", $id)->update([
            'status' => request('status'),
        ]);

        $accountOffer = Accountoffer::where("accountoffer_id", $id)->first();
        $suspend = new Suspend();

        $suspend->account_id = $accountOffer->account_id;
        $suspend->offer_id = $accountOffer->offer_id;
        $suspend->user_id = $accountOffer->user_id;
        $suspend->account = $accountOffer->account;
        $suspend->offer = $accountOffer->offer;
        $suspend->status = $accountOffer->status;

        $suspend->save();

        return redirect('/dashboard/offers');
    }

    public function accountOffer() {
        $accountOffer = new Accountoffer(); // create Account_Offer model

        $accountOffer->account_id = request('account_id');
        $accountOffer->offer_id = request('offer_id');
        $accountOffer->user_id = Auth::user()->id;
        $accountOffer->account = request('choosenAccount');
        $accountOffer->offer = request('choosenOffer');
        $accountOffer->status = 'active';

        $accountOffer->save(); // save to database

        return redirect('/dashboard/offers');
    }

    public function accounts() {
        $accounts = Account::all();

        $date = Account::select('created_at')->get();

        foreach($date as $value) {
            $dates[] = date_parse($value);
        }


        return view('accounts', [
            'accounts' => $accounts,
            'date' => $date, 
            'dates' => $dates,
        ]);
    }

    // Superadmin functions

    public function addOffer() {
        //error_log(request('key')); //gamoitans formidan wamogebul informacias (name vels)

        $offer = new Offer(); // create Pizza model

        $offer->key = request('key'); // add key in database
        $offer->adds_text = request('adds_text');
        $offer->bid = request('bid');
        // $offer->status = request('status');
        $offer->comment = request('comment');

        $offer->save(); // save to database

        return redirect('/dashboard/offersList');
    }

    public function offersList() {
        $offers = Offer::all(); //get all information from offer table
        // $pizzas = Pizza::orderBy('name', 'desc')->get(); //get all information ordered by name
        // $pizzas = Pizza::where('type', 'hawaian')->get(); //get all information where type is hawaian
        // $pizzas = Pizza::latest()->get(); 

        return view('superadminOffers', [
            'offers' => $offers,
        ]);
    }

    public function offerDestroy($id) {
        $offer = Offer::find($id);
        $offer->delete();

        return redirect('/dashboard/offersList');
    }

    public function offerEdit($id) {
        Offer::where("offer_id", $id)->update([
            "key" => request('key'),
            "adds_text" => request('adds_text'),
            "bid" => request('bid'),
            "comment" => request('comment'),
        ]);

        return redirect('/dashboard/offersList');
    }

    public function offerStatus($id1) {
        Offer::where("offer_id", $id1)->update([
            "status" => 'valid',
        ]);

        return redirect('/dashboard/offersList');
    }



    // Registrar functions

    public function accountsList() {
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

        $accounts = Account::all();
        $users = User::all();
        $date = Account::select('created_at')->get();
        $countryArr = Account::pluck('country_code');

        if(Account::select('created_at')->exists()){
            foreach($date as $key => $value) {
                $dates[] = date_parse($value['created_at']);
            }
        }else $dates[] = null;

        if(Account::select('country_code')->exists()){
            foreach($countryArr as $value) {
                $country[] = converter($value);
            }
        }else $country[] = null;

        // echo $countryArr[0];

        return view('registrarAccounts', [
            'accounts' => $accounts,
            'users' => $users,
            'dates' => $dates,
            'country' => $country,
        ]);
    }

    public function addAccount() {
        $account = new Account(); // create Account model

        $date = Account::select('created_at')->get();
        $countryArr = Account::pluck('country_code');

        $mydate = getdate(date("U"));
        $currentDate = intval($mydate['mday'] . $mydate['mon'] . $mydate['year']); //Current date
        
        $Acc_number = 1;

        if(Account::select('created_at')->exists()){
            foreach($date as $key => $value) {
                $dates[] = date_parse($value['created_at']);
            }
            foreach($dates as $date) {
                $alldates[] = intval($date['day'].$date['month'].$date['year']); //All date in the table
            }
            for($i=0; $i<count($alldates); $i++):
                if($countryArr[$i]==request('country_code') && $alldates[$i]==$currentDate) {
                    $Acc_number++;
                }
            endfor;
        }else $dates[] = null;

        $account->account_number = $Acc_number;
        $account->account_type = request('account_type');
        $account->country_code = request('country_code'); 
        $account->account_login = request('account_login'); 
        $account->account_pwd = request('account_pwd');
        $account->ssh_ip = request('ssh_ip');
        $account->ssh_port = request('ssh_port');
        $account->country = request('country_code');
        $account->city = request('city');
        $account->zip = request('zip');
        // $account->status = request('status');
        $account->comment = request('comment');
        $account->user_created_id = Auth::user()->id;

        $account->save(); // save to database

        return redirect('/dashboard/accountsList');
    }

    public function accountDestroy($id) {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect('/dashboard/accountsList');
    }

    public function accountEdit($id) {
        Account::where("id", $id)->update([
            "account_type" => request('account_type'),
            "country_code" => request('country_code'),
            "account_pwd" => request('account_pwd'),
            "account_login" => request('account_login'),
            "ssh_ip" => request('ssh_ip'),
            "ssh_port" => request('ssh_port'),
            "city" => request('city'),
            "zip" => request('zip'),
            "comment" => request('comment'),
        ]);

        return redirect('/dashboard/accountsList');
    }

    public function accountStatus($id1) {
        Account::where("id", $id1)->update([
            "status" => 'ready',
        ]);

        return redirect('/dashboard/accountsList');
    }
}


