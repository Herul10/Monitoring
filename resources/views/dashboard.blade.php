```blade
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Sistem Monitoring Sekolah</title>

    
    <style>
        /* ==========================================
        DASAR WEBSITE
        ========================================== */

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


        /* ==========================================
        SIDEBAR
        ========================================== */

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #0f172a, #172554);
            color: white;
            padding: 25px 18px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            overflow-y: auto;
            z-index: 100;
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
            margin-top: 30px;
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
            transition: .2s;
        }

        .logout button:hover {
            background: #b91c1c;
        }


        /* ==========================================
        KONTEN UTAMA
        ========================================== */

        .content {
            flex: 1;
            margin-left: 260px;
            padding: 30px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 20px;
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
            white-space: nowrap;
        }


        /* ==========================================
        KOTAK INFORMASI
        ========================================== */

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


        /* ==========================================
        KARTU STATISTIK
        ========================================== */

        .cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            position: relative;
            overflow: hidden;
            background: #ffffff;
            padding: 24px;
            border-radius: 18px;
            border: 1px solid #e8edf5;
            box-shadow: 0 5px 18px rgba(15,23,42,.05);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(15,23,42,.12);
        }

        /* Garis warna atas kartu */
        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .card-title {
            color: #64748b;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: .7px;
        }

        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .card-value {
            font-size: 32px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
            margin-bottom: 8px;
        }

        .card-description {
            margin-top: 5px;
            color: #94a3b8;
            font-size: 12px;
        }


        /* ==========================================
        WARNA KARTU STATISTIK
        ========================================== */

        /* TOTAL SISWA - BIRU */
        .cards .card-siswa::before {
            background: #2563eb !important;
        }

        .cards .card-siswa .card-icon {
            background: #dbeafe !important;
            color: #2563eb;
        }

        /* TOTAL KELAS - UNGU */
        .cards .card-kelas::before {
            background: #9333ea !important;
        }

        .cards .card-kelas .card-icon {
            background: #f3e8ff !important;
            color: #9333ea;
        }

        /* DATA NILAI - BIRU MUDA */
        .cards .card-nilai::before {
            background: #0891b2 !important;
        }

        .cards .card-nilai .card-icon {
            background: #cffafe !important;
            color: #0891b2;
        }

        /* RATA-RATA NILAI - HIJAU */
        .cards .card-rata::before {
            background: #16a34a !important;
        }

        .cards .card-rata .card-icon {
            background: #dcfce7 !important;
            color: #16a34a;
        }

        /* TOTAL GURU - BIRU TOSKA */
        .cards .card-guru::before {
            background: #0891b2 !important;
        }

        .cards .card-guru .card-icon {
            background: #cffafe !important;
            color: #0891b2;
        }

        /* TOTAL MAPEL - PINK */
        .cards .card-mapel::before {
            background: #db2777 !important;
        }

        .cards .card-mapel .card-icon {
            background: #fce7f3 !important;
            color: #db2777;
        }

        /* KEHADIRAN - HIJAU */
        .cards .card-kehadiran::before {
            background: #16a34a !important;
        }

        .cards .card-kehadiran .card-icon {
            background: #dcfce7 !important;
            color: #16a34a;
        }

        /* TAHUN AJARAN - ORANYE */
        .cards .card-tahun::before {
            background: #ea580c !important;
        }

        .cards .card-tahun .card-icon {
            background: #ffedd5 !important;
            color: #ea580c;
        }


        /* ==========================================
        PANEL DASHBOARD
        ========================================== */

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
            transition: .2s;
        }

        .quick-menu a:hover {
            background: #eff6ff;
            color: #2563eb;
            transform: translateX(3px);
        }


        /* ==========================================
        GRAFIK KEHADIRAN
        ========================================== */

        .chart-panel {
            background: white;
            border-radius: 15px;
            padding: 22px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(15,23,42,.05);
        }

        .chart-panel h3 {
            font-size: 16px;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .chart-panel p {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .chart-container {
            height: 320px;
            position: relative;
        }


        /* ==========================================
        RESPONSIVE TABLET
        ========================================== */

        @media (max-width: 1100px) {
            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .panel-grid {
                grid-template-columns: 1fr;
            }
        }


        /* ==========================================
        RESPONSIVE MOBILE
        ========================================== */

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

        @media (max-width: 550px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }

            .layout {
                flex-direction: column;
            }

            .content {
                margin-left: 0;
                padding: 15px;
            }

            .logout {
                position: static;
                margin-top: 20px;
            }
        }

        /* ==========================================
            DASHBOARD GURU - CSS BARU
        ========================================== */

        .guru-welcome {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 25px 30px;
            margin-bottom: 25px;
            border-radius: 18px;
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.18);
        }

        .guru-welcome h2 {
            margin: 0 0 8px;
            font-size: 25px;
            font-weight: 700;
        }

        .guru-welcome p {
            margin: 0;
            font-size: 14px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.9);
        }

        .guru-welcome-icon {
            width: 65px;
            height: 65px;
            min-width: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.18);
            font-size: 34px;
        }

        .guru-info-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .guru-info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px;
            border-radius: 12px;
            background: #f8fafc;
        }

        .guru-info-item > span {
            font-size: 23px;
        }

        .guru-info-item strong {
            display: block;
            margin-bottom: 5px;
            color: #1e293b;
            font-size: 14px;
        }

        .guru-info-item p {
            margin: 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        .quick-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            margin-bottom: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .quick-menu a:hover {
            transform: translateY(-2px);
            border-color: #93c5fd;
            background: #eff6ff;
        }

        .quick-menu a > span:first-child {
            width: 42px;
            height: 42px;
            min-width: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #dbeafe;
            font-size: 21px;
        }

        .quick-menu a strong {
            display: block;
            color: #1e293b;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .quick-menu a small {
            display: block;
            color: #64748b;
            font-size: 11px;
        }

        .quick-menu a .quick-arrow {
            margin-left: auto;
            color: #2563eb;
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .guru-welcome {
                padding: 20px;
            }

            .guru-welcome h2 {
                font-size: 20px;
            }

            .guru-welcome-icon {
                width: 50px;
                height: 50px;
                min-width: 50px;
                font-size: 27px;
            }
        }

        @media (max-width: 480px) {
            .guru-welcome {
                align-items: flex-start;
                padding: 18px;
            }

            .guru-welcome-icon {
                display: none;
            }
        }
    </style>

</head>

<body>

<div class="layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-title">MONITORING</div>

            <div class="brand-subtitle">
                Sistem Informasi Monitoring<br>
                Kehadiran & Prestasi Akademik
            </div>
        </div>

        <div class="user-role">
            <small>LOGIN SEBAGAI</small>
            <strong>{{ $user->name }}</strong>
        </div>

        <div class="menu-title">Menu Utama</div>

        <ul class="menu">

            <li>
                <a href="{{ route('dashboard') }}" class="active">
                    <span class="menu-icon">🏠</span>
                    Dashboard
                </a>
            </li>

            {{-- ADMIN --}}
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

            {{-- GURU --}}
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

            {{-- SISWA --}}
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

        <form class="logout" action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit">
                🚪 Logout
            </button>
        </form>

    </aside>

    {{-- CONTENT --}}
    <main class="content">

        <div class="topbar">

            <div class="welcome">

                @if ($user->role === 'admin')
                    <h1>Selamat Datang, Admin!</h1>
                @elseif ($user->role === 'guru')
                    <h1>Selamat Datang, Guru!</h1>
                @elseif ($user->role === 'siswa')
                    <h1>Selamat Datang, Siswa!</h1>
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

        {{-- INFO SISWA --}}
        @if ($user->role === 'siswa' && $user->siswa)

            <div class="info-box">

                <h2>👨‍🎓 Informasi Siswa</h2>

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

        {{-- DASHBOARD ADMIN --}}
        @if ($user->role === 'admin')

            <div class="cards">

                <div class="card card-siswa">

                    <div class="card-header">
                        <div class="card-title">TOTAL SISWA</div>
                        <div class="card-icon">👨‍🎓</div>
                    </div>

                    <div class="card-value">{{ $totalSiswa }}</div>
                    <div class="card-description">Data siswa dalam sistem</div>

                </div>

                <div class="card card-guru">
                    <div class="card-header">
                        <div class="card-title">TOTAL GURU</div>
                        <div class="card-icon">👨‍🏫</div>
                    </div>

                    <div class="card-value">{{ $totalGuru }}</div>
                    <div class="card-description">Data guru terdaftar</div>
                </div>

                <div class="card card-kelas">
                    <div class="card-header">
                        <div class="card-title">TOTAL KELAS</div>
                        <div class="card-icon">🏫</div>
                    </div>

                    <div class="card-value">{{ $totalKelas }}</div>
                    <div class="card-description">Kelas yang tersedia</div>
                </div>

                <div class="card card-mapel">
                    <div class="card-header">
                        <div class="card-title">MATA PELAJARAN</div>
                        <div class="card-icon">📚</div>
                    </div>

                    <div class="card-value">{{ $totalMapel }}</div>
                    <div class="card-description">Mata pelajaran terdaftar</div>
                </div>

            </div>

            <div class="cards">

                <div class="card card-nilai">
                    <div class="card-header">
                        <div class="card-title">TOTAL DATA NILAI</div>
                        <div class="card-icon">📝</div>
                    </div>

                    <div class="card-value">{{ $totalNilai }}</div>
                        <div class="card-description">Data nilai akademik</div>
                    </div>

                <div class="card card-rata">
                    <div class="card-header">
                        <div class="card-title">RATA-RATA NILAI</div>
                        <div class="card-icon">📊</div>
                    </div>

                    <div class="card-value">
                        {{ number_format($rataRataNilai, 2) }}
                    </div>

                    <div class="card-description">Rata-rata seluruh nilai</div>
                </div>

                <div class="card card-kehadiran">
                    <div class="card-header">
                        <div class="card-title">KEHADIRAN HARI INI</div>
                        <div class="card-icon">📍</div>
                </div>

                    <div class="card-value">
                        {{ $kehadiranHariIni }}
                    </div>

                <div style="
                    margin-top: 12px;
                    background: #dcfce7;
                    color: #166534;
                    padding: 8px 12px;
                    border-radius: 8px;
                    display: inline-block;
                    font-size: 12px;
                    font-weight: bold;
                ">
                    {{ $persentaseKehadiran }}% kehadiran
                </div>

                    <div class="card-value">{{ $totalKehadiranHariIni }}</div>
                    <div class="card-description">Siswa yang melakukan absensi</div>
                </div>

                <div class="card card-tahun">
                    <div class="card-header">
                        <div class="card-title">TAHUN AJARAN</div>
                        <div class="card-icon">📅</div>
                    </div>

                    <div class="card-value">2026/27</div>
                    <div class="card-description">Tahun ajaran aktif</div>
                </div>

            </div>

            {{-- GRAFIK KEHADIRAN ADMIN --}}
            <div class="chart-panel">

                <h3>📊 Grafik Kehadiran 7 Hari Terakhir</h3>

                <p>
                    Statistik kehadiran siswa berdasarkan status absensi.
                </p>

                <div class="chart-container">
                    <canvas id="grafikKehadiran"></canvas>
                </div>

            </div>

            {{-- PENGUMUMAN ADMIN --}}
            <div class="panel" style="margin-bottom: 25px; border-left: 5px solid #2563eb;">

                <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 18px; flex-wrap: wrap;">

                    <h3 style="margin-bottom: 0;">
                        📢 Pengumuman Sekolah
                    </h3>

                    <a href="{{ route('admin.pengumuman.index') }}"
                    style="background: #2563eb; color: white; text-decoration: none; padding: 9px 15px; border-radius: 8px; font-size: 12px;">
                        Kelola Pengumuman
                    </a>

                </div>

                @if(isset($pengumumanTerbaru) && $pengumumanTerbaru->count() > 0)

                    @foreach($pengumumanTerbaru as $pengumuman)

                        <div style="padding: 15px; margin-bottom: 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;">

                            <h4 style="font-size: 15px; color: #1e293b; margin-bottom: 8px;">
                                {{ $pengumuman->judul }}
                            </h4>

                            <p style="font-size: 13px; color: #475569; line-height: 1.7; white-space: pre-line;">
                                {{ $pengumuman->isi }}
                            </p>

                            <small style="display: block; margin-top: 10px; color: #64748b;">
                                📅
                                {{ $pengumuman->tanggal_publikasi
                                    ? $pengumuman->tanggal_publikasi->format('d/m/Y H:i')
                                    : $pengumuman->created_at->format('d/m/Y H:i') }}
                            </small>

                        </div>

                    @endforeach

                @else

                    <p>
                        Belum ada pengumuman yang dipublikasikan.
                    </p>

                @endif

            </div>

            {{-- PANEL ADMIN --}}
            <div class="panel-grid">

                {{-- RINGKASAN SISTEM --}}
                <div class="panel">
                    <h3>📋 Ringkasan Sistem</h3>

                    <p>
                        Dashboard admin digunakan untuk mengelola data siswa,
                        guru, kelas, mata pelajaran, nilai akademik serta
                        melakukan monitoring kehadiran siswa berdasarkan data
                        yang tersimpan pada sistem.
                    </p>
                </div>

                {{-- AKSES CEPAT --}}
                <div class="panel">
                    <h3>⚡ Akses Cepat</h3>

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

                {{-- RINGKASAN AKTIVITAS SISTEM --}}
                <div class="panel">
                    <h3>🕘 Ringkasan Aktivitas Sistem</h3>

                    @if(isset($aktivitasTerbaru) && $aktivitasTerbaru->count() > 0)

                        <div class="activity-list">

                            @foreach($aktivitasTerbaru as $aktivitas)

                                <div class="activity-item">

                                    <div class="activity-content">

                                        <strong>
                                            {{ $aktivitas->aktivitas }}
                                        </strong>

                                        <p>
                                            {{ $aktivitas->keterangan }}
                                        </p>

                                        <small>
                                            {{ $aktivitas->nama_pengguna ?? 'Pengguna' }}
                                            |
                                            {{ $aktivitas->created_at->format('d/m/Y H:i') }}
                                        </small>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <p>
                            Belum ada aktivitas yang tercatat.
                        </p>

                    @endif
                </div>

            </div>

        
            {{-- DASHBOARD GURU --}}
            @elseif ($user->role === 'guru')

            {{-- JUDUL DASHBOARD GURU --}}
            <div class="guru-welcome">
                <div>
                    <h2>Dashboard Guru 👋</h2>
                    <p>
                        Selamat datang, {{ $user->name }}.
                        Berikut ringkasan data akademik dan akses kegiatan mengajar Anda.
                    </p>
                </div>

                <div class="guru-welcome-icon">
                    👨‍🏫
                </div>
            </div>

            {{-- KARTU STATISTIK --}}
            <div class="cards">

                {{-- TOTAL SISWA --}}
                <div class="card card-siswa">
                    <div class="card-header">
                        <div class="card-title">TOTAL SISWA</div>
                        <div class="card-icon">👨‍🎓</div>
                    </div>

                    <div class="card-value">
                        {{ $totalSiswa }}
                    </div>

                    <div class="card-description">
                        Siswa terdaftar dalam sistem
                    </div>
                </div>

                {{-- TOTAL KELAS --}}
                <div class="card card-kelas">
                    <div class="card-header">
                        <div class="card-title">TOTAL KELAS</div>
                        <div class="card-icon">🏫</div>
                    </div>

                    <div class="card-value">
                        {{ $totalKelas }}
                    </div>

                    <div class="card-description">
                        Kelas tersedia
                    </div>
                </div>

                {{-- DATA NILAI --}}
                <div class="card card-nilai">
                    <div class="card-header">
                        <div class="card-title">DATA NILAI</div>
                        <div class="card-icon">📝</div>
                    </div>

                    <div class="card-value">
                        {{ $totalNilaiGuru }}
                    </div>

                    <div class="card-description">
                        Nilai akademik tersimpan
                    </div>
                </div>

                {{-- RATA-RATA NILAI --}}
                <div class="card card-rata">
                    <div class="card-header">
                        <div class="card-title">RATA-RATA NILAI</div>
                        <div class="card-icon">📊</div>
                    </div>

                    <div class="card-value">
                        {{ number_format($rataRataNilaiGuru, 2) }}
                    </div>

                    <div class="card-description">
                        Rata-rata nilai akademik
                    </div>
                </div>

            </div>

            {{-- PANEL GURU --}}
            <div class="panel-grid">

                {{-- PANEL INFORMASI --}}
                <div class="panel">
                    <h3>👨‍🏫 Informasi Guru</h3>

                    <p>
                        Gunakan dashboard ini untuk mengelola nilai akademik,
                        memantau kehadiran siswa, serta melihat data akademik
                        yang tersedia pada sistem.
                    </p>

                    <div class="guru-info-list">
                        <div class="guru-info-item">
                            <span>📚</span>
                            <div>
                                <strong>Pengelolaan Nilai</strong>
                                <p>Input dan periksa nilai akademik siswa.</p>
                            </div>
                        </div>

                        <div class="guru-info-item">
                            <span>📍</span>
                            <div>
                                <strong>Monitoring Kehadiran</strong>
                                <p>Pantau catatan kehadiran siswa.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PANEL AKSES CEPAT --}}
                <div class="panel">
                    <h3>⚡ Akses Cepat</h3>

                    <div class="quick-menu">

                        <a href="{{ route('nilai.index') }}">
                            <span>📝</span>
                            <div>
                                <strong>Data Nilai Akademik</strong>
                                <small>Kelola nilai siswa</small>
                            </div>
                            <span class="quick-arrow">→</span>
                        </a>

                        <a href="{{ route('monitoring.kehadiran') }}">
                            <span>📍</span>
                            <div>
                                <strong>Monitoring Kehadiran</strong>
                                <small>Lihat kehadiran siswa</small>
                            </div>
                            <span class="quick-arrow">→</span>
                        </a>

                    </div>
                </div>

            </div>


        {{-- DASHBOARD SISWA --}}
        @elseif ($user->role === 'siswa')

            <div class="cards">

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">TOTAL NILAI</div>
                        <div class="card-icon">📝</div>
                    </div>

                    <div class="card-value">{{ $nilaiSiswa->count() }}</div>
                    <div class="card-description">Mata pelajaran yang memiliki nilai</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">RATA-RATA NILAI</div>
                        <div class="card-icon">📊</div>
                    </div>

                    <div class="card-value">
                        {{ number_format($rataRataNilaiSiswa, 2) }}
                    </div>

                    <div class="card-description">Rata-rata nilai akademik</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">TOTAL KEHADIRAN</div>
                        <div class="card-icon">📍</div>
                    </div>

                    <div class="card-value">{{ $totalKehadiranSiswa }}</div>
                    <div class="card-description">Total absensi tercatat</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">TAHUN AJARAN</div>
                        <div class="card-icon">📅</div>
                    </div>

                    <div class="card-value">2026/27</div>
                    <div class="card-description">Tahun ajaran aktif</div>
                </div>

            </div>

            <div class="panel-grid">

                <div class="panel">
                    <h3>🎓 Informasi Akademik</h3>

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
                    <h3>⚡ Akses Cepat</h3>

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

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('grafikKehadiran');

    if (canvas) {
        new Chart(canvas, {
            type: 'line',

            data: {
                labels: @json($tanggalGrafik),

                datasets: [
                    {
                        label: 'Hadir',
                        data: @json($dataHadir),
                        borderColor: '#16a34a',
                        backgroundColor: 'rgba(22, 163, 74, 0.12)',
                        borderWidth: 3,
                        pointRadius: 4,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Izin',
                        data: @json($dataIzin),
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.08)',
                        borderWidth: 3,
                        pointRadius: 4,
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Sakit',
                        data: @json($dataSakit),
                        borderColor: '#eab308',
                        backgroundColor: 'rgba(234, 179, 8, 0.08)',
                        borderWidth: 3,
                        pointRadius: 4,
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Alpha',
                        data: @json($dataAlpha),
                        borderColor: '#dc2626',
                        backgroundColor: 'rgba(220, 38, 38, 0.08)',
                        borderWidth: 3,
                        pointRadius: 4,
                        tension: 0.4,
                        fill: false
                    }
                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        title: {
                            display: true,
                            text: 'Jumlah siswa'
                        }
                    },

                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                }
            }
        });
    }
});
</script>

</body>
</html>