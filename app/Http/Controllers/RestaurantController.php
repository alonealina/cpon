<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Comment;
use App\Models\Scene;
use App\Models\Commitment;
use App\Models\RestaurantScene;
use App\Models\RestaurantCommitment;
use App\Models\RestaurantHoliday;
use DB;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        $category = Category::find($restaurant->category_id);
        $recommend_menus = Menu::where('recommend_flg', 1)
            ->where('restaurant_id', $id)->take(8)->get();
        $comments = Comment::where('restaurant_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        $column = \Request::get('column');
        $sort = \Request::get('sort');
        if (isset($column)) {
            $comments = Comment::where('restaurant_id', $id)->orderBy($column, $sort)->paginate(5)
            ->appends(["column" => $column, "sort" => $sort]);
        }
        $avg_star = Comment::where('restaurant_id', $id)
            ->selectRaw('CAST(AVG(fivestar) AS DECIMAL(2,1)) AS star_avg')->first()->star_avg;
        $restaurant_id = $id;

        $restaurant_scenes = array_column(RestaurantScene::join('scenes', 'scenes.id', '=', 'restaurant_scenes.scene_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_commitments = array_column(RestaurantCommitment::join('commitments', 'commitments.id', '=', 'restaurant_commitments.commitment_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_holidays = $this->output_holiday_array(RestaurantHoliday::where('restaurant_id', $id)->first()->toArray());
        $restaurant_stations = $this->output_station_array($restaurant->station1, $restaurant->route1, $restaurant->station2, $restaurant->route2, 
            $restaurant->station3, $restaurant->route3, $restaurant->station4, $restaurant->route4, $restaurant->station5, $restaurant->route5);

        return view('restaurant/recommend', [
            'restaurant' => $restaurant,
            'category' => $category,
            'recommend_menus' => $recommend_menus,
            'comments' => $comments,
            'avg_star' => $avg_star,
            'restaurant_id' => $restaurant_id,
            'column' => $column,
            'sort' => $sort,
            'restaurant_scenes' => $restaurant_scenes,
            'restaurant_commitments' => $restaurant_commitments,
            'restaurant_holidays' => $restaurant_holidays,
            'restaurant_stations' => $restaurant_stations,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_allmenu($id)
    {
        $restaurant = Restaurant::find($id);
        $category = Category::find($restaurant->category_id);
        $menus = Menu::where('restaurant_id', $id)->paginate(12, ["*"], 'menupage')
            ->appends(["commentpage" => \Request::get('commentpage')]);
        $comments = Comment::where('restaurant_id', $id)->paginate(5, ["*"], 'commentpage')
            ->appends(["menupage" => \Request::get('menupage')]);
        $column = \Request::get('column');
        $sort = \Request::get('sort');
        $menupage = \Request::get('menupage');
        if (isset($column)) {
            $menus = Menu::where('restaurant_id', $id)->paginate(12, ["*"], 'menupage')
            ->appends(["column" => $column, "sort" => $sort, "commentpage" => \Request::get('commentpage')]);
            $comments = Comment::where('restaurant_id', $id)->orderBy($column, $sort)->paginate(5, ["*"], 'commentpage')
            ->appends(["column" => $column, "sort" => $sort, "menupage" => \Request::get('menupage')]);
        }
        $avg_star = Comment::where('restaurant_id', $id)
            ->selectRaw('CAST(AVG(fivestar) AS DECIMAL(2,1)) AS star_avg')->first()->star_avg;
        $restaurant_id = $id;

        $restaurant_scenes = array_column(RestaurantScene::join('scenes', 'scenes.id', '=', 'restaurant_scenes.scene_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_commitments = array_column(RestaurantCommitment::join('commitments', 'commitments.id', '=', 'restaurant_commitments.commitment_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_holidays = $this->output_holiday_array(RestaurantHoliday::where('restaurant_id', $id)->first()->toArray());

        return view('restaurant/allmenu', [
            'restaurant' => $restaurant,
            'category' => $category,
            'menus' => $menus,
            'comments' => $comments,
            'avg_star' => $avg_star,
            'restaurant_id' => $restaurant_id,
            'column' => $column,
            'sort' => $sort,
            'menupage' => $menupage,
            'restaurant_scenes' => $restaurant_scenes,
            'restaurant_commitments' => $restaurant_commitments,
            'restaurant_holidays' => $restaurant_holidays,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $restaurant = Restaurant::find($id);
        $category = Category::find($restaurant->category_id);
        $comments = Comment::where('restaurant_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        $avg_star = Comment::where('restaurant_id', $id)
        ->selectRaw('CAST(AVG(fivestar) AS DECIMAL(2,1)) AS star_avg')->first()->star_avg;
        $restaurant_id = $id;

        $restaurant_scenes = array_column(RestaurantScene::join('scenes', 'scenes.id', '=', 'restaurant_scenes.scene_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_commitments = array_column(RestaurantCommitment::join('commitments', 'commitments.id', '=', 'restaurant_commitments.commitment_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_holidays = $this->output_holiday_array(RestaurantHoliday::where('restaurant_id', $id)->first()->toArray());

        return view('restaurant/detail', [
            'restaurant' => $restaurant,
            'category' => $category,
            'comments' => $comments,
            'avg_star' => $avg_star,
            'restaurant_id' => $restaurant_id,
            'restaurant_scenes' => $restaurant_scenes,
            'restaurant_commitments' => $restaurant_commitments,
            'restaurant_holidays' => $restaurant_holidays,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment_list_sp($id)
    {
        $restaurant = Restaurant::find($id);
        $comments = Comment::where('restaurant_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        $column = \Request::get('column');
        $sort = \Request::get('sort');
        if (isset($column)) {
            $comments = Comment::where('restaurant_id', $id)->orderBy($column, $sort)->paginate(5)
            ->appends(["column" => $column, "sort" => $sort]);
        }
        $restaurant_id = $id;

        $restaurant_scenes = array_column(RestaurantScene::join('scenes', 'scenes.id', '=', 'restaurant_scenes.scene_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_commitments = array_column(RestaurantCommitment::join('commitments', 'commitments.id', '=', 'restaurant_commitments.commitment_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_holidays = $this->output_holiday_array(RestaurantHoliday::where('restaurant_id', $id)->first()->toArray());

        return view('restaurant/comment_list_sp', [
            'restaurant' => $restaurant,
            'comments' => $comments,
            'restaurant_id' => $restaurant_id,
            'column' => $column,
            'sort' => $sort,
            'restaurant_scenes' => $restaurant_scenes,
            'restaurant_commitments' => $restaurant_commitments,
            'restaurant_holidays' => $restaurant_holidays,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment_form($id)
    {
        $restaurant = Restaurant::find($id);
        $category = Category::find($restaurant->category_id);
        $comments = Comment::where('restaurant_id', $id)->paginate(5);
        $avg_star = Comment::where('restaurant_id', $id)
            ->selectRaw('CAST(AVG(fivestar) AS DECIMAL(2,1)) AS star_avg')->first()->star_avg;
        $restaurant_id = $id;

        $restaurant_scenes = array_column(RestaurantScene::join('scenes', 'scenes.id', '=', 'restaurant_scenes.scene_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_commitments = array_column(RestaurantCommitment::join('commitments', 'commitments.id', '=', 'restaurant_commitments.commitment_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_holidays = $this->output_holiday_array(RestaurantHoliday::where('restaurant_id', $id)->first()->toArray());

        return view('restaurant/comment_form', [
            'restaurant' => $restaurant,
            'category' => $category,
            'comments' => $comments,
            'avg_star' => $avg_star,
            'restaurant_id' => $restaurant_id,
            'restaurant_scenes' => $restaurant_scenes,
            'restaurant_commitments' => $restaurant_commitments,
            'restaurant_holidays' => $restaurant_holidays,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment_form_sp($id)
    {
        $restaurant = Restaurant::find($id);
        $category = Category::find($restaurant->category_id);
        $comments = Comment::where('restaurant_id', $id)->paginate(5);
        $avg_star = Comment::where('restaurant_id', $id)
            ->selectRaw('CAST(AVG(fivestar) AS DECIMAL(2,1)) AS star_avg')->first()->star_avg;
        $restaurant_id = $id;

        $restaurant_scenes = array_column(RestaurantScene::join('scenes', 'scenes.id', '=', 'restaurant_scenes.scene_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_commitments = array_column(RestaurantCommitment::join('commitments', 'commitments.id', '=', 'restaurant_commitments.commitment_id')
            ->where('restaurant_id', $id)->get()->toArray(), 'name');
        $restaurant_holidays = $this->output_holiday_array(RestaurantHoliday::where('restaurant_id', $id)->first()->toArray());

        return view('restaurant/comment_form_sp', [
            'restaurant' => $restaurant,
            'category' => $category,
            'comments' => $comments,
            'avg_star' => $avg_star,
            'restaurant_id' => $restaurant_id,
            'restaurant_scenes' => $restaurant_scenes,
            'restaurant_commitments' => $restaurant_commitments,
            'restaurant_holidays' => $restaurant_holidays,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comment_store(Request $request)
    {
        $rules = [
            'user_name' => ['max:20', 'required'],
            'fivestar' => 'required',
            'comment' => 'required',
            'comment_img' => 'max:10240'
        ];

        $messages = [
            'user_name.max' => 'お名前は20文字以下でお願いします',
            'user_name.required' => 'お名前を入力してください',
            'fivestar.required' => '評価を選択してください',
            'comment.required' => 'コメントを入力してください',
            'comment_img.max' => 'ファイルは10MB未満でお願いします',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $comment = new Comment;

        if ($file = $request->comment_img) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('uploads/');
            $file->move($target_path, $fileName);
        } else {
            $fileName = "";
        }

        $request = $request->all();
        $fill_data = [
            'restaurant_id' => $request['restaurant_id'],
            'user_name' => $request['user_name'],
            'fivestar' => $request['fivestar'],
            'comment' => $request['comment'],
            'filename' => $fileName,
            'user_id' => 1
        ];

        DB::beginTransaction();
        try {
            $comment->fill($fill_data)->save();
            DB::commit();
            if ($request['sp_flg']) {
                return redirect()->to('restaurants/'.$request['restaurant_id'].'/comment_sp')->with('flashmessage', '登録が完了いたしました。');
            } else {
                return redirect()->to('restaurants/'.$request['restaurant_id'].'/comment')->with('flashmessage', '登録が完了いたしました。');
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
    }


    private function output_holiday_array($array)
    {
        $tmp_array = [];
        if ($array['monday'] == 1) {
            $tmp_array[] = '月曜日';
        }
        if ($array['tuesday'] == 1) {
            $tmp_array[] = '火曜日';
        }
        if ($array['wednesday'] == 1) {
            $tmp_array[] = '水曜日';
        }
        if ($array['thursday'] == 1) {
            $tmp_array[] = '木曜日';
        }
        if ($array['friday'] == 1) {
            $tmp_array[] = '金曜日';
        }
        if ($array['saturday'] == 1) {
            $tmp_array[] = '土曜日';
        }
        if ($array['sunday'] == 1) {
            $tmp_array[] = '日曜日';
        }
        if ($array['none'] == 1) {
            $tmp_array[] = '定休日なし';
        }

        return implode("・", $tmp_array);
    }

    private function output_station_array($station1, $route1, $station2, $route2, $station3, $route3, $station4, $route4, $station5, $route5)
    {
        $tmp_array = [];
        if (!empty($station1)) {
            $tmp_str = $station1;
            if (!empty($route1)) {
                $tmp_str .= '（' . $route1 . '）';
            }
            $tmp_array[] = $tmp_str;
        }

        if (!empty($station2)) {
            $tmp_str = $station2;
            if (!empty($route2)) {
                $tmp_str .= '（' . $route2 . '）';
            }
            $tmp_array[] = $tmp_str;
        }

        if (!empty($station3)) {
            $tmp_str = $station3;
            if (!empty($route3)) {
                $tmp_str .= '（' . $route3 . '）';
            }
            $tmp_array[] = $tmp_str;
        }

        if (!empty($station4)) {
            $tmp_str = $station4;
            if (!empty($route4)) {
                $tmp_str .= '（' . $route4 . '）';
            }
            $tmp_array[] = $tmp_str;
        }

        if (!empty($station5)) {
            $tmp_str = $station5;
            if (!empty($route5)) {
                $tmp_str .= '（' . $route5 . '）';
            }
            $tmp_array[] = $tmp_str;
        }

        return implode("、", $tmp_array);
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
