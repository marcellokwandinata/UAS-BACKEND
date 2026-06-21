<h1>Tabungan Saya</h1>
<a href="{{ route('saving.create') }}">Buat Tabungan Baru</a>
<br><br>
@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif
@if($savings->isEmpty())
    <p>Belum ada tabungan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Tabungan</th>
            <th>Target</th>
            <th>Terkumpul</th>
            <th>Progress</th>
        </tr>
        </thead>
        <tbody>
        @foreach($savings as $saving)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><a href="{{ route('saving.show', $saving->id) }}">{{ $saving->saving_name }}</a></td>
            <td>Rp {{ number_format($saving->target_amount, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($saving->current_amount, 0, ',', '.') }}</td>
            <td>
            @if($saving->target_amount > 0)
            {{ round(($saving->current_amount / $saving->target_amount) * 100, 1) }}%
            @else
            0%
            @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endif