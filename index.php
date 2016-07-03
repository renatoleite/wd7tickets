<?
/* Faz requisição do topo dos tickets */
require('./topo.php');

/* Recebe o id do cliente */
$wd7TicketIdCliente = WD7Sessions::GetSession('WD7TicketIdCliente');
/* Recebe o id do funcionario */
$wd7TicketIdFuncionario = WD7Sessions::GetSession('WD7TicketIdFuncionario');

/* Valida se algum usuário ou senha foram passados */
if((!isset($wd7TicketIdCliente)) && ($pag != 'admin')){
    if(isset($wd7TicketIdFuncionario)){
        header("Location: admin");
        exit;
    }else{
        echo "<script>alert('Para usar esse serviço você precisa ser um cliente.');</script>";
        exit;
    }
}elseif((!isset($wd7TicketIdFuncionario)) && ($pag == 'admin')){
    echo "<script>alert('Acesso para administradores somente.');</script>";
    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- Site desenvolvido por WD7 - www.wde7.com -->
<html>
<head>
    <?
    /** Define o titulo */
    if(!isset($pag)){
        $complementoTitulo = ' | Principal';
    }elseif(file_exists('./pag/'.$pag.'.php')){
        $complementoTitulo = ' | ' . ucwords($pag);
    }
    ?>
    <title><? echo _WD7Tickets_Titulo_ . $complementoTitulo; ?></title>
    <base href="<? echo _WD7_URLSite_; ?>">
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
    <!-- Aqui definimos estilos e javascripts abstratos do sistema -->
    <link href="./temp/wd7tickets.css" type="Text/CSS" rel="Stylesheet">
    <!-- Aqui definimos estilos do template -->
    <link href="./templates/<? echo _WD7Tickets_Template_ ?>/estilo.css" type="Text/CSS" rel="Stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" type="text/javascript"></script>
    
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

        <?
        /* Quando o administrador que estiver usando, não ser necessario a exibição
         * do menu.
         */
        if($pag != 'admin'){
            echo "
                <!--  Menu -->
                    <ul id=\"menu\">
                        <li><a href='principal'>Principal</a></li>
                        <li><a href='novoticket'>Abrir Ticket</a></li>
                        <li><a href='consultarticket'>Consultar Ticket</a></li>
                    </ul>
                <!-- Fim do menu -->
                ";
        }
        ?>

        <!-- Conteudo -->
        <br>
        <div style="padding: 10px">

        <?
            if ($pag == "principal") {
                $pagina = "./inc/pag/consultarticket.php";
            }elseif ($pag == "consultarticket") {
                $pagina = "./inc/pag/consultarticket.php";
            }elseif ($pag == "novoticket") {
                $pagina = "./inc/pag/novoticket.php";
            }elseif ($pag == "admin") {
                $pagina = "./inc/pag/administrador.php";
            }

            if((isset($pagina)) and (file_exists($pagina))) {
                require ($pagina);
            }else{
                require ("./inc/pag/consultarticket.php");
            }
        ?>

        </div>
        <!-- Fim do conteudo -->

    </div>

    <br>

    <div id="rodape">
        WD7 Tickets 1.0.0.1 <u>beta</u> - Todos os direitos reservados.<br>
        Desenvolvido por Agência WD7.
    </div>

</body>
</html>