<?php

namespace App\Http\Controllers;

use App\Model\AdminModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    /**
     * hàm khởi tạo của class sẽ được chạy ngay khi khởi tạo đối tượng
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin')->only('index');

    }

    /**
     * phương thức trả về view khi đăng nhập admin thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('admin.dashboard');
    }

    /**
     * phương thức trả về view khi đăng ký tài khoản admin thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.auth.register');

    }

    public function store(Request $request){
        //validate dữ liệu gửi từ form đi
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ));

        //Khởi tạo model để lưu trữ admin mới
        $adminModel = new AdminModel();
        $adminModel->name = $request->name;
        $adminModel->email = $request->email;
        $adminModel->password = bcrypt($request->password);
        $adminModel->save();

        //@todo

        return redirect()->route('admin.auth.login');
    }
}
