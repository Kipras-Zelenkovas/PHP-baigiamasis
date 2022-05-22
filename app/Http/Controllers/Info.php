<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Info extends Controller
{

    public function showAbout_us()
    {
        return view('about_us');
    }

    public function showContacts()
    {
        return view('contacts');
    }
}
