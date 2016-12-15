<!DOCTYPE HTML>
<html>
<head>
    <title>@yield('title') - {{ $config->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="{{ $config->keywords }}"
    />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    @stack('topInclude')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/application.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
            });
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
        });
    </script>

</head>
<body>
<!---header---->
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="{{ route('getHome') }}"><img src="{{ $config->logo }}" title="" /></a>
        </div>
        <!---start-top-nav---->
        <div class="top-menu">
            <div class="search">
                <form>
                    <input type="text" placeholder="" required="">
                    <input type="submit" value=""/>
                </form>
            </div>
            <span class="menu"> </span>
            <ul>
                <li id="home"><a href="{{ route('getHome') }}">Trang Chủ</a></li>
                <li id="about"><a href="{{ route('getAbout') }}">Về Tôi</a></li>
                <li id="contact"><a href="{{ route('getContact') }}">Liên Hệ</a></li>
                <div class="clearfix"> </div>
            </ul>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
<!--/header-->
@yield('content')
<!---->
<div class="footer">
    <div class="container">
        <p>Copyrights © 2015 Huybui.blog All rights reserved </p>
    </div>
</div>
@stack('bottomInclude')
</body>
</html>


