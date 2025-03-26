<div>    
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card-box overflow-hidden">
                <div class="profile-tab">
                    <div class="tab">
                        <ul class="nav nav-tabs customtab">
                            <li class="nav-item">
                                <a wire:click.prevent="selectTab('novelty_types')"
                                   class="nav-link {{ $tab == 'novelty_types' ? 'active' : '' }}"
                                   href="#">Tipos de novedad</a>
                            </li>
                            <li class="nav-item">
                                <a wire:click.prevent="selectTab('data')"
                                   class="nav-link {{ $tab == 'data' ? 'active' : '' }}"
                                   href="#">Datos</a>
                            </li>
                        </ul>
    
                        <div class="tab-content">
                            <!-- Tipos de Novedad -->
                            <div class="tab-pane fade {{ $tab == 'novelty_types' ? 'active show' : '' }}">
                                <div class="pd-20">
                                    <div class="pull-left">
                                        <h4 class="text-blue h4">Tipos de Novedades</h4>
                                    </div>
                                    <div class="pull-right">
                                        <a wire:click="create_novelty_type()"><i class="icon dw dw-add"></i></a>
                                    </div>
                                    <input wire:model.live="searchNoveltyType" type="text" class="form-control mb-3" placeholder="Buscar...">
    
                                    @if($noveltyTypes->count())
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Tipo de Novedad</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($noveltyTypes as $noveltyType)
                                                    <tr>
                                                        <td>{{ $noveltyType->id }}</td>
                                                        <td>{{ $noveltyType->subdomain }}</td>
                                                        <td>                                                            
                                                            <a class="m-1" href="javascript:;" wire:click="editNoveltyType({{ $noveltyType->id }})">
                                                                <i class="icon dw dw-edit2"></i>
                                                            </a>
                                                            <a wire:click="confirmDeleteNovelty({{ $noveltyType->id }}, '{{ $noveltyType->subdomain }}')" href="javascript:;" >
                                                                <i class="icon dw dw-delete-3"></i>
                                                            </a>                                                                                                            
                                                        </td>                                                       
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $noveltyTypes->links() }}
                                    @else
                                        <strong>No hay registros</strong>
                                    @endif
                                </div>
                            </div>
    
                            <!-- Datos -->
                            <div class="tab-pane fade {{ $tab == 'data' ? 'active show' : '' }}">
                                <div class="pd-20">
                                    <div class="pull-left">
                                        <h4 class="text-blue h4">Datos</h4>
                                    </div>
                                    <div class="pull-right">
                                        <a wire:click="create_data()"><i class="icon dw dw-add"></i></a>
                                    </div>
                                    <input wire:model.live="searchData" type="text" class="form-control mb-3" placeholder="Buscar...">
    
                                    @if($data->count())
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Dato</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->subdomain }}</td>
                                                        <td>
                                                            <a class="m-1" href="javascript:;" wire:click="edit_data({{$item->id}})">
                                                                <i class="icon dw dw-edit2"></i>
                                                            </a>
                                                            <a class="m-1" href="javascript:;" wire:click="confirmDeleteData({{ $item->id }}, '{{ $item->subdomain }}')">
                                                                <i class="icon dw dw-delete-3"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $data->links() }}
                                    @else
                                        <strong>No hay registros</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Modal para Editar Tipo de Novedad -->
                        <div wire:ignore.self class="modal fade" id="editNoveltyModal" tabindex="-1" role="dialog" aria-labelledby="editNoveltyModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Tipo de Novedad</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="editNoveltyType">Tipo de Novedad:</label>                                            
                                            <input type="text" wire:model.defer="editingNoveltyTypeName" class="form-control mb-3">
                                            @error('editingNoveltyTypeName')
                                            <span class="text-danger" role="alert">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <!-- Selección de datos asociados con checkboxes -->
                                        <label>Asociar Datos:</label>
                                        <div class="form-group">
                                            @foreach($dataModal as $item)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" 
                                                        wire:model="selectedData" 
                                                        value="{{ $item->id }}" 
                                                        id="data_{{ $item->id }}">
                                                    <label class="form-check-label" for="data_{{ $item->id }}">
                                                        {{ $item->subdomain }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <button wire:click="updateNoveltyType" class="btn btn-success mt-3">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para crear tipo de Novedad -->
                        <div wire:ignore.self class="modal fade" id="createNoveltyModal" tabindex="-1" role="dialog" aria-labelledby="createNoveltyModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createNoveltyModalLabel">Crear Tipo de Novedad</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="newNoveltyTypeName">Nombre del Tipo de Novedad</label>
                                        <input type="text" id="newNoveltyTypeName" wire:model.defer="newNoveltyTypeName" class="form-control">
                                        @error('newNoveltyTypeName')
                                            <span class="text-danger" role="alert">{{$message}}</span>
                                        @enderror
                                        <label for="createData">Asociar Datos:</label>
                                        <div class="form-group">
                                            @foreach($dataModal as $item)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                wire:model="selectedData"
                                                value="{{ $item->id }}"
                                                id="data_{{ $item->id }}">
                                                <label class="form-check-label" for="data_{{ $item->id }}">
                                                    {{ $item->subdomain }}
                                                </label>
                                            </div>
                                            @endforeach
                                            <div class="form-group mt-3">
                                                <button wire:click="store_novelty_type()" class="btn btn-success mt-3" >Crear Tipo de Novedad</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para editar datos -->
                        <div wire:ignore.self class="modal fade" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editDataModalLabel">Editar Dato</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="editData">Nombre del Dato</label>
                                        <input type="text" id="editData" wire:model.defer="editingDataName" class="form-control">
                                        @error('editingDataName')
                                            <span class="text-danger" role="alert">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button wire:click="updateData"  class="btn btn-success mt-3" >Guardar Cambios</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para crear datos -->
                        <div wire:ignore.self class="modal fade" id="createDataModal" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createDataModalLabel">Crear Dato</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="createData">Nombre del Dato</label>
                                        <input type="text" id="createData" wire:model.defer="newDataName" class="form-control">
                                        @error('newDataName')
                                            <span class="text-danger" role="alert">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button wire:click="store_data"  class="btn btn-success mt-3" >Crear Dato</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de Confirmación de eliminacion de tipo de novedad-->
                        <div wire:ignore.self class="modal fade" id="deleteNoveltyModal" tabindex="-1" role="dialog" aria-labelledby="deleteNoveltyModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteNoveltyModalLabel">Confirmar Eliminación</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro de que deseas eliminar <strong>{{ $noveltyTypeNameToDelete }}</strong>?</p>
                                        <p class="text-danger"><i class="icon dw dw-warning"></i> Esta acción no se puede deshacer.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button wire:click="deleteNoveltyType" data-dismiss="modal" class="btn btn-danger">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de Confirmación de eliminacion de dato-->
                        <div wire:ignore.self class="modal fade" id="deleteDataModal" tabindex="-1" role="dialog" aria-labelledby="deleteDataModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteDataModalLabel">Confirmar Eliminación</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro de que deseas eliminar <strong>{{ $dataNameToDelete }}</strong>?</p>
                                        <p class="text-danger"><i class="icon dw dw-warning"></i> Esta acción no se puede deshacer.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button wire:click="deleteData" data-dismiss="modal" class="btn btn-danger">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>                
                </div> 
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', function () {
        Livewire.on('show-edit-novelty-modal', () => {
            $('#editNoveltyModal').modal('show');
        });
        Livewire.on('show-create-novelty-modal', () => {
            $('#createNoveltyModal').modal('show');
        });

        Livewire.on('show-edit-data-modal', () => {
            $('#editDataModal').modal('show');
        });
        Livewire.on('show-create-data-modal', () => {
            $('#createDataModal').modal('show');
        });

        Livewire.on('show-delete-modal-novelty', () => {
            $('#deleteNoveltyModal').modal('show');
        });
        Livewire.on('show-delete-modal-data', () => {
            $('#deleteDataModal').modal('show');
        });
        

        Livewire.on('hide-modal', () => {
            $('#editNoveltyModal').modal('hide');
            $('#createNoveltyModal').modal('hide');
            $('#editDataModal').modal('hide');
            $('#createDataModal').modal('hide');
            $('#deleteNoveltyModal').modal('hide');

        });
    });
</script>
@endpush

