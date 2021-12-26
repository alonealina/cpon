<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Scene;
use App\Models\Commitment;
use App\Rules\SceneCheck;
use App\Rules\CommitmentCheck;
use DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting_list()
    {
        $scenes = Scene::orderBy('id')->get();
        $commitments = Commitment::orderBy('id')->get();
        return view('admin.setting_list', [
            'scenes' => $scenes,
            'commitments' => $commitments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scene_regist()
    {
        return view('admin/scene_regist');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function scene_store(Request $request)
    {
        $rules = [
            'name' => ['max:20', 'required', new SceneCheck(0)],
        ];

        $messages = [
            'name.max' => 'タイトルは20文字以下でお願いします',
            'name.required' => 'タイトルを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $scene = new Scene();

        $request = $request->all();
        $fill_data = [
            'name' => $request['name'],
        ];

        DB::beginTransaction();
        try {
            $scene->fill($fill_data)->save();
            DB::commit();
            return redirect()->to('admin/setting_list')->with('flashmessage', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scene_edit($id)
    {
        $scene = Scene::find($id);

        return view('admin/scene_edit', [
            'scene' => $scene,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function scene_update(Request $request)
    {
        $rules = [
            'name' => ['max:20', 'required', new SceneCheck($request['id'])],
        ];

        $messages = [
            'name.max' => 'タイトルは20文字以下でお願いします',
            'name.required' => 'タイトルを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $request = $request->all();
        $scene = Scene::find($request['id']);

        $fill_data = [
            'name' => $request['name'],
        ];

        DB::beginTransaction();
        try {
            $scene->update($fill_data);
            DB::commit();
            return redirect()->to('admin/setting_list')->with('flashmessage', 'お知らせの更新が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commitment_regist()
    {
        return view('admin/commitment_regist');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function commitment_store(Request $request)
    {
        $rules = [
            'name' => ['max:20', 'required', new CommitmentCheck(0)],
        ];

        $messages = [
            'name.max' => 'タイトルは20文字以下でお願いします',
            'name.required' => 'タイトルを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $commitment = new Commitment();

        $request = $request->all();
        $fill_data = [
            'name' => $request['name'],
        ];

        DB::beginTransaction();
        try {
            $commitment->fill($fill_data)->save();
            DB::commit();
            return redirect()->to('admin/setting_list')->with('flashmessage', '登録が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commitment_edit($id)
    {
        $commitment = Commitment::find($id);

        return view('admin/commitment_edit', [
            'commitment' => $commitment,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function commitment_update(Request $request)
    {
        $rules = [
            'name' => ['max:20', 'required', new CommitmentCheck($request['id'])],
        ];

        $messages = [
            'name.max' => 'タイトルは20文字以下でお願いします',
            'name.required' => 'タイトルを入力してください',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $request = $request->all();
        $commitment = Commitment::find($request['id']);

        $fill_data = [
            'name' => $request['name'],
        ];

        DB::beginTransaction();
        try {
            $commitment->update($fill_data);
            DB::commit();
            return redirect()->to('admin/setting_list')->with('flashmessage', 'お知らせの更新が完了いたしました。');
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

}
