<?
class Ticket{
    /** @var type string Assunto do ticket */
    public $assunto;
    /** @var type boolean Ticket concluido ou não */
    public $concluido;
    /** @var type integer Id do cliente (caso tiver) */
    public $fkCliente;
    /** @var type integer Id do plano (caso tiver) */
    public $fkPlano;
    /** @var type integer Id da categoria */
    public $fkCategoria;

    /**
     * Gera um número sequencial unico.
     * @return string Número sequencial.
     */
    private function GeraNumeroTicket(){
        $dataAtual = preg_replace("/[^0-9]/", "", date('Y-m-d H:i:s'));
        $numAletorio = rand(1000000,9999999);
        /* Gero uma chave SHA1 que vai ser o número do ticket */
        return $numAletorio . $dataAtual;
    }

    /**
     * Insere um novo ticket no banco de dados.
     * @return boolean Se inseriu ou não.
     */
    public function InserirTicket(){
        /* Passo a tabela */
        WD7Model::Table('wd7tickets_ticket');

        /* Passo os parametros com os valores */
        WD7Model::LoadParameter('numeroticket', $this->GeraNumeroTicket(), string);
        WD7Model::LoadParameter('assunto', $this->assunto, string);
        WD7Model::LoadParameter('concluido', $this->concluido, boolean);
        WD7Model::LoadParameter('datacriado', date('Y-m-d H:i:s'), datetime);
        WD7Model::LoadParameter('fkcliente', (isset($this->fkCliente) ? $this->fkCliente : ''), integer);
        WD7Model::LoadParameter('fkplano', (isset($this->fkPlano) ? $this->fkPlano : ''), integer);
        WD7Model::LoadParameter('fkcategoria', $this->fkCategoria, integer);
        WD7Model::LoadParameter('fkstatus', 1, integer);

        /* Insiro e voltou com o retorno se inseriu ou não */
        return WD7Model::Insert();
    }

    /**
     *Retorna o id do ticket inserido.
     * @return integer Id do ticket inserido.
     */
    public function RetornaIdTicket(){
        return WD7Model::IdInsert();
    }

    /**
     * Retorna dados dos tickets que estão no banco de dados.
     * @param string $desc Caso queira pesquisar pela descrição de algum ticket.
     * @return mysql_result
     */
    public function RetornaTickets($id = null, $desc = null, $fkstatus = null){
        /* Passo a tabela */
        WD7Model::Table('wd7tickets_ticket');

        /* Passo os parametros */
        WD7Model::LoadParameter('id');
        WD7Model::LoadParameter('numeroticket');
        WD7Model::LoadParameter('assunto');
        WD7Model::LoadParameter('concluido');
        WD7Model::LoadParameter('datacriado');
        WD7Model::LoadParameter('fkcliente');
        WD7Model::LoadParameter('fkplano');
        WD7Model::LoadParameter('fkcategoria');
        WD7Model::LoadParameter('fkstatus');

        /* Caso tenha filtro, monto ele */
        if(isset($id)){
            WD7Model::Set('where', 'id = ' . $id);
        }elseif(isset($desc)){
            WD7Model::Set('where', "assunto LIKE '" . $desc . "%'");
        }elseif(isset($fkstatus)){
            WD7Model::Set('where', "fkstatus <> '" . $fkstatus . "'");
        }

        WD7Model::Set('order', 'datacriado desc');

        /* Retorno o resultado */
        return WD7Model::Select();
    }

    /**
     * Altera o status do ticket no banco de dados.
     * @param integer $id Id do ticket.
     * @param integer $novoStatus Novo status do ticket.
     * @return boolean Se alterou ou não.
     */
    private function AlteraStatusDb($id, $novoStatus){
        /* Passa a tabela */
        WD7Model::Table('wd7tickets_ticket');

        /* Passa os parametros */
        WD7Model::LoadParameter('fkstatus', $novoStatus, integer);
        WD7Model::Set('where', 'id = ' . $id);

        /* Retorna o resultado */
        return WD7Model::Update();
    }

    /**
     * Altera o status do ticket de fechado para aberto ou vice-e-versa.
     * @param integer $id Id do ticket.
     * @return boolean Se alterou ou não.
     */
    public function AlterarStatus($id){
        /* Passa a tabela */
        WD7Model::Table('wd7tickets_ticket');

        /* Passa os parametros */
        WD7Model::LoadParameter('fkstatus');
        WD7Model::Set('where', 'id = ' . $id);

        /* Carrega o resultado */
        $rs =  WD7Model::Select();
        $result = mysql_fetch_array($rs);

        /* Envia o comando para alterar o status */
        return $this->AlteraStatusDb($id, ($result['fkstatus'] == '1' ? '2' : '1'));
    }
}
?>
