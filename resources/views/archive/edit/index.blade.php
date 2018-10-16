@extends('layouts.app')
<!--中间内容区域-->
@section('content')
<div class="container container-responsive">
     
    <div class="row" style="background: #ffffff;">
        <div class="archiveMenu">
            <nav class="navbar navbar-default hr-nav" style="border: none">
                <!--<div class="container">-->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav flex" style="float: none; border-bottom: 1px solid #BBBBBB;">
                        <li class="{{ active_class(if_route('archive.edit') || if_route('archive.create')) }}">
                            <a href="javascript:void(0);" ><span><i class="iconfont">&#xe605;</i>个人信息</span></a>
                        </li>
                        @include('_parties.edit_archive_menu')
                    </ul>
                </div>

                <!--</div>-->
            </nav>
        </div>

        {!! Form::open(['url'=>route('archive.avater.upload'),'files'=>true,'id'=>'avatar']) !!}
        {!! Form::file('img',['class'=>'avatar hide','id'=>'image']) !!}
        {!! Form::close() !!}

         <form class="form-horizontal margin-top add-order-form padding-top-lg" id="add_form" style="padding-left: 4rem;padding-right: 4rem;">
            <div class="row afterboottom3 margin-left-lg margin-right-lg padding-bottom-lg">
                <div class="col-md-2 text-center">
                    <div class="uploadimgbtn-box"  id="uploadimgbtn">
                        @if( isset($archive))
                            @if( $archive->avatar)
                                <img id="headerimg" style="width: 100px; height: 100px" src="{{ $archive->avatar }}" />
                            @else
                                @if( $archive->sex == 0 )
                                    <img id="headerimg" style="width: 100px; height: 100px" src="{{ url('/img/boy.png') }}" />
                                @elseif($archive->sex == 1)
                                    <img id="headerimg" style="width: 100px; height: 100px" src="{{ url('/img/girl.png') }}" />
                                @endif
                            @endif
                        @else
                            @if( $user->sex == 0 )
                                <img id="headerimg" style="width: 100px; height: 100px" src="{{ url('/img/boy.png') }}" />
                            @elseif($user->sex == 1)
                                <img id="headerimg" style="width: 100px; height: 100px" src="{{ url('/img/girl.png') }}" />
                            @endif
                        @endif
                        {{--<img id="headerimg" style="width: 100px; height: 100px" src="{{ $archive->avatar ?? url('/img/default.png') }}" />--}}

                    </div>
                    <p class="text-left margin-top">只能上传jpg、jqeg、png格式图片</p>
                </div>
                <div class="col-md-5" style="margin-left: -8%;">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>姓名：</label>
                        <div class="col-sm-8">
                            @if(isset($archive))
                                <input type="text" id="" name="name"  class="form-control" value="{{ $archive->name }}" datatype="*" nullmsg="请输入姓名" maxlength="20" onKeypress="javascript:space_val()">
                            @else
                                <input type="text" id="" name="name"  class="form-control" value="{{ $user->name }}" datatype="*" nullmsg="请输入姓名" maxlength="20" onKeypress="javascript:space_val()">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>内部编号：</label>
                        <div class="col-sm-8">
                            @if(isset($archive))
                                <input type="text" id="local_no" name="local_no"  class="form-control" value="{{ $archive->local_no }}" datatype="*" nullmsg="请输入内部编号" maxlength="20" onkeyup="number_letter(this.value,$(this))">
                            @else
                                <input type="text" id="local_no" name="local_no"  class="form-control" value="" datatype="*" nullmsg="请输入内部编号" maxlength="20" onkeyup="number_letter(this.value,$(this))">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>邮箱：</label>
                        <div class="col-sm-8">
                            @if(isset($resume))
                                <input type="text" id="" name="email"  class="form-control" value="{{ $resume->email }}" datatype="e" nullmsg="请输入邮箱" onKeypress="javascript:space_val()">
                            @elseif(isset($archive))
                                <input type="text" id="" name="email"  class="form-control" value="{{ $archive->email }}" datatype="e" nullmsg="请输入邮箱" onKeypress="javascript:space_val()">
                            @else
                                <input type="text" id="" name="email"  class="form-control" value="{{ $user->email }}" datatype="e" nullmsg="请输入邮箱" onKeypress="javascript:space_val()">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>性别：</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="sex">
                                @if(isset($resume))
                                    <option value="0" {{ $resume->sex === '男' ? 'selected' : '' }} >男</option>
                                    <option value="1" {{ $resume->sex === '女' ? 'selected' : '' }} >女</option>
                                @elseif(isset($archive))
                                    <option value="0" {{ $archive->sex == 0 ? 'selected' : '' }} >男</option>
                                    <option value="1" {{ $archive->sex == 1 ? 'selected' : '' }}>女</option>
                                @else
                                    <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>男</option>
                                    <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>女</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>手机号码：</label>
                        <div class="col-sm-8">
                            @if(isset($resume))
                                <input type="text" id="tel" name="tel"  class="form-control" value="{{ $resume->tel }}" datatype="*" maxlength="11" nullmsg="请输入手机号码" errormsg="手机号码格式错误" onKeypress="javascript:space_val()" maxlength="8" onkeyup="number(this.value,$(this))"  onafterpaste="number(this.value,$(this))">
                            @elseif(isset($archive))
                                <input type="text" id="tel" name="tel"  class="form-control" value="{{ $archive->tel }}" datatype="*" maxlength="11" nullmsg="请输入手机号码" errormsg="手机号码格式错误" onKeypress="javascript:space_val()" maxlength="8" onkeyup="number(this.value,$(this))"  onafterpaste="number(this.value,$(this))">
                            @else
                                <input type="text" id="tel" name="tel"  class="form-control" value="{{$user->tel}}" datatype="*" maxlength="11" nullmsg="请输入手机号码" errormsg="手机号码格式错误" onKeypress="javascript:space_val()" maxlength="8" onkeyup="number(this.value,$(this))"  onafterpaste="number(this.value,$(this))">
                            @endif
                        </div>
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>

            {{-- 基本信息 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">基本信息</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>籍贯：</label>
                        <div class="col-sm-8">
                            @if(isset($resume))
                                <input type="text" id="" name="origin_address"  class="form-control" value="{{ $resume->origin_aderss }}" datatype="*" maxlength="20" nullmsg="请输入籍贯" onKeypress="javascript:space_val()">
                            @elseif(isset($archive))
                                <input type="text" id="" name="origin_address"  class="form-control" value="{{ $archive->origin_address }}" datatype="*" maxlength="20" nullmsg="请输入籍贯" onKeypress="javascript:space_val()">
                            @else
                                <input type="text" id="" name="origin_address"  class="form-control" value="" datatype="*" maxlength="20" nullmsg="请输入籍贯" onKeypress="javascript:space_val()">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>身高(cm)：</label>
                        <div class="col-sm-8">
                            @if(isset($resume))
                                <input type="text" id="height_v" name="height"  class="form-control" value="{{ $resume->height}}" datatype="*" nullmsg="请输入身高" maxlength="10" onkeyup="number_letter(this.value,$(this))">
                            @elseif(isset($archive))
                                <input type="text" id="height_v" name="height"  class="form-control" value="{{ $archive->height }}" datatype="*" nullmsg="请输入身高" maxlength="10" onkeyup="number_letter(this.value,$(this))">
                            @else
                                <input type="text" id="height_v" name="height"  class="form-control" value="" datatype="*" nullmsg="请输入身高" maxlength="10" onkeyup="number_letter(this.value,$(this))">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>出生年月：</label>
                        <div class="col-sm-8">
                            @if(isset($archive))
                                <input type="text" id="birthday" name="birthday"  class="form-control" value="{{ $archive->birthday->toDateString() }}" disabled="disabled">
                            @else
                                <input type="text" id="birthday" name="birthday"  class="form-control" value="" disabled="disabled">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>现居住地址：</label>
                        <div class="col-sm-8">
                            @if(isset($resume))
                                <input type="text" id="" name="residence"  class="form-control" value="{{ $resume->adress }}" datatype="*" nullmsg="请输入现居住地址" >
                            @elseif(isset($archive))
                                <input type="text" id="" name="residence"  class="form-control" value="{{ $archive->residence }}" datatype="*" nullmsg="请输入现居住地址" >
                            @else
                                <input type="text" id="" name="residence"  class="form-control" value="" datatype="*" nullmsg="请输入现居住地址" >
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>身份证号码：</label>
                        <div class="col-sm-8">
                            @if(isset($archive))
                                <input type="text" id="Id_card" name="Id_card"  class="form-control" value="{{ $archive->Id_card }}" datatype="*" nullmsg="请输入身份证号码" maxlength="18" onkeyup="number_letter(this.value,$(this))" oninput="check_birthday($(this))">
                            @else
                                <input type="text" id="Id_card" name="Id_card"  class="form-control" value="" datatype="*" nullmsg="请输入身份证号码" maxlength="18" onkeyup="number_letter(this.value,$(this))" oninput="check_birthday($(this))">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>婚姻状况：</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="marriage" >
                                @if(isset($resume))
                                    <option value="0" {{ $resume->marriage === '未婚' ? 'selected' : '' }}>未婚</option>
                                    <option value="1" {{ $resume->marriage === '已婚' ? 'selected' : '' }}>已婚</option>
                                    <option value="2" >离异</option>
                                @elseif(isset($archive))
                                    <option value="0" {{ $archive->marriage == 0 ? 'selected' : '' }} >未婚</option>
                                    <option value="1" {{ $archive->marriage == 1 ? 'selected' : '' }}>已婚</option>
                                    <option value="2" {{ $archive->marriage == 2 ? 'selected' : '' }}>离异</option>
                                @else
                                    <option value="0" >未婚</option>
                                    <option value="1" >已婚</option>
                                    <option value="2" >离异</option>
                                @endif
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>家庭地址：</label>
                        <div class="col-sm-8">
                            @if(isset($archive))
                                <input type="text" id="" name="address"  class="form-control" value="{{ $archive->address }}" datatype="*" nullmsg="请输入家庭地址" >
                            @else
                                <input type="text" id="" name="address"  class="form-control" value="" datatype="*" nullmsg="请输入家庭地址" >
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>身体状况：</label>
                        <div class="col-sm-8">
                            @if(isset($archive))
                                <input type="text" id="" name="healthy"  class="form-control" value="{{ $archive->healthy }}" datatype="*" nullmsg="请输入身体状况" >
                            @else
                                <input type="text" id="" name="healthy"  class="form-control" value="健康" datatype="*" nullmsg="请输入身体状况" >
                            @endif
                        </div>
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>

            {{-- 任职信息 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">任职信息</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>员工状态：</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="offer_status" >
                                @if(isset($archive))
                                    <option value="2" {{  $archive->offer_status == 2 ? 'selected' : '' }}>在职（试用期）</option>
                                    <option value="1" {{  $archive->offer_status == 1 ? 'selected' : '' }}>在职（已转正）</option>
                                    <option value="3" {{  $archive->offer_status == 3 ? 'selected' : '' }}>复职</option>
                                    {{-- <option value="0" {{  $archive->offer_status == 0 ? 'selected' : '' }}>离职</option> --}}
                                @else
                                    <option value="2" >在职（试用期）</option>
                                    <option value="1" >在职（已转正）</option>
                                    <option value="3" >复职</option>
                                    {{-- <option value="0" >离职</option> --}}
                                @endif

                            </select>
                            {{-- <input type="text" id="" name=""  class="form-control" value="" datatype="*" nullmsg="请选择员工状态" > --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>入职时间：</label>
                        <div class="col-sm-8">
                            @if(isset($archive))
                                <input type="text" id="in_date" name="offer_on_date"  class="form-control Mdata" value="{{ $archive->offer_on_date->toDateString() }}" datatype="*" nullmsg="请输入职时间" onkeyup="convert(this.value,$(this))">
                            @else
                                <input type="text" id="in_date" name="offer_on_date"  class="form-control Mdata" value="" datatype="*" nullmsg="请输入职时间" onkeyup="convert(this.value,$(this))">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>部门：</label>
                        <div class="col-sm-8">
                            <span class="choose_department" id="choose_department" onclick="showChoose('#choose_modal')">
                                + 选择部门
                            </span>
                            <div id="department_box" style="display: inline-block;">
                                @if(isset($archive))
                                    @foreach($archive->user()->withTrashed()->first()->departs as $depart)
                                       <span class="department"  name="{{ $depart->id }}">
                                            {{ $depart->name }}
                                            <i class="iconfont" onclick="delete_department(this)">&#xe619;</i>
                                        </span>
                                    @endforeach
                                @else
                                    @foreach($user->departs as $depart)
                                        <span class="department"  name="{{ $depart->id }}">
                                            {{ $depart->name }}
                                            <i class="iconfont" onclick="delete_department(this)">&#xe619;</i>
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>工作性质：</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="offer_type">
                              <option value="0" {{isset($archive) && $archive->offer_type == 0 ? 'selected' : '' }}>全职</option>
                              <option value="1" {{isset($archive) && $archive->offer_type == 1 ? 'selected' : '' }}>兼职</option>
                              <option value="2" {{isset($archive) && $archive->offer_type == 2 ? 'selected' : '' }}>实习</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>转正时间：</label>
                        <div class="col-sm-8">
                            <input type="text" id="on_date" name="offer_date"  class="form-control Mdata" value="{{isset($archive) && $archive->offer_date ? $archive->offer_date->toDateString() : '' }}" datatype="*" nullmsg="请输转正时间" onkeyup="convert(this.value,$(this))">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>职位：</label>
                        <div class="col-sm-8">
                            <input type="text" id="" name="offer_name"  class="form-control" value="{{isset($archive) ? $archive->offer_name : $user->position }}" datatype="*" nullmsg="请输入职位" onkeyup="convert(this.value,$(this))">
                        </div>
                    </div>
                </div>

                <div class="col-md-1">&nbsp;</div>
                <div style="clear: both;"></div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="must-icon">* </span>岗位职责：</label>
                        <div class="col-sm-10">
                            <div id="wangeditr"></div>
                        </div>
                    </div>
                </div>
                <div style="clear: both;"></div>
                <div style="clear: both;"></div>
            </div>

            {{-- 紧急联络人 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg" id="sos">
                <div class="archiveTitle">紧急联络人</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>紧急联络人：</label>
                         <div class="col-sm-8">
                            <input type="text" id="sos1" class="form-control" value="{{ isset($archive) ? $archive->sos[0] : '' }}" datatype="*" maxlength="20" nullmsg="请输入紧急联络人" onKeypress="javascript:space_val()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>联系方式：</label>
                        <div class="col-sm-8">
                            <input type="text" id="sos3" class="form-control" value="{{ isset($archive) ? $archive->sos[2] : '' }}" datatype="*" maxlength="11" nullmsg="请输入联系方式" errormsg="手机格式错误" onKeypress="javascript:space_val()" maxlength="8" onkeyup="number(this.value,$(this))"  onafterpaste="number(this.value,$(this))">
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>与本人关系：</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="sos2" >
                              <option value="1" {{ isset($archive) && $archive->sos[1] == 1 ? 'selected' : '' }}>父母</option>
                              <option value="2" {{ isset($archive) && $archive->sos[1] == 2 ? 'selected' : '' }}>配偶</option>
                              <option value="3" {{ isset($archive) && $archive->sos[1] == 3 ? 'selected' : '' }}>兄弟姐妹</option>
                              <option value="4" {{ isset($archive) && $archive->sos[1] == 4 ? 'selected' : '' }}>亲属</option>
                              <option value="5" {{ isset($archive) && $archive->sos[1] == 5 ? 'selected' : '' }}>好友</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>

            {{-- 能力水平 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">能力水平</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>语言能力：</label>
                         <div class="col-sm-8" id="ability1">
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="ability1" value="0" {{ isset($archive) && in_array(0,$archive->ability[0]) ? 'checked' : '' }}> 普通话
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="ability1" value="1" {{ isset($archive) && in_array(1,$archive->ability[0]) ? 'checked' : '' }}> 粤语
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="ability1" value="2" {{ isset($archive) && in_array(2,$archive->ability[0]) ? 'checked' : '' }}> 英语
                                </label>
                        </div>
                    </div>
                  
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>计算机能力：</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="ability2">
                              <option value="3" {{ isset($archive) && $archive->ability[1] == 3 ? 'selected' : '' }}>强</option>
                              <option value="2" {{ isset($archive) && $archive->ability[1] == 2 ? 'selected' : '' }}>好</option>
                              <option value="1" {{ isset($archive) && $archive->ability[1] == 1 ? 'selected' : '' }}>一般</option>
                              <option value="0" {{ isset($archive) && $archive->ability[1] == 0 ? 'selected' : '' }}>会</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>


            {{-- 专长及能力 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">专长及能力</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="must-icon">* </span>说明：</label>
                         <div class="col-sm-10">
                            <textarea class="form-control" name="evalution" rows="3" style="width: 100%">{{ isset($archive) ? $archive->evalution : '' }}</textarea>
                        </div>
                    </div>
                  
                </div>
                <div style="clear: both;"></div>
            </div>

            {{-- 内部推荐 --}}
            <div class="row margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">内部推荐</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-5">
               {{--      <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>是否推荐：</label>
                         <div class="col-sm-8">
                            <select class="form-control" id="internal1">
                              <option value="0" {{ isset($archive) && $archive->internal[0] == 0 ? 'selected' : '' }}>否</option>
                              <option value="1" {{ isset($archive) && $archive->internal[0] == 1 ? 'selected' : '' }}>是</option>
                            </select>
                        </div>
                    </div> --}}
                    {{-- class="internalis"用于判断是否选择了内部推荐控制显示 --}}

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon"> </span>内部推荐人：</label>
                        <div class="col-sm-8">
                            
                            <span class="choose_department" style=" {{  isset($archive) && $archive->internal_user ? 'display: none' : '' }} " id="choose_user_department" onclick="showChoose('#choose_user_modal')">
                                + 选择推荐人
                            </span>
                         
                            <div id="department_user_box" style="display: inline-block;">
                                @if( isset($archive) && $archive->internal_id )
                                <span class="department" name="{{ $archive->internal_id }}">
                                    {{ $archive->internal_user}}
                                    <i class="iconfont" onclick="delete_user_department(this)">&#xe619;</i>
                                </span>
                                @endif
                            </div>
                        
                        </div>
                    </div>

                </div>
         {{--        <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="must-icon">* </span>推荐人姓名：</label>
                        <div class="col-sm-8">
                            <input type="text" id="internal2"  class="form-control" value="{{ isset($archive) && $archive->internal[0] ? $archive->internal_user : '' }}"   onKeypress="javascript:space_val()" maxlength="20">
                        </div>
                    </div>
                </div> --}}
                
                <div style="clear: both;"></div>
            </div>
            <div class="text-center margin-bottom">
                <button type="submit" class="btn btn-primary margin-right" id="submitspr">保存</button>
                <a href="{{ route("archive.on") }}" class="btn btn-default">返回</a>
            </div>
         </form>
    </div>
</div>

 {{--选择部门模态框--}}
    <div class="modal fade" id="choose_modal">
        <div class="modal-dialog modalwidth-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">请选择部门</h4>
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="padding-left padding-right">
                            <div id="menuContent" class="menuContent">
                                <div class="tree_search">
                                    <label>
                                        <i class="iconfont"></i>
                                        <input type="text" id="citySel" onkeyup="AutoMatch(this,'treeBranch')" class="form-control tree-search input-md" placeholder="可输入部门"></label>
                                </div>
                                <ul id="treeBranch" class="ztree"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="submit_choose" class="btn btn-primary">保存</button>
                        <button type="button" class="btn btn-default margin-left-xs" data-dismiss="modal">关闭</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--选择人员模态框--}}
    <div class="modal fade" id="choose_user_modal">
        <div class="modal-dialog modalwidth-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">请选择内部推荐人</h4>
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="padding-left padding-right">
                            <div id="menuContent" class="menuContent">
                                <div class="tree_search">
                                    <label>
                                        <i class="iconfont"></i>
                                        <input type="text" id="citySel" onkeyup="AutoMatch(this,'treeBranchUser')" class="form-control tree-search input-md" placeholder="可输入部门"></label>
                                </div>
                                <ul id="treeBranchUser" class="ztree"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="submit_choose_user" class="btn btn-primary">保存</button>
                        <button type="button" class="btn btn-default margin-left-xs" data-dismiss="modal">关闭</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{--裁剪模态框--}}
    <div class="modal fade" id="jcorp_modal">
        <div class="modal-dialog modalwidth-lg" role="document">
            <div class="modal-content">
                    <div class="lindiv"></div>
                    {!! Form::open( [ 'url' => route('archive.avater.crop'), 'method' => 'POST','files' => true ,'id'=>'cropForm'] ) !!}
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="crop-image-wrapper" style="display: inline-block;">
                                <img src=""   id="cropbox" >
                                <input type="hidden" id="photo" name="photo" />
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                                <input type="hidden" id="width" name="width" />
                                <input type="hidden" id="height" name="height" />
                            </div>
                        </div>
                    </div>
                    <div class="am-form-group text-center padding-bottom-lg">
                        <a href="javascript:void(0)" id="close_jcorp_modal" class="btn btn-default">取消</a>
                        <button type="button" id="cropSubmit" class="btn btn-primary">裁剪头像</button>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
     <div class="fakeloader" style="position: fixed;width: 100%;height: 100%;top: 0px;left: 0px;background-color: rgba(134, 134, 134,0.2);z-index: 999; display: none; "> 
        <div class="mop-css-2 wave" style="position: absolute; top: 0;left: 0;right: 0;bottom: 0;margin: auto;"> 
            <div class="rect1"></div> 
            <div class="rect2"></div> 
            <div class="rect3"></div> 
            <div class="rect4"></div> 
            <div class="rect5"></div> 
        </div> 
    </div> 
    <div id="edit_wangeditr" style="display: none;">
    	{!! isset($archive) ?  html_entity_decode(stripslashes( $archive->offer_des)) :  '' !!}
    </div>
<style type="text/css">
    .add-order-form .control-label {
        color: #101010;
    }
     .w-e-toolbar {
        display: none;
    }
    .w-e-text-container {
        border-top: 1px solid #ccc !important;
        z-index: 100 !important;
    }
</style>
@endsection

@section('javascript')
    @parent
    <script>
        var delete_department = null;
        var showChoose;
        require(['bootstrap','dataimepicker','DataTable','layer','validform','ztree','jcrop','wangEditor'], function (bootstrap,dataimepicker,DataTable,layer,validform,ztree,jcrop,wangEditor) {

            // 富文本
            var Ed = wangEditor
            var editor = new Ed('#wangeditr')
            editor.create()
            editor.txt.html($("#edit_wangeditr").html());

            /*上传图片*/
            $("#uploadimgbtn").click(function () {
                $("#image").click();
            })
            $(document).ready(function() {
                var options = {
                    beforeSubmit:  showRequest,
                    success:       showResponse,
                    dataType: 'json'
                };
                $('#image').on('change', function(){
                    $('#avatar').ajaxForm(options).submit();
                });

                    if($("#internal1").val() == 1){
                        $(".internalis").show();
                    }else {
                        $(".internalis").hide();
                    }
            });

            function showRequest() {
                $('.fakeloader').fadeIn(100);
                $("#validation-errors").hide().empty();
                $("#output").css('display','none');
                return true;
            }
            // 初始化裁剪插件
            var jcropApi;           //定义裁剪对象，用于后面上传头像后，将头像地址替换到裁剪框里去
            $("#cropbox").Jcrop({
                allowMove : true,
                aspectRatio: 1,
                onSelect: updateCoords,
                setSelect: [110,110,10,10]

            }, function() {
              jcropApi = this;
            });
            function showResponse(response)  {
                // 上传失败
                if(response.status == false)
                {
                    layer.msg(response.message);
                    $('.fakeloader').fadeOut(100);
                } else {
                    // 上传成功
                    $('#jcorp_modal').modal();
                    // 上传成功，把图片路径放到input里去，然后提交表单的时候和其他参数（宽高，位置）一起提交到后台
                    $('#width').val(response.width);
                    $('#height').val(response.height);
                    $('#photo').val(response.url);     
                    // 上传完后，拿到图片地址，替换到裁剪框里去
                     jcropApi.setImage(response.url,function(){
                        this.setOptions({
                             allowMove : true,
                            aspectRatio: 1,
                            onSelect: updateCoords,
                            setSelect: [110,110,10,10]
                        })
                     });
                    $('.fakeloader').fadeOut(100);
                }
            }

            $("#close_jcorp_modal").click(function(){
                document.getElementById("avatar").reset()  
                $("#jcorp_modal").modal('hide');
            })

            function showcrop(){}
            function successCrop(data){
                if(data.status == true){
                    layer.msg(data.msg);
                    $("#headerimg").attr('src',data.url);
                    $('.jcrop-holder img').attr('src',data.url);
                }
                document.getElementById("avatar").reset()  
                $("#jcorp_modal").modal('hide');
            }

            $("#cropSubmit").click(function(){
                var options = {
                    beforeSubmit:  showcrop,
                    success:       successCrop,
                    dataType: 'json'
                };
                $('#cropForm').ajaxForm(options).submit();
            })

            //添加的两个function
            function updateCoords(c)
            {
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
            }

             //日期控件初始化
            var date = new Date();
            $(".Mdata").datetimepicker({
                format: 'yyyy-mm-dd',
//                   language: 'zh-CN',
                // startDate: date,
                autoclose :true,
                 minView:'month',    //选择到日，
            });
             $(".Ydata").datetimepicker({
                format: 'yyyy-mm',
//                   language: 'zh-CN',
                startDate: date,
                autoclose :true,
                 minView:3,    //选择到月，
            });

             // 监听内部推荐选框
             $("#internal1").change(function(){
                if($(this).val() == 1){
                    $(".internalis").show();
                }else {
                     $(".internalis").hide();
                }
             });
               
                var zNodes;    //部门数据
                var department_id = null; //存放选择了的部门id
                var department_name = ''; //存放选择了的部门名称
                var department_arrs = []; //存放已经选择了的部门id集合
                var uNodes;    //人员数据
                var userChoose_id = null; //存放选择了的人员id
                var userChoose_name = ''; //存放选择了的人员名字
                var max_id = "";
                $(document).ready(function(){
                    $.get('/depart/',function (data) {
                        zNodes = data;
                        InitialZtree('#treeBranch',departSetting,zNodes);
                    });
                    $.get('/depart/user',function (data) {
                        uNodes = data;
                        max_id = data[0].MaxId
                        InitialZtree('#treeBranchUser',userSetting,uNodes);
                    });
                });
                //部门配置
                var departSetting = {
                    view: {
                        showLine: false,
                    },
                    data: {
                        //如果使用的是通过父id和id来实现结构的，需要添加设置simpleData下的enable设置
                        simpleData: {
                            enable: true,
                            idKey: "id",   //设置id的字段
                            pIdKey: "prId", //设置父id的字段
                        },
                        key: {
        //                  name: "id"    //将 treeNode 的 fullName 属性当做节点名称
                        }
                    },
                    callback: {
                        onClick: nodeClick
                    }
                };

                 // 点击了部门后的执行
                function nodeClick(event, treeId, treeNode){
                    department_arrs = [];
                    department_id = treeNode.id;
                    department_name = treeNode.name;
                    console.log(treeNode)
                }

              

                 // 提交部门选择
                 $("#submit_choose").click(function(){
                       $('.fakeloader').fadeIn(100);
                        var op = 0; //判断部门是否已存在标记
                        $("#department_box").find('.department').each(function(){
                            department_arrs.push($(this).attr('name'))
                        })
                        for(var i = 0; i < department_arrs.length; i++){
                            if(department_id == department_arrs[i]){
                                op++
                            }
                        }
                        if(op == 0){
                            $("#department_box").append('<span class="department" name="'+ department_id +'">'+ department_name +'<i class="iconfont" onclick="delete_department(this)">&#xe619;</i></span>')
                        }else {
                            layer.msg("选择部门已存在");
                            $('.fakeloader').fadeOut(100);
                            return false;
                        }
                        $('.fakeloader').fadeOut(100);
              
                     $("#choose_modal").modal('hide');
                 });
                 //删除部门
                delete_department = function(t){
                    layer.msg('确定删除该部门吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        layer.close(index);
                        $(t).parents('.department').remove();
                        }
                    });
                }


                //人员配置
                var userSetting = {
                    view: {
                        showLine: false,
                    },
                    data: {
                        //如果使用的是通过父id和id来实现结构的，需要添加设置simpleData下的enable设置
                        simpleData: {
                            enable: true,
                            idKey: "id",   //设置id的字段
                            pIdKey: "prId", //设置父id的字段
                        },
                        key: {
        //                  name: "id"    //将 treeNode 的 fullName 属性当做节点名称
                        }
                    },
                    callback: {
                        beforeClick: zTreeBeforeClick,
                        onClick: usernodeClick
                    }
                };


                 // 点击了部门后的执行
                function usernodeClick(event, treeId, treeNode){
                    userChoose_id = treeNode.id;
                    userChoose_name = treeNode.name;
                }

                // 提交人员选择
                 $("#submit_choose_user").click(function(){
                        $("#department_user_box").append('<span class="department" name="'+ userChoose_id +'">'+ userChoose_name +'<i class="iconfont" onclick="delete_user_department(this)">&#xe619;</i></span>');
                        $("#choose_user_department").hide();
                     $("#choose_user_modal").modal('hide');
                 });
                 //删除人员
                delete_user_department = function(t){
                    layer.msg('确定删除该内部推荐人吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        layer.close(index);
                        $(t).parents('.department').remove();
                        $("#choose_user_department").show();
                        }
                    });
                }


                // 公用-------------------------------------------------------------------------------------树形

                  // 实例化树形插件
                function InitialZtree(docm,sett,data) {
                    $.fn.zTree.init($(docm), sett, data);
                }

                // 只能选择子节点（此处用于选择人员的时候）
                function zTreeBeforeClick(treeId, treeNode, clickFlag) {
                    return !treeNode.isParent;//当是父节点 返回false 不让选取
                };
           
                  ///根据文本框的关键词输入情况自动匹配树内节点 进行模糊查找   txtObj-----搜索框this     type---树形ul的id 
                AutoMatch = function(txtObj,type) {
                    var docmp = '#'+ type
                    if (txtObj.value.length > 0) {
                        InitialZtree(docmp,departSetting,zNodes);
                        var zTree = $.fn.zTree.getZTreeObj(type);
                        var nodeList = zTree.getNodesByParamFuzzy("name", txtObj.value);
                        InitialZtree(docmp,departSetting,nodeList);    //将找到的nodelist节点更新至Ztree内
                    } else {
                        InitialZtree(docmp,departSetting,zNodes);
                    }
                }
                // 点击触发选择部门模态框     modalID---模态框的id，需要带#
                showChoose =  function(modalID) {
                    $('.modal').on('show.bs.modal', centerModals);  // 在模态框出现的时候调用垂直居中函数
                    $(window).on('resize', centerModals);  // 在窗口大小改变的时候调用垂直居中函数
                    $(modalID).modal();
                }
 
                // 公用<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<树形



            


                
                $("#add_form").Validform({
                tiptype: function (msgs, o, cssctl) {
                    if (o.type != 2) {     //只有不正确的时候才出发提示，输入正确不提示
                        layer.msg(msgs);
                    }
                },
                ajaxPost: true,//true用ajax提交，false用form方式提交
                tipSweep: true,//true只在提交表单的时候开始验证，false每输入完一个输入框之后就开始验证
                beforeCheck:function(curform){
                    
                    //在表单提交执行验证之前执行的函数，curform参数是当前表单对象。
                    //这里明确return false的话将不会继续执行验证操作;    
                },
                beforeSubmit: function (curform) {
                    $('.fakeloader').fadeIn(100);
                     // 格式化数据（超级坑）----------------------------------------------------------------------------------------
                     var nameData = GetWebControls('#add_form');      //根据name值拿的数据（一对一）
                     var imgSrc = $("#headerimg").attr('src')  //头像地址
                     var offer_des = editor.txt.html()     //岗位职责
                     var offer_depart = []   //任职部门岗位
                     $("#department_box").find('.department').each(function(){
                            offer_depart.push($(this).attr('name'))
                     })
                     // 如果没有选择部门要提示
                     if(offer_depart.length == 0){
                        layer.msg("请选择任职部门");
                        $('.fakeloader').fadeOut(100);
                        return false;
                     }
                     var sos = [$("#sos1").val(), $("#sos2").val(), $("#sos3").val()]   //紧急联系人
                     var ability1 = [];  //能力水平---语言能力
                     $("#ability1").find('.ability1').each(function(){
                        if ($(this).is(':checked')) {
                            ability1.push($(this).val())
                        }
                     });
                     var ability = [ability1, $("#ability2").val()]    //能力水平
                     var internal =  $("#department_user_box").find('.department').attr("name") - max_id;

                     // 提交到后台的数据
                     var postData = nameData;
                     postData.avatar = imgSrc;
                     postData.offer_des = offer_des;
                     postData.offer_depart = offer_depart;
                     postData.sos = sos;
                     postData.ability = ability;
                     postData.internal = internal;
                     postData.user_id = "{{ isset($user) ? $user->id  : '' }}";
                     console.log(postData)
                     // return false;
                     AjaxJson('/archive/store/' + '{{ isset($archive) ? $archive->id  : '' }}',postData,function(data){
                        if(data.status){
                            layer.msg(data.msg);
                            setTimeout(function(){
                                $('.fakeloader').fadeOut(100);
                                // window.location.href = '/archive/' + data.archive_id + '/edit'
                            },2000)
                        }else {
                            $('.fakeloader').fadeOut(100);
                            layer.msg(data.msg)
                        }
                     })
                 
                         
                         
                     
                    return false;
                }
            });
        })
    </script>
@endsection