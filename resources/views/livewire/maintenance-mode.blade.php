@section('title', __('Under Maintenance'))

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8">
      <div class="card shadow-sm text-center">
        <div class="card-body">
          <h1 class="h3 mb-3">{{ __('Under Maintenance!') }}</h1>
          <p class="">{{ __('We apologize for the inconvenience. The page is scheduled for a refined refresh in:') }}</p>
          <button type="button" class="btn btn-xl btn-outline-warning waves-effect mb-3" id="timer" disabled>00:15:00:0</button>
          <hr>
          {{-- <p class="text-muted mt-3 small">لا تزال ميزة الرسائل الجماعية فعالة لضمان استمرارية العمل دون اي انقطاع.</p> --}}
          <p class="text-muted mt-3 small">{{ __('If you need to access specific functions during maintenance, contact the IT department.') }}</p>
        </div>
      </div>
    </div>
  </div>
</div>

@push('custom-scripts')
  <script>
    let totalMilliseconds = 900000;
    const timerElement = document.getElementById('timer');

    const countdown = setInterval(() => {
        let hours = Math.floor(totalMilliseconds / (1000 * 3600));
        let minutes = Math.floor((totalMilliseconds % (1000 * 3600)) / (1000 * 60));
        let seconds = Math.floor((totalMilliseconds % (1000 * 60)) / 1000);
        let milliseconds = totalMilliseconds % 1000;

        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        let milliDisplay = Math.floor(milliseconds / 100);

        timerElement.textContent = `${hours}:${minutes}:${seconds}.${milliDisplay}`;

        if (totalMilliseconds <= 0) {
            clearInterval(countdown);
                  window.location.reload();
        }

        totalMilliseconds -= 100;
    }, 100);
  </script>
@endpush
