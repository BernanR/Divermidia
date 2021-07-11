
DROP DATABASE IF EXISTS `divermidia_db`;
CREATE DATABASE IF NOT EXISTS `divermidia_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `divermidia_db`;

DROP TABLE IF EXISTS `captcha`;
CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned  NULL,
  `ip_address` varchar(45)  NULL,
  `word` varchar(20)  NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB AUTO_INCREMENT=2638 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT 0,
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `type` tinyint(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `json` mediumtext DEFAULT NULL,
  `created_dt` datetime NOT NULL,
  `carousel` tinyint(11) DEFAULT 0,
  `lightbox` tinyint(11) DEFAULT 0,
  `updated_dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` (`id`, `title`, `type`, `description`, `json`, `created_dt`, `carousel`, `lightbox`, `updated_dt`, `created_by`, `updated_by`, `deleted`) VALUES
	(1, 'Marcas', 1, 'Marcas', '[{"file":"1607654171.jpg","title":"LBS","ordem":"5"},{"file":"16076541711.jpg","title":"Brasilia","ordem":"2"},{"file":"16076541712.jpg","title":"Casa do p\\u00e3o de queijo","ordem":"3"},{"file":"1607820068.jpg","title":"Dom Camilo","ordem":"1"},{"file":"16078200681.jpg","title":"Mina Montagens","ordem":"4"},{"file":"16078200682.jpg","title":"NETPARK","ordem":"6"},{"file":"1608452289.jpg","title":"","key":"1608452289"},{"file":"1608452497.jpg","title":"","key":"1608452497"},{"file":"1608452519.jpg","title":"","key":"1608452519"}]', '2020-12-11 03:31:03', 0, 0, '2021-07-09 20:58:59', 0, 0, 1),
	(2, 'E social', 1, 'E social', '[{"file":"1607809897.jpg","title":""},{"file":"1607809898.jpg","title":""},{"file":"16078098981.jpg","title":""},{"file":"16078098982.jpg","title":""},{"file":"1607809917.jpg","title":""}]', '2020-12-12 22:44:35', 1, 0, '2021-07-09 20:59:02', 0, 0, 1),
	(3, 'Sobre nÃ³s', 1, 'Sobre nÃ³s', '[{"file":"1608450305.jpg","title":"teste","key":"1608450305","ordem":""},{"file":"1608450316.jpg","title":"","key":"1608450316","ordem":""},{"file":"16084503161.jpg","title":"","key":"16084503161","ordem":""},{"file":"16084503162.jpg","title":"","key":"16084503162","ordem":""},{"file":"16084503163.jpg","title":"","key":"16084503163","ordem":""}]', '2020-12-20 08:44:55', 1, 1, '2021-07-09 20:59:14', 0, 0, 1),
	(4, 'Videos Home', 2, 'Videos Home', '[{"key":"1608774773","title":"Teste","url":"Hu85TqElSZk"},{"key":"1608774773","title":"Video 2","url":"3ZJBcj5ZNLE"},{"key":"1608774773","title":"Video 4","url":"SLD9xzJ4oeU"},{"key":"1608774773","title":"Video 5","url":"sWob27tij_w"},{"title":"video 6","url":"EnSVdbLMRNI","key":1608774858}]', '2020-12-24 02:11:41', 0, 0, '2021-07-09 20:59:12', 0, 0, 1);
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` char(5) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `file` varchar(50) DEFAULT NULL,
  `path` varchar(50) NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  `created_dt` datetime NOT NULL,
  `updated_dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` (`id`, `key`, `title`, `file`, `path`, `note`, `created_dt`, `updated_dt`, `created_by`, `updated_by`, `deleted`) VALUES
	(1, 'upld_', 'Sem TÃ­tulo-2.jpg', '1607822264.jpg', './assets/uploads', NULL, '2020-12-13 02:17:44', '2020-12-12 22:17:44', 88, 88, 0),
	(2, 'upld_', 'Sem TÃ­tulo-1.jpg', '16078222642.jpg', './assets/uploads', NULL, '2020-12-13 02:17:44', '2020-12-12 22:17:44', 88, 88, 0),
	(3, 'upld_', 'Sem TÃ­tulo-1.jpg', '1608389879.jpg', './assets/uploads', NULL, '2020-12-19 15:58:02', '2020-12-19 11:58:02', 88, 88, 0),
	(4, 'upld_', 'sobre-nos.jpg', '1608389883.jpg', './assets/uploads', NULL, '2020-12-19 15:58:03', '2020-12-19 11:58:03', 88, 88, 0),
	(5, 'upld_', 'banner.jpg', '1608389884.jpg', './assets/uploads', NULL, '2020-12-19 15:58:04', '2020-12-19 11:58:04', 88, 88, 0),
	(6, 'upld_', 'Sem-TÃ­tulo-1.jpg', '1608389885.jpg', './assets/uploads', NULL, '2020-12-19 15:58:05', '2020-12-19 11:58:05', 88, 88, 0),
	(7, 'upld_', 'banner-mobi.jpg', '1608470940.jpg', './assets/uploads', NULL, '2020-12-20 14:29:00', '2020-12-20 10:29:00', 88, 88, 0),
	(8, 'upld_', 'Sem TÃ­tulo-8.jpg', '16084709402.jpg', './assets/uploads', NULL, '2020-12-20 14:29:00', '2020-12-20 10:29:00', 88, 88, 0),
	(9, 'upld_', 'desktop.jpg', '1608470941.jpg', './assets/uploads', NULL, '2020-12-20 14:29:01', '2020-12-20 10:29:01', 88, 88, 0),
	(10, 'upld_', 'Sem TÃ­tulo-7.jpg', '16084709412.jpg', './assets/uploads', NULL, '2020-12-20 14:29:01', '2020-12-20 10:29:01', 88, 88, 0);
