@extends('layout')

@section('content')
        <style>
            a.btn-council{
                color: #fff;
                background-color: #47A4D8;
                border-color: #296063;
            }
            a.btn-council:hover{
                color: #fff;
                background-color: #3986B1;
                border-color: #1B4042;
            }
        </style>
        <script src="{{asset('/js/jquery.appear.js')}}"></script>
        @if($show_regis)
        <div class="alert box_bg box_bg_">
            <div class="row">
                <h2 class="text_emphsis text-center"><strong>登記參選</strong></h2>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <a href="{{ route('regis0',0) }}" type="button" class="btn btn-primary btn-lg btn-block btn-sm">
                        <img src="{{asset('/img/president_sm.png')}}" style="max-height:200px">
                        <h3 class="text-center text_emphsis">學生會正副會長</h3>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <a href="{{ route('regis0',2) }}" type="button" class="btn btn-council btn-lg btn-block btn-sm">
                        <img src="{{asset('/img/council_sm.png')}}" style="max-height:200px">
                        <h3 class="text-center text_emphsis">學生代表</h3>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <a href="{{ route('regis0',3) }}" type="button" class="btn btn-info btn-lg btn-block btn-sm" >
                        <img src="{{asset('/img/depart_master_sm.png')}}" style="max-height:200px">
                        <h3 class="text-center text_emphsis">系總幹事</h3>
                    </a>
                </div>
            </div>
            <div class="row">　</div>
            <div class="row">
                <a href="{{ route('modify0') }}" type="button" class="btn btn-warning btn-lg btn-block btn-sm">
                    修改已登記資料
                </a>
                
            </div>
        </div>
        @endif
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="jumbotron box_bg box_bg_">
                <h2 class="text_emphsis"><strong>何謂三合一選舉？</strong></h2>
                <p>選出中興大學學生會正副會長、各系學生代表及各系總幹事(系學會會長)</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="jumbotron box_bg box_bg_">
                <h2 class="text_emphsis"><strong>何謂學生代表？</strong></h2>
                <p>學生代表又稱學生議員，可以說是校園裡的立法委員，每年要審核學生會近三百萬的預算及質詢學生會各部首長。</p>
            </div>
        </div>
    </div>
    @if($show_candidate)
        <link rel="stylesheet" href="{{asset('/css/animate.css')}}">
        <style>
            div.move-ctrl{
                display: inline-block;
                width: 4%;
            }
            div.ctrl-btn{
                height: 440px;
                position: relative;
                z-index: 999;
                width: 500%;
            }
            div.ctrl-btn:hover{
                background-color: rgba(145, 183, 192, 0.47);
                border-radius: 10px
            }
            div.next{
                background: url('img/next.png') center no-repeat;
                
            }
            div.prev{
                background: url('img/prev.png') center no-repeat;
            }
            .next div.ctrl-btn{
                right: 400%;
            }

            div.view{
                display: inline-block;
                width: 90%;

                background: green;
                overflow: hidden;
            }
            div.expended div.view{
                width: 100%;
            }
            ul.view_content{
                overflow: visible;
                position: relative;
                left: 0;
                white-space: nowrap;
                vertical-align: top;
                -moz-transition: left {{$const['moving_inteval']}}ms ease-in-out;
                -webkit-transition: left {{$const['moving_inteval']}}ms ease-in-out;
                transition: left {{$const['moving_inteval']}}ms ease-in-out;
                display: inline-block;
                list-style: none;
                padding: 0;
                margin-bottom: 0;
            }
            li.candidate_data{
                margin: 20px;
                height: 400px;
                width: 200px;
                vertical-align: top;
                word-wrap: break-word;
                display: inline-block;
                white-space: normal;

                -webkit-transition: opacity 1s;
                -moz-transition: opacity 1s;
                -ms-transition: opacity 1s;
                -o-transition: opacity 1s;
                transition: opacity 1s;

                border-top: 5px solid rgb(201, 176, 166);
            }

            li.candidate_data.title{
                width:160px;
            }
            
            li.candidate_data.building{
                opacity: 0;
            }
            li.candidate_data:nth-last-child(1){
                border-top: initial;
            }
            ul.NO_MORE li.candidate_data:nth-last-child(1){
                display: none;
            }

            div.loadingProgressContainer{
                margin: auto;
                margin-top: 195px;
                width:150px;
                height:12px;
                overflow:hidden;
                background-color:#4653DB;
                transition:background-color 0.5s;
                -moz-border-radius:6px;
                -webkit-border-radius:6px;
                -ms-border-radius:6px;
                -o-border-radius:6px;
                border-radius:6px;
            }

            div.loadingProgressContainer.working{
                background-color:#34C8D5;
            }

            div.loadingProgressG{
                background-color:#116327;
                margin-top:0;
                margin-left:-150px;
                -moz-animation-name:bounce_loadingProgressG;
                -moz-animation-duration:1.5s;
                -moz-animation-iteration-count:infinite;
                -moz-animation-timing-function:linear;
                -webkit-animation-name:bounce_loadingProgressG;
                -webkit-animation-duration:1.5s;
                -webkit-animation-iteration-count:infinite;
                -webkit-animation-timing-function:linear;
                -ms-animation-name:bounce_loadingProgressG;
                -ms-animation-duration:1.5s;
                -ms-animation-iteration-count:infinite;
                -ms-animation-timing-function:linear;
                -o-animation-name:bounce_loadingProgressG;
                -o-animation-duration:1.5s;
                -o-animation-iteration-count:infinite;
                -o-animation-timing-function:linear;
                animation-name:bounce_loadingProgressG;
                animation-duration:1.5s;
                animation-iteration-count:infinite;
                animation-timing-function:linear;
                width:150px;
                height:12px;
            }

            @-moz-keyframes bounce_loadingProgressG{
            0%{
            margin-left:-150px;
            }

            100%{
            margin-left:150px;
            }

            }

            @-webkit-keyframes bounce_loadingProgressG{
            0%{
            margin-left:-150px;
            }

            100%{
            margin-left:150px;
            }

            }

            @-ms-keyframes bounce_loadingProgressG{
            0%{
            margin-left:-150px;
            }

            100%{
            margin-left:150px;
            }

            }

            @-o-keyframes bounce_loadingProgressG{
            0%{
            margin-left:-150px;
            }

            100%{
            margin-left:150px;
            }

            }

            @keyframes bounce_loadingProgressG{
            0%{
            margin-left:-150px;
            }

            100%{
            margin-left:150px;
            }

            }

            div.listAll{
                width: 91%;
                margin-left: 4%;
                /* margin-right: auto; */
                text-align: center;
                background-color: rgba(0, 255, 204, 0.7);
                position: relative;
                top: -10px;
                font-size: 24px;

                -webkit-transition: background-color 0.5s;
                -moz-transition: background-color 0.5s;
                -ms-transition: background-color 0.5s;
                -o-transition: background-color 0.5s;
                transition: background-color 0.5s;

                cursor: pointer;
            }

            div.listAll:hover{
                background-color: rgba(0, 133, 255, 0.9);
            }

            br.expend_ctl{
                display: none;
            }

            div.expended br.expend_ctl{
                display: initial;
            }

            div.expended div.move-ctrl{
                display: none;
            }

            div.expended ul.view_content{
                white-space: initial;
            }

        </style>

        <h2 class="text-center">學生會正副長 候選人名單</h2>
        <div class="row" id="president">
            <div class="move-ctrl prev">
                <div class="ctrl-btn"></div>
            </div>
            <div class="view box_bg_ box_bg">
                <ul class="view_content">
                    <li id="0" class="candidate_data">
                        <div class="loadingProgressContainer"><div class="loadingProgressG"></div></div>
                    </li>
                </ul>
            </div>
            <div class="move-ctrl next">
                <div class="ctrl-btn"></div>
            </div>
            <div class="listAll">
                展開
            </div>
        </div>
        <h2 class="text-center">學生代表 候選人名單</h2>
        <div class="row" id="council">
            <div class="move-ctrl prev">
                <div class="ctrl-btn"></div>
            </div>
            <div class="view box_bg_ box_bg">
                <ul class="view_content">
                    <li id="0" class="candidate_data">
                        <div class="loadingProgressContainer"><div class="loadingProgressG"></div></div>
                    </li>
                </ul>
            </div>
            <div class="move-ctrl next">
                <div class="ctrl-btn"></div>
            </div>
            <div class="listAll">
                展開
            </div>
        </div>
        <h2 class="text-center">系總幹事 候選人名單</h2>
        <div class="row" id="depart_master">
            <div class="move-ctrl prev">
                <div class="ctrl-btn"></div>
            </div>
            <div class="view box_bg_ box_bg">
                <ul class="view_content">
                    <li id="0" class="candidate_data">
                        <div class="loadingProgressContainer"><div class="loadingProgressG"></div></div>
                    </li>
                </ul>
            </div>
            <div class="move-ctrl next">
                <div class="ctrl-btn"></div>
            </div>
            <div class="listAll">
                展開
            </div>
        </div>

        <script type="text/javascript" src="js/jquery.appear.js"></script>
        <script type="text/javascript" src="js/queue.js"></script>
        <script>
            var showingDelayTimeout={{$const['showingDelayTimeout']}};
            var moving_inteval={{$const['moving_inteval']}};
            var number_to_show_once={{$number_to_show_once}};
            var img_src_folder="{{asset('/img/upload/')}}";
            var candidate_source_url="{{route('get')}}";
            var regis_type2name=[
                {en:'president',ch:'學生會長'},
                {en:'sub-president',ch:'學生會副會長'},
                {en:'council',ch:'學生代表'},
                {en:'depart_master',ch:'系總幹事'}];
            var name2regis_type=new Array();
            name2regis_type['president']=0;
            name2regis_type['council']=2;
            name2regis_type['depart_master']=3;

            var preview_px=200;
            var move_px;
            var candidate_view_right_overflow_restricted;

            var change_height_value
            function set_height_value(){
                move_px=$('div.view').width()/2;
                candidate_view_right_overflow_restricted=$('li.candidate_data').width()*1.25;
                change_height_value=false;
            }

            set_height_value();
            $(window).resize(function(){
                if(!change_height_value){
                    change_height_value=setTimeout(set_height_value,300);
                    change_height_value=true;
                }
            });

            var getting=[
                false,false,false,false
            ];

            $.fn.candidate=function(data,isNewCandidate,completed){
                var container=$(this).parents('ul');
                var oriThis=this;

                var current_block=$(this);
                var max_height=current_block.height();

                if(typeof oriThis.current_height==="undefined")
                    oriThis.current_height=0;

                var new_container=function(whenDelayOver,isNewCandidate){
                    current_block.removeClass('building');
                    current_block=$(oriThis).clone().empty().addClass('building').removeAttr('id');
                    if(isNewCandidate===true){
                        current_block.addClass('title');
                        $(oriThis).before($('<br class="expend_ctl">'));
                    }
                    oriThis.current_height=0;
                    $(oriThis).before(current_block);
                    setTimeout(function(){
                        whenDelayOver();
                    },showingDelayTimeout);
                }

                var add_element=function(element,nextStep){
                    current_block.append(element);
                    var element_height=element.outerHeight(true);

                    oriThis.current_height+=element_height;
                    if(oriThis.current_height>max_height){ //放下去之後會超過 block的長度
                        var temp_element=element.clone();
                        element.remove();

                        if(element_height>max_height){ //內容比整個 block 都還長啊
                            if(temp_element.is('p')){ //是文字，可以切
                                var content_str=temp_element.html();
                                var pool_str="";

                                current_block.append(temp_element);
                                temp_element.html(pool_str);
                                while((temp_element.height()<max_height)&&content_str!=""){
                                    if(content_str.search('<br>')===0){
                                        pool_str+='<br>';
                                        content_str=content_str.substr(4);
                                    }
                                    else{
                                        pool_str+=content_str.substr(0,1);
                                        content_str=content_str.substr(1);
                                    }
                                    
                                    temp_element.html(pool_str);
                                }
                                if(content_str!=""){
                                    if(!pool_str.match(/<br>$/g)){
                                        var lastChar=pool_str.substr(pool_str.length-1)
                                        content_str=lastChar+content_str;
                                        pool_str=pool_str.substr(0,pool_str.length-1);

                                        temp_element.html(pool_str);
                                    }
                                    temp_element=temp_element.clone().html(content_str);

                                    new_container(function(){
                                        add_element(temp_element,nextStep);
                                    });
                                }
                            }
                            else{
                                // 無法，就是太大，直接放
                                current_block.append(temp_element);
                                new_container(nextStep);
                            }
                        }
                        else{
                            new_container(function(){
                                add_element(temp_element,nextStep);
                            });
                        }
                        
                    }
                    else{ // No problem! next one~
                        nextStep();
                    }
                }

                var next_data=function(){
                    var current_data=oriThis.cdq.get();

                    if(typeof current_data ==="undefined"){
                        current_block.removeClass('building');
                        oriThis.puting_candidate=false;
                        completed();
                    }
                    else if(current_data==="new_block")
                        new_container(next_data,false);
                    else if(current_data==="new_candidate")
                        new_container(next_data,true);
                    else if(current_data instanceof jQuery)
                        add_element(current_data,next_data);
                    else
                        throw new Exception("Invalid data type!");
                };

                if(typeof oriThis.cdq === 'undefined') //cdq stands for candidate_data_queue
                    oriThis.cdq=(new Queue());

                if(isNewCandidate&&(typeof oriThis.puting_candidate === 'boolean'))
                    oriThis.cdq.add("new_candidate")

                oriThis.cdq.add(data);

                if(!oriThis.puting_candidate){
                    oriThis.puting_candidate=true;
                    new_container(next_data,isNewCandidate);
                }
            }

            function trigger_get(e, $affected) {
                
                var type=name2regis_type[$(this).parents('div.row').attr('id')];
                var start=$(this).parents('ul').find('li:last').attr('id');
                var triggered_loadingBar=this;
                var triggered_li=$(this).parents('li');
                //console.log("trigger_get");
                if(!getting[type]){
                    //console.log("getting");
                    var target_url=candidate_source_url+"/"+type+"/"+start;
                    getting[type]=true;
                    $.ajax({
                        dataType: "json",
                        url: target_url,
                        success: function(data,textStatus){

                            function completed(){
                                getting[type]=false;
                            }

                            function add_normal_ele(ele){
                                triggered_li.candidate(ele,false,completed);
                            }

                            data.forEach(function(a_candidate){
                                if(a_candidate.regis_type<=1){
                                    if(typeof triggered_loadingBar.presidentCnt === 'undefined')
                                        triggered_loadingBar.presidentCnt=0;
                                    var president_str_temp="第"+((triggered_loadingBar.presidentCnt/2+1).toString().split('.')[0])+"組之";
                                    triggered_loadingBar.presidentCnt++;
                                    president_str_temp+=regis_type2name[a_candidate.regis_type].ch+"候選人：";

                                    triggered_li.candidate($('<p></p>').html(president_str_temp),true,completed);
                                    add_normal_ele($('<img class="img-responsive img-thumbnail" alt="">').attr('src',img_src_folder+"/"+a_candidate.id));
                                }
                                else{
                                triggered_li.candidate($('<img class="img-responsive img-thumbnail" alt="">').attr('src',img_src_folder+"/"+a_candidate.id),true,completed);
                                }

                                var name_temp=a_candidate.name+"  ";
                                if(a_candidate.sex==1)
                                    name_temp+="男"
                                else
                                    name_temp+="女"
                                add_normal_ele($('<h2></h2>').html(name_temp+"<br>"+a_candidate.depart),false,completed);
                                add_normal_ele("new_block");
                                add_normal_ele($('<p></p>').html("經歷：<br>"+a_candidate.exp));
                                add_normal_ele("new_block");
                                add_normal_ele($('<p></p>').html("政見：<br>"+a_candidate.politics));



                                if(a_candidate.regis_type!=1)
                                    triggered_li.attr('id',a_candidate.id+1);
                            });
                            

                            //console.log("get_candidate success!,textStatus="+textStatus);

                            if(data.length<number_to_show_once)
                                $(triggered_loadingBar).fadeOut(function(){
                                    triggered_li.candidate($("<h3>以上是全部的候選人了</h3>"),true,completed);
                                    $(this).hide().parents('ul').addClass("NO_MORE");
                                });
                        },
                    });
                }
            }

            function move_ul(view_wrapper,delta){

                if(typeof view_wrapper.data('left') ==='undefined')
                    view_wrapper.data('left',0);

                var left=view_wrapper.data('left');
                var new_left=left+delta;

                if((new_left>0)||(new_left<(-view_wrapper.width()+candidate_view_right_overflow_restricted))){
                    if(new_left>0)
                        new_left=0;
                    else
                        new_left=(-view_wrapper.width()+candidate_view_right_overflow_restricted);
                    view_wrapper.addClass('animated shake');
                    view_wrapper.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                        view_wrapper.removeClass('animated shake');
                    });
                    //return left;
                }

                view_wrapper.css('left',new_left);
                setTimeout(function(){
                    $('div.loadingProgressContainer').each(function(){
                        if($(this).is(":appeared")){
                            this.trigger_get=trigger_get;
                            this.trigger_get();
                        }
                    });
                },moving_inteval);
                return new_left;
            }

            rs_nav.config.complete=function(){
                $('div.loadingProgressContainer').appear();

                $(document.body).on('appear', 'div.loadingProgressContainer', trigger_get);

                $('div.ctrl-btn').click(function(){
                    var view_wrapper=$(this).parents('div.row').eq(0).find('ul');

                    if(typeof view_wrapper.data('left') ==='undefined')
                        view_wrapper.data('left',0);

                    if($(this).parent().is('div.prev')){
                        var delta=move_px;
                    }
                    else{
                        var delta=-move_px;
                    }
                    view_wrapper.data('left',move_ul(view_wrapper,delta));
                });

                $('div.ctrl-btn').hover(function(){
                    var view_wrapper=$(this).parents('div.row').eq(0).find('ul');

                    if(typeof view_wrapper.data('left') ==='undefined')
                        view_wrapper.data('left',0);

                    if(view_wrapper.is('ul.previewed')){
                        view_wrapper.removeClass('previewed');
                        view_wrapper.css('left',view_wrapper.data('left'));
                    }
                    else{
                        view_wrapper.addClass('previewed');
                        if($(this).parent().is('div.prev')){
                            move_ul(view_wrapper,preview_px);
                        }
                        else{
                            move_ul(view_wrapper,-preview_px);
                        }
                    }
                });

                $('div.listAll').click(function(){
                    if($(this).parent().is('div.expended')){
                        $(this).parent().removeClass('expended');
                        $(this).html("展開");
                    }
                    else{
                        $(this).parent().addClass('expended');
                        $(this).html("收回");

                        var view_wrapper=$(this).parent().find('ul.view_content');
                        view_wrapper.data('left',0);
                        view_wrapper.css('left','0px');
                    }
                });
            };
        </script>
    @endif
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">參選資格</h3>
                </div>
                <div class="panel-body">
                    <p>【學生會會長候選人參選、各系學生代表候選人資格】&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p>依國立中興大學學生會會長、副會長暨學生代表選舉罷免辦法：</p><ul style="list-style: none;"><li>（1）第十六條<ul style="list-style: none;"><li>凡具備學生會會員身份且符合下列資格者，均得登記為學生會會長、副會長及學生代表候選人：</li>
                    <li>&nbsp;一、前學期操行成績八十分以上及學業平均成績六十分以上。</li>
                    <li>&nbsp;二、未曾有過一學期不及格學分數達該學期修習學分數二分之ㄧ者。&nbsp;&nbsp;&nbsp;&nbsp;</li>
                    <li>&nbsp;三、無大過以上處分紀錄。</li>
                    <li>&nbsp;四、非應屆畢業生。</li>
                    <li>&nbsp;五、（刪除）</li>
                    <li>&nbsp;六、學生會會長參選人需曾經擔任過班級、社團等幹部，若無幹部經驗者，則須附系所主任或班導師推薦信函。</li>
                    <li>&nbsp;曾被解職之學生代表不得再參選學生會會長及副會長。</li></ul>
                    </li>
                    <li>（2）第十六條之一<ul style="list-style: none;"><li>凡具備學生會會員身份且符合下列資格者，均得登記為學生會會長、副會長及學生代表候選人：</li>
                    <li>&nbsp;一、前學期操行成績八十分以上及學業平均成績六十分以上。</li>
                    <li>&nbsp;二、無大過以上處分紀錄。</li>
                    <li>&nbsp;三、（刪除）&nbsp;</li>
                    <li>&nbsp;四、未申請轉出原系。</li>
                    <li>&nbsp;五、非應屆畢業生。</li>
                    <li>&nbsp;曾被解職之學生代表不得再參選學生會會長及副會長。</li></ul>
                    </li>
                    <li>（3）第十六條之二<ul style="list-style: none;"><li>&nbsp;已登記為候選人者不得為選務委員。</li></ul>
                    </li></ul>
                    <p>【學生代表選舉相關法規】</p>
                    <p>
                        學生代表以學系、學士學位學程為選區選舉之。各選區會員人 數在三百人以下者選出二人，三百至五百人者選出三人，五百至七百人者選出四人，七百人以上者選出五人。（第一項）研究所、碩士學位學程及博士學位學程以學 院劃分選區選舉學生代表，各選區選出二人。（第二項）前二項所指之學系、研究所及學位學程，依國立中興大學組織規程第三條之規定行之。（第三項）學生代表 選舉罷免辦法另訂之。
                    </p>
                    <p><a href="https://drive.google.com/file/d/0B-xy7gVEXhIrUW9nNzBkNWNEVnc/edit?usp=sharing">本屆學代人數統計</a> </p>
                    <p>【各系系總幹事候選人參選資格】</p><p>依國立中興大學學生社團輔導辦法：</p><ul style="list-style: none;"><li>第九條</li>
                    <li>學生社團負責人對內主持社務，對外代表社團。學生社團負責人登記候選資格為前一學期學業成績及格，操行在八十分以上。且無大過以上之處分者，始可參選，但每人以擔任一個社團之負責人為限。</li></ul>
                    
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">選舉日程</h3>
                    </div>
                    <div class="panel-body">
                       <p>抽籤時間: 103/3/28 (五)</p>
                       <p>候選人名單公佈: 103/4/7 (一)</p>
                       <p>投票日: 103/5/8 (四)</p>
                       <p>當選公告: 103/5/16 (五)</p>
                       <p>交接: 103/5/19 (一)</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">聯絡選委會</h3>
                    </div>
                    <div class="panel-body">
                       <p>主委：生科三 吳冠蓉 0987505433</p>
                       <p>副主委：植病三 黃金立 0920024488</p>
                       <p>執秘：資管三 蘇立舜 0921142406</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
