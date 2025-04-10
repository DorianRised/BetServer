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
                        <li><a href="{{route('apuestas.index')}}">Apuestas</a></li>
                    </ul>
                        <!-- <li><a href="users" data-key="t-usuarios">Usuarios</a></li>
                        <li><a href="clientes" data-key="t-clientes">Clientes</a></li>
                        <li><a href="vehiculos" data-key="t-vehiculos">Vehículos</a></li>
                        <li><a href="tipo-servicios" data-key="t-tipoServicio">Tipo de servicios</a></li>
                        <li><a href="marcas" data-key="t-marcas">Marcas</a></li>
                        <li><a href="sucursales" data-key="t-sucursales">Sucursales</a></li>
                        <li><a href="empresas" data-key="t-empresas">Empresas</a></li>
                </li>
                @if (request()->is('dashboard') || request()->is('/'))
                    <li class="menu-title" data-key="t-filtrosLabel">Filtros</li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="icon nav-icon" data-eva="funnel-outline"></i>
                            <span class="menu-item" data-key="t-filtros">filtros</span>
                            <i class="icon nav-icon" data-eva="plus-outline" style="font-size: 36px; margin-left: 120px;"></i>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><select name="TipoVenta" id="TipoVenta" class="form-control" data-trigger>
                                <option value="">Tipo de Venta</option>
                            </select></li>
                            <li><select name="marca" id="marca" class="form-control" data-trigger>
                                <option value="">Marca</option>
                            </select></li>
                            <li><select name="sucursal" id="sucursal" class="form-control" data-trigger>
                                <option value="">Sucursal</option>
                            </select></li>
                            <li><select name="modelo" id="modelo" class="form-control" data-trigger>
                                <option value="">Modelo</option>
                            </select></li>
                            <li><select name="asesor" id="asesor" class="form-control" data-trigger>
                                <option value="">Asesor</option>
                            </select></li>
                            <li><select name="tipoPago" id="tipoPago" class="form-control" data-trigger>
                                <option value="">Tipo de pago</option>
                            </select></li>
                            <li>
                            <p>Precio</p>
                            </li> -->
                        </ul>
                    </li>
                @endif 

                <!-- <li id="cambio-tema" style="margin-top: 10%;">
                    <a href="javascript: void(0);">
                        <i class="icon nav-icon" data-eva="moon-outline"></i>
                        <span class="menu-item" >Modo Dark</span>
                    </a>
                </li> -->
            </ul> 
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

@section('scripts')
 
@endsection