/*!40000 ALTER TABLE `media` ENABLE KEYS */;

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `ordem` int(11) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `updated_dt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(5) NOT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_Menu_menu_id` (`menu_id`),
  CONSTRAINT `FK_Menu_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `name`, `ordem`, `slug`, `menu_id`, `page_id`, `url`, `created_dt`, `updated_dt`, `created_by`, `updated_by`, `deleted`) VALUES
	(1, 'Sobre NÃ³s', 1, 'sobre-nos', NULL, 3, NULL, '2020-11-16 15:15:58', '2021-07-05 21:27:11', 88, 88, 1),
	(2, 'ServiÃ§os', 2, 'servicos', NULL, NULL, NULL, '2020-11-16 15:15:58', '2021-07-05 21:27:09', 88, 88, 1),
	(3, 'E-Social', NULL, 'e-social', NULL, 1, '', '2020-11-16 15:15:58', '2021-07-05 21:27:02', 88, 88, 1),
	(4, 'Home', NULL, 'home', NULL, NULL, '', '2020-11-30 02:10:00', '2020-12-10 22:45:35', 88, 88, 1),
	(5, 'Medicina do trabalho', NULL, 'medicina-do-trabalho', 2, 2, '', '2020-11-30 02:38:40', '2021-07-05 21:27:00', 88, 88, 1),
	(6, 'SeguranÃ§a do trabalho', NULL, 'seguranca-do-trabalho', 2, 5, '', '2020-11-30 02:24:19', '2021-07-05 21:26:57', 88, 88, 1),
	(13, 'Exames', 3, 'exames', NULL, NULL, '', '2020-12-24 21:36:31', '2021-07-05 21:27:08', 88, 88, 1),
	(15, 'Treinamentos', 4, 'treinamentos', NULL, NULL, '', '2020-12-24 21:32:26', '2021-07-05 21:27:06', 88, 88, 1),
	(16, 'Cursos', 5, 'cursos', NULL, NULL, '', '2020-12-24 21:37:02', '2021-07-05 21:27:04', 88, 88, 1);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `resume` varchar(500) DEFAULT NULL,
  `content` longtext NOT NULL,
  `files` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `banners` varchar(255) DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL,
  `created_dt` datetime NOT NULL,
  `display_brands` tinyint(1) DEFAULT 0,
  `gallery_id` int(11) DEFAULT NULL,
  `updated_dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_Pages_menu` (`menu_id`),
  CONSTRAINT `FK_Pages_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `title`, `slug`, `menu_id`, `keywords`, `resume`, `content`, `files`, `banners`, `order`, `created_dt`, `display_brands`, `gallery_id`, `updated_dt`, `created_by`, `updated_by`, `deleted`) VALUES
	(1, 'E-Social', 'e-social', 3, '', '', '<p><img alt="" longdesc="Teste Imagem aqui" src="http://localhost/righi-righi/assets/img/uploads/1605839702_726.jpg" style="float:left; height:202px; margin-left:0px; margin-right:20px; width:255px" />O eSocial (Sistema de Escritura&ccedil;&atilde;o Fiscal Digital das Obriga&ccedil;&otilde;es Fiscais, Previdenci&aacute;rias e Trabalhistas) &eacute; um projeto do Governo Federal, que pretende unificar o envio de informa&ccedil;&otilde;es pelo empregador em rela&ccedil;&atilde;o aos seus empregados , integrando as tr&ecirc;s esferas do Governo.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>No sistema estar&aacute; centralizada a entrega de todas as declara&ccedil;&otilde;es, resumos para recolhimento de tributos oriundos da rela&ccedil;&atilde;o trabalhista e previdenci&aacute;ria, bem como informa&ccedil;&otilde;es relevantes acerca do contrato de trabalho, al&eacute;m de inserir informa&ccedil;&otilde;es referentes &agrave; sa&uacute;de e seguran&ccedil;a do trabalhador.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>O que muda com o eSOCIAL?</h2>\r\n\r\n<p><img alt="" src="http://localhost/righi-righi/assets/img/uploads/1605839902_775.jpg" style="float:left; height:434px; margin-bottom:20px; margin-lef:0; margin-right:20px; width:450px" />O que muda com o eSocial?<br />\r\nAl&eacute;m das informa&ccedil;&otilde;es &agrave;s quais os profissionais de RH j&aacute; tem familiaridade, alguns outros conceitos dever&atilde;o ser introduzidos na rotina di&aacute;ria destes profissionais, que antes ficavam centralizadas apenas nas &aacute;reas de Seguran&ccedil;a e Medicina do Trabalho, se existentes na empresa, como descritos abaixo:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Exposi&ccedil;&atilde;o a fatores de riscos e medidas de controle: passa a ser obrigat&oacute;rio o registro das condi&ccedil;&otilde;es de trabalho do empregado, indicando a presta&ccedil;&atilde;o de servi&ccedil;os em condi&ccedil;&otilde;es insalubres e/ou perigosas, al&eacute;m da descri&ccedil;&atilde;o da exposi&ccedil;&atilde;o a fatores de riscos e respectivas medidas de controle.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Mas onde buscar essas informa&ccedil;&otilde;es? Embora obrigat&oacute;rio pelo Minist&eacute;rio do Trabalho, atrav&eacute;s da Norma Regulamentadora de n&deg; 09, nem todas as empresas mant&eacute;m atualizado o PPRA &ndash; Programa de Preven&ccedil;&atilde;o de Riscos Ambientais, onde as informa&ccedil;&otilde;es dos riscos envolvidos na atividade do funcion&aacute;rio e as medidas de controle est&atilde;o lan&ccedil;adas.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Faz-se ainda necess&aacute;rio que, empresas cujos funcion&aacute;rios exer&ccedil;am atividades insalubres ou perigosas, mantenham em arquivo o Laudo de Insalubridade ou Periculosidade, emitido por Engenheiro em Seguran&ccedil;a do trabalho, registrando os riscos e percentuais a serem pagos aos trabalhadores.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ASO &ndash; Atestado de Sa&uacute;de Ocupacional / PCMSO: Todo empregado deve submeter-se aos exames m&eacute;dicos ocupacionais, sendo estes obrigat&oacute;rios na admiss&atilde;o, na demiss&atilde;o e periodicamente no curso do v&iacute;nculo empregat&iacute;cio.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A admiss&atilde;o e demiss&atilde;o do funcion&aacute;rio somente conseguir&aacute; ser registrada no sistema com o lan&ccedil;amento dos dados do ASO do funcion&aacute;rio. Os exames peri&oacute;dicos, de retorno ao trabalho, de mudan&ccedil;a de fun&ccedil;&atilde;o e de monitora&ccedil;&atilde;o pontual dever&atilde;o ser cadastrados pontualmente, quando da sua realiza&ccedil;&atilde;o, havendo um layout do sistema especifico para estes eventos. Al&eacute;m dessas informa&ccedil;&otilde;es, passa a ser obrigat&oacute;rio o lan&ccedil;amento do respons&aacute;vel pela monitora&ccedil;&atilde;o Biol&oacute;gica da empresa &ndash; M&eacute;dico Coordenador do PCMSO &ndash; Programa de Controle M&eacute;dico de Sa&uacute;de Ocupacional. Desta forma, todas as empresas dever&atilde;o se regularizar no tocante a documenta&ccedil;&atilde;o exigida pelo MTE em Medicina e Seguran&ccedil;a do Trabalho.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="" src="http://localhost/righi-righi/assets/img/uploads/1605840108_822.jpg" style="float:left; height:195px; margin-bottom:50px; width:400px" />A Righi Righi Assessoria, especializada em Servi&ccedil;os de Medicina e Seguran&ccedil;a do Trabalho est&aacute; estabelecida h&aacute; mais de 28 anos e conta com reconhecimento de mercado pela qualidade de seus servi&ccedil;os, mantendo um portf&oacute;lio de clientes com empresas de diversos segmentos, oferecendo um relacionamento pautado na transpar&ecirc;ncia, &eacute;tica, agilidade e profissionalismo. Contamos com um quadro profissional altamente capacitado, o que nos permite fornecer solu&ccedil;&otilde;es completas em Medicina e Seguran&ccedil;a do Trabalho.</p>\r\n\r\n<p>Nosso Departamento Comercial fornece um atendimento t&eacute;cnico desde o primeiro contato, dando ao cliente um diagn&oacute;stico inicial das necessidades da empresa, sempre com embasamento na Legisla&ccedil;&atilde;o do Minist&eacute;rio do Trabalho.</p>\r\n\r\n<p><strong><span style="color:#000000">Contate-nos e verifique como realizar a adequa&ccedil;&atilde;o de sua empresa &agrave;s Normativas do MTE.</span></strong></p>\r\n\r\n<p>&nbsp;</p>', NULL, '{"desktop":"upload_desktop_banner-1605840162.jpg","mobile":"upload_desktop_banner-16058401621.jpg"}', NULL, '2020-12-13 01:08:46', 1, NULL, '2021-07-09 20:59:02', 88, 88, 1),
	(2, 'Medicina do trabalho', 'medicina-do-trabalho', 5, '', '', '<p><img alt="" src="http://localhost/righi-righi/assets/img/uploads/16078222643.jpg" style="float:left" /><img alt="" src="http://localhost/righi-righi/./assets/uploads/16078222642.jpg" style="float:left; height:411px; margin-left:20px; margin-right:20px; width:500px" />A Medicina do Trabalho &eacute; a especialidade m&eacute;dica que lida com as rela&ccedil;&otilde;es entre homens e mulheres trabalhadores e seu trabalho, visando n&atilde;o somente a preven&ccedil;&atilde;o dos acidentes e das doen&ccedil;as do trabalho, mas a promo&ccedil;&atilde;o da sa&uacute;de e da qualidade de vida.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tem por objetivo assegurar ou facilitar aos indiv&iacute;duos e ao coletivo de trabalhadores a melhoria cont&iacute;nua das condi&ccedil;&otilde;es de sa&uacute;de, nas dimens&otilde;es f&iacute;sica e mental, e a intera&ccedil;&atilde;o saud&aacute;vel entre as pessoas e, estas, com seu ambiente social e o trabalho.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>O m&eacute;dico do trabalho avalia a capacidade do candidato a determinado trabalho e realiza reavalia&ccedil;&otilde;es peri&oacute;dicas de sua sa&uacute;de dando &ecirc;nfase aos riscos ocupacionais aos quais este trabalhador fica exposto.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A Medicina do Trabalho est&aacute; constru&iacute;da sobre dois pilares: a Cl&iacute;nica e a Sa&uacute;de P&uacute;blica. Sua a&ccedil;&atilde;o est&aacute; orientada para a preven&ccedil;&atilde;o e a assist&ecirc;ncia do trabalhador v&iacute;tima de acidente, doen&ccedil;a ou de incapacidade relacionados ao trabalho e, tamb&eacute;m, para a promo&ccedil;&atilde;o da sa&uacute;de, do bem estar e da produtividade dos trabalhadores, suas fam&iacute;lias e a comunidade.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A ci&ecirc;ncia que estuda os acidentes e as doen&ccedil;as do trabalho e chamada de infortun&iacute;stica.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="" src="http://localhost/righi-righi/./assets/uploads/1607822264.jpg" style="width:100%" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A Righi Righi &eacute; uma Empresa especializada em presta&ccedil;&atilde;o de servi&ccedil;os de Medicina do Trabalho e Engenharia de Seguran&ccedil;a do Trabalho. Com mais de 20 anos de know-how assessorando mensalmente Empresas de diversos ramos em S&atilde;o Paulo e Grande S&atilde;o Paulo.</p>\r\n\r\n<p>Somos especializados em: PCMSO &ndash; PPRA &ndash; CIPA &ndash; PCMAT &ndash; LTCAT &ndash; SIPAT &ndash; PCA &ndash; PPP &ndash; Treinamentos &ndash; Laudos &ndash; An&aacute;lise &ndash; Assessoria em medicina do trabalho &ndash; Assessoria em Seguran&ccedil;a do Trabalho.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Hoje contamos com uma equipe m&eacute;dica t&eacute;cnica e engenheiros em seguran&ccedil;a do trabalho para que sua Empresa tenha o melhor atendimento e satisfa&ccedil;&atilde;o.</strong></p>\r\n\r\n<h4><span style="font-size:18px">Seguran&ccedil;a do Trabalho &bull; Medicina do Trabalho &bull; An&aacute;lises &bull; Laudos &bull; Treinamentos &bull; Audiometria CIPA &bull; PCMAT&bull; LTCAT &bull; PCA &bull; PCMSO &bull; PPP &bull; PPRA &bull; SIPAT</span></h4>', NULL, '{"desktop":"upload_desktop_banner-1607823890-1607823890.jpg","mobile":"upload_mobile_banner-1607891661-1607891661.jpg"}', NULL, '2020-12-13 21:38:19', 1, 0, '2021-07-05 21:26:46', 88, 88, 1),
	(3, 'Sobre nÃ³s', 'sobre-nos', NULL, '', 'A Righi & Righi, Ã© uma empresa especializada nÃ£o sÃ³ em prestaÃ§Ã£o de serviÃ§os de qualidade, mas tambÃ©m em ASSESSORIA as Empresas, dentro das normas legais, em MEDICINA e SEGURANÃ‡A DO TRABALHO.', '<p><img alt="" src="http://localhost/righi-righi/./assets/uploads/1608389883.jpg" style="float:left; margin-left:25px; margin-right:25px; width:46%" />A Righi &amp; Righi, &eacute; uma empresa especializada n&atilde;o s&oacute; em presta&ccedil;&atilde;o de servi&ccedil;os de qualidade, mas tamb&eacute;m em ASSESSORIA as Empresas, dentro das normas legais, em MEDICINA e SEGURAN&Ccedil;A DO TRABALHO.<br />\r\nGra&ccedil;as a sua presta&ccedil;&atilde;o de servi&ccedil;o integra, atuando dentro do determinado pelo Minist&eacute;rio do Trabalho e Emprego, cumprindo as Instru&ccedil;&otilde;es Normativas, se mant&eacute;m no mercado h&aacute; mais de 28 (vinte e oito) anos.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Como assessoria, controlamos os vencimentos dos exames cl&iacute;nicos e complementares, assim como os Programas e Laudos de Seguran&ccedil;a do Trabalho, al&eacute;m de orientar os clientes quanto as Normas Regulamentadoras, a necessidade da implanta&ccedil;&atilde;o, quando necess&aacute;ria na empresa, tudo de forma legal e transparente, visando sempre &agrave; credibilidade e confian&ccedil;a de nossos clientes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>E este trabalho, que dia ap&oacute;s dia vem sendo aprimorado, e com o aumento de procura de clientes que buscam uma assessoria de qualidade, a Righi &amp; Righi esta com nova sede, localizada estrategicamente, com f&aacute;cil acesso, no CENTRO DE S&Atilde;O PAULO.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Nossa Empresa</strong><br />\r\nNossa sede &eacute; constitu&iacute;da: &ndash; Pr&eacute;dio exclusivo para a Righi &amp; Righi de 10 (dez) andares &ndash; 02 (dois) elevadores &ndash; Ampla recep&ccedil;&atilde;o &ndash; Salas de espera confort&aacute;veis &ndash; 05 (cinco) consult&oacute;rios m&eacute;dicos &ndash; 03 (tr&ecirc;s) salas de audiometria &ndash; Andar exclusivo para Raio X do T&oacute;rax &ndash; Sala para realiza&ccedil;&atilde;o de eletrocardiograma<br />\r\nMatriz</p>\r\n\r\n<p><img alt="" src="http://localhost/righi-righi/./assets/uploads/1608389885.jpg" style="float:right; margin-bottom:25px; margin-top:25px; width:574px" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h2>Estrutura</h2>\r\n\r\n<p>Assegurando a qualidade de nossos servi&ccedil;os, contamos com uma equipe m&eacute;dica capacitada, com experi&ecirc;ncia, al&eacute;m do m&eacute;dico coordenador com anos de atua&ccedil;&atilde;o na &aacute;rea.<br />\r\nS&atilde;o 05 consult&oacute;rios m&eacute;dicos e &nbsp;03 salas de Audiometria</p>\r\n\r\n<p><br />\r\nAuxiliando os m&eacute;dicos examinadores, temos a equipe de T&eacute;cnicos de Enfermagem, com experi&ecirc;ncia em orienta&ccedil;&atilde;o dos exames complementares e na rotina di&aacute;ria dos exames cl&iacute;nicos, sempre direcionado a fun&ccedil;&atilde;o que o funcion&aacute;rio desempenha ou desempenhar&aacute; na empresa.</p>\r\n\r\n<p><br />\r\nOs T&eacute;cnicos de Raio X, todos devidamente habilitados sob a supervis&atilde;o do medico coordenador e do respons&aacute;vel t&eacute;cnico realizam este exame.</p>\r\n\r\n<p>Temos um andar exclusivo para Raio X do T&oacute;rax</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt="" src="http://localhost/righi-righi/./assets/uploads/1608389879.jpg" style="float:left; height:301px; margin-left:25px; margin-right:25px; width:350px" />Disponibilizamos atendimento tanto em nossa sede, como no pr&oacute;prio local de trabalho de acordo com as necessidades da empresa.</strong></p>\r\n\r\n<p><br />\r\nPara isso, contamos com unidade m&oacute;vel, que alem de realizarmos os exames cl&iacute;nicos, realizamos tamb&eacute;m audiometria, teste de acuidade visual e Eletrocardiograma;<br />\r\nTodos os nossos ve&iacute;culos s&atilde;o identificados, assim como nossos funcion&aacute;rios.</p>\r\n\r\n<p><br />\r\nAlem de Treinamentos, tamb&eacute;m dispomos de assistentes t&eacute;cnicos para Per&iacute;cias Judiciais, medicas e de engenharia (periculosidade; insalubridade).</p>\r\n\r\n<p><br />\r\nPara isso, contamos com Engenheiros que supervisionam a equipe de T&eacute;cnicos de Seguran&ccedil;a do Trabalho, todos devidamente habilitados.</p>\r\n\r\n<p><br />\r\nPara qualquer tipo de servi&ccedil;o, OCORRE A VISTORIA NO LOCAL, bem como possu&iacute;mos todos os aparelhos necess&aacute;rios &agrave; realiza&ccedil;&atilde;o dos servi&ccedil;os, sendo este todos com a calibra&ccedil;&atilde;o exigida.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="" src="http://localhost/righi-righi/./assets/uploads/1608389884.jpg" style="width:100%" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Proporcionamos aos nossos clientes, ampla assist&ecirc;ncia na execu&ccedil;&atilde;o das 32 Normas Regulamentadoras, do Minist&eacute;rio do Trabalho e Emprego &ndash; MTE, Lei 6.514 /77 e Portaria 3214/78.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Somos uma Empresa s&eacute;ria de renome, prova disso &eacute; o nosso respaldo dentro da Legisla&ccedil;&atilde;o vigente, possu&iacute;mos registro junto ao CREMESP (Conselho Regional Medicina do Estado de S&atilde;o Paulo), CREASP (Conselho Regional de Engenharia, Arquitetura e Agronomia do Estado de S&atilde;o Paulo), VIGIL&Acirc;NCIA SANIT&Aacute;RIA &ndash; COVISA (Coordena&ccedil;&atilde;o de Vigil&acirc;ncia e Sa&uacute;de). Portanto, tais registros nos &oacute;rg&atilde;os competentes demonstram nossa excel&ecirc;ncia na Presta&ccedil;&atilde;o de Servi&ccedil;os, uma vez que cada &oacute;rg&atilde;o, possui crit&eacute;rio avaliativo pr&oacute;prio, caso a Empresa seja considerada em n&atilde;o conformidade, os registros citados n&atilde;o s&atilde;o emitidos ou renovados.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A nossa maior preocupa&ccedil;&atilde;o, &eacute; estarmos sempre prontos para assessorarmos nossos clientes, com o cumprimento das determina&ccedil;&otilde;es da fiscaliza&ccedil;&atilde;o e demais &oacute;rg&atilde;os. Minimizando as possibilidades de arcarem com pesadas multas e reclama&ccedil;&otilde;es trabalhistas.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', NULL, '{"desktop":"upload_desktop_banner-1608390591-1608390591.jpg","mobile":"upload_desktop_banner-1608390591-16083905911.jpg"}', NULL, '2020-12-20 08:46:01', 0, NULL, '2021-07-09 20:59:14', 88, 88, 1),
	(4, 'Home', 'home', NULL, '', '', '<h3>&quot;H&Aacute; 28 ANOS ESTAMOS ENTRE AS CONTRATA&Ccedil;&Otilde;ES DE PROFISSIONAIS DO MERCADO DE TRABALHO,</h3>\r\n\r\n<h6>PRESTANDO SERVI&Ccedil;OS DE QUALIDADE E ASSESSORIA EM MEDICINA E SEGURAN&Ccedil;A NO TRABALHO, ATENDENDO EM TODO O BRASIL&quot;</h6>', NULL, '{"desktop":"","mobile":""}', NULL, '2020-12-20 10:01:17', 0, 0, '2020-12-20 06:01:17', 88, 88, 0),
	(5, 'SeguranÃ§a do Trabalho', 'seguranca-do-trabalho', NULL, '', 'SeguranÃ§a do trabalho (ou tambÃ©m denominado seguranÃ§a ocupacional) Ã© um conjunto de ciÃªncias e tecnologias que tem o objetivo de promover a proteÃ§Ã£o do trabalhador no seu local de trabalho, visando a reduÃ§Ã£o de acidentes de trabalho e doenÃ§as ocupacionais.\r\n', '<p><img alt="" src="http://localhost/righi-righi/./assets/uploads/16084709412.jpg" style="float:right; height:193px; width:200px" />Seguran&ccedil;a do trabalho (ou tamb&eacute;m denominado seguran&ccedil;a ocupacional) &eacute; um conjunto de ci&ecirc;ncias e tecnologias que tem o objetivo de promover a prote&ccedil;&atilde;o do <img alt="" src="http://localhost/righi-righi/assets/img/uploads/16084709413.jpg" style="float:right" />trabalhador no seu local de trabalho, visando a redu&ccedil;&atilde;o de acidentes de trabalho e doen&ccedil;as ocupacionais.<img alt="" src="http://localhost/righi-righi/assets/img/uploads/16084709413.jpg" style="float:right" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&Eacute; uma das &aacute;reas da seguran&ccedil;a e sa&uacute;de ocupacionais, cujo objetivo &eacute; identificar, avaliar e controlar situa&ccedil;&otilde;es de risco, proporcionando um ambiente de trabalho mais seguro e saud&aacute;vel para as pessoas.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Destacam-se entre as principais atividades da seguran&ccedil;a do trabalho:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="" src="http://localhost/righi-righi/./assets/uploads/16084709402.jpg" style="float:left; height:325px; margin:25px; width:580px" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Destacam-se entre as principais atividades da seguran&ccedil;a do trabalho:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>&bull; Preven&ccedil;&atilde;o de acidentes </strong></p>\r\n\r\n<p><strong>&bull; Promo&ccedil;&atilde;o da sa&uacute;de </strong></p>\r\n\r\n<p><strong>&bull; Preven&ccedil;&atilde;o de inc&ecirc;ndios </strong></p>\r\n\r\n<p><strong>&bull; Higiene do trabalho</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Brasil</strong></p>\r\n\r\n<p>No Brasil, a seguran&ccedil;a e sa&uacute;de ocupacionais s&atilde;o regulamentadas na forma do Servi&ccedil;o Especializado em Engenharia de Seguran&ccedil;a e em Medicina do Trabalho (SESMT). Este servi&ccedil;o est&aacute; previsto na legisla&ccedil;&atilde;o trabalhista brasileira e regulamentado pela portaria n&ordm; 3.214 de 08 de junho de 1978, considerando o disposto no art. 200, da consolida&ccedil;&atilde;o das Leis do Trabalho, com reda&ccedil;&atilde;o dada pela Lei n.&ordm; 6.514, de 22 de dezembro de 1977 do Minist&eacute;rio do Trabalho e Emprego, por interm&eacute;dio da Norma Regulamentadora n&ordm; 4 (NR-4),[1] e as normas da ABNT referentes seguran&ccedil;a no trabalho. &nbsp; &nbsp;</p>', NULL, '{"desktop":"upload_desktop_banner-1608470793-1608470793.jpg","mobile":"upload_desktop_banner-1608470793-16084707931.jpg"}', NULL, '2020-12-20 14:35:45', 1, 0, '2021-07-05 21:26:42', 88, 88, 1);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

