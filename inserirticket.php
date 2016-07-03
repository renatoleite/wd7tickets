<?
/* Faz requisiчуo do topo dos tickets */
require('./topo.php');

/* Corrige a codificaчуo da pagina */
header('Content-Type: text/html; charset=iso-8859-1');

/* Pega o ID do ticket */
$idTicket = WD7Utils::Firewall($_GET['idTicket']);

/* Pega o ID do cliente щ do funcionario */
$idCliente = WD7Utils::Firewall($_GET['idCliente']);
$idFuncionario = WD7Utils::Firewall($_GET['idFuncionario']);

/* Mensagem a ser enviada. */
$conteudoMensagem = WD7Utils::Firewall($_GET['conteudoMensagem']);

/* Faz referencia as classes */
require('./inc/classes/mensagens.class.php');

/* Objeto de mensagens */
$mensagens = new Mensagens();

/* Valida se as informaчѕes foram passadas */
if((!isset($idTicket)) || (!isset($conteudoMensagem))){
    echo "erro";
    exit;
}

/* Insere o ticket */
$mensagens->fkticket = $idTicket;
$mensagens->fkfuncionario = ($idFuncionario != 'null' ? $idFuncionario : null);
$mensagens->mensagem = $conteudoMensagem;

if($mensagens->InserirMensagem()){
    echo "sucesso";
}else{
    echo "erro";
}
?>