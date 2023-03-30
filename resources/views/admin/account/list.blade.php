@extends("admin.layout.app")

@section("title", "帳號管理")

@section("content")
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css
" rel="stylesheet">
<script>
    @if (Session::has("msg"))
        //alert("{{ Session::get('msg') }}");
        Swal.fire("{{ Session::get('msg') }}");
    @endif
</script>
<div class="card">
    <div class="card-header">
        <a class="btn btn-info" href="/admin/account/add">新增</a> &nbsp;&nbsp;
        <a class="btn btn-danger" href="javascript:deleteAll()">刪除</a>
    </div>
</div>
<div class="card">
    <form name="list" id="list" method="post" action="/admin/account/delete">
        {{ csrf_field() }}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center"><input type="checkbox" id="all" class="form-check-input"></th>
                <th class="text-center">部門</th>
                <th class="text-center">帳號</th>
                <th class="text-center">密碼</th>
                <th class="text-center">修改</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $data)
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="allchk form-check-input" 
                    name="userId[]" value="{{ $data->userId }}">
                </td>
                <td class="text-center">{{ $data->dept_name }}</td>
                <td class="text-center">{{ $data->userId }}</td>
                <td class="text-center">{{ $data->pwd }}</td>
                <td class="text-center">
                    <a href="/admin/account/edit/{{ $data->userId }}" class="btn btn-warning">修改</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </form>
</div>
{{ $list->links() }}
@endsection