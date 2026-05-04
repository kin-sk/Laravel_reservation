<h1>予約一覧（管理者）</h1>

<table>
    <tr>
        <th>ユーザー</th>
        <th>日付</th>
        <th>内容</th>
    </tr>

    @foreach($reservations as $reservation)
        <tr>
            <td>{{ $reservation->user->name }}</td>
            <td>{{ $reservation->timeSlot->start_time }}</td>
            <td>予約</td>
        </tr>
    @endforeach
</table>