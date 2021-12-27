<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Comment;
use DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comment_list($restaurant_id, Request $request)
    {
        /////////////////////////////////////////
        // 運営・該当店舗以外アクセス拒否する処理
        /////////////////////////////////////////

        $query = Comment::where('restaurant_id', $restaurant_id);
        $filter_array = $request->all();
        $user_name = isset($filter_array['user_name']) ? $filter_array['user_name'] : null;
        $fivestar_before_old = isset($filter_array['fivestar_before']) ? $filter_array['fivestar_before'] : null;
        $fivestar_after_old = isset($filter_array['fivestar_after']) ? $filter_array['fivestar_after'] : null;
        $created_year_before = isset($filter_array['created_year_before']) ? $filter_array['created_year_before'] : null;
        $created_month_before = isset($filter_array['created_month_before']) ? $filter_array['created_month_before'] : null;
        $created_day_before = isset($filter_array['created_day_before']) ? $filter_array['created_day_before'] : null;
        $created_year_after = isset($filter_array['created_year_after']) ? $filter_array['created_year_after'] : null;
        $created_month_after = isset($filter_array['created_month_after']) ? $filter_array['created_month_after'] : null;
        $created_day_after = isset($filter_array['created_day_after']) ? $filter_array['created_day_after'] : null;

        $fivestar_before = $fivestar_before_old == 'none' || 'zero' ? 0 : $fivestar_before_old;
        $fivestar_after = $fivestar_after_old == 'none' ? 5 : $fivestar_after_old;
        $fivestar_after = $fivestar_after_old == 'zero' ? 0 : $fivestar_after;
        if (!empty($user_name)) {
            $query->where('user_name', 'like', "%$user_name%");
        }

        if (!empty($created_year_before) && !empty($created_month_before) && !empty($created_day_before)) {
            $created_before = $created_year_before . '-' . $created_month_before . '-' . $created_day_before;
            $query->whereDate('created_at', '>=', $created_before);
        }
        if (!empty($created_year_after) && !empty($created_month_after) && !empty($created_day_after)) {
            $created_after = $created_year_after . '-' . $created_month_after . '-' . $created_day_after;
            $query->whereDate('created_at', '<=', $created_after);
        }

        if (!is_null($fivestar_before) && !is_null($fivestar_after)){
            $query->where('fivestar', '>=', $fivestar_before);
            $query->where('fivestar', '<=', $fivestar_after);    
        }

        $number = \Request::get('number');
        if (isset($number)) {
            $comments = $query->orderBy('id')->paginate($number)
            ->appends(["number" => $number]);
        } else {
            $number = isset($filter_array['number']) ? $filter_array['number'] : 10;
            $comments = $query->orderBy('id')->paginate($number);
        }

        return view('admin.comment_list', [
            'comments' => $comments,
            'number' => $number,
            'user_name' => $user_name,
            'fivestar_before_old' => $fivestar_before_old,
            'fivestar_after_old' => $fivestar_after_old,
            'created_year_before' => $created_year_before,
            'created_month_before' => $created_month_before,
            'created_day_before' => $created_day_before,
            'created_year_after' => $created_year_after,
            'created_month_after' => $created_month_after,
            'created_day_after' => $created_day_after,
            'restaurant_id' => $restaurant_id,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comment_list_update(Request $request)
    {
        $request = $request->all();
        $chk_list = isset($request['chk']) ? $request['chk'] : null;
        $restaurant_id = $request['restaurant_id'];

            foreach ($chk_list as $chk) {
                Comment::where('id', $chk)
                    ->where('restaurant_id', $restaurant_id)
                    ->delete();
            }
        return redirect()->route('admin.comment_list', ['id' => $restaurant_id])->with('message', 'test');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comment_detail($restaurant_id, $comment_id)
    {
        $comment = Comment::find($comment_id);
        return view('admin/comment_detail', [
            'comment' => $comment,
            'restaurant_id' => $restaurant_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comment_delete($restaurant_id, $menu_id)
    {
        DB::beginTransaction();
        try {
            Comment::where('restaurant_id', $restaurant_id)->where('id', $menu_id)->delete();
            DB::commit();
            return redirect()->route('admin.comment_list', ['id' => $restaurant_id])->with('flashmessage', 'クチコミ情報を削除しました');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

}
