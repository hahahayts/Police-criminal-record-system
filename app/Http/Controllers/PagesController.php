<?php

namespace App\Http\Controllers;

use App\Models\Crime;
use App\Models\Evidence;
use App\Models\Suspect;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    // Dashboard
    public function dashboard(){
        return inertia('Dashboard/Index');
    }

    // Manage Users
    public function manageUsers(){
        
        return inertia('Users/Index', ['users' => User::latest()->paginate(10)]);
    }

    // Suspects
    public function suspects(){
    $suspects = Suspect::with('crime')->latest()->paginate(10);
        return inertia('Suspects/Index',['suspects' => $suspects]);
    }

    // Reports
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

    public function viewReport($id){
        $crime = Crime::findOrFail($id);

        return inertia('ViewCrime/Index', ['crime' => $crime]);
    }

    // Evidences
    public function evidences(){
        return inertia('Evidences/Index', [
            'evidences' => Evidence::latest()->paginate(10)
        ]);
    }
}
