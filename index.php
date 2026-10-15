<?php
$hostname = gethostname();
$serverIp = $_SERVER['SERVER_ADDR'] ?? 'N/A';
$port     = $_SERVER['SERVER_PORT'] ?? 'N/A';
$phpVersion = phpversion();
$date = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Docker Test - Port 8090</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .card {
            background: #1e293b;
            border-radius: 16px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
            border: 1px solid #334155;
        }
        .badge {
            display: inline-block;
            background: #22c55e;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 999px;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }
        h1 {
            font-size: 28px;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 8px;
        }
        .subtitle {
            color: #94a3b8;
            margin-bottom: 32px;
            font-size: 14px;
        }
        .info-grid {
            display: grid;
            gap: 12px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #0f172a;
            border-radius: 8px;
            padding: 12px 16px;
            border: 1px solid #1e3a5f;
        }
        .info-label {
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-value {
            color: #38bdf8;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Courier New', monospace;
        }
        .info-value.green { color: #22c55e; }
        .info-value.yellow { color: #fbbf24; }
        .divider {
            border: none;
            border-top: 1px solid #334155;
            margin: 24px 0;
        }
        .footer {
            text-align: center;
            color: #475569;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="card">
        <span class="badge">✓ RUNNING</span>
        <h1>🐳 Docker PHP Test</h1>
        <p class="subtitle">Container is up and responding on port 8090</p>

        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Port</span>
                <span class="info-value green">8090</span>
            </div>
            <div class="info-row">
                <span class="info-label">Server Port</span>
                <span class="info-value"><?= htmlspecialchars($port) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Server IP</span>
                <span class="info-value"><?= htmlspecialchars($serverIp) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Hostname</span>
                <span class="info-value yellow"><?= htmlspecialchars($hostname) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">PHP Version</span>
                <span class="info-value"><?= htmlspecialchars($phpVersion) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Timestamp</span>
                <span class="info-value"><?= htmlspecialchars($date) ?></span>
            </div>
        </div>

        <hr class="divider">
        <p class="footer">PHP Docker Test Page &mdash; <?= date('Y') ?></p>
    </div>
</body>
</html>
