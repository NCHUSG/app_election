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
    <form role="form" action="{{route('regis1')}}" method="post" enctype="multipart/form-data">
    @for ($i = 1; $i <= $NumberOfCandidate; $i++,$type++)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $const['type2name'][$type] }} - 登記報名表</h3>
            </div>
            <div class="panel-body">
                <div class="input-group">
                    <label for="photo">照片 (看得清楚臉，以大頭照為主)</label>
                    <input type="file" id="photo" name="{{$type}}">
                    <p class="help-block">只接受 jpg,jpeg,png 之格式，且檔案不可超過50KB</p>
                </div>
                <div class="row">　</div>
                <div class="input-group">
                    <span class="input-group-addon">姓名</span>
                    <input type="text" class="form-control" placeholder="姓名" name="candidate[{{$type}}][name]"></input>
                </div>
                <div class="row">　</div>
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="candidate[{{$type}}][sex]" value="1">男
                        </label>
                        <label class="btn btn-danger">
                            <input type="radio" name="candidate[{{$type}}][sex]" value="0">女
                        </label>
                </div>
                <div class="row">　</div>
                <div class="input-group">
                    <span class="input-group-addon">聯絡電話</span>
                    <input type="text" class="form-control" placeholder="聯絡電話，共10碼，例如：0412345678、0912345678" name="candidate[{{$type}}][phone]"></input>
                </div>
                <div class="row">　</div>
                <div class="input-group">
                    <span class="input-group-addon">電子信箱</span>
                    <input type="text" class="form-control" placeholder="常用電子信箱" name="candidate[{{$type}}][email]"></input>
                </div>
                <div class="row">　</div>
                <div class="input-group">
                    <span class="input-group-addon">系級</span>
                    <input type="text" class="form-control" placeholder="系級，包含學系完整名稱和幾年級，例如：資訊科學與工程學系二年級" name="candidate[{{$type}}][depart]"></input>
                </div> 
                <div class="row">　</div>
                <div class="form-group">
                    <label class="control-label">經歷：</label>
                    <textarea class="form-control" rows="5" placeholder="經歷，三百字以內" name="candidate[{{$type}}][exp]"></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">政見：</label>
                    <textarea class="form-control" rows="5" placeholder="政見，三百字以內" name="candidate[{{$type}}][politics]"></textarea>
                </div>
                <h3>個人資料提供同意書</h3>
                <p>1.本會取得您的個人資料，目的在於進行社團相關工作，蒐集、處理及使用您的個人資料是受到個人資料保護法及相關法令之規範。</p>
                <p>2.本次蒐集與使用您的個人資料如報名表單所載。</p>
                <p>3.您同意本會因社務所需，以您所提供的個人資料確認您的身份、與您進行聯絡；並同意本會於您報名錄取後繼續處理及使用您的個人資料。</p>
                <p>4.本同意書如有未盡事宜，依個人資料保護法或其他相關法規之規定辦理。</p>
                <p>5.您瞭解此一同意書符合個人資料保護法及相關法規之要求，具有書面同意本會蒐集、處理及使用您的個人資料之效果。</p>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="candidate[{{$type}}][agree]" value="yes">我已詳閱本同意書，瞭解並同意受同意書之拘束（請打勾）
                    </label>
                </div>
            </div>
        </div>
    @endfor
        <div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">填完了，送出！ (送出後會給予一組驗證碼提供修改經歷和政見)</button>
        </div>
        <div>
            
        </div>
    </form>
@stop
