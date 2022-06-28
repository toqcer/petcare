<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Worker::all();

        return view('pages.admin.workers.index',[
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
        return view('pages.admin.workers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Worker::create([
            'name' => $request->name,
        ]);
        return redirect()->back()->with(['success' => 'Sukses Menambahkan Petugas']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        //
        return view('pages.admin.workers.edit',[
            'item' => $worker,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        //
        $worker->update([
            'name' => $request->name,
        ]);
        
        return redirect()->back()->with(['success' => "Update Data Petugas Berhasil"]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        //
        $worker->delete();
        return redirect()->back()->with(['success' => 'Delete Data Petugas Berhasil']);
    }
}
