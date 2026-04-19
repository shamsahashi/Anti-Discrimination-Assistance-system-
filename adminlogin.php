<?php
session_start();

// Already logged in — redirect immediately before any output
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    header("Location: admindashboard.php");
    exit;
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === "admin" && $password === "admin123") {
        $_SESSION['admin']      = true;
        $_SESSION['admin_user'] = $username;
        header("Location: admindashboard.php");
        exit;
    } else {
        $error = "Invalid username or password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — ADAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --navy:       #0f1f3d;
        --blue:       #1e4db7;
        --blue-light: #2f63d4;
        --gold:       #c8922a;
        --gold-light: #e8b04a;
        --cream:      #f7f5f0;
        --white:      #ffffff;
        --text:       #1a1a2e;
        --text-muted: #5a6175;
        --border:     #e2e5ec;
        --danger:     #dc2626;
        --danger-bg:  #fef2f2;
        --shadow-sm:  0 2px 8px rgba(15,31,61,.08);
        --shadow-md:  0 8px 32px rgba(15,31,61,.14);
        --radius:     12px;
        --radius-lg:  20px;
        --transition: 0.25s cubic-bezier(.4,0,.2,1);
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { height: 100%; }

    body {
        font-family: 'DM Sans', sans-serif;
        background: var(--navy);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }
    body::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 70% 60% at 80% 30%, rgba(30,77,183,.45) 0%, transparent 65%),
            radial-gradient(ellipse 50% 40% at 10% 80%, rgba(200,146,42,.15) 0%, transparent 60%);
        pointer-events: none;
    }
    body::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image: repeating-linear-gradient(
            0deg, transparent, transparent 39px,
            rgba(255,255,255,.02) 39px, rgba(255,255,255,.02) 40px
        );
        pointer-events: none;
    }

    .login-card {
        position: relative;
        z-index: 1;
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: 0 32px 80px rgba(0,0,0,.35);
        width: 100%;
        max-width: 420px;
        overflow: hidden;
    }

    .login-header {
        background: var(--navy);
        padding: 2.5rem 2.5rem 2rem;
        text-align: center;
        border-bottom: 1px solid rgba(255,255,255,.08);
        position: relative;
    }
    .login-header::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 80% 80% at 50% 120%, rgba(30,77,183,.4) 0%, transparent 70%);
        pointer-events: none;
    }

    .login-badge {
        position: relative;
        z-index: 1;
        width: 56px; height: 56px;
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        margin: 0 auto 1.1rem;
        box-shadow: 0 4px 20px rgba(200,146,42,.4);
    }
    .login-header h1 {
        position: relative;
        z-index: 1;
        font-family: 'Lora', Georgia, serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--white);
        margin-bottom: .3rem;
    }
    .login-header p {
        position: relative;
        z-index: 1;
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--gold);
    }

    .login-body { padding: 2.25rem 2.5rem 2.5rem; }

    .error-alert {
        display: flex;
        align-items: center;
        gap: .65rem;
        background: var(--danger-bg);
        border: 1px solid rgba(220,38,38,.2);
        border-left: 3px solid var(--danger);
        border-radius: var(--radius);
        padding: .85rem 1rem;
        margin-bottom: 1.5rem;
        font-size: .85rem;
        color: var(--danger);
        font-weight: 600;
    }

    .field { margin-bottom: 1.25rem; }
    .field label {
        display: block;
        font-size: .8rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: .45rem;
        letter-spacing: .02em;
    }
    .field-wrap { position: relative; }
    .field-icon {
        position: absolute;
        left: .9rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: .9rem;
        pointer-events: none;
    }
    .field input {
        width: 100%;
        padding: .75rem 1rem .75rem 2.5rem;
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        font-family: 'DM Sans', sans-serif;
        font-size: .93rem;
        color: var(--text);
        background: var(--white);
        transition: border-color var(--transition), box-shadow var(--transition);
        outline: none;
        margin: 0;
    }
    .field input:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(30,77,183,.1);
    }

    .login-btn {
        width: 100%;
        padding: .9rem;
        background: var(--navy);
        color: var(--white);
        font-family: 'DM Sans', sans-serif;
        font-size: .9rem;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        border: none;
        border-radius: var(--radius);
        cursor: pointer;
        transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
        box-shadow: var(--shadow-sm);
        margin-top: .5rem;
    }
    .login-btn:hover {
        background: var(--blue);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .login-footer {
        text-align: center;
        padding: 1.1rem;
        border-top: 1px solid var(--border);
        background: #fafbfc;
    }
    .login-footer p {
        font-size: .77rem;
        color: var(--text-muted);
    }
    .login-footer a {
        color: var(--blue);
        font-weight: 600;
        text-decoration: none;
    }
    .login-footer a:hover { color: var(--navy); }
    </style>
</head>
<body>

<div class="login-card">

    <div class="login-header">
        <div class="login-badge">⚖️</div>
        <h1>ADAS Admin Portal</h1>
        <p>Authorized Personnel Only</p>
    </div>

    <div class="login-body">

        <?php if ($error): ?>
            <div class="error-alert">⚠️ <?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" autocomplete="off">

            <div class="field">
                <label for="username">Username</label>
                <div class="field-wrap">
                    <span class="field-icon">👤</span>
                    <input type="text" id="username" name="username"
                           placeholder="Enter your username" required
                           value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                </div>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <div class="field-wrap">
                    <span class="field-icon">🔒</span>
                    <input type="password" id="password" name="password"
                           placeholder="Enter your password" required>
                </div>
            </div>

            <button type="submit" class="login-btn">Sign In →</button>

        </form>

    </div>

    <div class="login-footer">
        <p><a href="index.php">← Return to ADAS Homepage</a></p>
    </div>

</div>

</body>
</html>