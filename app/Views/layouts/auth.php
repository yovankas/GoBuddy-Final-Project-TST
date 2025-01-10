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
            background-color: #f5f5f5;
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
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <a href="" class="logo">
                <img src="assets/images/GoBuddy.png" alt="GoBuddy Logo" class="logo-img">
            </a>
        </div>
    </header>

    <?= $this->renderSection('content') ?>
</body>
</html>

