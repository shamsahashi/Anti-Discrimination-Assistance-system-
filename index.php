<?php include("includes/header.php"); ?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-eyebrow">Civil Rights Platform</div>
        <h1>Anti-Discrimination<br>Assistance System</h1>
        <p class="hero-subtitle">
            A secure, confidential platform to report discrimination in housing,
            employment, and public accommodations — and connect with the resources you deserve.
        </p>
        <div class="hero-actions">
            <a href="housing.php" class="primary-btn">File a Report</a>
            <a href="#mission" class="ghost-btn">Learn More</a>
        </div>
        <div class="hero-stats">
            <div class="stat">
                <span class="stat-number">3</span>
                <span class="stat-label">Report Categories</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <span class="stat-number">100%</span>
                <span class="stat-label">Confidential</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <span class="stat-number">Free</span>
                <span class="stat-label">To Use</span>
            </div>
        </div>
    </div>
</section>

<!-- MISSION SECTION -->
<section class="section" id="mission">
    <div class="container">
        <div class="two-col-grid">
            <div class="section-label-block">
                <span class="section-eyebrow">Our Purpose</span>
                <h2>Standing for Equal Rights in Our Community</h2>
            </div>
            <div class="section-body">
                <p>
                    The Anti-Discrimination Assistance System (ADAS) is committed to advancing
                    civil rights and promoting equal access to housing, employment, and public
                    accommodations. We provide a secure and confidential platform for individuals
                    to report incidents of discrimination and seek appropriate guidance.
                </p>
                <p>
                    Our mission is to strengthen community trust, ensure accountability, and
                    support individuals whose rights may have been violated. Through accessible
                    reporting tools and connection to local and legal resources, we promote
                    fairness, transparency, and equal treatment under the law.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT US SECTION -->
<section class="section section-alt" id="about">
    <div class="container">
        <div class="centered-header">
            <span class="section-eyebrow">About Us</span>
            <h2>A Centralized Gateway for Justice</h2>
            <p class="section-intro">
                ADAS was developed to address the need for a user-friendly, centralized reporting
                system for discrimination-related concerns. Many individuals are unaware of their
                rights — or uncertain where to turn when they experience unfair treatment.
            </p>
        </div>
        <div class="pillars-grid">
            <div class="pillar-card">
                <div class="pillar-icon">⚖️</div>
                <h3>Guidance</h3>
                <p>We walk you through documenting incidents clearly and connecting with the right agencies.</p>
            </div>
            <div class="pillar-card">
                <div class="pillar-icon">🔒</div>
                <h3>Confidentiality</h3>
                <p>Your reports are handled with full discretion and stored securely at every step.</p>
            </div>
            <div class="pillar-card">
                <div class="pillar-icon">🤝</div>
                <h3>Connection</h3>
                <p>We link you to civil rights organizations, municipal agencies, and legal professionals.</p>
            </div>
        </div>
    </div>
</section>

<!-- REPORT CATEGORIES -->
<section class="section" id="report">
    <div class="container">
        <div class="centered-header">
            <span class="section-eyebrow">Get Started</span>
            <h2>Report an Incident</h2>
            <p class="section-intro">
                Select the category that best describes your experience to begin your report.
                All submissions are confidential.
            </p>
        </div>
        <div class="report-grid">
            <div class="report-card">
                <div class="report-card-top housing-accent">
                    <div class="report-icon">🏠</div>
                </div>
                <div class="report-card-body">
                    <h3>Housing</h3>
                    <p>Discrimination in renting, purchasing, lending, or housing services based on protected characteristics.</p>
                    <a href="housing.php" class="card-btn">Submit Housing Report <span class="arrow">→</span></a>
                </div>
            </div>
            <div class="report-card">
                <div class="report-card-top employment-accent">
                    <div class="report-icon">💼</div>
                </div>
                <div class="report-card-body">
                    <h3>Employment</h3>
                    <p>Workplace discrimination, wrongful termination, hostile work environments, or unfair hiring practices.</p>
                    <a href="employment.php" class="card-btn">Submit Employment Report <span class="arrow">→</span></a>
                </div>
            </div>
            <div class="report-card">
                <div class="report-card-top public-accent">
                    <div class="report-icon">🏛️</div>
                </div>
                <div class="report-card-body">
                    <h3>Public Accommodations</h3>
                    <p>Discrimination in public spaces such as restaurants, hotels, transportation, or retail establishments.</p>
                    <a href="other.php" class="card-btn">Submit Public Report <span class="arrow">→</span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RESOURCES -->
