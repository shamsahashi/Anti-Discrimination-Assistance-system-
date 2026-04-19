<?php
session_start();

// Auth guard
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: adminlogin.php");
    exit;
}

include("db_connect.php");

if (!isset($_GET['id'])) {
    header("Location: admindashboard.php");
    exit;
}

$id = intval($_GET['id']);

/* ══════════════════════════════════════════════
   HANDLE UPDATE
══════════════════════════════════════════════ */
$success_msg = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $status      = $_POST['status']      ?? 'Pending';
    $priority    = $_POST['priority']    ?? 'Medium';
    $admin_notes = $_POST['admin_notes'] ?? '';

    $stmt = $conn->prepare("UPDATE reports SET status=?, priority=?, admin_notes=? WHERE id=?");
    $stmt->bind_param("sssi", $status, $priority, $admin_notes, $id);
    $stmt->execute();
    $stmt->close();
    $success_msg = "Case updated successfully.";
}

/* ══════════════════════════════════════════════
   FETCH CASE
══════════════════════════════════════════════ */
$stmt = $conn->prepare("SELECT * FROM reports WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$case = $result->fetch_assoc();
$stmt->close();

if (!$case) {
    echo "<p>Case not found.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case #<?php echo $id; ?> — ADAS Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --navy:       #0f1f3d;
        --blue:       #1e4db7;
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
        -webkit-font-smoothing: antialiased;
    }

    /* ── Admin Header ─────────────────────────── */
    .admin-header {
        background: var(--navy);
        position: sticky; top: 0; z-index: 100;
        box-shadow: 0 2px 20px rgba(0,0,0,.2);
    }
    .admin-header-inner {
        max-width: 1300px; margin: 0 auto;
        padding: 0 2rem; height: 62px;
        display: flex; align-items: center;
        justify-content: space-between; gap: 1.5rem;
    }
    .admin-brand { display: flex; align-items: center; gap: .7rem; text-decoration: none; }
    .admin-brand-badge {
        width: 34px; height: 34px;
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        border-radius: 8px; display: flex; align-items: center;
        justify-content: center; font-size: .95rem;
    }
    .admin-brand-name { font-family: 'Lora', serif; font-size: .9rem; font-weight: 700; color: var(--white); }
    .admin-brand-sub  { font-size: .63rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--gold); }
    .header-btn {
        font-size: .78rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase;
        color: rgba(255,255,255,.7); background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.15); border-radius: 8px;
        padding: .4rem .85rem; cursor: pointer; font-family: 'DM Sans', sans-serif;
        transition: all var(--transition); text-decoration: none;
    }
    .header-btn:hover { background: rgba(255,255,255,.15); color: var(--white); }

    /* ── Page Layout ──────────────────────────── */
    .page-wrap { max-width: 1200px; margin: 0 auto; padding: 2rem; }

    .back-bar {
        display: flex; align-items: center; gap: .6rem;
        margin-bottom: 1.5rem;
    }
    .back-link {
        display: inline-flex; align-items: center; gap: .4rem;
        font-size: .83rem; font-weight: 600; color: var(--text-muted);
        text-decoration: none; transition: color var(--transition);
    }
    .back-link:hover { color: var(--navy); }

    .case-title-row {
        display: flex; align-items: center; gap: 1rem;
        margin-bottom: 2rem; flex-wrap: wrap;
    }
    .case-title-row h1 {
        font-family: 'Lora', serif;
        font-size: 1.6rem; font-weight: 700; color: var(--navy);
    }

    .status-badge {
        display: inline-flex; align-items: center; gap: .3rem;
        font-size: .75rem; font-weight: 700;
        letter-spacing: .06em; text-transform: uppercase;
        padding: .3rem .85rem; border-radius: 100px;
    }
    .status-badge::before { content: ''; width: 7px; height: 7px; border-radius: 50%; }
    .s-Pending     { background: var(--warning-bg); color: var(--warning); }
    .s-Pending::before { background: var(--warning); }
    .s-Under-Review, .s-In-Review { background: rgba(30,77,183,.08); color: var(--blue); }
    .s-Under-Review::before, .s-In-Review::before { background: var(--blue); }
    .s-Resolved    { background: var(--success-bg); color: var(--success); }
    .s-Resolved::before { background: var(--success); }
    .s-Closed      { background: var(--cream); color: var(--text-muted); }
    .s-Closed::before { background: var(--text-muted); }
    .s-Escalated   { background: var(--danger-bg); color: var(--danger); }
    .s-Escalated::before { background: var(--danger); }

    .priority-badge {
        font-size: .73rem; font-weight: 700; letter-spacing: .06em;
        text-transform: uppercase; padding: .25rem .7rem; border-radius: 100px;
    }
    .p-Low    { background: var(--success-bg); color: var(--success); }
    .p-Medium { background: var(--warning-bg); color: var(--warning); }
    .p-High   { background: var(--danger-bg); color: var(--danger); }
    .p-Urgent { background: var(--danger); color: var(--white); }

    /* ── Two-col layout ───────────────────────── */
    .case-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 1.5rem;
        align-items: start;
    }

    /* ── Cards ────────────────────────────────── */
    .card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    .card:last-child { margin-bottom: 0; }
    .card-header {
        display: flex; align-items: center; gap: .7rem;
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid var(--border);
        background: #fafbfc;
    }
    .card-header-icon {
        width: 30px; height: 30px;
        background: linear-gradient(135deg, var(--navy), var(--blue));
        border-radius: 7px;
        display: flex; align-items: center; justify-content: center;
        font-size: .85rem; flex-shrink: 0;
    }
    .card-header h3 { font-size: .95rem; font-weight: 700; color: var(--navy); }
    .card-body { padding: 1.5rem; }

    /* ── Detail Grid ──────────────────────────── */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }
    .detail-item {}
    .detail-item.full { grid-column: 1 / -1; }
    .detail-label {
        font-size: .72rem; font-weight: 700;
        letter-spacing: .1em; text-transform: uppercase;
        color: var(--text-muted); margin-bottom: .3rem;
    }
    .detail-value {
        font-size: .9rem; color: var(--text); font-weight: 500; line-height: 1.6;
    }
    .detail-value a { color: var(--blue); font-weight: 600; }
    .detail-value.desc {
        background: #fafbfc;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1rem; font-size: .88rem;
        color: var(--text-muted); line-height: 1.75;
        white-space: pre-wrap;
    }

    /* ── Admin Form ───────────────────────────── */
    .form-field { margin-bottom: 1.25rem; }
    .form-field:last-child { margin-bottom: 0; }
    .form-field label {
        display: block; font-size: .78rem; font-weight: 700;
        color: var(--navy); margin-bottom: .4rem; letter-spacing: .02em;
    }
    .form-field select,
    .form-field textarea {
        width: 100%;
        padding: .7rem 1rem;
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        font-family: 'DM Sans', sans-serif;
        font-size: .9rem; color: var(--text);
        background: var(--white); outline: none;
        transition: border-color var(--transition), box-shadow var(--transition);
        margin: 0;
        appearance: none; -webkit-appearance: none;
    }
    .form-field select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%235a6175' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        padding-right: 2.5rem;
    }
    .form-field select:focus,
    .form-field textarea:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(30,77,183,.1); }
    .form-field textarea { resize: vertical; min-height: 110px; }

    .update-btn {
        width: 100%; padding: .85rem;
        background: var(--navy); color: var(--white);
        font-family: 'DM Sans', sans-serif; font-size: .88rem;
        font-weight: 700; letter-spacing: .05em; text-transform: uppercase;
        border: none; border-radius: var(--radius);
        cursor: pointer; transition: background var(--transition), transform var(--transition);
        box-shadow: var(--shadow-sm);
    }
    .update-btn:hover { background: var(--blue); transform: translateY(-1px); }

    /* ── Success Alert ────────────────────────── */
    .success-alert {
        display: flex; align-items: center; gap: .65rem;
        background: var(--success-bg);
        border: 1px solid rgba(22,163,74,.2);
        border-left: 3px solid var(--success);
        border-radius: var(--radius);
        padding: .85rem 1rem; margin-bottom: 1.5rem;
        font-size: .85rem; color: var(--success); font-weight: 600;
    }

    /* ── Evidence ─────────────────────────────── */
    .evidence-block {
        display: flex; align-items: center; gap: .75rem;
        background: var(--cream);
        border: 1px solid var(--border);
        border-radius: var(--radius); padding: 1rem 1.25rem;
    }
    .evidence-icon { font-size: 1.4rem; }
    .evidence-block a { color: var(--blue); font-weight: 600; font-size: .88rem; }
    .no-evidence { font-size: .85rem; color: var(--text-muted); font-style: italic; }

    @media (max-width: 900px) {
        .case-layout { grid-template-columns: 1fr; }
        .detail-grid  { grid-template-columns: 1fr; }
    }
    </style>
