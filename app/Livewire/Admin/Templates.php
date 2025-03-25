<?php

namespace App\Livewire\Admin;

use App\Models\Subdomain;
use App\Models\DataNoveltyType;
use Livewire\Component;
use Livewire\WithPagination;

class Templates extends Component
{
    use WithPagination;

    public $searchNoveltyType, $searchData;
    public $tab = null;
    public $tabname = 'novelty_types';
    protected $queryString = ['tab'=>['keep'=>true]];
    protected $paginationTheme="bootstrap";

    public $editingNoveltyTypeId, $editingNoveltyTypeName, $selectedData = [];
    public $dataModal;

    public $editingDataId, $editingDataName;
    public $editData;
    public $selectedNoveltyType;

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

    public function editNoveltyType($id)
    {
        $noveltyType = Subdomain::findOrFail($id);
        $this->editingNoveltyTypeId = $id;
        $this->editingNoveltyTypeName = $noveltyType->subdomain;


        // Cargar datos asociados
        $this->selectedData = DataNoveltyType::where('novelty_type_id', $id)->pluck('data_id')->toArray();

        $this->dispatch('show-edit-novelty-modal');
        
    }
    public function updateNoveltyType()
    {
        $noveltyType = Subdomain::findOrFail($this->editingNoveltyTypeId);
        $noveltyType->subdomain = $this->editingNoveltyTypeName;
        $noveltyType->save();

        // Actualizar relaciones en DataNoveltyType
        DataNoveltyType::where('novelty_type_id', $this->editingNoveltyTypeId)->delete();
        foreach ($this->selectedData as $dataId) {
            DataNoveltyType::create([
                'novelty_type_id' => $this->editingNoveltyTypeId,
                'data_id' => $dataId,
            ]);
        }

        // Emitir un evento para mostrar la alerta
        $this->dispatch('success', '¡Tipo de novedad actualizado con éxito!');

        // Disparar evento para cerrar el modal
        $this->dispatch('hide-modal');
        // Resetear valores
        $this->reset(['editingNoveltyTypeId', 'editingNoveltyTypeName', 'selectedData']);
        
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
        if ($this->editData) {
            $this->editData->subdomain = $this->editingDataName;
            $this->editData->save();
        }
    
        // Emitir un evento para mostrar la alerta
        $this->dispatch('success', '¡Dato actualizado con éxito!');

        // Cerrar el modal
        $this->dispatch('hide-modal');
    
        // Limpiar variables
        $this->reset(['editData', 'editingDataId', 'editingDataName']);

               
    }

    public function render()
    {
        $noveltyTypes = Subdomain::where('subdomain', 'like', '%'.$this->searchNoveltyType.'%')
                    ->Where('domain_id', getDomainId('report_type'))
                    ->paginate(10);

        $data = Subdomain::where('subdomain', 'like', '%'.$this->searchData.'%')
                ->Where('domain_id', getDomainId('report_item'))
                ->paginate(10);

        return view('livewire.admin.templates', [
            'noveltyTypes' => $noveltyTypes,
            'data' => $data
        ]);
    }
}

