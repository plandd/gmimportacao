(function() {
	//incrementar/decrementar quantidade de itens
	$('.add_item','.change_cart_quantity').on('click',function() {
		window.getSelection().removeAllRanges();
		var field_num = parseInt($('.total_item > input','.change_cart_quantity').val(),10);
		field_num++;
		$('.total_item > input','.change_cart_quantity').val(field_num);
	});
	$('.rem_item','.change_cart_quantity').on('click',function() {
		window.getSelection().removeAllRanges();
		var field_num = parseInt($('.total_item > input','.change_cart_quantity').val(),10);
		if(field_num > 0)
			field_num--;
		$('.total_item > input','.change_cart_quantity').val(field_num);
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
            //var obj = $.parseJSON(data);
            //$('.qtd-cart').text(obj.total);
            //$('#item-list-user').html(obj.list);
            //location.reload();
            location.reload();
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
            //var obj = $.parseJSON(data);
            //$('.qtd-cart').text(obj.total);
            //$('ul','.items-cart').html(obj.list);
            //location.reload();
            //console.log(data);
            location.reload();
        });
	});
})();