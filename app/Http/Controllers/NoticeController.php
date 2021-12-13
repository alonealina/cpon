<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::orderBy('notice_date', 'desc')->orderBy('id', 'desc')->paginate(10);

        return view('notice/index', [
            'notices' => $notices,
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
        $notice = Notice::find($id);
        $max_flg = false;
        $min_flg = false;
        $max_notice = Notice::orderBy('notice_date', 'desc')->orderBy('id', 'desc')->first();
        $min_notice = Notice::orderBy('notice_date', 'asc')->orderBy('id', 'asc')->first();
        if ($id == $max_notice->id) {
            $max_flg = true;
        }
        if ($id == $min_notice->id) {
            $min_flg = true;
        }

        $notices = Notice::orderBy('notice_date', 'desc')->orderBy('id', 'desc')->get();
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
