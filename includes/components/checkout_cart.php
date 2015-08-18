<?php
//Enviar dados do carrinho para o email do atendimento
//e esvaliá-lo
add_action('wp_ajax_nopriv_send_cart_items', 'send_cart_items');
add_action('wp_ajax_send_cart_items', 'send_cart_items');

function send_cart_items() {
	$items = $_GET['items_cart'];

	if ( is_user_logged_in() ):

		global $current_user;
		global $plandd_option;
		ob_start();
		?>
		<html>
		</head>
		<body>

		<div class="gmi_email_template" style="width: 100%;float: left;background: #fff;background: -moz-linear-gradient(top,#fff 0,#f6f6f6 47%,#ededed 100%);background: -webkit-gradient(left top,left bottom,color-stop(0%,#fff),color-stop(47%,#f6f6f6),color-stop(100%,#ededed));background: -webkit-linear-gradient(top,#fff 0,#f6f6f6 47%,#ededed 100%);background: -o-linear-gradient(top,#fff 0,#f6f6f6 47%,#ededed 100%);background: -ms-linear-gradient(top,#fff 0,#f6f6f6 47%,#ededed 100%);background: linear-gradient(to bottom,#fff 0,#f6f6f6 47%,#ededed 100%);filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed', GradientType=0);-moz-box-shadow: 0 0 5px 0 rgba(0,0,0,.2);-webkit-box-shadow: 0 0 5px 0 rgba(0,0,0,.2);box-shadow: 0 0 5px 0 rgba(0,0,0,.2);padding: 30px;border-radius: 10px;">
			<img src="http://67.23.244.7/~gmimportadmin/wp-content/themes/gmimportacao/images/logo.png" alt="" style="float: left;"><br><br>

			<div style="width: 100%;float: left;padding-bottom: 5px;border-bottom: 1px solid #ccc;margin-bottom: 20px;"></div>
			<br><br>
			<p>
			<header style="width: 100%;float: left;padding-bottom: 5px;border-bottom: 1px solid #ccc;margin-bottom: 20px;">
				<h5><strong><?php echo $current_user->first_name . ' ' . $current_user->last_name; ?></strong> deseja fechar um pedido realizado através do site.</h5>
			</header>

			<article style="width: 100%;float: left;padding-bottom: 5px;border-bottom: 1px solid #ccc;margin-bottom: 20px;">
				<p><strong>Nome do cliente: </strong><?php echo $current_user->first_name . ' ' . $current_user->last_name; ?></p>
				<p><strong>CNPJ: </strong><?php echo get_user_meta($current_user->ID, 'planDD_cnpj', true); ?></p>
				<p><strong>Telefone: </strong><?php echo get_user_meta($current_user->ID, 'planDD_telefone', true); ?></p>
				<p><strong>E-mail: </strong><?php echo $current_user->user_email; ?></p>
				<p><strong>Vendedor: </strong><?php echo get_user_meta($current_user->ID, 'planDD_vendedor', true); ?></p>
			</article>

			<header style="width: 100%;float: left;padding-bottom: 5px;border-bottom: 1px solid #ccc;margin-bottom: 20px;">
				<h5>Lista de produtos e quantidade:</h5>
			</header>

			<nav style="width: 100%;float: left;padding-bottom: 5px;border-bottom: 1px solid #ccc;margin-bottom: 20px;">
				<ol>
				<?php
					$total = 0;
					foreach ($items as $key => $value) {
						$item = get_post( $key );
		                if($value > 0):
						?>
						<li style="width:100%;float:left;margin-bottom:20px;">
							<p><strong>Nome: </strong> <?php echo get_the_title( $item->ID ); ?></p>
							<p><strong>Codigo: </strong> <?php echo $item->ID; ?></p>
							<?php
								$custom_fields = get_post_custom($item->ID);
								if(null != $custom_fields['produto_ref'][0])
				                    printf('<p><strong>Referência do produto: </strong>%s</p>',$custom_fields['produto_ref'][0]);
							?>
							<p><i><strong>Quantidade: </strong><?php echo $value; ?></i></p>
						</li>
						<?php
						$total += $value;
						endif;
					}
				?>
				</ol>
				<p class="item_red"><strong>Total de itens: <?php echo $total; ?></strong></p>
			</nav>
			</p>
		</div>
		</body>
		</html>
		<?php
		$output = ob_get_contents();
		ob_clean();
		//print($output);
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$to = ($plandd_option['opt-multitext-checkout']) ? $plandd_option['opt-multitext-checkout'] : $plandd_option['inst-email'];
		
		if(wp_mail( $to, '[PEDIDO] - Um cliente deseja realizar uma compra a partir do site', $output, $headers )) {
			print('success');
		} else {
			print('error');
		}

		ob_start();
		?>
		<html>
		</head>
		<body>
		<div class="gmi_email_template" style="width: 100%;float: left;background: #fff;background: -moz-linear-gradient(top,#fff 0,#f6f6f6 47%,#ededed 100%);background: -webkit-gradient(left top,left bottom,color-stop(0%,#fff),color-stop(47%,#f6f6f6),color-stop(100%,#ededed));background: -webkit-linear-gradient(top,#fff 0,#f6f6f6 47%,#ededed 100%);background: -o-linear-gradient(top,#fff 0,#f6f6f6 47%,#ededed 100%);background: -ms-linear-gradient(top,#fff 0,#f6f6f6 47%,#ededed 100%);background: linear-gradient(to bottom,#fff 0,#f6f6f6 47%,#ededed 100%);filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed', GradientType=0);-moz-box-shadow: 0 0 5px 0 rgba(0,0,0,.2);-webkit-box-shadow: 0 0 5px 0 rgba(0,0,0,.2);box-shadow: 0 0 5px 0 rgba(0,0,0,.2);padding: 30px;border-radius: 10px;">
			<img src="http://67.23.244.7/~gmimportadmin/wp-content/themes/gmimportacao/images/logo.png" alt=""><br><br>

			<header style="width: 100%;float: left;padding-bottom: 5px;border-bottom: 1px solid #ccc;margin-bottom: 20px;">
				<br><p>Olá <?php echo $current_user->first_name . ' ' . $current_user->last_name; ?>. Seu pedido foi realizado com sucesso. Aguarde o contato da nossa central de atendimento para o fechamento da compra.<br>Agradecemos sua preferência!</p><br>
				<br><p><strong>Lista de produtos e quantidade:</strong></p><br>
			</header>

			<nav style="width: 100%;float: left;padding-bottom: 5px;border-bottom: 1px solid #ccc;margin-bottom: 20px;">
				<ol>
				<?php
					$total = 0;
					foreach ($items as $key => $value) {
						$item = get_post( $key );
		                if($value > 0):
						?>
						<li style="width:100%;float:left;margin-bottom:20px;">
							<p><strong>Nome: </strong> <?php echo get_the_title( $item->ID ); ?></p>
							<p><strong>Codigo: </strong> <?php echo $item->ID; ?></p>
							<?php
								$custom_fields = get_post_custom($item->ID);
								if(null != $custom_fields['produto_ref'][0])
				                    printf('<p><strong>Referência do produto: </strong>%s</p>',$custom_fields['produto_ref'][0]);
							?>
							<p><i><strong>Quantidade: </strong><?php echo $value; ?></i></p>
						</li>
						<?php
						$total += $value;
						endif;
					}
				?>
				</ol>
				<p class="item_red"><strong>Total de itens: <?php echo $total; ?></strong></p>
			</nav>
			</p>
		</div>
		</body>
		</html>
		<?php
		$msg = ob_get_contents();
		ob_clean();

		if(wp_mail( $current_user->user_email, '[GMI Distribuidora] - Seu pedido foi realizado', $msg, $headers )) {
			delete_user_meta( $current_user->ID, 'user_cart' );
		}

	endif;

	exit();
}
?>