DROP TABLE IF EXISTS `page_medias`;
CREATE TABLE IF NOT EXISTS `page_medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pages` (`page_id`) USING BTREE,
  KEY `FK_medias` (`media_id`) USING BTREE,
  CONSTRAINT `FK_Media_ID` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`),
  CONSTRAINT `FK_Page_ID` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `page_medias` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_medias` ENABLE KEYS */;

DROP TABLE IF EXISTS `page_menus`;
CREATE TABLE IF NOT EXISTS `page_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `menu_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `page_menus_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  CONSTRAINT `page_menus_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `page_menus` DISABLE KEYS */;
INSERT INTO `page_menus` (`id`, `page_id`, `menu_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 2, 3);
/*!40000 ALTER TABLE `page_menus` ENABLE KEYS */;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(50) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `note` varchar(600) DEFAULT NULL,
  `file` varchar(50) DEFAULT NULL,
  `created_dt` datetime NOT NULL,
  `updated_dt` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COMMENT='data settings for web site';

/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `key`, `value`, `note`, `file`, `created_dt`, `updated_dt`, `created_by`, `updated_by`) VALUES
	(1, 'site_title', 'Righi & Righi - Desenvolvendo ideias', '', NULL, '2020-07-30 01:30:00', '2020-12-13 00:08:12', 88, 88),
	(2, 'contact_email_top', 'contato@strutech.com.br', 'E-mail de contato no topo do site', NULL, '2020-07-30 01:42:15', '2020-07-30 01:42:15', 88, 88),
	(3, 'contact_phone_top', '+55 11 4309-0029 / +55 11 98812-1431', 'NÃºmero de contato no topo do site', NULL, '2020-07-30 02:15:05', '2020-09-01 07:38:27', 88, 88),
	(4, 'andress_company', 'Cond. Empresarial ACIBAM - R. Dr. Jales Martins Salgueiro, 241F - Lot. Industrial Coral, MauÃ¡ - SP, 09372-000', '', NULL, '2020-07-30 02:16:13', '2020-07-30 02:19:35', 88, 88),
	(5, 'send_mail_form_home', 'contato@strutech.com.br', 'Email de contado para o formulÃ¡rio da home', NULL, '2020-07-31 00:04:02', '2020-09-01 07:38:57', 88, 88),
	(6, 'send_mail_form_trabalhe_conosco', 'cgouvea@strutech.com.br', 'E-mail formulÃ¡rio pÃ¡gina trabalhe conosco', NULL, '2020-07-31 00:05:18', '2020-09-01 07:39:22', 88, 88),
	(7, 'send_mail_form_contato', 'contato@strutech.com.br', 'E-mail do formulÃ¡rio da pÃ¡gina contato', NULL, '2020-07-31 00:06:12', '2020-09-01 07:39:33', 88, 88),
	(8, 'send_mail_form_internas', 'texto@divermidia.com.br', 'E-mail do formulÃ¡rio das pÃ¡ginas internas', NULL, '2020-07-31 00:07:30', '2020-08-30 21:25:29', 88, 88),
	(9, 'send_mail_form_produtos', 'contato@strutech.com.br; vendas11@strutech.com.br', 'E-mail formulÃ¡rio carrinho pÃ¡gina de produto', NULL, '2020-07-31 00:09:49', '2020-09-01 07:40:07', 88, 88),
	(10, 'link_facebook', 'https://www.facebook.com/strutechautomacao/', 'Link da pÃ¡gina do facebook\r\n', NULL, '2020-07-31 00:10:58', '2020-07-31 00:10:58', 88, 88),
	(11, 'link_linkedin', 'https://www.linkedin.com/company/strutech-engenharia-ltda/', 'Link da pÃ¡gina do linkedin', NULL, '2020-07-31 00:12:15', '2020-07-31 00:12:15', 88, 88),
	(12, 'link_instagram', 'https://www.instagram.com/strutechautomacao', '', NULL, '2020-07-31 00:14:38', '2020-09-01 07:40:38', 88, 88),
	(14, 'whatsapp_number', '+5511988121431', '', NULL, '2020-08-28 21:40:57', '2020-09-01 07:42:04', 88, 88),
	(15, 'company_schedule', 'seg. Ã  sex. das 08H Ã s 17H', '', NULL, '2020-08-28 21:40:57', '2020-09-01 07:42:04', 88, 88),
	(16, 'link_yt', 'https://youtube.com', '', NULL, '2020-08-28 21:40:57', '2020-09-01 07:42:04', 88, 88);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

DROP TABLE IF EXISTS `uploads`;
CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `uploads` DISABLE KEYS */;
INSERT INTO `uploads` (`id`, `file`, `created_dt`, `created_by`) VALUES
	(44, '1605794260_611.jpg', '2020-11-19 14:57:40', 88),
	(45, '1605839702_726.jpg', '2020-11-20 03:35:03', 88),
	(46, '1605839902_775.jpg', '2020-11-20 03:38:22', 88),
	(47, '1605840108_822.jpg', '2020-11-20 03:41:48', 88),
	(48, '1605999820_568.jpg', '2020-11-22 00:03:41', 88),
	(49, '16076536241.jpg', '2020-12-11 03:27:04', 88),
	(50, '16078222641.jpg', '2020-12-13 02:17:44', 88),
	(51, '16078222643.jpg', '2020-12-13 02:17:44', 88),
	(52, '16083898791.jpg', '2020-12-19 15:58:02', 88),
	(53, '16083898831.jpg', '2020-12-19 15:58:03', 88),
	(54, '16083898841.jpg', '2020-12-19 15:58:04', 88),
	(55, '16083898851.jpg', '2020-12-19 15:58:05', 88),
	(56, '16084709401.jpg', '2020-12-20 14:29:00', 88),
	(57, '16084709403.jpg', '2020-12-20 14:29:00', 88),
	(58, '16084709411.jpg', '2020-12-20 14:29:01', 88),
	(59, '16084709413.jpg', '2020-12-20 14:29:01', 88);
/*!40000 ALTER TABLE `uploads` ENABLE KEYS */;

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nivel` enum('1','2') DEFAULT '2' COMMENT '1 - Administrador e 2 - UsuÃ¡rio',
  `dt_cadastro` datetime DEFAULT NULL,
  `dt_acesso` datetime DEFAULT NULL,
  `dt_alteracao` datetime DEFAULT NULL,
  `status` enum('1','2') DEFAULT '1' COMMENT '1 - ativo\\n2 - inativo\\n',
  PRIMARY KEY (`id`),
  KEY `INDEXES` (`nome`,`senha`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `email`, `senha`, `nivel`, `dt_cadastro`, `dt_acesso`, `dt_alteracao`, `status`) VALUES
	(88, 'Bernan', 'admin', 'alves.bernan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1', '2020-07-16 21:17:37', '2021-07-10 01:58:19', NULL, '1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
