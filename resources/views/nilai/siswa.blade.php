<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nilai Saya</title>

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
            max-width: 1200px;
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
        }

        .header p {
            margin: 0;
            color: #777;
        }

        .student-info {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 18px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .student-info p {
            margin: 6px 0;
        }

        .top-bar {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
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
            min-width: 900px;
        }

        thead {
            background: #1e3a8a;
            color: white;
        }

        th,
        td {
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .nilai-akhir {
            font-size: 16px;
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-tuntas {
            background: #dcfce7;
            color: #166534;
        }

        .badge-belum {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #777;
        }

        .ringkasan {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.06);
        }

        .box-title {
            color: #777;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .box-value {
            font-size: 24px;
            font-weight: bold;
        }

        @media (max-width: 700px) {
            .ringkasan {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Nilai Saya</h1>

        <p>
            Informasi perkembangan prestasi akademik Anda
        </p>
    </div>


    <div class="student-info">

        <p>
            <strong>NIS:</strong>
            {{ $siswa->nis }}
        </p>

        <p>
            <strong>Nama:</strong>
            {{ $siswa->nama }}
        </p>

        <p>
            <strong>Kelas:</strong>
            {{ $siswa->kelas->nama_kelas ?? '-' }}
        </p>

    </div>


    @php
        $jumlahNilai = $nilais->count();

        $jumlahTuntas = 0;

        foreach ($nilais as $item) {
            $kkm = $item->mataPelajaran->kkm ?? 75;

            if ($item->nilai_akhir >= $kkm) {
                $jumlahTuntas++;
            }
        }

        $rataRata = $jumlahNilai > 0
            ? $nilais->avg('nilai_akhir')
            : 0;
    @endphp


    <div class="ringkasan">

        <div class="box">

            <div class="box-title">
                Jumlah Mata Pelajaran
            </div>

            <div class="box-value">
                {{ $jumlahNilai }}
            </div>

        </div>


        <div class="box">

            <div class="box-title">
                Rata-rata Nilai
            </div>

            <div class="box-value">
                {{ number_format($rataRata, 2) }}
            </div>

        </div>


        <div class="box">

            <div class="box-title">
                Nilai Tuntas
            </div>

            <div class="box-value">
                {{ $jumlahTuntas }}
            </div>

        </div>

    </div>


    <div class="top-bar">

        <a
            href="{{ route('dashboard') }}"
            class="btn btn-secondary"
        >
            ← Kembali ke Dashboard
        </a>

    </div>


    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Tugas</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Nilai Akhir</th>
                    <th>KKM</th>
                    <th>Status</th>
                    <th>Semester</th>
                    <th>Tahun Ajaran</th>
                </tr>

            </thead>

            <tbody>

                @forelse($nilais as $nilai)

                    @php
                        $kkm = $nilai->mataPelajaran->kkm ?? 75;
                        $tuntas = $nilai->nilai_akhir >= $kkm;
                    @endphp

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <strong>
                                {{ $nilai->mataPelajaran->nama ?? '-' }}
                            </strong>
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

                            @if($tuntas)

                                <span class="badge badge-tuntas">
                                    Tuntas
                                </span>

                            @else

                                <span class="badge badge-belum">
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

                    </tr>

                @empty

                    <tr>

                        <td colspan="10" class="empty">

                            <strong>
                                Belum ada data nilai.
                            </strong>

                            <br>

                            Nilai akademik Anda belum tersedia.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>