<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Offer;
use App\Models\Account;
use App\Models\User;
use App\Models\Accountoffer;
use App\Models\Suspend;

class RollerController extends Controller
{
    //roller functions

    public function offers() {
        include(app_path() . '/functions/converter.php');

        $offers = Offer::all();
        $accounts = Account::all();
        $users = User::all();
        $accountOffers = Accountoffer::all();
        $date = Account::select('created_at')->get();
        $countryArr = Account::pluck('country_code');

        global $dates;
        foreach($date as $key => $value) {
            $dates[] = date_parse($value['created_at']);
        }

        global $country;
        foreach($countryArr as $value) {
            $country[] = converter($value);
        }

        global $userShortNames;
        foreach($accounts as $account) {
            foreach($users as $user) {
                if($user->id == $account->user_created_id) {
                    $userShortNames[] = $user->first_name[0].$user->last_name[0];
                    break;
                }
            }
        }

        global $createdDates;
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

        $index = 0;

        return view('offers', [
            'offers' => $offers,
            'accounts' => $accounts,
            'accountOffers' => $accountOffers,
            'users' => $users,
            'dates' => $dates,
            'country' => $country,
            'index' => $index,
            'userShortNames' => $userShortNames,
            'createdDates' => $createdDates,
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
}
