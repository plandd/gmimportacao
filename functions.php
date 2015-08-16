<?php
/**
 * Funções para o tema
 *
 * @package WordPress
 * @subpackage GMI
 * @since GMI 1.0
 * @author https://github.com/plandd/
 */

//Versão do tema (RELEASES)
define('THEME_VERSION', '1.1');

//Icone do tema
define('THEME_ICON', get_stylesheet_directory_uri() . '/favicon.png');

/**
* Métodos úteis para snippets Wordpress
* @package Wordpress
*/
class PlanDDUtils
{
	/**
	 * Use para registrar páginas no inicio da
	 * instalaçao do tema
	 * @param $title título da página
	 * @param $desc resumo da página
	 * @param $type tipo da postagem
	 */
	public function registerInitPage($title, $desc, $parent = 0, $template = '') {
		$page = get_page_by_title($title);
		if(!isset($page)) {
			$defaults = array(
			  'post_type'             => 'page',
			  'post_title'    		  => $title,
			  //'post_content'  		  => '',
			  'post_status'   		  => 'publish',
			  'post_author'   		  => 1,
			  'post_excerpt'          => __($desc,'modabiz'),
			  'post_parent' 		  => $parent,
			  'page_template' 		  => $template
			);
			wp_insert_post( $defaults );
		}
	}
}

/**
* Configure funções para campos personalizados da aplicação
*/
define( 'USE_LOCAL_ACF_CONFIGURATION', true ); // apenas conf. local
add_filter('acf/settings/path', 'plandd_acf_path');
function plandd_acf_path( $path ) {
	   // update path
	   $path = get_stylesheet_directory() . '/includes/acf/';
	   // return
	   return $path;
}
add_filter('acf/settings/dir', 'plandd_acf_dir');
function plandd_acf_dir( $dir ) {
	   // update path
	   $dir = get_stylesheet_directory_uri() . '/includes/acf/';
	   // return
	   return $dir;
}
/**
 * Framework para personalização de campos
 * (custom meta post)
 */
include_once( get_stylesheet_directory() . '/includes/acf/acf.php' );
include_once( get_stylesheet_directory() . '/includes/acf-repeater/acf-repeater.php' );
//define( 'ACF_LITE' , true );
//include_once( get_stylesheet_directory() . '/includes/acf/preconfig.php' );

//PRODUTOS
function produtos_init() {
    $labels = array('name' => 'Produtos', 'singular_name' => 'Produto', 'add_new' => 'Adicionar Novo', 'add_new_item' => 'Adicionar novo Produto', 'edit_item' => 'Editar Produto', 'new_item' => 'Novo Produto', 'all_items' => 'Todos os Produtos', 'view_item' => 'Ver Produto', 'search_items' => 'Buscar Produtos', 'not_found' => 'N&atilde;o encontrado', 'not_found_in_trash' => 'N&atilde;o encontrado', 'parent_item_colon' => '', 'menu_name' => 'Produtos');
    
    $args = array('labels' => $labels, 'public' => true, 'exclude_from_search' => false, 'publicly_queryable' => true, 'show_ui' => true, 'show_in_menu' => true, 'query_var' => true, 'rewrite' => array('slug' => 'produtos'), 'capability_type' => 'post', 'has_archive' => true, 'hierarchical' => true, 'menu_position' => 4, 'supports' => array('title', 'thumbnail', 'editor'));
    
    register_post_type('produtos', $args);

    $labels = array(
		'name'              => __( 'Grupos'),
		'singular_name'     => __( 'Grupo'),
		'search_items'      =>  __( 'Buscar' ),
		'popular_items'     => __( 'Mais usados' ),
		'all_items'         => __( 'Todos os Grupos' ),
		'parent_item'       => null,
		'parent_item_colon' => null,
		'edit_item'         => __( 'Adicionar novo' ),
		'update_item'       => __( 'Atualizar' ),
		'rewrite'            => array( 'slug' => 'grupos' ),
		'add_new_item'      => __( 'Adicionar novo Grupo' ),
		'new_item_name'     => __( 'Novo' )
	);

	register_taxonomy("grupos", array("produtos"), array(
		"hierarchical"      => true, 
		"labels"            => $labels, 
		"singular_label"    => "Grupo", 
		"rewrite"           => true,
		"add_new_item"      => "Adicionar novo Grupo",
		"new_item_name"     => "Novo Grupo",
	));

	$labels = array(
		'name'              => __( 'Fabricante'),
		'singular_name'     => __( 'Fabricante'),
		'search_items'      =>  __( 'Buscar' ),
		'popular_items'     => __( 'Mais usados' ),
		'all_items'         => __( 'Todos os Fabricante' ),
		'parent_item'       => null,
		'parent_item_colon' => null,
		'edit_item'         => __( 'Adicionar novo' ),
		'update_item'       => __( 'Atualizar' ),
		'rewrite'            => array( 'slug' => 'fabricantes' ),
		'add_new_item'      => __( 'Adicionar novo Fabricante' ),
		'new_item_name'     => __( 'Novo' )
	);

	register_taxonomy("fabricantes", array("produtos"), array(
		"hierarchical"      => true, 
		"labels"            => $labels, 
		"singular_label"    => "Fabricante", 
		"rewrite"           => true,
		"add_new_item"      => "Adicionar novo Fabricante",
		"new_item_name"     => "Novo Fabricante",
	));
}
add_action('init', 'produtos_init');

