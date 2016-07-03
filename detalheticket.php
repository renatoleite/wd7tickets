<?
/* Faz requisição do topo dos tickets */
require('./topo.php');

/* Corrige a codificação da pagina */
header('Content-Type: text/html; charset=iso-8859-1');

/* Pega o ID do ticket, caso não tenha nenhum sai da pagina */
$idTicket = WD7Utils::Firewall($_GET['idTicket']);

/* Pega o ID do cliente é do funcionario */
$idCliente = WD7Utils::Firewall($_GET['idCliente']);
$idFuncionario = WD7Utils::Firewall($_GET['idFuncionario']);

if(!isset($idTicket)){
    echo "Há um problema com a identificação do seu ticket, tente mais tarde!";
    exit;
}

/* Faz referencia as classes */
require('./inc/classes/ticket.class.php');
require('./inc/classes/status.class.php');
require('./inc/classes/mensagens.class.php');

/* Cria o objeto do ticket */
$ticket = new Ticket();
/* Objeto de status */
$status = new Status();
/* Objeto de mensagens */
$mensagens = new Mensagens();

/* Busca informações sobre o ticket */
$rsTicket = $ticket->RetornaTickets($idTicket, null);
$ticketResult = mysql_fetch_array($rsTicket);

/* Busca as mensagens relacionado a esse ticket */
$rsMensagens = $mensagens->RetornaMensagens($idTicket);
?>

<b><? echo ( mysql_num_rows($rsMensagens) > 0 ? mysql_num_rows($rsMensagens) : 0); ?> resposta(s)</b>
<br>
<div class="detalheTicketInfoTop">Última resposta: <? echo $ticketResult['datacriado']; ?>.</div>

<br><br>

<div class="detalhesTicketBoxMensagens">

<?
/* Inicializa as variaveis */
$primeiraResposta = true;

/* Varre os resultados */
while($result = mysql_fetch_array($rsMensagens)){
    /* Caso for o primeiro resultado, seta como cabeçalho do ticket */
    if($primeiraResposta){
        echo "  <div class=\"detalheTicketTitulo tituloTicket\">Informações do ticket</div>
                    <div class=\"detalheTicketConteudo conteudoTicket\">
                    <div class=\"detalheTicketSubTitulo\">{$ticketResult['assunto']}</div><br>
                    <div class=\"detalheTicketSubTituloData\">{$ticketResult['datacriado']}</div>
                    <br><br>
                    {$result['mensagem']}
                </div><br>";
        $primeiraResposta = false;
    }else{
        /* Verifica se a mensagem quem postou foi um funcionário ou o cliente */
        if(!isset($result['fkfuncionario'])){
            echo "  <div class=\"detalheTicketTitulo tituloTicket\">Resposta</div>
                        <div class=\"detalheTicketConteudo conteudoTicket\">
                        <div class=\"detalheTicketSubTitulo\">Re: {$ticketResult['assunto']}</div><br>
                        <div class=\"detalheTicketSubTituloData\">{$ticketResult['datacriado']}</div>
                        <br><br>
                        {$result['mensagem']}
                    </div><br>";
        }else{
            echo "  <div class=\"detalheTicketTitulo respostaTicket\">Resposta</div>
                        <div class=\"detalheTicketConteudo conteudoRespostaTicket\">
                        <div class=\"detalheTicketSubTitulo\">Re: {$ticketResult['assunto']}</div><br>
                        <div class=\"detalheTicketSubTituloData\">{$ticketResult['datacriado']}</div>
                        <br><br>
                        {$result['mensagem']}
                    </div><br>";
        }
    }
}

?>

</div>

<br>

Responda: <br>
<textarea style="width: 755px; height: 70px;" name="respostaTicket" id="respostaTicket" <? echo ($ticketResult['fkstatus'] == '2' ? 'disabled' : '') ?>></textarea>
<br>
<div style="float: left;">
    <?
    if($ticketResult['fkstatus'] == '1'){
        echo "<a onclick=\"ResponderTicket({$idTicket}, {$idCliente}, {$idFuncionario});\">Enviar</a>";
    }
    ?>
</div>

<?
    if($ticketResult['fkstatus'] == 1){
        $descTicket = "Fechar ticket";
    }elseif($ticketResult['fkstatus'] == 2){
        $descTicket = "Abrir ticket";
    }

?>
<div style="float: right;">
    <a onclick="AlteraStatusTicket('<? echo $idTicket; ?>');"><? echo $descTicket; ?></a>
</div>