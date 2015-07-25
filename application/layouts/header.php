<?php require_once $_SERVER["DOCUMENT_ROOT"].'/BibliotecaFupWeb/config.ini.php';
 require_once BASEPATH .'library/Helpers.php';
 session_start();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>::Biblioteca FUP::</title>
                
        <link type="text/css" media="screen" rel="stylesheet" href="<?php echo BASEURL;?>public/css/zebra_form.css" />
           
        
        <script type="text/javascript" src="<?php echo BASEURL;?>public/js/jquery-1.10.2.js"></script>
        <!-- <script type="text/javascript" src="<?php echo BASEURL;?>public/js/jquery-1.8.0.min.js"></script> -->
        <script type="text/javascript" src="<?php echo BASEURL;?>public/js/jquery-ui-1.10.4.custom.js"></script>

        <script type="text/javascript" src="<?php echo BASEURL;?>public/js/zebra_form.js"></script>
        
        <script type="text/javascript" src="<?php echo BASEURL;?>public/js/hideshow.js"></script>
        <script type="text/javascript" src="<?php echo BASEURL;?>public/js/jquery.tablesorter.min.js"></script>
        <script type="text/javascript" src="<?php echo BASEURL;?>public/js/jquery.equalHeight.js"></script>
        <script type="text/javascript" src="<?php echo BASEURL;?>public/js/general.js"></script>
        
        <script type="text/javascript" src="<?php echo BASEURL;?>public/js/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo BASEURL;?>public/js/jquery.numeric.js"></script>
        
        <!-- Datatable -->
        <script type="text/javascript" src="<?php echo BASEURL;?>public/js/datatable/jquery.dataTables.js"></script>
        
        
        <!-- css black -->
       <!-- <link type="text/css" media="screen" rel="stylesheet" href="<?php echo BASEURL;?>public/css/datatable/jquery.dataTables_themeroller_black.css" /> -->
       <!-- <link type="text/css" media="screen" rel="stylesheet" href="<?php echo BASEURL;?>public/css/black-tie/jquery-ui-1.10.4.custom.css" /> -->
       <!-- <link type="text/css" media="screen" rel="stylesheet" href="<?php echo BASEURL;?>public/css/layout_black.css" /> -->
        
        <!-- css blue -->
        <link type="text/css" media="screen" rel="stylesheet" href="<?php echo BASEURL;?>public/css/datatable/jquery.dataTables_themeroller_blue.css" />
        <!-- <link type="text/css" media="screen" rel="stylesheet" href="<?php echo BASEURL;?>public/css/cupertino/jquery-ui.css" /> -->
        <link type="text/css" media="screen" rel="stylesheet" href="<?php echo BASEURL;?>public/css/smoothness-gris/jquery-ui.css" />
        <link type="text/css" media="screen" rel="stylesheet" href="<?php echo BASEURL;?>public/css/layout_blue.css" />
        
    </head>
    
 <body>

  <!-- <header id="header">
    <hgroup>
      <h1 class="site_title"><a href="index.html">Website</a></h1>
      <h2 class="section_title">Gesti&oacute;n docentes FUP</h2><div class="btn_view_site"></div>
    </hgroup>
  </header>  end of header bar -->   


<header id="header">
    <hgroup>
      <h1 class="site_title"><img src="<?php echo BASEURL;?>public/images/fup_logo.png" style="width:45%; height: 175%;"></h1>
      <h1 class="site_title"><img src="<?php echo BASEURL;?>public/images/cabecera_web2.png" style="height:175%; width: 325%;"></h1>
    </hgroup>
</header>

     