<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Influencer;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class LoginController extends Controller
{
    public function __construct() {
        
        return view("login");
    }

    public function getLogin()
    {
        if (Auth::guard('Admin')->id() != null) {
            return redirect('/index');
        } else {
            return view("login");
        }
    }

    public function postLogin(Request $request)
    {
        try{
            $email = $request->email;
            $password = $request->password;
        
            $remember = ($request->remember == 'on') ? true : false;
            if (Auth::guard('Admin')->attempt(['email' => $email, 'password' => $password], $remember)) 
            {
                $member = User::find(Auth::guard('Admin')->id());
                return redirect('/index')->with(['success' => 'เข้าสู่ระบบสำเร็จ !']);
            } 
            else 
            {
                return redirect('')->with(['error' => 'ชื่อผู้ใช้งาน หรือรหัสผ่านผิด !']);
            }
        }catch (\Exception $e) {
            $error_log = $e->getMessage();
            $error_line = $e->getLine();
            $type_log = 'backend';
            $error_url = url()->current();
            dd($e);
            return redirect('')->with(['error' => 'เกิดข้อผิดพลาด !']);
        }
    }

    public function logOut()
    {
        if (!Auth::guard('Admin')->logout()) {
            return redirect("");
        }
    }
}

