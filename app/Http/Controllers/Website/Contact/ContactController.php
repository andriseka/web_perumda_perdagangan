<?php

namespace App\Http\Controllers\Website\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('website.contact.contact');
    }
}
