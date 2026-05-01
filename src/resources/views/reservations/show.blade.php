<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ \Carbon\Carbon::parse($selectedDate)->format('Y年n月j日') }} の予約枠
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- 戻るボタン -->
            <div class="mb-6">
                <a href="{{ route('reservations.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    カレンダーに戻る
                </a>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-8">
                <h3 class="text-2xl font-bold mb-8 text-gray-800 text-center border-b pb-4">ご希望の時間を選択してください</h3>

                @if($timeSlots->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-400 text-lg italic">申し訳ありません。この日の予約枠はございません。</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach ($timeSlots as $slot)
                            <div class="flex items-center justify-between border-2 border-gray-50 p-6 rounded-2xl hover:border-blue-100 hover:bg-blue-50/50 transition-all shadow-sm">
                                <span class="text-2xl font-bold text-gray-700">
                                    {{ $slot->start_time->format('H:i') }}
                                </span>
                                @if ($slot->reservations_count > 0)
                                {{-- 予約済 --}}
                                <span class="text-gray-400">予約済</span>
                                @else
                                    {{-- ログイン状態によってボタンの挙動を変える --}}
                                    @auth
                                        <form method="POST" action="{{ route('reservations.confirm') }}">
                                            @csrf
                                            <input type="hidden" name="time_slot_id" value="{{ $slot->id }}">
                                            <button class="bg-blue-600 text-white px-8 py-3 rounded-full">
                                                予約
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="bg-gray-800 hover:bg-black text-white px-8 py-3 rounded-full text-sm font-bold shadow-lg transition-transform active:scale-95">
                                            ログインして予約
                                        </a>
                                    @endauth
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>