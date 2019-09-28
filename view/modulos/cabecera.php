<header class="main-header">
    <!-- ======================================= -->
    <!--    LOGOTIPO        -->
    <!-- ======================================= -->
    <a href="inicio" class="logo">
        <!-- logo normal -->
        <span class="logo-lg">
            <img src="view/img/plantilla/15.png" class="img-responsive" style="padding:10px 0px">
        </span>
        <!-- logo mini -->
        <span class="logo-mini">
            <img src="view/img/plantilla/02.png" class="img-responsive" style="padding:10px">
        </span>
    </a>

    <!-- ======================================= -->
    <!--    BARRA DE NAVEGACION    -->
    <!-- ======================================= -->

    <nav class="navbar navbar-static-top" role="navigation">
        
        <!-- Boton de Navegacion -->

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

            <span class="sr-only"></span>
        
        </a>

        <!-- Perfil de Usuario -->

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <!--<img src="" class="user-image">
                        {# <img src="view/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> #}-->

                        <span class="hidden-xs">

                            <i class="fa fa-user"></i>

                            <?php

                                if(isset($_SESSION['ACL']['usuario_activo']['usuario']))
                                {
                                    echo "Usuario: {$_SESSION['ACL']['usuario_activo']['usuario']}";
                                }

                            ?>
                        </span>

                    </a>

                    <!-- Dropdown-toggle -->

                    <ul class="dropdown-menu">

                        <li class="user-body">

                            <div class="pull-left">

                                <a href="config" class="btn btn-default btn-flat">

                                    <span>

                                        <i class="fa fa-cog"></i>

                                    </span>

                                    Configuración
                                </a>

                            </div>

                            <div class="pull-right">

                                <a href="salir" class="btn btn-default btn-flat">

                                    <span>

                                        <i class="fa fa-sign-out"></i>

                                    </span>

                                    Salir
                                </a>

                            </div>

                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </nav>

</header>