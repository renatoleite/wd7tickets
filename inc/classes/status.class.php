<?
    class Status{
        /**
         * Retorna a descri��o de um status.
         * @param int $id Id do status
         * @return string Descri��o
         */
        public function RetornaDescStatus($id){
            /* Defino a tabela */
            WD7Model::Table('wd7tickets_status');

            /* Carrego os parametros */
            WD7Model::LoadParameter('descricao');
            Wd7Model::Set('where', 'id = ' . $id);
            /* Executo o select para trazer a descri��o e retorno */
            $rs = WD7Model::Select();
            $result = mysql_fetch_array($rs);
            return $result['descricao'];
        }
    }
?>
