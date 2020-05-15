<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            font-family: 'Noto Sans TC', sans-serif;
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="email"] {
            border-radius: 0;
            border-radius: 0;
            margin-bottom: -1px;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body class="text-center">
    <div class="container">
        <div class="row align-item-center">
            <div class="col-12">
                <form method="POST" class="form-signin" action="{{ url('/newregister')}}">
                    {{ csrf_field() }}
                    <h1 class="h3 mb-3 font-weight-normal">註冊</h1>
                    <hr>
                    <label for="inputEmail" class="sr-only">帳號</label>
                    <input type="text" name='username' class="form-control" placeholder="請輸入姓名" required autofocus>
                    <label for="inputEmail" class="sr-only">帳號</label>
                    <input type="email" name='email' class="form-control" placeholder="example@example.com" required>
                    <label for="inputPassword" class="sr-only">密碼</label>
                    <input type="password" name='password' class="form-control" placeholder="請輸入八位密碼" required>
                    @if ($errors->has('fail'))
                    <p class="alert alert-danger" role="alert">{{ $errors->first('fail')}}</p>
                    @endif
                    <button class="btn btn-lg btn-primary btn-block">註冊</button>
                    <hr>
                </form>
            </div>
        </div>
        <div class="col-12">
            <span>有帳號?</span>
                <a class="btn btn-primary" href="{{ url('/sign')}}">登入</a>
        </div>


    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
</body>

</html>