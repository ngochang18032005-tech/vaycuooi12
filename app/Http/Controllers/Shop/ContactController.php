<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        
        return view('shop.user.contact');
    }
}
