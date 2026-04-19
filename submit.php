<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("db_connect.php");

/* ══════════════════════════════════════════════
   ONLY ACCEPT POST
══════════════════════════════════════════════ */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

/* ══════════════════════════════════════════════
   COLLECT & SANITIZE
══════════════════════════════════════════════ */
function clean($val) {
    return htmlspecialchars(trim($val ?? ''), ENT_QUOTES, 'UTF-8');
}

$category            = clean($_POST['category'] ?? '');
$name                = clean($_POST['name'] ?? '');
$email               = clean($_POST['email'] ?? '');
$phone               = clean($_POST['phone'] ?? '');
$preferred_contact   = clean($_POST['preferred_contact'] ?? '');
$incident_date       = !empty($_POST['incident_date']) ? $_POST['incident_date'] : date("Y-m-d");
$description         = clean($_POST['description'] ?? '');
$resolution          = clean($_POST['resolution'] ?? '');

// Incident type — "Other" override
$incident_type = clean($_POST['incident_type'] ?? '');
if ($incident_type === 'Other' && !empty($_POST['other_incident_type'])) {
    $incident_type = clean($_POST['other_incident_type']);
}

// Discrimination type — "Other" override
$discrimination_type = clean($_POST['discrimination_type'] ?? '');
if ($discrimination_type === 'Other' && !empty($_POST['other_discrimination'])) {
    $discrimination_type = clean($_POST['other_discrimination']);
}

// Resolution — "Other" override
if ($resolution === 'Other' && !empty($_POST['other_resolution'])) {
    $resolution = clean($_POST['other_resolution']);
}

// Employer / Respondent (varies by form)
$employer_name    = clean($_POST['employer_name']    ?? $_POST['respondent_name']    ?? '');
$employer_address = clean($_POST['employer_address'] ?? $_POST['property_address']   ?? $_POST['incident_address'] ?? '');
$city             = clean($_POST['city']  ?? '');
$state            = clean($_POST['state'] ?? '');
$zip              = clean($_POST['zip']   ?? '');
$supervisor_name  = clean($_POST['supervisor_name']  ?? $_POST['individual_name'] ?? '');

// Job / employment fields
$job_title          = clean($_POST['job_title']          ?? '');
$employment_status  = clean($_POST['employment_status']  ?? '');

// Witness fields
$has_witness      = clean($_POST['has_witness']      ?? '');
$witness_names    = clean($_POST['witness_names']    ?? '');
$witness_contact  = clean($_POST['witness_contact']  ?? '');

// Default status
$status   = 'Pending';
$priority = 'Medium';

/* ══════════════════════════════════════════════
   FILE UPLOAD
══════════════════════════════════════════════ */
$evidence_file = '';
if (!empty($_FILES['evidence']['name'])) {
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    $allowed = ['pdf','doc','docx','jpg','jpeg','png','gif'];
    $ext = strtolower(pathinfo($_FILES['evidence']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, $allowed) && $_FILES['evidence']['size'] <= 10 * 1024 * 1024) {
        $evidence_file = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES['evidence']['name']));
        move_uploaded_file($_FILES['evidence']['tmp_name'], $upload_dir . $evidence_file);
    }
}

/* ══════════════════════════════════════════════
   INSERT INTO DATABASE
══════════════════════════════════════════════ */
$sql = "INSERT INTO reports 
    (category, name, email, phone, preferred_contact,
     incident_date, incident_type, discrimination_type,
     description, resolution,
     employer_name, employer_address, city, state, zip,
     supervisor_name, job_title, employment_status,
     has_witness, witness_names, witness_contact,
     evidence_file, status, priority)
VALUES (?,?,?,?,?,  ?,?,?,  ?,?,  ?,?,?,?,?,  ?,?,?,  ?,?,?,  ?,?,?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "ssssssssssssssssssssssss",
    $category, $name, $email, $phone, $preferred_contact,
    $incident_date, $incident_type, $discrimination_type,
    $description, $resolution,
    $employer_name, $employer_address, $city, $state, $zip,
    $supervisor_name, $job_title, $employment_status,
    $has_witness, $witness_names, $witness_contact,
    $evidence_file, $status, $priority
);

$submitted = $stmt->execute();
$new_id    = $conn->insert_id;
$stmt->close();
$conn->close();

include("includes/header.php");
?>

