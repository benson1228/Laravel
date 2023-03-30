@extends("admin.layout.app")

@section("title", "最新消息管理")

@section("content")
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css
" rel="stylesheet">
<script>
    @if (Session::has("msg"))
        Swal.fire("{{ Session::get('msg') }}");
    @endif
</script>
<div class="card">
    <div class="card-header">
        <a class="btn btn-info" href="/admin/news/add">新增</a> &nbsp;&nbsp;
        <a class="btn btn-danger" href="javascript:deleteAll()">刪除</a>
    </div>
</div>
<div class="card">
    <form name="list" id="list" method="post" action="/admin/news/delete">
        {{ csrf_field() }}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center"><input type="checkbox" id="all" class="form-check-input"></th>
                <th class="text-center">標題</th>
                <th class="text-center">公告時間</th>
                <th class="text-center">編輯</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $data)
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="allchk form-check-input" 
                    name="id[]" value="{{ $data->id }}">
                </td>
                <td class="text-center">{!! $data->title !!}</td>
                <td class="text-center">{{ $data->dates }}</td>
                <td class="text-center">
                    <a href="/admin/news/edit/{{ $data->id }}" class="btn btn-warning">修改</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </form>
</div>
{{ $news->links() }}
@endsection