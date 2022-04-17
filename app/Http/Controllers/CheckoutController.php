<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionDetail;
use App\HealthPackage;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details', 'health_package', 'user'])->findOrFail($id);

        return view('pages.checkout',[
            'item' => $item
        ]);
    }

    public function process(Request $request, $id)
    {
        $health_package = HealthPackage::findOrfail($id);

        $transaction = Transaction::create([
            'health_packages_id' => $id,
            'users_id' => Auth::user()->id,
            'additional' => 0,
            'transaction_total' => $health_package->price,
            'transaction_status' => 'IN_CART'
        ]);

        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'queue' => 1,
            'pet' => false,
            // 'status' => Menunggu,
            'package_date' => Carbon::now()->addYears(5)
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findOrFail($detail_id);

        $transaction = Transaction::with(['details', 'health_package'])
            ->findOrFail($item->transactions_id);

        $transaction->transaction_total -= 
            $transaction->health_package->price;

        $transaction->save();
        $item->delete();

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'pet' => 'required|string',
            'package_date' => 'required'
        ]);

        $data = $request->all();
        $data['transactions_id'] = $id;

        TransactionDetail::create($data);

        $transaction = Transaction::with(['health_package'])->find($id);

        $transaction->transaction_total += 
            $transaction->health_package->price;

        $transaction->save();

        return redirect()->back();
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        return view('pages.success');
    }
}