<section class="section section-alt" id="resources">
    <div class="container">
        <div class="two-col-grid">
            <div class="section-label-block">
                <span class="section-eyebrow">Support Network</span>
                <h2>Community &amp; Legal Resources</h2>
                <p>Connect with local agencies and legal professionals who can provide additional support and representation.</p>
            </div>
            <div class="resource-links">
                <a href="durham.php" class="resource-link-card">
                    <div class="resource-link-icon">🏙️</div>
                    <div>
                        <strong>City of Durham Human Relations Commission</strong>
                        <span>Local civil rights enforcement and community mediation</span>
                    </div>
                    <span class="resource-arrow">→</span>
                </a>
                <a href="legal.php" class="resource-link-card">
                    <div class="resource-link-icon">⚖️</div>
                    <div>
                        <strong>Employment &amp; Civil Rights Attorneys</strong>
                        <span>Connect with qualified legal professionals in your area</span>
                    </div>
                    <span class="resource-arrow">→</span>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* ── CSS Variables ─────────────────────────────────────── */
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
    --shadow-sm:  0 2px 8px rgba(15,31,61,.08);
    --shadow-md:  0 8px 32px rgba(15,31,61,.12);
    --shadow-lg:  0 20px 60px rgba(15,31,61,.16);
    --radius:     12px;
    --radius-lg:  20px;
    --transition: 0.25s cubic-bezier(.4,0,.2,1);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: 'Georgia', 'Times New Roman', serif;
    color: var(--text);
    background: var(--white);
    line-height: 1.7;
    -webkit-font-smoothing: antialiased;
}

.container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* ── Typography ────────────────────────────────────────── */
h1 { font-size: clamp(2.4rem, 5vw, 3.8rem); font-weight: 700; line-height: 1.1; color: var(--white); letter-spacing: -0.02em; }
h2 { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 700; line-height: 1.2; color: var(--navy); letter-spacing: -0.01em; }
h3 { font-size: 1.15rem; font-weight: 700; color: var(--navy); margin-bottom: .5rem; }
p  { color: var(--text-muted); line-height: 1.8; }
a  { text-decoration: none; }

.section-eyebrow {
    display: inline-block;
    font-family: 'Arial', sans-serif;
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .15em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: .75rem;
}

/* ── Buttons ───────────────────────────────────────────── */
.primary-btn {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: var(--gold);
    color: var(--navy);
    font-family: 'Arial', sans-serif;
    font-weight: 700;
    font-size: .9rem;
    letter-spacing: .04em;
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
    font-family: 'Arial', sans-serif;
    font-weight: 600;
    font-size: .9rem;
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

/* ── Hero ──────────────────────────────────────────────── */
.hero {
    position: relative;
    background: var(--navy);
    padding: 7rem 0 5rem;
    overflow: hidden;
}
.hero-bg {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 80% 60% at 70% 40%, rgba(30,77,183,.4) 0%, transparent 70%),
        radial-gradient(ellipse 50% 40% at 10% 80%, rgba(200,146,42,.15) 0%, transparent 60%);
    pointer-events: none;
}
.hero-bg::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: repeating-linear-gradient(
        0deg, transparent, transparent 39px,
        rgba(255,255,255,.025) 39px, rgba(255,255,255,.025) 40px
    );
}
.hero .container { position: relative; z-index: 1; }

.hero-eyebrow {
    display: inline-block;
    font-family: 'Arial', sans-serif;
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .2em;
    text-transform: uppercase;
    color: var(--gold);
    background: rgba(200,146,42,.12);
    border: 1px solid rgba(200,146,42,.3);
    padding: .35rem .9rem;
    border-radius: 100px;
    margin-bottom: 1.5rem;
}

.hero h1 { margin-bottom: 1.25rem; }

.hero-subtitle {
    font-family: 'Arial', sans-serif;
    font-size: 1.05rem;
    color: rgba(255,255,255,.7);
    max-width: 560px;
    line-height: 1.7;
    margin-bottom: 2.5rem;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 4rem;
}

