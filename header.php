<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anti-Discrimination Assistance System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>

    /* ══════════════════════════════════════════════
       DESIGN TOKENS
    ══════════════════════════════════════════════ */
    :root {
        --navy:         #0f1f3d;
        --navy-mid:     #1a3260;
        --blue:         #1e4db7;
        --blue-light:   #2f63d4;
        --gold:         #c8922a;
        --gold-light:   #e8b04a;
        --cream:        #f7f5f0;
        --white:        #ffffff;
        --text:         #1a1a2e;
        --text-muted:   #5a6175;
        --border:       #e2e5ec;
        --shadow-sm:    0 2px 8px rgba(15,31,61,.08);
        --shadow-md:    0 8px 32px rgba(15,31,61,.12);
        --shadow-lg:    0 20px 60px rgba(15,31,61,.16);
        --radius:       12px;
        --radius-lg:    20px;
        --transition:   0.25s cubic-bezier(.4,0,.2,1);
    }

    /* ══════════════════════════════════════════════
       RESET & BASE
    ══════════════════════════════════════════════ */
    *, *::before, *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    html { scroll-behavior: smooth; }

    body {
        font-family: 'DM Sans', sans-serif;
        color: var(--text);
        background: var(--white);
        line-height: 1.7;
        -webkit-font-smoothing: antialiased;
    }

    /* ══════════════════════════════════════════════
       TYPOGRAPHY
    ══════════════════════════════════════════════ */
    h1, h2, h3, h4 {
        font-family: 'Lora', Georgia, serif;
        line-height: 1.2;
        letter-spacing: -0.01em;
        color: var(--navy);
        margin-top: 0;
    }

    h1 { font-size: clamp(2.4rem, 5vw, 3.8rem); font-weight: 700; letter-spacing: -0.02em; }
    h2 { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 700; }
    h3 { font-size: 1.15rem; font-weight: 700; }

    p {
        color: var(--text-muted);
        line-height: 1.8;
    }

    a { text-decoration: none; }

    /* ══════════════════════════════════════════════
       LAYOUT UTILITIES
    ══════════════════════════════════════════════ */
    .container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .section { padding: 6rem 0; }
    .section-alt { background: var(--cream); }

    .section-eyebrow {
        display: inline-block;
        font-family: 'DM Sans', sans-serif;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .15em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: .75rem;
    }

    .two-col-grid {
        display: grid;
        grid-template-columns: 1fr 1.4fr;
        gap: 5rem;
        align-items: start;
    }

    .centered-header {
        text-align: center;
        max-width: 620px;
        margin: 0 auto 3.5rem;
    }
    .centered-header h2 { margin: .5rem 0 1rem; }
    .section-intro { font-size: .97rem; }

    .section-label-block h2 { margin-top: .5rem; margin-bottom: 1rem; }
    .section-label-block p  { font-size: .95rem; }

    .section-body p { margin-bottom: 1.2rem; font-size: .97rem; }
    .section-body p:last-child { margin-bottom: 0; }

    /* ══════════════════════════════════════════════
       BUTTONS
    ══════════════════════════════════════════════ */
    .primary-btn {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        background: var(--gold);
        color: var(--navy);
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: .85rem;
        letter-spacing: .06em;
        text-transform: uppercase;
        padding: .85rem 2rem;
        border-radius: var(--radius);
        transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
        box-shadow: 0 4px 20px rgba(200,146,42,.35);
    }
    .primary-btn:hover {
        background: var(--gold-light);
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(200,146,42,.45);
    }

    .ghost-btn {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        background: transparent;
        color: rgba(255,255,255,.85);
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: .85rem;
        padding: .85rem 1.75rem;
        border-radius: var(--radius);
        border: 1.5px solid rgba(255,255,255,.3);
        transition: all var(--transition);
    }
    .ghost-btn:hover {
        background: rgba(255,255,255,.1);
        border-color: rgba(255,255,255,.6);
        color: var(--white);
    }

    .secondary-btn {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        background: var(--navy);
        color: var(--white);
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: .8rem;
        letter-spacing: .04em;
        text-transform: uppercase;
        padding: .7rem 1.4rem;
        border-radius: var(--radius);
        transition: background var(--transition), transform var(--transition);
    }
    .secondary-btn:hover {
        background: var(--blue);
        transform: translateY(-1px);
    }

    button {
        background: var(--navy);
        color: var(--white);
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: .9rem;
        padding: .75rem 1.5rem;
        border: none;
        border-radius: var(--radius);
        cursor: pointer;
        transition: background var(--transition), transform var(--transition);
    }
    button:hover {
        background: var(--blue);
        transform: translateY(-1px);
    }

    /* ══════════════════════════════════════════════
       FORMS
    ══════════════════════════════════════════════ */
    label {
        display: block;
        font-size: .85rem;
        font-weight: 600;
        color: var(--navy);
        margin-bottom: .4rem;
        letter-spacing: .01em;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: .75rem 1rem;
        margin-bottom: 1.25rem;
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        font-family: 'DM Sans', sans-serif;
        font-size: .95rem;
        color: var(--text);
        background: var(--white);
        transition: border-color var(--transition), box-shadow var(--transition);
        outline: none;
    }
    input:focus,
    textarea:focus,
    select:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(30,77,183,.12);
    }
    textarea { resize: vertical; min-height: 120px; }

    /* ══════════════════════════════════════════════
       LEGACY CARD / GRID SUPPORT
    ══════════════════════════════════════════════ */
    .content-card {
        background: var(--white);
        padding: 3rem;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border);
    }

    .grid {
        display: flex;
        gap: 1.5rem;
        margin-top: 2.5rem;
        flex-wrap: wrap;
    }
    .grid-item {
        flex: 1;
        min-width: 220px;
        background: var(--cream);
        padding: 1.75rem;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        transition: box-shadow var(--transition), transform var(--transition);
    }
    .grid-item:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-3px);
    }

    .resource-list {
        margin-top: 1.25rem;
        padding-left: 0;
        list-style: none;
    }
    .resource-list li {
        padding: .9rem 0;
        border-bottom: 1px solid var(--border);
    }
    .resource-list li:last-child { border-bottom: none; }
    .resource-list a {
        color: var(--blue);
        font-weight: 600;
        font-size: .95rem;
        transition: color var(--transition);
    }
    .resource-list a:hover { color: var(--navy); }

    /* ══════════════════════════════════════════════
       HEADER / NAV
    ══════════════════════════════════════════════ */
    .site-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: rgba(15,31,61,.97);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(255,255,255,.07);
        box-shadow: 0 2px 24px rgba(0,0,0,.18);
    }

    .header-inner {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 2rem;
        height: 68px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
    }

    .header-brand {
        display: flex;
        align-items: center;
        gap: .75rem;
        flex-shrink: 0;
        text-decoration: none;
    }

    .brand-badge {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
        box-shadow: 0 2px 10px rgba(200,146,42,.4);
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .brand-name {
        font-family: 'Lora', Georgia, serif;
        font-size: .95rem;
        font-weight: 700;
        color: var(--white);
        letter-spacing: -.01em;
    }

    .brand-sub {
        font-size: .65rem;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--gold);
    }

    .site-nav {
        display: flex;
        align-items: center;
        gap: .25rem;
    }

    .site-nav a {
        font-size: .82rem;
        font-weight: 600;
        color: rgba(255,255,255,.65);
        padding: .45rem .75rem;
        border-radius: 8px;
        transition: color var(--transition), background var(--transition);
        letter-spacing: .01em;
        white-space: nowrap;
    }

    .site-nav a:hover {
        color: var(--white);
        background: rgba(255,255,255,.08);
    }

    .site-nav a.nav-cta {
        background: var(--gold);
        color: var(--navy);
        font-weight: 700;
        padding: .45rem 1rem;
        margin-left: .5rem;
    }
    .site-nav a.nav-cta:hover {
        background: var(--gold-light);
        color: var(--navy);
    }

    /* Mobile nav toggle */
    .nav-toggle {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: .4rem;
        border-radius: 8px;
        flex-direction: column;
        gap: 5px;
        transition: background var(--transition);
    }
    .nav-toggle:hover { background: rgba(255,255,255,.1); }
    .nav-toggle span {
        display: block;
        width: 22px;
        height: 2px;
        background: var(--white);
        border-radius: 2px;
        transition: transform var(--transition), opacity var(--transition);
    }

    /* ══════════════════════════════════════════════
       RESPONSIVE
    ══════════════════════════════════════════════ */
    @media (max-width: 900px) {
        .two-col-grid { grid-template-columns: 1fr; gap: 2.5rem; }
    }

    @media (max-width: 820px) {
        .nav-toggle { display: flex; transform: none !important; }

        .site-nav {
            display: none;
            position: absolute;
            top: 68px;
            left: 0;
            right: 0;
            background: rgba(12,24,48,.98);
            backdrop-filter: blur(12px);
            flex-direction: column;
            align-items: stretch;
            padding: 1rem 1.5rem 1.5rem;
            gap: .25rem;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }
        .site-nav.is-open { display: flex; }
        .site-nav a { padding: .7rem 1rem; font-size: .9rem; }
        .site-nav a.nav-cta { margin-left: 0; margin-top: .5rem; text-align: center; }
    }

    @media (max-width: 600px) {
        .section { padding: 4rem 0; }
        .content-card { padding: 1.75rem; }
        .grid { flex-direction: column; }
    }
    </style>
</head>
<body>

<header class="site-header">
    <div class="header-inner">

        <a href="index.php" class="header-brand">
            <div class="brand-badge">⚖️</div>
            <div class="brand-text">
                <span class="brand-name">ADAS</span>
                <span class="brand-sub">Anti-Discrimination System</span>
            </div>
        </a>

        <button class="nav-toggle" aria-label="Toggle navigation" onclick="this.nextElementSibling.classList.toggle('is-open')">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="site-nav">
            <a href="index.php">Home</a>
            <a href="housing.php">Housing</a>
            <a href="employment.php">Employment</a>
            <a href="other.php">Public</a>
            <a href="durham.php">Durham Resources</a>
            <a href="legal.php">Legal</a>
            <a href="team.php">Our Team</a>
            <a href="chatbot.php">🤖 Assistant</a>
            <a href="housing.php" class="nav-cta">File a Report</a>
        </nav>

    </div>
</header>