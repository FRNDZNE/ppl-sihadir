<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        h3 {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <h3>Jadwal Perkuliahan Semester {{ $jadwals->first()->semester->nama ?? '' }}</h3>

    <table>
        <thead>
            <tr>
                <th>Kelas</th>
                <th>Hari</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Ruang</th>
                <th>Jam</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwals as $j)
                <tr>
                    <td>{{ $j->kelas->name }}</td>
                    <td>{{ $j->day->name }}</td>
                    <td>{{ $j->matkul->name }}</td>
                    <td>{{ $j->dosen->name }}</td>
                    <td>{{ $j->ruang->name }}</td>
                    <td>
                        @foreach ($j->jam as $jam)
                            {{ $jam->awal }} - {{ $jam->akhir }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
