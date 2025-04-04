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
			<div class="header-right">
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						>							
							<i class="bi bi-moon"></i>
							<i class="bi bi-brightness-high"></i>
						</a>
					</div>
				</div>
				<div class="user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<i class="icon-copy dw dw-notification"></i>
							<span class="badge notification-active"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">
								<ul>
									<li>
										<a href="#">
											<img src="/back/vendors/images/img.jpg" alt="" />
											<h3>John Doe</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/photo1.jpg" alt="" />
											<h3>Lea R. Frith</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/photo2.jpg" alt="" />
											<h3>Erik L. Richards</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/photo3.jpg" alt="" />
											<h3>John Doe</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/photo4.jpg" alt="" />
											<h3>Renee I. Hansen</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/img.jpg" alt="" />
											<h3>Vicki M. Coleman</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
					@livewire('admin.top-admin-info')
			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
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
							class="btn btn-outline-primary header-white active"
							>Claro</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Oscuro</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menú</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>Claro</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
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
						<li>
							<a href="{{route('dashboard')}}" class="dropdown-toggle no-arrow {{Route::is('dashboard') ? 'active' : ''}}">
								<span class="micon fa fa-home"></span>
								<span class="mtext">Inicio</span>
							</a>
						</li>
						<li>
							<a href="reportes.html" class="dropdown-toggle no-arrow">
								<span class="micon fa fa-warning"></span>
								<span class="mtext">Reportes</span>
							</a>
						</li>
						<li>
							<a href="{{route('templates-page')}}" class="dropdown-toggle no-arrow {{Route::is('templates-page') ? 'active' : ''}}">
								<span class="micon fa fa-clone"></span>
								<span class="mtext">Plantillas</span>
							</a>
						</li>
						<li>
							<a href="{{route('users')}}" class="dropdown-toggle no-arrow {{Route::is('users') ? 'active' : ''}}">
								<span class="micon fa fa-users"></span>
								<span class="mtext">Usuarios</span>
							</a>
						</li>
						<li>
							<a href="roles.html" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-person-badge"></span>
								<span class="mtext">Roles</span>
							</a>
						</li>
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

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">				
					
                @yield('content')
                    
				</div>
				
			</div>
		</div>
		<!-- js -->
		<script src="/back/vendors/scripts/core.js"></script>
		<script src="/back/vendors/scripts/script.min.js"></script>
		<script src="/back/vendors/scripts/process.js"></script>
		<script src="/back/vendors/scripts/layout-settings.js"></script>
		<script src="/extra-assets/ijaboCropTool/ijaboCropTool.min.js"></script>
        @stack('scripts')
	</body>
</html>