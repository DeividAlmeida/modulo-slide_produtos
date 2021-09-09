<?php require_once('includes/funcoes.php'); ?>
<?php require_once('includes/header.php'); ?>
<?php require_once('includes/menu.php'); ?>
<?php require_once('controller/slide_produtos.php'); ?>
<?php $TitlePage = 'Slide de Produtos'; ?>
<?php $UrlPage	 = 'slide_produtos.php'; ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="assets/plugins/iconpicker/bootstrap-iconpicker.min.css" />
<div class="has-sidebar-left">
	<header class="blue accent-3 relative nav-sticky">
		<div class="container-fluid text-white">
			<div class="row p-t-b-10 ">
				<div class="col">
					<h4><i class="icon icon-object-group"></i> <?= $TitlePage; ?></h4>
				</div>
			</div>
		</div>
	</header>

	<div class="container-fluid animatedParent animateOnce my-3">
		<p>
			<a class="btn btn-sm btn-primary" href="<?= $UrlPage; ?>">Listagens</a>

			<?php if (DadosSession('nivel') == 1) { ?>
				<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')) { ?>
					<a class="btn btn-sm btn-primary" href="?AdicionarCategoria">Cadastrar Listagem</a>
				<?php } ?>
			<?php } ?>
		</p>

		<?php
		if (isset($_GET['AdicionarItem']) || isset($_GET['EditarItem'])) {

			if (isset($_GET['AdicionarItem'])) {
				if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) {
					Redireciona('./index.php');
				}
				$post = "?Adicionar";
			}

			if (isset($_GET['EditarItem'])) {
				if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'editar')) {
					Redireciona('./index.php');
				}

				$id = get('EditarItem');
				$Query = DBRead('slide_produtos', '*', "WHERE id = '{$id}'");
				if (is_array($Query)) {
					$dados = $Query[0];
				}

				$post = "?Atualizar={$id}";
			}

			VerificaCategoria('c_slide_produtos');
		?>
			<form method="post" action="<?= $post; ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header  white">
						<strong>Salvar Item</strong>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Titulo:</label>
									<input class="form-control" name="titulo" value="<?= $dados['titulo'] ?? ''; ?>" required>
								</div>

								<div class="form-group">
									<label>Texto do Botão:</label>
									<input class="form-control" name="txt_botao" value="<?= $dados['txt_botao'] ?? ''; ?>">
								</div>

								<div class="form-group">
									<label>Preço:</label>
									<input class="form-control" type="number" name="preco" step="any" value="<?= $dados['preco'] ?? ''; ?>">
								</div>

								<div class="form-group">
									<label>URL:</label>
									<input class="form-control" name="url" value="<?= $dados['url'] ?? ''; ?>">
									<small>Deixe esse campo em branco para que seu slider não possua nenhum link.</small>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Destino URL:</label>
									<select class="form-control" name="destino_url" data-selected="<?= $dados['destino_url'] ?? ''; ?>">
										<option value="_blank">Nova Guia</option>
										<option value="_top">Guia Atual</option>
									</select>
								</div>

								
								<div class="form-group">
								<label>Categoria:</label>
									<select class="form-control" name="id_categoria" data-selected="<?= $dados['id_categoria'] ?? $_GET['AdicionarItem']; ?>">
										<?php foreach (DBRead('c_slide_produtos', '*', 'WHERE id > 0') ?? [] as $c_dados) { ?>
											<option value="<?= $c_dados['id']; ?>"><?= $c_dados['categoria']; ?></option>
										<?php } ?>
									</select>
								</div>
										
								<div class="form-group">
									<label>Preço Cortado:</label>
									<input class="form-control" step="any" name="preco_c" type="number" value="<?= $dados['preco_c'] ?? ''; ?>">
								</div>

								<div class="form-group">
									<label>Selecionar Imagem: <a target="_blank" href="<?= ConfigPainel('base_url'); ?>/wa/slide_produtos/uploads/<?= $dados['imagem'] ?? ''; ?>"><small>Imagem Atual</small></a></label>
									<input class="form-control" type="file" name="imagem">
									<input class="form-control" type="hidden" name="imagem_atual" value="<?= $dados['imagem'] ?? ''; ?>">
								</div>

								<div class="form-group">
									<label>Ordenar:</label>
									<input class="form-control" type="number" name="ordem" value="<?= $dados['ordem'] ?? ''; ?>">
								</div>
							</div>							
						</div>

						<div class="card-footer white">
							<button class="btn btn-primary float-right" type="submit">Salvar Alterações</button>
						</div>
					</div>
			</form>
		<?php } elseif (isset($_GET['AdicionarCategoria']) || isset($_GET['EditarCategoria'])) {
			if (isset($_GET['AdicionarCategoria'])) {
				if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')) {
					Redireciona('./index.php');
				}
				$post = "?AddCategoria";
			}

			if (isset($_GET['EditarCategoria'])) {
				if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'editar')) {
					Redireciona('./index.php');
				}

				$id = get('EditarCategoria');
				$Query = DBRead('c_slide_produtos', '*', "WHERE id = '{$id}'");
				if (is_array($Query)) {
					$c_dados = $Query[0];
				}

				$post = "?AtualizarCategoria={$id}";
			}
		?>
			<form method="post" action="<?= $post; ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header  white">
						<strong>Salvar Listagem</strong>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label>Titulo:</label>
									<input class="form-control" name="categoria" value="<?= $c_dados['categoria'] ?? ''; ?>" required>
								</div>
							</div>
						</div>						
						<div class="row">
							<div class="col">
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label>Cor do Preço:</label>
											<div class="color-picker input-group colorpicker-element focused">
												<input type="text" value="<?= $c_dados['cor_bg'] ?? ''; ?>" name="cor_bg" class="form-control">
												<span class="input-group-append">
													<span class="input-group-text add-on white">
														<i class="circle" style="background-color: rgb(0, 170, 187);"></i>
													</span>
												</span>
											</div>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label>Cor do Preço Cortado:</label>
											<div class="color-picker input-group colorpicker-element focused">
												<input type="text" value="<?= $c_dados['cor_bg_hover'] ?? ''; ?>" name="cor_bg_hover" class="form-control">
												<span class="input-group-append">
													<span class="input-group-text add-on white">
														<i class="circle" style="background-color: rgb(0, 170, 187);"></i>
													</span>
												</span>
											</div>
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col">
										<div class="form-group">
											<label>Cor Botão:</label>
											<div class="color-picker input-group colorpicker-element focused">
												<input type="text" value="<?= $c_dados['cor_btn'] ?? ''; ?>" name="cor_btn" class="form-control">
												<span class="input-group-append">
													<span class="input-group-text add-on white">
														<i class="circle" style="background-color: rgb(0, 170, 187);"></i>
													</span>
												</span>
											</div>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label>Cor Botão Hover:</label>
											<div class="color-picker input-group colorpicker-element focused">
												<input type="text" value="<?= $c_dados['cor_btn_hover'] ?? ''; ?>" name="cor_btn_hover" class="form-control">
												<span class="input-group-append">
													<span class="input-group-text add-on white">
														<i class="circle" style="background-color: rgb(0, 170, 187);"></i>
													</span>
												</span>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col">
										<div class="form-group">
											<label>Cor Texto Botão:</label>
											<div class="color-picker input-group colorpicker-element focused">
												<input type="text" value="<?= $c_dados['cor_btn_txt'] ?? ''; ?>" name="cor_btn_txt" class="form-control">
												<span class="input-group-append">
													<span class="input-group-text add-on white">
														<i class="circle" style="background-color: rgb(0, 170, 187);"></i>
													</span>
												</span>
											</div>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label>Cor Texto Botão Hover:</label>
											<div class="color-picker input-group colorpicker-element focused">
												<input type="text" value="<?= $c_dados['cor_btn_txt_hover'] ?? ''; ?>" name="cor_btn_txt_hover" class="form-control">
												<span class="input-group-append">
													<span class="input-group-text add-on white">
														<i class="circle" style="background-color: rgb(0, 170, 187);"></i>
													</span>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label>Cor Titulo:</label>
											<div class="color-picker input-group colorpicker-element focused">
												<input type="text" value="<?= $c_dados['cor_titulo'] ?? ''; ?>" name="cor_titulo" class="form-control">
												<span class="input-group-append">
													<span class="input-group-text add-on white">
														<i class="circle" style="background-color: rgb(0, 170, 187);"></i>
													</span>
												</span>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col">
										<div class="form-group">
											<label>Cor Setas:</label>
											<div class="color-picker input-group colorpicker-element focused">
												<input type="text" value="<?= $c_dados['cor_icone'] ?? ''; ?>" name="cor_icone" class="form-control">
												<span class="input-group-append">
													<span class="input-group-text add-on white">
														<i class="circle" style="background-color: rgb(0, 170, 187);"></i>
													</span>
												</span>
											</div>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label>Cor Setas Hover:</label>
											<div class="color-picker input-group colorpicker-element focused">
												<input type="text" value="<?= $c_dados['cor_icone_hover'] ?? ''; ?>" name="cor_icone_hover" class="form-control">
												<span class="input-group-append">
													<span class="input-group-text add-on white">
														<i class="circle" style="background-color: rgb(0, 170, 187);"></i>
													</span>
												</span>
											</div>
										</div>
									</div>
								</div>

								<div class="row">									
									<div class="col">
										<div class="form-group">
											<label>Tempo de transição em segundos:</label>
											<input type="number" class="form-control" name="seconds" value="<?= $c_dados['seconds'] ?? ''; ?>">
											<em>Deixe em branco para transição manual</em>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
						<h3>ESTILO DO TÍTULO</h3>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Tamanho da fonte <small>em PX</small>:</label>
									<select name="size_title" class="form-control" data-selected="<?= $c_dados['size_title']; ?>">
										<?php for ($i = 4; $i < 61; $i++) { ?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Tipo da fonte:</label>
									<select name="weight_title" class="form-control" data-selected="<?= $c_dados['weight_title']; ?>">
										<option value="normal">Normal</option>
										<option value="lighter">Lighter</option>
										<option value="bold">Bold</option>
										<option value="bolder">Bolder</option>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Fonte <?= (!empty($c_dados['font_title'])) ? "(Atual: {$c_dados['font_title']})" : ''; ?>:</label><br>
									<select class="select_fontfamily" name="font_title" data-selected="<?= $c_dados['font_title']; ?>"></select>
								</div>
							</div>
						</div>
						<hr>

						<h3>ESTILO DO PREÇO</h3>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Tamanho da fonte <small>em PX</small>:</label>
									<select name="size_desc" class="form-control" data-selected="<?= $c_dados['size_desc']; ?>">
										<?php for ($i = 4; $i < 61; $i++) { ?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?>px</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Tipo da fonte:</label>
									<select name="weight_desc" class="form-control" data-selected="<?= $c_dados['weight_desc']; ?>">
										<option value="normal">Normal</option>
										<option value="lighter">Lighter</option>
										<option value="bold">Bold</option>
										<option value="bolder">Bolder</option>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label>Fonte <?= (!empty($c_dados['font_desc'])) ? "(Atual: {$c_dados['font_desc']})" : ''; ?>:</label><br>
									<select class="select_fontfamily" name="font_desc" data-selected="<?= $c_dados['font_desc']; ?>"></select>
								</div>
							</div>
						</div>

					</div>

					<div class="card-footer white">
						<button class="btn btn-primary float-right" type="submit">Salvar Alterações</button>
					</div>
				</div>
			</form>
		<?php
		} elseif (isset($_GET['VisualizarCategoria'])) {
			$id = $_GET['VisualizarCategoria'];
			$Query = DBRead('slide_produtos', '*', "WHERE id_categoria = '{$id}'");
		?>
			<div class="card">
				<div class="card-header  white">
					<strong>Itens Cadastrados</strong>
				</div>

				<div class="card-body p-0">					
					<div class="table-responsive" style="overflow-x: visible !important">
						<table id="DataTable" class="table m-0 table-striped">
							<?php if (is_array($Query)) { ?>
								<tr>
									<th>ID</th>
									<th>Imagem</th>
									<th>Titulo</th>
									<th>Categoria</th>
									<th width="53px">Ações</th>
								</tr>
								<?php
								foreach ($Query as $dados) { ?>
									<tr>
										<td><?= $dados['id']; ?></td>
										<td width="150"><img class="no-b no-p r-5" src="wa/slide_produtos/uploads/<?= $dados['imagem']; ?>" /></td>
										<td><?= LimitarTexto($dados['titulo'], '80', '...'); ?></td>
										<td><?= VerificaCategoriaItem($dados['id_categoria'], 'c_slide_produtos'); ?></td>
										<td>
											<div class="dropdown">
												<a class="" href="#" data-toggle="dropdown">
													<i class="icon-apps blue lighten-2 avatar"></i>
												</a>

												<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
													<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'editar')) { ?>
														<a class="dropdown-item" href="?EditarItem=<?= $dados['id']; ?>"><i class="text-primary icon icon-pencil"></i> Editar</a>
													<?php } ?>
													<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) { ?>
														<a class="dropdown-item" href="?DuplicarItem=<?= $dados['id']; ?>"><i class="text-primary icon icon-clone"></i> Duplicar</a>
													<?php } ?>
													<?php if ($dados['id'] != 0) { ?>
														<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'deletar')) { ?>
															<a class="dropdown-item" onclick="DeletarItem(<?= $dados['id']; ?>, 'DeletarItem');" href="#!"><i class="text-danger icon icon-remove"></i> Excluir</a>
														<?php } ?>
													<?php } ?>
												</div>
											</div>
										</td>
									</tr>
								<?php }
							} else { ?>
								<div class="card-body">
									<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) { ?>
										<div class="alert alert-info">Nenhum item adicionado até o momento, <a href="?AdicionarItem=<?= $_GET['VisualizarCategoria']; ?>">clique aqui</a> para adicionar.</div>
									<?php } ?>
								</div>
							<?php } ?>
						</table>
					</div>					
				</div>
			</div>
		<?php } else { ?>
			<div class="card">
				<div class="card-header  white">
					<strong>Listagens</strong>
				</div>

				<div class="card-body p-0">
				
					<div class="table-responsive" style="overflow-x: visible !important">
						<table id="DataTable" class="table m-0 table-striped">
							<?php 
							$Query = DBRead('c_slide_produtos', '*');
								if (is_array($Query)) { 
							?>
							<tr>
								<th>ID</th>
								<th>Titulo</th>
								<th>Itens</th>
								<th>Implementação</th>
								<th width="53px">Ações</th>
							</tr>


							<?php 
								foreach ($Query as $dados) { 							
								
									 $CodSite  ='<iframe onload="Sframe(this)" id="Sframe" src="' . RemoveHttpS(ConfigPainel('base_url')) . 'wa/slide_produtos/?id='.$dados['id'].'" ></iframe>';
		
									?>
									<tr>
										<td><?= $dados['id']; ?></td>
										<td><?= $dados['categoria']; ?></td>
										<td>
											<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) { ?>
												<a class="tooltips" data-tooltip="Adicionar" href="?AdicionarItem=<?php echo $dados['id']; ?>">
													<i class="icon-plus blue lighten-2 avatar"></i>
												</a>
											<?php } ?>

											<a class="tooltips" data-tooltip="Visualizar" href="?VisualizarCategoria=<?php echo $dados['id']; ?>">
												<i class="icon-eye blue lighten-2 avatar"></i>
											</a>
										</td>
										<td>
											<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'codigo', 'acessar')) { ?>
												<button id="btnCopiarCodSite<?= $dados['id']; ?>" class="btn btn-primary btn-xs" onclick="CopiadoCodSite(<?= $dados['id']; ?>)" data-clipboard-text='<?= $CodSite; ?>'>
													<i class="icon icon-code"></i> Copiar Cód. do Site
												</button>
											<?php } ?>
										</td>
										<td>
											<div class="dropdown">
												<a class="" href="#" data-toggle="dropdown">
													<i class="icon-apps blue lighten-2 avatar"></i>
												</a>

												<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
													<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'editar')) { ?>
														<a class="dropdown-item" href="?EditarCategoria=<?= $dados['id']; ?>"><i class="text-primary icon icon-pencil"></i> Editar</a>
													<?php } ?>
													<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')) { ?>
														<a class="dropdown-item" href="?DuplicarCategoria=<?= $dados['id']; ?>"><i class="text-primary icon icon-clone"></i> Duplicar</a>
													<?php } ?>
													<?php if ($dados['id'] != 0) { ?>
														<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'deletar')) { ?>
															<a class="dropdown-item" onclick="DeletarItem(<?= $dados['id']; ?>, 'DeletarCategoria');" href="#!"><i class="text-danger icon icon-remove"></i> Excluir</a>
														<?php } ?>
													<?php } ?>
												</div>
											</div>
										</td>
									</tr>				
							<?php } }else{ ?>	
								<div class="card-body">
									<?php if (checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) { ?>
									<div class="alert alert-info">Nenhum item adicionado até o momento, <a href="?AdicionarCategoria">clique aqui</a> para adicionar.</div>
									<?php } ?>
								</div>
							<?php } ?>
						</table>
					</div>		
				</div>
			</div>
		<?php } ?>
	</div>

	<?php require_once('includes/footer.php'); ?>
	<script type="text/javascript" src="assets/plugins/iconpicker/bootstrap-iconpicker.bundle.min.js"></script>

	<div class="modal fade" id="Ajuda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content b-0">
				<div class="modal-header r-0 bg-primary">
					<h6 class="modal-title text-white" id="exampleModalLabel">Informações de Sobre o Módulo</h6>
					<a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
				</div>

				<div class="modal-body">
					<p>
						1- Recomendamos desativar efeitos parallax em páginas onde o módulo será integrado.<br>
					</p>
				</div>

				<div class="modal-footer">
					<center>
						<em>Obs.: As informações acima, não são BUGS e sim limitações que todo e qualquer sistema possui, portanto não será necessário reporta-los.</em>
					</center>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function CopiadoCodSiteWa4Full(id) {
			var clipboard = new Clipboard('#btnCopiarCodSiteWa4full' + id);
			clipboard.on('success', function(e) {
				document.getElementById('btnCopiarCodSiteWa4full' + id).innerHTML = 'Copiado!';
				document.getElementById("btnCopiarCodSiteWa4full" + id).disabled = true;
			});
		}

		$("[rel=tooltip]").tooltip({
			html: true,
			placement: 'right'
		});

		$('.target').iconpicker();
	</script>