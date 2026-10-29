<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Monitoring Kehadiran</title>

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #172033;
        }

        .container {
            max-width: 1400px;
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
            margin-bottom: 8px;
        }

        .header p {
            color: #64748b;
        }

        .btn-dashboard {
            background: #0f172a;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
        }

        .filter {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,.05);
        }

        .filter form {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: bold;
            color: #475569;
        }

        .form-group input,
        .form-group select {
            min-width: 200px;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }

        .btn-filter {
            border: none;
            background: #2563eb;
            color: white;
            padding: 11px 20px;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-reset {
            background: #64748b;
            color: white;
            padding: 11px 20px;
            border-radius: 8px;
            text-decoration: none;
        }

        .map-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,.05);
        }

        .map-card h2 {
            margin-bottom: 15px;
        }

        #map {
            width: 100%;
            height: 450px;
            border-radius: 12px;
        }

        .table-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,.05);
            overflow-x: auto;
        }

        .table-card h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
        }

        th {
            background: #f8fafc;
            color: #475569;
            font-size: 13px;
            text-align: left;
            padding: 14px;
        }

        td {
            padding: 14px;
            border-top: 1px solid #e2e8f0;
            font-size: 14px;
        }

        .status-hadir {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .radius-aman {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .radius-luar {
            display: inline-block;
            background: #fee2e2;
            color: #991b1b;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .gps {
            font-size: 12px;
            line-height: 1.6;
            color: #475569;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #64748b;
        }

        .legend {
            display: flex;
            gap: 20px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .legend-item {
            font-size: 13px;
            color: #475569;
        }

        @media (max-width: 700px) {
            .container {
                padding: 15px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            #map {
                height: 350px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div>
            <h1>Monitoring Kehadiran</h1>
            <p>
                Monitoring lokasi dan kehadiran siswa secara real-time
            </p>
        </div>

        <a
            href="{{ route('dashboard') }}"
            class="btn-dashboard"
        >
            ← Dashboard
        </a>

    </div>


    <!-- FILTER -->
    <div class="filter">

        <form method="GET" action="{{ route('monitoring.kehadiran') }}">

            <div class="form-group">

                <label>Tanggal</label>

                <input
                    type="date"
                    name="tanggal"
                    value="{{ request('tanggal') }}"
                >

            </div>


            <div class="form-group">

                <label>Kelas</label>

                <select name="kelas_id">

                    <option value="">
                        Semua Kelas
                    </option>

                    @foreach ($kelas as $item)

                        <option
                            value="{{ $item->id }}"
                            {{ request('kelas_id') == $item->id ? 'selected' : '' }}
                        >
                            {{ $item->nama_kelas }}
                        </option>

                    @endforeach

                </select>

            </div>


            <button
                type="submit"
                class="btn-filter"
            >
                🔎 Filter
            </button>


            <a
                href="{{ route('monitoring.kehadiran') }}"
                class="btn-reset"
            >
                Reset
            </a>

        </form>

    </div>


    <!-- MAP -->
    <div class="map-card">

        <h2>📍 Peta Monitoring Lokasi</h2>

        <div id="map"></div>

        <div class="legend">

            <div class="legend-item">
                🏫 Lokasi Sekolah
            </div>

            <div class="legend-item">
                📍 Lokasi Absensi Siswa
            </div>

            <div class="legend-item">
                🟢 Radius Absensi 100 Meter
            </div>

        </div>

    </div>


    <!-- TABLE -->
    <div class="table-card">

        <h2>📋 Data Kehadiran Siswa</h2>

        @if ($kehadirans->count() > 0)

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Siswa</th>

                        <th>NIS</th>

                        <th>Kelas</th>

                        <th>Tanggal</th>

                        <th>Jam</th>

                        <th>Status</th>

                        <th>Jarak</th>

                        <th>Status Radius</th>

                        <th>GPS</th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($kehadirans as $index => $kehadiran)

                        <tr>

                            <td>
                                {{ $index + 1 }}
                            </td>


                            <td>
                                <strong>
                                    {{ $kehadiran->siswa->nama ?? '-' }}
                                </strong>
                            </td>


                            <td>
                                {{ $kehadiran->siswa->nis ?? '-' }}
                            </td>


                            <td>
                                {{ $kehadiran->kelas->nama_kelas ?? '-' }}
                            </td>


                            <td>
                                {{ $kehadiran->tanggal }}
                            </td>


                            <td>
                                {{ $kehadiran->jam }}
                            </td>


                            <td>

                                <span class="status-hadir">
                                    {{ $kehadiran->status }}
                                </span>

                            </td>


                            <td>

                                @if ($kehadiran->jarak !== null)

                                    <strong>
                                        {{ number_format($kehadiran->jarak, 0, ',', '.') }}
                                    </strong>
                                    meter

                                @else

                                    -

                                @endif

                            </td>


                            <td>

                                @if ($kehadiran->dalam_radius)

                                    <span class="radius-aman">
                                        ✓ Dalam Radius
                                    </span>

                                @else

                                    <span class="radius-luar">
                                        ✕ Di Luar Radius
                                    </span>

                                @endif

                            </td>


                            <td>

                                @if ($kehadiran->latitude && $kehadiran->longitude)

                                    <div class="gps">

                                        Lat:
                                        {{ $kehadiran->latitude }}

                                        <br>

                                        Long:
                                        {{ $kehadiran->longitude }}

                                    </div>

                                @else

                                    -

                                @endif

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">

                Belum ada data kehadiran.

            </div>

        @endif

    </div>

</div>


<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>

    /*
    |--------------------------------------------------------------------------
    | KOORDINAT SEKOLAH
    |--------------------------------------------------------------------------
    */

    const latitudeSekolah = {{ $latitudeSekolah }};
    const longitudeSekolah = {{ $longitudeSekolah }};

    /*
    |--------------------------------------------------------------------------
    | INISIALISASI MAP
    |--------------------------------------------------------------------------
    */

    const map = L.map('map').setView(
        [latitudeSekolah, longitudeSekolah],
        17
    );


    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(map);


    /*
    |--------------------------------------------------------------------------
    | MARKER SEKOLAH
    |--------------------------------------------------------------------------
    */

    L.marker([
        latitudeSekolah,
        longitudeSekolah
    ])
    .addTo(map)
    .bindPopup(`
        <strong>🏫 SMKS PASUNDAN CIANJUR</strong>
        <br>
        Lokasi Sekolah
        <br>
        Radius Absensi: 100 meter
    `);


    /*
    |--------------------------------------------------------------------------
    | LINGKARAN RADIUS SEKOLAH
    |--------------------------------------------------------------------------
    */

    L.circle(
        [
            latitudeSekolah,
            longitudeSekolah
        ],
        {
            radius: 100,
            fillOpacity: 0.15
        }
    ).addTo(map);


    /*
    |--------------------------------------------------------------------------
    | DATA ABSENSI
    |--------------------------------------------------------------------------
    */

    @php
        $dataKehadiran = $kehadirans->map(function ($item) {
            return [
                'nama' => $item->siswa->nama ?? '-',
                'nis' => $item->siswa->nis ?? '-',
                'kelas' => $item->kelas->nama_kelas ?? '-',
                'tanggal' => $item->tanggal,
                'jam' => $item->jam,
                'status' => $item->status,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
                'jarak' => $item->jarak,
                'dalam_radius' => $item->dalam_radius,
            ];
        })->values();
    @endphp

const dataKehadiran = @json($dataKehadiran);


    /*
    |--------------------------------------------------------------------------
    | MARKER ABSENSI
    |--------------------------------------------------------------------------
    */

    const bounds = [];


    dataKehadiran.forEach(function (data) {

        if (
            data.latitude !== null &&
            data.longitude !== null
        ) {

            const lat = parseFloat(data.latitude);
            const lng = parseFloat(data.longitude);

            const marker = L.marker([lat, lng])
                .addTo(map);


            let statusRadius = data.dalam_radius
                ? '✓ Dalam Radius'
                : '✕ Di Luar Radius';


            marker.bindPopup(`

                <strong>👤 ${data.nama}</strong>

                <br><br>

                <strong>NIS:</strong>
                ${data.nis}

                <br>

                <strong>Kelas:</strong>
                ${data.kelas}

                <br>

                <strong>Tanggal:</strong>
                ${data.tanggal}

                <br>

                <strong>Jam:</strong>
                ${data.jam}

                <br>

                <strong>Status:</strong>
                ${data.status}

                <br>

                <strong>Jarak:</strong>
                ${Math.round(data.jarak)} meter

                <br>

                <strong>Radius:</strong>
                ${statusRadius}

                <br><br>

                <strong>GPS:</strong>

                <br>

                ${lat},
                ${lng}

            `);


            bounds.push([lat, lng]);

        }

    });


    /*
    |--------------------------------------------------------------------------
    | SESUAIKAN ZOOM DENGAN MARKER
    |--------------------------------------------------------------------------
    */

    if (bounds.length > 0) {

        bounds.push([
            latitudeSekolah,
            longitudeSekolah
        ]);

        map.fitBounds(bounds, {
            padding: [40, 40]
        });

    }

</script>

</body>

</html>