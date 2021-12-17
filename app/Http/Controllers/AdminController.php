<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Notice;
use App\Models\Restaurant;
use App\Models\Scene;
use App\Models\Commitment;
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
            'main_img' => ['max:10240', 'required'],
            'sub_img1' => 'max:10240',
            'sub_img2' => 'max:10240',
            'sub_img3' => 'max:10240',
            'sub_img4' => 'max:10240',
        ];

        $messages = [
            'name1.max' => '店舗名は20文字以下でお願いします',
            'name1.required' => '店舗名を入力してください',
            'profile.required' => 'プロフィールを入力してください',
            'zip.required' => '郵便番号を入力してください',
            'address.required' => '住所を入力してください',
            'main_img.required' => 'ファイルを選択してください',
            'main_img.max' => 'ファイルは10MB未満でお願いします',
            'sub_img1.max' => 'ファイルは10MB未満でお願いします',
            'sub_img2.max' => 'ファイルは10MB未満でお願いします',
            'sub_img3.max' => 'ファイルは10MB未満でお願いします',
            'sub_img4.max' => 'ファイルは10MB未満でお願いします',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $restaurant = new Restaurant;
        $scene = new Scene;
        $commitment = new Commitment;

        $main_img = $request->main_img;
        $main_img_name = 'main_' . $main_img->getClientOriginalName();

        if ($sub_img1 = $request->sub_img1) {
            $sub_img1_name = 'sub1_' . $sub_img1->getClientOriginalName();
        } else {
            $sub_img1_name = null;
        }

        if ($sub_img2 = $request->sub_img2) {
            $sub_img2_name = 'sub2_' . $sub_img2->getClientOriginalName();
        } else {
            $sub_img2_name = null;
        }

        if ($sub_img3 = $request->sub_img3) {
            $sub_img3_name = 'sub3_' . $sub_img3->getClientOriginalName();
        } else {
            $sub_img3_name = null;
        }

        if ($sub_img4 = $request->sub_img4) {
            $sub_img4_name = 'sub4_' . $sub_img4->getClientOriginalName();
        } else {
            $sub_img4_name = null;
        }

        $request = $request->all();
        $fill_data_restaurant = [
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
            'sub_img1' => $sub_img1_name,
            'sub_img2' => $sub_img2_name,
            'sub_img3' => $sub_img3_name,
            'sub_img4' => $sub_img4_name,
        ];

        $fill_data_scenes = [
            'one_person' => isset($request['one_person']) ? 1 : 0,
            'family' => isset($request['family']) ? 1 : 0,
            'with_friend' => isset($request['with_friend']) ? 1 : 0,
            'many_people' => isset($request['many_people']) ? 1 : 0,
            'kitty_party' => isset($request['kitty_party']) ? 1 : 0,
            'dating' => isset($request['dating']) ? 1 : 0,
            'joint_party' => isset($request['joint_party']) ? 1 : 0,
            'reception' => isset($request['reception']) ? 1 : 0,
        ];

        $fill_data_commitments = [
            'all_eat' => isset($request['all_eat']) ? 1 : 0,
            'all_drink' => isset($request['all_drink']) ? 1 : 0,
            'private_room' => isset($request['private_room']) ? 1 : 0,
            'net_booking' => isset($request['net_booking']) ? 1 : 0,
            'stylish' => isset($request['stylish']) ? 1 : 0,
            'sofa' => isset($request['sofa']) ? 1 : 0,
            'smoking' => isset($request['smoking']) ? 1 : 0,
            'no_smoking' => isset($request['no_smoking']) ? 1 : 0,
            'reserved' => isset($request['reserved']) ? 1 : 0,
            'morning' => isset($request['morning']) ? 1 : 0,
            'lunch' => isset($request['lunch']) ? 1 : 0,
            'dinner' => isset($request['dinner']) ? 1 : 0,
            'clean_scenery' => isset($request['clean_scenery']) ? 1 : 0,
            'card' => isset($request['card']) ? 1 : 0,
            'celebration' => isset($request['celebration']) ? 1 : 0,
            'take_out' => isset($request['take_out']) ? 1 : 0,
            'bring_in' => isset($request['bring_in']) ? 1 : 0,
            'karaoke' => isset($request['karaoke']) ? 1 : 0,
        ];

        DB::beginTransaction();
        try {
            $restaurant->fill($fill_data_restaurant)->save();
            $restaurant_id = $restaurant->id;
            $fill_data_scenes['restaurant_id'] = $restaurant_id;
            $fill_data_commitments['restaurant_id'] = $restaurant_id;
            $scene->fill($fill_data_scenes)->save();
            $commitment->fill($fill_data_commitments)->save();

            $target_path = public_path('restaurant/'. $restaurant_id . '/');
            $main_img->move($target_path, $main_img_name);
            if ($sub_img1) {
                $sub_img1->move($target_path, $sub_img1_name);
            }
            if ($sub_img2) {
                $sub_img2->move($target_path, $sub_img2_name);
            }
            if ($sub_img3) {
                $sub_img3->move($target_path, $sub_img3_name);
            }
            if ($sub_img4) {
                $sub_img4->move($target_path, $sub_img4_name);
            }
            DB::commit();
            return redirect()->to('admin/restaurant_regist')->with('flashmessage', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
