jQuery(document).ready(function($) {
	//importar clientes para a base
	$('#gmi-import-cli').on('click',function() {
		var field_cli = $('input[name="plandd_option[csv-clientes][url]"]').eq(0).val(),
		    ext = field_cli.slice(-3),
		    $this = $(this);
		
		if(ext == 'csv' || ext == 'CSV') {
			$.ajax({
				url: getData.ajaxDir,
				type: 'GET',
				dataType: 'html',
				data: {
					action: 'update_users_by_csv',
					param: field_cli
				},
				beforeSend: function() {
					$this.attr('disabled','disabled');
					$this.siblings('span').addClass('is-active');
					$this.siblings('p').removeClass('hide');
				},
				complete: function() {
					$this.removeAttr('disabled');
					$this.siblings('span').removeClass('is-active');
					$this.siblings('p').addClass('hide');
				},
				success: function(data) {
					alert('Operação concluída!');
				},
				error: function() {
					alert('Ocorreu algum erro durante a importação. Tente novamente.');
				}
			});
		} else {
			alert('Arquivo inválido');
		}
	});


	$('#gmi-import-prod').on('click',function() {
		var field_cli = $('input[name="plandd_option[csv-produtos][url]"]').eq(0).val(),
		    ext = field_cli.slice(-3),
		    $this = $(this);
		
		if(ext == 'csv' || ext == 'CSV') {
			$.ajax({
				url: getData.ajaxDir,
				type: 'GET',
				dataType: 'html',
				data: {
					action: 'GMI_Produtos',
					param: field_cli
				},
				beforeSend: function() {
					$this.attr('disabled','disabled');
					$this.siblings('span').addClass('is-active');
					$this.siblings('p').removeClass('hide');
				},
				complete: function() {
					$this.removeAttr('disabled');
					$this.siblings('span').removeClass('is-active');
					$this.siblings('p').addClass('hide');
				},
				success: function(data) {
					alert('Operação concluída!');
				},
				error: function() {
					alert('Ocorreu algum erro durante a importação. Tente novamente.');
				}
			});
		} else {
			alert('Arquivo inválido');
		}
	});
});