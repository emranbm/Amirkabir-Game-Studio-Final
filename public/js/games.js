/**
 * Created by emran on 12/27/16.
 */

const GAME_TITLE = emranHelper.getParameterByName('game');

$('#info-tab').click(infoTabClick);
$('#leader-tab').click(leaderTabClick);
$('#comments-tab').click(commentsTabClick);
$('#related-games-tab').click(relatedGamesTabClick);
$('#gallery-tab').click(galleryTabClick);

$.get("api/games/" + GAME_TITLE + '/header', function (data, status) {

    let response = checkResponse(data, status);
    if (!response)
        return;

    let game = response.result.game;

    $('#game-title').html(game.title);
    $('#rate-label').html(persianizer.reshapeNums(Number.parseFloat(game.rate)));
    $('#raters-label').html(persianizer.reshapeNums(game.number_of_comments));
    $('#header-img').attr('src', game.small_image);
    $('header').css('background', "linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('" + game.large_image + "') center no-repeat");
    $('header').css('background-size', 'cover');
    $('#game-genre').html(game.categories.join('، '));
    starRating.starRatingElement(Math.round(game.rate), 5, $('#rate-star-div')[0]);

    switch (emranHelper.getParameterByName('tab')) {
        case 'leaderboard':
            leaderTabClick();
            break;
        case 'comments':
            commentsTabClick();
            break;
        case 'related_games':
            relatedGamesTabClick();
            break;
        case 'gallery':
            galleryTabClick();
            break;
        default:
            infoTabClick();
    }
});

function infoTabClick() {
    resetActiveTabs();
    $('#info-tab').addClass('active-tab');
    $('#tab-title').html($('#info-tab a').html());

    if (infoTabClick.cache)
        return $('.tab-content').html('<div id="info-div">' + infoTabClick.cache + '</div>');
    else
        $.get("api/games/" + GAME_TITLE + "/info", function (data, status) {
            let response = checkResponse(data, status);
            if (!response)
                return;

            infoTabClick.cache = response.result.game.info;
            infoTabClick();
        });
}

