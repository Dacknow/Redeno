<div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a wire:click.prevent='selectTab("admins")' 
                                   class="nav-link {{ $tab == 'admins' ? 'active' : '' }}" 
                                   data-toggle="tab" 
                                   href="#admins" 
                                   role="tab">Administradores</a>
                            </li>
                            <li class="nav-item">
                                <a wire:click.prevent='selectTab("technicians")' 
                                   class="nav-link {{ $tab == 'technicians' ? 'active' : '' }}" 
                                   data-toggle="tab" 
                                   href="#technicians" 
                                   role="tab">Técnicos</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- Listado de Administradores -->
                            <div class="tab-pane fade {{ $tab == 'admins' ? 'active show' : '' }}" id="admins" role="tabpanel">
                                <div class="pd-20">
                                    <div class="clearfix mb-20">            
                                        <div class="pull-left">
                                            <h4 class="text-blue h4">Listado de Administradores</h4>
                                        </div>
                                    </div>
                                    
                                    <input wire:model.live="searchAdmin" id="search" type="text" class="form-control mb-3" placeholder="Ingrese el nombre o el correo de un usuario">
                                    @if($admins->count())
                                    <table class="table table-striped table-responsive">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Email</th>
                                                <th>Nombre de Usuario</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($admins as $admin)
                                                <tr>
                                                    <td>{{ $admin->id }}</td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ $admin->username }}</td>
                                                    <td><button class="btn btn-info btn-sm">Editar</button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="card-footer">
                                        {{$admins->links()}}
                                    </div>
                                    @else
                                        <div class="card-body">
                                            <strong>No hay registros</strong>
                                        </div>
                                    @endif
                                </div>                                
                            </div>

                            <!-- Listado de Técnicos -->
                            <div class="tab-pane fade {{ $tab == 'technicians' ? 'active show' : '' }}" id="technicians" role="tabpanel">
                                <div class="pd-20">
                                    <div class="clearfix mb-20">            
                                        <div class="pull-left">
                                            <h4 class="text-blue h4">Listado de Técnicos</h4>
                                        </div>
                                    </div>
                                    
                                    <input wire:model.live="searchTechnician" id="search" type="text" class="form-control mb-3" placeholder="Ingrese el nombre, correo o número de cédula de un usuario ">

                                    @if($technicians->count())

                                    <table class="table table-striped table-responsive">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Email</th>
                                                <th>Nombre de Usuario</th>
                                                <th>Número de Cédula</th>
                                                <th>Número de Teléfono</th>
                                                <th>Estado</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($technicians as $technician)
                                                <tr>
                                                    <td>{{ $technician->id }}</td>
                                                    <td>{{ $technician->name }}</td>
                                                    <td>{{ $technician->email }}</td>
                                                    <td>{{ $technician->username }}</td>
                                                    <td>{{ $technician->identification }}</td>
                                                    <td>{{ $technician->celphone }}</td>
                                                    <td>{{ $technician->state == 1? 'Activo' : 'Inactivo' }}</td>
                                                    <td><button class="btn btn-info btn-sm">Editar</button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="card-footer">
                                        {{$technicians->links()}}
                                    </div>

                                    @else
                                        <div class="card-body">
                                            <strong>No hay registros</strong>
                                        </div>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                    </div>                
                </div> 
            </div>
        </div>
    </div>
</div>