function plandd_setup() {
	/**
	 * Registrar formatos de miniaturas para corte automatico
	 */
	add_theme_support('post-thumbnails');
    set_post_thumbnail_size( 242, 220, true );

    if (function_exists('add_image_size')) {
        add_image_size('produtos.lista', 200, 190, true);
        add_image_size('slider.home', 1085, 9999, false);
        add_image_size('noticias.recentes', 300, 172, true);
        add_image_size('slider.reconhecimentos', 200, 99999, false);
        add_image_size('anuncios.rodape', 150, 99999, false);
        add_image_size('slider.distribuidores', 180, 99999, false);
    }
	/**
	 * Registre os menus do topo e rodapé
	 */
	register_nav_menus( array(
		'main' => __( 'Menu principal',   'plandd' ),
    	'corporate'  => __( 'Menu institucional', 'plandd' ),
    	'questions'  => __( 'Menu dúvidas', 'plandd' ),
	) );

	// Muda o nome da classe de submenu nativa
    function change_submenu_class($menu) {
        $menu = preg_replace('/ class="sub-menu"/', '/ class="submenu" /', $menu);
        return $menu;
    }
    add_filter('wp_nav_menu', 'change_submenu_class');
	/*
		Remova widgets padrões do wordpress
	 */
	function remove_dashboard_widgets() {
		remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
		remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
		remove_meta_box('dashboard_primary', 'dashboard', 'side');
		remove_meta_box('dashboard_secondary', 'dashboard', 'side');
		remove_meta_box('dashboard_activity', 'dashboard', 'normal');
		remove_meta_box('dashboard_welcome', 'dashboard', 'normal');
	}
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
	//limita tamanho do resumo
	function new_excerpt_length($length) {
		return 30;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
	// remove paragrafo em resumos
    remove_filter('the_excerpt', 'wpautop');

    //Páginas obrigatórias
    $utils = new PlanDDUtils();
    
    $page = get_page_by_title('Minha conta');
    if(!isset($page)) {
    	$utils->registerInitPage('Minha conta', '',0,'template.minha_conta.php');
    	$utils->registerInitPage('Carrinho', '');
    }

    $page = get_page_by_title('Atendimento');
    if(!isset($page)) {
    	$utils->registerInitPage('Atendimento', '');
    	$utils->registerInitPage('Dúvidas frequentes', '');
    	$utils->registerInitPage('Política de privacidade', '');
    	$utils->registerInitPage('Termos de uso', '');
    	$utils->registerInitPage('Troca e devolução', '');
    	$utils->registerInitPage('Atualizar boleto', '');
    	$utils->registerInitPage('Fale conosco', '');
    	$utils->registerInitPage('Sobre a GMI', '');
    	$utils->registerInitPage('Suporte', '');
    	$utils->registerInitPage('Seja um revendedor GMI', '');
    }

    /**
     * BREADCRUMB
     */
    include_once( get_stylesheet_directory() . '/includes/components/breadcrumb.php' );

    /**
	 * Opções gerais para a aplicação e seus
	 * componentes
	 * @link https://github.com/reduxframework/redux-framework
	 *
	 * @since GMI 1.0
	 */
	require_once (dirname(__FILE__) . '/includes/redux/redux-framework.php');
	require_once (dirname(__FILE__) . '/includes/redux/sample/barebones-config.php');
}
add_action('after_setup_theme','plandd_setup');

/**
 * Compenentes gerados pelo Redux
 */

//Destaques da home
function getSlidersHomes() {
	global $plandd_option;
  	var_dump($plandd_option['list-sliders']);
}

//Menu fabricantes
function show_brands_menu() {
		$fabricantes = get_terms( 'fabricantes', array(
          'orderby'    => 'name',
          'hide_empty' => true,
        ) );

        foreach ($fabricantes as $marca) {

          $args = array(
            'posts_per_page' => -1,
            'post_type'      => 'produtos',
            'tax_query' => array(
              array(
                'taxonomy' => 'fabricantes',
                'field' => 'slug',
                'terms' => $marca->slug
              )
            )
          );
          
          $posts_array = get_posts( $args );
          $terms = array();
          $groups = array();
          $groups_menu = array();
          $i = 0;
          
          foreach ($posts_array as $_post) {
            $terms[] = get_the_terms( $_post->ID, 'grupos' );
          }
          
          for($i = 0; $i < count($terms); $i++) {
            $_terms = $terms[$i];
            
            foreach ($_terms as $t) {
                $groups[] = $t->name;
            }
          }

          foreach ($groups as $group) {
            if(!in_array($group, $groups_menu))
              $groups_menu[] = $group;
          }


            if(NULL != $groups_menu) {
            	echo "<li><a href=\"". get_term_link( $marca, 'fabricantes' ) ."\">{$marca->name} <span class=\"icon-icon_right_3 right\"></span></a><ul>";
	        	foreach ($groups_menu as $item) {
	        		$t = get_term_by('name',$item,'grupos');
	        		$link = get_term_link( $t->term_id, 'grupos' );
	        		echo "<li><a href=\"{$link}?fabricante={$marca->name}\">". $t->name ."</a></li>";
	        	}
	        	echo "</ul></li>";
        	} else {
        		echo "<li><a href=\"". get_term_link($marca,'fabricantes') ."\" title=\"{$marca->name}\">{$marca->name}</a></li>";
        	}
        }

        
}

/**
 * Incorpore scripts essenciais para toda a
 * aplicação
 *
 * @since GMI 1.0
 */
function plandd_scripts() {
	/*
		Folha de estilo base para a aplicação
	 */
	wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', array(), THEME_VERSION, "screen");
    
    /*
    	modernizr
    */
    wp_enqueue_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), THEME_VERSION);
    
    /*
    	Jquery
     */
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', false, THEME_VERSION);
    wp_enqueue_script('jquery');
    
    /**
     * AangularJS
     */
    //wp_enqueue_script('angularjs', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js', array(), THEME_VERSION, true);
    
    /*
	    Scripts essenciais minificados em
	    um arquivo unico e essenciais para
	    o funcionamento do lado cliente
    */
    wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/scripts.js', array(), THEME_VERSION, true);
}
add_action( 'wp_enqueue_scripts', 'plandd_scripts' );

