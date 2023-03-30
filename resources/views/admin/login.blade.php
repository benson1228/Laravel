<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="關於此網站的描述,讓搜尋引擎搜尋">
    <meta name="keywords" content="美食,寵物,第一帥,第一美">
    <title>xxx管理系統</title>
    <link href="/css/admin/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">xxx管理系統</h1>
                            <p class="lead">

                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    @if ($errors->has("fail"))
                                    <font color="red">{{ $errors->first("fail") }}</font>
                                    @endif
                                    <form method="post" action="/admin/login">
                                        {{ csrf_field() }}
                                        <div class="mb-3">
                                            <label class="form-label">帳號</label>
                                            <input class="form-control form-control-lg" type="text" name="userId" 
                                            value="{{ old("userId") }}" placeholder="請輸入帳號" autofocus/>
                                            @if ($errors->has("userId"))
                                            <font color="red">{{ $errors->first("userId") }}</font>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">密碼</label>
                                            <input class="form-control form-control-lg" type="password" name="pwd" />
                                            @if ($errors->has("pwd"))
                                            <font color="red">{{ $errors->first("pwd") }}</font>
                                            @endif
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary"> 確 定 </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="/js/admin/app.js"></script>

</body>

</html>