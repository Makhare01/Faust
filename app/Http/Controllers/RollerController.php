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

    public function Rows() {;
        Accountoffer::where("user_id", Auth::user()->id)->update([
            "rows" => request('pages'),
        ]);

        return redirect('/dashboard/cases');
    }

    public function cases() {
        include(app_path() . '/functions/converter.php');

        $accountOffers_for_pagination = Accountoffer::where('user_id', Auth::user()->id)->first();
        if($accountOffers_for_pagination) $paginate_row = $accountOffers_for_pagination->rows;
        else $paginate_row = 5;

        $offers = Offer::all();
        $offers_valid = Offer::where('status', "valid")->get();
        $accounts = Account::all();
        $accounts_ready = Account::where('status', 'ready')->orWhere('status', 'elected')->get();
        $users = User::all();
        $accountOffers_all = Accountoffer::all();

        // $accountOffers = Accountoffer::where('user_id', Auth::user()->id)->where('status', '<>', 'suspend')->paginate($paginate_row);
        
        if(array_key_exists('case_search', $_GET) && $_GET['case_search'] == "") $search_item_text = "Search";
        else if(array_key_exists('case_search', $_GET)) $search_item_text = $_GET['case_search'];
        else $search_item_text = "Search";

        if(array_key_exists('case_search', $_GET) && $_GET['case_search'] != "") {
                $accountOffers = Accountoffer::where('user_id', Auth::user()->id)
                                                ->where('status', '<>', 'suspend')
                                                ->Where(function($query) {
                                                    // dd($query);
                                                    // exit;
                                                    $query->where('account', 'LIKE', "%".$_GET['case_search']."%")
                                                    ->orWhere('offer', 'LIKE', "%".$_GET['case_search']."%")
                                                    ->orWhere('status', 'LIKE', "%".$_GET['case_search']."%");
                                                })->paginate($paginate_row);
        } else $accountOffers = Accountoffer::where('user_id', Auth::user()->id)
                                                ->where('status', '<>', 'suspend')
                                                ->paginate($paginate_row);

        return view('rollerCase', [
            'offers' => $offers,
            'offers_valid' => $offers_valid,
            'accounts' => $accounts,
            'accounts_ready' => $accounts_ready,
            'accountOffers_all' => $accountOffers_all,
            'accountOffers' => $accountOffers,
            'search_item_text' => $search_item_text,
            'paginate_row' => $paginate_row,
        ]);
    }

    public function createCase() {
        $accountOffer = new Accountoffer(); // create Account_Offer model

        Account::where("id", request('account_id'))->update([
            'status' => 'elected',
        ]);

        $accountOffer->account_id = request('account_id');
        $accountOffer->offer_id = request('offer_id');
        $accountOffer->user_id = Auth::user()->id;
        $accountOffer->account = request('choosenAccount');
        $accountOffer->offer = request('choosenOffer');
        $accountOffer->status = 'active';

        $accountOffer->save(); // save to database

        return redirect('/dashboard/cases');
    }

    public function status($id) {
        Accountoffer::where("accountoffer_id", $id)->update([
            'status' => request('status'),
        ]);

        return redirect('/dashboard/cases');
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

        return redirect('/dashboard/cases');
    }

    // public function accounts() {
    //     $accounts = Account::all();

    //     $date = Account::select('created_at')->get();

    //     foreach($date as $value) {
    //         $dates[] = date_parse($value);
    //     }


    //     return view('accounts', [
    //         'accounts' => $accounts,
    //         'date' => $date, 
    //         'dates' => $dates,
    //     ]);
    // }
}