<style>
.confirm-hero {
    background: var(--navy);
    padding: 3.5rem 0 3rem;
    position: relative;
    overflow: hidden;
    text-align: center;
}
.confirm-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(ellipse 70% 80% at 50% 50%, rgba(22,163,74,.25) 0%, transparent 70%);
    pointer-events: none;
}
.confirm-hero .container { position: relative; z-index: 1; }
.confirm-check {
    width: 72px; height: 72px;
    background: linear-gradient(135deg, #16a34a, #22c55e);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 2rem;
    margin: 0 auto 1.25rem;
    box-shadow: 0 4px 24px rgba(22,163,74,.4);
    animation: popIn .5s cubic-bezier(.34,1.56,.64,1);
}
@keyframes popIn { from { transform: scale(0); opacity: 0; } to { transform: scale(1); opacity: 1; } }
.confirm-hero h1 { color: var(--white); font-size: clamp(1.8rem, 3.5vw, 2.4rem); margin-bottom: .6rem; }
.confirm-hero p  { color: rgba(255,255,255,.65); font-size: .97rem; max-width: 480px; margin: 0 auto; }

.confirm-body { background: var(--cream); padding: 3rem 0 5rem; }

.confirm-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 1.5rem;
    align-items: start;
}

.detail-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    margin-bottom: 1.25rem;
}
.detail-card:last-child { margin-bottom: 0; }
.detail-card-header {
    display: flex; align-items: center; gap: .65rem;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    background: #fafbfc;
}
.detail-card-icon {
    width: 28px; height: 28px;
    background: linear-gradient(135deg, var(--navy), var(--blue));
    border-radius: 6px; display: flex; align-items: center;
    justify-content: center; font-size: .8rem; flex-shrink: 0;
}
.detail-card-header h3 { font-size: .9rem; font-weight: 700; color: var(--navy); }
.detail-card-body { padding: 1.25rem 1.5rem; }

.detail-row {
    display: flex; gap: .75rem;
    padding: .6rem 0;
    border-bottom: 1px solid var(--border);
    font-size: .87rem;
}
.detail-row:last-child { border-bottom: none; padding-bottom: 0; }
.dr-label { font-weight: 700; color: var(--navy); min-width: 160px; flex-shrink: 0; }
.dr-value { color: var(--text-muted); }

.case-id-pill {
    display: inline-flex; align-items: center; gap: .5rem;
    background: var(--navy);
    color: var(--white);
    font-family: 'DM Sans', sans-serif;
    font-size: 1.1rem; font-weight: 700;
    padding: .6rem 1.4rem;
    border-radius: 100px;
    margin: 0 auto 1.5rem;
    box-shadow: var(--shadow-sm);
}

/* sidebar */
.confirm-sidebar { display: flex; flex-direction: column; gap: 1rem; }
.sidebar-info-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.4rem;
    box-shadow: var(--shadow-sm);
}
.sidebar-info-card h4 {
    font-size: .75rem; font-weight: 700; letter-spacing: .12em;
    text-transform: uppercase; color: var(--gold); margin-bottom: .85rem;
}
.sidebar-info-card p, .sidebar-info-card li {
    font-size: .83rem; color: var(--text-muted); line-height: 1.65;
}
.sidebar-info-card ul { padding-left: 1.1rem; display: flex; flex-direction: column; gap: .35rem; }
.sidebar-info-card.dark { background: var(--navy); border-color: transparent; }
.sidebar-info-card.dark h4 { color: var(--gold); }
.sidebar-info-card.dark p  { color: rgba(255,255,255,.6); }

.next-steps { display: flex; flex-direction: column; gap: .7rem; }
.step-item {
    display: flex; align-items: flex-start; gap: .75rem;
    font-size: .83rem; color: var(--text-muted); line-height: 1.55;
}
.step-num {
    width: 22px; height: 22px;
    background: var(--navy); color: var(--white);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: .7rem; font-weight: 700; flex-shrink: 0; margin-top: .05rem;
}

.home-btn {
    display: flex; align-items: center; justify-content: center; gap: .5rem;
    background: var(--gold); color: var(--navy);
    font-family: 'DM Sans', sans-serif; font-size: .85rem; font-weight: 700;
    letter-spacing: .05em; text-transform: uppercase;
    padding: .85rem 1.5rem; border-radius: var(--radius);
    text-decoration: none; transition: background var(--transition), transform var(--transition);
    box-shadow: 0 4px 16px rgba(200,146,42,.3);
    width: 100%;
}
.home-btn:hover { background: var(--gold-light); transform: translateY(-2px); }

@media (max-width: 860px) {
    .confirm-layout { grid-template-columns: 1fr; }
    .confirm-sidebar { order: -1; display: grid; grid-template-columns: 1fr 1fr; }
}
@media (max-width: 560px) {
    .confirm-sidebar { grid-template-columns: 1fr; }
    .dr-label { min-width: 120px; }
}
</style>

<!-- Confirmation Hero -->
<div class="confirm-hero">
    <div class="container">
        <div class="confirm-check">✓</div>
        <h1>Report Submitted Successfully</h1>
        <p>Thank you, <?php echo $name; ?>. Your report has been received and assigned to our team for review.</p>
    </div>
