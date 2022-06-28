<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TransactionRequest;
use App\Transaction;
use App\TransactionDetail;
use App\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Transaction::with([
            'details', 'health_package', 'user'
        ])->get();

        return view('pages.admin.transaction.index',[
            'items' => $items
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        Transaction::create($data);
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Transaction::with([
            'details', 'health_package', 'user'
        ])->findOrFail($id);

        return view('pages.admin.transaction.detail',[
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaction::findOrFail($id);

        return view('pages.admin.transaction.edit',[
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $item = Transaction::findOrFail($id);

        $item->update($data);

        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);

        $item->delete();

        return redirect()->route('transaction.index');
    }

    public function confirmPayment(Transaction $trx) 
    {
        $trx->update([
            'transaction_status' => 'SUCCESS',
        ]);
        return redirect()->route('transaction.index')->with('success', 'payment berhasil di verifikasi');
    }

    public function rejectPayment(Transaction $trx) 
    {
        $trx->update(['transaction_status' => 'CANCEL']);
        return redirect()->route('transaction.index')->with('success', 'payment berhasil di tolak');
    }

    public function weekTransaction() 
    {   
        $date = today();
        $date->subDays(7);
        $items = Transaction::with('health_package')
            ->withCount('details')
            ->selectRaw(' DATE(created_at) as created_date')
            ->where('created_at' ,'>', $date)
            ->where('transaction_status', 'SUCCESS')                 
            ->get();

        return view('pages.admin.transaction.report',[
            'items' => $items,
            'grandTotalTransaction' => $items->sum('details_count'),
            'grandTotalSales' => $items->sum('transaction_total'),
            'title' => 'Week Report'
        ]); 
    }

    public function monthTransaction() 
    {   
        $date = today();
        $date->subMonth();
        $items = Transaction::with('health_package')
            ->withCount('details')
            ->selectRaw(' DATE(created_at) as created_date')
            ->where('created_at' ,'>', $date)
            ->where('transaction_status', 'SUCCESS')                 
            ->get();

        return view('pages.admin.transaction.report',[
            'items' => $items,
            'grandTotalTransaction' => $items->sum('details_count'),
            'grandTotalSales' => $items->sum('transaction_total'),
            'title' => 'Month Report'
        ]); 
    }

    public function yearTransaction() 
    {   
        $date = today();
        $date->month(1);
        $date->day(1);
        $items = Transaction::with('health_package')
            ->withCount('details')
            ->selectRaw(' DATE(created_at) as created_date')
            ->where('created_at' ,'>', $date)
            ->where('transaction_status', 'SUCCESS')                 
            ->get();

        return view('pages.admin.transaction.report',[
            'items' => $items,
            'grandTotalTransaction' => $items->sum('details_count'),
            'grandTotalSales' => $items->sum('transaction_total'),
            'title' => 'Year Report'
        ]); 
    }

    public function todayTransaction()
    {
        return view('pages.admin.transaction.today', [
            'items' => TransactionDetail::with('worker')->where('package_date', Carbon::today())->get(),
        ]);
    }

    public function selectWorkerView(TransactionDetail $item)
    {
        return view('pages.admin.transaction.assign-worker', [
            'item' => $item,
            'workers' => Worker::all(),
        ]);
    }

    public function assignWorker(Request $request,TransactionDetail $item)
    {
        $item->worker_id = $request->worker_id;
        $item->save();
        return redirect()->route('transaction.today')->with(['success', 'Berhasil memilih pegawai']);
    }
}
