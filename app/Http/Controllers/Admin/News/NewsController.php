<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = DB::table("news")->paginate(10);
        return view("admin.news.list", compact("news"));
    }

    public function add()
    {
        return view("admin.news.add");
    }

    public function insert()
    {
        $input = request()->all();

        // \r\n 代表按enter鍵，要轉換瀏覽器看得懂的換行符號(<br>)
        // str_replace：文字取代，第一個參數為要被置換的文字，第二個參數為要想置換的內容
        DB::table("news")->insert([
            "title" => $input["title"],
            "content" => str_replace("\r\n", "<br/>", $input["content"]),
            "dates" => $input["dates"]
        ]);

        // 取得新增的自動編號最後id
        $newsId = DB::getPdo()->lastInsertId();

        if (!empty($input["files"])) {
            // 上傳的檔案
            $file = $input["files"];

            // 系統時間
            $times = explode(" ", microtime());
            // 將上傳的檔案重新命名，依時間（年月時時分秒亳秒）
            // extension：上傳檔案的副檔名(例如：jpg, jpeg, pdf...等)
            // strftime : 依時區將時間格式化，有刪除線表示新版程式不建議再使用，但仍可使用
            // substr： 取字串，字串的第一個字序位是0
            // substr($times[0], 2, 3) --> 2:從tims[0]的第三位元開始；3:取三個字
            $newFile = strftime("%Y_%m_%d_%H_%M_%S_", $times[1]) . substr($times[0], 2, 3) .
                "." . $file->extension();

            // 將上傳的檔案搬移至指定路徑
            $file->move("images/news", $newFile);

            DB::table("news_file")->insert([
                "newsId" => $newsId,
                "fileName" => $input["fileName"],
                "files" => $newFile
            ]);
        }

        \Session::flash("msg", "已新增");
        return redirect("/admin/news");
    }

    public function edit(Request $req)
    {
        $id = $req->id;
        /*
         $req->id：id來自 routes/web.php Route::get("edit/{id}" : 中的{id}
         若routes 中的{id}改變名稱，$req->這裡也要改為相同名稱
         例如: Route::get("edit/{abc}", [NewsController::class, "edit"]);
         則 $id = $req->abc
        */
        $list = DB::table("news")->where("id", $id)->first();
        $files = DB::table("news_file")->where("newsId", $id)->get();

        return view("admin.news.edit", compact("list", "files", "id"));
    }

    public function update(Request $req)
    {
        /* $req->id，中的id，來自edit.blade.php 中的 name="id"
         <input type="hidden" name="id" value="{{ $id }}"> 
         若name改為test <input type="hidden" name="test" value="{{ $id }}">
         則接收參數為 $req->test
         傳統的php接收參數為$_POST["id"]，這裡也可使用
        */

        DB::table("news")->where("id", $req->id)->update([
            "title" => $req->title,
            "content" => $req->content,
            "dates" => $req->dates,
            "content2" => str_replace("\r\n", "<br/>", $req->content2),
        ]);

        \Session::flash("msg", "已修改");
        return redirect("/admin/news");
    }

    public function addFile(Request $req)
    {
        $news = DB::table("news")->where("id", $req->id)->first();
        return view("admin.news.addFile", compact("news"));
    }

    public function uploadFile()
    {
        $req = request()->all();

        foreach (range("1", "5") as $index) {
            if (!empty($req["file" . $index])) {
                $fileName = $req["title" . $index];
                $file = $req["file" . $index];

                $times = explode(" ", microtime());
                $newFile = strftime("%Y_%m_%d_%H_%M_%S_", $times[1]) . substr($times[0], 2, 3) .
                    "." . $file->extension();

                $file->move("images/news", $newFile);

                DB::table("news_file")->insert([
                    "newsId" => $req["newsId"],
                    "fileName" => $fileName,
                    "files" => $newFile
                ]);
            }
        }

        \Session::flash("msg", "已新增");
        return redirect("/admin/news/edit/". $req["newsId"]. "#tab2");
    }
}
