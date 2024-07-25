<?php

namespace App\Livewire\Assets;

use App\Models\Asset;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Inventory extends Component
{
    use WithPagination;

    // 👉 Variables
    public $search_term = null;

    public $asset;

    #[Rule('required')]
    public $assetId;

    #[Rule('required')]
    public $oldId;

    public $serialNumber;

    public $description;

    #[Rule('required')]
    public $status;

    #[Rule('required')]
    public $inService;

    public $realPrice;

    public $expectedPrice;

    #[Rule('required')]
    public $acquisitionDate;

    #[Rule('required')]
    public $acquisitionType;

    #[Rule('required')]
    public $fundedBy;

    public $note;

    public $isEdit = false;

    public $confirmedId;

    public $colors = [
        'Good' => 'success',
        'Fine' => 'primary',
        'Bad' => 'warning',
        'Damaged' => 'danger',
    ];

    public function render()
    {
        $assets = Asset::where('id', 'like', '%'.$this->search_term.'%')
            ->orWhere('old_id', 'like', '%'.$this->search_term.'%')
            ->orWhere('serial_number', 'like', '%'.$this->search_term.'%')
            ->paginate(6);

        return view('livewire.assets.inventory', [
            'assets' => $assets,
        ]);
    }

    public function submitAsset()
    {
        $this->isEdit ? $this->editAsset() : $this->addAsset();
    }

    public function showNewAssetModal()
    {
        $this->reset(
            'isEdit',
            'assetId',
            'oldId',
            'description',
            'status',
            'inService',
            'realPrice',
            'expectedPrice',
            'acquisitionDate',
            'acquisitionType',
            'fundedBy',
            'note'
        );
    }

    public function addAsset()
    {
        // $this->validate();
        Asset::create([
            'id' => $this->assetId,
            'old_id' => $this->oldId,
            'description' => $this->description,
            'status' => $this->status,
            'in_service' => $this->inService,
            'real_price' => $this->realPrice,
            'expected_price' => $this->expectedPrice,
            'acquisition_date' => $this->acquisitionDate,
            'acquisition_type' => $this->acquisitionType,
            'funded_by' => $this->fundedBy,
            'note' => $this->note,
        ]);

        $this->dispatch('closeModal', elementId: '#assetModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function showEditAssetModal(Asset $asset)
    {
        $this->reset(
            'isEdit',
            'assetId',
            'oldId',
            'description',
            'status',
            'inService',
            'realPrice',
            'expectedPrice',
            'acquisitionDate',
            'acquisitionType',
            'fundedBy',
            'note'
        );
        $this->isEdit = true;
        $this->asset = $asset;
        $this->assetId = $asset->id;
        $this->oldId = $asset->old_id;
        $this->description = $asset->description;
        $this->status = $asset->status;
        $this->inService = $asset->in_service;
        $this->realPrice = $asset->real_price;
        $this->expectedPrice = $asset->expectedPrice;
        $this->acquisitionDate = $asset->acquisition_date;
        $this->acquisitionType = $asset->acquisition_type;
        $this->fundedBy = $asset->funded_by;
        $this->note = $asset->note;
    }

    public function editAsset()
    {
        // $this->validate();
        $this->asset->update([
            'id' => $this->assetId,
            'old_id' => $this->oldId,
            'description' => $this->description,
            'status' => $this->status,
            'in_service' => $this->inService,
            'real_price' => $this->realPrice,
            'expected_price' => $this->expectedPrice,
            'acquisition_date' => $this->acquisitionDate,
            'acquisition_type' => $this->acquisitionType,
            'funded_by' => $this->fundedBy,
            'note' => $this->note,
        ]);

        $this->dispatch('closeModal', elementId: '#assetModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));

        $this->reset(
            'isEdit',
            'assetId',
            'oldId',
            'description',
            'status',
            'inService',
            'realPrice',
            'expectedPrice',
            'acquisitionDate',
            'acquisitionType',
            'fundedBy',
            'note'
        );
    }

    public function confirmDeleteAsset($asset)
    {
        $this->confirmedId = $asset['id'];
    }

    public function deleteAsset(Asset $asset)
    {
        $asset->delete();
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }
}
