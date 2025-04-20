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
		
		<link rel="stylesheet" href="/extra-assets/ijaboCropTool/ijaboCropTool.min.css">
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/myStyles.css" />
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @stack('stylesheets')
	</head>
	<body>
		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>				
			</div>
			<div class="header-right theme-container">
				<div class="dashboard-setting py-3">
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
				@livewire('technician.top-technician-info')
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
							class="btn btn-outline-secondary header-white "
							>Claro</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-secondary header-dark active"
							>Oscuro</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menú</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-secondary sidebar-light"
							>Claro</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-secondary sidebar-dark active"
							>Oscuro</a
						>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="{{route('home')}}">
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
							<a href="{{route('home')}}" class="dropdown-toggle no-arrow {{Route::is('home') ? 'active' : ''}}">
								<span class="micon fa fa-home"></span
								><span class="mtext">Inicio</span>
							</a>
						</li>
						<li>
							<a href="{{route('reports')}}" class="dropdown-toggle no-arrow {{Route::is('reports') ? 'active' : ''}}">
								<span class="micon bi bi-receipt-cutoff"></span
								><span class="mtext">Reportes</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="{{route('tProfile')}}" class="dropdown-toggle no-arrow {{Route::is('tProfile') ? 'active' : ''}}">
								<span class="micon bi bi-person-circle"></span
								><span class="mtext">Perfil</span>
							</a>
						</li>
						<li>
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-pdf"></span
								><span class="mtext">Documentation</span>
							</a>
							<ul class="submenu">
								<li><a href="introduction.html">Introduction</a></li>
								<li><a href="getting-started.html">Getting Started</a></li>
								<li><a href="color-settings.html">Color Settings</a></li>
								<li>
									<a href="third-party-plugins.html">Third Party Plugins</a>
								</li>
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
</html>