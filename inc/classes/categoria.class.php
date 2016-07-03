<?
class Categoria{
    /**
     * Retorna os dados da categoria.
     * @return boolean Descrições das categorias.
     */
    public function RetornaCategorias(){
        /* Passo a tabela */
        WD7Model::Table('wd7tickets_categoria');

        /* Carrego os parametros do select */
        WD7Model::LoadParameter('id');
        WD7Model::LoadParameter('desccategoria');

        /* Retorno o dataresult com os dados do select */
        return WD7Model::Select();
    }
}
?>
