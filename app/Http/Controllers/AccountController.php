<?php

namespace App\Http\Controllers;

use App\Models\Account;

class AccountController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dakhal-operation', compact('dakhals'));
    }
}
