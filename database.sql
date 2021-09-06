SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET @@time_zone = `+03:00`;


INSERT INTO `modulos` (`nome`, `url`, `icone`, `status`, `ordem`, `tabela`, `cod_head`, `data_atualizacao`, `chave`, `acao`)
SELECT "Slide de Produtos", "slide_produtos.php", "icon-object-group", 1, 0, "slide_produtos", "slide_produtos/slide_produtos.js", "2019-12-16", "72b4b1d7ce2b514a981a49b1db5790a7","{\"item\":[\"adicionar\",\"editar\",\"deletar\"],\"categoria\":[\"adicionar\",\"editar\",\"deletar\"],\"codigo\":[\"acessar\"]}";

CREATE TABLE IF NOT EXISTS `slide_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `imagem` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text DEFAULT NULL,
  `txt_botao` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `destino_url` varchar(25) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `ordem` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `c_slide_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `categoria` varchar(255) DEFAULT NULL,
  `cor_bg` varchar(255) DEFAULT NULL,
  `cor_bg_hover` varchar(255) DEFAULT NULL,
  `cor_btn` varchar(255) DEFAULT NULL,
  `cor_btn_hover` varchar(255) DEFAULT NULL,
  `cor_btn_txt` varchar(255) DEFAULT NULL,
  `cor_btn_txt_hover` varchar(255) DEFAULT NULL,
  `cor_titulo` varchar(255) DEFAULT NULL,
  `cor_icone` varchar(255) DEFAULT NULL,
  `padding_y` int(11) DEFAULT NULL,
  `seconds` int(11) DEFAULT NULL,
  `size_title` int(11) DEFAULT NULL,
  `size_desc` int(11) DEFAULT NULL,
  `weight_title` varchar(255) DEFAULT NULL,
  `font_title` varchar(255) DEFAULT NULL,
  `weight_desc` varchar(255) DEFAULT NULL,
  `font_desc` varchar(255) DEFAULT NULL,
  `cor_icone_hover` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
