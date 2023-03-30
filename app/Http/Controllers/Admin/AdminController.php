<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.login");
    }

    public function login(Request $req)
    {
        // 自訂的規則
        $rule = [
            "userId" => "required",
            "pwd" => "required"
        ];

        // 自訂規則所要呈現在網頁的訊息
        $msg = [
            "userId.required" => "帳號不得為空",
            "pwd.required" => "請輸入密碼"
        ];

        // 根據上方的規則，依輸入的資料做驗證
        // request()->all()：全部輸入的資料
        $vd = Validator::make(request()->all(), $rule, $msg);

        // fails：符合自訂規則中的任一條件
        if ($vd->fails())
        {
            // widthInput：將使用者所輸入的資料回傳回上一個頁面
            // withErros：回傳錯誤的訊息
            return redirect("/admin")->withInput()->withErrors($vd);
            // exit:結束程式往下執行
            exit;
        }

        // 檢查admin資料表中是否有輸入的帳號及密碼
        $member = DB::table("admin")->where("userId", $req->userId)
            ->where("pwd", $req->pwd)->first();

        if (is_null($member))
        {
            return redirect("/admin")->withInput()->withErrors(["fail" => "帳號或密碼錯誤"]);
            exit;
        }

        session()->put("userId", $req->userId);
        session()->put("dept", $member->dept);
        return redirect("/admin/home");
    }

    public function myHome()
    {
        
        return view("admin.home");
    }

    public function logout()
    {
        session()->flush();
        return redirect("/admin");
    }
}
