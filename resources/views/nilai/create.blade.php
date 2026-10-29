<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Nilai Akademik</title>

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
            max-width: 900px;
            margin: 30px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #777;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        select,
        input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 14px;
        }

        select:focus,
        input:focus {
            outline: none;
            border-color: #2563eb;
        }

        .nilai-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .info {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .alert {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 11px 18px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
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

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        @media (max-width: 700px) {
            .nilai-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Tambah Nilai Akademik</h1>

        <p class="subtitle">
            Masukkan nilai akademik siswa sesuai mata pelajaran dan semester.
        </p>

        @if($errors->any())

            <div class="alert">

                <strong>Terjadi kesalahan:</strong>

                <ul style="margin-bottom: 0;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        <div class="info">

            <strong>Perhitungan Nilai Akhir:</strong><br>

            Nilai Tugas × 30% +
            Nilai UTS × 30% +
            Nilai UAS × 40%

            <br><br>

            Nilai akhir akan dihitung otomatis oleh sistem.

        </div>

        <form action="{{ route('nilai.store') }}" method="POST">

            @csrf

            <div class="form-group">

                <label for="siswa_id">
                    Siswa
                </label>

                <select name="siswa_id" id="siswa_id" required>

                    <option value="">
                        -- Pilih Siswa --
                    </option>

                    @foreach($siswas as $siswa)

                        <option
                            value="{{ $siswa->id }}"
                            {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}
                        >
                            {{ $siswa->nis }} - {{ $siswa->nama }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="form-group">

                <label for="mata_pelajaran_id">
                    Mata Pelajaran
                </label>

                <select
                    name="mata_pelajaran_id"
                    id="mata_pelajaran_id"
                    required
                >

                    <option value="">
                        -- Pilih Mata Pelajaran --
                    </option>

                    @foreach($mataPelajarans as $mapel)

                        <option
                            value="{{ $mapel->id }}"
                            {{ old('mata_pelajaran_id') == $mapel->id ? 'selected' : '' }}
                        >
                            {{ $mapel->kode }} - {{ $mapel->nama }}
                            (KKM {{ $mapel->kkm }})
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="nilai-grid">

                <div class="form-group">

                    <label for="nilai_tugas">
                        Nilai Tugas
                    </label>

                    <input
                        type="number"
                        name="nilai_tugas"
                        id="nilai_tugas"
                        min="0"
                        max="100"
                        step="0.01"
                        value="{{ old('nilai_tugas') }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="nilai_uts">
                        Nilai UTS
                    </label>

                    <input
                        type="number"
                        name="nilai_uts"
                        id="nilai_uts"
                        min="0"
                        max="100"
                        step="0.01"
                        value="{{ old('nilai_uts') }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="nilai_uas">
                        Nilai UAS
                    </label>

                    <input
                        type="number"
                        name="nilai_uas"
                        id="nilai_uas"
                        min="0"
                        max="100"
                        step="0.01"
                        value="{{ old('nilai_uas') }}"
                        required
                    >

                </div>

            </div>


            <div class="form-group">

                <label for="semester">
                    Semester
                </label>

                <select name="semester" id="semester" required>

                    <option value="">
                        -- Pilih Semester --
                    </option>

                    <option
                        value="Ganjil"
                        {{ old('semester') == 'Ganjil' ? 'selected' : '' }}
                    >
                        Ganjil
                    </option>

                    <option
                        value="Genap"
                        {{ old('semester') == 'Genap' ? 'selected' : '' }}
                    >
                        Genap
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label for="tahun_ajaran">
                    Tahun Ajaran
                </label>

                <input
                    type="text"
                    name="tahun_ajaran"
                    id="tahun_ajaran"
                    value="{{ old('tahun_ajaran', '2026/2027') }}"
                    maxlength="20"
                    placeholder="Contoh: 2026/2027"
                    required
                >

            </div>


            <div class="buttons">

                <a
                    href="{{ route('nilai.index') }}"
                    class="btn btn-secondary"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Simpan Nilai
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>