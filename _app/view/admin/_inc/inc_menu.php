    <!-- sidebar-->
    <aside class="aside">
        <!-- START Sidebar (left)-->
        <div class="aside-inner">
            <nav data-sidebar-anyclick-close="" class="sidebar">
                <!-- START sidebar nav-->
                <ul class="nav menu">
                    <!-- Iterates over all sidebar items-->
                    <li class="nav-heading ">
                        <span>USUÁRIO</span>
                    </li>
                    <li>
                        <a href="<?=DIR_ADM_HTM_ROOT?>usuario/dados"><em class="material-icons">perm_contact_calendar</em> Meus dados</a>
                    </li>
                    <li>
                        <a href="<?=DIR_ADM_HTM_ROOT?>logout"><em class="material-icons">exit_to_app</em> Sair</a>
                    </li>

                    <li class="nav-heading ">
                        <span>RESERVAS</span>
                    </li>
                    <li>
                        <a href="<?=DIR_ADM_HTM_ROOT?>reservas" title="Agenda"><em class="material-icons">today</em> Agenda</a>
                    </li>
                    <li>
                        <a href="<?=DIR_ADM_HTM_ROOT?>reservas/listar" title="Listar"><em class="material-icons">list</em> Listar reservas</a>
                    </li>
                    <li>
                        <a href="<?=DIR_ADM_HTM_ROOT?>reservas/editar" title="Inserir"><em class="icon-display fa fa-plus-square-o"></em> Criar reserva</a>
                    </li>

                    <li class="nav-heading ">
                        <span>REGIÕES</span>
                    </li>
                    <li>
                        <a href="<?=DIR_ADM_HTM_ROOT?>regioes/listar-comunas" title="Listar"><em class="material-icons">list</em> Listar comunas</a>
                    </li>
                    <li>
                        <a href="<?=DIR_ADM_HTM_ROOT?>regioes/editar-comuna" title="Inserir"><em class="icon-display fa fa-plus-square-o"></em> Inserir comuna</a>
                    </li>
                    <li>
                        <a href="<?=DIR_ADM_HTM_ROOT?>regioes/listar-bairros" title="Listar"><em class="material-icons">list</em> Listar bairros</a>
                    </li>
                    <li>
                        <a href="<?=DIR_ADM_HTM_ROOT?>regioes/editar-bairro" title="Inserir"><em class="icon-display fa fa-plus-square-o"></em> Inserir bairro</a>
                    </li>
                    
                    <li class="nav-heading ">
                        <span>USUÁRIOS</span>
                    </li>
                    <li>
                        <a href="<?=DIR_ADM_HTM_ROOT?>usuarios/listar" title="Listar"><em class="material-icons">list</em> Listar usuários</a>
                    </li>
                    <li>
                        <a href="<?=DIR_ADM_HTM_ROOT?>usuarios/editar" title="Inserir"><em class="icon-display fa fa-plus-square-o"></em> Inserir usuário</a>
                    </li>
                </ul>
                <!-- END sidebar nav-->
            </nav>
        </div>
        <!-- #END# Sidebar (left)-->
    </aside>
