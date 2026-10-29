<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Nilai Akademik</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        .container {
            width: 95%;
            max-width: 1400px;
            margin: 30px auto;
        }

        .header {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        .header p {
            margin: 0;
            color: #777;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
        }

        thead {
            background: #1e3a8a;
            color: white;
        }

        th,
        td {
            padding: 13px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            white-space: nowrap;
        }

        th {
            font-size: 14px;
        }

        td {
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-lulus {
            background: #dcfce7;
            color: #166534;
        }

        .badge-tidak {
            background: #fee2e2;
            color: #991b1b;
        }

        .aksi {
            display: flex;
            gap: 6px;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #777;
        }

        .nilai-akhir {
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Data Nilai Akademik</h1>
        <p>Monitoring perkembangan prestasi akademik siswa</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>

            <ul style="margin-bottom: 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="top-bar">

        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            ← Kembali ke Dashboard
        </a>

        <a href="{{ route('nilai.create') }}" class="btn btn-primary">
            + Tambah Nilai
        </a>

    </div>

    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Mata Pelajaran</th>
                    <th>Tugas</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Nilai Akhir</th>
                    <th>KKM</th>
                    <th>Status</th>
                    <th>Semester</th>
                    <th>Tahun Ajaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($nilais as $nilai)

                    @php
                        $kkm = $nilai->mataPelajaran->kkm ?? 75;
                        $lulus = $nilai->nilai_akhir >= $kkm;
                    @endphp

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $nilai->siswa->nis ?? '-' }}
                        </td>

                        <td>
                            <strong>
                                {{ $nilai->siswa->nama ?? '-' }}
                            </strong>
                        </td>

                        <td>
                            {{ $nilai->mataPelajaran->nama ?? '-' }}
                        </td>

                        <td>
                            {{ number_format($nilai->nilai_tugas, 2) }}
                        </td>

                        <td>
                            {{ number_format($nilai->nilai_uts, 2) }}
                        </td>

                        <td>
                            {{ number_format($nilai->nilai_uas, 2) }}
                        </td>

                        <td>
                            <span class="nilai-akhir">
                                {{ number_format($nilai->nilai_akhir, 2) }}
                            </span>
                        </td>

                        <td>
                            {{ $kkm }}
                        </td>

                        <td>

                            @if($lulus)

                                <span class="badge badge-lulus">
                                    Tuntas
                                </span>

                            @else

                                <span class="badge badge-tidak">
                                    Belum Tuntas
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $nilai->semester }}
                        </td>

                        <td>
                            {{ $nilai->tahun_ajaran }}
                        </td>

                        <td>

                            <div class="aksi">

                                <a
                                    href="{{ route('nilai.edit', $nilai->id) }}"
                                    class="btn btn-warning"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('nilai.destroy', $nilai->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus nilai ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="13" class="empty">

                            <strong>Belum ada data nilai akademik.</strong>

                            <br>

                            Silakan tambahkan nilai siswa terlebih dahulu.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>