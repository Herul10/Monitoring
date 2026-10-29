<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Absensi Siswa - SI Monitoring</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #172033;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 6px;
        }

        .header p {
            color: #64748b;
        }

        .back {
            text-decoration: none;
            background: #0f172a;
            color: white;
            padding: 11px 18px;
            border-radius: 8px;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
        }

        .info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .info-box {
            background: #f8fafc;
            padding: 18px;
            border-radius: 10px;
        }

        .info-box small {
            display: block;
            color: #64748b;
            margin-bottom: 6px;
        }

        .info-box strong {
            font-size: 17px;
        }

        .absen-area {
            text-align: center;
            padding: 25px;
            background: #eff6ff;
            border-radius: 12px;
        }

        .absen-area h2 {
            margin-bottom: 10px;
        }

        .absen-area p {
            color: #64748b;
            margin-bottom: 20px;
        }

        .btn-absen {
            border: none;
            background: #2563eb;
            color: white;
            padding: 14px 30px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-absen:hover {
            background: #1d4ed8;
        }

        .btn-absen:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }

        .status {
            padding: 15px;
            border-radius: 10px;
            background: #dcfce7;
            color: #166534;
            margin-top: 15px;
        }

        .error {
            padding: 15px;
            border-radius: 10px;
            background: #fee2e2;
            color: #991b1b;
            margin-bottom: 20px;
        }

        .success {
            padding: 15px;
            border-radius: 10px;
            background: #dcfce7;
            color: #166534;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 13px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background: #f8fafc;
            color: #475569;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
            font-weight: bold;
        }

        .coordinate {
            font-size: 12px;
            color: #64748b;
        }

        @media (max-width: 768px) {
            .info {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            table {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <div>
            <h1>Absensi Siswa</h1>
            <p>Sistem Monitoring Kehadiran Siswa</p>
        </div>

        <a href="{{ route('dashboard') }}" class="back">
            ← Dashboard
        </a>
    </div>


    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif


    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif


    <div class="card">

        <div class="info">

            <div class="info-box">
                <small>NIS</small>
                <strong>{{ $siswa->nis }}</strong>
            </div>

            <div class="info-box">
                <small>Nama Siswa</small>
                <strong>{{ $siswa->nama }}</strong>
            </div>

            <div class="info-box">
                <small>Kelas</small>
                <strong>
                    {{ $siswa->kelas->nama_kelas ?? '-' }}
                </strong>
            </div>

        </div>


        @if (!$kehadiranHariIni)

            <div class="absen-area">

                <h2>Absensi Hari Ini</h2>

                <p>
                    Klik tombol di bawah untuk melakukan absensi.
                    Sistem akan mengambil lokasi GPS Anda.
                </p>

                <form
                    id="formAbsensi"
                    action="{{ route('kehadiran.store') }}"
                    method="POST"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="latitude"
                        id="latitude"
                    >

                    <input
                        type="hidden"
                        name="longitude"
                        id="longitude"
                    >

                    <button
                        type="button"
                        class="btn-absen"
                        id="btnAbsensi"
                        onclick="ambilLokasi()"
                    >
                        📍 Absen Sekarang
                    </button>

                </form>

                <p id="statusLokasi"></p>

            </div>

        @else

            <div class="status">

                <strong>
                    ✓ Anda sudah melakukan absensi hari ini.
                </strong>

                <br><br>

                Tanggal:
                {{ $kehadiranHariIni->tanggal }}

                <br>

                Jam:
                {{ $kehadiranHariIni->jam }}

                <br>

                Status:
                {{ $kehadiranHariIni->status }}

            </div>

        @endif

    </div>


    <div class="card">

        <h2 style="margin-bottom: 20px;">
            Riwayat Kehadiran
        </h2>

        <div style="overflow-x:auto;">

            <table>

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Status</th>
                        <th>Koordinat GPS</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($riwayat as $index => $item)

                        <tr>

                            <td>
                                {{ $index + 1 }}
                            </td>

                            <td>
                                {{ $item->tanggal }}
                            </td>

                            <td>
                                {{ $item->jam }}
                            </td>

                            <td>
                                <span class="badge">
                                    {{ $item->status }}
                                </span>
                            </td>

                            <td>

                                <div class="coordinate">
                                    Latitude:
                                    {{ $item->latitude ?? '-' }}
                                </div>

                                <div class="coordinate">
                                    Longitude:
                                    {{ $item->longitude ?? '-' }}
                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" style="text-align:center;">
                                Belum ada riwayat kehadiran.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<script>

function ambilLokasi() {

    const tombol = document.getElementById('btnAbsensi');
    const status = document.getElementById('statusLokasi');

    if (!navigator.geolocation) {

        status.innerHTML =
            'Browser Anda tidak mendukung GPS/geolocation.';

        return;
    }

    tombol.disabled = true;
    tombol.innerText = '📍 Mengambil Lokasi...';

    status.innerHTML =
        'Mohon izinkan akses lokasi pada browser Anda...';


    navigator.geolocation.getCurrentPosition(

        function(position) {

            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;

            status.innerHTML =
                '✓ Lokasi berhasil diperoleh. Menyimpan absensi...';

            document.getElementById('formAbsensi').submit();
        },

        function(error) {

            tombol.disabled = false;
            tombol.innerText = '📍 Absen Sekarang';

            if (error.code === 1) {

                status.innerHTML =
                    'Akses lokasi ditolak. Silakan izinkan lokasi pada browser.';

            } else if (error.code === 2) {

                status.innerHTML =
                    'Lokasi tidak dapat ditemukan. Pastikan GPS/lokasi perangkat aktif.';

            } else if (error.code === 3) {

                status.innerHTML =
                    'Waktu mengambil lokasi habis. Silakan coba lagi.';

            } else {

                status.innerHTML =
                    'Terjadi kesalahan saat mengambil lokasi.';
            }
        },

        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }

    );
}

</script>

</body>

</html>