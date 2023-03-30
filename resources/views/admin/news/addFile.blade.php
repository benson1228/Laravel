@extends("admin.layout.app")

@section("title", "新增最新消息檔案")

@section("content")
<div class="page-header">
    {{ $news->title }}
</div>
<div class="row">
    <form method="post" action="/admin/news/uploadFile" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="newsId" value="{{ $news->id }}">
        <div class="card">
            <div class="card-body">
                @foreach (range("1", "5") as $index)
                <div class="mb-3 row">
                    <label class="col-form-label col-sm-2 text-sm-right">標題</label>
                    <div class="col-sm-4">
                        <input type="text" name="title{{ $index }}" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <input type="file" name="file{{ $index }}" class="form-control-file">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="card-body text-center">
            <button type="submit" class="btn btn-primary"> 確 &nbsp;&nbsp;定 </button>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-warning" 
            onclick="location.href='/admin/news/edit/{{ $news->id }}'">
             取&nbsp;&nbsp;消 </button>
        </div>
    </form>
</div>
@endsection