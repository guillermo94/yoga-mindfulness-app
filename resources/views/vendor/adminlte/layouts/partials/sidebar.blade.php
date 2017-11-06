<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Opciones</li>
            <!-- Optionally, you can add icons to the links -->

            @if($__env->yieldContent('PageName') == 'Home')
            <li class="active">
            @else 
            <li>
            @endif

            <a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            @if($__env->yieldContent('PageName') == 'AddLesson' || $__env->yieldContent('PageName') == 'ModifyLesson')
            <li class="treeview active">
            @else 
            <li class="treeview">
            @endif
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.submenulessons') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @if($__env->yieldContent('PageName') == 'AddLesson')
                    <li class="active">
                    @else 
                    <li>
                    @endif<a href="{{ url('addlesson') }}">{{ trans('adminlte_lang::message.linkaddlesson') }}</a></li>
                    <li><a href="{{ url('editlesson') }}">{{ trans('adminlte_lang::message.linkmodlesson') }}</a></li>
                </ul>
            </li>
             <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.submenuprograms') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    
                    <li><a href="{{ url('addprogram') }}">{{ trans('adminlte_lang::message.linkaddprogram') }}</a></li>
                    <li><a href="{{ url('editprogram') }}">{{ trans('adminlte_lang::message.linkmodprogram') }}</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
