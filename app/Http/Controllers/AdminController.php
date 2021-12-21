<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
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
        $notices = Notice::orderBy('notice_date', 'desc')->take(5)->get();

        return view('layouts.app_admin', [
            'categories' => $categories,
            'recommends' => $recommends,
            'notices' => $notices,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restaurant_list(Request $request)
    {
        $query = Restaurant::select('*');
        $filter_array = $request->all();
        $name = isset($filter_array['name']) ? $filter_array['name'] : null;
        $id = isset($filter_array['id']) ? $filter_array['id'] : null;
        $zip = isset($filter_array['zip']) ? $filter_array['zip'] : null;
        $pref = isset($filter_array['pref']) ? $filter_array['pref'] : null;
        $address = isset($filter_array['address']) ? $filter_array['address'] : null;
        $tel = isset($filter_array['tel']) ? $filter_array['tel'] : null;
        $open = isset($filter_array['open']) ? $filter_array['open'] : null;
        $close = isset($filter_array['close']) ? $filter_array['close'] : null;
        $fivestar_before_old = isset($filter_array['fivestar_before']) ? $filter_array['fivestar_before'] : null;
        $fivestar_after_old = isset($filter_array['fivestar_after']) ? $filter_array['fivestar_after'] : null;
        $created_year_before = isset($filter_array['created_year_before']) ? $filter_array['created_year_before'] : null;
        $created_month_before = isset($filter_array['created_month_before']) ? $filter_array['created_month_before'] : null;
        $created_day_before = isset($filter_array['created_day_before']) ? $filter_array['created_day_before'] : null;
        $created_year_after = isset($filter_array['created_year_after']) ? $filter_array['created_year_after'] : null;
        $created_month_after = isset($filter_array['created_month_after']) ? $filter_array['created_month_after'] : null;
        $created_day_after = isset($filter_array['created_day_after']) ? $filter_array['created_day_after'] : null;
        $updated_year_before = isset($filter_array['updated_year_before']) ? $filter_array['updated_year_before'] : null;
        $updated_month_before = isset($filter_array['updated_month_before']) ? $filter_array['updated_month_before'] : null;
        $updated_day_before = isset($filter_array['updated_day_before']) ? $filter_array['updated_day_before'] : null;
        $updated_year_after = isset($filter_array['updated_year_after']) ? $filter_array['updated_year_after'] : null;
        $updated_month_after = isset($filter_array['updated_month_after']) ? $filter_array['updated_month_after'] : null;
        $updated_day_after = isset($filter_array['updated_day_after']) ? $filter_array['updated_day_after'] : null;

        $fivestar_before = $fivestar_before_old == 'none' ? 0 : $fivestar_before_old;
        $fivestar_after = $fivestar_after_old == 'none' ? 5 : $fivestar_after_old;

        if (!empty($name)) {
            $query->where(function ($query) use ($name) {
                $query->orwhere('name1', 'like', "%$name%")->orwhere('name1', 'like', "%$name%")->orwhere('name1', 'like', "%$name%");
            });
        }

        if (!empty($id)) {
            $query->where('id', 'like', "%$id%");
        }

        if (!empty($zip)) {
            $query->where('zip', $zip);
        }

        if (!empty($pref)) {
            $query->where('pref', $pref);
        }

        if (!empty($address)) {
            $query->where('address', 'like', "%$address%");
        }

        if (!empty($tel)) {
            $query->where('tel', $tel);
        }

        if ($open != 0) {
            $query->whereTime('close_time', '>=', $open);
        }
        if ($close != 0) {
            $query->whereTime('open_time', '<=', $close);
        }

        if (!empty($created_year_before) && !empty($created_month_before) && !empty($created_day_before)) {
            $created_before = $created_year_before . '-' . $created_month_before . '-' . $created_day_before;
            $query->whereDate('created_at', '>=', $created_before);
        }
        if (!empty($created_year_after) && !empty($created_month_after) && !empty($created_day_after)) {
            $created_after = $created_year_after . '-' . $created_month_after . '-' . $created_day_after;
            $query->whereDate('created_at', '<=', $created_after);
        }
        if (!empty($updated_year_before) && !empty($updated_month_before) && !empty($updated_day_before)) {
            $updated_before = $updated_year_before . '-' . $updated_month_before . '-' . $updated_day_before;
            $query->whereDate('updated_at', '>=', $updated_before);
        }
        if (!empty($updated_year_after) && !empty($updated_month_after) && !empty($updated_day_after)) {
            $updated_after = $updated_year_after . '-' . $updated_month_after . '-' . $updated_day_after;
            $query->whereDate('updated_at', '<=', $updated_after);
        }

        if (!is_null($fivestar_before) && !is_null($fivestar_after)){
            $tmp = Restaurant::all();
            $id_list = [];
            foreach ($tmp as $tmp) {
                if ($tmp->avg_star >= $fivestar_before && $tmp->avg_star <= $fivestar_after) {
                    $id_list[] = $tmp->id;
                }
            }
            $query->WhereIn('restaurants.id', $id_list);
        }

        $restaurants = $query->orderBy('id')->paginate(10);

        return view('admin.restaurant_list', [
            'restaurants' => $restaurants,
            'name' => $name,
            'id' => $id,
            'zip' => $zip,
            'pref' => $pref,
            'address' => $address,
            'tel' => $tel,
            'open' => $open,
            'close' => $close,
            'fivestar_before_old' => $fivestar_before_old,
            'fivestar_after_old' => $fivestar_after_old,
            'created_year_before' => $created_year_before,
            'created_month_before' => $created_month_before,
            'created_day_before' => $created_day_before,
            'created_year_after' => $created_year_after,
            'created_month_after' => $created_month_after,
            'created_day_after' => $created_day_after,
            'updated_year_before' => $updated_year_before,
            'updated_month_before' => $updated_month_before,
            'updated_day_before' => $updated_day_before,
            'updated_year_after' => $updated_year_after,
            'updated_month_after' => $updated_month_after,
            'updated_day_after' => $updated_day_after,
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restaurant_edit($id)
    {
        $categories = Category::all();
        $restaurant = Restaurant::find($id);
        $scene = Scene::where('restaurant_id', $id)->first();
        $commitment = Commitment::where('restaurant_id', $id)->first();

        return view('admin/restaurant_edit', [
            'categories' => $categories,
            'restaurant' => $restaurant,
            'scene' => $scene,
            'commitment' => $commitment,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restaurant_update(Request $request)
    {
        $rules = [
            'name1' => ['max:20', 'required'],
            'profile' => 'required',
            'zip' => 'required',
            'address' => 'required',
            'main_img' => 'max:10240',
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
            'main_img.max' => 'ファイルは10MB未満でお願いします',
            'sub_img1.max' => 'ファイルは10MB未満でお願いします',
            'sub_img2.max' => 'ファイルは10MB未満でお願いします',
            'sub_img3.max' => 'ファイルは10MB未満でお願いします',
            'sub_img4.max' => 'ファイルは10MB未満でお願いします',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        if ($main_img = $request->main_img) {
            $main_img_name = 'main_' . $main_img->getClientOriginalName();
        } else {
            $main_img_name = null;
        }

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
        ];

        if (isset($main_img_name)) {
            $fill_data_restaurant['main_img'] = $main_img_name;
        }
        if (isset($sub_img1_name)) {
            $fill_data_restaurant['sub_img1'] = $sub_img1_name;
        }
        if (isset($sub_img2_name)) {
            $fill_data_restaurant['sub_img2'] = $sub_img2_name;
        }
        if (isset($sub_img3_name)) {
            $fill_data_restaurant['sub_img3'] = $sub_img3_name;
        }
        if (isset($sub_img4_name)) {
            $fill_data_restaurant['sub_img4'] = $sub_img4_name;
        }

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
        $restaurant_id = $request['restaurant_id'];
        $restaurant = Restaurant::find($restaurant_id);
        $scene = Scene::where('restaurant_id', $restaurant_id)->first();
        $commitment = Commitment::where('restaurant_id', $restaurant_id)->first();
        $old_main_img = $restaurant->main_img;
        $old_sub_img1 = $restaurant->sub_img1;
        $old_sub_img2 = $restaurant->sub_img2;
        $old_sub_img3 = $restaurant->sub_img3;
        $old_sub_img4 = $restaurant->sub_img4;
        DB::beginTransaction();
        try {
            $restaurant->update($fill_data_restaurant);
            $scene->update($fill_data_scenes);
            $commitment->update($fill_data_commitments);

            $target_path = public_path('restaurant/'. $restaurant_id . '/');

            if ($main_img) {
                if(file_exists($target_path . $old_main_img)){
                    unlink($target_path . $old_main_img);
                }
                $main_img->move($target_path, $main_img_name);
            }
            if ($sub_img1) {
                if($old_sub_img1 && file_exists($target_path . $old_sub_img1)){
                    unlink($target_path . $old_sub_img1);
                }
                $sub_img1->move($target_path, $sub_img1_name);
            }
            if ($sub_img2) {
                if($old_sub_img2 && file_exists($target_path . $old_sub_img2)){
                    unlink($target_path . $old_sub_img2);
                }
                $sub_img2->move($target_path, $sub_img2_name);
            }
            if ($sub_img3) {
                if($old_sub_img3 && file_exists($target_path . $old_sub_img3)){
                    unlink($target_path . $old_sub_img3);
                }
                $sub_img3->move($target_path, $sub_img3_name);
            }
            if ($sub_img4) {
                if($old_sub_img4 && file_exists($target_path . $old_sub_img4)){
                    unlink($target_path . $old_sub_img4);
                }
                $sub_img4->move($target_path, $sub_img4_name);
            }
            DB::commit();
            return redirect()->to('admin/restaurant_regist')->with('flashmessage', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restaurant_csv_export()
    {
        $restaurants = Restaurant::get();
        $cvsList[] = ['ID', '名前1', '名前2', '名前3', '店舗プロフィール', '都道府県', '郵便番号', '住所', '開店時間', '閉店時間', 'カテゴリー', 'URL', 'TEL',
        '備考（住所）', '備考（営業時間）', '備考（お問合せ）', 'メイン画像', 'サブ画像1', 'サブ画像2', 'サブ画像3', 'サブ画像4', '作成日時', '更新日時', 
        ];
        foreach ($restaurants as $restaurant) {
            $cvsList[] = $restaurant->outputCsvContent();
        }

        $response = new StreamedResponse (function() use ($cvsList){
            $stream = fopen('php://output', 'w');

            //　文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            // CSVデータ
            foreach($cvsList as $key => $value) {
                fputcsv($stream, $value);
            }
            $buffer = str_replace("\n", "\r\n", stream_get_contents($stream));
            fclose($stream);
            //出力ストリーム
            $fp = fopen('php://output', 'w+b');
            //さっき置換した内容を出力 
            fwrite($fp, $buffer);
        
            fclose($fp);
        });
        
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="sample.csv"');
 
        return $response;
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
            'title' => ['max:50', 'required'],
            'content' => 'required',
            'notice_date' => 'required',
        ];

        $messages = [
            'title.max' => 'タイトルは20文字以下でお願いします',
            'title.required' => 'タイトルを入力してください',
            'content.required' => '本文を入力してください',
            'notice_date.required' => 'お知らせ日時を入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $notice = new Notice;

        $request = $request->all();
        $fill_data = [
            'title' => $request['title'],
            'content' => $request['content'],
            'notice_date' => $request['notice_date'],
        ];

        DB::beginTransaction();
        try {
            $notice->fill($fill_data)->save();
            DB::commit();
            return redirect()->to('admin/notice_regist')->with('flashmessage', '登録が完了いたしました。');
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
            'title' => ['max:50', 'required'],
            'content' => 'required',
            'notice_date' => 'required',
        ];

        $messages = [
            'title.max' => 'タイトルは20文字以下でお願いします',
            'title.required' => 'タイトルを入力してください',
            'content.required' => '本文を入力してください',
            'notice_date.required' => 'お知らせ日時を入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $request = $request->all();
        $notice = Notice::find($request['id']);

        $fill_data = [
            'title' => $request['title'],
            'content' => $request['content'],
            'notice_date' => $request['notice_date'],
        ];

        DB::beginTransaction();
        try {
            $notice->update($fill_data);
            DB::commit();
            return redirect()->to('admin/notice_regist')->with('flashmessage', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
