<?
class Mensagens{
    /** @var string Mensagem a ser inserida. */
    public $mensagem;
    /** @var integer Id do ticket. */
    public $fkticket;
    /** @var integer Id do funcionário. */
    public $fkfuncionario;

    /**
     * Insere e relaciona uma mensagem ao ticket.
     * @return boolean Se inseriu ou não.
     */
    public function InserirMensagem(){
        /* Carrego a tabela */
        WD7Model::Table('wd7tickets_mensagens');

        /* Carrego os parametros */
        WD7Model::LoadParameter('mensagem', $this->mensagem, string);
        WD7Model::LoadParameter('dataupdate', date('Y-m-d H:i:s'), datetime);
        WD7Model::LoadParameter('fkticket', $this->fkticket, integer);
        WD7Model::LoadParameter('fkfuncionario', $this->fkfuncionario, integer);

        /* Insiro a mensagem */
        return WD7Model::Insert();
    }

    /**
     * Retorna as mensagens do ticket.
     * @param integer $idTicket Id do ticket.
     * @return dataresult
     * @throws string Caso o número do ticket não for passado.
     */
    public function RetornaMensagens($idTicket = null){
        /* Verifica se algum ticket foi passado */
        if(!isset($idTicket))
            throw "Ticket inexistente.";

        /* Carrega a tabela */
        WD7Model::Table('wd7tickets_mensagens');

        /* Carrega os parametros */
        WD7Model::LoadParameter('mensagem');
        WD7Model::LoadParameter('fkfuncionario');
        WD7Model::LoadParameter('dataupdate');

        WD7Model::Set('where', 'fkticket = ' . $idTicket);

        /* Retorna o select */
        return WD7Model::Select();
    }
}
?>
