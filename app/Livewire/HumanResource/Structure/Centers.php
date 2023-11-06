<?php

namespace App\Livewire\HumanResource\Structure;

use App\Models\Center;
use App\Models\Timeline;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Centers extends Component
{
    // Variables - Start //
    public $centers = [];

    public $center;

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $start_work_hour;

    #[Rule('required')]
    public $end_work_hour;

    #[Rule('required')]
    public $weekends;

    public $is_edit = false;

    public $confirmedId;
    // Variables - End //

    public function render()
    {
        $this->centers = Center::all();

        return view('livewire.human-resource.structure.centers');
    }

    public function submitCenter()
    {
        $this->is_edit ? $this->editCenter() : $this->addCenter();
    }

    public function addCenter()
    {
        $this->validate();

        Center::create([
            'name' => $this->name,
            'start_work_hour' => $this->start_work_hour,
            'end_work_hour' => $this->end_work_hour,
            'weekends' => $this->weekends,
        ]);

        $this->dispatch('closeModal', elementId: '#centerModal');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
    }

    public function editCenter()
    {
        $this->validate();

        $this->center->update([
            'name' => $this->name,
            'start_work_hour' => $this->start_work_hour,
            'end_work_hour' => $this->end_work_hour,
            'weekends' => $this->weekends,
        ]);

        $this->dispatch('closeModal', elementId: '#centerModal');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');

        $this->reset();
    }

    public function confirmDeleteCenter($id)
    {
        $this->confirmedId = $id;
    }

    public function deleteCenter(Center $center)
    {
        $center->delete();
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
    }

    public function showNewCenterModal()
    {
        $this->reset();
    }

    public function showEditCenterModal(Center $center)
    {
        $this->reset();
        $this->is_edit = true;

        $this->center = $center;

        $this->name = $center->name;
        $this->start_work_hour = $center->start_work_hour;
        $this->end_work_hour = $center->end_work_hour;
        $this->weekends = $center->weekends;
    }

    public function getSupervisor($id)
    {
        //
    }

    public function getMembersCount($center_id)
    {
        return Timeline::where('center_id', $center_id)->whereNull('end_date')->distinct('employee_id')->count();
    }

    public function getDaysName($weekends)
    {
        $daysName = [];
        foreach ($weekends as $day) {
            array_push($daysName, mb_substr(Carbon::now()->startOfWeek()->addDays($day)->format('l'), 0, 3));
        }

        return implode(', ', $daysName);
    }
}