function leaderTabClick() {
    resetActiveTabs();
    $('#leader-tab').addClass('active-tab');
    $('#tab-title').html($('#leader-tab a').html());

    if (leaderTabClick.cache) {
        let leaderboard = leaderTabClick.cache;

        if (leaderboard.length == 0) {
            $('.tab-content').html('محتوایی یافت نشد');
            return;
        }

        // Add leaderboard html.
        {
            $('.tab-content').html('<div id="board"> <div id="title"> برترین ها </div><div id="best"> <div id="person1"> <div class="rate"> ۲ </div><div> <img src="assets/images/thumb.jpg" class="silver-border"> <div class="hexagon-40 level-16md"> ۳۱ </div></div><div class="name text-center"> سروش صحت </div><div class="score text-center"> ۱۵۰۰۰۰۰۰۰ </div><abbr dir="rtl" title=""><div class="stars"> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> </div></abbr> </div><div id="person2"> <div id="rate"> ۱ </div><div> <img src="assets/images/thumb.jpg" class="gold_border"> <div class="hexagon-45 level-18md"> ۳۲ </div></div><div id="name" class="text-center"> کریم عبدالجبار </div><div id="score" class="text-center"> ۱۵۰۰۰۰۰۰۰ </div><abbr dir="rtl" title=""><div id="stars"> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> </div></abbr> </div><div id="person3"> <div class="rate"> ۳ </div><div> <img src="assets/images/thumb.jpg" class="bronze-border"> <div class="hexagon-40 level-16md"> ۰ </div></div><div class="name text-center"> هیچکس </div><div class="score text-center"> ۰ </div><div class="stars"> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> </div></div></div><div id="list"> <div class="list-item"> <div class="stars-block"> <abbr dir="rtl" title=""><div class="stars"> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> </div></abbr> </div><div class="rank-list"> ۴ </div><div class="personal-image"> <img src="assets/images/thumb.jpg" class="list-image"> <div class="hexagon level-14md"> ۰ </div></div><div class="information"> <div class="name"> هیچکس </div><div class="score"> ۰ </div></div></div><div class="list-item"> <div class="stars-block"> <abbr dir="rtl" title=""><div class="stars"> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> </div></abbr> </div><div class="rank-list"> ۵ </div><div class="personal-image"> <img src="assets/images/thumb.jpg" class="list-image"> <div class="hexagon level-14md"> ۲۲ </div></div><div class="information"> <div class="name"> هیچکس </div><div class="score"> ۰ </div></div></div><div class="list-item"> <div class="stars-block"> <abbr dir="rtl" title=""><div class="stars"> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> </div></abbr> </div><div class="rank-list"> ۶ </div><div class="personal-image"> <img src="assets/images/thumb.jpg" class="list-image"> <div class="hexagon level-14md"> ۰ </div></div><div class="information"> <div class="name"> هیچکس </div><div class="score"> ۰ </div></div></div><div class="list-item"> <div class="stars-block"> <abbr dir="rtl" title=""><div class="stars"> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> </div></abbr> </div><div class="rank-list"> ۷ </div><div class="personal-image"> <img src="assets/images/thumb.jpg" class="list-image"> <div class="hexagon level-14md"> ۰ </div></div><div class="information"> <div class="name"> هیچکس </div><div class="score"> ۰ </div></div></div><div class="list-item"> <div class="stars-block"> <abbr dir="rtl" title=""><div class="stars"> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> </div></abbr> </div><div class="rank-list"> ۸ </div><div class="personal-image"> <img src="assets/images/thumb.jpg" class="list-image"> <div class="hexagon level-14md"> ۰ </div></div><div class="information"> <div class="name"> هیچکس </div><div class="score"> ۰ </div></div></div><div class="list-item"> <div class="stars-block"> <abbr dir="rtl" title=""><div class="stars"> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> <i class="material-icons md-18 light_gray_star">star</i> </div></abbr> </div><div class="rank-list"> ۹ </div><div class="personal-image"> <img src="assets/images/thumb.jpg" class="list-image"> <div class="hexagon level-14md"> ۰ </div></div><div class="information"> <div class="name"> هیچکس </div><div class="score"> ۰ </div></div></div><div class="list-item"> <div class="stars-block"> <abbr dir="rtl" title=""><div class="stars"> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> <i class="material-icons md-18 gold_star">star</i> </div></abbr> </div><div class="rank-list"> ۱۰ </div><div class="personal-image"> <img src="assets/images/thumb.jpg" class="list-image"> <div class="hexagon level-14md"> ۰ </div></div><div class="information"> <div class="name"> هیچکس </div><div class="score"> ۰ </div></div></div></div></div>');
        }

        let rank1 = getLeaderboardRank(leaderboard, 1);
        $('#person2 img').attr('src', rank1.user.avatar);
        $('#name').html(rank1.user.name);
        $('#score').html(persianizer.reshapeNums(rank1.score));
        setStars($('#stars i'), rank1.displacement % 6);
        $('#person2 div.hexagon-45').html(persianizer.reshapeNums(rank1.level));
        $('#person2 abbr').attr('title', 'میزان پیشرفت: ' + rank1.displacement);

        let rank2 = getLeaderboardRank(leaderboard, 2);
        $('#person1 img').attr('src', rank2.user.avatar);
        $('#person1 .name').html(rank2.user.name);
        $('#person1 .score').html(persianizer.reshapeNums(rank2.score));
        setStars($('#person1 .stars i'), rank2.displacement % 6);
        $('#person1 div.hexagon-40').html(persianizer.reshapeNums(rank2.level));
        $('#person1 abbr').attr('title', 'میزان پیشرفت: ' + rank2.displacement);

        let rank3 = getLeaderboardRank(leaderboard, 3);
        $('#person3 img').attr('src', rank3.user.avatar);
        $('#person3 .name').html(rank3.user.name);
        $('#person3 .score').html(persianizer.reshapeNums(rank3.score));
        setStars($('#person3 .stars i'), rank3.displacement % 6);
        $('#person3 div.hexagon-40').html(persianizer.reshapeNums(rank3.level));
        $('#person3 abbr').attr('title', 'میزان پیشرفت: ' + rank3.displacement);

        let rankLevel = 4;
        for (let listItem of $('.list-item')) {
            let r = getLeaderboardRank(leaderboard, rankLevel);
            $(listItem).find('img').attr('src', r.user.avatar);
            $(listItem).find('.name').html(r.user.name);
            $(listItem).find('.score').html(persianizer.reshapeNums(r.score));
            setStars($(listItem).find('.stars i'), r.displacement % 6);
            $(listItem).find('div.hexagon-40').html(persianizer.reshapeNums(r.level));
            $(listItem).find('abbr').attr('title', 'میزان پیشرفت: ' + r.displacement);

            rankLevel++;
        }
        return;
    }
    else
        $.get("api/games/" + GAME_TITLE + "/leaderboard", function (data, status) {
            let response = checkResponse(data, status);
            if (!response)
                return;

            leaderTabClick.cache = response.result.leaderboard;
            leaderTabClick();
        });
}

