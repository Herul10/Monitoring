<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Sistem Monitoring Sekolah</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f1f5f9;
            color: #172033;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #0f172a, #172554);
            color: white;
            padding: 25px 18px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .brand {
            padding: 5px 12px 25px;
            border-bottom: 1px solid rgba(255,255,255,.1);
            margin-bottom: 20px;
        }

        .brand-title {
            font-size: 20px;
            font-weight: bold;
            color: #60a5fa;
            margin-bottom: 6px;
        }

        .brand-subtitle {
            font-size: 11px;
            color: #94a3b8;
            line-height: 1.5;
        }

        .user-role {
            background: rgba(255,255,255,.08);
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 20px;
        }

        .user-role small {
            display: block;
            color: #94a3b8;
            font-size: 10px;
            margin-bottom: 5px;
        }

        .user-role strong {
            font-size: 13px;
            color: white;
        }

        .menu-title {
            color: #64748b;
            font-size: 10px;
            font-weight: bold;
            margin: 18px 12px 8px;
            text-transform: uppercase;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 5px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 12px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 9px;
            font-size: 13px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(59,130,246,.2);
            color: white;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 15px;
        }

        .logout {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 20px;
        }

        .logout button {
            width: 100%;
            border: none;
            background: #dc2626;
            color: white;
            padding: 11px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 13px;
        }

        .logout button:hover {
            background: #b91c1c;
        }

        /* ================= CONTENT ================= */

        .content {
            flex: 1;
            margin-left: 260px;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .welcome h1 {
            font-size: 28px;
            color: #0f172a;
            margin-bottom: 7px;
        }

        .welcome p {
            color: #64748b;
            font-size: 14px;
        }

        .role-badge {
            background: #dbeafe;
            color: #1d4ed8;
            padding: 9px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        /* ================= INFO ================= */

        .info-box {
            background: white;
            border-radius: 15px;
            padding: 22px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(15,23,42,.05);
            border-left: 5px solid #2563eb;
        }

        .info-box h2 {
            font-size: 17px;
            margin-bottom: 7px;
            color: #0f172a;
        }

        .info-box p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        /* ================= CARDS ================= */

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(15,23,42,.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-title {
            color: #64748b;
            font-size: 12px;
        }

        .card-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .card-value {
            font-size: 28px;
            font-weight: bold;
            color: #0f172a;
        }

        .card-description {
            margin-top: 5px;
            color: #94a3b8;
            font-size: 11px;
        }

        /* ================= PANEL ================= */

        .panel-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .panel {
            background: white;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 5px 20px rgba(15,23,42,.05);
        }

        .panel h3 {
            font-size: 16px;
            color: #0f172a;
            margin-bottom: 15px;
        }

        .panel p {
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
        }

        .quick-menu {
            display: grid;
            gap: 10px;
        }

        .quick-menu a {
            text-decoration: none;
            background: #f8fafc;
            padding: 12px;
            border-radius: 9px;
            color: #334155;
            font-size: 13px;
        }

        .quick-menu a:hover {
            background: #eff6ff;
            color: #2563eb;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 1100px) {

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .panel-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 750px) {

            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;
                padding: 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .topbar {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

        }

    </style>

</head>


<body>

<div class="layout">


    {{-- ================= SIDEBAR ================= --}}

    <aside class="sidebar">

        <div class="brand">

            <div class="brand-title">
                SI MONITORING
            </div>

            <div class="brand-subtitle">
                Sistem Informasi Monitoring<br>
                Kehadiran & Prestasi Akademik
            </div>

        </div>


        <div class="user-role">

            <small>LOGIN SEBAGAI</small>

            <strong>
                {{ $user->name }}
            </strong>

        </div>


        <div class="menu-title">
            Menu Utama
        </div>


        <ul class="menu">

            <li>
                <a href="{{ route('dashboard') }}" class="active">
                    <span class="menu-icon">🏠</span>
                    Dashboard
                </a>
            </li>


            {{-- ================= ADMIN ================= --}}

            @if ($user->role === 'admin')

                <li>
                    <a href="{{ route('siswa.index') }}">
                        <span class="menu-icon">👨‍🎓</span>
                        Data Siswa
                    </a>
                </li>

                <li>
                    <a href="{{ route('guru.index') }}">
                        <span class="menu-icon">👨‍🏫</span>
                        Data Guru
                    </a>
                </li>

                <li>
                    <a href="{{ route('kelas.index') }}">
                        <span class="menu-icon">🏫</span>
                        Data Kelas
                    </a>
                </li>

                <li>
                    <a href="{{ route('mata-pelajaran.index') }}">
                        <span class="menu-icon">📚</span>
                        Mata Pelajaran
                    </a>
                </li>

                <li>
                    <a href="{{ route('nilai.index') }}">
                        <span class="menu-icon">📝</span>
                        Nilai Akademik
                    </a>
                </li>

                <li>
                    <a href="{{ route('monitoring.kehadiran') }}">
                        <span class="menu-icon">📍</span>
                        Monitoring Kehadiran
                    </a>
                </li>


            {{-- ================= GURU ================= --}}

            @elseif ($user->role === 'guru')

                <li>
                    <a href="{{ route('monitoring.kehadiran') }}">
                        <span class="menu-icon">📍</span>
                        Monitoring Kehadiran
                    </a>
                </li>

                <li>
                    <a href="{{ route('nilai.index') }}">
                        <span class="menu-icon">📝</span>
                        Nilai Akademik
                    </a>
                </li>


            {{-- ================= SISWA ================= --}}

            @elseif ($user->role === 'siswa')

                <li>
                    <a href="{{ route('kehadiran.siswa') }}">
                        <span class="menu-icon">📍</span>
                        Kehadiran Saya
                    </a>
                </li>

                <li>
                    <a href="{{ route('nilai.siswa') }}">
                        <span class="menu-icon">📝</span>
                        Nilai Saya
                    </a>
                </li>

            @endif

        </ul>


        <form
            class="logout"
            action="{{ route('logout') }}"
            method="POST"
        >

            @csrf

            <button type="submit">
                🚪 Logout
            </button>

        </form>

    </aside>


    {{-- ================= CONTENT ================= --}}

    <main class="content">


        <div class="topbar">

            <div class="welcome">

                @if ($user->role === 'admin')

                    <h1>
                        Selamat Datang, Admin!
                    </h1>

                @elseif ($user->role === 'guru')

                    <h1>
                        Selamat Datang, Guru!
                    </h1>

                @elseif ($user->role === 'siswa')

                    <h1>
                        Selamat Datang, Siswa!
                    </h1>

                @endif

                <p>
                    Halo,
                    <strong>{{ $user->name }}</strong>.
                    Selamat datang di Sistem Informasi Monitoring Sekolah.
                </p>

            </div>


            <div class="role-badge">

                {{ strtoupper($user->role) }}

            </div>

        </div>


        {{-- ================= INFO SISWA ================= --}}

        @if ($user->role === 'siswa' && $user->siswa)

            <div class="info-box">

                <h2>
                    👨‍🎓 Informasi Siswa
                </h2>

                <p>

                    <strong>NIS:</strong>
                    {{ $user->siswa->nis }}

                    &nbsp;&nbsp; | &nbsp;&nbsp;

                    <strong>Nama:</strong>
                    {{ $user->siswa->nama }}

                    &nbsp;&nbsp; | &nbsp;&nbsp;

                    <strong>Kelas:</strong>
                    {{ $user->siswa->kelas->nama_kelas ?? '-' }}

                </p>

            </div>

        @endif


        {{-- ================= ADMIN ================= --}}

        @if ($user->role === 'admin')

            <div class="cards">

                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            TOTAL SISWA
                        </div>

                        <div class="card-icon">
                            👨‍🎓
                        </div>

                    </div>

                    <div class="card-value">
                        {{ $totalSiswa }}
                    </div>

                    <div class="card-description">
                        Data siswa terdaftar
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            TOTAL GURU
                        </div>

                        <div class="card-icon">
                            👨‍🏫
                        </div>

                    </div>

                    <div class="card-value">
                        {{ $totalGuru }}
                    </div>

                    <div class="card-description">
                        Data guru terdaftar
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            TOTAL KELAS
                        </div>

                        <div class="card-icon">
                            🏫
                        </div>

                    </div>

                    <div class="card-value">
                        {{ $totalKelas }}
                    </div>

                    <div class="card-description">
                        Kelas yang tersedia
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            MATA PELAJARAN
                        </div>

                        <div class="card-icon">
                            📚
                        </div>

                    </div>

                    <div class="card-value">
                        {{ $totalMapel }}
                    </div>

                    <div class="card-description">
                        Mata pelajaran terdaftar
                    </div>

                </div>

            </div>


            <div class="cards">

                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            TOTAL DATA NILAI
                        </div>

                        <div class="card-icon">
                            📝
                        </div>

                    </div>

                    <div class="card-value">
                        {{ $totalNilai }}
                    </div>

                    <div class="card-description">
                        Data nilai akademik
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            RATA-RATA NILAI
                        </div>

                        <div class="card-icon">
                            📊
                        </div>

                    </div>

                    <div class="card-value">
                        {{ number_format($rataRataNilai, 2) }}
                    </div>

                    <div class="card-description">
                        Rata-rata seluruh nilai
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            KEHADIRAN HARI INI
                        </div>

                        <div class="card-icon">
                            📍
                        </div>

                    </div>

                    <div class="card-value">
                        {{ $totalKehadiranHariIni }}
                    </div>

                    <div class="card-description">
                        Siswa yang melakukan absensi
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            TAHUN AJARAN
                        </div>

                        <div class="card-icon">
                            📅
                        </div>

                    </div>

                    <div class="card-value">
                        2026/27
                    </div>

                    <div class="card-description">
                        Tahun ajaran aktif
                    </div>

                </div>

            </div>


            <div class="panel-grid">

                <div class="panel">

                    <h3>
                        📋 Ringkasan Sistem
                    </h3>

                    <p>
                        Dashboard admin digunakan untuk mengelola data siswa,
                        guru, kelas, mata pelajaran, nilai akademik serta
                        melakukan monitoring kehadiran siswa berdasarkan data
                        yang tersimpan pada sistem.
                    </p>

                </div>


                <div class="panel">

                    <h3>
                        ⚡ Akses Cepat
                    </h3>

                    <div class="quick-menu">

                        <a href="{{ route('siswa.index') }}">
                            👨‍🎓 Kelola Data Siswa
                        </a>

                        <a href="{{ route('nilai.index') }}">
                            📝 Kelola Nilai Akademik
                        </a>

                        <a href="{{ route('monitoring.kehadiran') }}">
                            📍 Monitoring Kehadiran
                        </a>

                    </div>

                </div>

            </div>


        {{-- ================= GURU ================= --}}

        @elseif ($user->role === 'guru')

            <div class="cards">

                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            TOTAL SISWA
                        </div>

                        <div class="card-icon">
                            👨‍🎓
                        </div>

                    </div>

                    <div class="card-value">
                        {{ $totalSiswa }}
                    </div>

                    <div class="card-description">
                        Data siswa dalam sistem
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            TOTAL KELAS
                        </div>

                        <div class="card-icon">
                            🏫
                        </div>

                    </div>

                    <div class="card-value">
                        {{ $totalKelas }}
                    </div>

                    <div class="card-description">
                        Kelas tersedia
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            DATA NILAI
                        </div>

                        <div class="card-icon">
                            📝
                        </div>

                    </div>

                    <div class="card-value">
                        {{ $totalNilai }}
                    </div>

                    <div class="card-description">
                        Nilai akademik
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            RATA-RATA NILAI
                        </div>

                        <div class="card-icon">
                            📊
                        </div>

                    </div>

                    <div class="card-value">
                        {{ number_format($rataRataNilai, 2) }}
                    </div>

                    <div class="card-description">
                        Rata-rata nilai siswa
                    </div>

                </div>

            </div>


            <div class="panel-grid">

                <div class="panel">

                    <h3>
                        👨‍🏫 Panel Guru
                    </h3>

                    <p>
                        Guru dapat melakukan pemantauan kehadiran siswa
                        dan mengelola data nilai akademik melalui menu
                        yang tersedia pada sidebar.
                    </p>

                </div>


                <div class="panel">

                    <h3>
                        ⚡ Akses Cepat
                    </h3>

                    <div class="quick-menu">

                        <a href="{{ route('nilai.index') }}">
                            📝 Data Nilai Akademik
                        </a>

                        <a href="{{ route('monitoring.kehadiran') }}">
                            📍 Monitoring Kehadiran
                        </a>

                    </div>

                </div>

            </div>


        {{-- ================= SISWA ================= --}}

        @elseif ($user->role === 'siswa')

            <div class="cards">

                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            TOTAL NILAI
                        </div>

                        <div class="card-icon">
                            📝
                        </div>

                    </div>

                    <div class="card-value">
                        {{ $nilaiSiswa->count() }}
                    </div>

                    <div class="card-description">
                        Mata pelajaran yang memiliki nilai
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            RATA-RATA NILAI
                        </div>

                        <div class="card-icon">
                            📊
                        </div>

                    </div>

                    <div class="card-value">
                        {{ number_format($rataRataNilaiSiswa, 2) }}
                    </div>

                    <div class="card-description">
                        Rata-rata nilai akademik
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            TOTAL KEHADIRAN
                        </div>

                        <div class="card-icon">
                            📍
                        </div>

                    </div>

                    <div class="card-value">
                        {{ $totalKehadiranSiswa }}
                    </div>

                    <div class="card-description">
                        Total absensi tercatat
                    </div>

                </div>


                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            TAHUN AJARAN
                        </div>

                        <div class="card-icon">
                            📅
                        </div>

                    </div>

                    <div class="card-value">
                        2026/27
                    </div>

                    <div class="card-description">
                        Tahun ajaran aktif
                    </div>

                </div>

            </div>


            <div class="panel-grid">

                <div class="panel">

                    <h3>
                        🎓 Informasi Akademik
                    </h3>

                    <p>
                        Gunakan menu <strong>Nilai Saya</strong> untuk
                        melihat perkembangan nilai akademik dan status
                        ketuntasan setiap mata pelajaran.
                    </p>

                    <br>

                    <p>
                        Gunakan menu <strong>Kehadiran Saya</strong> untuk
                        melakukan absensi dan melihat riwayat kehadiran.
                    </p>

                </div>


                <div class="panel">

                    <h3>
                        ⚡ Akses Cepat
                    </h3>

                    <div class="quick-menu">

                        <a href="{{ route('nilai.siswa') }}">
                            📝 Lihat Nilai Saya
                        </a>

                        <a href="{{ route('kehadiran.siswa') }}">
                            📍 Lihat Kehadiran Saya
                        </a>

                    </div>

                </div>

            </div>

        @endif


    </main>

</div>

</body>

</html>