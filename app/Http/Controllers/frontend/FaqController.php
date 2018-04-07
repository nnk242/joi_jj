<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    //
    public function index() {
        return view('frontends.faq');
    }

    public function submit(Request $request) {
        return $request->ip();
    }
}
