@extends('layout')

@section('content')
    <style>
        label.btn.active{
            color:black;

            text-shadow: white 0px 2px, white 2px 0px, white -2px 0px, 
            white 0px -2px, white -1.4px -1.4px, white 1.4px 1.4px, 
            white 1.4px -1.4px, white -1.4px 1.4px;
        }
    </style>
    <form role="form" action="{{route('modify1')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{$candidate->id}}">
        <input type="hidden" name="code" value="{{$candidate->code}}">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $const['type2name'][$candidate->regis_type]; }} {{$candidate->name}} - 修改資料</h3>
            </div>
            <div class="panel-body">
                @if ($allowModifyPhoto)
                    <div class="input-group">
                        <label for="photo">照片 (看得清楚臉，以大頭照為主)</label>
                        <input type="file" id="photo" name="photo">
                        <p class="help-block">只接受 jpg,jpeg,png 之格式，且檔案不可超過100KB</p>
                    </div>
                @endif
                @if ($allowModify['name'])
                    <div class="input-group">
                        <span class="input-group-addon">姓名</span>
                        <input type="text" class="form-control" placeholder="姓名" name="candidate[name]" value="{{$candidate->name}}"></input>
                    </div>
                    <div class="row">　</div>
                @endif
                @if ($allowModify['sex'])
                    <div class="btn-group btn-group-justified" data-toggle="buttons">
                            @if($candidate->sex)
                            <label class="btn btn-primary active">
                                <input type="radio" name="candidate[sex]" value="1" checked>男
                            </label>

                            <label class="btn btn-danger">
                                <input type="radio" name="candidate[sex]" value="0">女
                            </label>
                            @else
                            <label class="btn btn-primary">
                                <input type="radio" name="candidate[sex]" value="1">男
                            </label>

                            <label class="btn btn-danger active">
                                <input type="radio" name="candidate[sex]" value="0" checked>女
                            </label>
                            @endif
                    </div>
                    <div class="row">　</div>
                @endif
                @if ($allowModify['depart'])
                    <div class="input-group">
                        <span class="input-group-addon">系級</span>
                        <input type="text" class="form-control" placeholder="系級，包含學系完整名稱和幾年級，例如：資訊科學與工程學系二年級" name="candidate[depart]" value="{{$candidate->depart}}"></input>
                    </div><div class="row">　</div>
                @endif
                @if ($allowModify['phone'])
                    <div class="input-group">
                        <span class="input-group-addon">聯絡電話</span>
                        <input type="text" class="form-control" placeholder="聯絡電話，共10碼，例如：0412345678、0912345678" name="candidate[phone]" value="{{$candidate->phone}}"></input>
                    </div><div class="row">　</div>
                @endif
                @if ($allowModify['email'])
                    <div class="input-group">
                        <span class="input-group-addon">電子信箱</span>
                        <input type="text" class="form-control" placeholder="常用電子信箱" name="candidate[email]" value="{{$candidate->email}}"></input>
                    </div><div class="row">　</div>
                @endif
                @if ($allowModify['exp'])
                    <div class="form-group">
                        <label class="control-label">經歷：</label>
                        <textarea class="form-control" rows="5" placeholder="經歷，三百字以內" name="candidate[exp]">{{preg_replace("/<br\\s*?\/??>/i","",$candidate->exp)}}</textarea>
                    </div>
                @endif
                @if ($allowModify['politics'])
                    <div class="form-group">
                        <label class="control-label">政見：</label>
                        <textarea class="form-control" rows="5" placeholder="政見，三百字以內" name="candidate[politics]">{{preg_replace("/<br\\s*?\/??>/i","",$candidate->politics)}}</textarea>
                    </div>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">填完了，送出～</button>
    </form>
@stop
