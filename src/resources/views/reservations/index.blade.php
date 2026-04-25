<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('予約日を選択してください') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl p-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-blue-900">{{ $viewDate->format('Y年 n月') }}</h2>
                </div>

                <div class="grid grid-cols-7 gap-2 text-center font-bold text-gray-400 mb-4 text-xs uppercase tracking-widest">
                    <div>月</div><div>火</div><div>水</div><div>木</div><div>金</div><div>土</div><div class="text-red-400">日</div>
                </div>

                <div class="grid grid-cols-7 gap-3">
                    @foreach ($dates as $date)
                        @php $isClosed = ($date['day_of_week'] === 0 || $date['day_of_week'] === 3); @endphp
                        
                        {{-- ここがポイント：クリックすると show 画面へ飛ぶようにします --}}
                        <a href="{{ route('reservations.show', $date['date']) }}" 
                            class="h-20 flex flex-col items-center justify-center border-2 rounded-2xl transition-all duration-200
                            {{ !$date['is_current_month'] ? 'bg-gray-50 text-gray-200 border-transparent' : 'border-gray-50 bg-white hover:border-blue-200 hover:shadow-md' }}
                            {{ $date['is_today'] ? 'ring-2 ring-blue-400 ring-offset-2' : '' }}
                            {{ $isClosed ? 'text-red-300 bg-red-50/50' : '' }}
                            ">
                            <span class="text-lg font-bold">{{ $date['day'] }}</span>
                            @if($isClosed) <span class="text-[10px] font-black">休診</span> @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>