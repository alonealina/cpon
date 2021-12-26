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
use App\Models\RestaurantScene;
use App\Models\RestaurantCommitment;
use App\Models\RestaurantHoliday;
use App\Models\RestaurantCard;
use App\Models\AdminUser;
use App\Models\Banner;
use App\Models\Menu;
use App\Rules\PriorityCheck;
use DB;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $user = Restaurant::where('login_id', $request->login_id)->first();
        if (isset($user)) {
            if ($request->password == $user->password) {
                // セッション
                session(['login_id' => $user->login_id]);
                session(['id' => $user->id]);
                session(['name'  => $user->name2]);
                session(['type'  => 'restaurant']);
                return redirect('admin/'); 
            }
        }

        $admin_user = AdminUser::where('login_id', $request->login_id)->first();
        if (isset($admin_user)) {
            if ($request->password == $admin_user->password) {
                // セッション
                session(['login_id' => $admin_user->login_id]);
                session(['name'  => $admin_user->name]);
                session(['type'  => 'operation']);
                return redirect('admin/'); 
            }
        }

        return view('admin/login', ['login_error' => '1']);
    }
    
    public function logout(Request $request)
    {
        session()->forget('name');
        session()->forget('email');
        return redirect('admin/login');
    }

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
        $login_id = isset($filter_array['login_id']) ? $filter_array['login_id'] : null;
        $zip = isset($filter_array['zip']) ? $filter_array['zip'] : null;
        $pref = isset($filter_array['pref']) ? $filter_array['pref'] : null;
        $address1 = isset($filter_array['address1']) ? $filter_array['address1'] : null;
        $address2 = isset($filter_array['address2']) ? $filter_array['address2'] : null;
        $tel = isset($filter_array['tel']) ? $filter_array['tel'] : null;
        $open = isset($filter_array['open']) ? $filter_array['open'] : null;
        $close = isset($filter_array['close']) ? $filter_array['close'] : null;
        $fivestar_before_old = isset($filter_array['fivestar_before']) ? $filter_array['fivestar_before'] : null;
        $fivestar_after_old = isset($filter_array['fivestar_after']) ? $filter_array['fivestar_after'] : null;
        $status = isset($filter_array['status']) ? $filter_array['status'] : null;
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
                $query->orwhere('name1', 'like', "%$name%")->orwhere('name2', 'like', "%$name%")->orwhere('name3', 'like', "%$name%");
            });
        }

        if (!empty($login_id)) {
            $query->where('login_id', 'like', "%$login_id%");
        }

        if (!empty($zip)) {
            $query->where('zip', $zip);
        }

        if (!empty($pref)) {
            $query->where('pref', $pref);
        }

        if (!empty($address1)) {
            $query->where('address', 'like', "%$address1%");
        }

        if (!empty($address2)) {
            $query->where('address', 'like', "%$address2%");
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

        if ($status == 'release') {
            $query->where('release_flg', 1);
        } elseif ($status == 'no_release') {
            $query->where('release_flg', 0);
        } elseif ($status == 'recommend') {
            $query->where('recommend_flg', 1);
        }

        $number = \Request::get('number');
        if (isset($number)) {
            $restaurants = $query->orderBy('login_id')->paginate($number)
            ->appends(["number" => $number]);
        } else {
            $restaurants = $query->orderBy('login_id')->paginate(10);
        }

        
        return view('admin.restaurant_list', [
            'restaurants' => $restaurants,
            'number' => $number,
            'name' => $name,
            'login_id' => $login_id,
            'zip' => $zip,
            'pref' => $pref,
            'address1' => $address1,
            'address2' => $address2,
            'tel' => $tel,
            'open' => $open,
            'close' => $close,
            'fivestar_before_old' => $fivestar_before_old,
            'fivestar_after_old' => $fivestar_after_old,
            'status' => $status,
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restaurant_list_update(Request $request)
    {
        $request = $request->all();
        $chk_list = isset($request['chk']) ? $request['chk'] : null;
        $release_flg = isset($request['release_flg']) ? $request['release_flg'] : null;
        $recommend_flg = isset($request['recommend_flg']) ? $request['recommend_flg'] : null;

        if (isset($release_flg) && !empty($chk_list)) {
            foreach ($chk_list as $chk) {
                Restaurant::where('id', $chk)
                    ->update(['release_flg' => $release_flg]);
            }
        } elseif (isset($recommend_flg) && !empty($chk_list)) {
            if ($recommend_flg == 0) {
                foreach ($chk_list as $chk) {
                    Restaurant::where('id', $chk)
                        ->update(['recommend_flg' => $recommend_flg]);
                }
            } else {
                $recommend_id_list = Restaurant::where('recommend_flg', $recommend_flg)
                ->get()->pluck('id')->toArray();
                $count_array = array_merge($recommend_id_list, $chk_list);
                $count_array = array_unique($count_array);
                if (count($count_array) <= 6) {
                    foreach ($chk_list as $chk) {
                        Restaurant::where('id', $chk)
                            ->update(['recommend_flg' => $recommend_flg]);
                    }    
                } else {
                    return redirect('admin/restaurant_list')->with('message', 'おすすめ店舗は6店舗まででお願いします');
                }
            }
        }
        return redirect('admin/restaurant_list')->with('message', 'test');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restaurant_regist()
    {
        $categories = Category::all();
        $scenes = Scene::all();
        $commitments = Commitment::all();

        return view('admin/restaurant_regist', [
            'categories' => $categories,
            'scenes' => $scenes,
            'commitments' => $commitments,
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

        $main_img = $request->main_img;
        $main_img_name = 'main_' . $main_img->getClientOriginalName();

        $filename_array = [];
        $file_count = 1;
        if ($file_array = $request->sub_img) {
            foreach ($file_array as $file) {
                $filename_array['sub_img' . $file_count] = 'sub' . $file_count . time() . $file->getClientOriginalName();
                $file_count++;
            }
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
            'recommend_flg' => isset($request['recommend_flg']) ? 1 : 0,
            'budget_lunch' => $request['budget_lunch'],
            'budget_dinner' => $request['budget_dinner'],
            'station1' => $request['station1'],
            'route1' => $request['route1'],
            'station2' => $request['station2'],
            'route2' => $request['route2'],
            'station3' => $request['station3'],
            'route3' => $request['route3'],
            'station4' => $request['station4'],
            'route4' => $request['route4'],
            'station5' => $request['station5'],
            'route5' => $request['route5'],
            'access' => $request['access'],
            'parking' => $request['parking'],
            'e_money' => $request['e_money'],
            'seats' => $request['seats'],
            'smoking' => $request['smoking'],
            'other' => $request['other'],
            'main_img' => $main_img_name,
        ];
        foreach ($filename_array as $key => $value) {
            $fill_data_restaurant = array_merge($fill_data_restaurant, [$key => $value]);
        }

        $holidays = $request['holidays'];
        $fill_data_holiday = [];
        foreach ($holidays as $key => $value) {
            $fill_data_holiday = array_merge($fill_data_holiday, [$key => $value]);
        }
        $cards = $request['cards'];
        $fill_data_card = [];
        foreach ($cards as $key => $value) {
            $fill_data_card = array_merge($fill_data_card, [$key => $value]);
        }
        DB::beginTransaction();
        try {
            $restaurant->fill($fill_data_restaurant)->save();
            $restaurant_id = $restaurant->id;

            if (isset($request['scenes'])) {
                foreach ($request['scenes'] as $key => $value) {
                    $restaurant_scene = new RestaurantScene;
                    $restaurant_scene->fill([
                        'restaurant_id' => $restaurant_id,
                        'scene_id' => $key,
                        ])->save();
                }
            }

            if (isset($request['commitments'])) {
                foreach ($request['commitments'] as $key => $value) {
                    $restaurant_commitment = new RestaurantCommitment;
                    $restaurant_commitment->fill([
                        'restaurant_id' => $restaurant_id,
                        'commitment_id' => $key,
                        ])->save();
                }
            }

            $fill_data_holiday = array_merge($fill_data_holiday, ['restaurant_id' => $restaurant_id]);
            $restaurant_holiday = new RestaurantHoliday();
            $restaurant_holiday->fill($fill_data_holiday)->save();

            $fill_data_card = array_merge($fill_data_card, ['restaurant_id' => $restaurant_id]);
            $restaurant_card = new RestaurantCard();
            $restaurant_card->fill($fill_data_card)->save();

            $target_path = public_path('restaurant/'. $restaurant_id . '/');
            $main_img->move($target_path, $main_img_name);

            $file_count = 1;
            if (!empty($file_array)) {
                foreach ($file_array as $file) {
                    $file->move($target_path, $filename_array['sub_img' . $file_count]);
                    $file_count++;
                }
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
        /////////////////////////////////////////
        // 運営・該当店舗以外アクセス拒否する処理
        /////////////////////////////////////////


        $categories = Category::all();
        $restaurant = Restaurant::find($id);
        $scenes = Scene::all();
        $commitments = Commitment::all();
        $holidays = RestaurantHoliday::where('restaurant_id', $id)->first()->toArray();
        $cards = RestaurantCard::where('restaurant_id', $id)->first()->toArray();

        $restaurant_scenes = array_column(RestaurantScene::where('restaurant_id', $id)->get()->toArray(), 'scene_id');
        $restaurant_commitments = array_column(RestaurantCommitment::where('restaurant_id', $id)->get()->toArray(), 'commitment_id');

        return view('admin/restaurant_edit', [
            'categories' => $categories,
            'restaurant' => $restaurant,
            'scenes' => $scenes,
            'commitments' => $commitments,
            'holidays' => $holidays,
            'cards' => $cards,
            'restaurant_scenes' => $restaurant_scenes,
            'restaurant_commitments' => $restaurant_commitments,
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

        $filename_array = [];
        $file_count = 1;
        if ($file_array = $request->sub_img) {
            foreach ($file_array as $file) {
                $filename_array['sub_img' . $file_count] = 'sub' . $file_count . time() . $file->getClientOriginalName();
                $file_count++;
            }
            for ($file_count; $file_count <= 8; $file_count++) {
                $filename_array['sub_img' . $file_count] = null;
            }
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
            'recommend_flg' => isset($request['recommend_flg']) ? 1 : 0,
            'budget_lunch' => $request['budget_lunch'],
            'budget_dinner' => $request['budget_dinner'],
            'station1' => $request['station1'],
            'route1' => $request['route1'],
            'station2' => $request['station2'],
            'route2' => $request['route2'],
            'station3' => $request['station3'],
            'route3' => $request['route3'],
            'station4' => $request['station4'],
            'route4' => $request['route4'],
            'station5' => $request['station5'],
            'route5' => $request['route5'],
            'access' => $request['access'],
            'parking' => $request['parking'],
            'e_money' => $request['e_money'],
            'seats' => $request['seats'],
            'smoking' => $request['smoking'],
            'other' => $request['other'],
        ];

        if (isset($main_img_name)) {
            $fill_data_restaurant['main_img'] = $main_img_name;
        }
        foreach ($filename_array as $key => $value) {
            $fill_data_restaurant = array_merge($fill_data_restaurant, [$key => $value]);
        }

        $restaurant_id = $request['restaurant_id'];
        $restaurant = Restaurant::find($restaurant_id);
        $old_main_img = $restaurant->main_img;
        $old_sub_img1 = $restaurant->sub_img1;
        $old_sub_img2 = $restaurant->sub_img2;
        $old_sub_img3 = $restaurant->sub_img3;
        $old_sub_img4 = $restaurant->sub_img4;
        $old_sub_img5 = $restaurant->sub_img5;
        $old_sub_img6 = $restaurant->sub_img6;
        $old_sub_img7 = $restaurant->sub_img7;
        $old_sub_img8 = $restaurant->sub_img8;

        $holidays = $request['holidays'];
        $fill_data_holiday = [];
        foreach ($holidays as $key => $value) {
            $fill_data_holiday = array_merge($fill_data_holiday, [$key => $value]);
        }
        $cards = $request['cards'];
        $fill_data_card = [];
        foreach ($cards as $key => $value) {
            $fill_data_card = array_merge($fill_data_card, [$key => $value]);
        }
        DB::beginTransaction();
        try {
            $restaurant->update($fill_data_restaurant);

            RestaurantScene::where('restaurant_id', $restaurant_id)->delete();
            if (isset($request['scenes'])) {
                foreach ($request['scenes'] as $key => $value) {
                    $restaurant_scene = new RestaurantScene;
                    $restaurant_scene->fill([
                        'restaurant_id' => $restaurant_id,
                        'scene_id' => $key,
                        ])->save();
                }
            }

            RestaurantCommitment::where('restaurant_id', $restaurant_id)->delete();
            if (isset($request['commitments'])) {
                foreach ($request['commitments'] as $key => $value) {
                    $restaurant_commitment = new RestaurantCommitment;
                    $restaurant_commitment->fill([
                        'restaurant_id' => $restaurant_id,
                        'commitment_id' => $key,
                        ])->save();
                }
            }

            $fill_data_holiday = array_merge($fill_data_holiday, ['restaurant_id' => $restaurant_id]);
            $restaurant_holiday = RestaurantHoliday::where('restaurant_id', $restaurant_id)->first();
            $restaurant_holiday->update($fill_data_holiday);

            $fill_data_card = array_merge($fill_data_card, ['restaurant_id' => $restaurant_id]);
            $restaurant_card = RestaurantCard::where('restaurant_id', $restaurant_id)->first();
            $restaurant_card->update($fill_data_card);

            $target_path = public_path('restaurant/'. $restaurant_id . '/');

            if ($main_img) {
                if(file_exists($target_path . $old_main_img)){
                    unlink($target_path . $old_main_img);
                }
                $main_img->move($target_path, $main_img_name);
            }

            if (!empty($file_array)){
                if ($old_sub_img1) {
                    if($old_sub_img1 && file_exists($target_path . $old_sub_img1)){
                        unlink($target_path . $old_sub_img1);
                    }
                }
                if ($old_sub_img2) {
                    if($old_sub_img2 && file_exists($target_path . $old_sub_img2)){
                        unlink($target_path . $old_sub_img2);
                    }
                }
                if ($old_sub_img3) {
                    if($old_sub_img3 && file_exists($target_path . $old_sub_img3)){
                        unlink($target_path . $old_sub_img3);
                    }
                }
                if ($old_sub_img4) {
                    if($old_sub_img4 && file_exists($target_path . $old_sub_img4)){
                        unlink($target_path . $old_sub_img4);
                    }
                }
                if ($old_sub_img5) {
                    if($old_sub_img5 && file_exists($target_path . $old_sub_img5)){
                        unlink($target_path . $old_sub_img5);
                    }
                }
                if ($old_sub_img6) {
                    if($old_sub_img6 && file_exists($target_path . $old_sub_img6)){
                        unlink($target_path . $old_sub_img6);
                    }
                }
                if ($old_sub_img7) {
                    if($old_sub_img7 && file_exists($target_path . $old_sub_img7)){
                        unlink($target_path . $old_sub_img7);
                    }
                }
                if ($old_sub_img8) {
                    if($old_sub_img8 && file_exists($target_path . $old_sub_img8)){
                        unlink($target_path . $old_sub_img8);
                    }
                }
                $file_count = 1;
                foreach ($file_array as $file) {
                    $file->move($target_path, $filename_array['sub_img' . $file_count]);
                    $file_count++;
                }
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu_list($restaurant_id, Request $request)
    {
        /////////////////////////////////////////
        // 運営・該当店舗以外アクセス拒否する処理
        /////////////////////////////////////////

        $query = Menu::where('restaurant_id', $restaurant_id);
        $filter_array = $request->all();
        $name = isset($filter_array['name']) ? $filter_array['name'] : null;
        $price_before = isset($filter_array['price_before']) ? $filter_array['price_before'] : null;
        $price_after = isset($filter_array['price_after']) ? $filter_array['price_after'] : null;
        $status = isset($filter_array['status']) ? $filter_array['status'] : null;
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

        if (!empty($name)) {
            $query->where('name', 'like', "%$name%");
        }

        if (!empty($price_before)) {
            $query->where('price', '>=', $price_before);
        }

        if (!empty($price_after)) {
            $query->where('price', '<=', $price_after);
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

        if ($status == 'release') {
            $query->where('release_flg', 1);
        } elseif ($status == 'no_release') {
            $query->where('release_flg', 0);
        } elseif ($status == 'recommend') {
            $query->where('recommend_flg', 1);
        }

        $number = \Request::get('number');
        if (isset($number)) {
            $menus = $query->orderBy('id')->paginate($number)
            ->appends(["number" => $number]);
        } else {
            $number = isset($filter_array['number']) ? $filter_array['number'] : 10;
            $menus = $query->orderBy('id')->paginate($number);
        }

        $restaurant_name = Restaurant::where('id', $restaurant_id)->first()->name2;
        return view('admin.menu_list', [
            'menus' => $menus,
            'number' => $number,
            'name' => $name,
            'price_before' => $price_before,
            'price_after' => $price_after,
            'status' => $status,
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
            'restaurant_id' => $restaurant_id,
            'restaurant_name' => $restaurant_name,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu_list_update(Request $request)
    {
        $request = $request->all();
        $chk_list = isset($request['chk']) ? $request['chk'] : null;
        $release_flg = isset($request['release_flg']) ? $request['release_flg'] : null;
        $recommend_flg = isset($request['recommend_flg']) ? $request['recommend_flg'] : null;
        $restaurant_id = $request['restaurant_id'];

        if (isset($release_flg) && !empty($chk_list)) {
            foreach ($chk_list as $chk) {
                Menu::where('id', $chk)
                    ->where('restaurant_id', $restaurant_id)
                    ->update(['release_flg' => $release_flg]);
            }
        } elseif (isset($recommend_flg) && !empty($chk_list)) {
            if ($recommend_flg == 0) {
                foreach ($chk_list as $chk) {
                    Menu::where('id', $chk)
                        ->where('restaurant_id', $restaurant_id)
                        ->update(['recommend_flg' => $recommend_flg]);
                }
            } else {
                $recommend_id_list = Menu::where('recommend_flg', $recommend_flg)
                ->get()->pluck('id')->toArray();
                $count_array = array_merge($recommend_id_list, $chk_list);
                $count_array = array_unique($count_array);
                if (count($count_array) <= 12) {
                    foreach ($chk_list as $chk) {
                        Menu::where('id', $chk)
                            ->where('restaurant_id', $restaurant_id)
                            ->update(['recommend_flg' => $recommend_flg]);
                    }    
                } else {
                    return redirect()->route('admin.menu_list', ['id' => $restaurant_id])->with('message', 'イチオシメニューは12個まででお願いします');
                }
            }
        }
        return redirect()->route('admin.menu_list', ['id' => $restaurant_id])->with('message', 'test');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu_regist($id)
    {
        $restaurant_id = $id;

        return view('admin/menu_regist', [
            'restaurant_id' => $restaurant_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function menu_store(Request $request)
    {
        $rules = [
            'name' => ['max:20', 'required'],
            'price' => ['integer', 'required'],
            'explain' => 'max:30',
            'img' => 'max:10240',
        ];

        $messages = [
            'name.max' => 'メニュー名は20文字以下でお願いします',
            'name.required' => 'メニュー名を入力してください',
            'price.integer' => '数値を入力してください',
            'price.required' => '値段を入力してください',
            'explain.max' => '説明文は30文字以下でお願いします',
            'img.max' => 'ファイルは10MB未満でお願いします',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $menu = new Menu;

        if ($img = $request->img) {
            $img_name = 'menu_' . time() . $img->getClientOriginalName();
        } else {
            $img_name = null;
        }

        $restaurant_id = $request['restaurant_id'];

        $request = $request->all();
        $fill_data_menu = [
            'name' => $request['name'],
            'price' => $request['price'],
            'explain' => $request['explain'],
            'img' => $img_name,
            'restaurant_id' => $restaurant_id,
        ];

        DB::beginTransaction();
        try {
            $menu->fill($fill_data_menu)->save();

            if ($img_name) {
                $target_path = public_path('restaurant/'. $restaurant_id . '/menu/');
                $img->move($target_path, $img_name);    
            }

            DB::commit();
            return redirect()->route('admin.menu_list', ['id' => $restaurant_id])->with('flashmessage', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu_edit($restaurant_id, $menu_id)
    {
        /////////////////////////////////////////
        // 運営・該当店舗以外アクセス拒否する処理
        /////////////////////////////////////////


        $menu = Menu::where('restaurant_id', $restaurant_id)->where('id', $menu_id)->first();

        return view('admin/menu_edit', [
            'menu' => $menu,
            'restaurant_id' => $restaurant_id,
            'menu_id' => $menu_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function menu_update(Request $request)
    {
        $rules = [
            'name' => ['max:20', 'required'],
            'price' => ['integer', 'required'],
            'explain' => 'max:30',
            'img' => 'max:10240',
        ];

        $messages = [
            'name.max' => 'メニュー名は20文字以下でお願いします',
            'name.required' => 'メニュー名を入力してください',
            'price.integer' => '数値を入力してください',
            'price.required' => '値段を入力してください',
            'explain.max' => '説明文は30文字以下でお願いします',
            'img.max' => 'ファイルは10MB未満でお願いします',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        if ($img = $request->img) {
            $img_name = 'menu_' . time() . $img->getClientOriginalName();
        } else {
            $img_name = null;
        }

        $request = $request->all();
        $fill_data_menu = [
            'name' => $request['name'],
            'price' => $request['price'],
            'explain' => $request['explain'],
        ];

        if (isset($img_name)) {
            $fill_data_menu['img'] = $img_name;
        }

        $restaurant_id = $request['restaurant_id'];
        $menu_id = $request['menu_id'];
        
        $menu = Menu::find($menu_id);
        $old_img = $menu->img;

        DB::beginTransaction();
        try {
            $menu->update($fill_data_menu);

            $target_path = public_path('restaurant/'. $restaurant_id . '/menu/');

            if ($img && $old_img) {
                if(file_exists($target_path . $old_img)){
                    unlink($target_path . $old_img);
                }
                $img->move($target_path, $img_name);
            }

            DB::commit();
            return redirect()->route('admin.menu_list', ['id' => $restaurant_id])->with('flashmessage', 'メニューの更新が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
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
            'content.required' => '本文を入力してください',
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
            return redirect()->to('admin/notice_list')->with('flashmessage', '登録が完了いたしました。');
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
            'content.required' => '本文を入力してください',
            'notice_date.required' => 'お知らせ日時を入力してください',
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
            return redirect()->to('admin/notice_list')->with('flashmessage', 'お知らせの更新が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

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
}
