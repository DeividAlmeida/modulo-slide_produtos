<?php
header('Access-Control-Allow-Origin: *');
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
	$Query = DBRead('slide_produtos', '*', "WHERE id_categoria = '{$id}' ORDER BY ordem ASC");
} else {
	$Query = DBRead('slide_produtos', '*', "ORDER BY ordem ASC");
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
									<section
										class="elementor-section elementor-top-section elementor-element elementor-element-339fc32 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
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
																	<div data-bdt-slideshow="{&quot;animation&quot;:&quot;slide&quot;,&quot;ratio&quot;:&quot;1920:768&quot;,&quot;min-height&quot;:600,&quot;autoplay&quot;:true,&quot;autoplay-interval&quot;:7000,&quot;velocity&quot;:1}"
																		class="bdt-wc-slider bdt-arrows-align-bottom-right bdt-slideshow">
																		<div
																			class="bdt-position-relative bdt-visible-toggle">
																			<ul class="bdt-slideshow-items bdt-child-width-1-1"
																				style="min-height: 600px;">

																				<li class="bdt-slideshow-item bdt-active bdt-transition-active"
																					tabindex="-1" >
																					<div class="bdt-slideshow-item-inner bdt-grid bdt-grid-collapse bdt-height-1-1"
																						data-bdt-grid="">
																						<div
																							class="bdt-width-1-2@m bdt-flex bdt-flex-middle bdt-slider-item-content bdt-first-column">
																							<div
																								class="bdt-slideshow-content-wrapper bdt-padding bdt-text-left">

																								<div
																									class="bdt-wc-slider-price">
																									<div
																										class="wae-product-price">
																										<p
																											class="price">
																											<del
																												aria-hidden="true"><span
																													class="woocommerce-Price-amount amount"><bdi><span
																															class="woocommerce-Price-currencySymbol">$</span>180.00</bdi></span></del>
																											<ins><span
																													class="woocommerce-Price-amount amount"><bdi><span
																															class="woocommerce-Price-currencySymbol">$</span>105.00</bdi></span></ins>
																										</p>
																									</div>
																								</div>

																								<h2
																									class="bdt-wc-slider-title">
																									Scout Brook in Steel
																								</h2>

																								<div
																									class="bdt-wc-rating bdt-flex bdt-flex-left">
																								</div>


																								<div
																									class="bdt-wc-add-to-cart-readmore bdt-flex bdt-flex-left bdt-flex-middle">
																									<div
																										class="bdt-wc-add-to-cart">
																										<a href="https://www.elementpack.pro/demo/element/woocommerce-slider/?add-to-cart=41202"
																											data-quantity="1"
																											class="button product_type_simple add_to_cart_button ajax_add_to_cart"
																											data-product_id="41202"
																											data-product_sku=""
																											aria-label="Add “Scout Brook in Steel” to your cart"
																											rel="nofollow">Add
																											to cart</a>
																									</div>


																									<a href="https://www.elementpack.pro/demo/product/scout-brook-in-steel/"
																										class="bdt-wc-slider-readmore ">
																										Read More

																									</a>

																								</div>

																							</div>
																						</div>

																						<div
																							class="bdt-width-1-2@m bdt-flex bdt-flex-middle bdt-mobile-order">
																							<div
																								class="bdt-position-relative bdt-wc-slider-image">

																								<img src="./WooCommerce Slider with element pack pro WordPress plugin_files/watch.jpg"
																									alt="Scout Brook in Steel">																							

																							</div>
																						</div>

																					</div>
																				</li>


																				<li class="bdt-slideshow-item"
																					tabindex="-1" >
																					<div class="bdt-slideshow-item-inner bdt-grid bdt-grid-collapse bdt-height-1-1 bdt-grid-stack"
																						data-bdt-grid="">
																						<div
																							class="bdt-width-1-2@m bdt-flex bdt-flex-middle bdt-slider-item-content bdt-first-column">
																							<div
																								class="bdt-slideshow-content-wrapper bdt-padding bdt-text-left">

																								<div
																									class="bdt-wc-slider-price">
																									<div
																										class="wae-product-price">
																										<p
																											class="price">
																											<del
																												aria-hidden="true"><span
																													class="woocommerce-Price-amount amount"><bdi><span
																															class="woocommerce-Price-currencySymbol">$</span>150.00</bdi></span></del>
																											<ins><span
																													class="woocommerce-Price-amount amount"><bdi><span
																															class="woocommerce-Price-currencySymbol">$</span>90.00</bdi></span></ins>
																										</p>
																									</div>
																								</div>

																								<h2
																									class="bdt-wc-slider-title">
																									Zoo T-Shirt</h2>

																								<div
																									class="bdt-wc-rating bdt-flex bdt-flex-left">
																									<div class="star-rating"
																										role="img"
																										aria-label="Rated 5.00 out of 5">
																										<span
																											style="width:100%">Rated
																											<strong
																												class="rating">5.00</strong>
																											out of
																											5</span>
																									</div>
																								</div>


																								<div
																									class="bdt-wc-add-to-cart-readmore bdt-flex bdt-flex-left bdt-flex-middle">
																									<div
																										class="bdt-wc-add-to-cart">
																										<a href="https://www.elementpack.pro/demo/element/woocommerce-slider/?add-to-cart=41174"
																											data-quantity="1"
																											class="button product_type_simple add_to_cart_button ajax_add_to_cart"
																											data-product_id="41174"
																											data-product_sku=""
																											aria-label="Add “Zoo T-Shirt” to your cart"
																											rel="nofollow">Add
																											to cart</a>
																									</div>


																									<a href="https://www.elementpack.pro/demo/product/zoo-t-shirt/"
																										class="bdt-wc-slider-readmore ">
																										Read More

																									</a>

																								</div>

																							</div>
																						</div>

																						<div
																							class="bdt-width-1-2@m bdt-flex bdt-flex-middle bdt-mobile-order bdt-first-column">
																							<div
																								class="bdt-position-relative bdt-wc-slider-image">

																								<img src="./WooCommerce Slider with element pack pro WordPress plugin_files/shirt.jpg"
																									alt="Zoo T-Shirt">
																							</div>
																						</div>

																					</div>
																				</li>


																				<li class="bdt-slideshow-item"
																					tabindex="-1">
																					<div class="bdt-slideshow-item-inner bdt-grid bdt-grid-collapse bdt-height-1-1 bdt-grid-stack"
																						data-bdt-grid="">
																						<div
																							class="bdt-width-1-2@m bdt-flex bdt-flex-middle bdt-slider-item-content bdt-first-column">
																							<div
																								class="bdt-slideshow-content-wrapper bdt-padding bdt-text-left">

																								<div
																									class="bdt-wc-slider-price">
																									<div
																										class="wae-product-price">
																										<p
																											class="price">
																											<del
																												aria-hidden="true"><span
																													class="woocommerce-Price-amount amount"><bdi><span
																															class="woocommerce-Price-currencySymbol">$</span>800.00</bdi></span></del>
																											<ins><span
																													class="woocommerce-Price-amount amount"><bdi><span
																															class="woocommerce-Price-currencySymbol">$</span>610.00</bdi></span></ins>
																										</p>
																									</div>
																								</div>

																								<h2
																									class="bdt-wc-slider-title">
																									Mini Bucket Bag in
																									Olive</h2>

																								<div
																									class="bdt-wc-rating bdt-flex bdt-flex-left">
																								</div>


																								<div
																									class="bdt-wc-add-to-cart-readmore bdt-flex bdt-flex-left bdt-flex-middle">
																									<div
																										class="bdt-wc-add-to-cart">
																										<a href="https://www.elementpack.pro/demo/element/woocommerce-slider/?add-to-cart=41163"
																											data-quantity="1"
																											class="button product_type_simple add_to_cart_button ajax_add_to_cart"
																											data-product_id="41163"
																											data-product_sku=""
																											aria-label="Add “Mini Bucket Bag in Olive” to your cart"
																											rel="nofollow">Add
																											to cart</a>
																									</div>


																									<a href="https://www.elementpack.pro/demo/product/mini-bucket-bag-in-olive/"
																										class="bdt-wc-slider-readmore ">
																										Read More

																									</a>

																								</div>

																							</div>
																						</div>

																						<div
																							class="bdt-width-1-2@m bdt-flex bdt-flex-middle bdt-mobile-order">
																							<div
																								class="bdt-position-relative bdt-wc-slider-image">

																								<img src="./WooCommerce Slider with element pack pro WordPress plugin_files/bag.jpg"
																									alt="Mini Bucket Bag in Olive">
																							</div>
																						</div>

																					</div>
																				</li>

																			</ul>

																			<div
																				class="bdt-position-z-index bdt-position-bottom-right bdt-visible@m">
																				<div
																					class="bdt-arrows-container bdt-slidenav-container">
																					<a href="https://www.elementpack.pro/demo/element/woocommerce-slider/"
																						class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav"
																						data-bdt-slideshow-item="previous">
																						<i class="ep-arrow-left-5"
																							aria-hidden="true"></i>
																					</a>
																					<a href="https://www.elementpack.pro/demo/element/woocommerce-slider/"
																						class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav"
																						data-bdt-slideshow-item="next">
																						<i class="ep-arrow-right-5"
																							aria-hidden="true"></i>
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
								</div>
							</div>
						</div>
					</main> 
				</div> 
			</div> 
		</div> 
	</div> 
	<script type="text/javascript"	src="src/script/bdt-uikit.min.js"></script>
</body>

</html>