<?php include("includes/header.php"); ?>

<style>
/* ── Hero ─────────────────────────────────────────────── */
.legal-hero {
    background: var(--navy);
    padding: 4rem 0 3.5rem;
    position: relative;
    overflow: hidden;
}
.legal-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 80% at 85% 40%, rgba(30,77,183,.38) 0%, transparent 65%),
        radial-gradient(ellipse 40% 50% at 5% 75%, rgba(200,146,42,.12) 0%, transparent 60%);
    pointer-events: none;
}
.legal-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: repeating-linear-gradient(
        0deg, transparent, transparent 39px,
        rgba(255,255,255,.018) 39px, rgba(255,255,255,.018) 40px
    );
    pointer-events: none;
}
.legal-hero .container { position: relative; z-index: 1; }
.hero-eyebrow {
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
.legal-hero h1 { color: var(--white); font-size: clamp(2rem, 4vw, 3rem); margin-bottom: .85rem; }
.legal-hero p  { color: rgba(255,255,255,.6); font-size: 1rem; max-width: 560px; line-height: 1.75; }

/* ── Disclaimer Banner ────────────────────────────────── */
.disclaimer-bar {
    background: rgba(200,146,42,.1);
    border-bottom: 1px solid rgba(200,146,42,.25);
    padding: .85rem 0;
}
.disclaimer-bar .container {
    display: flex;
    align-items: center;
    gap: .75rem;
    font-size: .82rem;
    color: var(--text-muted);
}
.disclaimer-bar strong { color: var(--navy); }

/* ── Main Body ────────────────────────────────────────── */
.legal-body {
    background: var(--cream);
    padding: 3.5rem 0 5rem;
}

/* ── Tab Nav ──────────────────────────────────────────── */
.tab-nav {
    display: flex;
    gap: .4rem;
    flex-wrap: wrap;
    margin-bottom: 2.5rem;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: .5rem;
    box-shadow: var(--shadow-sm);
}

.tab-btn {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .65rem 1.25rem;
    border: none;
    border-radius: var(--radius);
    background: transparent;
    font-family: 'DM Sans', sans-serif;
    font-size: .85rem;
    font-weight: 600;
    color: var(--text-muted);
    cursor: pointer;
    transition: all var(--transition);
    white-space: nowrap;
}
.tab-btn:hover { background: var(--cream); color: var(--navy); }
.tab-btn.active {
    background: var(--navy);
    color: var(--white);
    box-shadow: var(--shadow-sm);
}

/* ── Tab Content ──────────────────────────────────────── */
.tab-panel { display: none; }
.tab-panel.active { display: block; }

.panel-intro {
    margin-bottom: 2rem;
}
.panel-intro h2 { margin-bottom: .5rem; font-size: 1.4rem; }
.panel-intro p  { font-size: .93rem; max-width: 680px; }

/* ── Attorney Cards ───────────────────────────────────── */
.attorney-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
    margin-bottom: 2.5rem;
}

.attorney-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: transform var(--transition), box-shadow var(--transition);
    display: flex;
    flex-direction: column;
}
.attorney-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}

