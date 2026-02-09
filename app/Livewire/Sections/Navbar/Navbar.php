<?php

namespace App\Livewire\Sections\Navbar;

use App\Models\Import;
use App\Models\User;
use Illuminate\Queue\Failed\FailedJobProviderInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    // Variables - Start //
    public $unreadNotifications;

    public $activeProgressBar = false;

    public $percentage = 0;

    public $imports;

    public $isMaintenance = 0;
    // Variables - End //

    public function render()
    {
        $this->isMaintenance = App::isDownForMaintenance();

        DB::table('failed_jobs')->truncate();
        auth()->user()
            ? ($this->unreadNotifications = auth()->user()->unreadNotifications)
            : ($this->unreadNotifications = []);

        $currentRouteName = request()->route() ? request()->route()->getName() : null;
        $routes = config('help.routes', []);
        $helpViewName = ($currentRouteName && isset($routes[$currentRouteName]))
            ? $routes[$currentRouteName]
            : 'default';

        return view('livewire.sections.navbar.navbar', [
            'currentRouteName' => $currentRouteName,
            'helpViewName' => $helpViewName,
        ]);
    }

    #[On('refreshNotifications')]
    public function refresh()
    {
        $this->unreadNotifications = auth()->user()->unreadNotifications;
    }

    #[On('activeProgressBar')]
    public function updateProgressBar()
    {
        $failedJobs = app(FailedJobProviderInterface::class)->all();

        if (! $failedJobs) {
            $this->activeProgressBar = true;

            $import_data = Import::latest()->first();
            if ($import_data->status == 'processing') {
                if ($import_data->total > 0) {
                    $this->percentage = round($import_data->current / ($import_data->total / 100));
                }
            } else {
                session()->flash('success', __('Imported Successfully!'));
                $this->percentage = 100;
                $this->activeProgressBar = false;
            }
        } else {
            session()->flash('error', 'Error Occurred, ' . count($failedJobs) . ' Job Failed, Check Log File!');
            $this->activeProgressBar = false;
        }
    }

    public function markNotificationAsRead($notificationId)
    {
        $notification = Auth::user()
            ->unreadNotifications->where('id', $notificationId)
            ->first();
        if ($notification) {
            $notification->markAsRead();
        }
        $this->dispatch('refreshNotifications')->self();
    }

    public function markAllNotificationsAsRead()
    {
        $user = User::find(auth()->user()->id);

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
    }

    public function turnMaintenanceModeOff()
    {
        if (App::isDownForMaintenance() == 1) {
            Artisan::call('up');
            Log::info('Maintenance mode has been suspended.');

            return redirect()->to('/');
        }
    }

    public function turnMaintenanceModeOn()
    {
        if (App::isDownForMaintenance() != 1) {
            Artisan::call('down');
            Log::info('Maintenance mode turned on.');

            return redirect()->to('/');
        }
    }
}
