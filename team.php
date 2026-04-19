<?php include("includes/header.php"); ?>

<style>
/* ── Page Hero ────────────────────────────────────────── */
.team-hero {
    background: var(--navy);
    padding: 4rem 0 3.5rem;
    position: relative;
    overflow: hidden;
}
.team-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 80% at 85% 40%, rgba(30,77,183,.38) 0%, transparent 65%),
        radial-gradient(ellipse 40% 50% at 10% 80%, rgba(200,146,42,.12) 0%, transparent 60%);
    pointer-events: none;
}
.team-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: repeating-linear-gradient(
        0deg, transparent, transparent 39px,
        rgba(255,255,255,.018) 39px, rgba(255,255,255,.018) 40px
    );
    pointer-events: none;
}
.team-hero .container { position: relative; z-index: 1; }
.team-hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .15em;
    text-transform: uppercase;
    color: var(--gold);
    background: rgba(200,146,42,.12);
    border: 1px solid rgba(200,146,42,.3);
    padding: .3rem .9rem;
    border-radius: 100px;
    margin-bottom: 1.1rem;
}
.team-hero h1 {
    color: var(--white);
    font-size: clamp(2rem, 4vw, 3rem);
    margin-bottom: .85rem;
}
.team-hero p {
    color: rgba(255,255,255,.6);
    font-size: 1rem;
    max-width: 540px;
    line-height: 1.75;
}

/* ── Team Section ─────────────────────────────────────── */
.team-section {
    background: var(--cream);
    padding: 5rem 0 6rem;
}

.team-intro {
    text-align: center;
    max-width: 580px;
    margin: 0 auto 4rem;
}
.team-intro .section-eyebrow { display: block; margin-bottom: .6rem; }
.team-intro h2 { margin-bottom: 1rem; }
.team-intro p  { font-size: .97rem; }

/* ── Cards Grid ───────────────────────────────────────── */
.team-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}
/* Bottom row: 2 cards centered */
.team-grid-bottom {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    max-width: 640px;
    margin: 0 auto;
}

/* ── Team Card ────────────────────────────────────────── */
.team-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: transform var(--transition), box-shadow var(--transition);
    display: flex;
    flex-direction: column;
}
.team-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
}

.card-top {
    padding: 2rem 2rem 1.25rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    flex: 1;
}

.avatar-ring {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    padding: 3px;
    margin-bottom: 1.1rem;
    flex-shrink: 0;
}
.avatar-ring.gold-ring   { background: linear-gradient(135deg, var(--gold), var(--gold-light)); }
.avatar-ring.navy-ring   { background: linear-gradient(135deg, var(--navy), var(--blue-light)); }
.avatar-ring.blue-ring   { background: linear-gradient(135deg, var(--blue), #5b8df5); }

.avatar-inner {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: var(--cream);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    border: 2px solid var(--white);
}

.member-name {
    font-family: 'Lora', Georgia, serif;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: .3rem;
}

.member-role {
    display: inline-block;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--gold);
    background: rgba(200,146,42,.1);
    border: 1px solid rgba(200,146,42,.25);
    padding: .2rem .75rem;
    border-radius: 100px;
    margin-bottom: 1rem;
}

.member-bio {
    font-size: .85rem;
    color: var(--text-muted);
    line-height: 1.7;
    text-align: center;
}

.card-footer {
    border-top: 1px solid var(--border);
    padding: 1rem 1.5rem;
    display: flex;
    flex-direction: column;
    gap: .45rem;
    background: #fafbfc;
}

.contact-line {
    display: flex;
    align-items: center;
    gap: .6rem;
    font-size: .8rem;
}
.contact-icon {
    width: 22px;
    height: 22px;
    background: var(--cream);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .7rem;
    flex-shrink: 0;
    border: 1px solid var(--border);
}
.contact-line a {
    color: var(--blue);
    font-weight: 600;
    transition: color var(--transition);
    word-break: break-all;
}
.contact-line a:hover { color: var(--navy); }

/* ── Mission Strip ────────────────────────────────────── */
.mission-strip {
    background: var(--navy);
    padding: 4rem 0;
    position: relative;
    overflow: hidden;
}
.mission-strip::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 50% 100% at 50% 50%, rgba(30,77,183,.3) 0%, transparent 70%);
    pointer-events: none;
}
.mission-strip .container {
    position: relative;
    z-index: 1;
    text-align: center;
    max-width: 680px;
}
.mission-strip h2 { color: var(--white); margin-bottom: 1rem; }
.mission-strip p  { color: rgba(255,255,255,.6); font-size: .97rem; line-height: 1.8; margin-bottom: 2rem; }
.mission-strip .primary-btn { margin: 0 auto; }

/* ── Responsive ───────────────────────────────────────── */
@media (max-width: 860px) {
    .team-grid        { grid-template-columns: repeat(2, 1fr); }
    .team-grid-bottom { grid-template-columns: repeat(2, 1fr); max-width: 100%; }
}
@media (max-width: 560px) {
    .team-grid        { grid-template-columns: 1fr; }
    .team-grid-bottom { grid-template-columns: 1fr; }
}
</style>

<!-- Hero -->
<div class="team-hero">
    <div class="container">
        <div class="team-hero-eyebrow">👥 Our Team</div>
        <h1>The People Behind ADAS</h1>
        <p>Meet the dedicated professionals who built and maintain the Anti-Discrimination Assistance System — committed to equal rights and accessible justice for everyone.</p>
    </div>
</div>

