<?php
session_start();

// Auth guard
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: adminlogin.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "antidiscrimination_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* ══════════════════════════════════════════════
   HANDLE STATUS UPDATE (inline from dashboard)
══════════════════════════════════════════════ */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $id     = intval($_POST['id']);
    $status = $_POST['status'];
    $notes  = $_POST['admin_notes'];
    $stmt = $conn->prepare("UPDATE reports SET status=?, admin_notes=? WHERE id=?");
    $stmt->bind_param("ssi", $status, $notes, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admindashboard.php" . ($_GET['filter'] ? "?filter=" . urlencode($_GET['filter']) : ""));
    exit;
}

/* ══════════════════════════════════════════════
   DASHBOARD COUNTS
══════════════════════════════════════════════ */
$total    = $conn->query("SELECT COUNT(*) as c FROM reports")->fetch_assoc()['c'];
$pending  = $conn->query("SELECT COUNT(*) as c FROM reports WHERE status='Pending'")->fetch_assoc()['c'];
$review   = $conn->query("SELECT COUNT(*) as c FROM reports WHERE status='Under Review' OR status='In Review'")->fetch_assoc()['c'];
$resolved = $conn->query("SELECT COUNT(*) as c FROM reports WHERE status='Resolved'")->fetch_assoc()['c'];
$closed   = $conn->query("SELECT COUNT(*) as c FROM reports WHERE status='Closed'")->fetch_assoc()['c'];
$escalated= $conn->query("SELECT COUNT(*) as c FROM reports WHERE status='Escalated'")->fetch_assoc()['c'];

/* ══════════════════════════════════════════════
   FILTER & SEARCH
══════════════════════════════════════════════ */
$filter  = $_GET['filter']  ?? '';
$search  = $_GET['search']  ?? '';
$cat     = $_GET['category'] ?? '';

$where = [];
$params = [];
$types  = '';

if ($filter !== '') { $where[] = "status = ?";    $params[] = $filter;  $types .= 's'; }
if ($cat    !== '') { $where[] = "category = ?";  $params[] = $cat;     $types .= 's'; }
if ($search !== '') { $where[] = "(name LIKE ? OR email LIKE ? OR description LIKE ?)";
                      $like = "%$search%";
                      $params[] = $like; $params[] = $like; $params[] = $like;
                      $types .= 'sss'; }

$sql = "SELECT * FROM reports" . ($where ? " WHERE " . implode(" AND ", $where) : "") . " ORDER BY id DESC";

if ($params) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}

