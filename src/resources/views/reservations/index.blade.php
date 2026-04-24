<h1>予約画面</h1>

<div class="p-4">
    @foreach ($timeSlots as $slot)
        <div class="border p-2 mb-2">
            <div>
                {{ $slot->date }} 
                {{ $slot->start_time }} - {{ $slot->end_time }}
            </div>
            <button class="bg-blue-500 text-white px-2 py-1 mt-2">
                予約する
            </button>
        </div>
    @endforeach
</div>