.attorney-card-header {
    padding: 1.5rem 1.5rem 1rem;
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.firm-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
}
.icon-navy  { background: linear-gradient(135deg, var(--navy), var(--blue)); }
.icon-gold  { background: linear-gradient(135deg, var(--gold), var(--gold-light)); }
.icon-blue  { background: linear-gradient(135deg, var(--blue), #5b8df5); }

.firm-name {
    font-family: 'Lora', Georgia, serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: .3rem;
    line-height: 1.3;
}

.firm-tags {
    display: flex;
    flex-wrap: wrap;
    gap: .35rem;
}
.firm-tag {
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--blue);
    background: rgba(30,77,183,.08);
    border: 1px solid rgba(30,77,183,.15);
    padding: .15rem .55rem;
    border-radius: 100px;
}

.attorney-card-body {
    padding: 0 1.5rem 1rem;
    flex: 1;
}
.attorney-card-body p {
    font-size: .85rem;
    color: var(--text-muted);
    line-height: 1.7;
}

.attorney-card-footer {
    border-top: 1px solid var(--border);
    padding: 1rem 1.5rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: .6rem;
    background: #fafbfc;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: .5rem;
    font-size: .8rem;
}
.contact-item .ci-icon {
    width: 22px; height: 22px;
    background: var(--cream);
    border: 1px solid var(--border);
    border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    font-size: .7rem; flex-shrink: 0;
}
.contact-item a {
    color: var(--blue);
    font-weight: 600;
    transition: color var(--transition);
    word-break: break-all;
}
.contact-item a:hover { color: var(--navy); }

.website-link {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .4rem;
    background: var(--navy);
    color: var(--white);
    font-family: 'DM Sans', sans-serif;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .05em;
    text-transform: uppercase;
    padding: .6rem 1rem;
    border-radius: var(--radius);
    margin: 0 1.5rem 1.25rem;
    text-align: center;
    transition: background var(--transition), transform var(--transition);
}
.website-link:hover { background: var(--blue); transform: translateY(-1px); }

/* ── Free / Nonprofit Resources ──────────────────────── */
.resource-section { margin-top: .5rem; }
.resource-section-title {
    font-family: 'DM Sans', sans-serif;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 1rem;
    padding-bottom: .5rem;
    border-bottom: 1px solid var(--border);
}

.resource-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}

.resource-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.25rem;
    box-shadow: var(--shadow-sm);
    transition: transform var(--transition), box-shadow var(--transition);
}
.resource-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
.resource-card-icon { font-size: 1.5rem; margin-bottom: .6rem; }
.resource-card h4 {
    font-size: .9rem;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: .4rem;
}
.resource-card p  { font-size: .8rem; color: var(--text-muted); line-height: 1.6; margin-bottom: .85rem; }
.resource-card a.rc-link {
    font-size: .78rem;
    font-weight: 700;
    color: var(--blue);
    letter-spacing: .03em;
    transition: color var(--transition);
}
.resource-card a.rc-link:hover { color: var(--navy); }

