<?
    /* Define o path do framework */
    Define('_WD7Framework_Path_', $_SERVER['DOCUMENT_ROOT'] . 'wd7framework');

    /* Define as configurações de banco de dados do framework */
    Define('_WD7DB_Host_', '127.0.0.1');
    Define('_WD7DB_User_', 'root');
    Define('_WD7DB_Pass_', '');
    Define('_WD7DB_Data_', 'wd7tickets');

    /* Chave de segurança do site (id do cliente) */
    Define('_WD7_Key_', md5('1'));

    /* Define o template */
    Define('_WD7Tickets_Template_', 'patrarpe');

    /* Define o titulo da aplicação */
    Define('_WD7Tickets_Titulo_', 'WD7 Tickets');

    /* Define a versão */
    Define('_WD7_Versao_', '1.0.0.1');

    /* Define a URL do site */
    Define('_WD7_URLSite_', 'http://127.0.0.1:8080/wd7tickets/');
?>
