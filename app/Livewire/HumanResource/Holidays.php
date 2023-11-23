<?php

namespace App\Livewire\HumanResource;

use App\Models\Holiday;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Holidays extends Component
{
    public $holidays = [];

    public $holiday;

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $from_date;

    #[Rule('required')]
    public $to_date;

    #[Rule('required')]
    public $note;

    public $is_edit = false;

    public $confirmedId;

    public function render()
    {

        $this->holidays = Holiday::all();

        return view('livewire.human-resource.holidays');
    }

    public function submitHoliday()
    {
        $this->is_edit ? $this->editHoliday() : $this->addHoliday();
    }

    public function addHoliday()
    {
        $this->validate();

        Holiday::create([
            'name' => $this->name,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
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
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
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
        $this->is_edit = true;

        $this->holiday = $holiday;

        $this->name = $holiday->name;
        $this->from_date = $holiday->from_date;
        $this->to_date = $holiday->to_date;
        $this->note = $holiday->note;
    }
}
