

$(function(){

	// cria uma nova aba referente a transação selecionada pelo usuário  (menu superior)
	$(".dropdown-menu li a").click(function(){
		var controller = $(this).attr('ctr'); //este atributo será utilizado para trazer o controller da transaçãoque será utilizado para manupulkar abas (abrir fechar etc) as abas
		var desc = $(this).text() ; // pega descrição do menu e utiliza nas abas que serão abertas

		//função que efetivamente criara a aba e respectivos conteudos
		criarNovaAba(controller, desc);

	});

	// deixa a aba ativa e o respectivo conteudo tb
	$(".nav.nav-tabs").on("click", "li a", function(){
		var numTran = $(this).attr('numtab');

		ativarAba(numTran);
	});


	// fecha a aba e seu respectivo conteudo
	$(".nav.nav-tabs").on("click", "li a span", function(){
		var numtab = $(this).closest("a").attr("numtab");
		$('a[numtab="'+ numtab +'"]').parent().remove();//remove a aba do numtab selecionado
		$('div[numtab="'+ numtab +'"]').remove(); //remove a div que contem o numtab selecionado

		ativaAbaAposFechar();
	});
	
	//inicia o sistema abrindo a guia abaixo:
	criarNovaAba('assunto/conceito', 'Conceitos');

}); //fim do código


	// cria uma div com o conteudo da transação selecionada pelo usuário
	function addConteudo(numTran){
		var counter = numTran;
		$('.conteudo-principal').append('<div class="conteudo" numtab="'+numTran+'"></div>');
		// $('<div class="conteudo">conteudo</div>');
	}

	// verifica o maior numero de controle de aba existente e retorna o maior mais 1
	function numTab(){

		numTran = parseInt($(".nav.nav-tabs li a").last().attr('numtab'));

		// se não é um numero, então começa com 100
		if (isNaN(numTran)) {
			numTran = 100;
		} else{ //senão acrescenta mais um
			numTran ++;
		};
		
		return parseInt(numTran);
	}

	// função que exibe o conteudo de acordo com o numtab
	function exibeConteudo(numTran){
		$('div[numtab="'+ numTran +'"]').show();
	}

	//oculta todos os conteudos.
	function ocultaConteudo(){
		$('.conteudo-principal .conteudo').hide();
	}

	// cria uma nova aba referente a transação selecionada pelo usuário
	function criarNovaAba(controller, desc){

		
		fecha_aba_mesmo_ctr(controller);
		// alert('entriou' + controller + desc + numTran);
		var numTran = numTab();
		$('.nav.nav-tabs li').removeClass('active');
		var $addAba = '<li class="active"><a href="#" numtab="'+ numTran +'" id="'+ desc  +'" crt="'+ controller +'">'+ desc  +'&nbsp<span>x</span>&nbsp</a></li>';
	    $(".nav.nav-tabs").append($addAba);
	    addConteudo(numTran);//cria uma div com classe conteudo
	    ocultaConteudo(); //oculta todos os conteudos
		exibeConteudo(numTran); //exibe conteudo apenas da aba selecionada
		addConteudoDiv(numTran, controller);
	}

	// cria uma nova aba referente a transação selecionada pelo usuário,
	function criarNovaAbaSemConteudo(controller, desc, numTran){

		// alert('entriou' + controller + desc + numTran);
		var numTran = numTab();

		if (controller.substring(0, 18) == 'ocorrencia/update/') {
			fecha_aba_ocorrencia_update(controller);
		}else if(controller.substring(0, 15) == 'assunto/update/'){
			fecha_aba_assunto_update(controller);
		}

		$('.nav.nav-tabs li').removeClass('active');
		var $addAba = '<li class="active"><a href="#" numtab="'+ numTran +'" id=" '+ desc  +'" crt="'+ controller +'">'+ desc  +'&nbsp<span>x</span>&nbsp</a></li>';
	    $(".nav.nav-tabs").append($addAba);
	    addConteudo(numTran);//cria uma div com classe conteudo
	    ocultaConteudo(); //oculta todos os conteudos
		exibeConteudo(numTran); //exibe conteudo apenas da aba selecionada
	}

	function fecha_aba_ocorrencia_update(controller){
		var sub_ctr = controller.substring(0, 18);

		$( "li a" ).each(function( index ) {
		
		if($(this).attr('crt')){
			var sub_att = $(this).attr('crt').substring(0, 18);
			
			if( sub_att == sub_ctr){
				var numtab = $(this).attr('numtab');
				$('a[numtab="'+ numtab +'"]').parent().remove();//remove a aba do numtab selecionado
				$('div[numtab="'+ numtab +'"]').remove(); //remove a div que contem o numtab selecionado

			}

		};
		  
		});

	}

	function fecha_aba_assunto_update(controller){
		var sub_ctr = controller.substring(0, 15);

		$( "li a" ).each(function( index ) {
		
		if($(this).attr('crt')){
			var sub_att = $(this).attr('crt').substring(0, 15);
			if( sub_att == sub_ctr){
				var numtab = $(this).attr('numtab');
				$('a[numtab="'+ numtab +'"]').parent().remove();//remove a aba do numtab selecionado
				$('div[numtab="'+ numtab +'"]').remove(); //remove a div que contem o numtab selecionado

			}

		};
		  
		});

	}



	// ativa a aba de acordo com o numTran
	function ativarAba(numTran){

		//VARIAVEL será utiliozada para verificar se o numero que quer ativar existe
		var numAtivar = $('a[numtab="'+ numTran +'"]').attr('numtab')
		
		// alert('ativarAba(numTran)' + numTran);
		// alert('numAtivar' + numAtivar)


		//condição criada devido ao conflito quando usuário fechava uma aba,
		//a função ativaAbaAposFechar() era disparada, mas a função ativarAba(numTran)
		//era disparada após ela, ocultando todos conteudos.
		if (numAtivar == numTran) {//se a tab ainda existe, então ativa
		    $('.nav.nav-tabs li').removeClass('active');
		    $('a[numtab="'+ numTran +'"]').parent().addClass('active');
			ocultaConteudo(); //oculta todos os conteudos
			exibeConteudo(numTran); //exibe conteudo apenas da aba selecionada
		};
	}

	// função que ativa a maior aba após alguma ser fechada
	function ativaAbaAposFechar(){


		var numTran  = parseInt($(".nav.nav-tabs li a").last().attr('numtab'));
		
		// alert('ativaAbaAposFechar()' + numTran);
		// alert(numTran);
		// ativarAba(numTran);
		// exibeConteudo(numTran);
		$('.nav.nav-tabs li').removeClass('active');
	    $('a[numtab="'+ numTran +'"]').parent().addClass('active');
		// $(this).addClass('active');
		ocultaConteudo(); //oculta todos os conteudos
		exibeConteudo(numTran); //exibe conteudo apenas da aba selecionada
	}

	
	//adiciona o conteudo recebido do controler na div conteudo
	function addConteudoDiv(numTran, controller){

		var href = controller;
			$.ajax({
				url: href,
				success: function( response ){
 					$('div[numtab="'+ numTran +'"]').append(response);
				}
			});
	}

	function fecha_aba_mesmo_ctr(controller){
		var numtab = $('a[crt="'+ controller +'"]').attr('numtab');
		$('a[numtab="'+ numtab +'"]').parent().remove();//remove a aba do numtab selecionado
		$('div[numtab="'+ numtab +'"]').remove(); //remove a div que contem o numtab selecionado

		if(controller == "assunto/create"){
			if ($('.modal.fade').length) {
				$(this).remove();
			};
		}
	}


	function update_menu_sidebar(){

		var controller = 'home/update_menu_sidebar';

		$.ajax({
			            type      : 'post',
			            url       : controller, //é o controller que receberá
			            
			            success: function( response ){
			            	// $(document).ready(function() {
			            	$('.nav-acordos').remove();
			            	$('#nav-sidebar script').remove();
			                $('#nav-sidebar').append(response);
			            // }
			            }
			    });
			}

	function update_container_conceito(){

		var controller = 'assunto/conceito_itens';

		$.ajax({
	            type      : 'post',
	            url       : controller, //é o controller que receberá
	            
	            success: function( response ){
	            	$('.container-conceito').empty();
	                $('.container-conceito').append(response);

	            }
	    });
	}