function commentsTabClick() {
    resetActiveTabs();
    $('#comments-tab').addClass('active-tab');
    $('#tab-title').html($('#comments-tab a').html());
    $('#comment-btn').removeClass('hidden');

    if (commentsTabClick.cache) {

        let comments = commentsTabClick.cache;

        $('.tab-content').html('<div class="comments-content"></div>');

        addComments(comments);

        let nextBtn = $('<button class="btn btn-primary center-block">بارگذاری نظرات بعدی</button>');
        let offset = comments.length;
        nextBtn.click(function () {
            $.get('api/games/' + GAME_TITLE + '/comments?offset=' + offset, function (data, status) {
                let response = checkResponse(data, status);
                if (!response)
                    return;
                if (response.result.comments.length == 0)
                    nextBtn.addClass('hidden');

                addComments(response.result.comments);
            })
        });
        $('.tab-content').append(nextBtn);


        return
    } else
        $.get("api/games/" + GAME_TITLE + "/comments", function (data, status) {
            let response = checkResponse(data, status);
            if (!response)
                return;

            commentsTabClick.cache = response.result.comments;
            commentsTabClick();
        })

}

function relatedGamesTabClick() {
    resetActiveTabs();
    $('#related-games-tab').addClass('active-tab');
    $('#tab-title').html($('#related-games-tab a').html());

    if (relatedGamesTabClick.cache) {
        let games = relatedGamesTabClick.cache;

        $('.tab-content').html('');

        let c4 = 0;
        let row;

        for (let g of games) {
            if (c4 % 4 == 0) {
                row = $('<div class="row"></div>');
                $('.tab-content').append(row);
            }
            let gameItem = $('<a><div class="game-item" dir="ltr"><img src="http://cdn.zoomg.ir/2016/11/bf222635-75e2-4c6e-8635-9e5415dc9332.jpg"> <div class="item-details-div" dir="rtl"><h4 class="item-title">بازی Dishonored 2</h4><h4 class="item-category">تیراندازی، اول شخص، اکشن</h4> <div class="stars-div" dir="rtl"><span class="glyphicon glyphicon-star small-text blue-star"></span><span class="glyphicon glyphicon-star small-text blue-star"></span><span class="glyphicon glyphicon-star small-text blue-star"></span><span class="glyphicon glyphicon-star small-text blue-star"></span><span class="glyphicon glyphicon-star small-text"></span></div></div></div></a>')
            gameItem.find('img').attr('src', g.large_image);
            gameItem.find('.item-title').html(g.title);
            gameItem.find('.item-category').html(g.categories.join('، '));
            gameItem.attr('href', 'games.html?game=' + g.title);
            setStars(gameItem.find('.glyphicon-star'), g.rate, 'blue-star', '');

            row.append(gameItem);
            c4++;
        }

        return;
    } else
        $.get("api/games/" + GAME_TITLE + "/related_games", function (data, status) {
            let response = checkResponse(data, status);
            if (!response)
                return;


            relatedGamesTabClick.cache = response.result.games;
            $('.tab-content').html('');
            relatedGamesTabClick();
        });
}

