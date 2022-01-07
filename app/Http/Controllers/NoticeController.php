<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Notice;
use DB;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::where('release_flg', 1)->orderBy('notice_date', 'desc')->orderBy('id', 'desc')->paginate(10);

        return view('notice/index', [
            'notices' => $notices,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notice = Notice::find($id);
        $max_flg = false;
        $min_flg = false;
        $max_notice = Notice::where('release_flg', 1)->orderBy('notice_date', 'desc')->orderBy('id', 'desc')->first();
        $min_notice = Notice::where('release_flg', 1)->orderBy('notice_date', 'asc')->orderBy('id', 'asc')->first();
        if ($id == $max_notice->id) {
            $max_flg = true;
        }
        if ($id == $min_notice->id) {
            $min_flg = true;
        }

        $notices = Notice::where('release_flg', 1)->orderBy('notice_date', 'desc')->orderBy('id', 'desc')->get();
        $notice_key = $notices->where('id', $id)->keys()->first();
        $back_id = null;
        $next_id = null;

        if (!$max_flg) {
            $back_id = $notices[$notice_key-1]->id;
        }
        if (!$min_flg) {
            $next_id = $notices[$notice_key+1]->id;
        }

        return view('notice/show', [
            'notice' => $notice,
            'max_flg' => $max_flg,
            'min_flg' => $min_flg,
            'back_id' => $back_id,
            'next_id' => $next_id,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notice_list()
    {
        $notices = Notice::orderBy('updated_at', 'desc')->paginate(10);
        
        return view('admin.notice_list', [
            'notices' => $notices,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notice_list_update(Request $request)
    {
        $request = $request->all();
        $id = $request['id'];
        $release_flg = $request['release_flg'] == 1 ? 0 : 1;

        $notice = Notice::find($id);
        $notice->release_flg = $release_flg;
        $notice->timestamps = false;
        $notice->save();

        return redirect()->route('admin.notice_list')->with('message', 'test');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notice_regist()
    {
        return view('admin/notice_regist');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notice_store(Request $request)
    {
        $rules = [
            'title' => ['max:20', 'required'],
            'content' => 'required',
        ];

        $messages = [
            'title.max' => 'タイトルは20文字以下でお願いします',
            'title.required' => 'タイトルを入力してください',
            'content.required' => '内容を入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $notice = new Notice;

        $request = $request->all();
        $fill_data = [
            'title' => $request['title'],
            'content' => $request['content'],
            'notice_date' => date('Y/m/d'),
        ];

        DB::beginTransaction();
        try {
            $notice->fill($fill_data)->save();
            DB::commit();
            return redirect()->to('admin/notice_list')->with('message', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notice_edit($id)
    {
        $notice = Notice::find($id);

        return view('admin/notice_edit', [
            'notice' => $notice,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notice_update(Request $request)
    {
        $rules = [
            'title' => ['max:20', 'required'],
            'content' => 'required',
        ];

        $messages = [
            'title.max' => 'タイトルは20文字以下でお願いします',
            'title.required' => 'タイトルを入力してください',
            'content.required' => '内容を入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $request = $request->all();
        $notice = Notice::find($request['id']);

        $fill_data = [
            'title' => $request['title'],
            'content' => $request['content'],
            'notice_date' => date('Y/m/d'),
        ];

        DB::beginTransaction();
        try {
            $notice->update($fill_data);
            DB::commit();
            return redirect()->to('admin/notice_list')->with('message', 'お知らせの更新が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notice_delete($id)
    {
        DB::beginTransaction();
        try {
            Notice::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.notice_list')->with('message', 'お知らせ情報を削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

}
