<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoBuddy - Travel Planning Made Easy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
        }

        .header {
            height: 68px;
            background: white;
            border-bottom: 1px solid #eee;
            padding: 0 24px;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: bold;
            font-size: 1.5rem;
            text-decoration: none;
            color: #1a73e8;
        }

        .logo-img {
            width: 80px;
            height: auto;
        }

        .nav {
            display: flex;
            gap: 48px;
        }

        .nav a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .welcome-text {
            font-weight: 600;
            font-size: 15px;
            color: #333;
        }

        .btn-logout {
            padding: 10px 18px;
            background: #FF3B30;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
        }

        .hero {
            height: 697px;
            background-image: url('https://images8.alphacoders.com/719/719571.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.2);
        }

        .hero-content {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero-title {
            color: white;
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            margin-top: 240px;
        }

        .feature-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            max-width: 1000px;
            width: 100%;
            margin-top: 64px;
        }

        .feature-card {
            background: white;
            padding: 24px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: inherit;
            transition: transform 0.2s;
        }

        .feature-card:hover {
            transform: translateY(-2px);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #2F80ED;
        }

        .feature-text {
            font-size: 19px;
            font-weight: 500;
        }

        .covid-alert {
            position: absolute;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 48px);
            max-width: 1000px;
            background: #FCEFCA;
            padding: 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .covid-alert a {
            color: #2F80ED;
            text-decoration: none;
        }

        .footer {
            padding: 32px;
            text-align: center;
        }

        .footer-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .footer-copyright {
            font-size: 14px;
            color: #4F4F4F;
        }

        @media (max-width: 768px) {
            .nav {
                display: none;
            }

            .feature-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <a href="" class="logo">
                <img src="assets/images/GoBuddy.png" alt="GoBuddy Logo" class="logo-img">
            </a>
            <nav class="nav">
                <a href="">Home</a>
                <a href="trip">Trip</a>
                <a href="recommendation">Recommendation</a>
                <a href="about">About</a>
            </nav>
            <div class="user-section">
                <span class="welcome-text">Welcome, <?= session()->get('name') ?>!</span>
                <a href="logout" class="btn-logout">Log Out</a>
            </div>
        </div>
    </header>

    <?= $this->renderSection('content') ?>

    <main class="hero">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1 class="hero-title">Hi, ready to plan your next trip?</h1>
                <div class="feature-cards">
                    <a href="flights" class="feature-card">
                        <div class="feature-icon">✈</div>
                        <span class="feature-text">Flight</span>
                    </a>
                    <a href="hotels" class="feature-card">
                        <div class="feature-icon">🏢</div>
                        <span class="feature-text">Accommodation</span>
                    </a>
                    <a href="plans" class="feature-card">
                        <div class="feature-icon">🧳</div>
                        <span class="feature-text">Plan your Trip</span>
                    </a>
                </div>
                <div class="covid-alert">
                    <span>⚠️</span>
                    <p>
                        Check the latest COVID-19 restrictions before you travel.
                        <a href="/learn-more">Learn more</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <h2 class="footer-title">Explore the world with GoBuddy</h2>
        <p class="footer-copyright">© <?php echo date('Y'); ?> GoBuddy.com</p>
    </footer>
</body>
</html>