<!-- Team Section -->
<section class="team-section">
    <div class="container">

        <div class="team-intro">
            <span class="section-eyebrow">Meet the Team</span>
            <h2>Built with Purpose</h2>
            <p>Our team combines expertise in project management, technology, data, and community relations to deliver a platform that truly serves those who need it most.</p>
        </div>

        <!-- Top row: 3 cards -->
        <div class="team-grid">

            <!-- Shamsa Hashi -->
            <div class="team-card">
                <div class="card-top">
                    <div class="avatar-ring gold-ring">
                        <div class="avatar-inner">👩‍💼</div>
                    </div>
                    <div class="member-name">Shamsa Hashi</div>
                    <div class="member-role">Project Manager</div>
                    <p class="member-bio">Leads the ADAS initiative from strategy to execution, coordinating cross-functional teams and ensuring every milestone advances our civil rights mission.</p>
                </div>
                <div class="card-footer">
                    <div class="contact-line">
                        <div class="contact-icon">✉️</div>
                        <a href="mailto:s.hashi@antidiscrimination.org">s.hashi@antidiscrimination.org</a>
                    </div>
                    <div class="contact-line">
                        <div class="contact-icon">📞</div>
                        <a href="tel:+19195550181">(919) 555-0181</a>
                    </div>
                </div>
            </div>

            <!-- Triniti Long -->
            <div class="team-card">
                <div class="card-top">
                    <div class="avatar-ring blue-ring">
                        <div class="avatar-inner">👩‍🤝‍👩</div>
                    </div>
                    <div class="member-name">Triniti Long</div>
                    <div class="member-role">Client Relations</div>
                    <p class="member-bio">Serves as the bridge between ADAS and the community, ensuring every user feels heard, supported, and guided through the reporting process with care.</p>
                </div>
                <div class="card-footer">
                    <div class="contact-line">
                        <div class="contact-icon">✉️</div>
                        <a href="mailto:t.long@antidiscrimination.org">t.long@antidiscrimination.org</a>
                    </div>
                    <div class="contact-line">
                        <div class="contact-icon">📞</div>
                        <a href="tel:+19195550247">(919) 555-0247</a>
                    </div>
                </div>
            </div>

            <!-- Rein Johnson -->
            <div class="team-card">
                <div class="card-top">
                    <div class="avatar-ring navy-ring">
                        <div class="avatar-inner">👨‍💻</div>
                    </div>
                    <div class="member-name">Rein Johnson</div>
                    <div class="member-role">Developer</div>
                    <p class="member-bio">Architects and maintains the ADAS platform, building secure, accessible, and responsive systems that empower users to report discrimination with confidence.</p>
                </div>
                <div class="card-footer">
                    <div class="contact-line">
                        <div class="contact-icon">✉️</div>
                        <a href="mailto:r.johnson@antidiscrimination.org">r.johnson@antidiscrimination.org</a>
                    </div>
                    <div class="contact-line">
                        <div class="contact-icon">📞</div>
                        <a href="tel:+19195550364">(919) 555-0364</a>
                    </div>
                </div>
            </div>

        </div><!-- /.team-grid -->

        <!-- Bottom row: 2 cards centered -->
        <div class="team-grid-bottom">

            <!-- Malcolm Reed -->
            <div class="team-card">
                <div class="card-top">
                    <div class="avatar-ring gold-ring">
                        <div class="avatar-inner">📊</div>
                    </div>
                    <div class="member-name">Malcolm Reed</div>
                    <div class="member-role">Data Analyst</div>
                    <p class="member-bio">Transforms report data into actionable insights, helping ADAS identify trends in discrimination and continuously improve the platform's effectiveness.</p>
                </div>
                <div class="card-footer">
                    <div class="contact-line">
                        <div class="contact-icon">✉️</div>
                        <a href="mailto:m.reed@antidiscrimination.org">m.reed@antidiscrimination.org</a>
                    </div>
                    <div class="contact-line">
                        <div class="contact-icon">📞</div>
                        <a href="tel:+19195550419">(919) 555-0419</a>
                    </div>
                </div>
            </div>

            <!-- Qur'an Walker -->
            <div class="team-card">
                <div class="card-top">
                    <div class="avatar-ring blue-ring">
                        <div class="avatar-inner">🧪</div>
                    </div>
                    <div class="member-name">Qur'an Walker</div>
                    <div class="member-role">Product Tester</div>
                    <p class="member-bio">Ensures every feature of ADAS works flawlessly for all users — rigorously testing forms, workflows, and accessibility before every release.</p>
                </div>
                <div class="card-footer">
                    <div class="contact-line">
                        <div class="contact-icon">✉️</div>
                        <a href="mailto:q.walker@antidiscrimination.org">q.walker@antidiscrimination.org</a>
                    </div>
                    <div class="contact-line">
                        <div class="contact-icon">📞</div>
                        <a href="tel:+19195550538">(919) 555-0538</a>
                    </div>
                </div>
            </div>

        </div><!-- /.team-grid-bottom -->

    </div>
</section>

<!-- Mission Strip -->
<div class="mission-strip">
    <div class="container">
        <h2>Have a Question for Our Team?</h2>
        <p>We're here to help. Whether you need guidance on filing a report, have questions about the process, or want to connect with local resources — reach out and someone from our team will respond within 1–2 business days.</p>
        <a href="mailto:support@antidiscrimination.org" class="primary-btn">✉️ Contact Us</a>
    </div>
</div>

<?php include("includes/footer.php"); ?>