function galleryTabClick() {
    resetActiveTabs();
    $('#gallery-tab').addClass('active-tab');
    $('#tab-title').html($('#gallery-tab a').html());

    if (galleryTabClick.cache) {

        let images = galleryTabClick.cache;
        $('.tab-content').html('<div class="owl-carousel owl-theme" dir="ltr"></div>');

        for (let img of images) {
            $('.owl-carousel').append('<a href="' + img.url + '"><img class="item" src="' + img.url + '"></a>');
        }

        $('.owl-carousel').owlCarousel({
            loop: true,
            responsiveClass: true,
            animateOut: 'fadeOut',
            autoplay: false,
            margin: 10,
            animateInClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true,
                    dots: false
                },
                600: {
                    items: 2,
                    nav: false,
                    dots: false
                },
                1000: {
                    items: 5,
                    loop: true,
                    dots: false
                }
            }
        });
        return
    } else
        $.get('api/games/' + GAME_TITLE + '/gallery', function (data, status) {
            let response = checkResponse(data, status);
            if (!response)
                return;

            galleryTabClick.cache = response.result.gallery.images;
            galleryTabClick();
        })

}

/**
 * Parses and returns the server response. if a problem found, returns null.
 * @param data
 * @param status
 * @return {*}
 */
function checkResponse(data, status) {
    if (status !== 'success') {
        alert('مشکل در ارتباط با سرور');
        return null;
    }

    let response = data.response;

    if (!response.ok) {
        alert('مشکل در بارگذازی صفحه');
        return null;
    }

    return response;
}

function resetActiveTabs() {
    $('.nav-tabs li').removeClass('active-tab');
    $('#comment-btn').addClass('hidden');
}

function getLeaderboardRank(leaderboard, rank = 1) {
    /*for (let item of leaderboard) {
     if (item.displacement == rank)
     return item;
     }*/

    return leaderboard[rank - 1];

    // return null;
}

function setStars(starElements, value, activeClass = 'gold_star', passiveClass = 'light_gray_star') {
    let i;
    for (i = 0; i < value; i++) {
        $(starElements[i]).removeClass(passiveClass);
        $(starElements[i]).addClass(activeClass);
    }

    for (; i < starElements.length; i++) {
        $(starElements[i]).removeClass(activeClass);
        $(starElements[i]).addClass(passiveClass);
    }

}

function addComments(comments) {
    for (let c of comments) {
        let commentElement = $('<div class="row comment-row"> <div class="col-md-3 comment-stars-div"><span class="glyphicon glyphicon-star small-text blue-star"></span><span class="glyphicon glyphicon-star small-text blue-star"></span><span class="glyphicon glyphicon-star small-text blue-star"></span><span class="glyphicon glyphicon-star small-text blue-star"></span><span class="glyphicon glyphicon-star small-text"></span></div><div class="col-md-7" dir="rtl"> <h5>۲۲ آذر ۹۵</h5> <span class="username text-primary">ali</span> <span class="text-primary comment-text">بسیار بازی زیبا و قشنگی بود</span> </div><div class="col-md-2"> <img class="round-img" src="assets/images/thumb.jpg"> </div></div>');
        if (c.user.avatar)
            commentElement.find('img').attr('src', c.user.avatar);
        commentElement.find('.username').html(c.user.name);
        commentElement.find('h5').html(c.date);
        commentElement.find('.comment-text').html(c.text);
        setStars(commentElement.find('.comment-stars-div span'), c.rate, 'blue-star', '');

        $('.comments-content').append(commentElement);
    }
}




