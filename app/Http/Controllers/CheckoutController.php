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
    protected $workingHour = 9;

    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details', 'user'])->findOrFail($id);

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
            'transaction_total' => 0,
            'transaction_status' => 'IN_CART'
        ]);

        // TransactionDetail::create([
        //     'transactions_id' => $transaction->id,
        //     'pet_name' => $request->pet_name,
        //     'queue' => 1,
        //     'pet' => $request->pet,
        //     // 'status' => Menunggu,
        //     'package_date' => $request->package_date
        // ]);

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
        $data = $request->validate([
            'pet_name' => 'required|string',
            'pet' => 'required|string',
            'package_date' => 'required'
        ]);

        $packageDate = Carbon::parse($request->package_date);
        
        $data['transactions_id'] = $id;
        $transaction = Transaction::findOrFail($id);

        $sameDayTrx = TransactionDetail::with(['transaction'])->where('package_date', $packageDate)->get();

        // dd($sameDayTrx);

        $totalTime = 0;
        if ($sameDayTrx) {
            $totalTime = $sameDayTrx->sum('transaction.health_package.duration');
        }
        // $totalTime += $transaction->health_package->duration;

        $isEnoughTime = $totalTime + $transaction->health_package->duration <= $this->workingHour * 60;

        if ($isEnoughTime) {
            $data['queue'] = count($sameDayTrx) + 1;
            $estimationTime = Carbon::parse($request->package_date);
            
            $estimationHour = $totalTime / 60;
            $estimationMinute = $totalTime  % 60;

            $estimationTime->hour( $this->openingHour + $estimationHour);
            $estimationTime->minute($estimationMinute);
            $data['estimation_time'] = $estimationTime;

            TransactionDetail::create($data);
    
            $transaction->transaction_total += 
                $transaction->health_package->price;
    
            $transaction->save();
    
            return redirect()->back();
            
        }

        return redirect()->back()->with(['error' => 'jadwal di tanggal '. $request->package_date . ' sudah penuh']);
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        return view('pages.success');
    }
}
