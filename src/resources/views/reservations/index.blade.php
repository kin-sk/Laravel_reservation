<x-app-layout>
    <x-slot name="header">
        <h2>予約画面</h2>
    </x-slot>

    <div class="p-4">
        @foreach ($timeSlots as $slot)
            <div>
                {{ $slot->date }} 
                {{ $slot->start_time }} - {{ $slot->end_time }}
            </div>
        @endforeach
    </div>
</x-app-layout>