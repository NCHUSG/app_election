@extends('layout')

@section('content')
        <div class="alert box_bg box_bg_">
            <div class="row">
                <h2 class="text_emphsis text-center"><strong>登記參選</strong></h2>
            </div>
                <a href="{{ route('regis0',0); }}" type="button" class="btn btn-primary btn-lg btn-block btn-sm">學生會正副會長</a>
                <a href="{{ route('regis0',2); }}" type="button" class="btn btn-success btn-lg btn-block btn-sm">學生代表</a>
                <a href="{{ route('regis0',3); }}" type="button" class="btn btn-info btn-lg btn-block btn-sm" >系總幹事</a>
                <a href="{{ route('modify0'); }}" type="button" class="btn btn-warning btn-lg btn-block btn-sm">修改已登記資料</a>
        </div>
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
