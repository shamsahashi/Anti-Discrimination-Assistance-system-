<?php include("includes/header.php"); ?>

<style>
.form-hero {
    background: var(--navy);
    padding: 3.5rem 0 3rem;
    position: relative;
    overflow: hidden;
}
.form-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 70% 80% at 80% 50%, rgba(30,77,183,.35) 0%, transparent 70%);
    pointer-events: none;
}
.form-hero .container { position: relative; z-index: 1; }
.form-hero-eyebrow {
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
    padding: .3rem .85rem;
    border-radius: 100px;
    margin-bottom: 1rem;
}
.form-hero h1 { font-size: clamp(1.8rem, 3.5vw, 2.6rem); color: var(--white); margin-bottom: .75rem; }
.form-hero p  { color: rgba(255,255,255,.6); font-size: .95rem; max-width: 520px; }

.form-page { padding: 3rem 0 5rem; background: var(--cream); }

.form-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 2rem;
    align-items: start;
}

.form-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}

.form-section { padding: 2rem 2.5rem; border-bottom: 1px solid var(--border); }
.form-section:last-child { border-bottom: none; }

.form-section-title {
    display: flex;
    align-items: center;
    gap: .6rem;
    font-family: 'Lora', Georgia, serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: 1.5rem;
    padding-bottom: .75rem;
    border-bottom: 2px solid var(--cream);
}
.form-section-icon {
    width: 28px;
    height: 28px;
    background: linear-gradient(135deg, var(--navy), var(--blue));
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .8rem;
    flex-shrink: 0;
}

.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.form-row.triple { grid-template-columns: 1fr 1fr 1fr; }
.form-row.full   { grid-template-columns: 1fr; }

.field { display: flex; flex-direction: column; margin-bottom: .25rem; }
.field label { font-size: .8rem; font-weight: 600; color: var(--navy); margin-bottom: .4rem; }
.field label .required { color: var(--gold); margin-left: .15rem; }

.field input,
.field select,
.field textarea {
    width: 100%;
    padding: .7rem 1rem;
    margin-bottom: 0;
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    font-family: 'DM Sans', sans-serif;
    font-size: .9rem;
    color: var(--text);
    background: var(--white);
    transition: border-color var(--transition), box-shadow var(--transition);
    outline: none;
    appearance: none;
    -webkit-appearance: none;
}
.field select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%235a6175' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    padding-right: 2.5rem;
}
.field input:focus,
.field select:focus,
.field textarea:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(30,77,183,.1);
}
.field textarea { resize: vertical; min-height: 130px; }

.other-box { display: none; margin-top: .75rem; }
.other-box.visible { display: block; }

.cert-block {
    display: flex;
    gap: .85rem;
    align-items: flex-start;
    background: rgba(15,31,61,.04);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.25rem;
}
.cert-block input[type="checkbox"] {
    width: 18px; height: 18px; margin: 0;
    flex-shrink: 0; cursor: pointer;
    accent-color: var(--navy); margin-top: .1rem;
}
.cert-block p { font-size: .85rem; color: var(--text-muted); line-height: 1.6; margin: 0; }

.submit-row {
    display: flex;
    justify-content: flex-end;
    padding: 1.5rem 2.5rem;
    background: var(--cream);
    border-top: 1px solid var(--border);
}
.submit-btn {
    display: inline-flex;
    align-items: center;
    gap: .6rem;
    background: var(--navy);
    color: var(--white);
    font-family: 'DM Sans', sans-serif;
    font-weight: 700;
    font-size: .9rem;
    letter-spacing: .04em;
    text-transform: uppercase;
    padding: .9rem 2.5rem;
    border: none;
    border-radius: var(--radius);
    cursor: pointer;
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
    box-shadow: var(--shadow-sm);
}
.submit-btn:hover { background: var(--blue); transform: translateY(-2px); box-shadow: var(--shadow-md); }

