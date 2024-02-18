<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Customer;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class PagesController extends Controller
{
    public $CURRENCY = [
        'افغانی',
        'دالر',
        'کلدار',
        'ین',
        'درهم',
        'تومن',
        'یورو'
    ];
    public $exists = [];
    public function __construct()
    {
        $this->isLogin();
    }

    // main page
    public function index() {
        $start_date = $end_date = Jalalian::now()->format("Y/m/d");
        $array = Controller::instance()->generate($start_date, $end_date, $this);
        $array['exists'] = $this->exists;
        return view("index", $array);
    }

    // customer
    public function customer() {
        return view('customer');
    }

    // customer
    public function customerAccount() {
        return view('customer-account');
    }

    // customer calculation
    public function customerCalculation() {
        return view('customer-calculation');
    }

    public function exchange() {
        return view('exchange');
    }

    public function transfer() {
        return view('transfer');
    }

    public function items() {
        return view('items');
    }

    public function expense() {
        return view('expense');
    }

    public function note() {
        return view('my-note');
    }

    public function account() {
        return view('dakhal-operation');
    }

    public function profile() {
        return view('profile');
    }

    public function report() {
        return view('report');
    }

    public function backup() {
         \Illuminate\Support\Facades\Artisan::call('myBackUp');
    }

    public function logout() {
        if(session()->has('user')) {
            session()->forget('user');
        }
        return redirect('/login')->send();
    }

}
