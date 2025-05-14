<?php

namespace App\Http\Controllers;

use App\Models\Crime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function reports(){
        $reports = [];
        $user = Auth::user();

       
    if ($user->hasRole('admin')) {
        $reports = Crime::latest()->paginate(10);
    }
    
    else {
        $reports = Crime::where('user_id', $user->id)->latest()->paginate(10);
    }

    return inertia('Reports/Index', [
        'reports' => $reports,
    ]);
    }
}
