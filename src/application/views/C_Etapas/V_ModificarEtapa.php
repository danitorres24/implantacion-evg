<?php include_once('application/views/Plantilla/header.php'); ?>
<html>
	<head>
		<title>Modificar Etapa</title>
	</head>
	<body>
		<div id="principal" class="container-fluid animate__animated animate__fadeIn">
			<div class="row">
				<header class="col-12">
					<div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-6">
						<?php echo '<a href="'.base_url().'main"><img id="logo-evg" src="'.base_url().'uploads/iconos/evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<?php echo "<h3>Modificar Etapa - ".$this->datosEtapa[0]['nombre']."</h3>"; ?>
					</div>
					<div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-6">
						<?php echo "<button onclick=\"location.href ='" . base_url() . "main'\" id=\"icon-grid\" class=\"btn mr-2\" data-toggle=\"popover\" data-content=\"Grid Aplicaciones\"><i class=\"fas fa-th\"></i></button>"; ?>
						<?php
							$picture = $this -> session -> userdata('profile_pic');
							echo '<img id="profile_picture" src="'.$picture.'" alt="Google Profile Picture" class="img-fluid rounded-circle"/>';
						?>
						<?php echo "<button onclick=\"confirmar('¿Seguro que quieres cerrar sesión?','".base_url()."Auth/logout', 'Cerrar Sesión', 'Cancelar', 'Cerrar')\" data-toggle=\"modal\" data-target=\"#myModal\" id=\"icon-logout\" class=\"btn\"><i class=\"fa fa-sign-out-alt\"></i></button>" ;?>
					</div>
				</header>
			</div>
			<div class="row">
				<?php include_once('application/views/Plantilla/asideGestor.php') ?>
				<div class="general">
					<button type="button" id="sidebarCollapse" class="btn btn-sidebar">
						<i class="fas fa-bars" data-toggle="popover" data-content="Mostrar menú"></i>
						<i class="fas fa-times" data-toggle="popover" data-content="Ocultar menú"></i>
					</button>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "stages'\" class=\"btn btn-secondary\" data-toggle=\"popover\" data-content=\"Volver atrás\"><i class=\"fas fa-arrow-left\"></i></button>"; ?>
					<div class="gestion-apps animate__animated animate__zoomIn">
						<?php
							$codEtapa = array
							(
									'id'=>'codEtapa',
									'name'=>'codEtapa',
									'oninput'=>"buscarCSU('".base_url()."', 'Etapas', this.value, 'codEtapa', 'infoAjax', 'codEtapa', 'Ya existe otra etapa con el código ', '".$this->datosEtapa[0]['codEtapa']."')",
									'value' => $this->datosEtapa[0]['codEtapa'],
									'required'=>'required',
									'class'=>'form-control'
							);

							$nombre = array
							(
									'id'=>'nombre',
									'name'=>'nombre',
									'oninput'=>"buscarCSU('".base_url()."', 'Etapas', this.value, 'nombre', 'infoAjax2', 'nombre', 'Ya existe otra etapa con el nombre ', '".$this->datosEtapa[0]['nombre']."')",
									'value'=>$this->datosEtapa[0]['nombre'],
									'required'=>'required',
									'class'=>'form-control'
							);

							if($this->datosEtapa[0]['idCoordinador'] == null)
								$this->datosEtapa[0]['idCoordinador'] = 0;

							$idCoordinador = array
							(
									'name'=>'idCoordinador',
									'options'=> $this->usuarios,
									'selected'=>$this->datosEtapa[0]['idCoordinador'],
									'required'=>'required',
									'class'=>'form-control'
							);

							$enviar = array
							(
									'type'=>'submit',
									'name'=>'enviar',
									'value'=>'ENVIAR',
									'class'=>'form-control'
							);
						?>

						<?php echo validation_errors(); ?>
						<?php echo form_open(base_url().'C_GestionEVG/modificarEtapa/'.$idEtapa); ?>
						<?php echo form_label('Código'); ?></br>
						<?php echo form_input($codEtapa); ?>
						<?php echo '<small id="infoAjax" class="form-text text-muted"></small>'; ?></br>
						<?php echo form_label('Nombre'); ?></br>
						<?php echo form_input($nombre); ?>
						<?php echo '<small id="infoAjax2" class="form-text text-muted"></small>'; ?></br>
						<?php echo form_label('Coordinador'); ?></br>
						<?php echo form_dropdown($idCoordinador); ?></br>
						<?php echo form_submit($enviar); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
