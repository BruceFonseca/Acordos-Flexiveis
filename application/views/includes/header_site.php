<!-- página que carregará apenas o menu de cada usuário de acordo com sua Role -->
<header id="header-principal">
    <nav class="navbar navbar-default">

        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php foreach ($menu_list->result() as $menu): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><?php echo ucwords($menu->menu) ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($submenu_list->result() as $submenu): ?>
                                <?php if($menu->id_menu==$submenu->id_menu):?>
                                    <li>
                                        <a href="#"  ctr= '<?php echo $submenu->controller ?>'><?php echo ucwords($submenu->submenu) ?></a>
                                    </li>
                                <?php endif;?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href='home/logout'>Sair</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href='#'> <?php echo $role; ?></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href='#'> <?php echo $dsc_name; ?></a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>