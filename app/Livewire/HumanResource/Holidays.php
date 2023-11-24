<?php

namespace App\Livewire\HumanResource;

use App\Models\Holiday;
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
    public $fromDate;

    #[Rule('required')]
    public $toDate;

    #[Rule('required')]
    public $note;

    public $holiday;

    public $isEdit = false;

    public $confirmedId;
    // Variables - End //

    public function render()
    {
        $holidays = Holiday::paginate(10);

        return view('livewire.human-resource.holidays', [
            'holidays' => $holidays,
        ]);
    }

    public function submitHoliday()
    {
        $this->isEdit ? $this->editHoliday() : $this->addHoliday();
    }

    public function addHoliday()
    {
        $this->validate();

        Holiday::create([
            'name' => $this->name,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate,
            'note' => $this->note,
        ]);

        $this->dispatch('closeModal', elementId: '#holidayModal');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
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

        $this->dispatch('closeModal', elementId: '#holidayModal');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');

        $this->reset();
    }

    public function confirmDeleteHoliday($id)
    {
        $this->confirmedId = $id;
    }

    public function deleteHoliday(Holiday $holiday)
    {
        $holiday->delete();
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
    }

    public function showNewHolidayModal()
    {
        $this->reset();
    }

    public function showEditHolidayModal(Holiday $holiday)
    {
        $this->reset();
        $this->isEdit = true;

        $this->holiday = $holiday;

        $this->name = $holiday->name;
        $this->fromDate = $holiday->from_date;
        $this->toDate = $holiday->to_date;
        $this->note = $holiday->note;
    }
}
