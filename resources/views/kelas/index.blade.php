<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas</title>

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
            max-width: 1200px;
            margin: 40px auto;
        }

        .header {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .header h1 {
            margin: 0 0 8px;
        }

        .header p {
            margin: 0;
            color: #777;
        }

        .top-menu {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-back {
            background: #6c757d;
            color: white;
        }

        .btn-add {
            background: #198754;
            color: white;
            margin-left: 8px;
        }

        .table-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #0d6efd;
            color: white;
            padding: 13px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .btn-edit {
            background: #ffc107;
            color: #000;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 13px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #777;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Data Kelas</h1>
        <p>Kelola data kelas dan wali kelas</p>
    </div>

    <div class="top-menu">
        <a href="{{ route('dashboard') }}" class="btn btn-back">
            ← Kembali ke Dashboard
        </a>

        <a href="{{ route('kelas.create') }}" class="btn btn-add">
            + Tambah Kelas
        </a>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-box">

        @if($kelas->count() > 0)

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Tingkat</th>
                        <th>Jurusan</th>
                        <th>Wali Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($kelas as $item)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $item->nama_kelas }}
                            </td>

                            <td>
                                {{ $item->tingkat }}
                            </td>

                            <td>
                                {{ $item->jurusan ?? '-' }}
                            </td>

                            <td>
                                {{ $item->guru->nama ?? '-' }}
                            </td>

                            <td>

                                <a href="{{ route('kelas.edit', ['id' => $item->id]) }}"
                                    class="btn btn-edit">
                                    Edit
                                </a>

                                <form action="{{ route('kelas.destroy', ['id' => $item->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data kelas ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-delete">
                                        Hapus
                                    </button>

                                </form>

                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        @else

            <div class="empty">
                <h3>Belum ada data kelas</h3>
                <p>Silakan tambahkan data kelas terlebih dahulu.</p>
            </div>

        @endif

    </div>

</div>

</body>
</html>