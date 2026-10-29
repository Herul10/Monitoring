<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Tambah Siswa</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            background: #f4f7fb;
            padding: 40px;
        }

        .card {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
        }

        h1 {
            margin-bottom: 25px;
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
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }

        textarea {
            min-height: 100px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        button,
        a {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #2563eb;
            color: white;
        }

        .back {
            background: #64748b;
            color: white;
        }

    </style>

</head>

<body>

<div class="card">

    <h1>
        Tambah Data Siswa
    </h1>


    <form
        action="{{ route('siswa.store') }}"
        method="POST"
    >

        @csrf


        <div class="form-group">

            <label>NIS</label>

            <input
                type="text"
                name="nis"
                value="{{ old('nis') }}"
                required
            >

            @error('nis')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <div class="form-group">

            <label>Nama Siswa</label>

            <input
                type="text"
                name="nama"
                value="{{ old('nama') }}"
                required
            >

            @error('nama')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <div class="form-group">

            <label>Jenis Kelamin</label>

            <select name="jenis_kelamin" required>

                <option value="">
                    -- Pilih --
                </option>

                <option value="L">
                    Laki-laki
                </option>

                <option value="P">
                    Perempuan
                </option>

            </select>

        </div>


        <div class="form-group">

            <label>Tempat Lahir</label>

            <input
                type="text"
                name="tempat_lahir"
                value="{{ old('tempat_lahir') }}"
            >

        </div>


        <div class="form-group">

            <label>Tanggal Lahir</label>

            <input
                type="date"
                name="tanggal_lahir"
                value="{{ old('tanggal_lahir') }}"
            >

        </div>


        <div class="form-group">

            <label>Alamat</label>

            <textarea name="alamat">{{ old('alamat') }}</textarea>

        </div>


        <div class="form-group">

            <label>No. HP</label>

            <input
                type="text"
                name="no_hp"
                value="{{ old('no_hp') }}"
            >

        </div>

        <div class="form-group">

            <label>Kelas</label>

            <select name="kelas_id">

                <option value="">-- Pilih Kelas --</option>

                @foreach ($kelas as $item)

                    <option
                        value="{{ $item->id }}"
                        {{ old('kelas_id') == $item->id ? 'selected' : '' }}
                    >
                        {{ $item->nama_kelas }}
                    </option>

                @endforeach

            </select>

            @error('kelas_id')
                <small style="color: red;">{{ $message }}</small>
            @enderror

        </div>


        <button type="submit">
            Simpan
        </button>


        <a
            href="{{ route('siswa.index') }}"
            class="back">

            Batal

        </a>

    </form>

</div>

</body>

</html>