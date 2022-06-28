<?php

namespace App\Http\Controllers;

use App\Rating;
use App\Transaction;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.rating', [
            'items' => rating::with(['user', 'health_package'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Transaction $transaction)
    {
        return view('pages.rating', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Transaction $transaction)
    {
        Rating::create([
            'user_id' => auth()->id(),
            'transaction_id' => $transaction->id,
            'health_package_id' => $transaction->health_packages_id,
            'value' => $request->value
        ]);

        return redirect()->route('my-order')->with('success', 'berhasil menambahkan rating');
    }
}
