 <!-- esta página ´pe responsável pelos carregamentos de arquivos js, css etc... -->

<html>
    <head>
        <title> COE - FLEXIBILIDADE </title>

        <meta charset="UTF-8">
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->
        <meta name="viewport" content="width=device-width">

        <script type="text/javascript" src=<?php echo base_url("js/jquery-2.1.0.js" )?>></script>
        <script type="text/javascript" src=<?php echo base_url('js/bootstrap.min.js') ?>></script>
        <script type="text/javascript" src=<?php echo base_url('js/jquery.form.js') ?>></script>
        <script type="text/javascript" src=<?php echo base_url('js/jquery-ui.min.js') ?>></script>
        <!-- home é o aruivo JS que tem todos eventos referentes ao funcionamnto das abas e respectivos conteudos -->
        <script type="text/javascript" src=<?php echo base_url('js/abas.js') ?>></script>
        <script type="text/javascript" src=<?php echo base_url('js/editor.js') ?>></script>

        <link rel="stylesheet" type="text/css" href= <?php echo base_url("css/editor.css" )?> />
        <link rel="stylesheet" type="text/css" href= <?php echo base_url("css/bootstrap.css" )?> />
        <link rel="stylesheet" type="text/css" href= <?php echo base_url("css/bootstrap-theme.css" )?> />
        <link rel="stylesheet" type="text/css" href= <?php echo base_url("css/custom.css" )?> />
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    </head>

    <body>
		<main>	
         <div class="apontamento">...</div>  <!-- esta tag receberá os balores de apontamento -->
        <!-- <div class="container-apontamento"> -->
         <div class="dados_componente"></div>
        <!-- </div>