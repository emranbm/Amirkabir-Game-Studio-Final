@extends('layouts.general')

@section('style')
    <link rel="stylesheet" href="css/games-list.css">
@endsection

@section('script')
    <script src="js/games-list.js"></script>
@endsection

@section('content')

    <header dir="rtl" class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h1 id="head-title">نتایج جستجو برای:‌ FIFA</h1>
        </div>
        <div class="col-md-3"></div>
    </header>

    <div id="content-div" class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        </div>
        <div class="col-md-3"></div>
    </div>

@endsection