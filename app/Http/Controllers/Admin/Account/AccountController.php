<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        // get()：取全部資料
        // first():取第一筆資料
        // paginate(x)：每x筆為一頁
        // orderby：排序, ASC:由小到大  DESC:由大到小, asc及desc不分大小寫

        // select a.*, b.dept_name from admin as a inner join dept as b on a.dept=b.deptId
        // order by a.dept asc limit 10

        /*
        $list = DB::select("select a.*, b.dept_name from admin as a inner join dept as b on a.dept=b.deptId
        order by a.dept asc limit 10");

        join = inner join
        leftjoin = left join
        rigthjoin = right join

         */
        $list = DB::table("admin AS a")
            ->selectRaw("a.*, b.dept_name")
            ->join("dept AS b", "a.dept", "b.deptId")
            ->orderby("a.dept", "ASC")->paginate(10);

        return view("admin.account.list", compact("list"));
    }

    public function add()
    {
        $list = DB::table("dept")->get();
        return view("admin.account.add", compact("list"));
    }

    public function insert(Request $req)
    {
        $user = DB::table("admin")->where("userId", $req->userId)->first();
        if (!empty($user)) {
            \Session::flash("msg", "[" . $req->userId . "]此帳號已存在");
            return redirect("/admin/account/add")->withInput();
            exit;
        }

        DB::table("admin")->insert([
            "dept" => $req->dept,
            "userId" => $req->userId,
            "pwd" => $req->pwd,
        ]);

        \Session::flash("msg", "已新增");
        return redirect("/admin/account");
    }

    public function delete(Request $req)
    {
        DB::table("admin")->wherein("userId", $req->userId)->delete();

        \Session::flash("msg", "已刪除");

        return redirect("/admin/account");
    }

    public function edit(Request $req)
    {
        $list = DB::table("admin")->where("userId", $req->userId)->first();

        return view("admin.account.edit", compact("list"));
    }

    public function update(Request $req)
    {
        if ($req->oldUserId != $req->userId) {
            $user = DB::table("admin")->where("userId", $req->userId)->first();
            if (!empty($user)) {
                \Session::flash("msg", "[" . $req->userId . "]此帳號已存在");
                return redirect("/admin/account/edit/" . $req->oldUserId)->withInput();
                exit;
            }
        }

        DB::table("admin")->where("userId", $req->oldUserId)->update(
            [
                "userId" => $req->userId,
                "pwd" => $req->pwd,
            ]);

        \Session::flash("msg", "已修改");
        return redirect("/admin/account");
    }
}
