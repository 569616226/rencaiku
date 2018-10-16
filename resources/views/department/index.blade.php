<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>东华国际·人力资源</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">通讯录</h3>
    </div>
    <div class="panel-body">
        <div class="btn-group" role="group" aria-label="...">
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    @foreach($departments as $department)

                        @if ($loop->first)
                            <li role="presentation" class="active">
                                <a href="#{{ $department->id }}" aria-controls="{{ $department->id }}" role="tab" data-toggle="tab" onclick="fpfun(this)">
                                    {{ $department->name }}
                                </a>
                            </li>
                        @endif

                        @if($loop->index == 0)
                            @continue
                        @endif

                        <li role="presentation">
                            <a href="#{{ $department->id }}" aria-controls="{{ $department->id }}" name="{{ $department->id }}" role="tab" data-toggle="tab" onclick="fpfun(this)">
                                {{ $department->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @foreach($departments as $department)
                        @if ($loop->first)
                            <div role="tabpanel" class="tab-pane active" id="{{ $department->id }}">
                                <ul class="list-group">
                                    <li class="list-group-item">....</li>
                                    <li class="list-group-item">Dapibus ac facilisis in</li>
                                    <li class="list-group-item">Morbi leo risus</li>
                                    <li class="list-group-item">Porta ac consectetur ac</li>
                                    <li class="list-group-item">Vestibulum at eros</li>
                                </ul>
                            </div>
                        @endif

                        @if($loop->index == 0)
                            @continue
                        @endif

                        <div role="tabpanel" class="tab-pane" id="{{ $department->id }}">
                            <ul class="list-group">
                                <li class="list-group-item">....</li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Morbi leo risus</li>
                                <li class="list-group-item">Porta ac consectetur ac</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="{{ url('/js/main.js') }}"></script>
<script>
    function fpfun(e) {
        var url = '/depart/members';
        AjaxJson(url,{department_id:$(e).attr("name")},function (data) {
            //
        });
    }
</script>

</body>
</html>