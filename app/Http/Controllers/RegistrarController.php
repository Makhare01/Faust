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
    public function numberOfRows() {
        Account::where("user_created_id", Auth::user()->id)->update([
            "rows" => request('pages'),
        ]);

        return redirect('/dashboard/accountsList');
    }

    public function accountsList() {
        include(app_path() . '/functions/converter.php');

        return view('registrarAccounts', [
            'allStates' => $allStates,
        ]);
    }

    public function addAccount() {
        include(app_path() . '/functions/converter.php');

        $account = new Account(); // create Account model

        if(Account::where('user_created_id', Auth::user()->id)->exists()) {
            $tmp = Account::where('user_created_id', Auth::user()->id)->first(); //table rows for auth user
            $add_rows = $tmp->rows;
        } else $add_rows = 25;

        $day = date("d");
        $month = date("m");
        $short_first_name = Auth::user()->first_name;
        $short_last_name = Auth::user()->last_name;
        $short_country_code = request('country_code');

        $data = request()->validate([
            'account_type' => ['required', 'string', 'max:2'],
            'country_code' => ['required', 'string', 'max:255'],
            'account_login' => ['required'],
            'account_pwd' => ['required', 'string'],
            'ssh_ip' => ['ipv4'],
            'ssh_port' => ['numeric'],
            'ssh_login' => ['string'],
            'ssh_pwd' => ['string'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'state' => ['string', 'max:100', "nullable"],
            'comment' => ['string', "nullable"],
        ]);

        $Acc_number = 0;
        if(Account::whereDate('updated_at', Carbon::today())->where('country_code', $data['country_code'])->exists()) {
            $last_account_for_accountNumber = Account::whereDate('updated_at', Carbon::today())->where('country_code', $data['country_code'])->get();
            foreach($last_account_for_accountNumber as $key => $value):
                if($Acc_number < $value->account_number) $Acc_number = $value->account_number;
            endforeach;
            $Acc_number++;
        } else $Acc_number = 1;

        
        $account_name = converter($short_country_code).'-'.Auth::user()->initials.'-'.$day.$month.'-'.$Acc_number.'/'.$data['account_type'];

        $account->account_number = $Acc_number;
        $account->account_name = $account_name;
        $account->account_type = $data['account_type'];
        $account->country_code = $data['country_code']; 
        $account->account_login = $data['account_login']; 
        $account->account_pwd = $data['account_pwd'];

        if(array_key_exists("ssh_ip",$data)) $account->ssh_ip =  $data['ssh_ip'];
        if(array_key_exists("ssh_port",$data)) $account->ssh_port =  $data['ssh_port'];
        if(array_key_exists("ssh_login",$data)) $account->ssh_login =  $data['ssh_login'];
        if(array_key_exists('ssh_pwd',$data)) $account->ssh_pwd = $data['ssh_pwd'];

        $account->country = $data['country_code'];
        $account->city = $data['city'];
        $account->zip = $data['zip'];
        if($data['state'] == null) $account->state = 'N/A';
        else $account->state = $data['state'];
        $account->comment = $data['comment'];
        $account->user_created_id = Auth::user()->id;
        $account->rows = $add_rows;

        $account->save(); // save to database

        return redirect('/dashboard/accountsList');
    }

    public function accountDestroy($id) {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect('/dashboard/accountsList');
    }

    public function accountEdit($id) {
        include(app_path() . '/functions/converter.php');
        
        if(Account::where('user_created_id', Auth::user()->id)->exists()) {
            $add_rows = Account::where('user_created_id', Auth::user()->id)->first(); //table rows for auth user
        } else $add_rows = 25;

        $day = date("d");
        $month = date("m");
        $short_first_name = Auth::user()->first_name;
        $short_last_name = Auth::user()->last_name;
        $short_country_code = request('country_code');

        $data = request()->validate([
            // 'account_number' => ['required', 'number'],
            'account_type' => ['required', 'string', 'max:2'],
            'country_code' => ['required', 'string', 'max:255'],
            'account_login' => ['required'],
            'account_pwd' => ['required', 'string'],
            'ssh_ip' => ['ipv4'],
            'ssh_port' => ['numeric'],
            'ssh_login' => ['string'],
            'ssh_pwd' => ['string'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'state' => ['string', 'max:255'],
            'comment' => ['string', "nullable"],
        ]);

        $Acc_number = 0;
        if(Account::whereDate('updated_at', Carbon::today())->where('country_code', $data['country_code'])->exists()) {
            $last_account_for_accountNumber = Account::whereDate('updated_at', Carbon::today())->where('country_code', $data['country_code'])->get();
            foreach($last_account_for_accountNumber as $key => $value):
                if($Acc_number < $value->account_number) $Acc_number = $value->account_number;
            endforeach;
            $Acc_number++;
        } else $Acc_number = 1;

        $account_name = converter($short_country_code).'-'.Auth::user()->initials.'-'.$day.$month.'-'.$Acc_number.'/'.$data['account_type'];

        if(!array_key_exists("ssh_ip",$data)) $data['ssh_ip'] = null;

        if(!array_key_exists("ssh_port",$data)) $data['ssh_port'] = null;

        if(!array_key_exists("ssh_login",$data)) $data['ssh_login'] = null;

        if(!array_key_exists('ssh_pwd',$data)) $data['ssh_pwd'] = null;

        $account = Account::findOrFail($id);
        // Account::where('id', $id)
        $account->update([
            "account_name" => $account_name,
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
            'rows' => $add_rows->rows,
        ]);

        return redirect('/dashboard/accountsList');
    }

    public function accountStatus($id) {
        // Account::where("id", $id)->update([
        //     "status" => 'ready',
        //     "company_created_date" => Carbon::now()->toDateTimeString(),
        // ]);

        $account = Account::findOrFail($id);

        $account->update([
            "status" => 'ready',
            "company_created_date" => Carbon::now()->toDateTimeString(),
        ]);

        return redirect('/dashboard/accountsList');
    }
}
