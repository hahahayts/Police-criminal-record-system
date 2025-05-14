<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboard(){
        return inertia('Dashboard/Index');
    }
    public function manageUsers(){
        return inertia('Users/Index');
    }
    public function suspects(){
        return inertia('Suspects/Index');
    }
}
