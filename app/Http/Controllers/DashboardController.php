<?php

namespace App\Http\Controllers;

use App\Models\Keys;
use App\Models\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allKeys = Keys::all()->count();
        $loanKeys = Keys::where('status', 'I')->count();

        //Requests

        $requests = DB::table('requests')
                    ->join('keys', 'keys.barcode', '=', 'requests.barcode')
                    ->select('requests.*', 'keys.status')
                    ->get();
//        $keys = DB::table('keys')
//            ->join('sectors', 'sector_id', '=', 'sectors.id')
//            ->join('types', 'type_id', '=', 'types.id')
//            ->select('keys.*', 'types.name as type', 'sectors.name as sector')
//            ->get();

        return view('dashboard', compact('requests', 'allKeys', 'loanKeys'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
