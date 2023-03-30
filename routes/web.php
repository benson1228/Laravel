<?php

use App\Http\Controllers\Admin\Account\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\News\NewsController;
use App\Http\Controllers\Web\Dept\DeptController;
use Illuminate\Support\Facades\Route;

//Route::get("/dept", [DeptController::class, "list"]);
// 在{}中的名稱為變數名稱，可自行定義
// 在{}的變數名稱後面若有?，表示該變數可能有，也可能沒有
// 例如{test?} : 表示可能有test的變數，也可能沒有test的變數
// Route::get 表示會顯示在網址列
// Route::post 表示用表單方式傳送
// Route::any 不限定是get或post方法
//Route::get("/dept/ed/{id}", [DeptController::class, "modify123"]);
//Route::post("/dept/update", [DeptController::class, "update"]);
//Route::post("/dept/delete", [DeptController::class, "deleteDept"]);
//Route::get("/dept/list", [DeptController::class, "dataList"]);
/*
Route::group(["prefix" => "dept"], function () {
    Route::get("/", [DeptController::class, "list"]);
    Route::get("ed/{id}", [DeptController::class, "modify123"]);
    Route::post("update", [DeptController::class, "update"]);
    Route::post("delete", [DeptController::class, "deleteDept"]);
    Route::get("list", [DeptController::class, "dataList"]);
});
*/

// 後台管理系統
Route::group(["prefix" => "admin"], function() {
    Route::get("/", [AdminController::class, "index"]);
    Route::post("login", [AdminController::class, "login"]);
    Route::get("home", [AdminController::class, "myHome"])->middleware("manager");
    Route::get("logout", [AdminController::class, "logout"]);

    // 帳號管理
    Route::group(["prefix" => "account"], function() {
        Route::get("/", [AccountController::class, "index"]);
        Route::get("add", [AccountController::class, "add"]);
        Route::post("insert", [AccountController::class, "insert"]);
        Route::post("delete", [AccountController::class, "delete"]);
        // ?:可能無資料時使用，一定有資料時可不加?，但加?不會有影響
        Route::get("edit/{userId?}", [AccountController::class, "edit"]);
        Route::post("update", [AccountController::class, "update"]);
    });

    // 最新消息管理
    Route::group(["prefix" => "news"], function(){
        Route::get("/", [NewsController::class, "index"]);
        Route::get("add", [NewsController::class, "add"]);
        Route::post("insert", [NewsController::class, "insert"]);
        Route::get("edit/{id}", [NewsController::class, "edit"]);
        Route::post("update", [NewsController::class, "update"]);
        Route::get("addFile/{id}", [NewsController::class, "addFile"]);
        Route::post("uploadFile", [NewsController::class, "uploadFile"]);
        Route::get("delFile/{newsId}/{fileId}", [NewsController::class, "delFile"]);

    });
});
