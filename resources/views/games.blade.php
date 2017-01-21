@extends('layouts.general')

@section('style')
    <link rel="stylesheet" href="css/games.css">
@endsection

@section('script')
    <script src="js/games.js"></script>
@endsection

@section('content')

    <header dir="rtl" class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div id="header-content" class="row">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">شروع بازی</button>
                </div>
                <div class="col-md-7">
                    <h2 id="game-title">Battlefield 4: Dragon's Teeth</h2>
                    <h4 id="game-genre" class="text-muted">اکشن، اول شخص، مولتی پلیر</h4>
                    <div class="row">
                        <div dir="rtl" class="col-md-9">
                            <span id="rate-label" class="text-muted">۳.۲</span>
                            <span id="raters-label" class="text-muted">۶۱ رای</span>
                        </div>
                        <div id="rate-star-div" class="col-md-3"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <img id="header-img" src="assets/images/tail-spin.svg"/>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </header>
    <div id="tabs-full-div" class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <ul class="nav nav-tabs">
                <li id="info-tab" class="active-tab"><a class="text-muted">اطلاعات بازی</a></li>
                <li id="leader-tab"><a class="text-muted">رتبه‌بندی و امتیازات</a></li>
                <li id="comments-tab"><a class="text-muted">نظرات کاربران</a></li>
                <li id="related-games-tab"><a class="text-muted">بازی‌های مشابه</a></li>
                <li id="gallery-tab"><a class="text-muted">عکس‌ها و ویدیوها</a></li>
            </ul>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>

        <div id="tab-title-div" class="col-md-6">
            <h1 id="tab-title">اطلاعات بازی</h1>
            <button id="comment-btn" data-toggle="modal" data-target="#myModal" class="btn btn-primary hidden">نظر
                دهید
            </button>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form method="post" action="{{ url('new_comment') }}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">ثبت نظر جدید</h4>
                            </div>
                            <div class="modal-body">
                                <p>نظر خود را وارد کنید.</p>
                                <textarea name="comment" cols="60" rows="4"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                                <button type="submit" class="btn btn-primary">ثبت</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="tab-content container" dir="rtl">
    </div>

@endsection