/*
    Icones para post-types
    (http://melchoyce.github.io/dashicons/)
    edit.php?post_type=acf
 */
function add_menu_icons_styles(){
?>

<style>
#menu-posts-produtos div.wp-menu-image:before {
  content: "\f174";
}
input[id^="list-winners-url"],
input[id^="list-faq-url"],
#plandd_option-list-faq .redux_slides_add_remove {
	display: none;
}
</style>

<script>
  //<![CDATA[
  var getData = {
    'urlDir':'<?php bloginfo('template_directory');?>/',
    'ajaxDir':'<?php echo stripslashes(get_admin_url()).'admin-ajax.php';?>'
  }
  //]]>
</script>
 
<?php

wp_enqueue_script('scripts-admin', get_stylesheet_directory_uri() . '/scripts-admin.js', array(), THEME_VERSION, true);
}
add_action( 'admin_head', 'add_menu_icons_styles' );

/**
 * ---------------------------------------------------------------
 * Clientes GMI
 * ---------------------------------------------------------------
 */

/**
 * Acesso ao painel apenas para admin
 */
function prevent_admin_access() {
    if (strpos(strtolower($_SERVER['REQUEST_URI']), '/wp-admin') !== false && !current_user_can('administrator')) {
        wp_redirect(get_option('siteurl'));
    }
}
add_action('init', 'prevent_admin_access', 0);

