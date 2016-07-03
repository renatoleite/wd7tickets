function CarregaConteudoTicket(id, idCliente, idFuncionario){
    getConteudo('./detalheticket.php', 'idTicket=' + id + '&idCliente=' + idCliente + '&idFuncionario=' + idFuncionario, '#conteudoticket');
}

function ResponderTicket(id, idCliente, idFuncionario){
    // Pega os valores.
    var conteudoResposta = document.getElementById('respostaTicket').value;

    conteudoResposta = conteudoResposta.replace(new RegExp( "\\n", "g" ),"<br>");

    // Envia uma requisição para inserir o ticket.
    getConteudo('./inserirticket.php', 'idTicket=' + id + "&conteudoMensagem=" + conteudoResposta + '&idCliente=' + idCliente + '&idFuncionario=' + idFuncionario, '#noresults');

    // Carrega de novo o conteudo.
    CarregaConteudoTicket(id, idCliente, idFuncionario);
}

function AlteraStatusTicket(id){
    getConteudo('./alterarstatus.php', 'idTicket=' + id, '#noresults');
    $.modal.close();
}

function getConteudo(lsPag,lsWhere,lsDiv){
    // Adiciona um texto que está carregando.
    $(document).ready(function() {
        $(lsDiv).html('<div style="text-align: center; margin-top: 225px;"><img src="./temp/img/carregando.gif"></div>');
    });

    // Carrega o conteudo.
    $.ajax({
        type: "GET",
        url: lsPag,
        data: lsWhere,
        contentType: "charset=ISO-8859-1",
        success: function(strRetorno){
            $(lsDiv).html(strRetorno);
        }
    });
}