<?
/* Carrego as classes */
require('./inc/classes/categoria.class.php');
require('./inc/classes/ticket.class.php');
require('./inc/classes/status.class.php');

/* Crio o objeto de categoria */
$categoria = new Categoria();
/* Crio o objeto do ticket */
$ticket = new Ticket();
/* Objeto de status */
$statusObj = new Status();
?>

<div class="tituloConsultarChamados">Consultar chamados</div>

<div style="border-top: 1px solid #ADADAD;"></div>

<br><br>

<div class="caixaFiltroConsulta">
    <form method="POST">
        Busque pelo assunto do ticket:
        <input type="text" class="buscaNumeroTicket" name="descTicket">
        <input type="submit" class="botaoEnviar" value="Buscar">
    </form>
</div>

<br><br>

<?
    /* Informa o status se foi inserido ou não o ticket. */
    if(($status == 'incluir') && ($extra == "erro"))
        echo "<br><div class='msgErro'>Desculpe, ticket não inserido! Tente novamente mais tarde!</div><br><br>";
    elseif(($status == 'incluir') && ($extra == "in"))
        echo "<br><div class='msgSucesso'>Ticket inserido com sucesso, em breve entraremos em contato!</div><br><br>";
?>

<div style="background-color: #F0F0F0; width: 100%; height: 300px;">
    <div style="padding: 10px">
        <?
            $desc = WD7Utils::Firewall($_POST['descTicket']);;

            /* Pego os tickets e varro eles */
            $rs = $ticket->RetornaTickets(null, $desc, null);

            /* Exibo o número de rows */
            echo "<b>" . ( mysql_num_rows($rs) > 0 ? mysql_num_rows($rs) : 0) . " chamado(s) encontrado(s)</b>";
        ?>

        <br><br>

        <div class="gridConsulta">

            <!-- Titulos do Grid -->
            <div class="consultaTituloGrid" style="width: 155px;">Número Ticket</div>
            <div class="consultaTituloGrid" style="width: 370px;">Assunto</div>
            <div class="consultaTituloGrid" style="width: 130px;">Data</div>
            <div class="consultaTituloGrid" style="width: 120px;">Status</div>

            <br><br>

            <?
                $i = 0;
                while($result = mysql_fetch_array($rs)){
                    /* Define a cor de fundo do item */
                    if($i == 0){
                        $corFundo = 'background-color: #DFDFDF;';
                        $i = 1;
                    }else{
                        $corFundo = 'background-color: #E9E9E9;';
                        $i = 0;
                    }
                    echo "
                        <div id=\"basic-modal\">
                            <a href=\"#\" class=\"basic\" onclick=\"CarregaConteudoTicket('{$result['id']}', {$wd7TicketIdCliente}, null);\">
                                <div class=\"consultaItemGrid\" style=\"width: 155px; {$corFundo}\"><div class=\"spc2px\">{$result['numeroticket']}</div></div>
                                <div class=\"consultaItemGrid\" style=\"width: 370px; {$corFundo}\"><div class=\"spc2px\">{$result['assunto']}</div></div>
                                <div class=\"consultaItemGrid\" style=\"width: 130px; {$corFundo}\"><div class=\"spc2px\">" . WD7Utils::FormatDateTime($result['datacriado']) . "</div></div>
                                <div class=\"consultaItemGrid\" style=\"width: 120px; text-align: center; {$corFundo}\"><div class=\"spc2px\">{$statusObj->RetornaDescStatus($result['fkstatus'])}</div></div>
                            </a>
                        </div>
                        <br>
                        ";
                }
            ?>

        </div>
    </div>

    <div id="basic-modal-content">
        <div id="conteudoticket"></div>
        <br><br>
    </div>

</div>