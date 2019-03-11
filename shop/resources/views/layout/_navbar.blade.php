<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">zloo77</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品分类管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('menu_cates.create') }}">添加分类</a></li>
                        <li><a href="{{ route('menu_cates.index') }}">分类列表</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('menus.create') }}">添加菜品</a></li>
                        <li><a href="{{ route('menus.index') }}">菜品列表</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">订单管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('order.index') }}">订单列表</a></li>
                        <li><a href="{{ route('order.orderWeek') }}">最近7天订单统计</a></li>
                        <li><a href="{{ route('order.orderMonth') }}">前3个月订单统计</a></li>
                        <li><a href="{{ route('menus.index') }}">最近7天菜品销量</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">最新活动 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('activitys.index') }}">最新活动</a></li>
                        <li><a href="{{ route('event_members.index') }}">抽奖活动</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('login') }}">登录</a></li>
                @endguest
                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            {{ auth()->user()->name }}
                            管理员<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('users.editpwd') }}">修改密码</a></li>
                            <li><a href="{{ route('admins.index') }}">修改头像</a></li>
                            <li><a href="{{ route('admins.index') }}">店铺信息</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}">退出登录</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>