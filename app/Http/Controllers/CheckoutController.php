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
    protected $openingHour = 8;
    protected $closingHour = 17; 
    protected $spareTime = 15; // in minutes

    public function index(Request $request, $id)
    {
        $item = Transaction::with(['user', 'details' => function ($query) {
            $query->orderBy('estimation_time');
        }])->findOrFail($id);

        return view('pages.checkout',[
            'item' => $item,
        ]);
    }

    public function process(Request $request, $id)
    {
        $transaction = Transaction::create([
            'health_packages_id' => $id,
            'users_id' => Auth::user()->id,
            'transaction_total' => 0,
            'transaction_status' => 'IN_CART'
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findOrFail($detail_id);

        $transaction = Transaction::with(['details'])
            ->findOrFail($item->transactions_id);

        $transaction->transaction_total -= 
            $transaction->health_package->price;

        $transaction->save();
        $item->delete();

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        // dd($request->all());
        $data = $request->validate([
            'pet_name' => 'required|string',
            'pet' => 'required|string',
            'package_date' => 'required',
            'transfer_proof' => 'required|image'
        ]);

        $now = Carbon::now();
        $today = Carbon::today();
        $packageDate = Carbon::parse($request->package_date);
        
        $closingTime = clone $packageDate;
        $closingTime->hour($this->closingHour);

        if ($now > $closingTime) {
            return redirect()->back()->withErrors(['tidak bisa membuat jadwal di tanggal '. $request->package_date]);
        }

        $transaction = Transaction::findOrFail($id);
        $sameDayTrx = TransactionDetail::where('package_date', $packageDate)->get();

        if ($packageDate != $today or ($sameDayTrx->isNotEmpty() and $sameDayTrx->last()->finished_at > $now)) {

            if ($sameDayTrx->isEmpty()) {

                $estimationTime = clone $packageDate;
                $estimationTime->hour($this->openingHour);
            
            } else {

                $estimationTime = $sameDayTrx->last()->finished_at;

            }
        
        } else {

            $estimationTime = $now->addMinutes($this->spareTime);
        
        }

        $finishedAt = clone $estimationTime;
        $finishedAt->addMinutes($transaction->health_package->duration);

        if ($finishedAt > $closingTime) {
            return redirect()->back()->withErrors(['jadwal di tanggal '. $request->package_date . ' sudah penuh']);
        }

        $uploadTransferProof = $request->file('transfer_proof');
        $pathTransferProof = $uploadTransferProof->store('assets/transfer-proof', 'public');
        
        $data['queue'] = count($sameDayTrx) + 1;
        $data['transactions_id'] = $id;
        $data['estimation_time'] = $estimationTime;
        $data['finished_at'] = $finishedAt;
        $data['transfer_proof'] = $pathTransferProof;

        TransactionDetail::create($data);
        $transaction->transaction_total += $transaction->health_package->price;
        $transaction->save();
        
        return redirect()->back();
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        return view('pages.success', compact('transaction'));
    }
}
