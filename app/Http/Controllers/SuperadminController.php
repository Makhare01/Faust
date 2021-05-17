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
        $Offers_for_pagination = Offer::first();
        if($Offers_for_pagination) $paginate_row = $Offers_for_pagination->rows;
        else $paginate_row = 5;

        if(array_key_exists('offer_search', $_GET) && $_GET['offer_search'] == "") $search_item_text = "Search";
        else if(array_key_exists('offer_search', $_GET)) $search_item_text = $_GET['offer_search'];
        else $search_item_text = "Search";

        if(array_key_exists('offer_search', $_GET) && $_GET['offer_search'] != "") {
            $offers = Offer::where('key', 'LIKE', "%".$_GET['offer_search']."%")
                            ->orWhere('adds_text', 'LIKE', "%".$_GET['offer_search']."%")
                            ->orWhere('bid', 'LIKE', "%".$_GET['offer_search']."%")
                            ->orWhere('status', 'LIKE', "%".$_GET['offer_search']."%")
                            ->orWhere('comment', 'LIKE', "%".$_GET['offer_search']."%")
                            ->paginate($paginate_row);
        } else $offers = Offer::paginate($paginate_row);
        
        
        return view('superadminOffers', [
            'offers' => $offers,
            'search_item_text' => $search_item_text,
            'paginate_row' => $paginate_row,
        ]);
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
