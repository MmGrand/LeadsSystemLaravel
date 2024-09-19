<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        if (Auth::check()) {
            $leads = Lead::all();
            $statuses = Status::all();

            return view('home', compact('leads', 'statuses'));
        } else {
            return view('home');
        }
    }
}
