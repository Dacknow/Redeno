<?php

namespace App\Livewire\Admin;

use App\Models\Subdomain;
use App\Models\DataNoveltyType;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Report;
use App\Models\ReportTypeRole;
use Spatie\Permission\Models\Role;

class Templates extends Component
{
    use WithPagination;

    public $searchNoveltyType, $searchData;
    public $tab = null;
    public $tabname = 'novelty_types';
    protected $queryString = ['tab'=>['keep'=>true]];
    protected $paginationTheme="bootstrap";

    public $editingNoveltyTypeId, $editingNoveltyTypeName, $selectedData = [],
    $selectedRoles = [];
    public $dataModal;

    public $editingDataId, $editingDataName;
    public $editData;
    public $selectedNoveltyType;
    public $newDataName, $newNoveltyTypeName;

    public $noveltyTypeIdToDelete;
    public $noveltyTypeNameToDelete;

    public $dataIdToDelete;
    public $dataNameToDelete;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function mount()
    {
        $this->tab = Request('tab') ? Request('tab') : $this->tabname;        
        
        $this->dataModal = Subdomain::where('domain_id', getDomainId('report_item'))->get();
    }
    public function selectTab($tab)
    {
        $this->tab = $tab;
    }
    public function create_novelty_type()
    {        
        $this->dispatch('show-create-novelty-modal');
    }
    public function store_novelty_type()
    {
        $this->validate([
            'newNoveltyTypeName' => 'required|max:100',
            'selectedData' => 'nullable|array',
            'selectedRoles' => 'nullable|array',
        ], [
            'newNoveltyTypeName.required' => 'El nombre del tipo de novedad es obligatorio.',
            'newNoveltyTypeName.max' => 'El nombre no puede exceder los 100 caracteres.',
            'selectedData.array' => 'Los datos seleccionados deben ser un array válido.',
            'selectedRoles.array' => 'Los roles seleccionados deben ser un array válido.',
        ]);

        try {
            DB::transaction(function () {
                $noveltyType = Subdomain::create([
                    'domain_id' => getDomainId('report_type'),
                    'subdomain' => $this->newNoveltyTypeName
                ]);

                if (!empty($this->selectedData)) {
                    $dataToInsert = collect($this->selectedData)->map(function ($data_id) use ($noveltyType) {
                        return [
                            'novelty_type_id' => $noveltyType->id,
                            'data_id' => $data_id,
                        ];
                    })->toArray();

                    DataNoveltyType::insert($dataToInsert); // Inserción masiva para mejor rendimiento
                }
                
                if (!empty($this->selectedRoles)) {
                    $dataToInsert = collect($this->selectedRoles)->map(function ($role_id) use ($noveltyType) {
                        return [
                            'novelty_type_id' => $noveltyType->id,
                            'role_id' => $role_id,
                        ];
                    })->toArray();

                    ReportTypeRole::insert($dataToInsert); // Inserción masiva para mejor rendimiento
                }

                // Emitir evento de éxito
                $this->dispatch('success', '¡Tipo de novedad creado con éxito!');
                $this->dispatch('hide-modal');

                // Limpiar variables
                $this->reset(['newNoveltyTypeName', 'selectedData', 'selectedRoles']);
                $noveltyType->refresh();
            });
        } catch (\Exception $e) {
            \Log::error('Error al crear el tipo de novedad: ' . $e->getMessage());
            $this->dispatch('error', 'Hubo un error al crear el tipo de novedad.');
        }
    }
    public function editNoveltyType($id)
    {
        $noveltyType = Subdomain::findOrFail($id);
        $this->editingNoveltyTypeId = $id;
        $this->editingNoveltyTypeName = $noveltyType->subdomain;


        // Cargar datos asociados
        $this->selectedData = DataNoveltyType::where('novelty_type_id', $id)->pluck('data_id')->toArray();
        
        // Cargar roles asociados
        $this->selectedRoles = ReportTypeRole::where('novelty_type_id', $id)->pluck('role_id')->toArray();

        $this->dispatch('show-edit-novelty-modal');
        
    }
    public function updateNoveltyType()
    {
        // Validación de los datos
        $validatedData = $this->validate([
            'editingNoveltyTypeName' => 'required|max:100',
            'selectedData' => 'nullable|array',
            'selectedRoles' => 'nullable|array',
        ], [
            'editingNoveltyTypeName.required' => 'El nombre de tipo de novedad es requerido',
            'editingNoveltyTypeName.max' => 'El nombre de tipo de novedad no puede exceder los 100 caracteres',
            'selectedData.array' => 'Los datos seleccionados deben ser un array',
            'selectedRoles.array' => 'Los datos seleccionados deben ser un array',
        ]);

        try {
            DB::beginTransaction(); // Iniciar una transacción

            // Buscar y actualizar el tipo de novedad
            $noveltyType = Subdomain::findOrFail($this->editingNoveltyTypeId);
            $noveltyType->subdomain = $this->editingNoveltyTypeName;
            $noveltyType->save();

            // Actualizar relaciones en DataNoveltyType
            DataNoveltyType::where('novelty_type_id', $this->editingNoveltyTypeId)->delete();

            if (!empty($this->selectedData)) {
                foreach ($this->selectedData as $dataId) {
                    DataNoveltyType::create([
                        'novelty_type_id' => $this->editingNoveltyTypeId,
                        'data_id' => $dataId,
                    ]);
                }
            }
            // Actualizar relaciones en ReportTypeRole
            ReportTypeRole::where('novelty_type_id', $this->editingNoveltyTypeId)->delete();

            if (!empty($this->selectedRoles)) {
                foreach ($this->selectedRoles as $role_id) {
                    ReportTypeRole::create([
                        'novelty_type_id' => $this->editingNoveltyTypeId,
                        'role_id' => $role_id,
                    ]);
                }
            }

            DB::commit(); // Confirmar la transacción

            // Emitir eventos de éxito
            $this->dispatch('success', '¡Tipo de novedad actualizado con éxito!');
            $this->dispatch('hide-modal');
            $this->reset(['editingNoveltyTypeId', 'editingNoveltyTypeName', 'selectedData', 'selectedRoles']);
        } catch (\Exception $e) {
            DB::rollBack(); // Revertir cambios si hay un error 
            
            // Registrar error en el log (opcional para depuración)
            \Log::error('Error al actualizar el tipo de novedad: ' . $e->getMessage());

            // Emitir alerta de error
            $this->dispatch('error', 'Hubo un error al actualizar el tipo de novedad.');
        }
    }
    public function confirmDeleteNovelty($id, $name)
    {
        $this->noveltyTypeIdToDelete = $id;
        $this->noveltyTypeNameToDelete = $name;
    
        // Emitir evento para mostrar el modal
        $this->dispatch('show-delete-modal-novelty');
    }    
    public function deleteNoveltyType()
    {
        try {
            DB::beginTransaction();
    
            $noveltyType = Subdomain::findOrFail($this->noveltyTypeIdToDelete);
    
            // Verificar si el tipo de novedad está relacionado con reportes
            $relatedReports = Report::where('novelty_type_id', $this->noveltyTypeIdToDelete)->exists();
            
            if ($relatedReports) {
                $this->dispatch('warning', 'No se puede eliminar este tipo de novedad porque está asociado a reportes.');
                DB::rollBack();
                return;
            }
    
            $noveltyType->delete();
            DB::commit();
    
            $this->dispatch('success', '¡Tipo de novedad eliminado con éxito!');
            $this->dispatch('hide-delete-modal');
    
            // Resetear variables
            $this->reset(['noveltyTypeIdToDelete', 'noveltyTypeNameToDelete']);
    
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al eliminar el tipo de novedad: '. $e->getMessage());
            $this->dispatch('error', 'Hubo un error al eliminar el tipo de novedad.');
        }
    }    
    public function create_data()
    {
        $this->dispatch('show-create-data-modal');
    }
    public function store_data()
    {
        $this->validate([
            'newDataName' => 'required|max:100',
        ], [
            'newDataName.required' => 'El nombre del dato es obligatorio.',
            'newDataName.max' => 'El nombre no puede exceder los 100 caracteres.',
        ]);

        try {
            DB::transaction(function () {
                Subdomain::create([
                    'domain_id' => getDomainId('report_item'),
                    'subdomain' => $this->newDataName
                ]);

                // Emitir un evento para mostrar la alerta
                $this->dispatch('success', '¡Dato creado con éxito!');
                $this->dispatch('hide-modal');
                // Limpiar variables
                $this->reset(['newDataName']);
                
            });
        } catch (\Exception $e) {
            \Log::error('Error al crear el dato: ' . $e->getMessage());
            $this->dispatch('error', 'Hubo un error al crear el dato.');
        }
    }
    public function edit_data($dataId)
    {
        $this->editData = Subdomain::findOrFail($dataId);
        $this->editingDataId = $dataId;
        $this->editingDataName = $this->editData->subdomain;

        $this->dispatch('show-edit-data-modal');

    }
    public function updateData()
    {
        $this->validate([
            'editingDataName' => 'required|max:100',
        ], [
            'editingDataName.required' => 'El nombre del dato es requerido.',
            'editingDataName.max' => 'El nombre del dato no puede exceder los 100 caracteres.',
        ]);

        try {
            if ($this->editData) {
                DB::transaction(function () {
                    $this->editData->subdomain = $this->editingDataName;
                    $this->editData->save();
                });

                // Emitir eventos de éxito
                $this->dispatch('success', '¡Dato actualizado con éxito!');
                $this->dispatch('hide-modal');

                // Resetear variables solo si todo salió bien
                $this->reset(['editData', 'editingDataId', 'editingDataName']);
            }
        } catch (\Exception $e) {
            \Log::error('Error al actualizar el dato: ' . $e->getMessage());

            // Emitir mensaje de error
            $this->dispatch('error', 'Hubo un error al actualizar el dato.');
        }
    }
    public function confirmDeleteData($id, $name)
    {
        $this->dataIdToDelete = $id;
        $this->dataNameToDelete = $name;
    
        // Emitir evento para mostrar el modal
        $this->dispatch('show-delete-modal-data');
    }
    public function deleteData()
    {
        try {
            // Verificar si el dato está relacionado con algún tipo de novedad
            $relatedNoveltyTypes = DataNoveltyType::where('data_id', $this->dataIdToDelete)->exists();
    
            if ($relatedNoveltyTypes) {
                // Emitir un evento de advertencia si el dato está relacionado
                $this->dispatch('error', 'No se puede eliminar este dato porque está asociado a uno o más tipos de novedad.');
                return;
            }
    
            DB::transaction(function () {
                Subdomain::where('id', $this->dataIdToDelete)->delete();
            });
    
            // Emitir un evento para mostrar la alerta de éxito
            $this->dispatch('success', '!Dato eliminado con éxito!');
            $this->dispatch('hide-delete-modal');
    
            // Resetear variables
            $this->reset(['dataIdToDelete', 'dataNameToDelete']);
            
        } catch (\Exception $e) {
            \Log::error('Error al eliminar el dato: ' . $e->getMessage());
            $this->dispatch('error', 'Hubo un error al eliminar el dato.');
        }
    }
    public function render()
    {
        $noveltyTypes = Subdomain::where('subdomain', 'like', '%'.$this->searchNoveltyType.'%')
            ->Where('domain_id', getDomainId('report_type'))
            ->paginate(10, ['*'], 'noveltyTypesPage') // Nombre único para esta paginación
            ->onEachSide(1)
            ->withQueryString();

        $data = Subdomain::where('subdomain', 'like', '%'.$this->searchData.'%')
            ->Where('domain_id', getDomainId('report_item'))
            ->paginate(10, ['*'], 'dataPage') // Nombre único para esta paginación
            ->onEachSide(1)
            ->withQueryString();

        $roles = Role::all();

        return view('livewire.admin.templates', [
            'noveltyTypes' => $noveltyTypes,
            'data' => $data,
            'roles' => $roles
        ]);
    }

}