.form-sidebar { display: flex; flex-direction: column; gap: 1rem; }
.sidebar-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
}
.sidebar-card h4 { font-size: .8rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--gold); margin-bottom: .85rem; }
.sidebar-card p, .sidebar-card li { font-size: .83rem; color: var(--text-muted); line-height: 1.65; }
.sidebar-card ul { padding-left: 1.1rem; display: flex; flex-direction: column; gap: .35rem; }
.sidebar-card.accent-card { background: var(--navy); border-color: transparent; }
.sidebar-card.accent-card h4 { color: var(--gold); }
.sidebar-card.accent-card p  { color: rgba(255,255,255,.6); }
.sidebar-card.accent-card a  { color: var(--gold-light); }

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    border: 2px dashed var(--border);
    border-radius: var(--radius);
    padding: 1.75rem;
    cursor: pointer;
    transition: border-color var(--transition), background var(--transition);
    text-align: center;
}
.file-upload-label:hover { border-color: var(--blue); background: rgba(30,77,183,.03); }
.file-upload-label span   { font-size: .83rem; color: var(--text-muted); }
.file-upload-label strong { font-size: .88rem; color: var(--navy); }
.file-upload-label input[type="file"] { display: none; }

/* Category selector pills */
.category-pills {
    display: flex;
    flex-wrap: wrap;
    gap: .6rem;
    margin-bottom: 1rem;
}
.category-pill {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .45rem 1rem;
    border: 1.5px solid var(--border);
    border-radius: 100px;
    font-size: .82rem;
    font-weight: 600;
    color: var(--text-muted);
    cursor: pointer;
    transition: all var(--transition);
    user-select: none;
}
.category-pill:hover { border-color: var(--blue); color: var(--blue); }
.category-pill.selected { border-color: var(--navy); background: var(--navy); color: var(--white); }

@media (max-width: 900px) {
    .form-layout { grid-template-columns: 1fr; }
    .form-sidebar { order: -1; display: grid; grid-template-columns: 1fr 1fr; }
}
@media (max-width: 640px) {
    .form-row, .form-row.triple { grid-template-columns: 1fr; }
    .form-section { padding: 1.5rem; }
    .submit-row { padding: 1.25rem 1.5rem; }
    .form-sidebar { grid-template-columns: 1fr; }
}
</style>

<!-- Page Hero -->
<div class="form-hero">
    <div class="container">
        <div class="form-hero-eyebrow">🏛️ Public Accommodations</div>
        <h1>General Discrimination Report</h1>
        <p>Report discrimination in public spaces, services, education, government, or any other setting not covered by our housing or employment forms.</p>
    </div>
</div>

