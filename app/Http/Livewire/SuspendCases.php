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

class SuspendCases extends Component
{
    public function sort() {
        $suspendCase = Suspend::where('user_id', Auth::user()->id)->first();
        
        if($suspendCase->sort == 'ASC'):
            $suspendCase->update([
                'sort' => 'DESC'
            ]);
        else:
            $suspendCase->update([
                'sort' => 'ASC'
            ]);
        endif;
        
        return redirect('/dashboard/suspends');
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

        $suspendCases_for_pagination = Suspend::first();
        if($suspendCases_for_pagination) $paginate_row = $suspendCases_for_pagination->rows;
        else $paginate_row = 5;

        $offers = Offer::all();
        $offers_valid = Offer::where('status', "valid")->get();
        $accounts = Account::all();
        $accounts_ready = Account::where('status', 'ready')->orWhere('status', 'elected')->get();
        $users = User::all();
        $accountOffers_all = Suspend::all();

        $sort = $suspendCases_for_pagination->sort;

        // $accountOffers = Accountoffer::where('user_id', Auth::user()->id)->where('status', '<>', 'suspend')->paginate($paginate_row);
        
        if(array_key_exists('suspendCase_search', $_GET) && $_GET['suspendCase_search'] == "") $search_item_text = "Search";
        else if(array_key_exists('suspendCase_search', $_GET)) $search_item_text = $_GET['suspendCase_search'];
        else $search_item_text = "Search";

        if(array_key_exists('suspendCase_search', $_GET) && $_GET['suspendCase_search'] != "") {
                $suspendCases = Suspend::Where(function($query) {
                                                    $query->where('account', 'LIKE', "%".$_GET['suspendCase_search']."%")
                                                    ->orWhere('offer', 'LIKE', "%".$_GET['suspendCase_search']."%")
                                                    ->orWhere('status', 'LIKE', "%".$_GET['suspendCase_search']."%");
                                                })->paginate($paginate_row);
        } else $suspendCases = Suspend::orderBy('id', $sort)->paginate($paginate_row);

        $existCase = true;

        return view('livewire.suspend-cases', [
            'offers' => $offers,
            'offers_valid' => $offers_valid,
            'accounts' => $accounts,
            'accounts_ready' => $accounts_ready,
            'accountOffers_all' => $accountOffers_all,
            'suspendCases' => $suspendCases,
            'search_item_text' => $search_item_text,
            'paginate_row' => $paginate_row,
            'existCase' => $existCase,
            'sort' => $sort,
        ]);
    }
}
