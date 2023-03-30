@extends("admin.layout.app")

@section("title", "新增最新消息")

@section("content")
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="/js/admin/jquery.datetimepicker.js"></script>
<script src="/js/admin/ckeditor.js"></script>
<script>
    $(function() {
        $("#tabs").tabs();
        $("#dates").datepicker(
            {
                dateFormat: "yy-mm-dd"
            }
        );
    });
</script>
<div class="card">
    <div class="card-body">
        <form method="post" action="/admin/news/insert" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="title" required autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-1 text-sm-right">內容</label>
                        <div class="col-sm-10">
                            <textarea rows="10" name="content" id="content" class="form-control ckeditor" required></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-1 text-sm-right">開放時間</label>
                        <div class="col-sm-2">
                            <input type="text" name="dates" id="dates" class="form-control" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div id="tab2">
                    <div class="mb-3 row">
                        <label class="col-form-label col-sm-1 text-sm-right">標題</label>
                        <div class="col-sm-4">
                            <input type="text" name="fileName" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <input type="file" name="files" class="form-control-file">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body text-center">
                <button type="submit" class="btn btn-primary"> 確 定 </button>
                &nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-warning" onclick="location.href='/admin/news'">回上頁</button>
            </div>
        </form>
    </div>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection