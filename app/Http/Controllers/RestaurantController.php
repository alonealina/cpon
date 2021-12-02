<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Comment;
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
        $comments = Comment::where('restaurant_id', $id)->paginate(5);
        $avg_star = Comment::where('restaurant_id', $id)
            ->selectRaw('CAST(AVG(fivestar) AS DECIMAL(2,1)) AS star_avg')->first()->star_avg;
        $restaurant_id = $id;

        return view('restaurant/recommend', [
            'restaurant' => $restaurant,
            'category' => $category,
            'recommend_menus' => $recommend_menus,
            'comments' => $comments,
            'avg_star' => $avg_star,
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
        $comments = Comment::where('restaurant_id', $id)->paginate(5);
        $avg_star = Comment::where('restaurant_id', $id)
            ->selectRaw('CAST(AVG(fivestar) AS DECIMAL(2,1)) AS star_avg')->first()->star_avg;
        $restaurant_id = $id;

        return view('restaurant/allmenu', [
            'restaurant' => $restaurant,
            'category' => $category,
            'menus' => $menus,
            'comments' => $comments,
            'avg_star' => $avg_star,
            'restaurant_id' => $restaurant_id,
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

        return view('restaurant/comment_form', [
            'restaurant' => $restaurant,
            'category' => $category,
            'comments' => $comments,
            'avg_star' => $avg_star,
            'restaurant_id' => $restaurant_id,
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
        $comment = new Comment;
        $request = $request->all();
        $fill_data = [
            'restaurant_id' => $request['restaurant_id'],
            'fivestar' => $request['fivestar'],
            'comment' => $request['comment'],
            'user_id' => 1
            
        ];
        DB::beginTransaction();
        try {
            $comment->fill($fill_data)->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
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
