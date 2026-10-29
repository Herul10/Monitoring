<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Guru - SI Monitoring</title>

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
            padding: 40px;
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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 30px;
        }

        .header p {
            color: #64748b;
            margin-top: 8px;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
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
            padding: 15px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .empty {
            text-align: center;
            padding: 50px;
            color: #64748b;
        }

    </style>

</head>


<body>

<div class="container">

    <a
        href="{{ route('dashboard') }}"
        class="back">

        ← Kembali ke Dashboard

    </a>


    <div class="header">

        <div>

            <h1>
                Data Guru
            </h1>

            <p>
                Kelola data guru sekolah
            </p>

        </div>


        <a
            href="{{ route('guru.create') }}"
            class="btn btn-primary">

            + Tambah Guru

        </a>

    </div>


    @if(session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif


    <div class="card">

        @if($gurus->count() > 0)

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>NIP</th>

                        <th>Nama Guru</th>

                        <th>Jenis Kelamin</th>

                        <th>Mata Pelajaran</th>

                        <th>No. HP</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($gurus as $guru)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $guru->nip }}
                            </td>

                            <td>
                                {{ $guru->nama }}
                            </td>

                            <td>

                                @if($guru->jenis_kelamin == 'L')

                                    Laki-laki

                                @else

                                    Perempuan

                                @endif

                            </td>

                            <td>
                                {{ $guru->mata_pelajaran ?? '-' }}
                            </td>

                            <td>
                                {{ $guru->no_hp ?? '-' }}
                            </td>

                            <td>

                                <div class="actions">

                                    <a
                                        href="{{ route('guru.edit', $guru) }}"
                                        class="btn btn-warning">

                                        Edit

                                    </a>


                                    <form
                                        action="{{ route('guru.destroy', $guru) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data guru ini?')"
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
                    Belum Ada Data Guru
                </h3>

                <p>
                    Silakan tambahkan data guru.

                </p>

            </div>

        @endif

    </div>

</div>

</body>

</html>