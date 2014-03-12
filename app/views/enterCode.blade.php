@extends('layout')

@section('content')
    <div class="alert alert-warning"><strong>請輸入驗證碼以開始修改資料</strong></div>
    <form action="{{route('modify1')}}" method="post">
        <div class="input-group">
            <span class="input-group-addon">驗證碼</span>
            <input type="text" class="form-control" placeholder="驗證碼" name="code"></input>
        </div>
        <div class="row">　</div>
        <div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">送出</button>
        </div>
        <div>
            
        </div>
    </form>
@stop