<!-- Form Body -->
<div class="form-page">
    <div class="container">
        <div class="form-layout">

            <form action="submit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="category" value="Public Accommodations">

                <div class="form-card">

                    <!-- Contact Info -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <div class="form-section-icon">👤</div>
                            Your Contact Information
                        </div>
                        <div class="form-row">
                            <div class="field">
                                <label>Full Name <span class="required">*</span></label>
                                <input type="text" name="name" required placeholder="Jane Smith">
                            </div>
                            <div class="field">
                                <label>Email Address <span class="required">*</span></label>
                                <input type="email" name="email" required placeholder="jane@example.com">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="field">
                                <label>Phone Number <span class="required">*</span></label>
                                <input type="tel" name="phone" required placeholder="(919) 555-0000">
                            </div>
                            <div class="field">
                                <label>Preferred Contact Method</label>
                                <select name="preferred_contact">
                                    <option value="Email">Email</option>
                                    <option value="Phone">Phone</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Incident Category -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <div class="form-section-icon">🗂️</div>
                            Incident Category
                        </div>
                        <div class="field">
                            <label>Where Did the Discrimination Occur? <span class="required">*</span></label>
                            <select name="incident_category" id="incident_category" onchange="toggleConditional('incident_category','Other','other_category_box','other_category_input')" required>
                                <option value="">-- Select a category --</option>
                                <option>Restaurant / Food Service</option>
                                <option>Hotel / Lodging</option>
                                <option>Retail / Store</option>
                                <option>Transportation (Bus, Taxi, Rideshare)</option>
                                <option>Healthcare / Medical Facility</option>
                                <option>Education / School</option>
                                <option>Government Office / Service</option>
                                <option>Entertainment Venue</option>
                                <option>Financial Services / Bank</option>
                                <option>Online Platform / Service</option>
                                <option>Other</option>
                            </select>
                            <div id="other_category_box" class="other-box">
                                <input type="text" name="other_category" id="other_category_input" placeholder="Please describe the setting...">
                            </div>
                        </div>
                    </div>

                    <!-- Respondent & Location -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <div class="form-section-icon">📍</div>
                            Respondent &amp; Location
                        </div>
                        <div class="form-row">
                            <div class="field">
                                <label>Name of Business or Organization <span class="required">*</span></label>
                                <input type="text" name="respondent_name" required placeholder="e.g. ABC Restaurant">
                            </div>
                            <div class="field">
                                <label>Name of Individual (if known)</label>
                                <input type="text" name="individual_name" placeholder="Employee or agent name">
                            </div>
                        </div>
                        <div class="form-row full">
                            <div class="field">
                                <label>Address Where Incident Occurred</label>
                                <input type="text" name="incident_address" placeholder="123 Main St">
                            </div>
                        </div>
                        <div class="form-row triple">
                            <div class="field">
                                <label>City</label>
                                <input type="text" name="city" placeholder="Durham">
                            </div>
                            <div class="field">
                                <label>State</label>
                                <input type="text" name="state" placeholder="NC">
                            </div>
                            <div class="field">
                                <label>ZIP Code</label>
                                <input type="text" name="zip" placeholder="27701">
                            </div>
                        </div>
                    </div>

                    <!-- Discrimination Details -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <div class="form-section-icon">📋</div>
                            Discrimination Details
                        </div>
                        <div class="form-row">
                            <div class="field">
                                <label>Date of Incident <span class="required">*</span></label>
                                <input type="date" name="incident_date" required>
                            </div>
                            <div class="field">
                                <label>Basis of Discrimination <span class="required">*</span></label>
                                <select name="discrimination_type" id="discrimination_type" onchange="toggleConditional('discrimination_type','Other','other_discrimination_box','other_discrimination_input')" required>
                                    <option value="">-- Select --</option>
                                    <option>Race</option>
                                    <option>Color</option>
                                    <option>National Origin</option>
                                    <option>Religion</option>
                                    <option>Sex / Gender</option>
                                    <option>Sexual Orientation</option>
                                    <option>Gender Identity</option>
                                    <option>Disability</option>
                                    <option>Age</option>
                                    <option>Pregnancy</option>
                                    <option>Veteran Status</option>
                                    <option>Other</option>
                                </select>
                                <div id="other_discrimination_box" class="other-box">
                                    <input type="text" name="other_discrimination" id="other_discrimination_input" placeholder="Please describe...">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="field">
                                <label>Type of Discriminatory Action <span class="required">*</span></label>
                                <select name="action_type" id="action_type" onchange="toggleConditional('action_type','Other','other_action_box','other_action_input')" required>
                                    <option value="">-- Select --</option>
                                    <option>Denial of Service</option>
                                    <option>Unequal Treatment</option>
                                    <option>Verbal Harassment or Slurs</option>
                                    <option>Physical Intimidation</option>
                                    <option>Denial of Accommodation</option>
                                    <option>Retaliation</option>
                                    <option>Other</option>
                                </select>
                                <div id="other_action_box" class="other-box">
                                    <input type="text" name="other_action_type" id="other_action_input" placeholder="Please describe...">
                                </div>
                            </div>
                            <div class="field">
                                <label>Desired Resolution <span class="required">*</span></label>
                                <select name="resolution" id="resolution" onchange="toggleConditional('resolution','Other','other_resolution_box','other_resolution_input')" required>
                                    <option value="">-- Select --</option>
                                    <option>Formal Complaint / Investigation</option>
                                    <option>Mediation</option>
                                    <option>Apology / Acknowledgment</option>
                                    <option>Policy Change</option>
                                    <option>Financial Compensation</option>
                                    <option>Other</option>
                                </select>
                                <div id="other_resolution_box" class="other-box">
                                    <input type="text" name="other_resolution" id="other_resolution_input" placeholder="Please describe...">
                                </div>
                            </div>
                        </div>
                        <div class="form-row full">
                            <div class="field">
                                <label>Have you previously reported this incident elsewhere?</label>
                                <select name="previously_reported" id="previously_reported" onchange="toggleConditional('previously_reported','Yes','prior_report_box','prior_report_input')">
                                    <option value="">-- Select --</option>
                                    <option>No</option>
                                    <option>Yes</option>
                                </select>
                                <div id="prior_report_box" class="other-box">
                                    <input type="text" name="prior_report_details" id="prior_report_input" placeholder="Where did you report it, and what was the outcome?">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Witnesses -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <div class="form-section-icon">👥</div>
                            Witness Information
                        </div>
                        <div class="form-row">
                            <div class="field">
                                <label>Were There Witnesses?</label>
                                <select name="has_witness" id="has_witness" onchange="toggleConditional('has_witness','Yes','witness_fields','')">
                                    <option value="">-- Select --</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div id="witness_fields" class="other-box">
                            <div class="form-row">
                                <div class="field">
                                    <label>Witness Name(s)</label>
                                    <input type="text" name="witness_names" placeholder="Full name(s)">
                                </div>
                                <div class="field">
                                    <label>Witness Contact Info</label>
                                    <input type="text" name="witness_contact" placeholder="Phone or email">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <div class="form-section-icon">📝</div>
                            Description of Incident
                        </div>
                        <div class="field">
                            <label>Please describe what happened in as much detail as possible <span class="required">*</span></label>
                            <textarea name="description" required placeholder="Include dates, times, locations, what was said or done, names of people involved, and any other relevant details..."></textarea>
                        </div>
                    </div>

                    <!-- Evidence -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <div class="form-section-icon">📎</div>
                            Supporting Evidence
                        </div>
                        <label class="file-upload-label">
                            <span style="font-size:1.5rem">📁</span>
                            <strong>Click to upload a file</strong>
                            <span>Photos, receipts, screenshots, documents — max 10MB</span>
                            <input type="file" name="evidence" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif">
                        </label>
                    </div>

                    <!-- Certification -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <div class="form-section-icon">✅</div>
                            Certification
                        </div>
                        <div class="cert-block">
                            <input type="checkbox" name="consent" required>
                            <p>I certify that the information provided is true and accurate to the best of my knowledge, and I consent to being contacted regarding this complaint. I understand this report is confidential.</p>
                        </div>
                    </div>

                </div><!-- /.form-card -->

                <div class="submit-row">
                    <button type="submit" class="submit-btn">Submit Report →</button>
                </div>

            </form>

            <!-- Sidebar -->
            <aside class="form-sidebar">
                <div class="sidebar-card accent-card">
                    <h4>🔒 Confidential</h4>
                    <p>Your information is stored securely and shared only as needed during the review process.</p>
                </div>
                <div class="sidebar-card">
                    <h4>📋 What to Include</h4>
                    <ul>
                        <li>Exact date, time, and location</li>
                        <li>What was said or done</li>
                        <li>Names of anyone involved</li>
                        <li>Any witnesses present</li>
                        <li>Photos, receipts, or screenshots</li>
                    </ul>
                </div>
                <div class="sidebar-card">
                    <h4>🏛️ Not Sure Where to File?</h4>
                    <p>If your incident involves housing or employment, use those dedicated forms for faster processing.</p>
                    <p style="margin-top:.6rem"><a href="housing.php" style="color:var(--blue);font-weight:600;">Housing Form →</a><br>
                    <a href="employment.php" style="color:var(--blue);font-weight:600;">Employment Form →</a></p>
                </div>
                <div class="sidebar-card">
                    <h4>📞 Need Help?</h4>
                    <p>Contact us at <a href="mailto:support@antidiscrimination.org">support@antidiscrimination.org</a> or <a href="tel:+19195551234">(919) 555-1234</a>.</p>
                </div>
            </aside>

        </div>
    </div>
</div>

<script>
function toggleConditional(selectId, triggerValue, boxId, inputId) {
    var select = document.getElementById(selectId);
    var box    = document.getElementById(boxId);
    if (!box) return;
    var show = select.value === triggerValue;
    box.classList.toggle('visible', show);
    if (inputId) {
        var input = document.getElementById(inputId);
        if (input) { input.required = show; if (!show) input.value = ''; }
    }
}
</script>

<?php include("includes/footer.php"); ?>