<div>
    <div class="pd-20 card-box overflow-hidden">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="text-blue h4">Generar Reporte</h4>
            <a href="javascript:;" wire:click="createReport">
                <i class="icon dw dw-add"></i>
            </a>
        </div>
    
        {{-- Filtro por fecha --}}
        <div class="mb-3">
            <input type="date" wire:model.live="selected_day" class="form-control">
        </div>
    
        {{-- Contenedor de reportes en tarjetas --}}
        <div class="row">
            @forelse($reports as $report)
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header text-left font-weight-bold">
                            Re {{$report->id.' : '.$report->noveltyType->subdomain }}
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            {{-- Estado --}}
                            <button class="btn {{ $this->getStateColor($report->state->subdomain) }} btn-sm"
                                wire:click="{{ $report->state->subdomain == 'Pendiente' ? 'deleteReportConfirm': ''}}({{ $report->id }})">
                                {{ $report->state->subdomain }}
                            </button>                            
                            
                            {{-- Botón para ver detalles --}}
                            <button class="btn btn-info btn-sm" wire:click="viewReport({{ $report->id}})">
                                <i class="icon dw dw-eye"></i> Ver Detalles
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No hay reportes disponibles.</p>
                </div>
            @endforelse
        </div>
    </div>
    
    {{-- Modal para crear un reporte --}}
    <div wire:ignore.self class="modal fade" id="modal-create-report" tabindex="-1" role="dialog" aria-labelledby="modalCreateReportLabel" aria-hidden="true">
        <div class="modal-dialog" role="document"> {{-- Modal ampliado --}}
            <div class="modal-content">
                {{-- Encabezado del modal --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateReportLabel">Crear Reporte</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- Cuerpo del modal --}}
                <div class="modal-body">                                                        

                    {{-- Formulario para crear reporte --}}
                    <form wire:submit.prevent="storeReport" enctype="multipart/form-data">
                        @csrf

                        {{-- Selección de tipo de novedad --}}
                        
                        <div class="form-group">
                            <select wire:model.live="reportTypeSelected" id="reportTypeSelected" class="form-control">
                                <option value="" selected>Seleccione un Tipo de Novedad</option>
                                @foreach ($report_types as $item)
                                    <option value="{{$item->id}}">{{$item->subdomain}}</option>                
                                @endforeach
                            </select>
                            @error('reportTypeSelected')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>  
                        
                        

                        {{-- Seleccion del administrador--}}

                        
                        <div class="form-group">
                            <select wire:model.live="adminSelected" id="adminSelected" class="form-control">
                                <option value="" selected>Seleccione un Administrador</option>
                                @foreach ($admins as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('adminSelected')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- llenar datos del reporte--}}
                        @foreach($data as $item)
                            <div class="form-group">
                                <input type="text" wire:model.defer="form.{{$item->data_id}}" class="form-control" id="input-{{$item->data_id}}" placeholder="{{$item->data->subdomain}}">
                            </div>
                            @error('form.{{$item->data_id}}')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endforeach

                        {{-- Description --}}
                        <div class="form-group">
                            <textarea wire:model.defer="description" class="form-control" id="description" rows="5" placeholder="Descripción"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Vista previa de imágenes antes de subirlas -->
                        <div class="mt-2">
                            @if ($photos)
                                @foreach ($photos as $photo)
                                    @if (str_starts_with($photo->getMimeType(), 'image/'))
                                        <img src="{{ $photo->temporaryUrl() }}" width="100" class="m-2">
                                    @endif
                                @endforeach
                            @endif
                        </div>


                        {{-- Cargar imagen --}}
                        <div class="form-group">
                            <label for="photos">Seleccione una a varias Imágenes (Opcional)</label>
                            <input id="photos" type="file" wire:model="photos" class="form-control" multiple accept="image/*">
                            <div wire:loading wire:target="photos">Subiendo...</div>
                            @error('photos.*')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Botón para enviar el formulario --}}
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Guardar Reporte
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Modal de Detalles del Reporte -->
    <div wire:ignore.self class="modal fade" id="modal-report-detail" tabindex="-1" role="dialog" aria-labelledby="modal-report-detailLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-report-detailLabel">Detalles del Reporte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    @if($selectedReport)
                        <div class="container">
                            <p><strong>ID:</strong> {{ $selectedReport->id }}</p>
                            <p><strong>Técnico:</strong> {{ $selectedReport->technician->name ?? 'No disponible' }}</p>
                            <p><strong>Administrador:</strong> {{ $selectedReport->manager->name ?? 'No disponible' }}</p>
                            <p><strong>Estado:</strong> 
                                <span class="badge {{$this->getStateColor($selectedReport->state->subdomain ?? '')}}">
                                    {{ $selectedReport->state->subdomain ?? 'Desconocido' }}
                                </span>
                            </p>
                            <p><strong>Fecha de Creación:</strong> {{ optional($selectedReport->created_at)->format('d/m/Y H:i') }}</p>
                            <p><strong>Descripción:</strong> {{ $selectedReport->description ?? 'No proporcionada' }}</p>
                            @foreach($selectedReport->items ?? [] as $item)
                                <p><strong>{{ $item->item->subdomain ?? 'Desconocido' }}:</strong> {{ $item->value ?? 'N/A' }}</p>
                            @endforeach
                            <p><strong>Respuesta Administrador:</strong> {{ $selectedReport->admin_response ?? 'No proporcionada' }}</p>
                            <p><strong>Fecha de Finalización:</strong> {{ optional($selectedReport->completation_time)->format('d/m/Y H:i') }}</p>                            
                            @foreach ($selectedReport->images as $image)
                                <img src="{{ asset('storage/' . $image->image_url) }}" class="m-1" alt="Imagen del reporte" width="200">
                            @endforeach
                        </div>
                    @else
                        <p>No se encontró el reporte.</p>
                    @endif
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de eliminacion de reporte-->
    <div wire:ignore.self class="modal fade" id="modal-delete-report" tabindex="-1" role="dialog" aria-labelledby="modal-delete-reportLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modal-delete-reportLabel">Cancelar reporte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar <strong>Re {{$reportToDelete->id ?? 'No Disponible'}} : {{$reportToDelete->noveltyType->subdomain ?? 'No Disponible' }}</strong>?</p>
                    <p class="text-danger"><i class="icon dw dw-warning"></i> Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button wire:click="deleteReport" data-dismiss="modal" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>      
    // Emitir evento desde el modal del calendario para seleccionar una fecha
    document.addEventListener('livewire:initialized', function () {
        Livewire.on('show-modal-create-report', () => {
            $('#modal-create-report').modal('show');
        });
        Livewire.on('show-modal-report-detail', () => {
            $('#modal-report-detail').modal('show');
        });
        Livewire.on('show-delete-report-modal', () => {
            $('#modal-delete-report').modal('show');
        });

        Livewire.on('hide-modal', () => {
            $('#modal-create-report').modal('hide');
            $('#modal-report-detail').modal('hide');
            $('#modal-delete-report').modal('hide');
        });
    });
</script>
@endpush

