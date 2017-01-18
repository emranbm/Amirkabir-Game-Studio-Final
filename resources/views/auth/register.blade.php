<!doctype html>

<html lang="fa">
<head>
    <meta charset="utf-8">

    <title>ثبت نام</title>
    <meta name="description" content="ثبت نام در سایت">
    <meta name="author" content="1111111">

    <link rel="stylesheet" href="css/reset.css">
    <link href="https://cdn.rawgit.com/rastikerdar/shabnam-font/v1.0.2/dist/font-face.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/auth/global.css">
    <link rel="stylesheet" href="css/auth/register.css">

    <script src="js/auth/global.js"></script>
</head>

<body>

<header>
    <div class="header-div"><i class="material-icons">person</i></div>
    <div class="header-div"><span>ceitgames</span></div>
</header>

<div dir="rtl" class="center-box">
    <span class="title">ثبت نام</span>
    <?php
    if (empty($errors->all()))
        $msg = false;
    else if ($errors->has('name'))
        $msg = 'نام کاربری قابل قبول نیست.';
    else if ($errors->has('email'))
        $msg = 'لطفا ایمیل را به درستی وارد کنید.';
    else if ($errors->has('password'))
        $msg = 'پسورد نامناسب است.';
    ?>

    @if (isset($msg))
        <span id="wrong-form-label">{{ $msg }}</span>
    @endif

    <form method="POST" action="{{url('register')}}">
        {{ csrf_field() }}
        <div class="center-box-row"><i class="material-icons">person</i>
            <input class="text-box" type="text" name="name" value="{{ old("name") }}" placeholder="نام کاربری"/>
        </div>
        <div class="center-box-row"><i class="material-icons">email</i>
            <input class="text-box" type="text" name="email" value="{{ old("email") }}" placeholder="رایانامه"/>
        </div>
        <div class="center-box-row"><i class="material-icons">lock</i>
            <input class="text-box" type="password" name="password" placeholder="رمز عبور"/>
        </div>
        <div class="center-box-row"><i class="material-icons">lock</i>
            <input class="text-box" type="password" name="password_confirmation" placeholder="تکرار رمز عبور"/>
        </div>
        <br/>
        <input type="checkbox" checked/><a href="#">قوانین</a> را می‌پذیرم. <br/>
        <input class="button center-horizontal" type="submit" value="ثبت نام">
    </form>
</div>

</body>

</html>