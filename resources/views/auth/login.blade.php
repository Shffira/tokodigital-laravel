
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Toko Digital</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #f3f6fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            
            background: #FAF9F5;
        }

        /* ========================================
           CONTAINER
        ======================================== */

        .login-container {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;

            background: #ffffff;

            border-radius: 24px;
            overflow: hidden;

            display: grid;
            grid-template-columns: 1fr 1fr;

            box-shadow:
                0 20px 60px rgba(15, 23, 42, 0.12);
        }


        /* ========================================
           LEFT SIDE
        ======================================== */

        .login-left {
            position: relative;
            padding: 55px;

            background: #FAF9F5;

            color: #1C2321;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }


        /* Decorative Circle */

        .login-left::before {
    background: rgba(22, 135, 127, 0.07);
}


        .login-left::after {
    background: rgba(22, 135, 127, 0.05);
}


        /* ========================================
           BRAND
        ======================================== */

        .brand {
    position: relative;
    z-index: 2;

    display: flex;
    align-items: center;

    gap: 12px;

    font-size: 24px;
    font-weight: 700;

    color: #1C2321;
    letter-spacing: -0.6px;
}

.brand-icon {
    width: 42px;
    height: 42px;

    border-radius: 12px;

    background: #EDE9DF;

    border: 1px solid #DDD8CB;

    display: flex;
    align-items: center;
    justify-content: center;
}

.brand-icon svg {
    width: 21px;
    height: 21px;

    stroke: #1C2321;

    fill: none;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}


        /* ========================================
           HERO
        ======================================== */

        .hero-content {
            position: relative;
            z-index: 2;
        }


        .hero-content h1 {
            font-size: 42px;

            line-height: 1.15;

            font-weight: 800;

            margin-bottom: 20px;

            max-width: 430px;

            letter-spacing: -1px;
            .hero-content h1 {
    color: #1C2321;
}
        }


        .hero-content p {
    max-width: 420px;

    font-size: 15px;

    line-height: 1.8;

    color: #64706D;
}


        /* ========================================
           FEATURES
        ======================================== */

        .features {
            position: relative;
            z-index: 2;

            display: flex;
            flex-direction: column;

            gap: 14px;
        }


        .feature {
            display: flex;
            align-items: center;

            gap: 12px;

            font-size: 14px;

            color: #4F5D59;
        }


        .feature-icon {
    width: 30px;
    height: 30px;

    border-radius: 50%;

    background: #E8F2EF;

    display: flex;
    align-items: center;
    justify-content: center;
}


        .feature-icon svg {
    width: 15px;
    height: 15px;

    stroke: #16877F;

    fill: none;

    stroke-width: 2;

    stroke-linecap: round;
    stroke-linejoin: round;
}


        /* ========================================
           RIGHT SIDE
        ======================================== */

        .login-right {
    padding: 55px;

    background: #FFFFFF;

    display: flex;
    align-items: center;
    justify-content: center;
}


        .login-form {
            width: 100%;
            max-width: 390px;
        }


        /* ========================================
           HEADER
        ======================================== */

        .form-header {
            margin-bottom: 35px;
        }


        .form-header h2 {
            display: flex;
            align-items: center;

            gap: 10px;

            font-size: 30px;

            font-weight: 800;

            color: #111827;

            margin-bottom: 10px;
        }


        .welcome-icon {
            width: 28px;
            height: 28px;
        }


        .welcome-icon svg {
    width: 100%;
    height: 100%;

    stroke: #8A8F8C;

    fill: none;

    stroke-width: 1.8;

    stroke-linecap: round;
    stroke-linejoin: round;
}


        .form-header p {
            font-size: 14px;

            line-height: 1.6;

            color: #6b7280;
        }


        /* ========================================
           ERROR
        ======================================== */

        .alert-error {
            background: #fef2f2;

            border: 1px solid #fecaca;

            color: #b91c1c;

            padding: 13px 15px;

            border-radius: 10px;

            font-size: 13px;

            margin-bottom: 20px;
        }


        .alert-error ul {
            margin-left: 18px;
        }


        /* ========================================
           FORM
        ======================================== */

        .form-group {
            margin-bottom: 21px;
        }


        .form-label {
            display: block;

            font-size: 14px;

            font-weight: 600;

            color: #374151;

            margin-bottom: 8px;
        }


        .input-wrapper {
            position: relative;
        }


        .form-input {
            width: 100%;

            height: 50px;

            padding: 0 15px;

            border: 1px solid #d1d5db;

            border-radius: 10px;

            outline: none;

            font-family: inherit;

            font-size: 14px;

            color: #111827;

            background: white;

            transition: all 0.2s ease;
        }


        .form-input:focus {
            border-color: #16877F;

            box-shadow:
                0 0 0 4px rgba(22,135,127,0.10);
        }


        .form-input::placeholder {
            color: #9ca3af;
        }


        .password-input {
            padding-right: 50px;
        }


        /* ========================================
           PASSWORD TOGGLE
        ======================================== */

        .toggle-password {
            position: absolute;

            right: 15px;
            top: 50%;

            transform: translateY(-50%);

            border: none;

            background: transparent;

            cursor: pointer;

            color: #64748b;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 3px;
        }


        .toggle-password:hover {
            color: #163b68;
        }


        .toggle-password svg {
            width: 19px;
            height: 19px;

            stroke: currentColor;

            fill: none;

            stroke-width: 1.8;

            stroke-linecap: round;

            stroke-linejoin: round;
        }


        /* ========================================
           FIELD ERROR
        ======================================== */

        .input-error {
            margin-top: 7px;

            font-size: 12px;

            color: #dc2626;
        }


        /* ========================================
           REMEMBER
        ======================================== */

        .remember {
            display: flex;
            align-items: center;

            gap: 8px;

            font-size: 13px;

            color: #6b7280;

            margin-bottom: 25px;

            cursor: pointer;
        }


        .remember input {
            width: 16px;
            height: 16px;

            accent-color: #163b68;

            cursor: pointer;
        }


        /* ========================================
           LOGIN BUTTON
        ======================================== */

        .login-button {
    width: 100%;

    height: 50px;

    border: none;

    border-radius: 10px;

    background: #16877F;

    color: white;

    font-family: inherit;

    font-size: 14px;

    font-weight: 700;

    cursor: pointer;

    transition: all 0.2s ease;
}

        .login-button:hover {
    background: #126F69;

    transform: translateY(-1px);

    box-shadow:
        0 8px 20px rgba(22,135,127,0.20);
}


        .login-button:active {
            transform: translateY(0);
        }


        /* ========================================
           ROLE INFO
        ======================================== */

        .role-info {
    margin-top: 28px;

    padding: 16px;

    border-radius: 12px;

    background: #F7F5ED;

    border: 1px solid #E5E2D8;
}


        .role-info-title {
            font-size: 13px;

            font-weight: 700;

            color: #374151;

            margin-bottom: 10px;
        }


        .role-list {
            display: flex;

            gap: 8px;

            flex-wrap: wrap;
        }


        .role {
    padding: 7px 11px;

    border-radius: 8px;

    background: #E8F2EF;

    color: #126F69;

    font-size: 12px;

    font-weight: 600;
}


        /* ========================================
           COPYRIGHT
        ======================================== */

        .copyright {
            text-align: center;

            margin-top: 25px;

            font-size: 11px;

            color: #9ca3af;
        }


        /* ========================================
           RESPONSIVE
        ======================================== */

        @media (max-width: 850px) {

            body {
                padding: 20px;
            }


            .login-container {
                grid-template-columns: 1fr;

                max-width: 500px;
            }


            .login-left {
                min-height: 300px;

                padding: 35px;
            }


            .hero-content {
                margin-top: 60px;
            }


            .hero-content h1 {
                font-size: 30px;
            }


            .features {
                display: none;
            }


            .login-right {
                padding: 40px 30px;
            }
        }


        @media (max-width: 480px) {

            body {
                padding: 0;
            }


            .login-container {
                min-height: 100vh;

                border-radius: 0;
            }


            .login-left {
                padding: 30px 25px;
            }


            .login-right {
                padding: 35px 25px;
            }


            .hero-content h1 {
                font-size: 27px;
            }


            .form-header h2 {
                font-size: 26px;
            }
        }
    </style>
</head>


<body>

<div class="login-container">


    {{-- =====================================
         BAGIAN KIRI
    ====================================== --}}

    <div class="login-left">


        {{-- BRAND --}}

        <div class="brand">

            <div class="brand-icon">

                {{-- Shopping Bag Icon --}}
                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="M6 8h12l1 12H5L6 8z"></path>
                    <path d="M9 8V6a3 3 0 0 1 6 0v2"></path>
                </svg>

            </div>

            <span>Toko Digital</span>

        </div>


        {{-- HERO --}}

        <div class="hero-content">

            <h1>
                Belanja lebih mudah dalam satu tempat.
            </h1>

            <p>
                Selamat datang di Toko Digital.
                Masuk ke akun Anda untuk mengakses
                berbagai fitur dan layanan toko.
            </p>

        </div>


        {{-- FEATURES --}}

        <div class="features">


            <div class="feature">

                <div class="feature-icon">

                    {{-- Check Icon --}}
                    <svg viewBox="0 0 24 24">

                        <path d="M5 12l4 4L19 6"></path>

                    </svg>

                </div>

                <span>
                    Belanja dengan mudah dan cepat
                </span>

            </div>


            <div class="feature">

                <div class="feature-icon">

                    {{-- Check Icon --}}
                    <svg viewBox="0 0 24 24">

                        <path d="M5 12l4 4L19 6"></path>

                    </svg>

                </div>

                <span>
                    Kelola aktivitas toko dengan praktis
                </span>

            </div>


            <div class="feature">

                <div class="feature-icon">

                    {{-- Check Icon --}}
                    <svg viewBox="0 0 24 24">

                        <path d="M5 12l4 4L19 6"></path>

                    </svg>

                </div>

                <span>
                    Sistem aman untuk pengguna
                </span>

            </div>


        </div>

    </div>


    {{-- =====================================
         BAGIAN KANAN
    ====================================== --}}

    <div class="login-right">


        <div class="login-form">


            {{-- HEADER --}}

            <div class="form-header">

                <h2>

                    <span class="welcome-icon">

                        {{-- Spark / Welcome Icon --}}
                        <svg viewBox="0 0 24 24">

                            <path d="M12 3v4"></path>

                            <path d="M12 17v4"></path>

                            <path d="M3 12h4"></path>

                            <path d="M17 12h4"></path>

                            <path d="M5.6 5.6l2.8 2.8"></path>

                            <path d="M15.6 15.6l2.8 2.8"></path>

                            <path d="M18.4 5.6l-2.8 2.8"></path>

                            <path d="M8.4 15.6l-2.8 2.8"></path>

                        </svg>

                    </span>

                    Selamat Datang

                </h2>


                <p>
                    Silakan masuk menggunakan akun Anda
                    untuk melanjutkan.
                </p>

            </div>


            {{-- ERROR LOGIN --}}

            @if ($errors->any())

                <div class="alert-error">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =================================
                 FORM LOGIN
            ================================== --}}

            <form
                method="POST"
                action="{{ route('login') }}"
            >

                @csrf


                {{-- EMAIL --}}

                <div class="form-group">

                    <label
                        for="email"
                        class="form-label"
                    >
                        Email
                    </label>


                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-input"
                        placeholder="Masukkan email Anda"
                        required
                        autofocus
                        autocomplete="username"
                    >


                    @error('email')

                        <div class="input-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- PASSWORD --}}

                <div class="form-group">

                    <label
                        for="password"
                        class="form-label"
                    >
                        Password
                    </label>


                    <div class="input-wrapper">

                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-input password-input"
                            placeholder="Masukkan password Anda"
                            required
                            autocomplete="current-password"
                        >


                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword()"
                            id="passwordToggle"
                            aria-label="Tampilkan password"
                        >

                            {{-- Eye Icon --}}
                            <svg
                                id="eyeIcon"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"
                                ></path>

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="2.5"
                                ></circle>

                            </svg>

                        </button>

                    </div>


                    @error('password')

                        <div class="input-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- REMEMBER --}}

                <label class="remember">

                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                    >

                    <span>
                        Ingat saya
                    </span>

                </label>


                {{-- LOGIN BUTTON --}}

                <button
                    type="submit"
                    class="login-button"
                >
                    Masuk ke Akun
                </button>


            </form>


            {{-- =================================
                 ROLE INFORMATION
            ================================== --}}

            


            {{-- COPYRIGHT --}}

            <div class="copyright">

                © {{ date('Y') }} Toko Digital.
                All rights reserved.

            </div>


        </div>

    </div>

</div>


{{-- =====================================
     JAVASCRIPT
====================================== --}}

<script>

    function togglePassword() {

        const password =
            document.getElementById('password');

        const toggle =
            document.getElementById('passwordToggle');

        const eyeIcon =
            document.getElementById('eyeIcon');


        if (password.type === 'password') {

            password.type = 'text';

            toggle.setAttribute(
                'aria-label',
                'Sembunyikan password'
            );

            /*
             * Icon ketika password terlihat
             */
            eyeIcon.innerHTML = `
                <path d="M3 3l18 18"></path>
                <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"></path>
                <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.5 0 10 7 10 7a18.5 18.5 0 0 1-3.2 3.8"></path>
                <path d="M6.2 6.2C3.5 8.2 2 12 2 12s3.5 7 10 7c1.5 0 2.8-.3 4-.8"></path>
            `;

        } else {

            password.type = 'password';

            toggle.setAttribute(
                'aria-label',
                'Tampilkan password'
            );

            /*
             * Icon ketika password tersembunyi
             */
            eyeIcon.innerHTML = `
                <path
                    d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"
                ></path>

                <circle
                    cx="12"
                    cy="12"
                    r="2.5"
                ></circle>
            `;
        }

    }

</script>


</body>
</html>
```
