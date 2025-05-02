<style>

#sidebar-menu ul li ul.sub-menu:before {
    content: "";
    position: absolute;
    left: 100px;
    top: 10px;
    bottom: 10px;
    width: 0px !important;
}

#sidebar-menu ul li ul.sub-menu {
    margin-left: 10% !important;
} 

#sidebar-menu ul li ul.sub-menu li {
    padding: 10px;
}

.alto_a{ 
    height: 75px;
    display: flex;
    align-items: center;
}

/* .img{ 
    margin-top: 200px !important;
    margin-left: 0 !important;
} */


</style>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" >

    <!-- LOGO -->
    <div class="navbar-brand-box alto_a" style="margin-left: 0 !important; margin-top:20px;">
        <a href="dashboard">
                <!-- <img src="{{ URL::asset('build/images/BUGO.png') }}" alt="" style="height: 75px !important; width:150px !important; margin-top: 15px; margin-left: 30px"> -->
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn" >
    <i class="icon nav-icon" data-eva="menu-outline"></i>
    </button>

    <div style="margin-top: 50% !important"></div>

    <div data-simplebar class="sidebar-menu-scroll" style="height: calc(100% - 101px) !important;">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Navegación</li>

               <li>
                    <!-- <a href="javascript: void(0);">

                        <i class="icon nav-icon" data-eva="grid-outline"></i>
                        <span class="menu-item" data-key="t-nav">Navegación</span>
                        <i class="icon nav-icon text-info" data-eva="plus-outline"></i>

                    </a> -->
                    <ul class="filter-menu" aria-expanded="false">
                        <li><a href="{{route('usuarios.index')}}">Usuarios</a></li>
                    <ul>
                    <ul class="filter-menu" aria-expanded="false">
                        <li><a href="{{route('apuestas.index')}}">Apuestas</a></li>
                    </ul>
                    <ul class="filter-menu" aria-expanded="false">
                        <li><a href="{{route('eventos.index')}}">Eventos</a></li>
                    </ul>
                    <ul class="filter-menu" aria-expanded="false">
                        <li><a href="{{route('deportes.index')}}">Deportes</a></li>
                    </ul>
                    <ul class="filter-menu" aria-expanded="false">
                        <li><a href="{{route('ligas.index')}}">Ligas</a></li>
                    </ul>
                    <ul class="filter-menu" aria-expanded="false">
                        <li><a href="{{route('grupos.index')}}">Grupos</a></li>
                    </ul>
                    <ul class="filter-menu" aria-expanded="false">
                        <li><a href="{{route('tipsters.index')}}">Tipsters</a></li>
                    </ul>
                    <ul class="filter-menu" aria-expanded="false">
                        <li><a href="{{route('tipo-apuestas.index')}}">Tipo apuestas</a></li>
                    </ul>
                    <ul class="filter-menu" aria-expanded="false">
                        <li><a href="{{route('parlays.index')}}">Parlays</a></li>
                    </ul>
                    
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar sesión</a>
                            </form>
                        </li>
                    </ul>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

@section('scripts')
 
@endsection