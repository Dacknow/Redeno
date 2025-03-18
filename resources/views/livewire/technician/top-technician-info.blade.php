<div>
    <div class="user-info-dropdown">
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">                              
                <span class="user-icon">
                    <img src="{{$technician->picture}}" alt="" class="profile-img"/>                    
                </span>
                <span id="technicianProfileUsername" class="user-name">{{$technician->username}}</span>
            </a>            
            <div
                class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
            >
                <a class="dropdown-item" href="{{route('tProfile')}}"
                    ><i class="dw dw-user1"></i> Perfil</a
                >
                <a class="dropdown-item" href="profile.html"
                    ><i class="dw dw-settings2"></i> Ajustes</a
                >
                <a class="dropdown-item" href="faq.html"
                    ><i class="dw dw-help"></i> Ayuda</a
                >
                <a class="dropdown-item" href="{{route('tLogout-handler')}}"
                onclick="event.preventDefault(); document.getElementById('technicianLogoutForm').
                submit();"><i class="dw dw-logout"></i> Cerrar Sesión</a>
                <form id="technicianLogoutForm" action="{{route('tLogout-handler')}}" method="POST">
                    @csrf 
                </form>
            </div>
        </div>
    </div>
</div>
