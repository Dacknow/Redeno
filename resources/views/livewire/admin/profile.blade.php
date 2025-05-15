<div>    
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <a href="javascript:;" onclick="event.preventDefault();document.getElementById
                    ('adminProfilePictureFile').click();" class="edit-avatar"><i class="fa fa-pencil" style="margin-top:7px;"></i></a>
                    <img src="{{$admin->picture}}" alt="" class="avatar-photo" id="adminProfilePicturePreview">
                    <input type="file" name="adminProfilePictureFile" id="adminProfilePictureFile" class="d-none"
                    style="opacity:0">
                </div>
                <h5 id="adminProfileName" class="text-center h5 mb-0">{{$admin->name}}</h5>
                <p id="adminProfileEmail" class="text-center text-muted font-14">
                    {{$email}}
                </p>
                {{-- Aqui va el rol del admin --}}
                @if($admin && $admin->roles->isNotEmpty())
                    <p class="text-center text-muted font-14">
                        <strong>{{ $admin->getRoleNames()->first() }}</strong>
                    </p> 
                @endif
                
                <p class="text-center text-muted font-14">
                    Estado: <strong>{{ $state ? 'Activo' : 'Inactivo' }}</strong>
                </p>
            
                <!-- Interruptor de Disponibilidad -->
                <div class="text-center mt-3">
                    <label class="switch">
                        <input type="checkbox" wire:click="toggleAvailability" {{ boolval($is_available) ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                    <p class="text-muted font-14 mt-2">
                        <strong>{{ $is_available ? 'Disponible' : 'No Disponible' }}</strong>
                    </p>                   
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a wire:Click.prevent='selectTab("personal_details")' class="nav-link {{ $tab == 'personal_details' ? 'active' : ''}}" data-toggle="tab" href="#personal_details" role="tab">Información Personal</a>
                            </li>
                            <li class="nav-item">
                                <a wire:Click.prevent='selectTab("update_password")' class="nav-link {{ $tab == 'update_password' ? 'active' : ''}}" data-toggle="tab" href="#update_password" role="tab">Actualizar Contraseña</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            
                            <!-- Formulario de Información Personal -->
                            <div class="tab-pane fade {{ $tab == 'personal_details' ? 'active show' : ''}}" id="personal_details" role="tabpanel">
                                <div class="pd-20">
                                    <x-form-alerts></x-form-alerts>
                                    <form id="personal-info-form" wire:submit="updatePersonalDetails()">
                                        <div class="form-group">
                                            <label for="name">Nombre Completo</label>
                                            <input wire:model="name" type="text" class="form-control" id="name" name="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Usuario</label>
                                            <input wire:model="username" type="text" class="form-control" id="username" name="username">
                                            @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Correo Electrónico</label>
                                            <input wire:model="email" type="email" class="form-control" id="email" name="email" disabled>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Formulario de Cambio de Contraseña -->
                            <div class="tab-pane fade {{ $tab == 'update_password' ? 'active show' : ''}}" id="update_password" role="tabpanel">
                                <div class="pd-20">
                                    <x-form-alerts></x-form-alerts>
                                    <form id="password-form" wire:submit="updatePassword()">
                                        <div class="form-group">
                                            <label for="current-password">Contraseña Actual</label>
                                            <input type="password" class="form-control" id="current-password" name="current-password" wire:model.defer='current_password'>
                                            @error('current_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="new-password">Nueva Contraseña</label>
                                            <input type="password" class="form-control" id="new-password" name="new-password" wire:model.defer='new_password'>
                                            @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm-password">Confirmar Nueva Contraseña</label>
                                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" wire:model.defer='new_password_confirmation'>
                                            @error('new_password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div> 
            </div>
        </div>
    </div> 
</div>
