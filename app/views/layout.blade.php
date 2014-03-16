<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>三合一選舉登記</title>

    <script type="text/javascript" src="http://res.nchusg.org/nav/nav.js"></script>
    <script type="text/javascript" src="http://res.nchusg.org/js/jquery-1.10.2.min.js"></script>
    <link rel="stylesheet" href="{{asset('/css/font-awesome.min.css');}}">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        rs_nav.load({
            complete:function(){},
            afterfadeIn:function(){},
            autoHideReady:function(){},
            bsCss:true,
            fadeIn:false,
            fadeIn_inteval:1000,
            autoHide:true,
            message:true,
        });
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
        @yield('content')
    </div>
</body>
</html>
