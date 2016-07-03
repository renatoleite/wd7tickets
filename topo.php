<?
/* Cria as sessões */
$nome = md5("hhUUhh7u45hpatrarpedDDfdsWWmk2121");
session_name($nome);
session_start();
session_regenerate_id();
ob_start();

/* Antes de mais nada verifico se algum cliente foi registrado */

/* Define as configurações do site */
require(dirname(__FILE__) . '/inc/config/config.php');

/* Carrega as classes do Framework WD7 */
require(_WD7Framework_Path_ . '/error.class.php');
require(_WD7Framework_Path_ . '/db.class.php');
require(_WD7Framework_Path_ . '/model.class.php');
require(_WD7Framework_Path_ . '/sessions.class.php');
require(_WD7Framework_Path_ . '/utils.class.php');
require(_WD7Framework_Path_ . '/encryption.class.php');
require(_WD7Framework_Path_ . '/mysqltransaction.class.php');

/* Inicializa o MySQL */
WD7DB::InitializeMySQL();

/* Pag */
$key = WD7Utils::Firewall($_GET['key']);
$status = WD7Utils::Firewall($_GET['st']);
$extra = WD7Utils::Firewall($_GET['extra']);
?>