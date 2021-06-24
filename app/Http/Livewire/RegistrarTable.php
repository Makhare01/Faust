<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Account;
use App\Models\User;
use Carbon\Carbon;

class RegistrarTable extends Component
{
    public $search;
    public $searched = false;

    public function searchFunc() {
        $this->searched = true;
        $search = $this->search;
        return $search;
        // return redirect('/dashboard/accountsList');
    }

    public function changeRow($row) {
        Account::where("user_created_id", Auth::user()->id)->update([
            "rows" => $row,
        ]);

        return redirect('/dashboard/accountsList');
    }

    // public function changeStatus($id) {
    //     $account = Account::findOrFail($id);

    //     $account->update([
    //         "status" => 'ready',
    //         "company_created_date" => Carbon::now()->toDateTimeString(),
    //     ]);
    // }

    // public function deleteAccount($id) {
    //     $account = Account::findOrFail($id);
    //     $account->delete();
    // }

    public function sort() {
        $account = Account::where('user_created_id', Auth::user()->id)->first();
        
        if($account->sort == 'ASC'):
            $account->update([
                'sort' => 'DESC'
            ]);
        else:
            $account->update([
                'sort' => 'ASC'
            ]);
        endif;
        
        return redirect('/dashboard/accountsList');
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
        
        $States_string = 'Alabama,Alaska,Arizona,Arkansas,California,Colorado,Connecticut,Delaware,Florida,Georgia,Hawaii,Idaho,Illinois,Indiana,Iowa,Kansas,Kentucky,Louisiana,Maine,Maryland,Massachusetts,Michigan,Minnesota,Mississippi,Missouri,Montana,Nebraska,Nevada,New Hampshire,New Jersey,New Mexico,New York,North Carolina,North Dakota,Ohio,Oklahoma,Oregon,Pennsylvania,Rhode Island,South Carolina,South Dakota,Tennessee,Texas,Utah,Vermont,Virginia,Washington,Washington DC,West Virginia,Wisconsin,Wyoming';
        
        $allStates = explode(",", $States_string);

        $users = User::all();

        if(array_key_exists('account_search', $_GET) && $_GET['account_search'] == "") $search_item_text = "Search";
        else if(array_key_exists('account_search', $_GET)) $search_item_text = $_GET['account_search'];
        else $search_item_text = "Search";

        $account_for_pagination = Account::where('user_created_id', Auth::user()->id)->first();
        if($account_for_pagination) $paginate_row = $account_for_pagination->rows;
        else $paginate_row = 5;

        $sort = $account_for_pagination->sort;

        // dd($this->searchFunc());
        // exit;
        
        if(array_key_exists('account_search', $_GET) && $_GET['account_search'] != "") {
            $auth_user_accounts = Account::where('user_created_id', Auth::user()->id)
                                            ->where('status', "in progress")
                                            ->Where(function($query) {
                                                $query->where('account_name', 'LIKE', "%".$_GET['account_search']."%")
                                                ->orWhere('country', 'LIKE', "%".$_GET['account_search']."%")
                                                ->orWhere('account_login', 'LIKE', "%".$_GET['account_search']."%")
                                                ->orWhere('account_pwd', 'LIKE', "%".$_GET['account_search']."%")
                                                ->orWhere('ssh_port', 'LIKE', "%".$_GET['account_search']."%")
                                                ->orWhere('ssh_ip', 'LIKE', "%".$_GET['account_search']."%")
                                                ->orWhere('ssh_login', 'LIKE', "%".$_GET['account_search']."%")
                                                ->orWhere('ssh_pwd', 'LIKE', "%".$_GET['account_search']."%")
                                                ->orWhere('state', 'LIKE', "%".$_GET['account_search']."%")
                                                ->orWhere('city', 'LIKE', "%".$_GET['account_search']."%")
                                                ->orWhere('zip', 'LIKE', "%".$_GET['account_search']."%")
                                                ->orWhere('comment', 'LIKE', "%".$_GET['account_search']."%");
                                            })->orderBy('id', $sort)->paginate($paginate_row);
        } else $auth_user_accounts = Account::where('user_created_id', Auth::user()->id)
                                            ->where('status', "in progress")
                                            ->orderBy('id', $sort)
                                            ->paginate($paginate_row);
        
        return view('livewire.registrar-table', [
            'users' => $users,
            'allStates' => $allStates,
            'auth_user_accounts' => $auth_user_accounts,
            'paginate_row' => $paginate_row,
            'search_item_text' => $search_item_text,
            'sort' => $sort,
        ]);
    }
}
