<?php

namespace App\Http\Controllers;

use App\Model\ShipperModel;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    //
    /**
     * hàm khởi tạo của class sẽ được chạy ngay khi khởi tạo đối tượng
     * SellerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:shipper')->only('index');

    }

    /**
     * phương thức trả về view khi đăng nhập shipper thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('shipper.dashboard');
    }

    /**
     * phương thức trả về view khi đăng ký tài khoản shipper thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('shipper.auth.register');

    }

    public function store(Request $request){
        //validate dữ liệu gửi từ form đi
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required|unique:shippers,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ));

        //Khởi tạo model để lưu trữ shipper mới
        $shipperModel = new ShipperModel();
        $shipperModel->name = $request->name;
        $shipperModel->email = $request->email;
        $shipperModel->password = bcrypt($request->password);
        $shipperModel->save();

        //@todo

        return redirect()->route('shipper.auth.login');
    }
}
