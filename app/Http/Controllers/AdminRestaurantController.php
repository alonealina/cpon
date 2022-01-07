<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Scene;
use App\Models\Commitment;
use App\Models\RestaurantScene;
use App\Models\RestaurantCommitment;
use App\Models\RestaurantHoliday;
use App\Models\RestaurantCard;
use App\Models\Menu;
use App\Rules\HolidayCheck;
use App\Rules\ZipCheck;
use App\Rules\PhoneCheck;
use App\Rules\AlphaNumCheck;
use App\Exceptions\LoginIdException;
use DB;

class AdminRestaurantController extends Controller
{
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
        $category_id = isset($filter_array['category_id']) ? $filter_array['category_id'] : null;
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

        $fivestar_before = $fivestar_before_old == 'none' || 'zero' ? 0 : $fivestar_before_old;
        $fivestar_after = $fivestar_after_old == 'none' ? 5 : $fivestar_after_old;
        $fivestar_after = $fivestar_after_old == 'zero' ? 0 : $fivestar_after;
        
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

        if (!empty($category_id) && $category_id != 'none') {
            $query->where('category_id', $category_id);
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

        $categories = Category::all();
        
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
            'category_id' => $category_id,
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
            'categories' => $categories,
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
        $restaurant_id = $request['restaurant_id'];
        $release_flg = isset($request['release_flg']) ? $request['release_flg'] : null;
        $recommend_flg = isset($request['recommend_flg']) ? $request['recommend_flg'] : null;
        $csv_type = isset($request['csv_type']) ? $request['csv_type'] : null;
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
        } elseif (isset($csv_type) && $csv_type == 'export') {
            return $this->restaurant_csv_export($restaurant_id);
        }
        return redirect('admin/restaurant_list')->with('message', '店舗情報を更新しました');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restaurant_csv_export($restaurant_id)
    {
        $restaurants = Restaurant::whereIn('id', $restaurant_id)->orderBy('login_id')->get();
        $cvsList[] = ['店舗ID', 'パスワード', '飾り文字前', '店舗名', '飾り文字後', '店舗紹介文', '都道府県', '郵便番号', '市区町村', '以降の住所',
        '開店時間', '閉店時間', 'カテゴリ', 'WEBページURL', 'TEL',
         '備考欄（営業時間）', 'オススメ店舗', '公開・非公開', 'CポンモールURL', '予算（昼）', '予算（夜）', '駅名1', '路線1', '駅名2', '路線2', 
        '駅名3', '路線3', '駅名4', '路線4', '駅名5', '路線5', 'アクセス', '駐車場', '電子マネー・その他', '席数', '禁煙・喫煙', 'その他', '作成日時', '更新日時', 
        '定休日', 'クレジットカード', '利用シーン', 'こだわり条件', 
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
    public function restaurant_csv_import(Request $request)
    {
        DB::beginTransaction();
        try {
        $fp = fopen($request->csv, 'r');
            while($data = fgetcsv($fp)){
                mb_convert_variables('UTF-8', 'SJIS-win', $data);
                if ($data[0] == '店舗ID') {
                    continue;
                }
                $fill_data = [
                    'login_id' => $data[0],
                    'password' => $data[1],
                    'name1' => $data[2],
                    'name2' => $data[3],
                    'name3' => $data[4],
                    'profile' => $data[5],
                    'pref' => $data[6],
                    'zip' => $data[7],
                    'address' => $data[8],
                    'address_remarks' => $data[9],
                    'open_time' => $data[10],
                    'close_time' => $data[11],
                    'category_id' => Category::where('name', $data[12])->first()->id,
                    'url' => $data[13],
                    'tel' => $data[14],
                    'time_remarks' => $data[15],
                    'cpon_mall_url' => $data[16],
                    'budget_lunch' => $data[17],
                    'budget_dinner' => $data[18],
                    'station1' => $data[19],
                    'route1' => $data[20],
                    'station2' => $data[21],
                    'route2' => $data[22],
                    'station3' => $data[23],
                    'route3' => $data[24],
                    'station4' => $data[25],
                    'route4' => $data[26],
                    'station5' => $data[27],
                    'route5' => $data[28],
                    'access' => $data[29],
                    'parking' => $data[30],
                    'e_money' => $data[31],
                    'seats' => $data[32],
                    'smoking' => $data[33],
                    'other' => $data[34],
                    'main_img' => '',
                ];

                $login_id_count = Restaurant::where('login_id', $data[0])->count();

                if ($login_id_count > 0) {
                    throw new LoginIdException($data[0]);
                }

                $restaurant = new Restaurant();
                $restaurant->fill($fill_data)->save();
                $restaurant_id = $restaurant->id;

                $fill_data_holiday = [
                'monday' => $data[35],
                'tuesday' => $data[36],
                'wednesday' => $data[37],
                'thursday' => $data[38],
                'friday' => $data[39],
                'saturday' => $data[40],
                'sunday' => $data[41],
                'restaurant_id' => $restaurant_id,
                ];
                $fill_data_holiday['none'] = in_array(1, $fill_data_holiday) ? 0 : 1;

                $fill_data_card = [
                    'visa' => $data[42],
                    'mastercard' => $data[43],
                    'jcb' => $data[44],
                    'diners' => $data[45],
                    'amex' => $data[46],
                    'other' => $data[47],
                    'restaurant_id' => $restaurant_id,
                ];
    
                $restaurant_holiday = new RestaurantHoliday();
                $restaurant_holiday->fill($fill_data_holiday)->save();

                $restaurant_card = new RestaurantCard();
                $restaurant_card->fill($fill_data_card)->save();
            }

            DB::commit();
            fclose($fp);
            return redirect()->to('admin/restaurant_list')->with('message', 'CSVインポートが完了いたしました。');
        } catch (LoginIdException $e) {
            DB::rollback();
            return redirect()->to('admin/restaurant_list')->with('message', $e->getMessage()); 
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->to('admin/restaurant_list')->with('message', 'CSVインポートに失敗しました。');
        }  
        fclose($fp);

        return;
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
            'login_id' => ['required', new AlphaNumCheck()],
            'pass' => ['required', 'between:8,12', new AlphaNumCheck()],
            'name2' => 'required',
            'profile' => 'required',
            'zip' => ['required', new ZipCheck()],
            'address' => 'required',
            'holidays' => new HolidayCheck($request['holidays']),
            'tel' => ['required', new PhoneCheck()],
            'main_img' => ['max:10240', 'required'],
            'sub_img' => 'max:10240',
        ];

        $messages = [
            'login_id.required' => '店舗IDを入力してください',
            'pass.required' => 'パスワードを入力してください',
            'pass.between' => 'パスワードは8～12文字で入力してください',
            'name2.required' => '店舗名を入力してください',
            'profile.required' => 'プロフィールを入力してください',
            'zip.required' => '郵便番号を入力してください',
            'address.required' => '住所を入力してください',
            'tel.required' => '電話番号を入力してください',
            'main_img.required' => 'メイン画像を選択してください',
            'main_img.max' => 'ファイルは10MB未満でお願いします',
            'sub_img.max' => 'ファイルは10MB未満でお願いします',
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
            'login_id' => $request['login_id'],
            'password' => $request['pass'],
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
            'cpon_mall_url' => $request['cpon_mall_url'],
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
            return redirect()->to('admin/restaurant_list')->with('message', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->to('admin/restaurant_regist')->withInput();
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
            'pass' => ['required', 'between:8,12', new AlphaNumCheck()],
            'name2' => 'required',
            'profile' => 'required',
            'zip' => 'required',
            'address' => 'required',
            'holidays' => new HolidayCheck($request['holidays']),
            'tel' => ['required', new PhoneCheck()],
            'main_img' => 'max:10240',
            'sub_img' => 'max:10240',
        ];

        if (session('type') == 'operation') {
            $rules['login_id'] = ['required', new AlphaNumCheck()];
        }

        $messages = [
            'login_id.required' => '店舗IDを入力してください',
            'pass.required' => 'パスワードを入力してください',
            'pass.between' => 'パスワードは8～12文字で入力してください',
            'name2.required' => '店舗名を入力してください',
            'profile.required' => 'プロフィールを入力してください',
            'zip.required' => '郵便番号を入力してください',
            'address.required' => '住所を入力してください',
            'tel.required' => '電話番号を入力してください',
            'main_img.max' => 'ファイルは10MB未満でお願いします',
            'sub_img.max' => 'ファイルは10MB未満でお願いします',
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
            'password' => $request['pass'],
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
            'cpon_mall_url' => $request['cpon_mall_url'],
            'other' => $request['other'],
        ];

        if (session('type') == 'operation') {
            $fill_data_restaurant['login_id'] = $request['login_id'];
        }

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
            if (session('type') == 'restaurant') {
                return redirect()->to('admin/')->with('message', '店舗情報の更新が完了いたしました。');
            } else {
                return redirect()->to('admin/restaurant_list')->with('message', '店舗情報の更新が完了いたしました。');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.restaurant_edit', ['id' => $restaurant_id])->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restaurant_delete($id)
    {
        DB::beginTransaction();
        try {
            Restaurant::where('id', $id)->delete();
            DB::commit();
            return redirect()->to('admin/restaurant_list')->with('message', '店舗情報を削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

}