</div>

<div class="confirm-body">
    <div class="container">

        <?php if ($submitted && $new_id): ?>
            <div style="text-align:center;margin-bottom:2rem;">
                <div style="font-size:.75rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--text-muted);margin-bottom:.6rem;">Your Case Reference Number</div>
                <div class="case-id-pill">📋 Case #<?php echo $new_id; ?></div>
                <p style="font-size:.83rem;color:var(--text-muted);">Keep this number for your records. Our team will follow up within 3–5 business days.</p>
            </div>
        <?php endif; ?>

        <div class="confirm-layout">

            <!-- Report Summary -->
            <div>
                <div class="detail-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">👤</div>
                        <h3>Your Information</h3>
                    </div>
                    <div class="detail-card-body">
                        <div class="detail-row"><span class="dr-label">Name</span><span class="dr-value"><?php echo $name; ?></span></div>
                        <div class="detail-row"><span class="dr-label">Email</span><span class="dr-value"><?php echo $email; ?></span></div>
                        <div class="detail-row"><span class="dr-label">Phone</span><span class="dr-value"><?php echo $phone ?: '—'; ?></span></div>
                        <div class="detail-row"><span class="dr-label">Preferred Contact</span><span class="dr-value"><?php echo $preferred_contact ?: '—'; ?></span></div>
                    </div>
                </div>

                <div class="detail-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">📋</div>
                        <h3>Incident Summary</h3>
                    </div>
                    <div class="detail-card-body">
                        <div class="detail-row"><span class="dr-label">Category</span><span class="dr-value"><?php echo $category; ?></span></div>
                        <div class="detail-row"><span class="dr-label">Incident Date</span><span class="dr-value"><?php echo date('F j, Y', strtotime($incident_date)); ?></span></div>
                        <?php if ($incident_type): ?>
                        <div class="detail-row"><span class="dr-label">Incident Type</span><span class="dr-value"><?php echo $incident_type; ?></span></div>
                        <?php endif; ?>
                        <?php if ($discrimination_type): ?>
                        <div class="detail-row"><span class="dr-label">Discrimination Basis</span><span class="dr-value"><?php echo $discrimination_type; ?></span></div>
                        <?php endif; ?>
                        <?php if ($resolution): ?>
                        <div class="detail-row"><span class="dr-label">Desired Resolution</span><span class="dr-value"><?php echo $resolution; ?></span></div>
                        <?php endif; ?>
                        <div class="detail-row"><span class="dr-label">Status</span><span class="dr-value" style="color:#d97706;font-weight:600;">⏳ Pending Review</span></div>
                    </div>
                </div>

                <?php if ($description): ?>
                <div class="detail-card">
                    <div class="detail-card-header">
                        <div class="detail-card-icon">📝</div>
                        <h3>Your Description</h3>
                    </div>
                    <div class="detail-card-body">
                        <p style="font-size:.87rem;color:var(--text-muted);line-height:1.75;"><?php echo nl2br($description); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <aside class="confirm-sidebar">
                <div class="sidebar-info-card dark">
                    <h4>📅 What Happens Next</h4>
                    <div class="next-steps">
                        <div class="step-item"><div class="step-num" style="background:var(--gold);color:var(--navy);">1</div><span>Our team reviews your report within <strong style="color:var(--white);">3–5 business days</strong>.</span></div>
                        <div class="step-item"><div class="step-num" style="background:var(--gold);color:var(--navy);">2</div><span>You'll be contacted via your preferred method.</span></div>
                        <div class="step-item"><div class="step-num" style="background:var(--gold);color:var(--navy);">3</div><span>We'll discuss next steps — mediation, investigation, or legal referral.</span></div>
                    </div>
                </div>

                <div class="sidebar-info-card">
                    <h4>📞 Need Immediate Help?</h4>
                    <p>Contact us directly:</p>
                    <p style="margin-top:.6rem;"><a href="mailto:support@antidiscrimination.org" style="color:var(--blue);font-weight:600;">support@antidiscrimination.org</a></p>
                    <p><a href="tel:+19195551234" style="color:var(--blue);font-weight:600;">(919) 555-1234</a></p>
                </div>

                <div class="sidebar-info-card">
                    <h4>⚖️ Legal Resources</h4>
                    <p style="margin-bottom:.75rem;">Need immediate legal guidance?</p>
                    <ul>
                        <li><a href="legal.php" style="color:var(--blue);font-weight:600;">Civil Rights Attorneys</a></li>
                        <li><a href="durham.php" style="color:var(--blue);font-weight:600;">Durham Community Resources</a></li>
                    </ul>
                </div>

                <a href="index.php" class="home-btn">← Return to Homepage</a>
            </aside>

        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>