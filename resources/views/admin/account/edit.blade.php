@extends("admin.layout.app")

@section("title", "修改帳號")

@section("content")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css" rel="stylesheet">
<script>
    @if (Session::has("msg"))
        Swal.fire("{{ Session::get('msg') }}");
    @endif
</script>
<div class="card">
    <div class="card-body">
        <form method="post" action="/admin/account/update">
            <input type="hidden" name="oldUserId" value="{{ $list->userId }}">
            {{ csrf_field() }}
            
            <div class="mb-3 row">
                <label class="col-form-label col-sm-1 text-sm-right">帳號</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" 
                        name="userId" required autocomplete="off"
                        maxlength="10" value="{{ $list->userId }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-sm-1 text-sm-right">密碼</label>
                <div class="col-sm-2">
                    <input type="password" class="form-control" 
                        name="pwd" required autocomplete="off"
                        maxlength="10" value="{{ $list->pwd }}">
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