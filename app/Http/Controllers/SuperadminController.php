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

    public function addOffer() {
        //error_log(request('key')); //gamoitans formidan wamogebul informacias (name vels)

        $offer = new Offer(); // create Pizza model

        $data = request()->validate([
            'key' => ['required', 'string'],
            'adds_text' => ['required', 'string'],
            'bid' => ['required', 'numeric'],
            'comment' => ['required', 'string'],
        ]);

        $offer->key = $data['key'];
        $offer->adds_text = $data['adds_text'];
        $offer->bid = $data['bid'];
        $offer->comment = $data['comment'];

        $offer->save();

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
        $data = request()->validate([
            'key' => ['required', 'string'],
            'adds_text' => ['required', 'string'],
            'bid' => ['required', 'numeric'],
            'comment' => ['required', 'string'],
        ]);

        Offer::where("offer_id", $id)->update([
            "key" => $data['key'],
            "adds_text" => $data['adds_text'],
            "bid" => $data['bid'],
            "comment" => $data['comment'],
        ]);

        return redirect('/dashboard/offersList');
    }

    public function offerStatus($id1) {
        Offer::where("offer_id", $id1)->update([
            "status" => request('status'),
        ]);

        return redirect('/dashboard/offersList');
    }
}
