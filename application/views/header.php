<?php ini_set('error_reporting','E_ALL & ^E_NOTICE');  ?>
<html>
<head>
	<title>Jump Orçamentos</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>"/>
    <meta charset="UTF-8">
    <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.mask.min.js'); ?>" type="text/javascript"></script>
</head>
<body>
	<div class="header">
		<div class="logo">
			<img src="<?php echo base_url('assets/imgs/logo.png'); ?>">
		</div>
		<span class="spTitulo"><?php echo $titulo; ?></span>
		<div class="j">
			<img src="<?php echo base_url('assets/imgs/j.png'); ?>">
		</div>
	</div>

	<?php if( $this->session->userdata('user_logged')){ ?>
	<div class="logoff">
		Bem vindo <label class="lbl_usuario_nome"><?php echo $this->session->userdata('user_nome'); ?></label>.
		<a href="<?php echo base_url('/login/logoff'); ?>">Sair</a>
	</div>
	<?php } ?>

	<div class="borderBottomHeader">&nbsp</div>
	<div class="content">