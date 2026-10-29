<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Data Siswa - SI Monitoring</title>

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
            padding: 35px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 28px;
        }

        .header p {
            color: #64748b;
            margin-top: 7px;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-back {
            background: #64748b;
            color: white;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,.05);
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f1f5f9;
            text-align: left;
            padding: 14px;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .actions form {
            display: inline;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #64748b;
        }

    </style>

</head>

<body>

<div class="container">

    <a href="{{ route('dashboard') }}"
       class="btn btn-back">

        ← Kembali ke Dashboard

    </a>


    <div class="header">

        <div>

            <h1>
                Data Siswa
            </h1>

            <p>
                Kelola data siswa sekolah
            </p>

        </div>


        <a href="{{ route('siswa.create') }}"
           class="btn btn-primary">

            + Tambah Siswa

        </a>

    </div>


    @if(session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif


    <div class="card">

        @if($siswas->count() > 0)

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>NIS</th>

                        <th>Nama Siswa</th>

                        <th>Jenis Kelamin</th>

                        <th>Tempat Lahir</th>

                        <th>No. HP</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($siswas as $siswa)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $siswa->nis }}
                            </td>

                            <td>
                                {{ $siswa->nama }}
                            </td>

                            <td>
                                {{ $siswa->jenis_kelamin == 'L'
                                    ? 'Laki-laki'
                                    : 'Perempuan' }}
                            </td>

                            <td>
                                {{ $siswa->tempat_lahir ?? '-' }}
                            </td>

                            <td>
                                {{ $siswa->no_hp ?? '-' }}
                            </td>

                            <td>

                                <div class="actions">

                                    <a
                                        href="{{ route('siswa.edit', $siswa) }}"
                                        class="btn btn-warning">

                                        Edit

                                    </a>


                                    <form
                                        action="{{ route('siswa.destroy', $siswa) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">

                <h3>
                    Belum Ada Data Siswa
                </h3>

                <p>
                    Silakan tambahkan data siswa.
                </p>

            </div>

        @endif

    </div>

</div>

</body>

</html>