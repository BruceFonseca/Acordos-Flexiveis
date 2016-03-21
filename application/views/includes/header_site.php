<!-- página que carregará apenas o menu de cada usuário de acordo com sua Role -->
<header id="header-principal">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="navbar-header">
                    <img id="logo-login" src="<?php echo base_url('img/sistema/logotipo/logo.png' )?>" alt=""/>
                <h1>COE - Flexibilidade</h1>
                </div>
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