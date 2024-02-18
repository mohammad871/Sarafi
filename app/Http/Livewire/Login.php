<?php
namespace App\Http\Livewire;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Session;

class Login extends Component
{
    public function __construct($id = null)
    {
        parent::__construct($id);
        Controller::instance()->isLogin();
    }

    public $data = [];

    // check logging of user
    public function login() {
        $result = false;
        Validator::make($this->data, [
            'username'=> 'required',
            'password'=> 'required'
        ])->validate();

        $user = User::all()->where('name', $this->data['username']);
        if(count($user) == 1) {
            $user = $user->first();
            if(Hash::check($this->data['password'], $user->password)) {
                session(['user'=> $user]);
                session()->save();
                $result = true;
            }
        }
        if($result) {
            return redirect('/dashboard');
        } else {
            $this->dispatchBrowserEvent('message', ['text'=> 'نام کابری یا پسورد نادرست است.', 'type'=> 'error']);
        }
    }

    public function render()
    {
        return view('Auth.login')->extends('layouts.master');
    }
}
