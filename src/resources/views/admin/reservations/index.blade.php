<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            予約一覧（管理者）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- 成功メッセージ --}}
            @if(session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow sm:rounded-lg p-6">
                <table class="min-w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">ユーザー</th>
                            <th class="px-4 py-2 border">時間</th>
                            <th class="px-4 py-2 border">ステータス</th>
                            <th class="px-4 py-2 border">操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td class="px-4 py-2 border">
                                    {{ $reservation->user->name }}
                                </td>

                                <td class="px-4 py-2 border">
                                    {{ $reservation->timeSlot->start_time }}
                                </td>

                                <td class="px-4 py-2 border">
                                    {{ $reservation->status }}
                                </td>

                                <td class="px-4 py-2 border">
                                    {{-- キャンセルボタン --}}
                                    @if($reservation->status !== 'cancelled')
                                        <form method="POST" action="{{ route('admin.reservations.cancel', $reservation->id) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('キャンセルしますか？')">
                                                キャンセル
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">キャンセル済</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>