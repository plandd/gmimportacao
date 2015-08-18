// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

//plugins
$.fn.getDataThumb = function(options) {
    options = $.extend({
        bgClass: 'bg-cover'
    }, options || {});
    return this.each(function() {
        var th = $(this).data('thumb');
        if (th) {
            $(this).css('background-image', 'url(' + th + ')').addClass(options.bgClass);
        }
    });
};
$('figure').getDataThumb(); // data-thumb para esses elementos

$('a','#corp-skills').on('click',function(e) { e.preventDefault(); });

/**
 * Navegação
 * ---------------------------------------------------------------------
 */
//Escolher entre o menu de produtos ou grupos
$('a','div.main-items').on('click',function(e) {
	e.preventDefault();
	var i = $(this).index();
	//console.log(i);
	$(this).toggleClass('active')
	.siblings('a').removeClass('active');

	$('.list-menu','.search-menu').eq(i).addClass('active')
	.siblings('ul').removeClass('active');
});

/**
 * Sliders
 * ---------------------------------------------------------------------
 */

//Distribuidores oficiais
(function() {
    var partners = $("#list-partners");
    partners.owlCarousel({
        responsiveBaseWidth: $("#list-partners"),
        responsive: false,
        pagination: false,
        items: 5,
        rewindNav: false,
        rewindSpeed: 300,
        autoPlay : 5000
    });

    //navegação
    $(".next-partner").click(function(e){
        e.preventDefault();
        partners.trigger('owl.next');
    });
    $(".prev-partner").click(function(e){
        e.preventDefault();
        partners.trigger('owl.prev');
    });


    var testimonials = $("#nav-testimonials");
    testimonials.owlCarousel({
        responsiveBaseWidth: $("#nav-testimonials"),
        responsive: false,
        pagination: true,
        items: 1,
        rewindNav: false,
        rewindSpeed: 300,
        autoPlay : 5000
    });
})();

/**
 * Usuários
 * ---------------------------------------------------------------------
 */
(function() {
    //ajaxSetup
    $.ajaxSetup({
        url: getData.ajaxDir,
        type: 'GET',
        dataType: 'html',
        beforeSend: function() {
            $('#ajax-loader').addClass('show');
        },
        complete: function() {
            $('#ajax-loader').removeClass('show');
        }
    });

    //Logar
    $('#login-form, .login-form-alt').on('submit',function(e) {
        e.preventDefault();
        var user = $(this).serialize();
        $.ajax({
            data: {
                action: 'plandd_login_user',
                user_data: user
            },
            success: function(data) {
                if(data == 'error')
                    alert('Usuário ou senha inválido. Tente novamente');
                else
                    location.reload();
            },
            error: function() {
                alert("Dados inválidos. Tente novamente dentro de alguns instantes.");
            }
        });
    });

    //logaout
    $('.user-logout').on('click',function(e) {
        e.preventDefault();
        $.ajax({
            data: {
                action: 'plandd_logout_user',
                user_data: user
            },
            success: function(data) {
                location.reload();
            },
            error: function() {
                alert("Dados inválidos. Tente novamente dentro de alguns instantes.");
            }
        });
    });

    //Mudar senha
    $('#update-pass').on('submit',function(e) {
        e.preventDefault();
        var pass = $('input[name="password"]',this).val(),
            user_id = $('input[name="id_usuario"]',this).val();

        $.ajax({
            data: {
                action: 'update_user_pass',
                pass: pass,
                user_id: user_id
            },
            success: function(data) {
                alert('Sua senha foi alterada com sucesso');
                location.reload();
            },
            error: function(e) {
                alert(e.statusText);
            }
        });
    });

    //Enviar mensagem para departamentos
    $('input.disabled').each(function(index, el) {
        $(this).focusin(function(event) {
           $(this).blur();
        });
    });

    $('#support-form').on('submit',function(e) {
        e.preventDefault();
        var dataForm = $(this).serialize();

        $.get(getData.ajaxDir, { action: 'gmi_req_support', data_form: dataForm })
        .done(function(data) {
            alert('Seu e-mail foi enviado com sucesso');
            window.location.href = data;
        });
    });
})();

/**
 * Perguntas frequentes
 * ---------------------------------------------------------------------
 */
(function() {
    $('li','.faq-list').click(function() {
        $(this).toggleClass('active')
        .siblings('li').removeClass('active');
    });
})();

/**
 * Botão mais produtos
 * ---------------------------------------------------------------------
 */
(function(){
    $('.req-posts').on('click',function(e) {
        e.preventDefault();
        var term_id = $(this).data('term'),
            total_posts = parseInt($(this).data('total')),
            tax = $(this).data('tax'),
            brand_slug = ($(this).data('brand')) ? $(this).data('brand') : null,
            $this = $(this);

        $.get(getData.ajaxDir, { action: 'get_more_posts', term: term_id, total: total_posts, taxonomy: tax, brand: brand_slug })
        .done(function(data) {     
            if(data != "false") {
                total_posts += 15;
                $this.data('total',total_posts);
                $('ul','#list-products').append(data);
            } else {
                $this.fadeOut('fast', function() {
                    $this.remove();
                });
            }
        });
    });
})();

/**
 * Solicitar cadastro
 * ---------------------------------------------------------------------
 */
(function() {
    $('.request-gmi-account').on('submit',function(e) {
        e.preventDefault();
        var data_form = $(this).serialize();
        $.get(getData.ajaxDir, { action: 'request_gmi_account', data_form: data_form })
        .done(function(data) {     
            if(data != "false") {
                window.location.href = data;
            } else {
                alert('Ocorreu algum erro. Tente novamente ou entre em contato com o nosso suporte.');
            }
        });
    });
})();
