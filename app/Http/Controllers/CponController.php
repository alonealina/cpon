<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Notice;
use App\Models\Restaurant;
use App\Models\Comment;
use App\Models\Banner;
use App\Models\Scene;
use App\Models\Commitment;
use App\Models\RestaurantScene;
use App\Models\RestaurantCommitment;

class CponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $recommends = Restaurant::where('recommend_flg', 1)->where('release_flg', 1)->take(6)->get();
        $news = Restaurant::orderBy('created_at', 'desc')->where('release_flg', 1)->take(6)->get();
        $notices = Notice::orderBy('notice_date', 'desc')->orderBy('title', 'asc')->where('release_flg', 1)->take(5)->get();
        $banners = Banner::where('priority', '<>', '7')->orderBy('priority', 'asc')->take(6)->get();
        $scenes = Scene::all();
        $commitments = Commitment::all();

        return view('index', [
            'categories' => $categories,
            'recommends' => $recommends,
            'news' => $news,
            'notices' => $notices,
            'banners' => $banners,
            'scenes' => $scenes,
            'commitments' => $commitments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $categories = Category::all();
        $scenes = Scene::all();
        $commitments = Commitment::all();
        $freeword = $request->input('freeword');
        $restaurants = Restaurant::where(function ($query) use ($freeword) {
            $query->whereIn('restaurants.id', function($q) use($freeword) {
                return $q->from('menus')
                    ->select('restaurant_id')
                    ->where('name', 'like', "%$freeword%")
                    ->groupBy('restaurant_id');
                })
                ->orwhere('name1', 'like', "%$freeword%")->orwhere('name2', 'like', "%$freeword%")->orwhere('name3', 'like', "%$freeword%")
                ->orwhere('profile', 'like', "%$freeword%")->orwhere('zip', 'like', "%$freeword%")->orwhere('pref', 'like', "%$freeword%")
                ->orwhere('address', 'like', "%$freeword%")->orwhere('address_remarks', 'like', "%$freeword%")->orwhere('url', 'like', "%$freeword%")
                ->orwhere('tel', 'like', "%$freeword%")->orwhere('access', 'like', "%$freeword%")->orwhere('station1', 'like', "%$freeword%")
                ->orwhere('station2', 'like', "%$freeword%")->orwhere('station3', 'like', "%$freeword%")->orwhere('station4', 'like', "%$freeword%")
                ->orwhere('station5', 'like', "%$freeword%")->orwhere('route1', 'like', "%$freeword%")->orwhere('route2', 'like', "%$freeword%")
                ->orwhere('route3', 'like', "%$freeword%")->orwhere('route4', 'like', "%$freeword%")->orwhere('route5', 'like', "%$freeword%");
                })->where('release_flg', 1)
                ->paginate(24);

        return view('search', [
            'categories' => $categories,
            'restaurants' => $restaurants,
            'scenes' => $scenes,
            'commitments' => $commitments,
            'freeword' => $freeword,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search_sp()
    {
        $categories = Category::all();
        $scenes = Scene::all();
        $commitments = Commitment::all();

        return view('search_sp', [
            'categories' => $categories,
            'scenes' => $scenes,
            'commitments' => $commitments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $categories = Category::all();
        $filter_array = $request->all();
        $area = null;
        $open_only = null;
        $highly_rated = null;

        if (isset($filter_array['area'])) {
            $area = $filter_array['area'];
        }
        if (isset($filter_array['open_only'])) {
            $open_only = $filter_array['open_only'];
        }
        if (isset($filter_array['highly_rated'])) {
            $highly_rated = $filter_array['highly_rated'];
        }

        $freeword = $filter_array['freeword'];
        $category_id = $filter_array['category_id'];
        $open = $filter_array['open'];
        $close = $filter_array['close'];
        $pref = $filter_array['pref'];
        unset($filter_array['search_radio'], $filter_array['search_radio_ipad'], $filter_array['freeword'], $filter_array['open'], $filter_array['close'],
        $filter_array['pref'], $filter_array['area'], $filter_array['open_only'], $filter_array['highly_rated']);
        
        $query = Restaurant::where('release_flg', 1);

        if (!empty($freeword)) {
            $query->where(function ($query) use ($freeword) {
                $query->whereIn('restaurants.id', function($q) use($freeword) {
                    return $q->from('menus')
                        ->select('restaurant_id')
                        ->where('name', 'like', "%$freeword%")
                        ->groupBy('restaurant_id');
                    })
                    ->orwhere('name1', 'like', "%$freeword%")->orwhere('name2', 'like', "%$freeword%")->orwhere('name3', 'like', "%$freeword%")
                    ->orwhere('profile', 'like', "%$freeword%")->orwhere('zip', 'like', "%$freeword%")->orwhere('pref', 'like', "%$freeword%")
                    ->orwhere('address', 'like', "%$freeword%")->orwhere('address_remarks', 'like', "%$freeword%")->orwhere('url', 'like', "%$freeword%")
                    ->orwhere('tel', 'like', "%$freeword%")->orwhere('access', 'like', "%$freeword%")->orwhere('station1', 'like', "%$freeword%")
                    ->orwhere('station2', 'like', "%$freeword%")->orwhere('station3', 'like', "%$freeword%")->orwhere('station4', 'like', "%$freeword%")
                    ->orwhere('station5', 'like', "%$freeword%")->orwhere('route1', 'like', "%$freeword%")->orwhere('route2', 'like', "%$freeword%")
                    ->orwhere('route3', 'like', "%$freeword%")->orwhere('route4', 'like', "%$freeword%")->orwhere('route5', 'like', "%$freeword%");
                });
        }

        if (isset($request['scenes'])) {
            $restaurant_id_list_scene = array_column(Restaurant::get()->toArray(), 'id');
            foreach ($request['scenes'] as $key => $value) {
                $restaurant_scenes = array_column(RestaurantScene::where('scene_id', $key)->get()->toArray(), 'restaurant_id');
                $restaurant_id_list_scene = array_intersect($restaurant_id_list_scene, $restaurant_scenes);
            }
            $query->whereIn( 'restaurants.id', $restaurant_id_list_scene);
        }

        if (isset($request['commitments'])) {
            $restaurant_id_list_commitment = array_column(Restaurant::get()->toArray(), 'id');
            foreach ($request['commitments'] as $key => $value) {
                $restaurant_commitments = array_column(RestaurantCommitment::where('commitment_id', $key)->get()->toArray(), 'restaurant_id');
                $restaurant_id_list_commitment = array_intersect($restaurant_id_list_commitment, $restaurant_commitments);
            }
            $query->whereIn( 'restaurants.id', $restaurant_id_list_commitment);

        }

        if ($area == 'area') {
            $query->where('pref', $pref);
        } 
        if ($open_only == 'open_only') {
            $query->whereTime('close_time', '>=', date("H:i:s"));
            $query->whereTime('open_time', '<=', date("H:i:s"));
        }
        if ($highly_rated == 'highly_rated') {
            $avg_star_4 = Comment::selectRaw('restaurant_id, AVG(fivestar) as avg_star')
                ->groupBy('restaurant_id')
                ->having('avg_star', '>=', 4)->get();
            $id_list = [];
            foreach ($avg_star_4 as $value) {
                $id_list[] = $value->restaurant_id;
            }
            $query->WhereIn('restaurants.id', $id_list);
        } 

        if ($open != 0) {
            $query->whereTime('close_time', '>=', $open);
        } else {
            // フィルター検索値保持用
            $open = 'none';
        }
        if ($close != 0) {
            $query->whereTime('open_time', '<', $close);
        } else {
            // フィルター検索値保持用
            $close = 'none';
        }
        if ($category_id != '指定なし') {
            $query->where('category_id', $category_id);
        } else {
            // フィルター検索値保持用
            $category_id = '指定なし';
        }

        $restaurants = $query->paginate(24);

        $scenes = Scene::all();
        $commitments = Commitment::all();
        $filter_scenes = isset($request['scenes']) ? $request['scenes'] : null;
        $filter_commitments = isset($request['commitments']) ? $request['commitments'] : null;
        return view('search', [
            'categories' => $categories,
            'restaurants' => $restaurants,
            'scenes' => $scenes,
            'commitments' => $commitments,
            'freeword' => $freeword,
            'filter_freeword' => $freeword,
            'filter_pref' => $pref,
            'area' => $area,
            'open_only' => $open_only,
            'highly_rated' => $highly_rated,
            'filter_category_id' => $category_id,
            'filter_open' => $open,
            'filter_close' => $close,
            'filter_scenes' => $filter_scenes,
            'filter_commitments' => $filter_commitments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        $categories = Category::all();
        $day_30_ago = date("Y-m-d", strtotime("-30 day"));
        $news = Restaurant::where('release_flg', 1)->whereDate('created_at', '>=', $day_30_ago)->orderBy('created_at', 'desc')->paginate(12);
        $news_count = $news->total();
        if ($news_count <= 5) {
            $news = Restaurant::where('release_flg', 1)->orderBy('created_at', 'desc')->take(6)->get();
        }
        $scenes = Scene::all();
        $commitments = Commitment::all();
        return view('new', [
            'categories' => $categories,
            'news' => $news,
            'news_count' => $news_count,
            'scenes' => $scenes,
            'commitments' => $commitments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($id)
    {
        $categories = Category::all();
        $restaurants = Restaurant::where('release_flg', 1)->where('category_id', $id)->paginate(24);
        $category_name = Category::where('id', $id)->first()->name;

        $scenes = Scene::all();
        $commitments = Commitment::all();
        return view('category', [
            'categories' => $categories,
            'restaurants' => $restaurants,
            'category_name' => $category_name,
            'scenes' => $scenes,
            'commitments' => $commitments,
            'id' => $id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function help()
    {
        return view('help');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function policy()
    {
        return view('policy');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        return view('terms');
    }

}
