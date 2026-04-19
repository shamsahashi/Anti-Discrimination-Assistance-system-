<footer class="site-footer">
    <div class="footer-inner">

        <div class="footer-top">

            <div class="footer-brand">
                <div class="footer-brand-row">
                    <div class="brand-badge">⚖️</div>
                    <div class="brand-text">
                        <span class="brand-name">ADAS</span>
                        <span class="brand-sub">Anti-Discrimination System</span>
                    </div>
                </div>
                <p class="footer-tagline">
                    Empowering individuals to report discrimination and connect
                    with the resources they deserve — confidentially and freely.
                </p>
            </div>

            <div class="footer-col">
                <h4>Report an Incident</h4>
                <ul>
                    <li><a href="housing.php">Housing Discrimination</a></li>
                    <li><a href="employment.php">Employment Discrimination</a></li>
                    <li><a href="other.php">Public Accommodations</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Resources</h4>
                <ul>
                    <li><a href="durham.php">Durham Human Relations Commission</a></li>
                    <li><a href="legal.php">Civil Rights Attorneys</a></li>
                    <li><a href="team.php">Our Team</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul class="footer-contact">
                    <li>
                        <span class="contact-icon">✉️</span>
                        <a href="mailto:support@antidiscrimination.org">support@antidiscrimination.org</a>
                    </li>
                    <li>
                        <span class="contact-icon">📞</span>
                        <a href="tel:+19195551234">(919) 555-1234</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© 2026 Anti-Discrimination Assistance System. All rights reserved.</p>
            <p class="footer-note">This platform is provided for informational and reporting purposes only and does not constitute legal advice.</p>
        </div>

    </div>
</footer>

<style>
.site-footer {
    background: var(--navy);
    color: rgba(255,255,255,.65);
    margin-top: 0;
}

.footer-inner {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 2rem;
}

.footer-top {
    display: grid;
    grid-template-columns: 1.6fr 1fr 1fr 1fr;
    gap: 3rem;
    padding: 4rem 0 3rem;
    border-bottom: 1px solid rgba(255,255,255,.08);
}

/* Brand column */
.footer-brand-row {
    display: flex;
    align-items: center;
    gap: .75rem;
    margin-bottom: 1rem;
}

.footer-brand .brand-badge {
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

.footer-brand .brand-name {
    font-family: 'Lora', Georgia, serif;
    font-size: .95rem;
    font-weight: 700;
    color: var(--white);
}

.footer-brand .brand-sub {
    font-size: .65rem;
    font-weight: 600;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--gold);
}

.footer-tagline {
    font-size: .85rem;
    line-height: 1.7;
    color: rgba(255,255,255,.45);
    max-width: 280px;
}

/* Nav columns */
.footer-col h4 {
    font-family: 'DM Sans', sans-serif;
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 1.1rem;
}

.footer-col ul {
    list-style: none;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: .6rem;
}

.footer-col ul li a {
    font-size: .87rem;
    color: rgba(255,255,255,.55);
    transition: color var(--transition);
}
.footer-col ul li a:hover { color: var(--white); }

/* Contact column */
.footer-contact li {
    display: flex;
    align-items: center;
    gap: .6rem;
}
.contact-icon { font-size: .9rem; flex-shrink: 0; }

/* Bottom bar */
.footer-bottom {
    padding: 1.5rem 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}

.footer-bottom p {
    font-size: .78rem;
    color: rgba(255,255,255,.3);
}

.footer-note {
    font-style: italic;
    text-align: right;
}

/* Responsive */
@media (max-width: 900px) {
    .footer-top {
        grid-template-columns: 1fr 1fr;
        gap: 2.5rem;
    }
    .footer-brand { grid-column: 1 / -1; }
    .footer-tagline { max-width: 100%; }
}

@media (max-width: 560px) {
    .footer-top { grid-template-columns: 1fr; gap: 2rem; }
    .footer-bottom { flex-direction: column; align-items: flex-start; }
    .footer-note { text-align: left; }
}
</style>

</body>
</html>