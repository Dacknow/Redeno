<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>@yield('pageTitle')</title>
		
		<!-- Site favicon -->
		<link rel="icon" type="image/png" sizes="32x32" href="/images/site/logo_favicon/favicon_Redeno.png">

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="/back/vendors/styles/icon-font.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />
		<link rel="stylesheet" href="/extra-assets/ijaboCropTool/ijaboCropTool.min.css">
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/myStyles.css" />
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @stack('stylesheet')
	</head>
	<body>
		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
			</div>
			<div class="header-right theme-container">
				<div class="py-3">
					<div class="dropdown">
						<a
							class="btn dropdown-toggle no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						>							
							<i class="bi bi-moon"></i>
							<i class="bi bi-brightness-high"></i>
						</a>
					</div>
				</div>
				<div class="py-3">
					@livewire('admin.report-alert')
				</div>
					@livewire('admin.top-admin-info')
			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-dark">
					Configuración
					<span class="btn-block font-weight-400 font-12"
						>Color de Interfaz</span
					>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Cabecera</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-secondary header-white active"
							>Claro</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-secondary header-dark"
							>Oscuro</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menú</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-secondary sidebar-light active"
							>Claro</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-secondary sidebar-dark"
							>Oscuro</a
						>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="{{route('dashboard')}}">
					<img src="/images/site/logo_favicon/logo_white_Redeno.png" alt="" class="dark-logo" />
					<img
						src="/images/site/logo_favicon/logo_dark_Redeno.png"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						@if(auth('admin')->user()->can('dashboard'))
							<li>
								<a href="{{route('dashboard')}}" class="dropdown-toggle no-arrow {{Route::is('dashboard') ? 'active' : ''}}">
									<span class="micon fa fa-home"></span>
									<span class="mtext">Inicio</span>
								</a>
							</li>
						@endif
						@if(auth('admin')->user()->can('manage-reports'))
							<li>
								<a href="{{route('manage-reports')}}" class="dropdown-toggle no-arrow {{Route::is('manage-reports') ? 'active' : ''}}">
									<span class="micon fa fa-warning"></span>
									<span class="mtext">Reportes</span>
								</a>
							</li>
						@endif
						@if(auth('admin')->user()->can('templates-page'))
							<li>
								<a href="{{route('templates-page')}}" class="dropdown-toggle no-arrow {{Route::is('templates-page') ? 'active' : ''}}">
									<span class="micon fa fa-clone"></span>
									<span class="mtext">Plantillas</span>
								</a>
							</li>
						@endif
						@if(auth('admin')->user()->can('users'))
							<li>
								<a href="{{route('users')}}" class="dropdown-toggle no-arrow {{Route::is('users') ? 'active' : ''}}">
									<span class="micon fa fa-users"></span>
									<span class="mtext">Usuarios</span>
								</a>
							</li>
						@endif
						
						@if(auth('admin')->user()->can('roles'))
							<li>
								<a href="roles.html" class="dropdown-toggle no-arrow">
									<span class="micon bi bi-person-badge"></span>
									<span class="mtext">Roles</span>
								</a>
							</li>
						@endif

						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="{{route('profile')}}" class="dropdown-toggle no-arrow {{Route::is('profile') ? 'active' : ''}}">
								<span class="micon bi bi-person-circle"></span>
								<span class="mtext">Perfil</span>
							</a>
						</li>
						<li>
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span>
								<span class="mtext">Documentación</span>
							</a>
							<ul class="submenu">
								<li><a href="introduction.html">Introducción</a></li>
								<li><a href="getting-started.html">Primeros pasos</a></li>
								<li><a href="color-settings.html">Configuración de colores</a></li>
								<li><a href="third-party-plugins.html">Plugins de terceros</a></li>
							</ul>
						</li>
					</ul>										
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>

					
					
        @yield('content')
                    
				
		<!-- js -->
		<script src="/back/vendors/scripts/core.js"></script>
		<script src="/back/vendors/scripts/script.min.js"></script>
		<script src="/back/vendors/scripts/process.js"></script>
		<script src="/back/vendors/scripts/layout-settings.js"></script>
		<script src="/extra-assets/ijaboCropTool/ijaboCropTool.min.js"></script>
        @stack('scripts')
	</body>
	<footer class="bg-light text-dark mt-5 pt-4 border-top">
		<div class="container">
			<div class="row">
	
				<!-- Descripción del sistema -->
				<div class="col-md-4 mb-3">
					<h5 class="text-uppercase fw-bold">Redeno</h5>
					<p class="small">
						Plataforma web para el registro y seguimiento de novedades de instalación y reparación en tiempo real. Optimiza la comunicación entre técnicos y supervisores.
					</p>
				</div>
	
				<!-- Enlaces rápidos -->
				<div class="col-md-4 mb-3">
					<h6 class="fw-semibold">Enlaces rápidos</h6>
					<ul class="list-unstyled">
						<li><a href="{{ route('dashboard') }}" class="text-dark text-decoration-none">Inicio</a></li>
						<li><a href="{{ route('manage-reports') }}" class="text-dark text-decoration-none">Mis Reportes</a></li>
						<li><a  class="text-dark text-decoration-none">Preguntas Frecuentes</a></li>
						<li><a  class="text-dark text-decoration-none">Términos y condiciones</a></li>
					</ul>
				</div>
	
				<!-- Contacto o redes sociales -->
				<div class="col-md-4 mb-3">
					<h6 class="fw-semibold">Contacto</h6>
					<p class="small mb-1">Soporte técnico</p>
					<p class="small mb-1"><i class="dw dw-envelope me-2"></i> soporte@redeno.com</p>
					<p class="small"><i class="dw dw-phone me-2"></i> +57 310 000 0000</p>
				</div>
			</div>
	
			<div class="text-center py-3 border-top small">
				© {{ date('Y') }} Redeno. Todos los derechos reservados.
			</div>
		</div>
	</footer>	
</html>