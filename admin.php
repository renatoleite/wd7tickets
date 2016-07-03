<?
/* Faz requisição do topo dos tickets */
require('../topo.php');

/* Recebe o id do cliente */
$wd7TicketIdFuncionario = WD7Sessions::GetSession('WD7TicketIdFuncionario');
if(!isset($wd7TicketIdFuncionario)){
    echo "<script>alert('Acesso para administradores somente.');</script>";
    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- Site desenvolvido por WD7 - www.wde7.com -->
<html>
<head>
    <title><? echo _WD7Tickets_Titulo_ . " - Administrador"; ?></title>
    <base href="<? echo _WD7_URLSite_; ?>">
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
    <!-- Aqui definimos estilos e javascripts abstratos do sistema -->
    <link href="./temp/wd7tickets.css" type="Text/CSS" rel="Stylesheet">
    <!-- Aqui definimos estilos do template -->
    <link href="./templates/<? echo _WD7Tickets_Template_ ?>/estilo.css" type="Text/CSS" rel="Stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="./plugins/precos/precoswd7.css" type="text/css" media="all">
    <script src="./temp/wd7tickets.js" type="text/javascript"></script>
    <link type='text/css' href='./plugins/modalbox/css/basic.css' rel='stylesheet' media='screen' />
    <script type='text/javascript' src='./plugins/modalbox/js/jquery.simplemodal.js'></script>
    <script type='text/javascript'>
        jQuery(function ($) {
            $('#basic-modal .basic').click(function (e) {
                $('#basic-modal-content').modal();
                return false;
            });
        });
    </script>
</head>

<body>

    <div id="bgTopo"></div>

    <div id="conteudo">
        <!-- Conteudo -->
        <div style="padding: 10px">

        <?
            if ($pag == "principal") {
                $pagina = "../inc/pag/consultarticket.php";
            }

            if((isset($pagina)) and (file_exists($pagina))) {
                require ($pagina);
            }else{
                require ("../inc/pag/administrador.php");
            }
        ?>

        </div>
        <!-- Fim do conteudo -->

    </div>

</body>
</html>