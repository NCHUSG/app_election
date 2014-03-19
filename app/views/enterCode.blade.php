@extends('layout')

@section('content')
    <div class="alert alert-warning"><strong>請輸入修改碼以開始修改資料</strong></div>
    <form action="{{route('modify1')}}" method="post">
        @if($enable_recaptcha)
        <div class="alert alert-danger">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <h3 class="text-center">不好意思，請證明你是人類。</h3>
                <p class="text-center">
                    為了防止惡意濫用，請辨識此圖片證明本表單由人類所填，請見諒！
                </p>
                <p class="text-center">
                    <a href="http://zh.wikipedia.org/wiki/%E9%AA%8C%E8%AF%81%E7%A0%81" target="_blank">告訴我為何這樣可以防止惡意濫用</a>
                </p>
                
            </div>
            <div class="visible-xs col-xs-2">　</div>
            <div style="col-xs-9 col-sm-6 col-md-6 col-lg-6">
                <div style="display:inline-block">
                    {{Form::recaptcha()}}
                </div>
            </div>
        </div>
        @endif
        <div class="input-group">
            <span class="input-group-addon">修改碼</span>
            <input type="text" class="form-control" placeholder="修改碼" name="code"></input>
        </div>
        <div class="row">　</div>
        <div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">送出</button>
        </div>
        <div>
            
        </div>
    </form>
@stop
