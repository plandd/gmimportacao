(function() {
	//incrementar/decrementar quantidade de itens
	$('.add_item','.change_cart_quantity').on('click',function() {
		window.getSelection().removeAllRanges();
		var field_num = parseInt($(this).siblings('.total_item').find('input').val(),10),
			qtd_checkout = $(this).parents('li').find('.info-check');

		field_num++;

		$(this).siblings('.total_item').find('input').val(field_num);
		
		if(qtd_checkout.length) {
			qtd_checkout.data('qtd',field_num);
		}
	});

	$('.rem_item','.change_cart_quantity').on('click',function() {
		window.getSelection().removeAllRanges();
		var field_num = parseInt($(this).siblings('.total_item').find('input').val(),10),
			qtd_checkout = $(this).parents('li').find('.info-check');

		if(field_num > 0)
			field_num--;
		
		$(this).siblings('.total_item').find('input').val(field_num);

		if(qtd_checkout.length) {
			qtd_checkout.data('qtd',field_num);
		}
	});

	$('.total_item > input','.change_cart_quantity').on('blur',function() {
		var field_num = parseInt($(this).val(),10),
			qtd_checkout = $(this).parents('li').find('.info-check');
		
		$(this).val(field_num);

		if(qtd_checkout.length) {
			qtd_checkout.data('qtd',field_num);
		}
	});

	//Alterar quantidade de produtos da sessão do cliente
	$('.submit_item','.change_cart_quantity').on('click',function(e) {
		e.preventDefault();
		var $this = $(this),
			userId = $(this).data('user'),
			itemId = $(this).data('item'),
			totalItems = $('.total_item > input','.change_cart_quantity').val();

		$.get(getData.ajaxDir, {action: 'update_items_cart',user_id: userId,item_id: itemId,total_item: totalItems})
        .done(function(data) {     
            location.reload();
        });
	});

	//Salva modificações de quantidade de items
	//ao sair da pedido sem realizar checkout (adicionar mais produtos)
	$('.submit_new_items').on('click',function(e) {
		e.preventDefault();
		var obj = {}, user_id = $(this).data('user');

		$('.info-check','#cart-for-checkout').each(function(index, el) {
			var item = $(this).data('item'),
				item_total = $(this).data('qtd');

			obj[item] = item_total;
		});
		
		$.get(getData.ajaxDir, {action: 'update_item_and_exit', items: obj, user: user_id})
        .done(function(data) {     
            window.location.href = data;
        });
	});

	//Deletar um item do carrinho
	$('.remove_item').on('click',function(e) {
		e.preventDefault();
		var $this = $(this),
			userId = $(this).data('user'),
			itemId = $(this).data('item');

		$.get(getData.ajaxDir, {action: 'delete_item_cart',user_id: userId,item_id: itemId})
        .done(function(data) {     
            location.reload();
        });
	});

	//enviar carrinho para o atendimento, fechar pedido
	$('.send-cart').on('click',function(e) {
		e.preventDefault();
		var items = new Object(),
			payForm = $('input[type="radio"]:checked','.pay-form').val();
			
		if($('.with-items').length) {
			$('li','.with-items').each(function(index, el) {
				var itemId = $('.info-check',this).data('item'),
					itemTotal = $('.info-check',this).data('qtd');

				items[itemId] = itemTotal;
			});
			$.ajax({
				data: {
					action: 'send_cart_items',
					items_cart: items,
					pay_form: payForm
				},
				success: function(data) {
					if(data != 'false') {
						alert('email enviado com sucesso');
						window.location.href = data;
					}
					else {
						alert('Ocorreu algum erro. Tente novamente');
					}
				}
			});
		}
	});

})();