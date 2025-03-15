<div>
    <div class="user-info-dropdown">
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">                              
                <span class="user-icon">
                    <img src="{{$admin->picture}}" alt="" class="profile-img"/>
                    <span id="statusIndicator" class="status-indicator {{ $admin->is_available ? 'online' : 'offline' }}">
                        <i class="dw {{ $admin->is_available ? 'dw-checkmark-circle' : 'dw-minus-circle' }}"></i>
                    </span> 
                </span>
                <span id="adminProfileUsername" class="user-name">{{$admin->username}}</span>
            </a>            
            <div
                class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
            >
                <a class="dropdown-item" href="{{route('profile')}}"
                    ><i class="dw dw-user1"></i> Perfil</a
                >
                <a class="dropdown-item" href="profile.html"
                    ><i class="dw dw-settings2"></i> Ajustes</a
                >
                <a class="dropdown-item" href="faq.html"
                    ><i class="dw dw-help"></i> Ayuda</a
                >
                <a class="dropdown-item" href="{{route('logout-handler')}}"
                onclick="event.preventDefault(); document.getElementById('adminLogoutForm').
                submit();"><i class="dw dw-logout"></i> Cerrar Sesión</a>
                <form id="adminLogoutForm" action="{{route('logout-handler')}}" method="POST">
                    @csrf 
                </form>
            </div>
        </div>
    </div>
</div>
