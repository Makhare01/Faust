<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Offer;
use App\Models\Account;
use App\Models\User;
use App\Models\Accountoffer;
use App\Models\Suspend;

class DashboardController extends Controller
{
    public function index() {
        // $user = User::findOrFail($id);
        if(Auth::user()->hasRole('registrar')) {
            return view('registrar');
        }
        elseif (Auth::user()->hasRole('superadmin')) {
            return view('superadmin');
        }
        elseif (Auth::user()->hasRole('roller')) {
            return view('roller');
        }
        elseif (Auth::user()->hasRole('admin')) {
            $users = User::all();
            return view('admin');
        }
    }

    // Admin functions

    public function users() {
        $users = User::all();

        return view('allUser', [
            'users' => $users,
        ]);
    }

    public function destroyUser($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/dashboard/users');
    }

}


