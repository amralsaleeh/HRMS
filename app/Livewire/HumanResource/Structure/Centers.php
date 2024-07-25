<?php

namespace App\Livewire\HumanResource\Structure;

use App\Models\Center;
use App\Models\Timeline;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Centers extends Component
{
    // TODO: Show supervisor name beside each center in the table.
    // FIXME: Weekends input (select2) doesn't turn red on validation error.
    // FIXME: Weekends input (select2) doesn't display previously entered values visually when click on edit center.

    // Variables - Start //
    public $centers = [];

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $startWorkHour;

    #[Rule('required')]
    public $endWorkHour;

    #[Rule('required')]
    public $weekends;

    public $center;

    public $isEdit = false;

    public $confirmedId;
    // Variables - End //

    public function render()
    {
        $this->centers = Center::all();

        return view('livewire.human-resource.structure.centers');
    }

    public function submitCenter()
    {
        $this->isEdit ? $this->editCenter() : $this->addCenter();
    }

    public function addCenter()
    {
        $this->validate();

        Center::create([
            'name' => $this->name,
            'start_work_hour' => $this->startWorkHour,
            'end_work_hour' => $this->endWorkHour,
            'weekends' => $this->weekends,
        ]);

        $this->dispatch('closeModal', elementId: '#centerModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function editCenter()
    {
        $this->validate();

        $this->center->update([
            'name' => $this->name,
            'start_work_hour' => $this->startWorkHour,
            'end_work_hour' => $this->endWorkHour,
            'weekends' => $this->weekends,
        ]);

        $this->dispatch('closeModal', elementId: '#centerModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));

        $this->reset();
    }

    public function confirmDeleteCenter($id)
    {
        $this->confirmedId = $id;
    }

    public function deleteCenter(Center $center)
    {
        $center->delete();
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function showNewCenterModal()
    {
        $this->reset();
    }

    public function showEditCenterModal(Center $center)
    {
        $this->reset();
        $this->isEdit = true;

        $this->center = $center;

        $this->name = $center->name;
        $this->startWorkHour = $center->start_work_hour;
        $this->endWorkHour = $center->end_work_hour;
        $this->weekends = $center->weekends;
    }

    public function getSupervisor($id)
    {
        //
    }

    public function getMembersCount($center_id)
    {
        return Timeline::where('center_id', $center_id)
            ->whereNull('end_date')
            ->distinct('employee_id')
            ->count();
    }

    public function getDaysName($weekends)
    {
        $daysName = [];
        foreach ($weekends as $day) {
            array_push(
                $daysName,
                mb_substr(
                    Carbon::now()
                        ->startOfWeek()
                        ->addDays($day)
                        ->format('l'),
                    0,
                    3
                )
            );
        }

        return implode(', ', $daysName);
    }
}
