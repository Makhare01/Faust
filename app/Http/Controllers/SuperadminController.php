<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Offer;
use App\Models\Account;
use App\Models\User;
use App\Models\Accountoffer;
use App\Models\Suspend;

class SuperadminController extends Controller
{

    //Superadmin functions
    public function changeRows() {
        Offer::query()->update([
            "rows" => request('pages'),
        ]);

        return redirect('/dashboard/offersList');
    }
    
    public function offersList() {
        return view('superadminOffers');
    }

    public function addOffer() {
        //error_log(request('key')); //gamoitans formidan wamogebul informacias (name vels)

        $offer = new Offer(); // create Pizza model

        $data = request()->validate([
            'key' => ['required', 'string'],
            'adds_text' => ['required', 'string'],
            'bid' => ['required', 'numeric'],
            'comment' => ['string', 'nullable'],
        ]);

        $offer->key = $data['key'];
        $offer->adds_text = $data['adds_text'];
        $offer->bid = $data['bid'];
        $offer->comment = $data['comment'];

        $offer->save();

        return redirect('/dashboard/offersList');
    }

    public function offerDestroy($id) {
        $offer = Offer::find($id);
        $offer->delete();

        return redirect('/dashboard/offersList');
    }

    public function offerEdit($id) {
        $data = request()->validate([
            'key' => ['required', 'string'],
            'adds_text' => ['required', 'string'],
            'bid' => ['required', 'numeric'],
            'comment' => ['string', 'nullable'],
        ]);

        $offer = Offer::findOrFail($id);

        // Offer::where("offer_id", $id)

        $offer->update([
            "key" => $data['key'],
            "adds_text" => $data['adds_text'],
            "bid" => $data['bid'],
            "comment" => $data['comment'],
        ]);

        return redirect('/dashboard/offersList');
    }

    public function offerStatus($id) {
        // Offer::where("offer_id", $id)->update([
        //     "status" => request('status'),
        // ]);

        $offer = Offer::findOrFail($id);

        $offer->update([
            "status" => request('status'),
        ]);

        return redirect('/dashboard/offersList');
    }
}
