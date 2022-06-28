<?php

namespace App\Http\Controllers;

use App\HealthPackage;
use App\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = HealthPackage::with(['galleries', 'ratings'])->get();
        return view('pages.home',[
            'items' => $items
        ]);
    }

    public function myOrder()
    {
        return view('pages.my-order', ['items' => Transaction::with('details')->where('users_id', auth()->id())->get()]);
    }
}
