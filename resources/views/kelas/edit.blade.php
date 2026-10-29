<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container {
            width: 95%;
            max-width: 800px;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-save {
            background: #0d6efd;
            color: white;
        }

        .btn-back {
            background: #6c757d;
            color: white;
        }

        .error {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Edit Data Kelas</h1>

        <p>Perbarui informasi kelas.</p>

        @if($errors->any())
            <div style="background:#f8d7da; color:#842029; padding:15px; border-radius:7px; margin-bottom:20px;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kelas</label>

                <input type="text"
                       name="nama_kelas"
                       value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Tingkat</label>

                <select name="tingkat" required>

                    <option value="">-- Pilih Tingkat --</option>

                    <option value="X"
                        {{ old('tingkat', $kelas->tingkat) == 'X' ? 'selected' : '' }}>
                        X
                    </option>

                    <option value="XI"
                        {{ old('tingkat', $kelas->tingkat) == 'XI' ? 'selected' : '' }}>
                        XI
                    </option>

                    <option value="XII"
                        {{ old('tingkat', $kelas->tingkat) == 'XII' ? 'selected' : '' }}>
                        XII
                    </option>

                </select>
            </div>

            <div class="form-group">
                <label>Jurusan</label>

                <input type="text"
                       name="jurusan"
                       value="{{ old('jurusan', $kelas->jurusan) }}">
            </div>

            <div class="form-group">
                <label>Wali Kelas</label>

                <select name="guru_id">

                    <option value="">-- Pilih Wali Kelas --</option>

                    @foreach($gurus as $guru)

                        <option value="{{ $guru->id }}"
                            {{ old('guru_id', $kelas->guru_id) == $guru->id ? 'selected' : '' }}>

                            {{ $guru->nama }}

                        </option>

                    @endforeach

                </select>
            </div>

            <a href="{{ route('kelas.index') }}" class="btn btn-back">
                Kembali
            </a>

            <button type="submit" class="btn btn-save">
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

</body>
</html>