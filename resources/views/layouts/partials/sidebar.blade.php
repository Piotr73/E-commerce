<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">FUNCIONES</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
                <a href="{{url('/home')}}"><i class="fa fa-home"></i><span>Inicio</span></a>
            </li>
            <li class="treeview">
                <a href="{{ url('usuarios/usuario') }}"><i class='fa fa-users'></i> <span>Usuarios</span> </a>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>Personas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('personas/trabajador')}}">Personal</a></li>
                    <li><a href="{{url('personas/cliente')}}">Clientes</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-table'></i> <span>Almacén</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('almacen/marca')}}">Marcas</a></li>
                    <li><a href="{{url('almacen/categoria')}}">Categorías</a></li>  
                    <li><a href="{{url('almacen/modelo')}}">Modelos</a></li>
                    <li><a href="{{url('almacen/producto')}}">Productos</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-laptop'></i> <span>Panel</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('panel/slider')}}">Slider</a></li>
                    <li><a href="{{url('panel/footer')}}">Footer</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
