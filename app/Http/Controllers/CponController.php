<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Notice;
use App\Models\Restaurant;

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
    public function search(Request $request)
    {
        $categories = Category::all();
        $freeword = $request->input('freeword');
        $restaurants = Restaurant::whereIn('id', function($q) use($freeword) {
            return $q->from('menus')
                ->select('restaurant_id')
                ->where('name', 'like', "%$freeword%")
                ->groupBy('restaurant_id');
            })
            ->orwhere('restaurants.name', 'like', "%$freeword%")
            ->paginate(24);

        return view('search', [
            'categories' => $categories,
            'restaurants' => $restaurants,
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
        $search_radio = null;

        if (isset($filter_array['search_radio'])) {
            $search_radio = $filter_array['search_radio'];
        }

        $freeword = $filter_array['freeword'];
        $open = $filter_array['open'];
        $close = $filter_array['close'];
        unset($filter_array['search_radio'], $filter_array['freeword'], $filter_array['open'], $filter_array['close']);
        
        $query = Restaurant::join('scenes', 'restaurants.id', '=', 'scenes.restaurant_id')
            ->join('commitments', 'restaurants.id', '=', 'commitments.restaurant_id');

        foreach ($filter_array as $key => $value) {
            $query->orWhere($key , 1);
        }

        if (!empty($freeword)) {
            $query->orWhereIn('restaurants.id', function($q) use($freeword) {
                return $q->from('menus')
                    ->select('restaurant_id')
                    ->where('name', 'like', "%$freeword%")
                    ->groupBy('restaurant_id');
                })
                ->orwhere('restaurants.name', 'like', "%$freeword%");    
        }

        if ($search_radio == 'open_only') {
            $query->whereTime('close_time', '>=', date("H:i:s"));
            $query->whereTime('open_time', '<=', date("H:i:s"));
        } 

        if ($open != 0) {
            $query->whereTime('close_time', '>=', $open - 1 . ':00');
        } 
        if ($close != 0) {
            $query->whereTime('open_time', '<=', $close - 1 . ':00');
        }

        $restaurants = $query->paginate(24);

        return view('search', [
            'categories' => $categories,
            'restaurants' => $restaurants,
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
        $news = Restaurant::where('new_flg', 1)->take(24)->get();

        return view('new', [
            'categories' => $categories,
            'news' => $news,
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
        $restaurants = Restaurant::where('category_id', $id)->paginate(24);

        return view('category', [
            'categories' => $categories,
            'restaurants' => $restaurants,
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
        //
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
