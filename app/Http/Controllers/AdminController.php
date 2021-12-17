<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Notice;
use App\Models\Restaurant;
use App\Models\Comment;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $recommends = Restaurant::where('recommend_flg', 1)->take(6)->get();
        $news = Restaurant::where('new_flg', 1)->take(6)->get();
        $notices = Notice::orderBy('notice_date', 'desc')->take(5)->get();

        return view('index', [
            'categories' => $categories,
            'recommends' => $recommends,
            'news' => $news,
            'notices' => $notices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restaurant_regist()
    {
        $categories = Category::all();

        return view('admin/restaurant_regist', [
            'categories' => $categories,
        ]);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restaurant_store(Request $request)
    {
        $rules = [
            'name1' => ['max:20', 'required'],
            'profile' => 'required',
            'zip' => 'required',
            'address' => 'required',
            'url' => 'required',
            'tel' => 'required',
            'main_img' => 'max:10240'
        ];

        $messages = [
            'name1.max' => '店舗名は20文字以下でお願いします',
            'name1.required' => '店舗名を入力してください',
            'profile.required' => 'プロフィールを入力してください',
            'zip.required' => '郵便番号を入力してください',
            'address.required' => '住所を入力してください',
            'url.required' => 'URLを入力してください',
            'tel.required' => 'TELを入力してください',
            'main_img.max' => 'ファイルは10MB未満でお願いします',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $restaurant = new Restaurant;

        // if ($file = $request->main_img) {
        //     $fileName = time() . $file->getClientOriginalName();
        //     $target_path = public_path('restaurant/');
        //     $file->move($target_path, $fileName);
        // } else {
        //     $fileName = "";
        // }

        if ($main_img = $request->main_img) {
            $main_img_name = time() . $main_img->getClientOriginalName();
        } else {
            $main_img_name = "";
        }

        $request = $request->all();
        $fill_data = [
            'name1' => $request['name1'],
            'name2' => $request['name2'],
            'name3' => $request['name3'],
            'profile' => $request['profile'],
            'pref' => $request['pref'],
            'zip' => $request['zip'],
            'address' => $request['address'],
            'address_remarks' => $request['address_remarks'],
            'open_time' => $request['open_time'],
            'close_time' => $request['close_time'],
            'time_remarks' => $request['time_remarks'],
            'category_id' => $request['category_id'],
            'url' => $request['url'],
            'tel' => $request['tel'],
            'inquiry_remarks' => $request['inquiry_remarks'],
            'recommend_flg' => isset($request['recommend_flg']) ? 1 : 0,
            'new_flg' => isset($request['new_flg']) ? 1 : 0,
            'main_img' => $main_img_name,
            'sub_img1' => null,
        ];

        DB::beginTransaction();
        try {
            $restaurant->fill($fill_data)->save();
            $restaurant_id = $restaurant->id;
            $target_path = public_path('restaurant/'. $restaurant_id . '/');
            $main_img->move($target_path, $main_img_name);
            DB::commit();
            return redirect()->to('admin/restaurant_regist')->with('flashmessage', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