.hero-stats {
    display: flex;
    align-items: center;
    gap: 2rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255,255,255,.1);
}
.stat { display: flex; flex-direction: column; gap: .2rem; }
.stat-number {
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--white);
    line-height: 1;
}
.stat-label {
    font-family: 'Arial', sans-serif;
    font-size: .72rem;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: rgba(255,255,255,.45);
}
.stat-divider {
    width: 1px;
    height: 2.5rem;
    background: rgba(255,255,255,.15);
}

/* ── Sections ──────────────────────────────────────────── */
.section { padding: 6rem 0; }
.section-alt { background: var(--cream); }

.two-col-grid {
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    gap: 5rem;
    align-items: start;
}

.section-label-block h2 { margin-top: .5rem; margin-bottom: 1rem; }
.section-label-block p  { font-size: .95rem; }
.section-body p { margin-bottom: 1.2rem; font-size: .97rem; }
.section-body p:last-child { margin-bottom: 0; }

.centered-header {
    text-align: center;
    max-width: 620px;
    margin: 0 auto 3.5rem;
}
.centered-header h2 { margin: .5rem 0 1rem; }
.section-intro { font-size: .97rem; }

/* ── Pillars ───────────────────────────────────────────── */
.pillars-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
}

.pillar-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 2rem;
    text-align: center;
    box-shadow: var(--shadow-sm);
    transition: transform var(--transition), box-shadow var(--transition);
}
.pillar-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}
.pillar-icon { font-size: 2rem; margin-bottom: 1rem; }
.pillar-card p { font-size: .9rem; }

/* ── Report Cards ──────────────────────────────────────── */
.report-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
}

.report-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: transform var(--transition), box-shadow var(--transition);
}
.report-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}
.report-card-top {
    padding: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
.housing-accent    { background: linear-gradient(135deg, #0f3460, #1a5276); }
.employment-accent { background: linear-gradient(135deg, #1a3260, #154360); }
.public-accent     { background: linear-gradient(135deg, #0d2137, #0f3460); }

.report-icon { font-size: 2.5rem; }
.report-card-body { padding: 1.75rem; }
.report-card-body h3 { margin-bottom: .6rem; font-size: 1.1rem; }
.report-card-body p  { font-size: .88rem; margin-bottom: 1.5rem; min-height: 3.5rem; }

.card-btn {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    font-family: 'Arial', sans-serif;
    font-size: .8rem;
    font-weight: 700;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: var(--blue);
    transition: gap var(--transition), color var(--transition);
}
.card-btn:hover { color: var(--navy); gap: .7rem; }
.arrow { transition: transform var(--transition); }
.card-btn:hover .arrow { transform: translateX(3px); }

/* ── Resource Links ────────────────────────────────────── */
.resource-links { display: flex; flex-direction: column; gap: 1rem; }

.resource-link-card {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    transition: all var(--transition);
    color: inherit;
}
.resource-link-card:hover {
    border-color: var(--blue);
    box-shadow: var(--shadow-md);
    transform: translateX(4px);
}
.resource-link-icon { font-size: 1.6rem; flex-shrink: 0; }
.resource-link-card div { flex: 1; }
.resource-link-card strong {
    display: block;
    font-size: .95rem;
    color: var(--navy);
    margin-bottom: .2rem;
}
.resource-link-card span {
    font-family: 'Arial', sans-serif;
    font-size: .82rem;
    color: var(--text-muted);
}
.resource-arrow {
    font-size: 1.1rem;
    color: var(--text-muted);
    transition: transform var(--transition), color var(--transition);
}
.resource-link-card:hover .resource-arrow {
    transform: translateX(4px);
    color: var(--blue);
}

/* ── Responsive ────────────────────────────────────────── */
@media (max-width: 900px) {
    .two-col-grid    { grid-template-columns: 1fr; gap: 2.5rem; }
    .pillars-grid    { grid-template-columns: 1fr; }
    .report-grid     { grid-template-columns: 1fr; }
    .hero-stats      { gap: 1.5rem; }
}

@media (max-width: 600px) {
    .hero            { padding: 5rem 0 3.5rem; }
    .hero-actions    { flex-direction: column; }
    .primary-btn,
    .ghost-btn       { justify-content: center; }
    .hero-stats      { flex-direction: column; align-items: flex-start; gap: 1rem; }
    .stat-divider    { display: none; }
    .section         { padding: 4rem 0; }
}
</style>

<?php include("includes/footer.php"); ?>