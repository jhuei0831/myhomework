<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\menu;
use App\Log;
class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_notices = DB::table('notices')->get();
        return view('manage.notice.index',compact('all_notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->permission < '2') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }

        return view('manage.notice.create');
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
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $error = 0;
        $notice = new Notice;
        $data = $request->validate([
            'menu_id' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'width' => ['nullable', 'integer', 'min:0'],
            'content' => ['required'],
            'is_open' => ['required'],
        ]);
        // 逐筆進行htmlpurufier 並去掉<p></p>
        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key) && $request->filled($key) != NULL && $key != 'content') {
                $notice->$key = strip_tags(clean($data[$key]));
                if ($notice->$key == '') {
                    $error += 1;
                }
            }
            else{
                $notice->$key = NULL;
            }
        }

        $notice->content = clean($request->input('content'));

        if ($error == 0) {
            // 寫入log
            Log::write_log('notices',$request->all());
            $notice->save();
        }
        else{
            return back()->withInput()->with('warning', '請確認輸入 !');
        }

        return back()->with('success','通知新增成功 !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $notice = Notice::where('id',$id)->first();
        return view('manage.notice.edit',compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->permission < '3') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        $error = 0;
        $notice = Notice::where('id',$id)->first();

        $data = $this->validate($request, [
            'menu_id' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'width' => ['nullable', 'integer', 'min:0'],
            'content' => ['required'],
            'is_open' => ['required'],
        ]);

        // 逐筆進行htmlpurufier 並去掉<p></p>
        foreach ($request->except('_token', '_method') as $key => $value) {
            if ($request->filled($key) && $request->filled($key) != NULL && $key != 'content') {
                $notice->$key = strip_tags(clean($data[$key]));
                if ($notice->$key == '') {
                    $error += 1;
                }
            }
            else{
                $notice->$key = NULL;
            }
        }

        $notice->content = clean($request->input('content'));
        if ($error == 0) {
            // 寫入log
            Log::write_log('notices',$request->all());
            $notice->save();
        }
        else{
            return back()->withInput()->with('warning', '請確認輸入 !');
        }
        return back()->with('success','修改通知成功 !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->permission < '4') {
            return back()->with('warning', '權限不足以訪問該頁面 !');
        }
        // 寫入log
        Log::write_log('notices',Notice::where('id', $id)->first());
        Notice::destroy($id);
        return back()->with('success','刪除通知成功 !');
    }
}
