<?php

// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function show()
    {
        return view('contact');
    }
    public function terms()
    {
        return view('terms');
    }

    public function policy()
    {
        return view('privacy-policy');
    }
}
