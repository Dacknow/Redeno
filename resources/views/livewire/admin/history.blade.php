<div>
    <div class="pd-20 card-box overflow-hidden">
        <x-form-alerts></x-form-alerts>          
        <div class="col-12 pull-left">
            <h4 class="text-dark h4">Historial de Reportes</h4>
        </div>
        {{-- Filtros --}}
        
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="searchByDay" class="">Filtrar por Fecha</label>
                    <input wire:model.live="searchByDay" id="searchByDay" type="date" class="form-control ">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="searchByReport">Filtrar por Reporte</label>
                    <input wire:model.live ='searchByReport' id="searchByReport" type="text" class="form-control" placeholder="Ingrese el ID del reporte">  
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="searchByAdmin">Filtrar por Administrador</label>
                    <input wire:model.live ='searchByAdmin' id="searchByAdmin" type="text" class="form-control" placeholder="Ingrese el nombre del administrador">  
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="searchByTechnician">Filtrar por Técnico</label>
                    <input wire:model.live ='searchByTechnician' id="searchByTechnician" type="text" class="form-control" placeholder="Ingrese el nombre del técnico">  
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <select wire:model.live="stateSelected" id="stateSelected" class="form-control">
                        <option value="" selected>Filtrar por Estado</option>
                        @foreach ($states as $state)
                            <option value="{{$state->id}}">{{$state->subdomain}}</option>                
                        @endforeach
                    </select>
                </div>
            </div>
            
             
        </div>
        {{-- Repores --}}
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Técnico</th>
                        <th>Administrador</th>
                        <th>Estado</th>
                        <th>Descripción</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                        <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $report->technician->name ?? '—' }}</td>
                            <td>{{ $report->manager->name ?? '—' }}</td>
                            <td>
                                <span class="badge {{$this->getStateColor($report->state->subdomain ?? '')}}">
                                    {{ $report->state->subdomain ?? 'Desconocido' }}
                                </span>
                            </td>
                            <td>{{ Str::limit($report->description, 50) }}</td>
                            <td>
                                {{-- Botón para ver detalles --}}
                                <button class="btn btn-info btn-sm" wire:click="viewReport({{ $report->id}})">
                                    <i class="icon dw dw-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No se encontraron reportes para los filtros seleccionados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
    
        <!-- Modal de Actividad del Reporte -->
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
                                <span class="badge {{ $this->getStateColor($selectedReport->state->subdomain ?? '') }}">
                                    {{ $selectedReport->state->subdomain ?? 'Desconocido' }}
                                </span>
                            </p>
                            <p><strong>Descripción:</strong> {{ $selectedReport->description ?? 'No proporcionada' }}</p>
                            @foreach($selectedReport->items ?? [] as $item)
                                <p><strong>{{ $item->item->subdomain ?? 'Desconocido' }}:</strong> {{ $item->value ?? 'N/A' }}</p>
                            @endforeach
                            <p><strong>Respuesta Administrador:</strong> {{ $selectedReport->admin_response ?? 'No proporcionada' }}</p>
                            <p><strong>Fecha de Creación:</strong> {{ $selectedReport->created_at }}</p>
                            <p><strong>Fecha de Finalización:</strong> {{ $selectedReport->completation_time ?? 'No finalizado' }}</p>

                            @if($selectedReport->images)
                                @foreach ($selectedReport->images as $image)
                                    <img src="{{ asset('storage/' . $image->image_url) }}" class="m-1" alt="Imagen del reporte" width="200">
                                @endforeach
                            @endif

                            <hr>
                            <h5 class="mt-3">🕒 Actividad del Reporte</h5>
                            @if($selectedReport->histories && $selectedReport->histories->count() > 0)
                                <ul class="list-group">
                                    @foreach($selectedReport->histories->sortByDesc('created_at') as $history)
                                        <li class="list-group-item">
                                            <strong>{{ $history->admin->name ?? 'Administrador desconocido' }}:</strong>
                                            {{ $history->action }}<br>
                                            <small class="text-muted">{{ $history->created_at->format('d/m/Y H:i:s') }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">Este reporte no tiene historial de actividad aún.</p>
                            @endif
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


</div>
 @push('scripts')
 <script>
    document.addEventListener('livewire:initialized', function () {
        
        Livewire.on('show-modal-report-detail', () => {
            $('#modal-report-detail').modal('show');
        });
        Livewire.on('hide-modal', () => {
            $('#modal-report-detail').modal('hide');
        });
    });
 </script>
 @endpush