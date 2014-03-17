@extends('layout')

@section('content')
    <div class="alert alert-success">{{$info;}}</div>
    @foreach ($candidate as $element)
        <div class="panel panel-default">
	        <div class="panel-heading">
	            <h3 class="panel-title">{{ $const['type2name'][$element->regis_type] }} - 候選人資料</h3>
	        </div>
	        <div class="panel-body">
	        	<div class="row">
		        	<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
		        		<img src="{{asset($const['uploaded_photo_folder'].$element->id);}}" style="width:100%;" alt="">
		        	</div>
		        	<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
		        		<table class="table table-striped">
							<tbody>
								<tr>
									<td>姓名</td>
									<td>{{ $element->name; }}</td>
								</tr>
								<tr>
									<td>性別</td>
									<td>{{ $const['sex2string'][$element->sex]; }}</td>
								</tr>
								<tr>
									<td>系級</td>
									<td>{{ $element->depart; }}</td>
								</tr>
								<tr>
									<td>電話號碼</td>
									<td>{{ $element->phone; }}</td>
								</tr>
								<tr>
									<td>電子信箱</td>
									<td>{{ $element->email; }}</td>
								</tr>
								<tr>
									<td colspan="2"><?php if($element->agree)echo '已同意個人資料提供同意書'; ?></td>
								</tr>
							</tbody>
		        		</table>
		        	</div>
	        	</div>
	        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        		<div class="jumbotron box_bg box_bg_">
	        			<p>驗證碼：</p>
	        			<h3 class="text_emphsis">{{ $element->code; }}</h3>
	        		</div>
	        	</div>
	        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        		<div class="well">
	        			<h2>經歷</h2>
	        			<p>{{ nl2br($element->exp); }}</p>
	        		</div>
	        	</div>
	        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        		<div class="well">
	        			<h2>政見</h2>
	        			<p>{{ nl2br($element->politics); }}</p>
	        		</div>
	        	</div>
        	</div>
        </div>
    @endforeach
    <a href="{{ route('index'); }}" type="button" class="btn btn-primary btn-lg btn-block btn-sm">回首頁</a>
    <div class="row">　</div>
@stop
