@extends("admin.layout.app")

@section("title", "新增帳號")

@section("content")
<div class="card">
    <div class="card-body">
        <form method="post" action="/admin/account/insert">
            {{ csrf_field() }}
            <div class="mb-3 row">
                <label class="col-form-label col-sm-1 text-sm-right">部門</label>
                <div class="col-sm-2">
                    <select name="dept" class="form-control mb-3" required>
                        <option>請選擇</option>
                        @foreach($list as $data)
                        <option value="{{ $data->deptId }}">{{ $data->dept_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-sm-1 text-sm-right">帳號</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" 
                        name="userId" required autocomplete="off"
                        maxlength="10">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-sm-1 text-sm-right">密碼</label>
                <div class="col-sm-2">
                    <input type="password" class="form-control" 
                        name="pwd" required autocomplete="off"
                        maxlength="10">
                </div>
            </div>
            <div class="card-body text-center">
                <button type="submit" class="btn btn-primary"> 確 定 </button> 
                &nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-warning" 
                    onclick="location.href='/admin/account'">回上頁</button>
            </div>
        </form>
    </div>
</div>
@endsection