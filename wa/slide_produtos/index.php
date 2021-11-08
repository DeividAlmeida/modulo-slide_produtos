<?php
header('Access-Control-Allow-Origin: *');
error_reporting(0);
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
if (ModoManutencao()) {
	header("Location: ../manutencao.php");
}

$id 		= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$QueryCat 	= DBRead('c_slide_produtos', '*', "WHERE id = '{$id}'");
$categoria 	= $QueryCat[0];

if ($id != '0') {
	$Query = DBRead('slide_produtos', '*', "WHERE id_categoria = '{$id}' AND status = 'checked' ORDER BY ordem ASC");
} else {
	$Query = DBRead('slide_produtos', '*', "WHERE status = 'checked' ORDER BY ordem ASC");
}
?>
<html lang="pt-BR" >
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="src/style/main.css">
	<link rel="stylesheet" href="src/style/ep-woocommerce.css">
	<link rel="stylesheet" href="src/style/bdt-uikit.css">
	<link rel="stylesheet" href="src/style/element-pack-site.css">
	<link rel="stylesheet" href="src/style/ep-advanced-button.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<style>
	<?php if (!empty($categoria['font_title'])) : ?>@import url("https://fonts.googleapis.com/css?family=<?= $categoria['font_title']; ?>");
	<?php endif; ?>
	<?php if (!empty($categoria['font_desc'])) : ?>@import url("https://fonts.googleapis.com/css?family=<?= $categoria['font_desc']; ?>");

	<?php endif; ?>
	#countdown{
		display			: flex;
		white-space		: nowrap;
		background		: <?= $categoria['cor_timer']; ?>  !important;
		color			: <?= $categoria['cor_text_timer']; ?>  !important;
		padding			: 10px;
		border-radius	: 15px;
	}
	.bdt-wc-slider-title{
		font-family	: <?= $categoria['font_title']; ?> !important;
		color		: <?= $categoria['cor_titulo']; ?> !important;
		font-size	: <?= $categoria['size_title']; ?> !important;
		font-weight	: <?= $categoria['weight_title']; ?> !important;
	}
	#descricao{
		color		: <?= $categoria['cor_descricao']; ?> !important;
		margin		: 0px;
	}
	.bdt-wc-slider .bdt-wc-slider-price{
		font-family	: <?= $categoria['font_desc']; ?> !important;		
		font-size	: <?= $categoria['size_desc']; ?> !important;
		font-weight : <?= $categoria['weight_desc']; ?> !important;
	}
	ins{
		color	: <?= $categoria['cor_bg']; ?> !important;
	}
	del{
		color	: <?= $categoria['cor_bg_hover']; ?> !important;

	}
	.fa-chevron-circle-left, .fa-chevron-circle-right{
		cursor	: pointer;
		color	: <?= $categoria['cor_icone']; ?> !important;
		border	: 2px solid <?= $categoria['cor_icone']; ?> !important;
	}
	.fa-chevron-circle-left:hover, .fa-chevron-circle-right:hover  {
		color	: <?= $categoria['cor_icone_hover']; ?> !important;
		border	: 2px solid <?= $categoria['cor_icone_hover']; ?> !important;
	}
	.bdt-wc-slider .bdt-wc-add-to-cart a:hover{
		background	: <?= $categoria['cor_btn_hover']; ?> !important;
		color		: <?= $categoria['cor_btn_txt_hover']; ?> !important;
		border		: 2px solid <?= $categoria['cor_btn_hover']; ?> !important;
	}
	.bdt-wc-slider .bdt-wc-add-to-cart a{
		background	: <?= $categoria['cor_btn']; ?> !important;
		color		: <?= $categoria['cor_btn_txt']; ?> !important;
		border		: 2px solid <?= $categoria['cor_btn']; ?> !important;
	}
	.w-100{
		width	: 100% !important;
	}
	.justify-content-between{
		justify-content	: space-between !important;
	}
	.bdt-controle{
		position	: relative !important;
		bottom		: 350px;
	}
	
	.bdt-wc-slider .bdt-wc-slider-image img{
		object-fit	: contain !important;
		height		: 100% !important;
		margin		: 80px 80px 80px 0px;
		max-height	: 480px !important;
	}
	
	.info{
		margin-left	: 80px !important;
		padding		: 0px 0px 30px 15px !important;
	}
	#clock{
		list-style-type			: none;
		display					: grid;
		grid-template-columns	: auto auto auto 25px;
		padding					: 1px;

	}
	ul#clock>li{
		display			: flex;
		justify-content	: center;
	}
	ul#clock>li.number{
		font-weight : bold;
		font-size:25px;
	}
	#countdown>label{
		margin	: 9px 10px 0px 2px
	}
	ul#clock>li>span{
		margin-right	: 10px !important
	}
	.text{
		display	: flex
	}
	.bt-mobile{
		display 		: none !important;
		width			: 100%;
		justify-content	: center !important;
		position		: relative;
		top				: 130px !important;
	}

	@media only screen and (min-width: 1250px){
		.bdt-wc-slider .bdt-wc-slider-image img{
			position: relative;
			right: 70px !important;
		}
	}

	@media only screen and (max-width:960px) {
		
		#countdown{
			display		: block;
		}

		.bdt-wc-slider .bdt-wc-add-to-cart a{
			padding		: 20px 50px;
			font-size 	: 15px !important;
		}
		.bt-mobile{
			display :	flex !important;
		}
		.bdt-controle{
			bottom: 290px !important;
		}


		.bdt-wc-slider .bdt-slider-item-content{
			background	: transparent !important;
			bottom		: 400px !important;
		}

		.info{
			margin	:0px !important;
		}

		.bdt-wc-slider.bdt-slideshow .bdt-slideshow-content-wrapper{
			text-align	: center !important;
			padding 	: 0px !important;
			position	: relative !important;
		}

		.bdt-wc-slider.bdt-slideshow .bdt-slideshow-content-wrapper .bdt-wc-add-to-cart-readmore{
			justify-content	: center !important;
		}

		.bdt-wc-slider .bdt-wc-slider-image> img{
			margin	: 0px !important;
			height	: 50% !important;
			position: absolute !important;
			top	: 225px !important;
		}

		.bdt-wc-slider .bdt-wc-slider-image{
			display	: contents !important;
		}

		.bdt-wc-slider .bdt-slideshow-item-inner .bdt-mobile-order{
			justify-content	: center !important;
		}

		.bdt-wc-slider .bdt-navigation-prev, .bdt-wc-slider .bdt-navigation-prev, .bdt-wc-slider .bdt-navigation-next{
			margin	: 0px !important;
		}

	}
	@media only screen and (max-width: 375px) {
		
		.bdt-wc-slider .bdt-wc-slider-image> img{
			margin	: 0px !important;
			width	: 100% !important;
			position: absolute !important;
			bottom	: 0px !important;
		}
		.bdt-wc-slider.bdt-slideshow .bdt-slideshow-content-wrapper{
			text-align	: center !important;
			padding 	: 0px !important;
			position	: relative !important;
			top			: 10px !important;
		}
		.bdt-wc-slider.bdt-slideshow .bdt-slideshow-content-wrapper .bdt-wc-slider-title{
			margin-top : 0px !important;
		}
	}
	</style>
</head>

<body
	class="page-template-default page page-id-41141 page-child parent-pageid-32 theme-rooten woocommerce-js tribe-js layout-default navbar-style2 header-mode-horizontal-center elementor-default elementor-kit-51364 elementor-page elementor-page-41141 e--ua-blink e--ua-chrome e--ua-webkit"
	data-elementor-device-mode="desktop">

	<div class="tm-main bdt-section bdt-padding-remove-vertical bdt-section-medium">
		<div>
			<div class="bdt-grid bdt-grid-large bdt-grid-stack" bdt-grid="">
				<div class="bdt-width-expand bdt-first-column">
					<main class="tm-content">

						<div data-elementor-type="wp-post" data-elementor-id="41141" class="elementor elementor-41141"
							data-elementor-settings="[]">
							<div class="elementor-inner">
								<div class="elementor-section-wrap">
								<?php if (is_array($Query)) : ?>
									<section	class="elementor-section elementor-top-section elementor-element elementor-element-339fc32 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
										data-id="339fc32" data-element_type="section"
										data-settings="{&quot;background_background&quot;:&quot;classic&quot;}"
										style="opacity: 1;">
										<div class="elementor-container elementor-column-gap-default">
											<div class="elementor-row">
												<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-bce4685"
													data-id="bce4685" data-element_type="column">
													<div class="elementor-column-wrap elementor-element-populated">
														<div class="elementor-widget-wrap">														
															<div class="elementor-element elementor-element-63e9d76 elementor-widget elementor-widget-bdt-wc-slider"
																data-id="63e9d76" data-element_type="widget"
																data-widget_type="bdt-wc-slider.default">
																<div class="elementor-widget-container">
																	<div data-bdt-slideshow="{&quot;animation&quot;:&quot;slide&quot;,&quot;ratio&quot;:&quot;1920:768&quot;,&quot;min-height&quot;:600,&quot;autoplay&quot;:<?= $categoria['seconds']?'true':'false'?>,&quot;autoplay-interval&quot;:<?= $categoria['seconds']*1000; ?>,&quot;velocity&quot;:1}"
																		class="bdt-wc-slider bdt-arrows-align-bottom-right bdt-slideshow">
																		<div
																			class="bdt-position-relative bdt-visible-toggle">
																			<ul class="bdt-slideshow-items bdt-child-width-1-1"
																				style="min-height: 600px;">
																				<?php foreach ($Query as  $dados) { ?>
																				<li class="bdt-slideshow-item" tabindex="-1" id="<?= $dados['id']?>">
																					<div class="bdt-slideshow-item-inner bdt-grid bdt-grid-collapse bdt-height-1-1"
																						data-bdt-grid="">
																						<div class="bdt-width-1-2@m bdt-flex bdt-flex-middle bdt-slider-item-content bdt-first-column">
																							<div class="bdt-slideshow-content-wrapper bdt-padding bdt-text-right info">

																								<div	class="bdt-wc-slider-price">
																									<div class="wae-product-price">
																										<p	class="price">
																											<?php if(count($dados['preco_c'])>0){ ?>
																												<del aria-hidden="true">
																														<span	class="woocommerce-Price-amount amount">
																														<bdi>
																															<span	class="woocommerce-Price-currencySymbol">R$</span>
																															<?= $dados['preco_c']; ?>
																														</bdi>
																													</span>
																												</del>	
																												<?php } ?>																										
																											<ins >
																												<span	class="woocommerce-Price-amount amount">
																													<bdi>
																														<span class="woocommerce-Price-currencySymbol">R$</span>
																														<?= $dados['preco']; ?>
																													</bdi>
																												</span>
																											</ins>
																										</p>
																									</div>
																								</div>

																								<p	class="bdt-wc-slider-title">
																									<?= $dados['titulo']; ?>
																								</p>

																								<div class="bdt-wc-rating bdt-flex bdt-flex-left"></div>
																								<div class="bdt-wc-slider-text bdt-visible@m">
																									<p id="descricao">
																										<?= $dados['descricao']; ?>
																									</p>
																								</div>

																								<div class="bdt-wc-add-to-cart-readmore bdt-flex bdt-flex-right bdt-flex-middle" >
																									<?php if($dados['timer'] == 'padrao' || $dados['timer'] == 'loop'){ ?>
																										<div id="countdown" data-type="<?=$dados['timer']?>" data-timer="<?= $dados['data_timer']?>" data-id="<?= $dados['id']?>">
																											<label> Oferta acaba em:</label>
																											<ul id="clock" class="timer">
																												<li class="number" id="days"></li>
																												<li class="number" id="hours"></li>
																												<li class="number" id="minutes"></li>
																												<li class="number" id="seconds"></li>
																												<li class="text">Dias</li>
																												<li class="text">Horas</li>
																												<li class="text">Min</li>
																												<li class="text">Seg</li>
																											</ul>
																										</div>
																								<?php } ?>
																								</div>
																								<div class="bdt-wc-add-to-cart-readmore bdt-flex bdt-flex-right bdt-flex-middle bdt-visible@m">
																									<div class="bdt-wc-add-to-cart">
																										<a target="<?= $dados['destino_url']; ?>" href="<?= $dados['url']; ?>"
																											data-quantity="1"
																											class="button product_type_simple add_to_cart_button ajax_add_to_cart"
																											data-product_id="41202"
																											data-product_sku=""
																											aria-label="Add “Scout Brook in Steel” to your cart"
																											rel="nofollow">Comprar</a>
																									</div>																									

																								</div>

																							</div>
																						</div>

																						<div
																							class="bdt-width-1-2@m bdt-flex bdt-flex-middle bdt-mobile-order">
																							<div
																								class="bdt-position-relative bdt-wc-slider-image">

																								<img src="<?= ConfigPainel('base_url'); ?>/wa/slide_produtos/uploads/<?= $dados['imagem']; ?>" alt="Scout Brook in Steel">																							

																							</div>
																						</div>
																						<div class="bt-mobile bdt-wc-add-to-cart-readmore bdt-flex bdt-flex-middle bdt-flex-middle">
																							<div class="bdt-wc-add-to-cart">
																								<a target="<?= $dados['destino_url']; ?>" href="<?= $dados['url']; ?>"
																									data-quantity="1"
																									class="button product_type_simple add_to_cart_button ajax_add_to_cart"
																									data-product_id="41202"
																									data-product_sku=""
																									aria-label="Add “Scout Brook in Steel” to your cart"
																									rel="nofollow">Comprar</a>
																							</div>																								
																						</div>
																					</div>
																				</li>
																				<?php } ?>																				
																			</ul>

																			<div class="bdt-position-z-index bdt-position-bottom-right  w-100 bdt-controle">
																				<div class="bdt-arrows-container bdt-slidenav-container w-100 justify-content-between">
																					<a class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav"	data-bdt-slideshow-item="previous" style="margin-left:10px">
																						<i class="fas fa-chevron-circle-left"></i>
																					</a>
																					<a class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav" data-bdt-slideshow-item="next" style="margin-right:20px">
																						<i class="fas fa-chevron-circle-right"></i>
																					</a>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
									<?php else : ?>
										<p>Não encontramos nenhuma informação para ser exibida.</p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</main> 
				</div> 
			</div> 
		</div> 
	</div> 
	<script>

document.querySelectorAll('#countdown').forEach(a=>{
		const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24,
		tipo = a.getAttribute('data-type');

		//I'm adding this section so I don't have to keep updating this pen every year :-)
		//remove this if you don't need it
		let today = new Date(),
		dd = String(today.getDate()).padStart(2, "0"),
		mm = String(today.getMonth() + 1).padStart(2, "0"),
		yyyy = today.getFullYear(),
		nextYear = yyyy + 1,
		birthday =  a.getAttribute('data-timer')

  		today = mm + "-" + dd + "-" + yyyy;
		if (today > birthday && tipo != 'loop') {
			birthday = dayMonth + nextYear;
		}
  		//end
  		let countDown = new Date(birthday).getTime(),
      	x = setInterval(function() {    
        let now = new Date().getTime(),
              distance = countDown - now;
		if(tipo == 'loop') {
			let minutos = (parseInt(a.getAttribute('data-timer').slice(0,2))*60)+parseInt(a.getAttribute('data-timer').slice(3))
			if(!localStorage.getItem(a.getAttribute('data-id')+'counterWA') || localStorage.getItem(a.getAttribute('data-id')+'counterWAC') != a.getAttribute('data-timer')){
				countDown = new Date().getTime()+minutos*60000
				distance = countDown - now;
				localStorage.setItem(a.getAttribute('data-id')+'counterWA',countDown)
				localStorage.setItem(a.getAttribute('data-id')+'counterWAC',a.getAttribute('data-timer'))
			}else{
								
				if((parseInt(localStorage.getItem(a.getAttribute('data-id')+'counterWA')) - now )<= 0){
					countDown = new Date().getTime()+minutos*60000
					localStorage.setItem(a.getAttribute('data-id')+'counterWA',countDown)
					distance = countDown - now;		
				}else{
					countDown = parseInt(localStorage.getItem(a.getAttribute('data-id')+'counterWA'))
					distance = countDown - now;		
				}
				
			}
		}
		  a.childNodes[3].childNodes[1].innerHTML = '<span>'+Math.floor(distance / (day))+'</span>'
		  a.childNodes[3].childNodes[9].innerHTML = '<span>Dias</span>'
		if (Math.floor(distance / (day))==0) {
			a.childNodes[3].childNodes[1].innerHTML = ''
			a.childNodes[3].childNodes[9].innerHTML = ''
		}
          a.childNodes[3].childNodes[3].innerHTML = '<span>'+Math.floor((distance % (day)) / (hour))+'</span>'
          a.childNodes[3].childNodes[11].innerHTML = '<span>Horas</span>'

		 if (Math.floor((distance % (day)) / (hour))<=0) {
			a.childNodes[3].childNodes[3].innerHTML = ''
			a.childNodes[3].childNodes[11].innerHTML = ''
		 }
          a.childNodes[3].childNodes[5].innerHTML = '<span>'+Math.floor((distance % (hour)) / (minute))+'</span>'
          a.childNodes[3].childNodes[13].innerHTML = '<span>Min</span>'
		  if (Math.floor((distance % (day)) / (minute))<=0) {
			a.childNodes[3].childNodes[5].innerHTML = ''
          	a.childNodes[3].childNodes[13].innerHTML = ''
		  }

          a.childNodes[3].childNodes[7].innerHTML = Math.floor((distance % (minute)) / second);

        //do something later when date is reached
        if (distance <= 0 && tipo == 'padrao') {
			document.getElementById(a.getAttribute('data-id')).remove()
			fetch('apis/?Status=null&id='+a.getAttribute('data-id'))
          	clearInterval(x);
        }
        //seconds
      }, 0)
	})

	</script>
	<script type="text/javascript"	src="src/script/bdt-uikit.min.js"></script>
</body>

</html>