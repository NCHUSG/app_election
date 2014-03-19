@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{asset('/css/jquery.fileupload.css')}}">
    <link rel="stylesheet" href="{{asset('/css/nprogress.css')}}">
    <script type="text/javascript" src="{{asset('/js/nprogress.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/jquery.scrollTo-min.js')}}"></script>
    <style>
        label.btn.active{
            color:black;

            text-shadow: white 0px 2px, white 2px 0px, white -2px 0px, 
            white 0px -2px, white -1.4px -1.4px, white 1.4px 1.4px, 
            white 1.4px -1.4px, white -1.4px 1.4px;
        }

        span.fileinput-button{
            transition:background-color 2s;
        }

        div.progress{
            transition:width 1s;
        }

    </style>
    <form id="regis_form" role="form" action="{{route($target_route)}}" method="post">
    @for ($i = 1; $i <= $NumberOfCandidate; $i++,$type++)
        <input type="hidden" name="id" value="{{$candidate->id or ""}}">
        <input type="hidden" name="code" value="{{$candidate->code or ""}}">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" style="font-size: 30px; font-weight: bold;">{{ $form_title or $const['type2name'][$type] }}</h3>
            </div>
            <div class="panel-body">

                @if ($enabled_field['photo'])
                <p>照片： ({{ $const['fieldDocExample']['photo'] }})</p>
                <div class="row">
                    <div class="photo_upload_input col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="btn btn-primary fileinput-button">
                            <div class="progress progress-striped active" style="display:none;">
                              <div class="progress-bar progress-bar-info"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                              </div>
                            </div>
                            <div class="photo_preview">
                                @if (isset($candidate))
                                <img src="{{asset($const['uploaded_photo_folder'].$candidate->id);}}" style="width:100%;" alt="">
                                @else
                                <i class="fa fa-upload fa-5x"></i>
                                @endif
                            </div>
                            <input type="file" class="fileupload" name="{{$type}}" data-url="{{route('photo_upload',$type)}}" multiple>
                        </span>
                    </div>
                </div>
                <div class="row">　</div>
                @endif
                
                @if ($enabled_field['name'])
                <div class="input-group">
                    <span class="input-group-addon">姓名</span>
                    <input type="text" class="form-control" placeholder="{{ $const['fieldDocExample']['name'] }}" name="candidate[{{$type}}][name]" value="{{$candidate->name or ""}}"></input>
                </div>
                <div class="row">　</div>
                @endif

                @if ($enabled_field['sex'])
                <div class="btn-group btn-radio-group" data-toggle="buttons">
                    <label class="btn btn-default disabled" style="background: #E6E6E6; border: 1px solid #ccc; opacity: 1;">
                        性別
                    </label>
                    @if(!isset($candidate))
                    <label class="btn btn-primary">
                        <input type="radio" name="candidate[{{$type}}][sex]" value="1"> <i class="fa fa-male"></i>　男
                    </label>
                    <label class="btn btn-danger">
                        <input type="radio" name="candidate[{{$type}}][sex]" value="0"> <i class="fa fa-female"></i>　女
                    </label>
                    @elseif ($candidate->sex)
                    <label class="btn btn-primary active">
                        <input type="radio" name="candidate[{{$type}}][sex]" value="1" checked> <i class="fa fa-male"></i>　男
                    </label>
                    <label class="btn btn-danger">
                        <input type="radio" name="candidate[{{$type}}][sex]" value="0"> <i class="fa fa-female"></i>　女
                    </label>
                    @else
                    <label class="btn btn-primary">
                        <input type="radio" name="candidate[{{$type}}][sex]" value="1"> <i class="fa fa-male"></i>　男
                    </label>
                    <label class="btn btn-danger active">
                        <input type="radio" name="candidate[{{$type}}][sex]" value="0" checked> <i class="fa fa-female"></i>　女
                    </label>
                    @endif
                </div>
                <div class="row">　</div>
                @endif

                @if ($enabled_field['phone'])
                <div class="input-group">
                    <span class="input-group-addon">聯絡電話</span>
                    <input type="text" class="form-control" placeholder="{{ $const['fieldDocExample']['phone'] }}" name="candidate[{{$type}}][phone]" value="{{$candidate->phone or ""}}"></input>
                </div>
                <div class="row">　</div>
                @endif

                @if ($enabled_field['email'])
                <div class="input-group">
                    <span class="input-group-addon">電子信箱</span>
                    <input type="text" class="form-control" placeholder="{{ $const['fieldDocExample']['email'] }}" name="candidate[{{$type}}][email]" value="{{$candidate->email or ""}}"></input>
                </div>
                <div class="row">　</div>
                @endif

                @if ($enabled_field['depart'])
                <div class="input-group">
                    <span class="input-group-addon">系級</span>
                    <input type="text" class="form-control" placeholder="{{ $const['fieldDocExample']['depart'] }}" name="candidate[{{$type}}][depart]" value="{{$candidate->depart or ""}}"></input>
                </div> 
                <div class="row">　</div>
                @endif

                @if ($enabled_field['exp'])
                <div class="form-group">
                    <label class="control-label">經歷：</label>
                    <textarea class="form-control" rows="5" placeholder="{{ $const['fieldDocExample']['exp'] }}" name="candidate[{{$type}}][exp]">{{$candidate->exp or ""}}</textarea>
                </div>
                @endif

                @if ($enabled_field['politics'])
                <div class="form-group">
                    <label class="control-label">政見：</label>
                    <textarea class="form-control" rows="5" placeholder="{{ $const['fieldDocExample']['politics'] }}" name="candidate[{{$type}}][politics]">{{$candidate->politics or ""}}</textarea>
                </div>
                @endif

                @if ($enabled_field['agree'])
                <h3>個人資料提供同意書</h3>
                <p>1.本會取得您的個人資料，目的在於進行社團相關工作，蒐集、處理及使用您的個人資料是受到個人資料保護法及相關法令之規範。</p>
                <p>2.本次蒐集與使用您的個人資料如報名表單所載。</p>
                <p>3.您同意本會因社務所需，以您所提供的個人資料確認您的身份、與您進行聯絡；並同意本會於您報名錄取後繼續處理及使用您的個人資料。</p>
                <p>4.本同意書如有未盡事宜，依個人資料保護法或其他相關法規之規定辦理。</p>
                <p>5.您瞭解此一同意書符合個人資料保護法及相關法規之要求，具有書面同意本會蒐集、處理及使用您的個人資料之效果。</p>

                <p>PS.送出後將會給予一組修改碼，可以用於修改證件、經歷和相片，請謹慎保管 (若要修改其他欄位，請洽學生會行政中心資訊部門)。</p>

                <div class="checkbox">
                    <label>
                        @if (isset($candidate) && $candidate->agree)
                        <input type="checkbox" name="candidate[{{$type}}][agree]" value="1" checked>我已詳閱本同意書，瞭解並同意受同意書之拘束（請打勾）
                        @else
                        <input type="checkbox" name="candidate[{{$type}}][agree]" value="1">我已詳閱本同意書，瞭解並同意受同意書之拘束（請打勾）
                        @endif
                    </label>
                </div>
                @endif
            </div>
        </div>
    @endfor
        @if($enable_recaptcha)
        <div class="alert alert-danger">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <h3 class="text-center">不好意思，請證明你是人類。</h3>
                <p class="text-center">
                    為了防止惡意濫用，使用圖片辨識驗證，請見諒！
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
        <div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">填完了，送出！</button>
        </div>
    </form>
    <script src="{{asset('/js/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('/js/jquery.fileupload.js')}}"></script>
    
    <script>
        var submit_url="{{route($target_route)}}";
        var upload_photo_folder="{{asset($const['PhotoTempLocation']).'/'}}";
        var photo_error_message_prefix="{{$const['photo_error_message_prefix']}}";
        var progress_bar_width=250;
        var debug_var;

        rs_nav.config.complete=function(){
            if(oldIE){
                alert("舊版 IE (版本小於等於9) 無法正常上傳檔案，因此若要申請，請使用 Chrome 或 Firefox 等先進瀏覽器");
            }

            $('input.fileupload').each(function(){
                var preview_box=$(this).parent().find('div.photo_preview');
                var progress_bar=$(this).parent().find('div.progress');
                var name=$(this).attr('name');
                var inteval;
                var upload_status;
                debug_var=progress_bar;
                $(this).fileupload({
                    start: function () {
                        //console.log('start');
                        progress_bar.slideDown();
                        upload_status=0;
                        progress_bar.find('div.progress-bar').css('width',upload_status+'%');

                        inteval=setInterval(function(){
                            if(upload_status==='done'){
                                progress_bar.find('div.progress-bar').css('width','100%');
                                upload_status='end';
                            }
                            else if(upload_status==='end'){
                                progress_bar.slideUp(function(){
                                    progress_bar.find('div.progress-bar').css('width','0%');
                                });
                                preview_box.slideDown();
                                clearInterval(inteval);
                            }
                            else{
                                upload_status+=5;
                                progress_bar.find('div.progress-bar').css('width',upload_status+'%');
                            }
                        },250);
                    },
                    always: function (e, data) {
                        //console.log('always');
                        upload_status='done';
                        if(data.jqXHR.status!=200){
                            alert("傳送失敗！錯誤："+data.jqXHR.statusText);
                            return;
                        }
                        var result=data.result;
                        console.log(e);
                        console.log(data);
                        if(result.search(photo_error_message_prefix)!==-1){
                            alert(result);
                            return;
                        }
                        var img=$('<img class="ready-to-show img-responsive img-rounded" src="'+upload_photo_folder+result+'" alt="" />');
                        var temp_photo_path=$('<input type="hidden" name="candidate['+name+'][photo_tmp]" value="'+data.result+'"/>')
                        preview_box.empty().append(img).append(temp_photo_path);
                        preview_box.parent().removeClass('btn-primary').addClass('btn-success');
                    }
                });
            });

            $('form#regis_form').submit(function(e){
                NProgress.start();
                var data=$(this).serializeArray();
                
                var radio_bug_array=new Array();
                $('div.btn-radio-group').each(function(){
                    var active=$(this).find('label.active');
                    if(!active.is('label')){
                        console.log("!!!");
                    }
                    else{
                        var input=active.find('input');
                        radio_bug_array.push({
                            name:input.attr('name'),
                            value:input.attr('value')
                        });
                    }
                });
                //console.log(radio_bug_array);
                
                data=data.concat(radio_bug_array)

                //console.log(data);
                
                $.ajax({
                    type: "POST",
                    url: submit_url,
                    data: data,
                    success: function(data){
                        var error=$(data).find('div.alert.alert-danger');
                        if(error.is('div')){
                            //console.log(error.html());
                            //console.log(error.text());
                            alert(error.html().replace(/<br>/g,"\n"));
                        }
                        else{
                            console.log($(data).find('div.main'));
                            debug_var=$(data);
                            $('div.main').fadeOut(function(){
                                $('div.main').empty().append($(data).find('div.main').children()).fadeIn(function(){
                                    window.history.pushState({"html":$('body').html(),"pageTitle":$('title').text()},"", submit_url);
                                    $('body').scrollTo($('h1#main_title'),800)
                                });
                            });
                            
                        }
                        //console.log(data);
                    },
                    error:function(jqXHR,textStatus){
                        alert("提交失敗！錯誤："+textStatus);
                    },
                    complete:function(){
                        NProgress.done();
                    }
                });
                e.preventDefault();
                return false;
            });
            
        };
    </script>
@stop
