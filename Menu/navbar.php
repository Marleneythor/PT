        <?php
            $URL_BASE = '/PT/'
            
        ?>

        <nav class="w-full bg-blue-900 shadow-lg">
            <div class="container mx-auto flex items-center justify-between px-4 py-3">
                <div class="flex items-center">
                    <img src="<?=$URL_BASE?>/public/images/fondo.png" class="w-16 h-auto mr-4" alt="Logo">
                    <a class="text-white text-lg font-bold" href="<?=$URL_BASE?>/Menu/Menu.php">EDD</a>
                </div>
                <button class="text-white text-2xl md:hidden" id="menu-toggle">☰</button>
                <ul class="hidden md:flex space-x-6 text-white font-medium">
                    <li><a class="hover:text-blue-300" href="<?=$URL_BASE?>Perfil/perfilView.php">Perfil</a></li>
                    <li><a class="hover:text-blue-300" href="<?=$URL_BASE?>RequisitosDeInicio/requisitosDeInicioView.php">Requisitos de Inicio</a></li>
                    <li><a class="hover:text-blue-300" href="#">Buscar</a></li>
                    <li><a class="hover:text-blue-300" target="_blank" href="https://edd.tecnm.mx/docentes/index.php">Ayuda</a></li>
                    <li><a class="hover:text-blue-300" href="<?=$URL_BASE?>cerrarSesion/cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
            <div class="hidden bg-blue-800 md:hidden" id="mobile-menu">
                <ul class="text-white text-center py-2 space-y-2">
                    <li><a class="block py-2 hover:bg-blue-700" href="<?=$URL_BASE?>Perfil/perfilView.php">Perfil</a></li>
                    <li><a class="block py-2 hover:bg-blue-700" href="<?=$URL_BASE?>RequisitosDeInicio/requisitosDeInicioView.php">Requisitos de Inicio</a></li>
                    <li><a class="block py-2 hover:bg-blue-700" href="#">Buscar</a></li>
                    <li><a class="block py-2 hover:bg-blue-700" target="_blank" href="https://edd.tecnm.mx/docentes/index.php">Ayuda</a></li>
                    <li><a class="block py-2 hover:bg-blue-700" href="<?=$URL_BASE?>cerrarSesion/cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </nav>
