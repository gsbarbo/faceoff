<div class="absolute right-9 z-50 top-9">
    @if (session()->has('alerts'))
        @foreach (session('alerts') as $alert)
            <x-alert :level="$alert['level']" :message="$alert['message']"/>
        @endforeach

        @php
            session()->forget('alerts'); // <-- remove after rendering
        @endphp

    @endif
</div>