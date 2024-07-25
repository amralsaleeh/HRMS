<?php

namespace App\Livewire\HumanResource;

use App\Models\Center;
use App\Models\Holiday;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Holidays extends Component
{
    use WithPagination;

    // Variables - Start //
    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $centers = [];

    #[Rule('required')]
    public $fromDate;

    #[Rule('required')]
    public $toDate;

    public $note;

    public $holiday;

    public $isEdit = false;

    public $confirmedId;
    // Variables - End //

    public function render()
    {
        $holidays = Holiday::with('centers')->paginate(10);
        // $centers = Center::pluck('name', 'id')->all();

        return view('livewire.human-resource.holidays', [
            'holidays' => $holidays,
            // 'centers' => $centers,
        ]);
    }

    public function mount()
    {
        $this->centers = Center::pluck('name', 'id');
    }

    public function submitHoliday()
    {
        $this->isEdit ? $this->editHoliday() : $this->addHoliday();
    }

    public function addHoliday()
    {
        $this->validate();

        $holiday = Holiday::create([
            'name' => $this->name,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate,
            'note' => $this->note,
        ]);

        $holiday->centers()->attach($this->centers, [
            'created_by' => Auth::user()->name,
            'updated_by' => Auth::user()->name,
        ]);

        $this->dispatch('closeModal', elementId: '#holidayModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function editHoliday()
    {
        $this->validate();

        $this->holiday->update([
            'name' => $this->name,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate,
            'note' => $this->note,
        ]);

        $this->holiday->centers()->syncWithPivotValues($this->centers, [
            'created_by' => Auth::user()->name,
            'updated_by' => Auth::user()->name,
        ]);

        $this->dispatch('closeModal', elementId: '#holidayModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));

        $this->reset('isEdit', 'name', 'centers', 'fromDate', 'toDate', 'note');
    }

    public function confirmDeleteHoliday($id)
    {
        $this->confirmedId = $id;
    }

    public function deleteHoliday(Holiday $holiday)
    {
        $holiday->delete();
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function showNewHolidayModal()
    {
        $this->reset('isEdit', 'name', 'centers', 'fromDate', 'toDate', 'note');
    }

    public function showEditHolidayModal(Holiday $holiday)
    {
        $this->reset('isEdit', 'name', 'centers', 'fromDate', 'toDate', 'note');
        $this->isEdit = true;
        $this->holiday = $holiday;
        $this->name = $holiday->name;
        // $this->center_id = $holiday->centers->pluck('id')->first();
        $this->centers = $holiday->centers->pluck('id')->toArray();
        $this->fromDate = $holiday->from_date;
        $this->toDate = $holiday->to_date;
        $this->note = $holiday->note;
        // $this->dispatchBrowserEvent('openEditHolidayModal');
    }
}
