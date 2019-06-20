<?php

namespace App\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * phương thức này dùng để đăng nhập cho login
     */
    public function login(){
        return view('admin.auth.login');
    }

    public function loginAdmin(Request $request){
        //validate dữ liệu
        $this->validate($request,array(
            'email' => 'required|email',
            'password' => 'required|min:6'
        ));
        // Đăng nhập
        if (Auth::guard('admin')->attempt(
            ['email' => $request->email, 'password' => $request->password ] , $request->remember
        )){
            // nếu đăng nhập thành công thì chuyển hướng về view dashboard của admin
            return redirect()->intended(route('admin.dashboard'));

        }
        //nếu đăng nhập thấ bại thì quay trở về form đăng nhập với giá trị của ô input  cũ
        return redirect()->back()->withInput($request->only('email','remember'));
    }


    public function logout(){
        Auth::guard('admin')->logout();
        //chuyển hướng về trang login
        return redirect()->route('admin.auth.login');
    }
}
