<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amirkabir Game Studio</title>
    <link rel="stylesheet" href="css/reset.css">
    <link href="https://cdn.rawgit.com/rastikerdar/shabnam-font/v1.0.2/dist/font-face.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="libs/node_modules/owl.carousel/dist/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="libs/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/general.css">

    @yield('style')

    <link rel="stylesheet" href="css/utils/star-rate.css">
    <link rel="stylesheet" href="css/game-item.css">
    <link rel="stylesheet" href="css/general-comments.css">
    <link rel="stylesheet" href="css/leaderboard.css">
    <link rel="stylesheet" href="css/primary-bar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/leaderboard-fixer.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<div class="container-fluid">
    <div id="primary-bar" class="row">
        <div class="col-md-3"></div>
        <div class="row col-md-6">
            <div class="row col-md-6">
                <div class="col-md-4">
                    @if (Auth::guest())
                        <a href="{{ url('login') }}">
                            <span id="login-label" class="text-muted">ورود</span>
                            <span class="glyphicon glyphicon-user"></span>
                        </a>
                    @else
                        <a href="{{ url('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span id="login-label" class="text-muted">خروج</span>
                            <span class="glyphicon glyphicon-user"></span>
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                </div>
                <div id="search-div" class="row col-md-8">
                    <span id="search-icon" class="glyphicon glyphicon-search col-md-3"></span>
                    <input id="search-input" class="shabnam-font col-md-9" dir="rtl" type="text"
                           placeholder="جست و جو ..."/>
                </div>
            </div>
            <div class="col-md-6">
                <a href="{{ url('/') }}">
                    <span dir="rtl" id="top-right-span" class="white-text">
                        <span class="glyphicon glyphicon-cloud small-text"></span>
                        <span class="small-text text-muted">امیرکبیر </span> <span
                                class="small-text blue-text">استودیو</span>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>

    @yield('content')

    <footer>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <ul dir="rtl">
                    <li><a href="{{ url('/') }}">صفحه اصلی</a></li>
                    <li><a href="#">درباره ما</a></li>
                    <li><a href="#">ارتباط با سازندگان</a></li>
                    <li><a href="#">سوالات متداول</a></li>
                    <li><a href="#">حریم خصوصی</a></li>
                    <li>
                        <a href="{{ url('/') }}">
                            <span dir="rtl" class="white-text">
                                <span class="glyphicon glyphicon-cloud small-text"></span>
                                <span class="small-text text-muted">امیرکبیر </span> <span class="small-text blue-text">استودیو</span>
                            </span>
                        </a>
                    </li>
                </ul>
                <img src="assets/images/fake-icons.jpg">
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row text-center">
            <span class="text-muted">تمامی حقوق محفوظ و متعلق به دانشگاه امیرکبیر است</span>
        </div>
    </footer>
</div>
</body>

<script src="libs/node_modules/jquery/dist/jquery.min.js"></script>
<script src="libs/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="libs/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="js/utils/emranHelper.js"></script>
<script src="js/utils/starRating.js"></script>
<script src="js/utils/persianizer.js"></script>
<script src="js/general-comments-loader.js"></script>

@yield('script')

<script src="js/primary-bar.js"></script>

</html>