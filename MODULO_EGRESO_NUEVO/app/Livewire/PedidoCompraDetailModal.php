<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Filament\Resources\PedidoCompraResource;
use Livewire\Attributes\On;

class PedidoCompraDetailModal extends Component
{
    public bool $showModal = false;
    public array $details = [];
    public float $totalGeneral = 0.0;
    public ?string $connectionName = null;
    public ?string $pedi_cod_pedi = null;

    #[On('open-pedido-modal')]
    public function loadDetails(string $pedi_cod_pedi, string $connectionId)
    {
        $this->pedi_cod_pedi = $pedi_cod_pedi;
        $this->connectionName = PedidoCompraResource::getExternalConnectionName($connectionId);

        if ($this->connectionName) {
            $this->details = DB::connection($this->connectionName)
                ->table('saedped')
                ->where('dped_cod_pedi', $this->pedi_cod_pedi)
                ->get()
                ->toArray();

            $this->totalGeneral = collect($this->details)->sum(function ($item) {
                return $item->dped_can_ped * $item->dped_prc_dped;
            });
        }
        
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pedido-compra-detail-modal');
    }
}
