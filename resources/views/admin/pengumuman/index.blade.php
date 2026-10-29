
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Pengumuman - MONITORING</title>

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

        /* SIDEBAR */
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
        }

        .logout button:hover {
            background: #b91c1c;
        }

        /* CONTENT */
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
            gap: 20px;
            flex-wrap: wrap;
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
            line-height: 1.6;
        }

        .role-badge {
            background: #dbeafe;
            color: #1d4ed8;
            padding: 9px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        /* BUTTON */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            color: white;
            transform: translateY(-1px);
        }

        .btn-warning {
            background: #f59e0b;
            color: #ffffff;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .btn-sm {
            padding: 8px 11px;
            font-size: 12px;
        }

        /* ALERT */
        .alert {
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.6;
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

        /* PANEL */
        .panel {
            background: white;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 5px 20px rgba(15,23,42,.05);
            border: 1px solid #e8edf5;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            padding-bottom: 18px;
            margin-bottom: 18px;
            border-bottom: 1px solid #e2e8f0;
        }

        .panel-header h2 {
            color: #0f172a;
            font-size: 18px;
        }

        .panel-header p {
            margin-top: 6px;
            font-size: 12px;
            color: #64748b;
        }

        /* TABLE */
        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        thead {
            background: #f8fafc;
        }

        th {
            text-align: left;
            padding: 14px 12px;
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .5px;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 15px 12px;
            font-size: 13px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .judul {
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .isi {
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
            max-width: 350px;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-secondary {
            background: #e2e8f0;
            color: #475569;
        }

        .aksi {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .aksi form {
            margin: 0;
        }

        /* EMPTY STATE */
        .empty {
            text-align: center;
            padding: 55px 20px;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .empty h3 {
            font-size: 18px;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .empty p {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 20px;
        }

        /* PAGINATION */
        .pagination-wrap {
            margin-top: 20px;
            overflow-x: auto;
        }

        .pagination-wrap nav > div:first-child {
            margin-bottom: 10px;
        }

        .pagination-wrap svg {
            width: 18px;
            height: 18px;
        }

        .pagination-wrap nav > div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination-wrap nav span,
        .pagination-wrap nav a {
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;
                padding: 22px;
            }
        }

        @media (max-width: 600px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }

            .content {
                margin-left: 0;
                padding: 15px;
            }

            .welcome h1 {
                font-size: 23px;
            }

            .panel {
                padding: 15px;
            }

            .panel-header {
                align-items: flex-start;
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
            <strong>{{ auth()->user()->name }}</strong>
        </div>

        <div class="menu-title">Menu Utama</div>

        <ul class="menu">
            <li>
                <a href="{{ route('dashboard') }}">
                    <span class="menu-icon">🏠</span>
                    Dashboard
                </a>
            </li>

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

            <li>
                <a href="{{ route('admin.pengumuman.index') }}" class="active">
                    <span class="menu-icon">📢</span>
                    Kelola Pengumuman
                </a>
            </li>
        </ul>

        <form class="logout" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">🚪 Logout</button>
        </form>

    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="content">

        <div class="topbar">
            <div class="welcome">
                <h1>📢 Pengumuman Sekolah</h1>
                <p>
                    Kelola informasi dan pengumuman sekolah melalui halaman ini.
                </p>
            </div>

            <div class="role-badge">
                {{ strtoupper(auth()->user()->role) }}
            </div>
        </div>

        {{-- PESAN SUKSES --}}
        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- PESAN ERROR --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin: 8px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- PANEL DAFTAR PENGUMUMAN --}}
        <div class="panel">

            <div class="panel-header">
                <div>
                    <h2>Daftar Pengumuman</h2>
                    <p>Daftar pengumuman yang tersimpan di sistem.</p>
                </div>

                <a href="{{ route('admin.pengumuman.create') }}"
                   class="btn btn-primary">
                    + Tambah Pengumuman
                </a>
            </div>

            @if($pengumumans->count() > 0)

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Informasi Pengumuman</th>
                                <th>Tanggal Publikasi</th>
                                <th>Status</th>
                                <th>Admin Pembuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($pengumumans as $pengumuman)
                                <tr>
                                    <td>
                                        {{ $pengumumans->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <div class="judul">
                                            {{ $pengumuman->judul }}
                                        </div>

                                        <div class="isi">
                                            {{ \Illuminate\Support\Str::limit($pengumuman->isi, 100) }}
                                        </div>
                                    </td>

                                    <td>
                                        @if($pengumuman->tanggal_publikasi)
                                            {{ $pengumuman->tanggal_publikasi->format('d-m-Y H:i') }}
                                        @else
                                            <span style="color:#94a3b8;">
                                                Belum ditentukan
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($pengumuman->is_published)
                                            <span class="badge badge-success">
                                                Dipublikasikan
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                Draft
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $pengumuman->user->name ?? 'Admin' }}
                                    </td>

                                    <td>
                                        <div class="aksi">

                                            <a href="{{ route('admin.pengumuman.edit', $pengumuman->id) }}"
                                               class="btn btn-warning btn-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.pengumuman.destroy', $pengumuman->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="pagination-wrap">
                    {{ $pengumumans->links() }}
                </div>

            @else

                <div class="empty">
                    <div class="empty-icon">📢</div>

                    <h3>Belum Ada Pengumuman</h3>

                    <p>
                        Belum ada pengumuman yang dibuat.
                        Silakan tambahkan pengumuman sekolah pertama.
                    </p>

                    <a href="{{ route('admin.pengumuman.create') }}"
                       class="btn btn-primary">
                        + Tambah Pengumuman
                    </a>
                </div>

            @endif

        </div>

    </main>

</div>

</body>
</html>
