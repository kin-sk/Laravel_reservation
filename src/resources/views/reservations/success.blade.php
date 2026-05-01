<x-app-layout>
    <div class="py-12 text-center">
        <h1 class="text-3xl font-bold text-green-600 mb-4">
            予約が完了しました！
        </h1>

        <p class="mb-6 text-gray-600">
            ご予約ありがとうございます。
        </p>

        <a href="{{ route('reservations.index') }}"
          class="bg-blue-600 text-white px-6 py-3 rounded-full">
            カレンダーへ戻る
        </a>
    </div>
</x-app-layout>