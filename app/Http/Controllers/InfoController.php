<?php

namespace App\Http\Controllers;

use App\Info;
use App\log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_infos = Info::all();
        return view('manage.info.index',compact('all_infos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->permission < '2') {
            return back()->with('warning', 'action.permission.deny');
        }
        return view('manage.info.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->permission < '2') {
            return back()->with('warning', 'action.permission.deny');
        }
        $error = 0;
        $info = new Info;

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'is_open' => ['required'],
            'is_sticky' => ['required'],
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key) && $key != 'content') {
                $info->$key = strip_tags(clean($data[$key]));
                if ($info->$key == '') {
                    $error += 1;
                }
            }
        }

        $info->editor = Auth::user()->name;
        $info->content = clean($request->input('content'));

        if ($error == 0) {
            // 寫入log
            Log::write_log('infos',$request->all());
            $info->save();
        }
        else{
            return back()->withInput()->with('warning', 'action.input_confirm');
        }
        // 寫入log
        Log::write_log('infos',$request->all());

        return back()->with('success', 'action.create_success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', 'action.permission.deny');
        }
        $info = Info::where('id',$id)->first();
        return view('manage.info.edit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', 'action.permission.deny');
        }
        $error = 0;
        $info = Info::where('id',$id)->first();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'is_open' => ['required'],
            'is_sticky' => ['required'],
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key) && $key != 'content') {
                $info->$key = strip_tags(clean($data[$key]));
                if ($info->$key == '') {
                    $error += 1;
                }
            }
        }

        $info->editor = Auth::user()->name;
        $info->content = clean($request->input('content'));

        if ($error == 0) {
            // 寫入log
            Log::write_log('infos',$request->all());
            $info->save();
        }
        else{
            return back()->withInput()->with('warning', 'action.input_confirm');
        }
        // 寫入log
        Log::write_log('infos',$request->all());

        return back()->with('success', 'action.update_success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->permission < '4') {
            return back()->with('warning', 'action.permission.deny');
        }
        // 寫入log
        Log::write_log('infos',Info::where('id', $id)->first());
        Info::destroy($id);
        return back()->with('success','action.delete_success');
    }
    /**
     * [info_detail 顯示消息內容]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function infodetail($id)
    {
        $info_detail = Info::where('id',$id)->first();
        return view('detail',compact('info_detail'));
    }

    //拖曳排序
    public function sort(Request $request)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', 'action.permission.deny');
        }

        $info_stickys = Info::where('is_sticky',1)->where('is_open',1)->orderby('sort')->get();

        foreach ($info_stickys as $info) {
            foreach ($request->order as $order) {
                if ($order['id'] == $info->id) {
                    $info->update(['sort' => $order['position']]);
                }
            }
        }
        $sort = DB::table('infos')->where('is_sticky',1)->where('is_open',1)->select('title','sort')->orderby('sort')->get();
        Log::write_log('infos',$sort,'action.sort');

        return response('Update Successfully.', 200);
    }
}
