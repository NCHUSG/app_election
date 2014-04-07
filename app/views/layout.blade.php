<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>三合一選舉登記</title>

    <script type="text/javascript" src="http://res.nchusg.org/nav/nav.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('/css/font-awesome.min.css');}}">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
    <!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
    <!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
    <!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> <html class=""> <!--<![endif]-->

    <script>
        rs_nav.load({
            complete:function(){},
            afterfadeIn:function(){},
            autoHideReady:function(){},
            bsCss:true,
            fadeIn:false,
            fadeIn_inteval:1000,
            autoHide:true,
            message:false,
        });

        var oldIE = $('html').is('.ie6, .ie7, .ie8');
        
    </script>

    <style>
        .box_bg_.box_bg{
            background-color: #fff; 
            background-image: 
            linear-gradient(90deg, transparent 79px, #abced4 79px, #abced4 81px, transparent 81px),
            linear-gradient(#eee .1em, transparent .1em);
            background-size: 100% 1.2em;
        }

        .text_emphsis{
            color:rgb(23, 141, 70);

            text-shadow: white 0px 2px, white 2px 0px, white -2px 0px, 
            white 0px -2px, white -1.4px -1.4px, white 1.4px 1.4px, 
            white 1.4px -1.4px, white -1.4px 1.4px;
        }

        h1#main_title{
            background-color: #026873;
            background-image: linear-gradient(90deg, rgba(255,255,255,.07) 50%, transparent 50%),
            linear-gradient(90deg, rgba(255,255,255,.13) 50%, transparent 50%),
            linear-gradient(90deg, transparent 50%, rgba(255,255,255,.17) 50%),
            linear-gradient(90deg, transparent 50%, rgba(255,255,255,.19) 50%);
            background-size: 13px, 29px, 37px, 53px;

            border-radius: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="box_bg text-center text_emphsis" id="main_title"><strong><a href="{{route('index');}}">三合一選舉登記</a></strong></h1>
        <div class="row main">
            @yield('content')
        </div>
        <div class="row">　</div>
        <div class="row">
            <p class="text-center">
                Designed and Programmed by PastLeo
                <br>
                國立中興大學 學生會行政中心 (NCHU Student Goverment Administration Center)
                <br>
                © NCHUSG Department of Information Technology 2014. All right reserved.
            </p>
            <p class="text-center"><a href="https://github.com/orgs/NCHUSG" target="_blank">Github</a></p>
        </div>
    </div>
</body>
</html>
