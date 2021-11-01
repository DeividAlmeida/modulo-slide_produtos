<?php
error_reporting(0);
if (!$_SESSION['node']['id']) {
	die();
	exit();
}

if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'])) {
	Redireciona('./index.php');
}
// Save Item
if (isset($_GET['Atualizar']) || isset($_GET['Adicionar'])) {
	if (isset($_GET['Adicionar'])) {
		if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) {
			Redireciona('./index.php');
		}
	}

	if (isset($_GET['Atualizar'])) {
		if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'editar')) {
			Redireciona('./index.php');
		}
		$id = get('Atualizar');
	}
	$dataArray = array(
		'titulo' 		=> post('titulo'),
		'preco' 		=> post('preco'),
		'preco_c' 		=> post('preco_c'),
		'txt_botao' 	=> post('txt_botao'),
		'tipo' 			=> post('tipo'),
		'url' 			=> post('url'),
		'ordem' 		=> (!empty(post('ordem'))) ? post('ordem') : 1,
		'destino_url' 	=> post('destino_url'),
		'id_categoria' 	=> post('id_categoria')
	);

	if (isset($_FILES['imagem']) && !empty($_FILES['imagem']['name'])) {
		require_once 'database/upload.class.php';
		$dir_dest = 'wa/slide_produtos/uploads/';
		$files = array();
		$file = $_FILES['imagem'];
		$handle = new Upload($file);
		if ($handle->uploaded) {
			$handle->file_new_name_body = md5(uniqid($file['name']));
			$handle->Process($dir_dest);
			if ($handle->processed) {
				$file_dst_name = $handle->file_dst_name;
				$Imagem = $handle->file_dst_name;
				$dataArray['imagem'] = $Imagem;
			}
		}
	}

	if (isset($_GET['Adicionar'])) {
		$Query = DBCreate('slide_produtos', $dataArray);
	}

	if (isset($_GET['Atualizar'])) {
		$Query = DBUpdate('slide_produtos', $dataArray, "id = '{$id}'");
	}

	if ($Query != 0) {
		$id_categoria = post('id_categoria');
		Redireciona("?VisualizarCategoria={$id_categoria}&sucesso");
	} else {
		Redireciona('?VisualizarCategoria={$id_categoria}&erro');
	}
}

if (isset($_GET['DuplicarItem'])) {
	if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) {
		Redireciona('./index.php');
	}

	$id = get('DuplicarItem');

	$Query = DBRead('slide_produtos', '*', "WHERE id = '{$id}' LIMIT 1");
	$Query = $Query[0];
	unset($Query['id']);

	$Query = DBCreate('slide_produtos', $Query, true);

	if ($Query != 0) {
		Redireciona('?EditarItem=' . $Query . '&sucesso');
	} else {
		Redireciona('?erro');
	}
}


// Excluir Item
if (isset($_GET['DeletarItem'])) {
	if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'deletar')) {
		Redireciona('./index.php');
	}

	$id = get('DeletarItem');

	$deleteImage = DBRead('slide_produtos', '*', "WHERE id = '{$id}'");
	if (!empty($deleteImage)) {
		@unlink(__DIR__ . "/../wa/slide_produtos/uploads/{$deleteImage[0]['imagem']}");
	}

	$Query = DBDelete('slide_produtos', "id = '{$id}'");

	if ($Query != 0) {
		Redireciona('?sucesso');
	} else {
		Redireciona('?erro');
	}
}
// Save Categoria
if (isset($_GET['AddCategoria']) || isset($_GET['AtualizarCategoria'])) {
	if (isset($_GET['AddCategoria'])) {
		if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'adicionar')) {
			Redireciona('./index.php');
		}
	}

	if (isset($_GET['AtualizarCategoria'])) {
		if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'editar')) {
			Redireciona('./index.php');
		}
		$id = get('AtualizarCategoria');
	}

	$dataArray = array(
		'categoria' 		=> post('categoria'),

		'cor_bg' 	    	=> post('cor_bg'),
		'cor_bg_hover' 		=> post('cor_bg_hover'),

		'cor_btn' 	    	=> post('cor_btn'),
		'cor_btn_hover' 	=> post('cor_btn_hover'),

		'cor_btn_txt' 	    => post('cor_btn_txt'),
		'cor_btn_txt_hover' => post('cor_btn_txt_hover'),

		'cor_titulo' 	    => post('cor_titulo'),

		'cor_icone' 	    => post('cor_icone'),
		'cor_icone_hover' 	=> post('cor_icone_hover'),

		'seconds' 			=> post('seconds') ,

		'size_title' 	    => post('size_title'),
		'weight_title' 	    => post('weight_title'),

		'size_desc' 	    => post('size_desc'),
		'weight_desc' 	    => post('weight_desc'),
	);

	if (!empty(post('font_title'))) {
		$dataArray['font_title'] = post('font_title');
	}

	if (!empty(post('font_desc'))) {
		$dataArray['font_desc'] = post('font_desc');
	}

	if (isset($_GET['AddCategoria'])) {
		$Query = DBCreate('c_slide_produtos', $dataArray);
	}

	if (isset($_GET['AtualizarCategoria'])) {
		$Query = DBUpdate('c_slide_produtos', $dataArray, "id = '{$id}'");
	}

	if ($Query != 0) {
		Redireciona('?sucesso');
	} else {
		Redireciona('?erro');
	}
}

if (isset($_GET['DuplicarCategoria'])) {
	if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'item', 'adicionar')) {
		Redireciona('./index.php');
	}

	$id = get('DuplicarCategoria');

	$Query = DBRead('c_slide_produtos', '*', "WHERE id = '{$id}' LIMIT 1");
	$Query = $Query[0];
	unset($Query['id']);

	$Query = DBCreate('c_slide_produtos', $Query, true);

	if ($Query != 0) {
		Redireciona('?EditarCategoria=' . $Query . '&sucesso');
	} else {
		Redireciona('?erro');
	}
}

// Excluir Categoria
if (isset($_GET['DeletarCategoria'])) {
	if (!checkPermission($PERMISSION, $_SERVER['SCRIPT_NAME'], 'categoria', 'deletar')) {
		Redireciona('./index.php');
	}

	$id = get('DeletarCategoria');
	$Query = DBDelete('c_slide_produtos', "id = '{$id}'");
	if ($Query != 0) {
		Redireciona('?sucesso');
	} else {
		Redireciona('?erro');
	}
}
