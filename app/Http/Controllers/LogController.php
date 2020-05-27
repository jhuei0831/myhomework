<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = Log::orderby('created_at','desc')->paginate();
        return view('manage.log.index',compact('logs'));
    }

    public function search(Request $request)
    {
        $user = $request->user;
        $ip = $request->ip;
        $browser = $request->browser;
        $action = $request->action;
        $table = $request->table;
        $start = date($request->start);
        $end = date($request->end);
        $date = [$start,$end];

        $logs_search = Log::when($user, function ($q) use ($user) {
            return $q->where('user', 'like', '%' . $user . '%');
        })
        ->when($ip, function ($q) use ($ip) {
            return $q->where('ip', 'like', '%' . $ip . '%');
        })
        ->when($browser, function ($q) use ($browser) {
            return $q->where('browser', $browser);
        })
        ->when($action, function ($q) use ($action) {
            return $q->where('action', $action);
        })
        ->when($table, function ($q) use ($table) {
            return $q->where('table', $table);
        })
        ->when($start, function ($q) use ($date) {
            return $q->whereBetween('created_at', $date);
        })
        ->paginate()
        ->appends($request->all());

        return view('manage.log.search', compact('logs_search'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $log = Log::where('id',$id)->first();
        return view('manage.log.detail',compact('log'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
        //
    }
}
