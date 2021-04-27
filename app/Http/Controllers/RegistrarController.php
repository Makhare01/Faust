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
        include(app_path() . '/functions/converter.php');

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
