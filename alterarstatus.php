<?
/* Faz requisição do topo dos tickets */
require('./topo.php');

/* Corrige a codificação da pagina */
header('Content-Type: text/html; charset=iso-8859-1');

/* Pega o ID do ticket */
$idTicket = WD7Utils::Firewall($_GET['idTicket']);

/* Faz referencia a classe */
require('./inc/classes/ticket.class.php');

/* Objeto de ticket */
$ticket = new Ticket();

/* Envia um comando para o status ser alterado */
$ticket->AlterarStatus($idTicket);
?>