</head>
<body>

<!-- Header -->
<div class="admin-header">
    <div class="admin-header-inner">
        <a href="admindashboard.php" class="admin-brand">
            <div class="admin-brand-badge">⚖️</div>
            <div style="display:flex;flex-direction:column;line-height:1.2;">
                <span class="admin-brand-name">ADAS</span>
                <span class="admin-brand-sub">Admin Dashboard</span>
            </div>
        </a>
        <div style="display:flex;align-items:center;gap:.75rem;">
            <a href="admindashboard.php" class="header-btn">← All Reports</a>
            <a href="adminlogout.php" class="header-btn">Sign Out</a>
        </div>
    </div>
</div>

<div class="page-wrap">

    <!-- Back -->
    <div class="back-bar">
        <a href="admindashboard.php" class="back-link">← Back to Dashboard</a>
    </div>

    <?php if ($success_msg): ?>
        <div class="success-alert">✅ <?php echo htmlspecialchars($success_msg); ?></div>
    <?php endif; ?>

    <!-- Title Row -->
    <div class="case-title-row">
        <h1>Case #<?php echo $case['id']; ?></h1>
        <?php
        $sc = 's-' . str_replace(' ', '-', $case['status'] ?? 'Pending');
        $pc = 'p-' . ($case['priority'] ?? 'Medium');
        ?>
        <span class="status-badge <?php echo $sc; ?>"><?php echo htmlspecialchars($case['status'] ?? 'Pending'); ?></span>
        <span class="priority-badge <?php echo $pc; ?>"><?php echo htmlspecialchars($case['priority'] ?? 'Medium'); ?></span>
        <?php
        $cat_icons = ['Housing'=>'🏠','Employment'=>'💼','Public Accommodations'=>'🏛️'];
        $ci = $cat_icons[$case['category']] ?? '📋';
        ?>
        <span style="font-size:.82rem;font-weight:600;color:var(--text-muted);"><?php echo $ci . ' ' . htmlspecialchars($case['category'] ?? '—'); ?></span>
        <?php if (!empty($case['submitted_at'])): ?>
            <span style="font-size:.8rem;color:var(--text-muted);margin-left:auto;">Submitted <?php echo date('F j, Y', strtotime($case['submitted_at'])); ?></span>
        <?php endif; ?>
    </div>

    <div class="case-layout">

        <!-- Left Column: Case Info -->
        <div>

            <!-- Complainant -->
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">👤</div>
                    <h3>Complainant Information</h3>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Full Name</div>
                            <div class="detail-value"><?php echo htmlspecialchars($case['name']); ?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value"><a href="mailto:<?php echo htmlspecialchars($case['email']); ?>"><?php echo htmlspecialchars($case['email']); ?></a></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone</div>
                            <div class="detail-value"><a href="tel:<?php echo htmlspecialchars($case['phone'] ?? ''); ?>"><?php echo htmlspecialchars($case['phone'] ?? '—'); ?></a></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Preferred Contact</div>
                            <div class="detail-value"><?php echo htmlspecialchars($case['preferred_contact'] ?? '—'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Incident Details -->
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">📋</div>
                    <h3>Incident Details</h3>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Category</div>
                            <div class="detail-value"><?php echo $ci . ' ' . htmlspecialchars($case['category'] ?? '—'); ?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Incident Date</div>
                            <div class="detail-value"><?php echo !empty($case['incident_date']) ? date('F j, Y', strtotime($case['incident_date'])) : '—'; ?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Incident Type</div>
                            <div class="detail-value"><?php echo htmlspecialchars($case['incident_type'] ?? '—'); ?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Discrimination Basis</div>
                            <div class="detail-value"><?php echo htmlspecialchars($case['discrimination_type'] ?? '—'); ?></div>
                        </div>
                        <?php if (!empty($case['resolution'])): ?>
                        <div class="detail-item">
                            <div class="detail-label">Desired Resolution</div>
                            <div class="detail-value"><?php echo htmlspecialchars($case['resolution']); ?></div>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($case['employer_name']) || !empty($case['respondent_name'])): ?>
                        <div class="detail-item">
                            <div class="detail-label">Respondent / Employer</div>
                            <div class="detail-value"><?php echo htmlspecialchars($case['employer_name'] ?? $case['respondent_name'] ?? '—'); ?></div>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($case['witness_names'])): ?>
                        <div class="detail-item">
                            <div class="detail-label">Witnesses</div>
                            <div class="detail-value"><?php echo htmlspecialchars($case['witness_names']); ?></div>
                        </div>
                        <?php endif; ?>
                        <div class="detail-item full">
                            <div class="detail-label">Description</div>
                            <div class="detail-value desc"><?php echo htmlspecialchars($case['description'] ?? ''); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Evidence -->
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">📎</div>
                    <h3>Supporting Evidence</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($case['evidence_file'])): ?>
                        <div class="evidence-block">
                            <div class="evidence-icon">📄</div>
                            <div>
                                <div style="font-size:.78rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.08em;margin-bottom:.3rem;">Uploaded File</div>
                                <a href="uploads/<?php echo htmlspecialchars($case['evidence_file']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($case['evidence_file']); ?> ↗
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="no-evidence">No supporting files were uploaded with this report.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div><!-- /left col -->

        <!-- Right Column: Admin Actions -->
        <div>

            <!-- Case Management -->
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">⚙️</div>
                    <h3>Case Management</h3>
                </div>
                <div class="card-body">
                    <form method="POST">

                        <div class="form-field">
                            <label>Status</label>
                            <select name="status">
                                <?php foreach (['Pending','Under Review','In Review','Resolved','Escalated','Closed'] as $s): ?>
                                    <option value="<?php echo $s; ?>" <?php echo ($case['status']===$s)?'selected':''; ?>><?php echo $s; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-field">
                            <label>Priority</label>
                            <select name="priority">
                                <?php foreach (['Low','Medium','High','Urgent'] as $p): ?>
                                    <option value="<?php echo $p; ?>" <?php echo (($case['priority'] ?? 'Medium')===$p)?'selected':''; ?>><?php echo $p; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-field">
                            <label>Admin Notes</label>
                            <textarea name="admin_notes" placeholder="Internal notes, referral info, follow-up details…"><?php echo htmlspecialchars($case['admin_notes'] ?? ''); ?></textarea>
                        </div>

                        <button type="submit" class="update-btn">Save Changes →</button>
                    </form>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon">⚡</div>
                    <h3>Quick Actions</h3>
                </div>
                <div class="card-body" style="display:flex;flex-direction:column;gap:.6rem;">
                    <a href="mailto:<?php echo htmlspecialchars($case['email']); ?>"
                       style="display:flex;align-items:center;gap:.6rem;padding:.7rem 1rem;background:var(--cream);border:1px solid var(--border);border-radius:var(--radius);font-size:.85rem;font-weight:600;color:var(--navy);text-decoration:none;transition:all var(--transition);">
                        ✉️ Email Complainant
                    </a>
                    <a href="tel:<?php echo htmlspecialchars($case['phone'] ?? ''); ?>"
                       style="display:flex;align-items:center;gap:.6rem;padding:.7rem 1rem;background:var(--cream);border:1px solid var(--border);border-radius:var(--radius);font-size:.85rem;font-weight:600;color:var(--navy);text-decoration:none;transition:all var(--transition);">
                        📞 Call Complainant
                    </a>
                    <a href="legal.php" target="_blank"
                       style="display:flex;align-items:center;gap:.6rem;padding:.7rem 1rem;background:var(--cream);border:1px solid var(--border);border-radius:var(--radius);font-size:.85rem;font-weight:600;color:var(--navy);text-decoration:none;transition:all var(--transition);">
                        ⚖️ View Legal Resources
                    </a>
                    <a href="durham.php" target="_blank"
                       style="display:flex;align-items:center;gap:.6rem;padding:.7rem 1rem;background:var(--cream);border:1px solid var(--border);border-radius:var(--radius);font-size:.85rem;font-weight:600;color:var(--navy);text-decoration:none;transition:all var(--transition);">
                        🏙️ Durham Resources
                    </a>
                    <a href="admindashboard.php"
                       style="display:flex;align-items:center;gap:.6rem;padding:.7rem 1rem;background:var(--navy);border:1px solid transparent;border-radius:var(--radius);font-size:.85rem;font-weight:600;color:var(--white);text-decoration:none;transition:all var(--transition);">
                        ← Back to All Reports
                    </a>
                </div>
            </div>

        </div><!-- /right col -->

    </div><!-- /.case-layout -->
</div><!-- /.page-wrap -->

<?php $conn->close(); ?>
</body>
</html>