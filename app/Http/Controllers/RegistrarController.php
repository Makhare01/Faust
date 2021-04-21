<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Offer;
use App\Models\Account;
use App\Models\User;
use App\Models\Accountoffer;
use App\Models\Suspend;

class RegistrarController extends Controller
{
    //Registrar functions

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

        global $userShortNames;
        foreach($accounts as $account) {
            foreach($users as $user) {
                if($user->id == $account->user_created_id) {
                    $userShortNames[] = strtoupper($user->first_name[0].$user->last_name[0]);
                    break;
                }
            }
        }

        global $createdDates;
        if(Account::select('country_code')->exists()){
            foreach($dates as $key => $date) {
                $TMP = "";
                if(intval($date['day']) < 10) {
                    $TMP = $TMP.'0'.$dates[$key]['day'];
                } 
                else $TMP = $TMP.$dates[$key]['day'];

                if(intval($date['month']) < 10) {
                    $TMP = $TMP.'0'.$dates[$key]['month'];
                } 
                else $TMP = $TMP.$dates[$key]['month'];

                $createdDates[] = $TMP;
            }
        }

        return view('registrarAccounts', [
            'accounts' => $accounts,
            'users' => $users,
            'dates' => $dates,
            'country' => $country,
            'userShortNames' => $userShortNames,
            'createdDates' => $createdDates,
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

        $data = request()->validate([
            'account_type' => ['required', 'string', 'max:2'],
            'country_code' => ['required', 'string', 'max:255'],
            'account_login' => ['required'],
            'account_pwd' => ['required', 'string'],
            'ssh_ip' => ['required', 'ipv4'],
            'ssh_port' => ['required', 'numeric'],
            'ssh_login' => ['required', 'string'],
            'ssh_pwd' => ['required', 'string'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'state' => ['string', 'max:255'],
            'comment' => ['string', "nullable"],
        ]);

        // dd($data);

        if(request('account_number') === '' || request('account_number') === null) $account->account_number = $Acc_number;
        else $account->account_number = request('account_number');
        $account->account_type = $data['account_type'];
        $account->country_code = $data['country_code']; 
        $account->account_login = $data['account_login']; 
        $account->account_pwd = $data['account_pwd'];
        $account->ssh_ip = $data['ssh_ip'];
        $account->ssh_port = $data['ssh_port'];
        $account->ssh_login = $data['ssh_login'];
        $account->ssh_pwd = $data['ssh_pwd'];
        $account->country = $data['country_code'];
        $account->city = $data['city'];
        $account->zip = $data['zip'];
        if($data['country_code'] == 'United States of America') {
            $account->state = $data['state'];
        }else $account->state = 'N/A';
        $account->comment = $data['comment'];
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

        $data = request()->validate([
            // 'account_number' => ['required', 'number'],
            'account_type' => ['required', 'string', 'max:2'],
            'country_code' => ['required', 'string', 'max:255'],
            'account_login' => ['required'],
            'account_pwd' => ['required', 'string'],
            'ssh_ip' => ['required', 'ipv4'],
            'ssh_port' => ['required', 'numeric'],
            'ssh_login' => ['required', 'string'],
            'ssh_pwd' => ['required', 'string'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'state' => ['string', 'max:255'],
            'comment' => ['string', "nullable"],
        ]);

        if(request("account_number") != null) $Acc_number = request("account_number");

        Account::where("id", $id)->update([
            "account_number" => $Acc_number,
            "account_type" => $data['account_type'],
            "country_code" => $data['country_code'],
            "account_pwd" => $data['account_pwd'],
            "account_login" => $data['account_login'],
            "ssh_ip" => $data['ssh_ip'],
            "ssh_port" => $data['ssh_port'],
            "ssh_login" => $data['ssh_login'],
            "ssh_pwd" => $data['ssh_pwd'],
            "country" => $data['country_code'],
            "city" => $data['city'],
            "zip" => $data['zip'],
            "state" => $data['state'],
            "comment" => $data['comment'],
        ]);

        return redirect('/dashboard/accountsList');
    }

    public function accountStatus($id1) {
        Account::where("id", $id1)->update([
            "status" => 'ready',
            "company_created_date" => Carbon::now()->toDateTimeString(),
        ]);

        return redirect('/dashboard/accountsList');
    }
}
