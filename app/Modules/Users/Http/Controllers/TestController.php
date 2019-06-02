<?php

namespace Modules\Users\Http\Controllers;


use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index() {
        return view('users::test');
    }
}