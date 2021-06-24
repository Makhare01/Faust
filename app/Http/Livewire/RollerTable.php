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

class RollerTable extends Component
{
    public function sort() {
        $accountOffer = Accountoffer::where('user_id', Auth::user()->id)->first();
        
        if($accountOffer->sort == 'ASC'):
            $accountOffer->update([
                'sort' => 'DESC'
            ]);
        else:
            $accountOffer->update([
                'sort' => 'ASC'
            ]);
        endif;
        
        return redirect('/dashboard/cases');
    }

    public function render()
    {
        function converter($countryName) {
            $fullNames = "France,Spain,United States of America";
        
            $abbrNames = "FR,ES,US";
        
            // Full names
            $countryFullNames = explode(",", $fullNames);
        
            // Abbr names
            $countryAbbrNames = explode(",", $abbrNames);
        
            $COUNTRY = array_combine($countryFullNames, $countryAbbrNames);
            foreach ($COUNTRY as $key => $value) {
                if($countryName == $key) return $value;
            }
        }

        $accountOffers_for_pagination = Accountoffer::where('user_id', Auth::user()->id)->first();
        if($accountOffers_for_pagination) $paginate_row = $accountOffers_for_pagination->rows;
        else $paginate_row = 5;

        $offers = Offer::all();
        $accounts = Account::all();
        $users = User::all();
        $accountOffers_all = Accountoffer::all();

        // $accountOffers = Accountoffer::where('user_id', Auth::user()->id)->where('status', '<>', 'suspend')->paginate($paginate_row);
        
        $sort = $accountOffers_for_pagination->sort;
        // dd($sort);
        // exit;

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
                                                })->orderBy('accountoffer_id', $sort)->paginate($paginate_row);
        } else $accountOffers = Accountoffer::where('user_id', Auth::user()->id)
                                                ->where('status', '<>', 'suspend')
                                                ->orderBy('accountoffer_id', $sort)
                                                ->paginate($paginate_row);

        return view('livewire.roller-table', [
            'offers' => $offers,
            'accounts' => $accounts,
            'accountOffers_all' => $accountOffers_all,
            'accountOffers' => $accountOffers,
            'search_item_text' => $search_item_text,
            'paginate_row' => $paginate_row,
            'sort' => $sort,
        ]);
    }
}
