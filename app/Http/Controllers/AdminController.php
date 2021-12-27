<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Category;
use App\Models\Notice;
use App\Models\Restaurant;
use App\Models\AdminUser;
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
                session(['id' => 'admin']);
                session(['name'  => $admin_user->name]);
                session(['type'  => 'operation']);
                return redirect('admin/'); 
            }
        }

        return view('admin/login', ['login_error' => '1']);
    }
    
    public function logout(Request $request)
    {
        session()->forget('login_id');
        session()->forget('id');
        session()->forget('name');
        session()->forget('type');
        return redirect('admin/login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index', [
        ]);
    }
}
