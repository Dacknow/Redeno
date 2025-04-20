<div>
    <div class="pd-20 card-box overflow-hidden">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="text-dark h4">Administrar Reportes</h4>
            
        </div>
    
        {{-- Filtro por fecha --}}
        <div class="mb-3">
            <input type="date" wire:model.live="selected_day" class="form-control">
        </div>
    
        {{-- Contenedor de reportes en tarjetas --}}
        <div class="row" wire:poll.15s>
            @forelse($reports as $report)
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header text-left font-weight-bold">
                            Re {{$report->id.' : '.$report->noveltyType->subdomain }}
                        </div>
                        <div class="card-body d-flex justify-content-between align-items-center">
                            {{-- Estado --}}
                            <button class="btn {{ $this->getStateColor($report->state->subdomain) }} btn-sm"
                                wire:click="changeState({{ $report->id }})">
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
                            <p><strong>ID Reporte:</strong> {{ $selectedReport->id }}</p>
                            <p><strong>Técnico:</strong> {{ $selectedReport->technician->name ?? 'No disponible' }}</p>
                            <p><strong>Cédula:</strong> {{ $selectedReport->technician->identification ?? 'No disponible' }}</p>
                            <p><strong>Télefono:</strong> {{ $selectedReport->technician->celphone ?? 'No disponible' }}</p>
                            <p><strong>Administrador:</strong> {{ $selectedReport->manager->name ?? 'No disponible' }}</p>
                            <p><strong>Estado:</strong> 
                                <span class="badge {{$this->getStateColor($selectedReport->state->subdomain ?? '')}}">
                                    {{ $selectedReport->state->subdomain ?? 'Desconocido' }}
                                </span>
                            </p>         
                            <p><strong>Descripción:</strong> {{ $selectedReport->description ?? 'No proporcionada' }}</p>
                            @foreach($selectedReport->items ?? [] as $item)
                                <p><strong>{{ $item->item->subdomain ?? 'Desconocido' }}:</strong> {{ $item->value ?? 'N/A' }}</p>
                            @endforeach
                            <p><strong>Respuesta Administrador:</strong> {{ $selectedReport->admin_response ?? 'No proporcionada' }}</p>
                            <p><strong>Fecha de Creación:</strong> {{$selectedReport->created_at }}</p> 
                            <p><strong>Fecha de Finalización:</strong> {{ $selectedReport->completation_time}}</p>                  
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

     <!-- Modal de Respuesta del Administrador -->

    <div wire:ignore.self class="modal fade" id="modal-report-response" tabindex="-1" role="dialog" aria-labelledby="modal-report-responseLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-report-responseLabel">Respuesta del Administrador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    @if($selectedReport)
                        <form wire:submit.prevent="sendResponse">
                            @csrf
                            <div class="form-group">
                                <label for="adminResponse">Respuesta del Administrador</label>
                                <textarea id="adminResponse" class="form-control" rows="5" wire:model="adminResponse"></textarea>
                                @error('adminResponse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>                       
                            <div class="form-group">
                                <select wire:model="reportStateSelected" id="reportStateSelected" class="form-control">
                                    <option value="" selected>Seleccione un Estado</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}">{{$state->subdomain}}</option>                
                                    @endforeach
                                </select>
                                @error('reportStateSelected')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>  
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    @endif
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
</div>

@push('scripts')
<script>      
    
    document.addEventListener('livewire:initialized', function () {
        
        Livewire.on('show-modal-report-detail', () => {
            $('#modal-report-detail').modal('show');
        });
        Livewire.on('show-modal-report-response', () => {
            $('#modal-report-response').modal('show');
        });
        

        Livewire.on('hide-modal', () => {
            $('#modal-report-detail').modal('hide');
        });
        Livewire.on('hide-modal', () => {
            $('#modal-report-response').modal('hide');
        });
    });
</script>
@endpush
