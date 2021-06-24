<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Offer;
use App\Models\Account;
use App\Models\User;
use App\Models\Accountoffer;
use App\Models\Suspend;


class SuperadminOffers extends Component
{
    public function sort() {
        $offer = Offer::first();
        
        if($offer->sort == 'ASC'):
            $offer->update([
                'sort' => 'DESC'
            ]);
        else:
            $offer->update([
                'sort' => 'ASC'
            ]);
        endif;
        
        return redirect('/dashboard/offersList');
    }

    public function render()
    {
        $Offers_for_pagination = Offer::first();
        if($Offers_for_pagination) $paginate_row = $Offers_for_pagination->rows;
        else $paginate_row = 5;

        if(array_key_exists('offer_search', $_GET) && $_GET['offer_search'] == "") $search_item_text = "Search";
        else if(array_key_exists('offer_search', $_GET)) $search_item_text = $_GET['offer_search'];
        else $search_item_text = "Search";
        
        $sort = $Offers_for_pagination->sort;

        if(array_key_exists('offer_search', $_GET) && $_GET['offer_search'] != "") {
            $offers = Offer::where('key', 'LIKE', "%".$_GET['offer_search']."%")
                            ->orWhere('adds_text', 'LIKE', "%".$_GET['offer_search']."%")
                            ->orWhere('bid', 'LIKE', "%".$_GET['offer_search']."%")
                            ->orWhere('status', 'LIKE', "%".$_GET['offer_search']."%")
                            ->orWhere('comment', 'LIKE', "%".$_GET['offer_search']."%")
                            ->orderBy('offer_id', 'DESC')
                            ->orderByRaw("FIELD(status , 'valid', 'in progress', 'work') $sort")
                            ->paginate($paginate_row);
        } else $offers = Offer::orderByRaw("FIELD(status , 'valid', 'in progress', 'work') ASC")->orderBy('offer_id', $sort)->paginate($paginate_row);

        return view('livewire.superadmin-offers', [
            'offers' => $offers,
            'search_item_text' => $search_item_text,
            'paginate_row' => $paginate_row,
            'sort' => $sort,
        ]);
    }
}
