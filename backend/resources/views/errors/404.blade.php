<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Taman Zakat</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #EBF1D5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow: hidden;
            color: #1f2937;
        }

        /* Decorative Background */
        body::before {
            content: '';
            position: absolute;
            top: -15%;
            right: -5%;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(93, 166, 48, 0.08);
            z-index: 0;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: rgba(93, 166, 48, 0.05);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 10;
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        .error-card {
            background: #ffffff;
            border-radius: 40px;
            padding: 4rem 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        /* Glitch / 404 Text Effect */
        .error-code {
            font-size: 120px;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, #5DA630, #2d7d42);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            position: relative;
            display: inline-block;
            text-shadow: 0 10px 20px rgba(93, 166, 48, 0.2);
        }

        .error-code::after {
            content: '';
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 8px;
            background: #EBF1D5;
            border-radius: 10px;
        }

        .error-title {
            font-size: 28px;
            font-weight: 700;
            color: #0D2B05;
            margin-bottom: 1rem;
            margin-top: 1rem;
        }

        .error-desc {
            font-size: 15px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: #5DA630;
            color: #ffffff;
            padding: 1rem 2.5rem;
            border-radius: 9999px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 24px rgba(93, 166, 48, 0.25);
        }

        .action-btn:hover {
            background: #4a8a26;
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(93, 166, 48, 0.35);
        }

        .action-btn:active {
            transform: translateY(0);
        }

        .action-btn svg {
            width: 20px;
            height: 20px;
            transition: transform 0.3s;
        }

        .action-btn:hover svg {
            transform: translateX(-4px);
        }

        /* Floating Animation */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @media (max-width: 640px) {
            .error-card {
                padding: 3rem 1.5rem;
                border-radius: 30px;
            }
            .error-code { font-size: 96px; }
            .error-title { font-size: 22px; }
            .error-desc { font-size: 14px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-card floating-element">
            <div class="error-code">404</div>
            <h2 class="error-title">Halaman Tidak Ditemukan</h2>
            <p class="error-desc">
                Waduh! Sepertinya halaman yang Anda cari sedang dipindahkan, dihapus, atau mungkin tidak pernah ada.
            </p>
            <a href="{{ env('FRONTEND_URL', 'http://localhost:3000') }}" class="action-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