/* ── CTA Strip ────────────────────────────────────────── */
.legal-cta {
    background: var(--navy);
    padding: 4rem 0;
    position: relative;
    overflow: hidden;
    text-align: center;
}
.legal-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 50% 100% at 50% 50%, rgba(30,77,183,.3) 0%, transparent 70%);
    pointer-events: none;
}
.legal-cta .container { position: relative; z-index: 1; max-width: 640px; }
.legal-cta h2 { color: var(--white); margin-bottom: 1rem; }
.legal-cta p  { color: rgba(255,255,255,.6); font-size: .97rem; line-height: 1.8; margin-bottom: 2rem; }
.cta-buttons  { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

/* ── Responsive ───────────────────────────────────────── */
@media (max-width: 860px) {
    .attorney-grid  { grid-template-columns: 1fr; }
    .resource-cards { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 560px) {
    .tab-nav        { gap: .25rem; }
    .tab-btn        { font-size: .78rem; padding: .55rem .9rem; }
    .resource-cards { grid-template-columns: 1fr; }
    .attorney-card-footer { grid-template-columns: 1fr; }
}
</style>

<!-- Hero -->
<div class="legal-hero">
    <div class="container">
        <div class="hero-eyebrow">⚖️ Legal Resources</div>
        <h1>Employment &amp; Civil Rights Attorneys</h1>
        <p>Connect with experienced discrimination attorneys and free legal resources serving Durham and the greater Triangle area of North Carolina.</p>
    </div>
</div>

<!-- Disclaimer -->
<div class="disclaimer-bar">
    <div class="container">
        <span>⚠️</span>
        <p><strong>Disclaimer:</strong> ADAS does not endorse any specific attorney or firm. This directory is provided for informational purposes only and does not constitute legal advice. Always verify credentials before retaining counsel.</p>
    </div>
</div>

<!-- Main Body -->
<div class="legal-body">
    <div class="container">

        <!-- Tab Navigation -->
        <div class="tab-nav" role="tablist">
            <button class="tab-btn active" onclick="switchTab('employment')" role="tab">💼 Employment</button>
            <button class="tab-btn" onclick="switchTab('housing')" role="tab">🏠 Housing &amp; Fair Housing</button>
            <button class="tab-btn" onclick="switchTab('civil')" role="tab">🏛️ Civil Rights</button>
            <button class="tab-btn" onclick="switchTab('free')" role="tab">🆓 Free &amp; Nonprofit</button>
        </div>

        <!-- ══ TAB: EMPLOYMENT ══════════════════════════════ -->
        <div id="tab-employment" class="tab-panel active">
            <div class="panel-intro">
                <span class="section-eyebrow">Employment Discrimination</span>
                <h2>Workplace Discrimination Attorneys</h2>
                <p>These firms specialize in wrongful termination, harassment, unequal pay, retaliation, and other employment-related discrimination claims in Durham and the Triangle area.</p>
            </div>

            <div class="attorney-grid">

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-navy">⚖️</div>
                        <div>
                            <div class="firm-name">Patterson Harkavy LLP</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Employment</span>
                                <span class="firm-tag">Civil Rights</span>
                                <span class="firm-tag">Harassment</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>One of North Carolina's most respected plaintiff-side firms with over 40 years of experience. Secured the largest sexual harassment verdict in state history. Regularly represents workers facing discrimination based on race, sex, age, disability, and national origin.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18004582541">1 (800) 458-2541</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Durham / Chapel Hill, NC</span>
                        </div>
                    </div>
                    <a href="https://www.pathlaw.com" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-gold">🏛️</div>
                        <div>
                            <div class="firm-name">Kornbluth Ginsberg Law Group, P.A.</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Employment</span>
                                <span class="firm-tag">Discrimination</span>
                                <span class="firm-tag">EEOC</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>Durham-based employment law firm known for sensitive, compassionate representation of employees facing discrimination. Regularly assists clients through the EEOC process and in court. Recognized among Durham's most trusted employee-rights firms.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19194014100">(919) 401-4100</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://www.kornbluthginsberg.com" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-blue">👔</div>
                        <div>
                            <div class="firm-name">Law Offices of Robert Crawford</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Employment</span>
                                <span class="firm-tag">Wrongful Termination</span>
                                <span class="firm-tag">Harassment</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>Over 40 years of combined experience representing employees throughout the Durham and Triangle area. Handles workplace discrimination, sexual harassment, wrongful termination, and retaliation claims with a dedicated, client-first approach.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19196514230">(919) 651-4230</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Raleigh / Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://www.crawfordandcrawfordattorneys.com" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-navy">⚡</div>
                        <div>
                            <div class="firm-name">The Noble Law</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Employment</span>
                                <span class="firm-tag">Retaliation</span>
                                <span class="firm-tag">Discrimination</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>A recognized leader in employee-side employment law with offices across North Carolina and New York. Works to level the playing field for employees with integrity and empathy. Handles discrimination, harassment, retaliation, and wage disputes.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19194019790">(919) 401-9790</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Raleigh / Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://thenoblelaw.com" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

            </div><!-- /.attorney-grid -->

            <div class="resource-section">
                <div class="resource-section-title">Federal Agencies — Employment</div>
                <div class="resource-cards">
                    <div class="resource-card">
                        <div class="resource-card-icon">🏛️</div>
                        <h4>EEOC — Charlotte District</h4>
                        <p>File federal employment discrimination charges. Covers Durham and all of NC. Free to file; no attorney required.</p>
                        <a href="https://www.eeoc.gov" target="_blank" rel="noopener" class="rc-link">eeoc.gov →</a>
                    </div>
                    <div class="resource-card">
                        <div class="resource-card-icon">📋</div>
                        <h4>NC Department of Labor</h4>
                        <p>State-level resource for wage disputes, workplace safety, and employment rights violations in North Carolina.</p>
                        <a href="https://www.labor.nc.gov" target="_blank" rel="noopener" class="rc-link">labor.nc.gov →</a>
                    </div>
                    <div class="resource-card">
                        <div class="resource-card-icon">🤝</div>
                        <h4>Volunteer Lawyers Program of Durham County</h4>
                        <p>Free legal services for income-eligible Durham County residents. Contact North Central Legal Assistance for referral.</p>
                        <a href="tel:+18662195262" class="rc-link">(866) 219-5262</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══ TAB: HOUSING ════════════════════════════════ -->
        <div id="tab-housing" class="tab-panel">
            <div class="panel-intro">
                <span class="section-eyebrow">Fair Housing</span>
                <h2>Housing Discrimination Attorneys &amp; Resources</h2>
                <p>These firms and organizations handle Fair Housing Act violations, discriminatory lending, wrongful evictions, and housing-related civil rights claims in Durham and North Carolina.</p>
            </div>

            <div class="attorney-grid">

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-navy">🏠</div>
                        <div>
                            <div class="firm-name">Legal Aid of North Carolina — Fair Housing Project</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Fair Housing</span>
                                <span class="firm-tag">Free Services</span>
                                <span class="firm-tag">Statewide</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>The Fair Housing Project of Legal Aid NC provides free legal representation, advice, and referrals to individuals who have experienced housing discrimination statewide. Handles evictions, discriminatory lending, and Fair Housing Act violations.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18557973247">1 (855) 797-3247</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">✉️</div>
                            <a href="mailto:info@fairhousingnc.org">info@fairhousingnc.org</a>
                        </div>
                    </div>
                    <a href="https://www.fairhousingnc.org" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-gold">🏘️</div>
                        <div>
                            <div class="firm-name">City of Durham Human Relations Division</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Fair Housing</span>
                                <span class="firm-tag">Local Agency</span>
                                <span class="firm-tag">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>Enforces Durham's Fair Housing Ordinance and the federal Fair Housing Act. Investigates housing discrimination complaints and conducts neutral investigations. Complaints are dual-filed with HUD. Free to file; investigations completed within 100 days.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19195604107">(919) 560-4107</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">✉️</div>
                            <a href="mailto:humanrelations@durhamnc.gov">humanrelations@durhamnc.gov</a>
                        </div>
                    </div>
                    <a href="https://www.durhamfairhousing.com" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-blue">🌾</div>
                        <div>
                            <div class="firm-name">Land Loss Prevention Project</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Housing</span>
                                <span class="firm-tag">Property Rights</span>
                                <span class="firm-tag">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>Durham-based nonprofit providing free legal assistance to farmers and rural landowners facing discriminatory lending, foreclosure, or land loss. Particularly focused on historically underserved communities across North Carolina.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18006725839">1 (800) 672-5839</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://www.landloss.org" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-navy">🏦</div>
                        <div>
                            <div class="firm-name">HUD — Office of Fair Housing &amp; Equal Opportunity</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Federal Agency</span>
                                <span class="firm-tag">Fair Housing</span>
                                <span class="firm-tag">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>The federal agency responsible for enforcing the Fair Housing Act. File a complaint directly with HUD for free. HUD investigates claims of housing discrimination in rentals, sales, lending, and advertising. Must file within one year of the incident.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18006699777">1 (800) 669-9777</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Federal — Nationwide</span>
                        </div>
                    </div>
                    <a href="https://www.hud.gov/fairhousing" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

            </div>
        </div>

        <!-- ══ TAB: CIVIL RIGHTS ═══════════════════════════ -->
        <div id="tab-civil" class="tab-panel">
            <div class="panel-intro">
                <span class="section-eyebrow">Civil Rights</span>
                <h2>Civil Rights &amp; Public Accommodations Attorneys</h2>
                <p>These firms handle broad civil rights violations including public accommodation discrimination, police misconduct, disability rights, and constitutional claims in Durham and North Carolina.</p>
            </div>

            <div class="attorney-grid">

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-navy">⚖️</div>
                        <div>
                            <div class="firm-name">Patterson Harkavy LLP</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Civil Rights</span>
                                <span class="firm-tag">Police Misconduct</span>
                                <span class="firm-tag">Wrongful Conviction</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>Widely recognized for landmark civil rights litigation across North Carolina and the South. Handles police misconduct, civil rights violations, wrongful convictions, and discrimination cases. Attorneys regularly named among Best Lawyers in America.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18004582541">1 (800) 458-2541</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Chapel Hill / Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://www.pathlaw.com" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-blue">🎓</div>
                        <div>
                            <div class="firm-name">Tin Fulton Walker &amp; Owen</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Civil Rights</span>
                                <span class="firm-tag">Employment</span>
                                <span class="firm-tag">Education</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>A Charlotte-based civil rights firm with attorneys serving the Durham area. Handles civil rights, employment discrimination, education law, personal injury, and wrongful death. Attorney Nichad Davis focuses on civil rights and plaintiff advocacy.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+17048560144">(704) 856-0144</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Charlotte / Triangle, NC</span>
                        </div>
                    </div>
                    <a href="https://www.tinfulton.com" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-gold">🗽</div>
                        <div>
                            <div class="firm-name">ACLU of North Carolina</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Civil Liberties</span>
                                <span class="firm-tag">Constitutional Rights</span>
                                <span class="firm-tag">Free Referrals</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>The ACLU of NC defends constitutional rights and civil liberties statewide. Provides legal resources, referrals, and in some cases direct representation for civil rights violations. Handles cases involving discrimination, free speech, and equal protection.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19193340609">(919) 334-0609</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Raleigh, NC (Statewide)</span>
                        </div>
                    </div>
                    <a href="https://www.acluofnc.org" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-navy">♿</div>
                        <div>
                            <div class="firm-name">Disability Rights NC</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Disability Rights</span>
                                <span class="firm-tag">ADA</span>
                                <span class="firm-tag">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>The federally designated protection and advocacy system for people with disabilities in North Carolina. Provides free legal services for ADA violations, disability discrimination in employment, housing, and public accommodations.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18774352060">1 (877) 235-4210</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Raleigh, NC (Statewide)</span>
                        </div>
                    </div>
                    <a href="https://disabilityrightsnc.org" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

            </div>
        </div>

        <!-- ══ TAB: FREE / NONPROFIT ═══════════════════════ -->
        <div id="tab-free" class="tab-panel">
            <div class="panel-intro">
                <span class="section-eyebrow">Free &amp; Low-Cost Resources</span>
                <h2>Free Legal Aid &amp; Nonprofit Resources</h2>
                <p>If you cannot afford an attorney, these organizations provide free or low-cost legal assistance, counseling, and referrals for discrimination-related matters in Durham and North Carolina.</p>
            </div>

            <div class="attorney-grid">

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-gold">🆓</div>
                        <div>
                            <div class="firm-name">Legal Aid of North Carolina</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Free</span>
                                <span class="firm-tag">Income-Eligible</span>
                                <span class="firm-tag">All Issues</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>Provides free civil legal services to low-income North Carolinians. Covers housing, employment, eviction, discrimination, and more. Serves Durham County residents directly. Income guidelines apply.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18662195262">(866) 219-5262</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://legalaidnc.org" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-blue">🎓</div>
                        <div>
                            <div class="firm-name">Duke Law Civil Justice Clinic</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Free</span>
                                <span class="firm-tag">Civil Rights</span>
                                <span class="firm-tag">Student-Supervised</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>Duke Law School's clinic provides free legal representation to low-income Durham residents in civil matters. Supervised by experienced faculty attorneys. Handles civil rights, housing, and public benefits cases.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19196137743">(919) 613-7743</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://law.duke.edu/clinics/" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-navy">🏙️</div>
                        <div>
                            <div class="firm-name">Durham Human Relations Commission</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Free</span>
                                <span class="firm-tag">Mediation</span>
                                <span class="firm-tag">Local</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>Free mediation and complaint investigation for housing, employment, and public accommodation discrimination in Durham. Enforces the City's Non-Discrimination Ordinance. No attorney required to file.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19195604107">(919) 560-4107</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">✉️</div>
                            <a href="mailto:humanrelations@durhamnc.gov">humanrelations@durhamnc.gov</a>
                        </div>
                    </div>
                    <a href="https://www.durhamhumanrelations.com" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

                <div class="attorney-card">
                    <div class="attorney-card-header">
                        <div class="firm-icon icon-gold">🔎</div>
                        <div>
                            <div class="firm-name">NC Bar Association Lawyer Referral Service</div>
                            <div class="firm-tags">
                                <span class="firm-tag">Referrals</span>
                                <span class="firm-tag">Low-Cost Consult</span>
                                <span class="firm-tag">All Areas</span>
                            </div>
                        </div>
                    </div>
                    <div class="attorney-card-body">
                        <p>The NC Bar Association's referral service connects you with a screened local attorney for a low-cost initial consultation (typically $50 or less for 30 minutes). Covers employment, housing, civil rights, and more.</p>
                    </div>
                    <div class="attorney-card-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18003620890">1 (800) 662-7407</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span style="font-size:.78rem;color:var(--text-muted);">Statewide, NC</span>
                        </div>
                    </div>
                    <a href="https://www.ncbar.org/public-resources/find-a-lawyer/" target="_blank" rel="noopener" class="website-link">Visit Website →</a>
                </div>

            </div><!-- /.attorney-grid -->

            <div class="resource-section">
                <div class="resource-section-title">Additional No-Cost Options</div>
                <div class="resource-cards">
                    <div class="resource-card">
                        <div class="resource-card-icon">🌐</div>
                        <h4>NC Judicial Branch Self-Help</h4>
                        <p>Free online guides and court forms for representing yourself in civil rights and discrimination matters in NC courts.</p>
                        <a href="https://www.nccourts.gov/help-topics/representing-yourself" target="_blank" rel="noopener" class="rc-link">nccourts.gov →</a>
                    </div>
                    <div class="resource-card">
                        <div class="resource-card-icon">🏛️</div>
                        <h4>US Dept. of Justice Civil Rights Division</h4>
                        <p>File a federal civil rights complaint with the DOJ at no cost. Covers public accommodations, government agencies, and more.</p>
                        <a href="https://www.justice.gov/crt" target="_blank" rel="noopener" class="rc-link">justice.gov/crt →</a>
                    </div>
                    <div class="resource-card">
                        <div class="resource-card-icon">📱</div>
                        <h4>LawHelp NC</h4>
                        <p>Online legal information and self-help resources specifically tailored to North Carolina residents facing civil legal issues.</p>
                        <a href="https://www.lawhelpnc.org" target="_blank" rel="noopener" class="rc-link">lawhelpnc.org →</a>
                    </div>
                </div>
            </div>

        </div><!-- /#tab-free -->

    </div><!-- /.container -->
</div><!-- /.legal-body -->

<!-- CTA Strip -->
<div class="legal-cta">
    <div class="container">
        <h2>Ready to File a Report?</h2>
        <p>You don't need an attorney to submit a report through ADAS. Our platform guides you through the process step by step — for free and in complete confidence.</p>
        <div class="cta-buttons">
            <a href="housing.php" class="primary-btn">🏠 Housing Report</a>
            <a href="employment.php" class="primary-btn">💼 Employment Report</a>
            <a href="other.php" class="primary-btn">🏛️ Public Report</a>
        </div>
    </div>
</div>

<script>
function switchTab(name) {
    // Hide all panels
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    // Deactivate all buttons
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    // Show selected panel
    document.getElementById('tab-' + name).classList.add('active');
    // Activate clicked button
    event.currentTarget.classList.add('active');
}
</script>

<?php include("includes/footer.php"); ?>