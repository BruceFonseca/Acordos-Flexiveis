<!-- página que carregará apenas o menu de cada usuário de acordo com sua Role -->
<header id="header-principal">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <!-- <a class="navbar-brand" href="#">CNH Industrial</a> -->
                <img id="logo-login" src="<?php echo base_url('img/sistema/logotipo/logo.png' )?>" alt=""/>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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