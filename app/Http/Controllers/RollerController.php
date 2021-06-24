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

    public function Rows() {
        Accountoffer::where("user_id", Auth::user()->id)->update([
            "rows" => request('pages'),
        ]);

        return redirect('/dashboard/cases');
    }

    public function cases() {
        $offers_valid = Offer::where('status', "valid")->get();
        $accounts_ready = Account::where('status', 'ready')->orWhere('status', 'elected')->get();
        $registrar_accounts = User::where("role_id", "registrar")->get();

        return view('rollerCase', [
            'offers_valid' => $offers_valid,
            'registrar_accounts' => $registrar_accounts,
            'accounts_ready' => $accounts_ready,
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

        $account_offer = Accountoffer::findOrFail($id);
        
        $account_offer->update([
            'status' => request('status'),
        ]);

        return redirect('/dashboard/cases');
    }

    public function suspend($id) {
        // Accountoffer::where("accountoffer_id", $id)->update([
        //     'status' => request('status'),
        // ]);

        $suspend = new Suspend();

        $accountOffer = Accountoffer::where("accountoffer_id", $id)->first();
        $accountOffer->update([
            'status' => request('status'),
        ]);

        $suspend->account_id = $accountOffer->account_id;
        $suspend->offer_id = $accountOffer->offer_id;
        $suspend->user_id = $accountOffer->user_id;
        $suspend->account = $accountOffer->account;
        $suspend->offer = $accountOffer->offer;
        $suspend->status = $accountOffer->status;

        $suspend->save();

        return redirect('/dashboard/cases');
    }

    // ----------------------------------------------------------------------------

    public function suspendCasesRow() {
        $suspends = Suspend::all();

        foreach ($suspends as $key => $suspend) {
            $suspend->update([
                "rows" => request('suspendPages'),
            ]);
        }

        return redirect('/dashboard/suspends');

    }

    public function suspendCases() {
        return view('suspendCases');
    }
}
