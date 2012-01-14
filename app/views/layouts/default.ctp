<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php  echo $this -> Html -> charset();?>
		<title> Grafo - ¡Red Social de Investigadores! <?php  echo $title_for_layout;?></title>
		<?php
		echo $this -> Html -> meta('icon');
		echo $this -> Html -> css('grafo_web.css');
		?>
		<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
		<?php
		echo $scripts_for_layout;
		?>
	</head>
	<body>
		<div id="header-container">
			<div class="contenedor-contenido-bookmark-footer">
				<div class="contenedor-contenido-bookmark">
					<div class="contenedor-bookmark fl">
						<div class="bookmark">
							<?php echo $this->Html->link('Nodus', array("controller"=>"pages", "action"=>"index"), array("class"=>"grafo-logo")); ?>
							<div class="bookmark-logo <?php 	if(isset($posicionPaginasLogo)) { echo $posicionPaginasLogo; } else echo "bookmark-logo-normal"; ?>"></div>
							<h2 class="objetivo">Objetivo</h2>
							<div class="objetive-description"><?php echo $objetivosBookmark; ?></div>
						</div>
						<div class="cl"></div>
					</div>
					<div class="contenedor-contenido fl">
						<div class="user-box fr">
						<?php
							$usuario_id = $this->Session->read('Auth.Usuario.id');
							if(!isset($usuario_id)){
								echo $this->Form->create('Usuario', array('action' => 'login'));
								echo $this->Form->input('correo', array("label"=>"Correo",  "div"=>array("class" => "fl login-box-correo")));
								echo $this->Form->input('password', array("label"=>"Contraseña",  "div"=>array("class" => "fl login-box-password")));
								echo $this->Form->end(array("name"=>"Login", "label"=>"Login", "div"=>array("class" => "fl login-box-submit")));
							}else{
							?>
								<ul id="user-logged">
									<li><?php echo $this->Html->link($this->Session->read('Auth.Usuario.nombre_completo'), array("controller"=>"usuarios", "action"=>"edit"), array("class"=>"nombre-logeado")); ?></li>
									<li><?php echo $this->Html->link('Desconectarse', array("controller"=>"usuarios", "action"=>"logout"), array("class"=>"boton-logout")); ?></li>
								</ul>
							<?php
							}
						?>
						</div>
						<div class="cr"></div>
						<div class="content">
							<?php
								echo $this->Session->flash(); 
								echo $this->Session->flash('auth');
							?>
							
							<div class="content-layout">
								<div class="pages">
									<?php 
									if(isset($posicionPaginas)){
										echo $this->element('menu_datos', array("posicion" => $posicionPaginas));
									}
									?>
									<div class="<?php if(!isset($posicionInicio)) echo "pages-wrapper"; ?>">
										<?php echo $content_for_layout; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="cl"></div>
				</div>
				<div id="contendor-footer">
					<div class="footer-logos fr">
						<ul>
							<li>
								<?php  echo $this -> Html -> link('Conacyt', 'http://www.conacyt.mx/', array("class" => "footer-conacyt-logo"));?>
							</li>
							<li>
								<?php  echo $this -> Html -> link('Tec. Monterrey', 'http://www.ags.itesm.mx/', array("class" => "footer-texmonterrey-logo"));?>
							</li>
							<li>
								<?php echo $this -> Html -> link('Nodus', 'http://www.nodus.mx/', array("class" => "footer-nodus-logo"));?>
							</li>
						</ul>
					</div>
					<div class="cr"></div>
				</div>
			</div>
		</div>
	</body>
</html>