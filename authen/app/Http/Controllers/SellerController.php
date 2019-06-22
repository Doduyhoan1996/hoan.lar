<?php

namespace App\Http\Controllers;

use App\Model\SellerModel;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    //
    /**
     * hàm khởi tạo của class sẽ được chạy ngay khi khởi tạo đối tượng
     * SellerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:seller')->only('index');

    }

    /**
     * phương thức trả về view khi đăng nhập seller thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('seller.dashboard');
    }

    /**
     * phương thức trả về view khi đăng ký tài khoản seller thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('seller.auth.register');

    }

    public function store(Request $request){
        //validate dữ liệu gửi từ form đi
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required|unique:sellers,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ));

        //Khởi tạo model để lưu trữ seller mới
        $sellerModel = new SellerModel();
        $sellerModel->name = $request->name;
        $sellerModel->email = $request->email;
        $sellerModel->password = bcrypt($request->password);
        $sellerModel->save();

        //@todo

        return redirect()->route('seller.auth.login');
    }
}
