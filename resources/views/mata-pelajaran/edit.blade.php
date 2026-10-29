<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Mata Pelajaran</title>

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

        input {
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

        .error-box {
            background: #f8d7da;
            color: #842029;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Edit Mata Pelajaran</h1>

        <p>Perbarui data mata pelajaran.</p>

        @if($errors->any())

            <div class="error-box">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('mata-pelajaran.update', ['id' => $mataPelajaran->id]) }}"
              method="POST">

            @csrf

            @method('PUT')

            <div class="form-group">

                <label>Kode Mata Pelajaran</label>

                <input
                    type="text"
                    name="kode"
                    value="{{ old('kode', $mataPelajaran->kode) }}"
                    required
                >

            </div>

            <div class="form-group">

                <label>Nama Mata Pelajaran</label>

                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama', $mataPelajaran->nama) }}"
                    required
                >

            </div>

            <div class="form-group">

                <label>KKM</label>

                <input
                    type="number"
                    name="kkm"
                    value="{{ old('kkm', $mataPelajaran->kkm) }}"
                    min="0"
                    max="100"
                    required
                >

            </div>

            <a href="{{ route('mata-pelajaran.index') }}"
               class="btn btn-back">
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