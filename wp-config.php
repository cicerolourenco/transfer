<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', '123esite_transferbrasil');


/** Usuário do banco de dados MySQL */
define('DB_USER', 'sitetransferdb');


/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'x{^g-)tg@Ror');


/** Nome do host do MySQL */
define('DB_HOST', 'localhost');


/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');


/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~<=#f6569[7OCy RK&xBCfV-DDhAj!Y/Z~B&?JJBQIQjFF`UdSi(;xr+,S+jNLYK');

define('SECURE_AUTH_KEY',  'XFj<wEQ!8(3Ju[%e)EMW_x+fI}U8*KZpZ9F7Xx18J!:@4r72m^[D:{/2AussS9hZ');

define('LOGGED_IN_KEY',    'Nox(x*u([yh<M,&Jm-#wBtx+QI+[D:B,paAT.GD[,%sKWL$xO.B3A:Nsf7$P7PY[');

define('NONCE_KEY',        'pOB^Zq18nqu=FTk|3x3|xvy@n~+M)q=VqxOaCjkg}w 9iYe[y7[S4-JO4[ o{|01');

define('AUTH_SALT',        '2i{quJx/vVP[xpu4NZgS:R-j8_9%Bjh9S4ymqciJirE0?<WRo6J}O&Y8^aX}F#XL');

define('SECURE_AUTH_SALT', 'pDAe6TjzsZ;v;I$C*PDIF0IsK9swb~&fkhRt3sD8RNb!OCJu7]U=.X>tLreVH,1*');

define('LOGGED_IN_SALT',   'HF`!NwtTI,/=1/EMi^]4G_X0>JNrf*Oe@U.Qy/]?n!j=ZtO?^6/-xCU0`~`Ckx`]');

define('NONCE_SALT',       'K%<+`0|)QIxC9XOu~I4jjFg*X%IKTJQ1MDTLvdoO3KWcF!/RI8E13_uW7[.|py*%');


/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = '123esite_transfer_';


/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', true);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
