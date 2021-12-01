<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Menu;

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
        $restaurant = Restaurant::find($id);
        $category = Category::find($restaurant->category_id);
        $recommend_menus = Menu::where('recommend_flg', 1)
            ->where('restaurant_id', $id)->take(4)->get();
        $restaurant_id = $id;

        return view('restaurant/recommend', [
            'restaurant' => $restaurant,
            'category' => $category,
            'recommend_menus' => $recommend_menus,
            'restaurant_id' => $restaurant_id,
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
        $menus = Menu::where('restaurant_id', $id)->paginate(12);
        $restaurant_id = $id;

        return view('restaurant/allmenu', [
            'restaurant' => $restaurant,
            'category' => $category,
            'menus' => $menus,
            'restaurant_id' => $restaurant_id,
        ]);
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