$active_filter = $filter ?: $cat ?: $search ?: '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — ADAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --navy:       #0f1f3d;
        --navy-mid:   #1a3260;
        --blue:       #1e4db7;
        --blue-light: #2f63d4;
        --gold:       #c8922a;
        --gold-light: #e8b04a;
        --cream:      #f7f5f0;
        --white:      #ffffff;
        --text:       #1a1a2e;
        --text-muted: #5a6175;
        --border:     #e2e5ec;
        --success:    #16a34a;
        --success-bg: #f0fdf4;
        --warning:    #d97706;
        --warning-bg: #fffbeb;
        --danger:     #dc2626;
        --danger-bg:  #fef2f2;
        --purple:     #7c3aed;
        --purple-bg:  #f5f3ff;
        --shadow-sm:  0 2px 8px rgba(15,31,61,.08);
        --shadow-md:  0 8px 32px rgba(15,31,61,.12);
        --radius:     10px;
        --radius-lg:  16px;
        --transition: 0.22s cubic-bezier(.4,0,.2,1);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'DM Sans', sans-serif;
        background: #f0f2f7;
        color: var(--text);
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
    }

    /* ── Admin Header ─────────────────────────── */
    .admin-header {
        background: var(--navy);
        padding: 0;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 2px 20px rgba(0,0,0,.2);
    }
    .admin-header-inner {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
        height: 62px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
    }
    .admin-brand {
        display: flex;
        align-items: center;
        gap: .7rem;
        text-decoration: none;
    }
    .admin-brand-badge {
        width: 34px; height: 34px;
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: .95rem;
        box-shadow: 0 2px 8px rgba(200,146,42,.35);
    }
    .admin-brand-text { display: flex; flex-direction: column; line-height: 1.2; }
    .admin-brand-name { font-family: 'Lora', serif; font-size: .9rem; font-weight: 700; color: var(--white); }
    .admin-brand-sub  { font-size: .63rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--gold); }

    .admin-header-right { display: flex; align-items: center; gap: 1rem; }
    .admin-user-pill {
        display: flex; align-items: center; gap: .5rem;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 100px;
        padding: .35rem .9rem;
        font-size: .8rem; font-weight: 600; color: rgba(255,255,255,.8);
    }
    .logout-btn {
        font-size: .78rem; font-weight: 700;
        letter-spacing: .05em; text-transform: uppercase;
        color: rgba(255,255,255,.6);
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 8px;
        padding: .4rem .85rem;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: all var(--transition);
        text-decoration: none;
    }
    .logout-btn:hover { background: rgba(220,38,38,.2); border-color: rgba(220,38,38,.4); color: #fca5a5; }

    /* ── Layout ───────────────────────────────── */
    .admin-layout {
        display: grid;
        grid-template-columns: 220px 1fr;
        min-height: calc(100vh - 62px);
    }

    /* ── Sidebar ──────────────────────────────── */
    .admin-sidebar {
        background: var(--white);
        border-right: 1px solid var(--border);
        padding: 1.5rem 0;
    }
    .sidebar-section { margin-bottom: 1.5rem; }
    .sidebar-section-label {
        font-size: .67rem; font-weight: 700;
        letter-spacing: .14em; text-transform: uppercase;
        color: var(--text-muted);
        padding: 0 1.25rem;
        margin-bottom: .5rem;
    }
    .sidebar-link {
        display: flex; align-items: center; gap: .65rem;
        padding: .6rem 1.25rem;
        font-size: .85rem; font-weight: 600; color: var(--text-muted);
        text-decoration: none;
        transition: all var(--transition);
        border-left: 3px solid transparent;
        cursor: pointer; background: none; border-right: none;
        border-top: none; border-bottom: none;
        width: 100%; text-align: left;
        font-family: 'DM Sans', sans-serif;
    }
    .sidebar-link:hover { background: var(--cream); color: var(--navy); border-left-color: var(--border); }
    .sidebar-link.active { background: rgba(30,77,183,.06); color: var(--blue); border-left-color: var(--blue); }
    .sidebar-badge {
        margin-left: auto;
        background: var(--navy);
        color: var(--white);
        font-size: .67rem; font-weight: 700;
        padding: .15rem .5rem;
        border-radius: 100px;
        min-width: 20px; text-align: center;
    }
    .sidebar-badge.gold { background: var(--gold); }
    .sidebar-badge.red  { background: var(--danger); }

    /* ── Main Content ─────────────────────────── */
    .admin-main { padding: 2rem; max-width: 100%; overflow: hidden; }

    .page-title {
        font-family: 'Lora', serif;
        font-size: 1.5rem; font-weight: 700; color: var(--navy);
        margin-bottom: .3rem;
    }
    .page-sub { font-size: .85rem; color: var(--text-muted); margin-bottom: 2rem; }

    /* ── Stat Cards ───────────────────────────── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.25rem;
        box-shadow: var(--shadow-sm);
        transition: transform var(--transition), box-shadow var(--transition);
        cursor: pointer;
        text-decoration: none;
        display: block;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
    .stat-card.active-filter { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(30,77,183,.1); }
    .stat-icon { font-size: 1.3rem; margin-bottom: .6rem; }
    .stat-num  { font-size: 1.8rem; font-weight: 700; color: var(--navy); line-height: 1; margin-bottom: .2rem; }
    .stat-lbl  { font-size: .72rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--text-muted); }
    .stat-card.s-pending  .stat-num { color: var(--warning); }
    .stat-card.s-review   .stat-num { color: var(--blue); }
    .stat-card.s-resolved .stat-num { color: var(--success); }
    .stat-card.s-closed   .stat-num { color: var(--text-muted); }
    .stat-card.s-escalated .stat-num { color: var(--danger); }

    /* ── Toolbar ──────────────────────────────── */
    .toolbar {
        display: flex;
        align-items: center;
        gap: .85rem;
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
    }
    .search-wrap { position: relative; flex: 1; min-width: 200px; }
    .search-wrap input {
        width: 100%;
        padding: .65rem 1rem .65rem 2.4rem;
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        font-family: 'DM Sans', sans-serif;
        font-size: .88rem;
        color: var(--text);
        background: var(--white);
        outline: none;
        transition: border-color var(--transition), box-shadow var(--transition);
        margin: 0;
    }
    .search-wrap input:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(30,77,183,.1); }
    .search-icon {
        position: absolute; left: .8rem; top: 50%;
        transform: translateY(-50%); font-size: .85rem; pointer-events: none;
    }
    .toolbar select {
        padding: .65rem 2rem .65rem .9rem;
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        font-family: 'DM Sans', sans-serif;
        font-size: .85rem;
        color: var(--text);
        background: var(--white);
        outline: none;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%235a6175' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right .75rem center;
        transition: border-color var(--transition);
        margin: 0;
    }
    .toolbar select:focus { border-color: var(--blue); }
    .toolbar-btn {
        display: inline-flex; align-items: center; gap: .4rem;
        padding: .65rem 1.25rem;
        background: var(--navy); color: var(--white);
        font-family: 'DM Sans', sans-serif; font-size: .83rem; font-weight: 700;
        letter-spacing: .04em; text-transform: uppercase;
        border: none; border-radius: var(--radius);
        cursor: pointer; transition: background var(--transition);
        white-space: nowrap;
    }
    .toolbar-btn:hover { background: var(--blue); }
    .clear-btn {
        font-size: .82rem; font-weight: 600;
        color: var(--text-muted); text-decoration: none;
        padding: .65rem .75rem;
        border-radius: var(--radius);
        transition: all var(--transition);
    }
    .clear-btn:hover { background: var(--cream); color: var(--navy); }

    /* ── Table Card ───────────────────────────── */
    .table-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .table-card-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid var(--border);
    }
    .table-card-header h3 {
        font-size: .95rem; font-weight: 700; color: var(--navy);
    }
    .result-count { font-size: .8rem; color: var(--text-muted); font-weight: 600; }

    table { width: 100%; border-collapse: collapse; }
    thead th {
        background: #f8f9fb;
        padding: .75rem 1rem;
        font-size: .72rem; font-weight: 700;
        letter-spacing: .08em; text-transform: uppercase;
        color: var(--text-muted);
        border-bottom: 1px solid var(--border);
        text-align: left;
        white-space: nowrap;
    }
    tbody tr { border-bottom: 1px solid var(--border); transition: background var(--transition); }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #fafbfc; }
    td { padding: .85rem 1rem; vertical-align: middle; font-size: .85rem; }

    /* ── Status Badges ────────────────────────── */
    .status-badge {
        display: inline-flex; align-items: center; gap: .3rem;
        font-size: .72rem; font-weight: 700;
        letter-spacing: .06em; text-transform: uppercase;
        padding: .25rem .7rem; border-radius: 100px;
    }
    .status-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
    .status-Pending     { background: var(--warning-bg); color: var(--warning);  }
    .status-Pending::before { background: var(--warning); }
    .status-Under-Review, .status-In-Review {
        background: rgba(30,77,183,.08); color: var(--blue); }
    .status-Under-Review::before, .status-In-Review::before { background: var(--blue); }
    .status-Resolved    { background: var(--success-bg); color: var(--success); }
    .status-Resolved::before { background: var(--success); }
    .status-Closed      { background: var(--cream); color: var(--text-muted); }
    .status-Closed::before { background: var(--text-muted); }
    .status-Escalated   { background: var(--danger-bg); color: var(--danger); }
    .status-Escalated::before { background: var(--danger); }

    /* ── Priority Badges ──────────────────────── */
    .priority-badge {
        display: inline-block; font-size: .7rem; font-weight: 700;
        letter-spacing: .06em; text-transform: uppercase;
        padding: .2rem .6rem; border-radius: 100px;
    }
    .priority-Low    { background: var(--success-bg); color: var(--success); }
    .priority-Medium { background: var(--warning-bg); color: var(--warning); }
    .priority-High   { background: var(--danger-bg); color: var(--danger); }
    .priority-Urgent { background: var(--danger); color: var(--white); }

    /* ── Category Badges ──────────────────────── */
    .cat-badge {
        display: inline-flex; align-items: center; gap: .3rem;
        font-size: .72rem; font-weight: 700;
        padding: .2rem .65rem; border-radius: 100px;
        background: rgba(30,77,183,.08); color: var(--navy);
        letter-spacing: .04em;
    }

    /* ── Inline Quick-Update Form ─────────────── */
    .quick-form { display: flex; align-items: center; gap: .5rem; flex-wrap: wrap; }
    .quick-form select {
        padding: .35rem 1.75rem .35rem .6rem;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: .8rem; color: var(--text);
        background: var(--white);
        outline: none; cursor: pointer;
        appearance: none; -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%235a6175' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right .55rem center;
        margin: 0; width: auto;
        transition: border-color var(--transition);
    }
    .quick-form select:focus { border-color: var(--blue); }
    .quick-save-btn {
        padding: .35rem .8rem;
        background: var(--navy); color: var(--white);
        font-family: 'DM Sans', sans-serif;
        font-size: .75rem; font-weight: 700;
        border: none; border-radius: 8px;
        cursor: pointer; transition: background var(--transition);
        white-space: nowrap;
    }
    .quick-save-btn:hover { background: var(--blue); }

    /* ── Action Buttons ───────────────────────── */
    .action-btn {
        display: inline-flex; align-items: center; gap: .3rem;
        padding: .4rem .85rem;
        font-family: 'DM Sans', sans-serif;
        font-size: .78rem; font-weight: 700;
        border-radius: 8px; border: none;
        cursor: pointer; transition: all var(--transition);
        text-decoration: none; white-space: nowrap;
    }
    .btn-view { background: var(--navy); color: var(--white); }
    .btn-view:hover { background: var(--blue); }

    /* ── Description truncate ─────────────────── */
    .desc-cell { max-width: 220px; }
    .desc-text {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-size: .83rem; color: var(--text-muted); line-height: 1.5;
    }

    /* ── Empty State ──────────────────────────── */
    .empty-state {
        text-align: center; padding: 4rem 2rem;
        color: var(--text-muted);
    }
    .empty-state-icon { font-size: 2.5rem; margin-bottom: 1rem; opacity: .4; }
    .empty-state p { font-size: .9rem; }

    /* ── Responsive ───────────────────────────── */
    @media (max-width: 1100px) { .stats-row { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 860px)  {
        .admin-layout { grid-template-columns: 1fr; }
        .admin-sidebar { display: none; }
        .stats-row { grid-template-columns: repeat(2, 1fr); }
    }
    </style>
</head>
<body>

<!-- Admin Header -->
<div class="admin-header">
    <div class="admin-header-inner">
        <a href="admindashboard.php" class="admin-brand">
            <div class="admin-brand-badge">⚖️</div>
            <div class="admin-brand-text">
                <span class="admin-brand-name">ADAS</span>
                <span class="admin-brand-sub">Admin Dashboard</span>
            </div>
        </a>
        <div class="admin-header-right">
            <div class="admin-user-pill">👤 <?php echo htmlspecialchars($_SESSION['admin_user'] ?? 'Admin'); ?></div>
            <a href="index.php" class="logout-btn">← Public Site</a>
            <a href="adminlogout.php" class="logout-btn">Sign Out</a>
        </div>
    </div>
</div>

<div class="admin-layout">

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-section">
            <div class="sidebar-section-label">Navigation</div>
            <a href="admindashboard.php" class="sidebar-link active">📋 All Reports <span class="sidebar-badge"><?php echo $total; ?></span></a>
            <a href="admindashboard.php?filter=Pending" class="sidebar-link">🕐 Pending <span class="sidebar-badge gold"><?php echo $pending; ?></span></a>
            <a href="admindashboard.php?filter=Under+Review" class="sidebar-link">🔍 Under Review <span class="sidebar-badge"><?php echo $review; ?></span></a>
            <a href="admindashboard.php?filter=Escalated" class="sidebar-link">🚨 Escalated <span class="sidebar-badge red"><?php echo $escalated; ?></span></a>
            <a href="admindashboard.php?filter=Resolved" class="sidebar-link">✅ Resolved <span class="sidebar-badge"><?php echo $resolved; ?></span></a>
            <a href="admindashboard.php?filter=Closed" class="sidebar-link">📁 Closed <span class="sidebar-badge"><?php echo $closed; ?></span></a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-section-label">By Category</div>
            <a href="admindashboard.php?category=Housing" class="sidebar-link">🏠 Housing</a>
            <a href="admindashboard.php?category=Employment" class="sidebar-link">💼 Employment</a>
            <a href="admindashboard.php?category=Public+Accommodations" class="sidebar-link">🏛️ Public</a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-section-label">System</div>
            <a href="index.php" class="sidebar-link">🌐 Public Site</a>
            <a href="adminlogout.php" class="sidebar-link" style="color:var(--danger);">🔓 Sign Out</a>
        </div>
    </aside>

    <!-- Main -->
    <main class="admin-main">

        <div class="page-title">Reports Dashboard</div>
        <div class="page-sub">Manage and review all submitted discrimination reports.</div>

        <!-- Stats Row -->
        <div class="stats-row">
            <a href="admindashboard.php" class="stat-card s-total <?php echo (!$filter && !$cat) ? 'active-filter' : ''; ?>">
                <div class="stat-icon">📋</div>
                <div class="stat-num"><?php echo $total; ?></div>
                <div class="stat-lbl">Total</div>
            </a>
            <a href="admindashboard.php?filter=Pending" class="stat-card s-pending <?php echo $filter==='Pending' ? 'active-filter' : ''; ?>">
                <div class="stat-icon">🕐</div>
                <div class="stat-num"><?php echo $pending; ?></div>
                <div class="stat-lbl">Pending</div>
            </a>
            <a href="admindashboard.php?filter=Under+Review" class="stat-card s-review <?php echo ($filter==='Under Review'||$filter==='In Review') ? 'active-filter' : ''; ?>">
                <div class="stat-icon">🔍</div>
                <div class="stat-num"><?php echo $review; ?></div>
                <div class="stat-lbl">In Review</div>
            </a>
            <a href="admindashboard.php?filter=Escalated" class="stat-card s-escalated <?php echo $filter==='Escalated' ? 'active-filter' : ''; ?>">
                <div class="stat-icon">🚨</div>
                <div class="stat-num"><?php echo $escalated; ?></div>
                <div class="stat-lbl">Escalated</div>
            </a>
            <a href="admindashboard.php?filter=Resolved" class="stat-card s-resolved <?php echo $filter==='Resolved' ? 'active-filter' : ''; ?>">
                <div class="stat-icon">✅</div>
                <div class="stat-num"><?php echo $resolved; ?></div>
                <div class="stat-lbl">Resolved</div>
            </a>
            <a href="admindashboard.php?filter=Closed" class="stat-card s-closed <?php echo $filter==='Closed' ? 'active-filter' : ''; ?>">
                <div class="stat-icon">📁</div>
                <div class="stat-num"><?php echo $closed; ?></div>
                <div class="stat-lbl">Closed</div>
            </a>
        </div>

        <!-- Toolbar -->
        <form method="GET" class="toolbar">
            <div class="search-wrap">
                <span class="search-icon">🔍</span>
                <input type="text" name="search" placeholder="Search by name, email, or description…"
                       value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <select name="filter">
                <option value="">All Statuses</option>
                <?php foreach (['Pending','Under Review','In Review','Resolved','Escalated','Closed'] as $s): ?>
                    <option value="<?php echo $s; ?>" <?php echo $filter===$s?'selected':''; ?>><?php echo $s; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="category">
                <option value="">All Categories</option>
                <option value="Housing" <?php echo $cat==='Housing'?'selected':''; ?>>🏠 Housing</option>
                <option value="Employment" <?php echo $cat==='Employment'?'selected':''; ?>>💼 Employment</option>
                <option value="Public Accommodations" <?php echo $cat==='Public Accommodations'?'selected':''; ?>>🏛️ Public</option>
            </select>
            <button type="submit" class="toolbar-btn">Apply</button>
            <?php if ($filter || $search || $cat): ?>
                <a href="admindashboard.php" class="clear-btn">✕ Clear</a>
            <?php endif; ?>
        </form>

        <!-- Table -->
        <div class="table-card">
            <div class="table-card-header">
                <h3>
                    <?php
                    if ($filter) echo htmlspecialchars($filter) . " Reports";
                    elseif ($cat) echo htmlspecialchars($cat) . " Reports";
                    elseif ($search) echo "Search: \"" . htmlspecialchars($search) . "\"";
                    else echo "All Reports";
                    ?>
                </h3>
                <span class="result-count"><?php echo $result->num_rows; ?> record<?php echo $result->num_rows !== 1 ? 's' : ''; ?></span>
            </div>

            <?php if ($result->num_rows === 0): ?>
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <p>No reports found matching your filters.</p>
                </div>
            <?php else: ?>
            <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Submitted</th>
                        <th>Category</th>
                        <th>Complainant</th>
                        <th>Incident Date</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()):
                    $statusClass = 'status-' . str_replace(' ', '-', $row['status'] ?? 'Pending');
                    $priorityClass = 'priority-' . ($row['priority'] ?? 'Medium');
                ?>
                <tr>
                    <td><strong style="color:var(--navy);">#<?php echo $row['id']; ?></strong></td>
                    <td style="color:var(--text-muted);font-size:.8rem;white-space:nowrap;">
                        <?php echo isset($row['submitted_at']) ? date('M j, Y', strtotime($row['submitted_at'])) : '—'; ?>
                    </td>
                    <td>
                        <span class="cat-badge">
                            <?php
                            $cat_icon = ['Housing'=>'🏠','Employment'=>'💼','Public Accommodations'=>'🏛️'];
                            echo ($cat_icon[$row['category']] ?? '📋') . ' ' . htmlspecialchars($row['category'] ?? '—');
                            ?>
                        </span>
                    </td>
                    <td>
                        <div style="font-weight:600;color:var(--navy);font-size:.85rem;"><?php echo htmlspecialchars($row['name']); ?></div>
                        <div style="font-size:.78rem;color:var(--text-muted);"><?php echo htmlspecialchars($row['email']); ?></div>
                    </td>
                    <td style="white-space:nowrap;font-size:.83rem;"><?php echo $row['incident_date'] ?? '—'; ?></td>
                    <td class="desc-cell"><div class="desc-text"><?php echo htmlspecialchars($row['description'] ?? ''); ?></div></td>
                    <td>
                        <span class="priority-badge <?php echo $priorityClass; ?>">
                            <?php echo htmlspecialchars($row['priority'] ?? 'Medium'); ?>
                        </span>
                    </td>
                    <td>
                        <form method="POST" class="quick-form">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="admin_notes" value="<?php echo htmlspecialchars($row['admin_notes'] ?? ''); ?>">
                            <select name="status">
                                <?php foreach (['Pending','Under Review','In Review','Resolved','Escalated','Closed'] as $s): ?>
                                    <option value="<?php echo $s; ?>" <?php echo ($row['status']===$s)?'selected':''; ?>><?php echo $s; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" name="update" class="quick-save-btn">Save</button>
                        </form>
                        <div style="margin-top:.4rem;">
                            <span class="status-badge <?php echo $statusClass; ?>"><?php echo htmlspecialchars($row['status'] ?? 'Pending'); ?></span>
                        </div>
                    </td>
                    <td>
                        <a href="casedetails.php?id=<?php echo $row['id']; ?>" class="action-btn btn-view">View →</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
            </div>
            <?php endif; ?>
        </div>

    </main>
</div>

</body>
</html>
<?php $conn->close(); ?>