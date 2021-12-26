<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Banner;
use App\Rules\PriorityCheck;
use DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banner_list()
    {
        $banners = Banner::orderBy('priority')->get();
        
        return view('admin.banner_list', [
            'banners' => $banners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banner_regist()
    {
        return view('admin/banner_regist');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function banner_store(Request $request)
    {
        $rules = [
            'img' => ['max:10240', 'required'],
            'url' => 'required',
            'priority' => new PriorityCheck(0),
        ];

        $messages = [
            'img.required' => 'ファイルを選択してください',
            'img.max' => 'ファイルは10MB未満でお願いします',
            'url.required' => 'URLを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $img = $request->img;
        $img_name = 'banner_' . time() . $img->getClientOriginalName();

        $banner = new Banner;

        $request = $request->all();
        $fill_data = [
            'img' => $img_name,
            'url' => $request['url'],
            'priority' => $request['priority'],
        ];

        DB::beginTransaction();
        try {
            $banner->fill($fill_data)->save();
            $target_path = public_path('banner/');
            $img->move($target_path, $img_name);

            DB::commit();
            return redirect()->to('admin/banner_list')->with('flashmessage', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banner_edit($id)
    {
        $banner = Banner::find($id);

        return view('admin/banner_edit', [
            'banner' => $banner,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function banner_update(Request $request)
    {
        $rules = [
            'img' => 'max:10240',
            'url' => 'required',
            'priority' => new PriorityCheck($request['id']),
        ];

        $messages = [
            'img.max' => 'ファイルは10MB未満でお願いします',
            'url.required' => 'URLを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        if ($img = $request->img) {
            $img_name = 'banner_' . time() . $img->getClientOriginalName();
        } else {
            $img_name = null;
        }

        $banner = Banner::find($request['id']);
        $old_img = $banner->img;
        $request = $request->all();

        $fill_data = [
            'url' => $request['url'],
            'priority' => $request['priority'],
        ];

        if (isset($img_name)) {
            $fill_data['img'] = $img_name;
        }

        DB::beginTransaction();
        try {
            $banner->update($fill_data);

            $target_path = public_path('banner/');
            if ($img_name) {
                if(file_exists($target_path . $old_img)){
                    unlink($target_path . $old_img);
                }
                $img->move($target_path, $img_name);
            }

            DB::commit();
            return redirect()->to('admin/banner_list')->with('flashmessage', '画像の更新が完了いたしました。');
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
    public function banner_delete($id)
    {
        DB::beginTransaction();
        try {
            Banner::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.banner_list')->with('flashmessage', 'バナー情報を削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

}
