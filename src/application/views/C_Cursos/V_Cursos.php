<?php include_once('application/views/Plantilla/header.php'); ?>
<html>
	<head>
		<title>Cursos</title>
	</head>
	<body>
		<div id="principal" class="container-fluid animate__animated animate__fadeIn">
			<div class="row">
				<header class="col-12">
					<div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-6">
						<?php echo '<a href="'.base_url().'main"><img id="logo-evg" src="'.base_url().'uploads/iconos/evg.png" alt="Escudo EVG" class="img-fluid"/></a>'  ;?>
						<h3>Gestión EVG - Cursos</h3>
					</div>
					<div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-6">
						<?php echo "<button onclick=\"location.href ='" . base_url() . "main'\" id=\"icon-grid\" class=\"btn mr-2\" data-toggle=\"popover\" data-content=\"Grid Apliciones\"><i class=\"fas fa-th\"></i></button>"; ?>
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
					<?php echo "<button onclick=\"location.href ='" . base_url() . "add-course'\" class=\"btn btn-success\" data-toggle=\"popover\" data-content=\"Añadir Curso\"><i class=\"fas fa-plus-square\"></i></button>"; ?>
					<?php echo "<button onclick=\"location.href ='" . base_url() . "import-courses'\" class=\"btn btn-warning\" data-toggle=\"popover\" data-content=\"Importar Cursos\"><i class=\"fas fa-file-import\"></i></button>"; ?>
					<div class="gestion-apps animate__animated animate__slideInLeft">
						<?php
							if(empty($this -> listaCursos))
								echo "<b>No hay cursos creados.</b>";
							else
								foreach($this -> listaCursos as $indice => $valor)
								{
									echo
											"
										<div class=\"fila\">
											<h3>" . $valor . "</h3>
											<button onclick=\"location.href ='" . base_url() . "stage-course/" . $indice . "'\" class=\"btn btn-info\" data-toggle=\"popover\" data-content=\"Asignar Etapa\"><i class=\"fas fa-cog\"></i></button>
											<button onclick=\"location.href ='" . base_url() . "update-course/" . $indice . "'\" class=\"btn btn-warning\" data-toggle=\"popover\" data-content=\"Modificar Curso\"><i class=\"fas fa-edit\"></i></button>
											<button onclick=\"confirmar('¿Seguro que quieres borrar el curso: <b>" . $valor . "</b>?', '" . base_url() . "delete-course/" . $indice . "', 'Eliminar Curso', 'Cancelar', 'Eliminar')\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#myModal\"><i class=\"fas fa-trash\"></i></button>";
									if (!is_null($this->listaEtapasCursos[$indice]))
										echo "
											<button class=\"btn btn-secondary curso-info\" data-toggle=\"popover\" data-content=\"Ya hay una etapa asignada\"><i class=\"fas fa-exclamation-circle\"></i></button>
										</div>						
									";
								}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
			if(!is_null($this -> input -> cookie('importedCourses')))
			{
				if($this -> input -> cookie('importedCourses') != 0)
				{
					echo
					'
							<!--Bootstrap Import Modal-->
							<div id="imports" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title font-weight-bolder">Importación Finalizada</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="eliminarModal()">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">';
											echo "<p>Se han importado " . $this -> input -> cookie('importedCourses') . ' usuarios.</p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger font-weight-bolder" data-dismiss="modal" onclick="eliminarModal()">Cerrar</button>
										</div>
									</div>
								</div>
							</div>
						';
				}
				else
				{
					echo
					'
							<!--Bootstrap Import Modal-->
							<div id="imports" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title font-weight-bolder">Importación Finalizada</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="eliminarModal()">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<p>No se han importado cursos.</p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger font-weight-bolder" data-dismiss="modal" onclick="eliminarModal()">Cerrar</button>
										</div>
									</div>
								</div>
							</div>
						';
				}
			}
			delete_cookie('importedCourses');
		?>
	</body>
</html>
