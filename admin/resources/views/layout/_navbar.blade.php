
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">zloo77</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">zloo77</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $Dmenus = \App\Models\Nva::where('pid',0)->get();
//                var_dump($Dmenus);exit;
                $menus =  \App\Models\Nva::where('pid','!=',0)->get();
                ?>
                @foreach($Dmenus as $Dmenu)
                 @if(auth()->user())  @if(\Illuminate\Support\Facades\Auth::user()->can($Dmenu->permission->name))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$Dmenu->name}} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($menus as $menu)
                                    @if($menu->pid == $Dmenu->id)
                                        <li><a href="{{route($menu->url)}}">{{$menu->name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    @endif
                    @endforeach
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
                            <li><a href="{{ route('admins.create') }}">添加管理员</a></li>
                            <li><a href="{{ route('admins.index') }}">管理员列表</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}">退出登录</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>