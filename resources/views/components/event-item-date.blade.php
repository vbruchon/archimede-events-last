<div class="flex mb-5 items-center">
    {!! $svg !!}

    <p class="p-2 text-lg text-custom-blue font-semibold">{{ $event->date_start }}</p>
    @if ($event->date_end !== $event->date_start)
    <p class="p-2 text-lg text-custom-blue font-semibold">{{ $event->date_end }}</p>
    @endif
    <p class="p-2 text-lg text-custom-blue font-semibold">{{ $event->hours }}</p>
</div>