/**
 * Oculta barra do wordpress para não admin
 */
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'remove_admin_bar');

//logar usuário
//------------------------------------------
add_action('wp_ajax_nopriv_plandd_login_user', 'plandd_login_user');
add_action('wp_ajax_plandd_login_user', 'plandd_login_user');

function plandd_login_user( $user ) {
    $user_data = $_GET['user_data'];
	$params = array();
	parse_str($user_data, $params);

    if ( !is_user_logged_in() ) {
        $user = get_userdatabylogin( $params['cnpj'] );
        $user_id = $user->ID;
        if ( $user && wp_check_password( $params['senha'], $user->data->user_pass, $user->ID) ) {
        	wp_set_current_user( $user_id, $params['cnpj'] );
	        wp_set_auth_cookie( $user_id );
	        do_action( 'wp_login', $params['cnpj'] );
        } else {
        	wp_redirect('http://google.com');
        }
    }     
}

//Campos adicionais de dados
//------------------------------------------
add_action( 'show_user_profile', 'planDD_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'planDD_extra_user_profile_fields' );
add_action( 'personal_options_update', 'planDD_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'planDD_save_extra_user_profile_fields' );
 
function planDD_save_extra_user_profile_fields( $user_id )
 {
	 if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
	 update_user_meta( $user_id, 'planDD_cnpj', $_POST['planDD_cnpj'] );
	 update_user_meta( $user_id, 'planDD_telefone', $_POST['planDD_telefone'] );
	 update_user_meta( $user_id, 'planDD_vendedor', $_POST['planDD_vendedor'] );
	 update_user_meta( $user_id, 'planDD_compra', $_POST['planDD_compra'] );
	 update_user_meta( $user_id, 'planDD_limite', $_POST['planDD_limite'] );
 }
#Developed By planDD , http://planDD.com
function planDD_extra_user_profile_fields( $user )
 { ?>
 <h3>Dados extraídos da tabela</h3>
 
 <table class="form-table">
	 <tr>
	 <th><label for="planDD_cnpj">CNPJ</label></th>
	 <td>
	 <input type="text" id="planDD_cnpj" name="planDD_cnpj" size="20" value="<?php echo esc_attr( get_the_author_meta( 'planDD_cnpj', $user->ID )); ?>">
	 <span class="description">CNPJ do usuário conforme arquivos CSV importado</span>
	 </td>
	 </tr>
	 
	 <tr>
	  <th><label for="planDD_cnpj">Telefone</label></th>
	 <td>
	 <input type="text" id="planDD_telefone" name="planDD_telefone" size="20" value="<?php echo esc_attr( get_the_author_meta( 'planDD_telefone', $user->ID )); ?>">
	 </td>
	 </tr>
	 
	 <tr>
	  <th><label for="planDD_cnpj">Vendedor</label></th>
	 <td>
	 <input type="text" id="planDD_vendedor" name="planDD_vendedor" size="20" value="<?php echo esc_attr( get_the_author_meta( 'planDD_vendedor', $user->ID )); ?>">
	 </td>
	 </tr>
	 
	 <tr>
	  <th><label for="planDD_cnpj">Última compra</label></th>
	 <td>
	 <input type="text" id="planDD_compra" name="planDD_compra" size="20" value="<?php echo esc_attr( get_the_author_meta( 'planDD_compra', $user->ID )); ?>">
	 </td>
	 </tr>
	 
	 <tr>
	  <th><label for="planDD_cnpj">Limite</label></th>
	 <td>
	 <input type="text" id="planDD_limite" name="planDD_limite" size="20" value="<?php echo esc_attr( get_the_author_meta( 'planDD_limite', $user->ID )); ?>">
	 </td>
	 </tr>
 </table>
<?php 
}

/**
 * ----------------------------------------------------------------------------------
 * Atualização de dados via importaçao de CSV
 * ----------------------------------------------------------------------------------
 */

/**
* Mantém os dados do cliente de acordo com as linhas
* do csv importado pelo usuário
*/
class GMI_Clientes
{
	private $mysqli;
	static  $codes = array();
	static  $codes_file = array();
	
	function __construct($table) {
		$this->mysqli = new mysqli("localhost","gmimport_gmi","gmi20727");
		$this->mysqli->select_db($table);
	}

	/**
	 * Armazena ids de usuários em um único vetor
	 * para processos na tabela de usuários
	 */
	private function get_userlogins() {
		if(@$result = $this->mysqli->query("SELECT * FROM wp_users")):
			for($i = 0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_row();
				if($row[1] != NULL)
					self::$codes[] = $row[1];
			}
			$this->mysqli->close();
			return self::$codes;
		endif;
	}

	/**
	 * Atualiza, insere ou remove usuários da tabela
	 * com base no arquivo cvs importado
	 * @param $csv_file [STRING] Caminho do arquivo csv
	 */
	public function update_users_by_file($csv_file) {
		$file = fopen($csv_file, "r");
		$arr = $this->get_userlogins();

		while(($data = fgetcsv($file, 1000, ",")) !== false) {
			if(@$data[1] != 'CNPJ'):

				@$cnpj = $data[1];
			    @$pass = preg_replace( '/[^0-9]/', '', $data[1] );
			    @$name = explode(' ', $data[0]);
			    @$first_name = $name[0];
			    @$last_name = $name[count($name) - 1];
			    @$full_name = $data[0];
			    @$email = $data[2];
			    @$telefone = $data[3];
			    @$vendedor = $data[4];
			    @$compra = $data[5];
			    @$limite = $data[6];

			    if(wp_create_user( $pass, $pass , $email )) {
					@$user = get_user_by( 'login', $pass );
					
					if(isset($user)) {
						
						if ( $user && wp_check_password( $pass, $user->data->user_pass, $user->ID) ) {
							@$userdata = array(
							  'ID' => $user->ID,
							  'user_login'  =>  $pass,
							  'user_pass'   =>  $pass,
							  'display_name' => $first_name,
							  'nickname' => strtolower($first_name),
							  'user_email' => $email,
							  'user_nicename' => $full_name,
							  'first_name' => $first_name,
							  'last_name' => $last_name
							);
						} else {
							@$userdata = array(
							  'ID' => $user->ID,
							  'user_login'  =>  $pass,
							  'display_name' => $first_name,
							  'nickname' => strtolower($first_name),
							  'user_email' => $email,
							  'user_nicename' => $full_name,
							  'first_name' => $first_name,
							  'last_name' => $last_name
							);
						}

						wp_update_user( $userdata );

						@update_user_meta( $user->ID , 'planDD_cnpj', $cnpj );
						@update_user_meta( $user->ID , 'planDD_telefone', $telefone );
						@update_user_meta( $user->ID , 'planDD_vendedor', $vendedor );
						@update_user_meta( $user->ID , 'planDD_compra', $compra );
						@update_user_meta( $user->ID , 'planDD_limite', $limite );

						self::$codes_file[] = $pass;
					}
			    }

			endif;
		}
		fclose($file);
		return $this->exclude_client_outside_csv(self::$codes_file , $arr);
	}

	/**
	 * Exclui usuários que não estão no arquivo csv
	 * @param $data_file [String] vetor com os logins de usuários do arquivo
	 */
	private function exclude_client_outside_csv( $data , $arr ) {
		for($i = 0; $i < count($arr); $i ++) {
			$user = get_user_by( 'login', $arr[$i] );
			$user_login = $user->first_name;
			if(!in_array($arr[$i], $data)) {
				if($user->ID != 1) {
					require_once(ABSPATH.'wp-admin/includes/user.php' );
					wp_delete_user($user->ID);
					printf("%s foi deletado\n",$user_login);
				}
			} else {
				printf("%s foi atualizado\n",$user_login);
			}
		}
	}

	/**
	 * Fechar a conxão com o banco de dados
	 */
	public function close_db() {
		return $this->mysqli->close();
	}
}

//Atualiza o banco de usuários
add_action('wp_ajax_nopriv_update_users_by_csv', 'update_users_by_csv');
add_action('wp_ajax_update_users_by_csv', 'update_users_by_csv');

function update_users_by_csv() {
	$file = $_GET['param'];
	$update = new GMI_Clientes('gmimport_gmi');
	$update->update_users_by_file($file);
	exit();
}

//Mudar senha de usuário logado
add_action('wp_ajax_nopriv_update_user_pass', 'update_user_pass');
add_action('wp_ajax_update_user_pass', 'update_user_pass');

function update_user_pass() {
	$pass = $_GET['pass'];
	$user_id = $_GET['user_id'];

	if(wp_set_password( $pass, $user_id )) {
		echo "success";
		exit();
	}

	exit();
}

/**
 * Enviar email para departamentos
 */
add_action('wp_ajax_nopriv_gmi_req_support', 'gmi_req_support');
add_action('wp_ajax_gmi_req_support', 'gmi_req_support');

function gmi_req_support() {
	$data = $_GET['data_form'];
	$params = array();
	parse_str($data, $params);

	$msg = $params['mensagem'] . "\n";
	$msg .= "Cliente: {$params['nome']} \n";
	$msg .= "Email do cliente: {$params['email']} \n";
	$msg .= "Telefone do cliente: {$params['telefone']} \n";

	if(null != $params) {
		if(wp_mail( $params['departamento'], '[CLIENTE GMI] - Mensagem do cliente logado', $msg )) {
			echo "success";
			exit();
		}
	}

	exit();
}

/**
 * Atualização de produtos via ajax
 * deleta / atualiza / insere com base nas linhas 
 * do arquivo csv
 */
add_action('wp_ajax_nopriv_GMI_Produtos', 'GMI_Produtos');
add_action('wp_ajax_GMI_Produtos', 'GMI_Produtos');

function GMI_Produtos() {
    global $wpdb;
    
 
    // Change these to whatever you set
    $planDD = array(
        "custom-field" => "planDD_post_attachment",
        "custom-post-type" => "planDD_posts"
    );
 
    // Get the data from all those CSVs!
    /*$posts = function() {
        $row = array();
        $errors = array();
        $file = $_GET['param'];

        if ( is_readable( $file ) && $_file = fopen( $file, "r" ) ) {
        	while(($data = fgetcsv($_file, 1000, ",")) !== false) {
        		if($data[0] != 'CODIGO') $row[] = $data;
        	}
        	fclose($_file);
        }
        return $row;
    };
 
    $post_exists = function( $title ) use ( $wpdb, $planDD ) {
        // Get an array of all posts within our custom post type
        $posts = $wpdb->get_col( "SELECT post_title FROM {$wpdb->posts} WHERE post_type = 'produtos'" );
 		
        // Check if the passed title exists in array
        return in_array( $title, $posts );
    };

    $rows = $wpdb->get_col( "SELECT post_title FROM {$wpdb->posts} WHERE post_type = 'produtos'" );

    for($i = 0; $i < count($rows); $i++) {
    	if(!in_array($rows[$i], $posts())) {
    		$exclude = get_page_by_title( $rows[$i], 'OBJECT', 'produtos' );
    		wp_delete_post( $exclude->ID, true );
    	}
    }
 
    foreach ( $posts() as $post ) {

        if(!term_exists( $post[2], 'grupos', 0 )) {
			wp_insert_term( $post[2], 'grupos', $args = array( 'slug' => strtolower($post[2]) ) );
		}

		if(!term_exists( $post[3], 'fabricantes', 0 )) {
			wp_insert_term( $post[3], 'fabricantes', $args = array( 'slug' => strtolower($post[3]) ) );
		}

		$grupo = get_term_by( 'name', $post[2], 'grupos' );
        $fabricante = get_term_by( 'name', $post[3], 'fabricantes' );

        if ( $post_exists( $post[1] ) ) {
        	// Upadate the post into the postbase
        	$post_exist = get_page_by_title( $post[1], 'OBJECT', 'produtos' );
	        wp_update_post( array(
	        	"ID" => $post_exist->ID,
	            "post_title" => $post[1],
	            "post_content" => $post[4],
	            "post_type" => 'produtos',
	            "post_status" => "publish",
	            "tax_input"     => array( 'grupos' => $grupo->term_id, 'fabricantes' => $fabricante->term_id )
	        ));
	        update_field('produto_preco', $post[6], $post_exist->ID);
	        update_field('produto_ref', $post[5], $post_exist->ID);
	        update_field('produto_descricao', $post[4], $post_exist->ID);

            continue;
        }
 
        // Insert the post into the postbase
        $_post["id"] = wp_insert_post( array(
            "post_title" => $post[1],
            "post_content" => $post[4],
            "post_type" => 'produtos',
            "post_status" => "publish",
            "tax_input"     => array( 'grupos' => $grupo->term_id, 'fabricantes' => $fabricante->term_id )
        ));
        update_field('produto_preco', $post[6], $_post["id"]);
        update_field('produto_ref', $post[5], $_post["id"]);
        update_field('produto_descricao', $post[4], $_post["id"]);
         
    }

    echo "success";*/
    if ( ! is_readable( $_GET['param'] ) ) {
        chmod( $_GET['param'] , 0744 );
    }

    $file = fopen($_GET['param'], "r");
    $arr = array();
    $titles_csv = array();

    $post_exists = function( $title ) use ( $wpdb, $planDD ) {
        // Get an array of all posts within our custom post type
        $posts = $wpdb->get_col( "SELECT post_title FROM {$wpdb->posts} WHERE post_type = 'produtos'" );
 		
        // Check if the passed title exists in array
        return in_array( $title, $posts );
    };

	while(($data = fgetcsv($file, 1000, ",")) !== false) {
		if($data[0] != 'CODIGO') {
			$arr[] = $data;
			$titles_csv[] = $data[1];
		}
	}

	fclose($file);

	$rows = $wpdb->get_col( "SELECT post_title FROM {$wpdb->posts} WHERE post_type = 'produtos'" );

	for($i = 0; $i < count($rows); $i++) {
    	if(!in_array($rows[$i], $titles_csv)) {
    		$exclude = get_page_by_title( $rows[$i], 'OBJECT', 'produtos' );
    		wp_delete_post( $exclude->ID, true );
    		echo $exclude->post_title . " deletado";
    	}
    }

	foreach ( $arr as $postdata ) {
		if(!term_exists( $postdata[2], 'grupos', 0 )) {
			wp_insert_term( $postdata[2], 'grupos', $args = array( 'slug' => strtolower($postdata[2]) ) );
		}
		if(!term_exists( $postdata[3], 'fabricantes', 0 )) {
			wp_insert_term( $postdata[3], 'fabricantes', $args = array( 'slug' => strtolower($postdata[3]) ) );
		}

		$grupo = get_term_by( 'name', $postdata[2], 'grupos' );
        $fabricante = get_term_by( 'name', $postdata[3], 'fabricantes' );

        if ( $post_exists( $postdata[1] ) ) {
        	// Upadate the post into the postbase
        	$post_exist = get_page_by_title( $postdata[1], 'OBJECT', 'produtos' );
	        wp_update_post( array(
	        	"ID" => $post_exist->ID,
	            "post_title" => $postdata[1],
	            "post_content" => $postdata[4],
	            "post_type" => 'produtos',
	            "post_status" => "publish",
	            "tax_input"     => array( 'grupos' => $grupo->term_id, 'fabricantes' => $fabricante->term_id )
	        ));
	        update_field('produto_preco', $postdata[6], $post_exist->ID);
	        update_field('produto_ref', $postdata[5], $post_exist->ID);
	        update_field('produto_descricao', $postdata[4], $post_exist->ID);

            continue;
        }

        $_post["id"] = wp_insert_post( array(
            "post_title" => $postdata[1],
            "post_content" => $postdata[4],
            "post_type" => 'produtos',
            "post_status" => "publish",
            "tax_input"     => array( 'grupos' => $grupo->term_id, 'fabricantes' => $fabricante->term_id )
        ));
        update_field('produto_preco', $postdata[6], $_post["id"]);
        update_field('produto_ref', $postdata[5], $_post["id"]);
        update_field('produto_descricao', $postdata[4], $_post["id"]);

	}

    exit();
 
}

?>