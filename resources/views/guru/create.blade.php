<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Guru - SI Monitoring</title>

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
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
        }

        .back {
            display: inline-block;
            background: #64748b;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,.06);
        }

        h1 {
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }

        textarea {
            min-height: 100px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-secondary {
            background: #64748b;
            color: white;
        }

    </style>

</head>


<body>

<div class="container">

    <a
        href="{{ route('guru.index') }}"
        class="back">

        ← Kembali ke Data Guru

    </a>


    <div class="card">

        <h1>
            Tambah Data Guru
        </h1>

        <p class="subtitle">
            Masukkan informasi guru
        </p>


        @if($errors->any())

            <div class="error">

                <strong>
                    Terdapat kesalahan:
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('guru.store') }}"
            method="POST"
        >

            @csrf


            <div class="form-group">

                <label>
                    NIP
                </label>

                <input
                    type="text"
                    name="nip"
                    value="{{ old('nip') }}"
                    placeholder="Masukkan NIP"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Nama Guru
                </label>

                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    placeholder="Masukkan nama guru"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Jenis Kelamin
                </label>

                <select
                    name="jenis_kelamin"
                    required
                >

                    <option value="">
                        -- Pilih Jenis Kelamin --
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

                <label>
                    Tempat Lahir
                </label>

                <input
                    type="text"
                    name="tempat_lahir"
                    value="{{ old('tempat_lahir') }}"
                    placeholder="Masukkan tempat lahir"
                >

            </div>


            <div class="form-group">

                <label>
                    Tanggal Lahir
                </label>

                <input
                    type="date"
                    name="tanggal_lahir"
                    value="{{ old('tanggal_lahir') }}"
                >

            </div>


            <div class="form-group">

                <label>
                    Alamat
                </label>

                <textarea
                    name="alamat"
                    placeholder="Masukkan alamat"
                >{{ old('alamat') }}</textarea>

            </div>


            <div class="form-group">

                <label>
                    No. HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp') }}"
                    placeholder="Masukkan nomor HP"
                >

            </div>


            <div class="form-group">

                <label>
                    Mata Pelajaran
                </label>

                <input
                    type="text"
                    name="mata_pelajaran"
                    value="{{ old('mata_pelajaran') }}"
                    placeholder="Contoh: Matematika"
                >

            </div>


            <div class="buttons">

                <button
                    type="submit"
                    class="btn btn-primary">

                    Simpan Guru

                </button>


                <a
                    href="{{ route('guru.index') }}"
                    class="btn btn-secondary">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>