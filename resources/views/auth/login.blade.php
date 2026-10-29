<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Sistem Informasi Monitoring Sekolah</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at 10% 20%, rgba(59, 130, 246, 0.35), transparent 30%),
                radial-gradient(circle at 90% 80%, rgba(14, 165, 233, 0.25), transparent 30%),
                linear-gradient(135deg, #0f172a 0%, #172554 50%, #1d4ed8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
            overflow-x: hidden;
        }

        /* =========================
           BACKGROUND DECORATION
        ========================= */

        .background-circle {
            position: fixed;
            border-radius: 50%;
            filter: blur(2px);
            pointer-events: none;
        }

        .circle-one {
            width: 250px;
            height: 250px;
            background: rgba(96, 165, 250, 0.12);
            top: -80px;
            left: -80px;
        }

        .circle-two {
            width: 320px;
            height: 320px;
            background: rgba(14, 165, 233, 0.10);
            right: -100px;
            bottom: -100px;
        }

        /* =========================
           LOGIN CONTAINER
        ========================= */

        .login-wrapper {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: rgba(255, 255, 255, 0.97);
            border-radius: 28px;
            overflow: hidden;
            box-shadow:
                0 30px 80px rgba(0, 0, 0, 0.30),
                0 10px 30px rgba(0, 0, 0, 0.10);
            position: relative;
            z-index: 2;
        }

        /* =========================
           LEFT SIDE
        ========================= */

        .login-info {
            position: relative;
            padding: 55px;
            color: white;
            background:
                linear-gradient(
                    145deg,
                    rgba(15, 23, 42, 0.98),
                    rgba(30, 64, 175, 0.96)
                );
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .login-info::before {
            content: "";
            position: absolute;
            width: 330px;
            height: 330px;
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: 50%;
            right: -160px;
            top: -120px;
        }

        .login-info::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 50%;
            left: -250px;
            bottom: -250px;
        }

        .brand {
            position: relative;
            z-index: 2;
        }

        .brand-icon {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.13);
            border: 1px solid rgba(255,255,255,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .brand h1 {
            font-size: 30px;
            line-height: 1.25;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .brand p {
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 15px;
            max-width: 410px;
        }

        .feature-list {
            position: relative;
            z-index: 2;
            list-style: none;
            margin-top: 35px;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 18px;
            color: #e2e8f0;
            font-size: 14px;
        }

        .feature-icon {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            border-radius: 10px;
            background: rgba(255,255,255,0.10);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .school-info {
            position: relative;
            z-index: 2;
            border-top: 1px solid rgba(255,255,255,0.12);
            padding-top: 20px;
        }

        .school-info strong {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .school-info span {
            font-size: 12px;
            color: #94a3b8;
        }

        /* =========================
           RIGHT SIDE
        ========================= */

        .login-form-section {
            padding: 55px 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
        }

        .login-form {
            width: 100%;
            max-width: 390px;
        }

        .form-header {
            margin-bottom: 35px;
        }

        .form-header .small-title {
            color: #2563eb;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 10px;
        }

        .form-header h2 {
            font-size: 30px;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        /* =========================
           ERROR
        ========================= */

        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            border-radius: 12px;
            padding: 13px 15px;
            margin-bottom: 22px;
            font-size: 13px;
            line-height: 1.5;
        }

        .alert ul {
            padding-left: 18px;
        }

        /* =========================
           INPUT
        ========================= */

        .form-group {
            margin-bottom: 21px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 9px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 17px;
            color: #94a3b8;
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            height: 52px;
            border: 1px solid #dbe3ef;
            border-radius: 12px;
            padding: 0 45px;
            font-size: 14px;
            color: #0f172a;
            background: #f8fafc;
            outline: none;
            transition: all 0.25s ease;
        }

        .input-wrapper input::placeholder {
            color: #94a3b8;
        }

        .input-wrapper input:focus {
            background: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.10);
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 16px;
            color: #94a3b8;
            padding: 5px;
        }

        .password-toggle:hover {
            color: #2563eb;
        }

        /* =========================
           BUTTON
        ========================= */

        .login-button {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.25);
            transition: all 0.25s ease;
            margin-top: 5px;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(37, 99, 235, 0.32);
        }

        .login-button:active {
            transform: translateY(0);
        }

        /* =========================
           FOOTER
        ========================= */

        .form-footer {
            text-align: center;
            margin-top: 28px;
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.6;
        }

        .form-footer strong {
            color: #64748b;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 850px) {
            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 520px;
            }

            .login-info {
                padding: 40px;
                min-height: 360px;
            }

            .feature-list {
                margin-top: 25px;
            }

            .school-info {
                margin-top: 20px;
            }

            .login-form-section {
                padding: 45px 40px;
            }
        }

        @media (max-width: 500px) {
            body {
                padding: 15px;
            }

            .login-wrapper {
                border-radius: 20px;
            }

            .login-info {
                padding: 30px;
            }

            .brand h1 {
                font-size: 25px;
            }

            .login-form-section {
                padding: 35px 25px;
            }

            .form-header h2 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>

    <div class="background-circle circle-one"></div>
    <div class="background-circle circle-two"></div>

    <div class="login-wrapper">

        <!-- =========================================
             BAGIAN INFORMASI SISTEM
        ========================================== -->

        <div class="login-info">

            <div>

                <div class="brand">

                    <div class="brand-icon">
                        🎓
                    </div>

                    <h1>
                        Sistem Informasi<br>
                        Monitoring Sekolah
                    </h1>

                    <p>
                        Platform berbasis web untuk membantu
                        pengelolaan kehadiran dan perkembangan
                        prestasi akademik siswa secara terintegrasi.
                    </p>

                </div>

                <ul class="feature-list">

                    <li>
                        <span class="feature-icon">📍</span>
                        Monitoring kehadiran berbasis lokasi
                    </li>

                    <li>
                        <span class="feature-icon">📊</span>
                        Monitoring nilai akademik siswa
                    </li>

                    <li>
                        <span class="feature-icon">👥</span>
                        Pengelolaan data siswa dan guru
                    </li>

                </ul>

            </div>

            <div class="school-info">

                <strong>SMKS PASUNDAN CIANJUR</strong>

                <span>
                    Sistem Informasi Monitoring Kehadiran dan
                    Perkembangan Prestasi Akademik Siswa
                </span>

            </div>

        </div>


        <!-- =========================================
             FORM LOGIN
        ========================================== -->

        <div class="login-form-section">

            <div class="login-form">

                <div class="form-header">

                    <div class="small-title">
                        Portal Pengguna
                    </div>

                    <h2>
                        Selamat Datang
                    </h2>

                    <p>
                        Silakan masuk menggunakan akun yang
                        telah terdaftar untuk mengakses sistem.
                    </p>

                </div>


                {{-- ERROR LOGIN --}}

                @if ($errors->any())

                    <div class="alert">

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                @endif


                <form
                    action="{{ route('login.process') }}"
                    method="POST"
                >

                    @csrf


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                ✉
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan email Anda"
                                autocomplete="email"
                                required
                            >

                        </div>

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                🔒
                            </span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan password Anda"
                                autocomplete="current-password"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword()"
                                id="passwordToggle"
                                aria-label="Tampilkan password"
                            >
                                👁
                            </button>

                        </div>

                    </div>


                    <!-- LOGIN BUTTON -->

                    <button
                        type="submit"
                        class="login-button"
                    >
                        Masuk ke Sistem
                    </button>

                </form>


                <div class="form-footer">

                    <strong>
                        Sistem Informasi Monitoring Sekolah
                    </strong>

                    <br>

                    © {{ date('Y') }} SMKS Pasundan Cianjur

                </div>

            </div>

        </div>

    </div>


    <script>

        function togglePassword() {

            const password =
                document.getElementById('password');

            const toggle =
                document.getElementById('passwordToggle');

            if (password.type === 'password') {

                password.type = 'text';

                toggle.textContent = '🙈';

                toggle.setAttribute(
                    'aria-label',
                    'Sembunyikan password'
                );

            } else {

                password.type = 'password';

                toggle.textContent = '👁';

                toggle.setAttribute(
                    'aria-label',
                    'Tampilkan password'
                );

            }

        }

    </script>

</body>

</html>