<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Restaurant;
use App\Models\Menu;
use DB;

class MenuController extends Controller
{
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
        $menu_id = $request['menu_id'];
        $release_flg = isset($request['release_flg']) ? $request['release_flg'] : null;
        $recommend_flg = isset($request['recommend_flg']) ? $request['recommend_flg'] : null;
        $csv_type = isset($request['csv_type']) ? $request['csv_type'] : null;
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
                $recommend_id_list = Menu::where('recommend_flg', $recommend_flg)->where('restaurant_id', $restaurant_id)
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
        } elseif (isset($csv_type) && $csv_type == 'export') {
            return $this->menu_csv_export($menu_id);
        }
        return redirect()->route('admin.menu_list', ['id' => $restaurant_id])->with('message', 'メニュー情報を更新しました');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu_csv_export($menu_id)
    {
        $menus = Menu::whereIn('id', $menu_id)->get();
        $cvsList[] = ['メニュー名', '値段', '説明文', '公開・非公開', 'イチオシメニュー', '作成日時', '更新日時', 
        ];
        foreach ($menus as $menu) {
            $cvsList[] = $menu->outputCsvContent();
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
    public function menu_csv_import(Request $request)
    {
        $restaurant_id = $request->restaurant_id;
        $fp = fopen($request->csv, 'r');
        
        DB::beginTransaction();
        try {
            while($data = fgetcsv($fp)){
                mb_convert_variables('UTF-8', 'SJIS-win', $data);
                if ($data[0] == 'メニュー名') {
                    continue;
                }
                $fill_data = [
                    'name' => $data[0],
                    'price' => $data[1],
                    'explain' => $data[2],
                    'restaurant_id' => $restaurant_id,
                ];

                $menu = new Menu();
                $menu->fill($fill_data)->save();
            }

            DB::commit();
            fclose($fp);
            return redirect()->to('admin/menu_list/'.$restaurant_id)->with('message', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }  
        fclose($fp);

        return;
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
            return redirect()->route('admin.menu_list', ['id' => $restaurant_id])->with('message', '登録が完了いたしました。');
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
            return redirect()->route('admin.menu_list', ['id' => $restaurant_id])->with('message', 'メニューの更新が完了いたしました。');
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
    public function menu_delete($restaurant_id, $menu_id)
    {
        DB::beginTransaction();
        try {
            Menu::where('restaurant_id', $restaurant_id)->where('id', $menu_id)->delete();
            DB::commit();
            return redirect()->route('admin.menu_list', ['id' => $restaurant_id])->with('message', 'メニュー情報を削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

}
