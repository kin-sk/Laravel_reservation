<x-app-layout>
    <div class="py-12 text-center">
        <h1 class="text-2xl font-bold mb-6">予約内容の確認</h1>

        <div class="mb-6">
            <p>日時：</p>
            <p class="text-xl font-bold">
                {{ $slot->start_time->format('Y年n月j日 H:i') }}
            </p>
        </div>

        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf
            <input type="hidden" name="time_slot_id" value="{{ $slot->id }}">

            <button class="bg-blue-600 text-white px-6 py-3 rounded">
                この内容で予約する
            </button>
        </form>

        <div class="mt-4">
            <a href="{{ url()->previous() }}" class="text-gray-500">
                戻る
            </a>
        </div>
    </div>
</x-app-layout>