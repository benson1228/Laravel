@extends("admin.layout.app")

@section("title", "編輯最新消息")

@section("content")
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="/js/admin/jquery.datetimepicker.js"></script>
<script src="/js/admin/ckeditor.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.min.css
" rel="stylesheet">
<script>
    $(function() {
        $("#tabs").tabs();
        $("#dates").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });

    function delFile(fileId) {
        Swal.fire({
            title: '確定刪除?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: '確定',
            denyButtonText: '取消',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "/admin/news/delFile/{{ $id }}/" + fileId;   
            }
        })
    }
</script>

<div class="card">
    <div class="card-body">
        <form method="post" action="/admin/news/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $id }}">
            {{ csrf_field() }}
            <div id="tabs">
                <div class="mb-3 row">
                    <ul>
                        <li><a href="#tab1" id="#tab1">內容</a></li>
                        <li><a href="#tab2" id="#tab2">檔案</a></li>
                    </ul>
                </div>
                <div id="tab1">
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-1 text-sm-right">標題</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" required autocomplete="off" value="{{ $list->title }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-1 text-sm-right">內容</label>
                        <div class="col-sm-10">
                            <!--使用編輯器，本身就是html語法
                                ｛!! !!｝ : 當有html語法時，前後加上二個！！，取代內部第二個{}
                            -->
                            <textarea rows="10" name="content" id="content" class="form-control ckeditor" required>
                            {!! $list->content !!}
                            </textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-1 text-sm-right">內容</label>
                        <div class="col-sm-10">
                            <!--str_replace("<br/>", "\r\n", $list->content2)
                                將換行符號(<br/>)轉換為輸入框的換行符號(\r\n)
                                r:return 回到最前端
                                n:new line 換行
                            -->
                            <textarea rows="10" name="content2" id="content2" class="form-control" required>{{ str_replace("<br/>", "\r\n", $list->content2) }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-1 text-sm-right">開放時間</label>
                        <div class="col-sm-2">
                            <input type="text" name="dates" id="dates" class="form-control" autocomplete="off" value="{{ $list->dates }}">
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <button type="submit" class="btn btn-primary"> 確 定 </button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-warning" onclick="location.href='/admin/news'">回上頁</button>
                    </div>
                </div>
                <div id="tab2">
                    <div class="card-header">
                        <a class="btn btn-info" href="/admin/news/addFile/{{ $id }}">新增</a>
                    </div>

                    <div class="mb-3 row">
                        <table class="table table-bordered" border="1">
                            <tr style="background-color:bisque">
                                <td width="55%" class="text-center">標題</td>
                                <td width="35%">檔案</td>
                                <td width="10%">刪除</td>
                            </tr>
                            @foreach($files as $data)
                            <tr>
                                <td class="text-center">{{ $data->fileName }}</td>
                                <td>[檢視]：<a href="/images/news/{{ $data->files }}" target="_blank">
                                        {{ $data->files }}</a></td>
                                <td><a class="btn btn-danger" href="javascript:delFile('{{ $data->id }}')">刪除</a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection