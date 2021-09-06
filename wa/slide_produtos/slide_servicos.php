<?php
header('Access-Control-Allow-Origin: *');
require_once('../../includes/funcoes.php');
require_once('../../database/config.database.php');
require_once('../../database/config.php');
if (ModoManutencao()) {
	header("Location: ../manutencao.php");
}

$id 		= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$QueryCat 	= DBRead('c_slide_servicos', '*', "WHERE id = '{$id}'");
$categoria 	= $QueryCat[0];

if ($id != '0') {
	$Query = DBRead('slide_servicos', '*', "WHERE id_categoria = '{$id}' ORDER BY ordem ASC");
} else {
	$Query = DBRead('slide_servicos', '*', "ORDER BY ordem ASC");
}
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo RemoveHttpS(ConfigPainel('base_url')); ?>/epack/css/font-awesome.min.css">
<style>
	<?php if (!empty($categoria['font_title'])) : ?>@import url("https://fonts.googleapis.com/css?family=<?= $categoria['font_title']; ?>");
	<?php endif; ?><?php if (!empty($categoria['font_desc'])) : ?>@import url("https://fonts.googleapis.com/css?family=<?= $categoria['font_desc']; ?>");

	<?php endif; ?>.testimonial<?= "{$id} "; ?> {
		background: <?= $categoria['cor_bg']; ?>;
		background: -moz-linear-gradient(left, <?= $categoria['cor_bg']; ?> 0%, <?= $categoria['cor_bg']; ?> 48%, <?= $categoria['cor_bg_hover']; ?> 48%, <?= $categoria['cor_bg_hover']; ?> 100%);
		background: -webkit-linear-gradient(left, <?= $categoria['cor_bg']; ?> 0%, <?= $categoria['cor_bg']; ?> 51%, <?= $categoria['cor_bg_hover']; ?> 48%, <?= $categoria['cor_bg_hover']; ?> 100%);
		background: linear-gradient(to right, <?= $categoria['cor_bg']; ?> 0%, <?= $categoria['cor_bg']; ?> 48%, <?= $categoria['cor_bg_hover']; ?> 48%, <?= $categoria['cor_bg_hover']; ?> 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$info', endColorstr='$light', GradientType=1);
	}

	.testimonial<?= "{$id} "; ?>.testi<?= "{$id} "; ?>.title {
		color: <?= $categoria['cor_titulo']; ?>;
		line-height: 36px;
		font-family: <?= $categoria['font_title']; ?>;
		font-weight: <?= (!empty($categoria['weight_title'])) ? "{$categoria['weight_title']}" : '300'; ?>;
		font-size: <?= (!empty($categoria['size_title'])) ? "{$categoria['size_title']}px" : '2em'; ?>;
		margin-top: 80px;
		margin-bottom: 20px;
	}

	.testimonial<?= "{$id} "; ?>.testi<?= "{$id} "; ?>.content p {
		font-family: <?= $categoria['font_desc']; ?>;
		font-weight: <?= (!empty($categoria['weight_desc'])) ? "{$categoria['weight_desc']}" : '300'; ?>;
		font-size: <?= (!empty($categoria['size_desc'])) ? "{$categoria['size_desc']}px" : '1.1em'; ?>;
	}

	.testimonial<?= "{$id} "; ?>.testi<?= "{$id} "; ?>.owl-nav {
		float: right;
	}

	.testimonial<?= "{$id} "; ?>.testi<?= "{$id} "; ?>.owl-nav [class*="owl-"] {
		background: transparent;
		color: <?= $categoria['cor_icone']; ?>;
		font-size: 34px;
		margin: -100px 0 0 0px !important;
	}

	.testimonial<?= "{$id} "; ?>.testi<?= "{$id} "; ?>.owl-nav [class*="owl-"]:hover {
		color: <?= $categoria['cor_icone_hover']; ?>;
	}

	@media (max-width: 767px) {
		.testimonial<?= "{$id} "; ?> {
			background: -moz-linear-gradient(top, <?= $categoria['cor_bg']; ?> 0%, <?= $categoria['cor_bg']; ?> 51%, <?= $categoria['cor_bg_hover']; ?> 51%, <?= $categoria['cor_bg_hover']; ?> 100%);
			background: -webkit-linear-gradient(top, <?= $categoria['cor_bg']; ?> 0%, <?= $categoria['cor_bg']; ?> 51%, <?= $categoria['cor_bg_hover']; ?> 51%, <?= $categoria['cor_bg_hover']; ?> 100%);
			background: linear-gradient(to bottom, <?= $categoria['cor_bg']; ?> 0%, <?= $categoria['cor_bg']; ?> 51%, <?= $categoria['cor_bg_hover']; ?> 51%, <?= $categoria['cor_bg_hover']; ?> 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$info', endColorstr='$light', GradientType=1);
		}
	}

	.testimonial<?= "{$id} "; ?>.btnCustom {
		background: <?= $categoria['cor_btn']; ?> !important;
		border: 0px !important;
		border-radius: 3px;
		color: <?= $categoria['cor_btn_txt']; ?> !important;
	}

	.testimonial<?= "{$id} "; ?>.btnCustom:hover {
		background: <?= $categoria['cor_btn_hover']; ?> !important;
		border: 0px !important;
		border-radius: 3px;
		color: <?= $categoria['cor_btn_txt_hover']; ?> !important;
	}

	@media (min-width: 992px) {
		.vertical-align {
			display: flex;
			align-items: center;
		}
	}
</style>

<?php if (is_array($Query)) : ?>
	<div class="testimonial<?= "{$id} "; ?> spacer bg-light">
		<div class="container">
			<div class="owl-carousel owl-theme testi<?= "{$id} "; ?>">
				<?php foreach ($Query as $dados) : ?>
					<div class="item">
						<div class="row vertical-align">
							<div class="col-lg-7 col-md-6" style="margin-top: <?= ($categoria['padding_y'] + 39) . "px"; ?>; padding-bottom: <?= "{$categoria['padding_y']}px"; ?>;">
								<img src="<?= ConfigPainel('base_url'); ?>/wa/slide_servicos/uploads/<?= $dados['imagem']; ?>" alt="wrapkit" class="img-fluid" />
							</div>
							<div class="col-lg-5 col-md-6 content">
								<h1 class="text-uppercase title"><?= $dados['titulo']; ?></h1>
								<p class="desc"><?= $dados['conteudo']; ?></p>
								<!-- <h6 style="margin-top:5rem;">Michelle Anderson</h6>
								<span>Partner, Brevin</span> -->

								<?php if (!empty($dados['txt_botao'])) : ?>
									<a class="btn btn-default btn-lg btnCustom" target="<?= $dados['destino_url']; ?>" href="<?= $dados['url']; ?>" style="margin-top: 1.5em;">
										<span><?= $dados['txt_botao']; ?></span>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>

			</div>
		</div>
	</div>

<?php else : ?>
	<p>Não encontramos nenhuma informação para ser exibida.</p>
<?php endif; ?>

<script>
	jQuery(document).ready(function() {
		$('.testi<?= "{$id} "; ?>').owlCarousel({
			loop: true,
			margin: 30,
			nav: true,
			navText: ['<i class="fas fa-chevron-circle-left"></i>', '<i class="fas fa-chevron-circle-right"></i>'],
			dots: false,
			<?php if ($categoria['seconds'] > 0) : ?>
				autoplay: true,
				autoplayTimeout: <?= ($categoria['seconds'] * 1000); ?>,
			<?php endif; ?>
			center: true,
			responsiveClass: true,
			responsive: {
				0: {
					items: 1

				},
				1650: {
					items: 1
				}
			}
		})
	});
</script>