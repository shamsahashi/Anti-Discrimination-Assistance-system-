<?php include("includes/header.php"); ?>

<style>
/* ── Hero ─────────────────────────────────────────────── */
.durham-hero {
    background: var(--navy);
    padding: 4rem 0 3.5rem;
    position: relative;
    overflow: hidden;
}
.durham-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 65% 80% at 90% 40%, rgba(30,77,183,.38) 0%, transparent 65%),
        radial-gradient(ellipse 45% 55% at 5% 80%, rgba(200,146,42,.14) 0%, transparent 60%);
    pointer-events: none;
}
.durham-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: repeating-linear-gradient(
        0deg, transparent, transparent 39px,
        rgba(255,255,255,.018) 39px, rgba(255,255,255,.018) 40px
    );
    pointer-events: none;
}
.durham-hero .container { position: relative; z-index: 1; }

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
.durham-hero h1 { color: var(--white); font-size: clamp(2rem, 4vw, 3rem); margin-bottom: .85rem; }
.durham-hero p  { color: rgba(255,255,255,.6); font-size: 1rem; max-width: 580px; line-height: 1.75; }

/* ── Quick Stats Bar ──────────────────────────────────── */
.stats-bar {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
}
.stats-bar .container {
    display: flex;
    align-items: stretch;
    justify-content: center;
    flex-wrap: wrap;
}
.stat-item {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: 1.1rem 2rem;
    border-right: 1px solid var(--border);
    flex: 1;
    min-width: 160px;
}
.stat-item:last-child { border-right: none; }
.stat-icon {
    font-size: 1.4rem;
    flex-shrink: 0;
}
.stat-text strong {
    display: block;
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--navy);
    line-height: 1;
    margin-bottom: .2rem;
}
.stat-text span {
    font-size: .72rem;
    font-weight: 600;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--text-muted);
}

/* ── Main Body ────────────────────────────────────────── */
.durham-body {
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
.tab-btn:hover  { background: var(--cream); color: var(--navy); }
.tab-btn.active { background: var(--navy); color: var(--white); box-shadow: var(--shadow-sm); }

/* ── Tab Panels ───────────────────────────────────────── */
.tab-panel { display: none; }
.tab-panel.active { display: block; }

.panel-intro { margin-bottom: 2rem; }
.panel-intro h2 { margin-bottom: .5rem; font-size: 1.4rem; }
.panel-intro p  { font-size: .93rem; max-width: 680px; }

/* ── Resource Cards ───────────────────────────────────── */
.resource-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
    margin-bottom: 2.5rem;
}

.resource-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    display: flex;
    flex-direction: column;
    transition: transform var(--transition), box-shadow var(--transition);
}
.resource-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}

