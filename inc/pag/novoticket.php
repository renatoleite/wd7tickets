<?
/* Carrego as classes */
require('./inc/classes/categoria.class.php');
require('./inc/classes/ticket.class.php');
require('./inc/classes/mensagens.class.php');

/* Crio o objeto de categoria */
$categoria = new Categoria();
/* Crio o objeto do ticket */
$ticket = new Ticket();
/* Crio o objeto de mensagens */
$mensagem = new Mensagens();

/* Classe que retorna o Exception */
class MyException extends Exception { }

/* Caso esteja incluindo um ticket */
if($status == 'incluir'){
    /** Inicia a transação */
    WD7MySQLTransaction::StartTransaction();
    try{
        /* Insiro um novo ticket */
        $ticket->assunto = $_POST['tituloTicket'];
        $ticket->concluido = false;
        $ticket->fkCategoria = $_POST['categoriaTicket'];
        $ticket->fkCliente = $wd7TicketIdCliente;
        $ticket->fkPlano = null;

        /* Insiro o ticket e o retorno o id */
        $ticket->InserirTicket();
        $idTicket = $ticket->RetornaIdTicket();

        /** Insiro a mensagem do ticket */
        $mensagem->fkticket = $idTicket;
        $mensagem->mensagem = nl2br($_POST['mensagem']);
        $mensagem->InserirMensagem();

        /*Commita a transação e redireciona  pagina*/
        WD7MySQLTransaction::Commit();

        header("Location: principal/incluir/in");
        exit;
    }catch(Exception $e){
        WD7MySQLTransaction::RollBack();

        /* Trato o erro e redireciona pagina*/
        WD7Error::SetError($e);

        header("Location: principal/incluir/erro");
        exit;
    }
}

?>

<div class="tituloConsultarChamados">Abrir ticket</div>

<div style="border-top: 1px solid #ADADAD;"></div>

<br><br>

<div style="background-color: #F0F0F0; width: 100%;">
    <div style="padding: 10px">

        <i>Para agilizarmos ainda mais seu atendimento, preencha o formulário abaixo com o máximo possível de detalhes sobre o seu ticket.</i>

        <br><br>

        <form method="POST" action="index.php?pag=novoticket&st=incluir">
            Titulo do ticket:<br>
            <input type="text" name="tituloTicket" style="width: 300px;">

            <br><br>

            Categoria:<br>
            <select name="categoriaTicket" style="width: 200px;">
                <?
                    /* Retorno as categorias e as listo */
                    $rs = $categoria->RetornaCategorias();

                    while($result = mysql_fetch_array($rs)){
                        echo "<option value='{$result['id']}'>{$result['desccategoria']}</option>";
                    }
                ?>
            </select>

            <br><br>

            Mensagem:<br>
            <textarea name="mensagem" style="width: 500px; height: 150px;"></textarea>

            <br><br>

            <input type="submit" value="Enviar">
        </form>
    </div>
</div>