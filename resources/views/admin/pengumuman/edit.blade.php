
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Pengumuman - MONITORING</title>

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

        /* PANEL */
        .panel {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(15,23,42,.05);
            border: 1px solid #e8edf5;
            max-width: 1000px;
        }

        .panel-header {
            padding-bottom: 18px;
            margin-bottom: 22px;
            border-bottom: 1px solid #e2e8f0;
        }

        .panel-header h2 {
            font-size: 18px;
            color: #0f172a;
            margin-bottom: 7px;
        }

        .panel-header p {
            font-size: 12px;
            color: #64748b;
        }

        /* FORM */
        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #334155;
            margin-bottom: 9px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            background: white;
            color: #0f172a;
            font-size: 13px;
            font-family: Arial, Helvetica, sans-serif;
            outline: none;
            transition: .2s;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        }

        textarea.form-control {
            min-height: 180px;
            resize: vertical;
            line-height: 1.7;
        }

        .form-help {
            display: block;
            margin-top: 7px;
            color: #64748b;
            font-size: 11px;
        }

        .checkbox-row {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 15px;
        }

        .checkbox-row input {
            width: 17px;
            height: 17px;
            margin-top: 2px;
            accent-color: #2563eb;
        }

        .checkbox-row label {
            margin: 0;
            cursor: pointer;
        }

        .checkbox-row strong {
            display: block;
            color: #334155;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .checkbox-row small {
            display: block;
            color: #64748b;
            font-size: 11px;
            line-height: 1.6;
        }

        /* ALERT */
        .alert {
            padding: 15px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.6;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* BUTTON */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            text-decoration: none;
            padding: 11px 17px;
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
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

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
                padding: 17px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn {
                width: 100%;
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

    {{-- CONTENT --}}
    <main class="content">

        <div class="topbar">
            <div class="welcome">
                <h1>✏️ Edit Pengumuman</h1>
                <p>Perbarui informasi pengumuman sekolah.</p>
            </div>

            <div class="role-badge">
                {{ strtoupper(auth()->user()->role) }}
            </div>
        </div>

        {{-- VALIDATION ERROR --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali data yang dimasukkan:</strong>

                <ul style="margin: 8px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="panel">

            <div class="panel-header">
                <h2>Form Edit Pengumuman</h2>
                <p>Perubahan yang disimpan akan memperbarui pengumuman ini.</p>
            </div>

            <form action="{{ route('admin.pengumuman.update', $pengumuman->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- JUDUL --}}
                <div class="form-group">
                    <label for="judul">Judul Pengumuman</label>

                    <input
                        type="text"
                        id="judul"
                        name="judul"
                        class="form-control"
                        value="{{ old('judul', $pengumuman->judul) }}"
                        required
                    >
                </div>

                {{-- ISI --}}
                <div class="form-group">
                    <label for="isi">Isi Pengumuman</label>

                    <textarea
                        id="isi"
                        name="isi"
                        class="form-control"
                        required
                    >{{ old('isi', $pengumuman->isi) }}</textarea>
                </div>

                {{-- TANGGAL --}}
                <div class="form-group">
                    <label for="tanggal_publikasi">
                        Tanggal dan Waktu Publikasi
                    </label>

                    <input
                        type="datetime-local"
                        id="tanggal_publikasi"
                        name="tanggal_publikasi"
                        class="form-control"
                        value="{{ old('tanggal_publikasi', $pengumuman->tanggal_publikasi ? $pengumuman->tanggal_publikasi->format('Y-m-d\TH:i') : '') }}"
                    >

                    <small class="form-help">
                        Kosongkan jika tanggal publikasi belum ditentukan.
                    </small>
                </div>

                {{-- STATUS --}}
                <div class="form-group">
                    <div class="checkbox-row">
                        <input
                            type="checkbox"
                            id="is_published"
                            name="is_published"
                            value="1"
                            {{ old('is_published', $pengumuman->is_published) ? 'checked' : '' }}
                        >

                        <label for="is_published">
                            <strong>Publikasikan pengumuman</strong>
                            <small>
                                Centang jika pengumuman sudah siap ditampilkan
                                pada dashboard.
                            </small>
                        </label>
                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="form-actions">
                    <a href="{{ route('admin.pengumuman.index') }}"
                       class="btn btn-secondary">
                        ← Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        💾 Perbarui Pengumuman
                    </button>
                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>