.rc-header {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem 1.5rem 1rem;
}
.rc-icon {
    width: 48px; height: 48px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; flex-shrink: 0;
}
.icon-navy { background: linear-gradient(135deg, var(--navy), var(--blue)); }
.icon-gold { background: linear-gradient(135deg, var(--gold), var(--gold-light)); }
.icon-blue { background: linear-gradient(135deg, var(--blue), #5b8df5); }
.icon-teal { background: linear-gradient(135deg, #0e7490, #0891b2); }

.rc-title-block { flex: 1; }
.rc-name {
    font-family: 'Lora', Georgia, serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: .35rem;
    line-height: 1.3;
}
.rc-tags {
    display: flex;
    flex-wrap: wrap;
    gap: .3rem;
}
.rc-tag {
    font-size: .67rem;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--blue);
    background: rgba(30,77,183,.08);
    border: 1px solid rgba(30,77,183,.15);
    padding: .15rem .5rem;
    border-radius: 100px;
}
.rc-tag.gold { color: var(--gold); background: rgba(200,146,42,.1); border-color: rgba(200,146,42,.25); }

.rc-body {
    padding: 0 1.5rem 1rem;
    flex: 1;
}
.rc-body p { font-size: .85rem; color: var(--text-muted); line-height: 1.7; }

.rc-footer {
    border-top: 1px solid var(--border);
    padding: .85rem 1.5rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: .5rem;
    background: #fafbfc;
}
.contact-item {
    display: flex;
    align-items: center;
    gap: .45rem;
    font-size: .79rem;
}
.ci-icon {
    width: 20px; height: 20px;
    background: var(--cream);
    border: 1px solid var(--border);
    border-radius: 5px;
    display: flex; align-items: center; justify-content: center;
    font-size: .65rem; flex-shrink: 0;
}
.contact-item a { color: var(--blue); font-weight: 600; transition: color var(--transition); word-break: break-all; }
.contact-item a:hover { color: var(--navy); }
.contact-item span { font-size: .78rem; color: var(--text-muted); }

.rc-website {
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
    transition: background var(--transition), transform var(--transition);
    text-decoration: none;
}
.rc-website:hover { background: var(--blue); transform: translateY(-1px); }

/* ── Info Box ─────────────────────────────────────────── */
.info-box {
    background: var(--white);
    border: 1px solid var(--border);
    border-left: 4px solid var(--gold);
    border-radius: var(--radius);
    padding: 1.25rem 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    gap: .85rem;
    align-items: flex-start;
}
.info-box-icon { font-size: 1.2rem; flex-shrink: 0; margin-top: .05rem; }
.info-box p { font-size: .87rem; color: var(--text-muted); line-height: 1.7; margin: 0; }
.info-box strong { color: var(--navy); }

/* ── Small Grid (3-col extras) ────────────────────────── */
.mini-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-top: .5rem;
}
.mini-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.25rem;
    box-shadow: var(--shadow-sm);
    transition: transform var(--transition), box-shadow var(--transition);
}
.mini-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
.mini-card-icon  { font-size: 1.4rem; margin-bottom: .6rem; }
.mini-card h4    { font-size: .9rem; font-weight: 700; color: var(--navy); margin-bottom: .4rem; }
.mini-card p     { font-size: .8rem; color: var(--text-muted); line-height: 1.6; margin-bottom: .75rem; }
.mini-card a.ml  { font-size: .78rem; font-weight: 700; color: var(--blue); transition: color var(--transition); text-decoration: none; }
.mini-card a.ml:hover { color: var(--navy); }

.sub-section-label {
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin: 2rem 0 1rem;
    padding-bottom: .5rem;
    border-bottom: 1px solid var(--border);
}

/* ── CTA Strip ────────────────────────────────────────── */
.durham-cta {
    background: var(--navy);
    padding: 4rem 0;
    position: relative;
    overflow: hidden;
    text-align: center;
}
.durham-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 50% 100% at 50% 50%, rgba(30,77,183,.3) 0%, transparent 70%);
    pointer-events: none;
}
.durham-cta .container { position: relative; z-index: 1; max-width: 640px; }
.durham-cta h2 { color: var(--white); margin-bottom: 1rem; }
.durham-cta p  { color: rgba(255,255,255,.6); font-size: .97rem; line-height: 1.8; margin-bottom: 2rem; }
.cta-buttons   { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

/* ── Responsive ───────────────────────────────────────── */
@media (max-width: 860px) {
    .resource-grid { grid-template-columns: 1fr; }
    .mini-grid     { grid-template-columns: 1fr 1fr; }
    .stats-bar .container { justify-content: flex-start; }
    .stat-item     { border-right: none; border-bottom: 1px solid var(--border); min-width: 50%; }
}
@media (max-width: 560px) {
    .mini-grid { grid-template-columns: 1fr; }
    .tab-btn   { font-size: .78rem; padding: .55rem .9rem; }
    .rc-footer { grid-template-columns: 1fr; }
    .stat-item { min-width: 100%; }
}
</style>

<!-- Hero -->
<div class="durham-hero">
    <div class="container">
        <div class="hero-eyebrow">🏙️ Durham, NC</div>
        <h1>Durham Community Resources</h1>
        <p>Local agencies, nonprofits, and city offices serving Durham residents who have experienced discrimination or need civil rights assistance, housing support, or legal guidance.</p>
    </div>
</div>

<!-- Stats Bar -->
<div class="stats-bar">
    <div class="container">
        <div class="stat-item">
            <div class="stat-icon">🏛️</div>
            <div class="stat-text">
                <strong>6+</strong>
                <span>City Agencies</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">🤝</div>
            <div class="stat-text">
                <strong>10+</strong>
                <span>Community Orgs</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">🆓</div>
            <div class="stat-text">
                <strong>Free</strong>
                <span>Most Services</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">📞</div>
            <div class="stat-text">
                <strong>2-1-1</strong>
                <span>24/7 NC Helpline</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Body -->
<div class="durham-body">
    <div class="container">

        <!-- Tab Navigation -->
        <div class="tab-nav" role="tablist">
            <button class="tab-btn active" onclick="switchTab('city', event)">🏛️ City Agencies</button>
            <button class="tab-btn" onclick="switchTab('housing', event)">🏠 Housing</button>
            <button class="tab-btn" onclick="switchTab('employment', event)">💼 Employment</button>
            <button class="tab-btn" onclick="switchTab('community', event)">🤝 Community Orgs</button>
            <button class="tab-btn" onclick="switchTab('crisis', event)">🆘 Crisis &amp; Support</button>
        </div>

        <!-- ══ CITY AGENCIES ═══════════════════════════════ -->
        <div id="tab-city" class="tab-panel active">
            <div class="panel-intro">
                <span class="section-eyebrow">Official City &amp; State Offices</span>
                <h2>Durham City &amp; Government Agencies</h2>
                <p>These official agencies enforce anti-discrimination laws, investigate complaints, and provide mediation services to Durham residents — all free of charge.</p>
            </div>

            <div class="info-box">
                <div class="info-box-icon">💡</div>
                <p><strong>Tip:</strong> City agency complaints are free to file and do not require an attorney. Filing with the Durham Human Relations Division also dual-files your complaint with HUD or the EEOC at the federal level.</p>
            </div>

            <div class="resource-grid">

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-navy">🏛️</div>
                        <div class="rc-title-block">
                            <div class="rc-name">City of Durham Human Relations Division</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Housing</span>
                                <span class="rc-tag">Employment</span>
                                <span class="rc-tag gold">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>The primary local agency for discrimination complaints in Durham. Enforces the City's Non-Discrimination Ordinance (NDO), the federal Fair Housing Act, and other civil rights laws. Handles housing, employment, and public accommodation complaints through investigation and mediation. Civil penalties of $10,000–$50,000 may apply to violators.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19195604107">(919) 560-4107</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">✉️</div>
                            <a href="mailto:humanrelations@durhamnc.gov">humanrelations@durhamnc.gov</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>807 E. Main St., Durham, NC 27701</span>
                        </div>
                    </div>
                    <a href="https://www.durhamnc.gov/617/Human-Relations" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-gold">⚖️</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Durham Fair Housing — Complaint Process</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Fair Housing</span>
                                <span class="rc-tag">Mediation</span>
                                <span class="rc-tag gold">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Dedicated fair housing complaint portal for Durham. Protected classes include race, color, national origin, religion, sex, familial status, disability, sexual orientation, gender identity, military status, and protected hairstyles. Complaints dual-filed with HUD. Investigations completed within 100 days.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19195604107">(919) 560-4107</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Golden Belt Bldg., Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://www.durhamfairhousing.com" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-blue">🏢</div>
                        <div class="rc-title-block">
                            <div class="rc-name">NC Human Relations Commission (NCHRC)</div>
                            <div class="rc-tags">
                                <span class="rc-tag">State Agency</span>
                                <span class="rc-tag">Housing</span>
                                <span class="rc-tag">Employment</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Statewide agency that improves relationships among all NC citizens while ensuring equal opportunities in employment, housing, and public accommodations. Serves as a resource for communities and investigates housing discrimination in residential real estate transactions. Part of the NC Office of Administrative Hearings.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19842361905">(984) 236-1905</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>1711 New Hope Church Rd., Raleigh, NC</span>
                        </div>
                    </div>
                    <a href="https://www.oah.nc.gov/civil-rights-division/human-relations-commission" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-navy">🔍</div>
                        <div class="rc-title-block">
                            <div class="rc-name">NC Attorney General — Civil Rights Unit</div>
                            <div class="rc-tags">
                                <span class="rc-tag">State AG</span>
                                <span class="rc-tag">Systemic Issues</span>
                                <span class="rc-tag gold">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Created in 2022 to enhance NC's civil rights enforcement. Monitors employers, landlords, and financial institutions for compliance with civil rights laws. Accepts reports of systemic discrimination in housing, financial services, and labor rights. Particularly active in fighting predatory housing and lending practices.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19197166400">(919) 716-6400</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Raleigh, NC (Statewide)</span>
                        </div>
                    </div>
                    <a href="https://ncdoj.gov/civil-rights-unit/" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

            </div>

            <div class="sub-section-label">Federal Agencies Serving Durham</div>
            <div class="mini-grid">
                <div class="mini-card">
                    <div class="mini-card-icon">🏛️</div>
                    <h4>EEOC — Charlotte District Office</h4>
                    <p>Federal agency for employment discrimination complaints. Covers all of NC. Free to file; no attorney required. Call or file online.</p>
                    <a href="https://www.eeoc.gov/field/charlotte" target="_blank" rel="noopener" class="ml">eeoc.gov →</a>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon">🏠</div>
                    <h4>HUD Fair Housing</h4>
                    <p>File federal housing discrimination complaints. Must file within 1 year. Investigations are free and thorough.</p>
                    <a href="https://www.hud.gov/fairhousing" target="_blank" rel="noopener" class="ml">hud.gov/fairhousing →</a>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon">⚖️</div>
                    <h4>DOJ Civil Rights Division</h4>
                    <p>Report systemic civil rights violations to the U.S. Department of Justice. Handles public accommodation, government, and institutional discrimination.</p>
                    <a href="https://www.justice.gov/crt" target="_blank" rel="noopener" class="ml">justice.gov/crt →</a>
                </div>
            </div>
        </div>

        <!-- ══ HOUSING ══════════════════════════════════════ -->
        <div id="tab-housing" class="tab-panel">
            <div class="panel-intro">
                <span class="section-eyebrow">Housing Assistance</span>
                <h2>Durham Housing Resources</h2>
                <p>Organizations providing fair housing advocacy, rental assistance, emergency shelter, affordable housing access, and tenant rights support in Durham.</p>
            </div>

            <div class="resource-grid">

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-gold">🏘️</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Legal Aid NC — Fair Housing Project</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Fair Housing</span>
                                <span class="rc-tag">Legal Help</span>
                                <span class="rc-tag gold">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Provides free legal representation, advice, and referrals for housing discrimination statewide. Handles evictions, discriminatory lending, refusal to rent, and Fair Housing Act violations. Also publishes free guides including a renting-with-criminal-background fair housing guide.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18557973247">1 (855) 797-3247</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">✉️</div>
                            <a href="mailto:info@fairhousingnc.org">info@fairhousingnc.org</a>
                        </div>
                    </div>
                    <a href="https://www.fairhousingnc.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-navy">🏠</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Urban Ministries of Durham (UMD)</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Shelter</span>
                                <span class="rc-tag">Food</span>
                                <span class="rc-tag">Homelessness</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Connects Durham residents with shelter, food, and pathways out of homelessness. Serves over 6,000 people annually through a community café, food pantry, clothing closet, and shelter. Welcomes all regardless of race, religion, sexual orientation, gender identity, or disability. No discrimination tolerated in service delivery.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19196880235">(919) 688-0235</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>410 Liberty St., Durham, NC 27701</span>
                        </div>
                    </div>
                    <a href="https://umdurham.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-blue">🌱</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Self-Help Credit Union</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Lending</span>
                                <span class="rc-tag">Homeownership</span>
                                <span class="rc-tag">Financial Services</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Durham-based credit union dedicated to responsible lending for people of color, women, rural residents, and low-wealth families who face discriminatory barriers at traditional banks. Provides mortgages, small business loans, and financial services with a focus on community wealth-building and fair access.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18008760012">1 (800) 476-7428</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>301 W. Main St., Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://www.self-help.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-gold">🌾</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Land Loss Prevention Project</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Property Rights</span>
                                <span class="rc-tag">Foreclosure</span>
                                <span class="rc-tag gold">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Durham nonprofit providing free legal help to farmers and landowners facing discriminatory lending, foreclosure, or land loss. Focused on historically underserved communities across NC who are disproportionately affected by predatory financial practices and unequal access to credit.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18006725839">1 (800) 672-5839</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://www.landloss.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

            </div>

            <div class="sub-section-label">Additional Housing Resources</div>
            <div class="mini-grid">
                <div class="mini-card">
                    <div class="mini-card-icon">🏗️</div>
                    <h4>Durham Community Land Trust (DCLT)</h4>
                    <p>Long history of creating affordable homeownership and rental opportunities for Durham residents facing market barriers.</p>
                    <a href="https://www.dclt.org" target="_blank" rel="noopener" class="ml">dclt.org →</a>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon">🏡</div>
                    <h4>Durham County Emergency Rental Assistance</h4>
                    <p>Financial assistance for eligible Durham renters facing eviction or inability to pay rent. Contact Durham DSS for eligibility.</p>
                    <a href="tel:+19195600000" class="ml">(919) 560-8000</a>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon">📋</div>
                    <h4>NC 2-1-1 Housing Hotline</h4>
                    <p>Dial 2-1-1 anytime to be connected with housing resources, emergency shelter, and rental assistance programs in Durham County.</p>
                    <a href="tel:211" class="ml">Dial 2-1-1 →</a>
                </div>
            </div>
        </div>

        <!-- ══ EMPLOYMENT ══════════════════════════════════ -->
        <div id="tab-employment" class="tab-panel">
            <div class="panel-intro">
                <span class="section-eyebrow">Workers' Rights</span>
                <h2>Durham Employment &amp; Workers' Rights Resources</h2>
                <p>Agencies and organizations supporting Durham workers facing discrimination, wage theft, unsafe conditions, or unfair labor practices.</p>
            </div>

            <div class="resource-grid">

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-navy">💼</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Durham Human Relations — Employment Division</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Employment</span>
                                <span class="rc-tag">Mediation</span>
                                <span class="rc-tag gold">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Investigates employment discrimination complaints under Durham's Non-Discrimination Ordinance. Protects against discrimination based on race, color, national origin, religion, sex, age, disability, sexual orientation, gender identity, military status, and protected hairstyles. Complaints are dual-filed with the EEOC.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19195604107">(919) 560-4107</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">✉️</div>
                            <a href="mailto:humanrelations@durhamnc.gov">humanrelations@durhamnc.gov</a>
                        </div>
                    </div>
                    <a href="https://www.durhamnc.gov/4812/Equal-Employment-Opportunity-and-Public-" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-gold">🤝</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Forward Justice Action Network</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Workers' Rights</span>
                                <span class="rc-tag">Racial Justice</span>
                                <span class="rc-tag">Advocacy</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Durham-based organization promoting policies that advance racial, social, and economic justice in NC and the South through education and advocacy. Works on workers' rights, voting rights, and economic equity. Provides referrals and advocacy support for workers facing systemic discrimination.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Durham, NC</span>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">🌐</div>
                            <a href="https://forwardjustice.org" target="_blank" rel="noopener">forwardjustice.org</a>
                        </div>
                    </div>
                    <a href="https://forwardjustice.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-blue">🌎</div>
                        <div class="rc-title-block">
                            <div class="rc-name">NCCLO — Latino Workforce Rights</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Latino Community</span>
                                <span class="rc-tag">Workers' Rights</span>
                                <span class="rc-tag">Advocacy</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>NC Council on Latino Organizations develops Latino organizational capacity and empowers community leaders to address workplace discrimination, labor rights violations, and social justice issues. Increases collective power and visibility of Latino workers across NC including Durham County.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Durham / Triangle, NC</span>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">🌐</div>
                            <a href="https://www.ncclo.org" target="_blank" rel="noopener">ncclo.org</a>
                        </div>
                    </div>
                    <a href="https://www.ncclo.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-navy">📋</div>
                        <div class="rc-title-block">
                            <div class="rc-name">NC Department of Labor — Wage &amp; Hour</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Wage Theft</span>
                                <span class="rc-tag">Workplace Safety</span>
                                <span class="rc-tag gold">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>State agency handling wage disputes, unpaid wages, unsafe working conditions, and child labor violations in North Carolina. File a complaint online or by phone. Investigators have authority to recover back wages and impose penalties on employers who violate labor laws.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18002252220">1 (800) 625-2267</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Raleigh, NC (Statewide)</span>
                        </div>
                    </div>
                    <a href="https://www.labor.nc.gov" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

            </div>
        </div>

        <!-- ══ COMMUNITY ORGS ══════════════════════════════ -->
        <div id="tab-community" class="tab-panel">
            <div class="panel-intro">
                <span class="section-eyebrow">Community Organizations</span>
                <h2>Durham Civil Rights &amp; Community Advocates</h2>
                <p>Nonprofits, advocacy groups, and community organizations working to advance equity, inclusion, and civil rights for Durham residents.</p>
            </div>

            <div class="resource-grid">

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-gold">🗽</div>
                        <div class="rc-title-block">
                            <div class="rc-name">LGBTQ Center of Durham</div>
                            <div class="rc-tags">
                                <span class="rc-tag">LGBTQ+</span>
                                <span class="rc-tag">Advocacy</span>
                                <span class="rc-tag">Support Services</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Affirms all LGBTQ+ experiences, supports survivors of violence, and hosts PRIDE Durham. Provides advocacy, referrals, and support services for LGBTQ+ individuals facing discrimination in housing, employment, healthcare, or public accommodations. A vital resource for one of Durham's most protected communities.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19196888660">(919) 688-8660</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>309 W. Main St., Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://www.lgbtqcenterofdurham.com" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-navy">⚖️</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Southern Coalition for Social Justice (SCSJ)</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Legal Advocacy</span>
                                <span class="rc-tag">Communities of Color</span>
                                <span class="rc-tag">Research</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Durham-based organization partnering with communities of color in the South to advance political, social, and economic rights through legal advocacy and research. Works on voting rights, criminal justice reform, economic justice, and immigration rights. Strong presence in the Durham community.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19195231600">(919) 323-3380</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://www.southerncoalition.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-blue">🏘️</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Durham CAN (Congregations, Associations &amp; Neighborhoods)</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Community Power</span>
                                <span class="rc-tag">Faith-Based</span>
                                <span class="rc-tag">Advocacy</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Builds relationships across race, class, religion, and geography to give ordinary Durham families a powerful voice in public decisions. Develops community leaders and organizes institutions around civil rights, economic justice, and housing equity. Intentionally crosses boundaries that divide communities.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Durham, NC</span>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">🌐</div>
                            <a href="https://www.durhamcan.org" target="_blank" rel="noopener">durhamcan.org</a>
                        </div>
                    </div>
                    <a href="https://www.durhamcan.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-gold">🗳️</div>
                        <div class="rc-title-block">
                            <div class="rc-name">You Can Vote</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Voter Rights</span>
                                <span class="rc-tag">Civic Education</span>
                                <span class="rc-tag">60 NC Counties</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Educates, registers, and empowers voters across 60 NC counties including Durham. Works with community partner organizations to ensure every eligible resident can exercise their voting rights free from intimidation or suppression. Provides nonpartisan civic education and voter registration assistance.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Durham, NC</span>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">🌐</div>
                            <a href="https://www.youcanvote.org" target="_blank" rel="noopener">youcanvote.org</a>
                        </div>
                    </div>
                    <a href="https://www.youcanvote.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

            </div>

            <div class="sub-section-label">Additional Community Organizations</div>
            <div class="mini-grid">
                <div class="mini-card">
                    <div class="mini-card-icon">🏛️</div>
                    <h4>ACLU of North Carolina</h4>
                    <p>Defends constitutional rights and civil liberties statewide. Provides referrals and takes select civil rights cases in Durham.</p>
                    <a href="https://www.acluofnc.org" target="_blank" rel="noopener" class="ml">acluofnc.org →</a>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon">🤝</div>
                    <h4>United Way Greater Triangle</h4>
                    <p>Funds and coordinates community-led solutions in workforce, housing stability, and racial equity across the Durham area.</p>
                    <a href="https://unitedwaytriangle.org" target="_blank" rel="noopener" class="ml">unitedwaytriangle.org →</a>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon">🌐</div>
                    <h4>Durham County Network of Care</h4>
                    <p>Online directory of agencies serving children, youth, adults, and seniors in Durham County across all service categories.</p>
                    <a href="https://durham.nc.networkofcare.org" target="_blank" rel="noopener" class="ml">networkofcare.org →</a>
                </div>
            </div>
        </div>

        <!-- ══ CRISIS & SUPPORT ════════════════════════════ -->
        <div id="tab-crisis" class="tab-panel">
            <div class="panel-intro">
                <span class="section-eyebrow">Immediate Help</span>
                <h2>Crisis &amp; Support Services</h2>
                <p>If you need immediate assistance — for safety, mental health, food, shelter, or emergency legal help — these resources are available to Durham residents now.</p>
            </div>

            <div class="info-box">
                <div class="info-box-icon">🆘</div>
                <p><strong>In an emergency, call 911.</strong> For non-emergency assistance, dial <strong>2-1-1</strong> anytime — 24 hours a day, 7 days a week — to be connected with local resources for food, shelter, mental health, and more across Durham County.</p>
            </div>

            <div class="resource-grid">

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-teal">📞</div>
                        <div class="rc-title-block">
                            <div class="rc-name">NC 2-1-1 Resource Helpline</div>
                            <div class="rc-tags">
                                <span class="rc-tag">24/7</span>
                                <span class="rc-tag">All Services</span>
                                <span class="rc-tag gold">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Dial 2-1-1 anytime for free, confidential referrals to local health and human services. Connects Durham residents with food, housing, mental health, domestic violence, and legal resources. Available 24/7 in multiple languages. Can also be accessed online through the United Way NC portal.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:211">Dial 2-1-1</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">🌐</div>
                            <a href="https://nc211.org" target="_blank" rel="noopener">nc211.org</a>
                        </div>
                    </div>
                    <a href="https://nc211.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-gold">🛡️</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Compass Center for Women &amp; Families</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Domestic Violence</span>
                                <span class="rc-tag">Legal Aid</span>
                                <span class="rc-tag">Youth Programs</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Helps all people navigate the journey to self-sufficiency, safety, and health through career and financial education, domestic violence crisis and prevention programs, legal resource assistance, and youth health programs. Serves Durham and Orange County residents facing discrimination tied to domestic violence or gender-based violence.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+19196482050">(919) 929-7122</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Chapel Hill / Durham, NC</span>
                        </div>
                    </div>
                    <a href="https://www.compassctr.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-blue">🍽️</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Durham Congregations in Action</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Food</span>
                                <span class="rc-tag">Housing</span>
                                <span class="rc-tag">Financial Aid</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>Comprehensive community resource listing for housing, food, financial assistance, and clothing across Durham. Maintained as a community service connecting residents with emergency resources. Particularly useful for individuals who face resource discrimination or who need immediate support while pursuing a formal complaint.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Durham, NC</span>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">🌐</div>
                            <a href="https://www.dcaction.org" target="_blank" rel="noopener">dcaction.org</a>
                        </div>
                    </div>
                    <a href="https://www.dcaction.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

                <div class="resource-card">
                    <div class="rc-header">
                        <div class="rc-icon icon-navy">♿</div>
                        <div class="rc-title-block">
                            <div class="rc-name">Disability Rights NC</div>
                            <div class="rc-tags">
                                <span class="rc-tag">Disability</span>
                                <span class="rc-tag">ADA Rights</span>
                                <span class="rc-tag gold">Free</span>
                            </div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <p>The federally designated protection and advocacy organization for people with disabilities in NC. Provides free legal services for ADA violations, disability discrimination in employment, housing, education, and public accommodations. Serves Durham residents directly. No income requirements.</p>
                    </div>
                    <div class="rc-footer">
                        <div class="contact-item">
                            <div class="ci-icon">📞</div>
                            <a href="tel:+18772354210">1 (877) 235-4210</a>
                        </div>
                        <div class="contact-item">
                            <div class="ci-icon">📍</div>
                            <span>Raleigh, NC (Statewide)</span>
                        </div>
                    </div>
                    <a href="https://disabilityrightsnc.org" target="_blank" rel="noopener" class="rc-website">Visit Website →</a>
                </div>

            </div>

            <div class="sub-section-label">Mental Health &amp; Crisis Lines</div>
            <div class="mini-grid">
                <div class="mini-card">
                    <div class="mini-card-icon">💙</div>
                    <h4>988 Suicide &amp; Crisis Lifeline</h4>
                    <p>Call or text <strong>988</strong> anytime for free, confidential mental health crisis support. Available 24/7 in English and Spanish.</p>
                    <a href="tel:988" class="ml">Call or text 988 →</a>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon">💬</div>
                    <h4>Crisis Text Line</h4>
                    <p>Text HOME to <strong>741741</strong> to connect with a trained crisis counselor via text. Free, 24/7, confidential support.</p>
                    <a href="sms:741741" class="ml">Text 741741 →</a>
                </div>
                <div class="mini-card">
                    <div class="mini-card-icon">🏥</div>
                    <h4>Durham Center Access Line</h4>
                    <p>24/7 local mental health crisis line for Durham County residents. Connects to local behavioral health services and emergency support.</p>
                    <a href="tel:+18003732223">1 (800) 506-2724</a>
                </div>
            </div>
        </div>

    </div><!-- /.container -->
</div><!-- /.durham-body -->

<!-- CTA Strip -->
<div class="durham-cta">
    <div class="container">
        <h2>Ready to File a Discrimination Report?</h2>
        <p>You don't need an attorney to get started. Use our secure reporting platform to document your experience and connect with the resources above — for free.</p>
        <div class="cta-buttons">
            <a href="housing.php" class="primary-btn">🏠 Housing Report</a>
            <a href="employment.php" class="primary-btn">💼 Employment Report</a>
            <a href="other.php" class="primary-btn">🏛️ Public Report</a>
        </div>
    </div>
</div>

<script>
function switchTab(name, e) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    if (e && e.currentTarget) e.currentTarget.classList.add('active');
}
</script>

<?php include("includes/footer.php"); ?>