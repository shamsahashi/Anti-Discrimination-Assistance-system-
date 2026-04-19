<?php
session_start();

/* ══════════════════════════════════════════════
   SESSION INIT
══════════════════════════════════════════════ */
if (!isset($_SESSION['conversation'])) {
    $_SESSION['conversation'] = [];
}

/* ══════════════════════════════════════════════
   INPUT SANITIZATION
══════════════════════════════════════════════ */
function sanitize_input($input) {
    return strtolower(trim(strip_tags($input)));
}

/* ══════════════════════════════════════════════
   INTENT DETECTION
══════════════════════════════════════════════ */
function detect_intent($message) {
    $intents = [

        'greeting' => [
            'hello', 'hi', 'hey', 'good morning', 'good afternoon',
            'good evening', 'howdy', 'sup', 'greetings', 'start'
        ],

        'housing' => [
            'housing', 'rent', 'renting', 'landlord', 'apartment', 'eviction',
            'lease', 'tenant', 'mortgage', 'buy a home', 'buying a house',
            'sell a home', 'real estate', 'property', 'refused to rent',
            'denied housing', 'kicked out', 'section 8', 'fair housing',
            'housing discrimination', 'housing report', 'lender', 'loan'
        ],

        'employment' => [
            'employment', 'job', 'workplace', 'hiring', 'fired', 'termination',
            'terminated', 'laid off', 'boss', 'manager', 'supervisor', 'hr',
            'human resources', 'salary', 'wage', 'pay', 'unequal pay',
            'promotion', 'demotion', 'harassment at work', 'hostile workplace',
            'work environment', 'coworker', 'retaliation', 'wrongful', 'eeoc',
            'employment discrimination', 'job application', 'not hired', 'interview'
        ],

        'public_accommodations' => [
            'public', 'restaurant', 'store', 'hotel', 'transit', 'bus', 'taxi',
            'rideshare', 'uber', 'lyft', 'school', 'education', 'university',
            'college', 'hospital', 'doctor', 'clinic', 'healthcare', 'bank',
            'financial', 'government office', 'dmv', 'entertainment', 'venue',
            'refused service', 'denied service', 'kicked out of', 'thrown out',
            'public accommodation', 'other discrimination'
        ],

        'how_to_report' => [
            'how do i report', 'how to report', 'submit report', 'file complaint',
            'file a report', 'report discrimination', 'make a complaint',
            'where do i report', 'start a report', 'submit a complaint',
            'how does this work', 'what do i do', 'steps to report',
            'report process', 'filing process'
        ],

        'confidentiality' => [
            'confidential', 'private', 'anonymous', 'safe', 'privacy',
            'secure', 'will anyone know', 'is this anonymous', 'who sees',
            'who can see', 'data', 'information shared', 'keep secret',
            'identity', 'protected information'
        ],

        'evidence' => [
            'evidence', 'upload', 'documents', 'proof', 'attach', 'file',
            'screenshot', 'photo', 'video', 'email', 'text message', 'record',
            'recording', 'document', 'what can i upload', 'what to upload',
            'do i need evidence', 'support my claim', 'supporting documents'
        ],

        'protected_classes' => [
            'race', 'racism', 'racial', 'color', 'religion', 'religious',
            'age', 'disability', 'disabled', 'sexual orientation', 'gay',
            'lesbian', 'lgbtq', 'gender', 'sex', 'pregnancy', 'pregnant',
            'national origin', 'immigration', 'veteran', 'military',
            'protected class', 'protected characteristic', 'what counts',
            'what qualifies', 'types of discrimination', 'basis'
        ],

        'legal_resources' => [
            'lawyer', 'attorney', 'legal help', 'legal advice', 'sue',
            'lawsuit', 'legal action', 'legal resource', 'legal aid',
            'civil rights attorney', 'eeoc', 'hud', 'department of justice',
            'ncrc', 'fair housing council', 'who can help me legally'
        ],

        'durham_resources' => [
            'durham', 'city of durham', 'local resource', 'human relations',
            'commission', 'durham resource', 'local help', 'durham office',
            'north carolina', 'nc resource'
        ],

        'deadlines' => [
            'deadline', 'time limit', 'how long', 'when do i have to',
            'statute of limitations', 'days to file', 'how soon', 'expire',
            'too late', 'can i still report', 'filing window'
        ],

        'retaliation' => [
            'retaliation', 'retaliated', 'got back at', 'punished for reporting',
            'fired for complaining', 'fired after complaint', 'demoted after',
            'threatened', 'blacklisted', 'whistleblower'
        ],

        'after_submit' => [
            'what happens after', 'after i submit', 'next steps', 'what happens next',
            'review process', 'how long does it take', 'will someone contact me',
            'follow up', 'status of my report', 'what do you do with my report'
        ],

        'reset' => [
            'reset', 'start over', 'clear chat', 'new conversation', 'restart'
        ]
    ];

    foreach ($intents as $intent => $keywords) {
        foreach ($keywords as $keyword) {
            if (strpos($message, $keyword) !== false) {
                return $intent;
            }
        }
    }

    return 'unknown';
}

/* ══════════════════════════════════════════════
   RESPONSE ENGINE
══════════════════════════════════════════════ */
function generate_response($intent) {
    switch ($intent) {

        case 'greeting':
            return [
                'text' => "Hello! Welcome to the **Anti-Discrimination Assistance System**. I'm here to help you understand your rights and guide you through the reporting process.\n\nYou can ask me about:\n- Housing, employment, or public accommodation discrimination\n- How to file a report\n- What evidence to gather\n- Local and legal resources\n\nHow can I help you today?",
                'quick_replies' => ['How do I file a report?', 'What counts as discrimination?', 'Is this confidential?', 'I need legal help']
            ];

        case 'housing':
            return [
                'text' => "**Housing discrimination** is illegal under the Fair Housing Act and covers unfair treatment when renting, buying, or financing a home based on protected characteristics.\n\nCommon examples include:\n- Being refused a rental or sale\n- Offered different terms or conditions than others\n- Harassed or intimidated by a landlord\n- Denied a mortgage or loan\n- Evicted based on a protected characteristic\n\n**Protected characteristics in housing:** Race, color, national origin, religion, sex, familial status, disability, and in some areas — source of income.\n\nYou can submit a housing report using the link below. Filing deadlines under the Fair Housing Act are generally **within 1 year** of the incident.",
                'quick_replies' => ['File a Housing Report', 'What evidence should I gather?', 'What are the filing deadlines?', 'I need a lawyer']
            ];

        case 'employment':
            return [
                'text' => "**Employment discrimination** is prohibited under Title VII, the ADA, the ADEA, and other federal and state laws.\n\nCommon examples include:\n- Wrongful termination or demotion\n- Unequal pay or benefits\n- Denied promotion or training\n- Harassment or hostile work environment\n- Retaliation for making a complaint\n- Discrimination during hiring\n\n**Protected characteristics at work:** Race, color, religion, sex, national origin, age (40+), disability, pregnancy, and genetic information.\n\nEEOC complaints must generally be filed within **180–300 days** of the incident, so it's important to act promptly.",
                'quick_replies' => ['File an Employment Report', 'What is retaliation?', 'What are the filing deadlines?', 'I need legal help']
            ];

        case 'public_accommodations':
            return [
                'text' => "**Public accommodation discrimination** occurs when you are treated unfairly in places open to the public based on a protected characteristic.\n\nThis can include:\n- Restaurants, hotels, or retail stores\n- Hospitals, clinics, or healthcare providers\n- Schools, universities, or libraries\n- Banks or financial services\n- Transportation (bus, rideshare, taxi)\n- Government offices or services\n\nIf your experience doesn't fit housing or employment, our **General Discrimination Report** is the right place to start.",
                'quick_replies' => ['File a Public Report', 'What counts as discrimination?', 'Is this confidential?', 'I need legal help']
            ];

        case 'how_to_report':
            return [
                'text' => "Filing a report with ADAS is straightforward:\n\n**Step 1 — Choose your report type:**\n- 🏠 Housing discrimination\n- 💼 Employment discrimination\n- 🏛️ Public accommodations or other\n\n**Step 2 — Complete the form:**\nProvide your contact info, details about the incident, and information about the respondent.\n\n**Step 3 — Describe the incident:**\nBe as specific as possible — include dates, names, what was said or done, and any prior complaints.\n\n**Step 4 — Upload evidence** (optional but helpful)\n\n**Step 5 — Certify and submit.**\nOur team will review your report and follow up with you.\n\nAll submissions are confidential.",
                'quick_replies' => ['Housing Report', 'Employment Report', 'Public Report', 'What evidence should I upload?']
            ];

        case 'confidentiality':
            return [
                'text' => "Your privacy is a top priority.\n\n🔒 **All reports are confidential.** Your information is securely stored and only reviewed by authorized ADAS personnel.\n\nWe do not publicly disclose your identity. Your report may be shared with relevant agencies (such as the Durham Human Relations Commission or the EEOC) only as part of the formal review process, and only with your knowledge.\n\nYou will never be identified publicly as a result of submitting a report through this system.",
                'quick_replies' => ['How do I file a report?', 'What happens after I submit?', 'I need legal help']
            ];

        case 'evidence':
            return [
                'text' => "Gathering strong evidence significantly strengthens your case.\n\n**Useful evidence includes:**\n- Emails, text messages, or letters\n- Written notices or official documents\n- Screenshots of online communications\n- Photographs or videos\n- Voicemails or audio recordings\n- Pay stubs, contracts, or lease agreements\n- Witness names and contact information\n- A written timeline of events\n\n**Tips:**\n- Save everything — even minor communications\n- Write down what happened as soon as possible while details are fresh\n- Note the names and job titles of anyone involved\n\nYou can upload a supporting file directly on the report form.",
                'quick_replies' => ['How do I file a report?', 'Do I need evidence to file?', 'What happens after I submit?']
            ];

        case 'protected_classes':
            return [
                'text' => "Discrimination laws protect individuals from unfair treatment based on specific characteristics. Here are the main **protected classes** recognized under federal and North Carolina law:\n\n**Housing (Fair Housing Act):**\nRace, color, national origin, religion, sex, familial status, disability\n\n**Employment (Title VII / EEOC):**\nRace, color, religion, sex, national origin, age (40+), disability, pregnancy, genetic information, veteran status\n\n**Public Accommodations:**\nRace, color, religion, national origin, sex, disability, sexual orientation, gender identity, age (varies by jurisdiction)\n\nIf you're unsure whether your situation qualifies, describe it in your report and our team will assess it.",
                'quick_replies' => ['File a Housing Report', 'File an Employment Report', 'File a Public Report', 'I need legal help']
            ];

        case 'legal_resources':
            return [
                'text' => "We can connect you with legal professionals and civil rights organizations.\n\n**Legal Resources Available:**\n\n⚖️ **Civil Rights & Employment Attorneys**\nOur legal resources page lists attorneys in the Durham area who handle discrimination cases.\n\n🏛️ **EEOC (Equal Employment Opportunity Commission)**\nHandles federal employment discrimination complaints.\nVisit: eeoc.gov or call 1-800-669-4000\n\n🏠 **HUD (Dept. of Housing & Urban Development)**\nHandles Fair Housing Act complaints.\nVisit: hud.gov/fairhousing or call 1-800-669-9777\n\n🤝 **Durham Human Relations Commission**\nLocal resource for community-level civil rights concerns.\n\nWould you like more details on any of these?",
                'quick_replies' => ['Durham Resources', 'How do I file a report?', 'What are the filing deadlines?']
            ];

        case 'durham_resources':
            return [
                'text' => "The **City of Durham Human Relations Commission** is a local resource dedicated to advancing civil rights within the Durham community.\n\nThey offer:\n- Mediation services for discrimination disputes\n- Guidance on local civil rights ordinances\n- Community outreach and education\n- Referrals to legal and social services\n\n📍 You can find more details and contact information on our **Durham Resources** page.\n\nFor statewide resources, the **NC Human Relations Commission** (nccommerce.com/humanrelations) is also available.",
                'quick_replies' => ['I need legal help', 'How do I file a report?', 'Is this confidential?']
            ];

        case 'deadlines':
            return [
                'text' => "Filing deadlines vary depending on the type of discrimination:\n\n🏠 **Housing (Fair Housing Act)**\nGenerally **1 year** from the date of the discriminatory act.\n\n💼 **Employment (EEOC)**\n**180 days** if only state law applies.\n**300 days** if a state or local agency also covers the issue (which applies in North Carolina).\n\n🏛️ **Public Accommodations**\nDeadlines vary by law and jurisdiction — typically 180–300 days for federal claims.\n\n⚠️ **Do not delay.** Missing a filing deadline can mean losing your right to pursue the complaint. If you're unsure, file as soon as possible and consult an attorney.",
                'quick_replies' => ['How do I file a report?', 'I need legal help', 'What evidence should I gather?']
            ];

        case 'retaliation':
            return [
                'text' => "**Retaliation is illegal.** If you reported discrimination or participated in an investigation, your employer or landlord is prohibited from punishing you for it.\n\nExamples of illegal retaliation include:\n- Being fired or demoted after making a complaint\n- Receiving a negative performance review after reporting\n- Being evicted after reporting a Fair Housing violation\n- Being denied services or housing after filing a complaint\n- Threats, intimidation, or coercion\n\nRetaliation is a separate and serious violation. You can report it using our **Employment** or **Public Accommodations** form, and you should note that it occurred after a previous complaint.",
                'quick_replies' => ['File an Employment Report', 'File a Public Report', 'I need legal help', 'What are the filing deadlines?']
            ];

        case 'after_submit':
            return [
                'text' => "After you submit your report, here's what happens:\n\n**1. Acknowledgment**\nYou'll receive confirmation that your report was received.\n\n**2. Review**\nAn ADAS representative will review your submission for completeness and assess the nature of your complaint.\n\n**3. Follow-Up**\nA staff member will contact you via your preferred method (email or phone) to discuss next steps.\n\n**4. Referral (if applicable)**\nDepending on your situation, we may refer you to:\n- The Durham Human Relations Commission\n- The EEOC or HUD\n- A civil rights attorney\n\n**5. Resolution**\nOptions may include mediation, a formal investigation, or legal referral.\n\nTypical response time is **3–5 business days**.",
                'quick_replies' => ['Is this confidential?', 'I need legal help', 'File another report']
            ];

        case 'reset':
            $_SESSION['conversation'] = [];
            return [
                'text' => "Conversation cleared. Hello again! I'm here to help with questions about discrimination reporting. What can I help you with?",
                'quick_replies' => ['How do I file a report?', 'What counts as discrimination?', 'Is this confidential?', 'I need legal help']
            ];

        default:
            return [
                'text' => "I'm here to help with questions about discrimination reporting, your rights, or how to navigate the process.\n\nHere are some things I can help with:\n- 🏠 Housing discrimination\n- 💼 Employment discrimination\n- 🏛️ Public accommodation issues\n- ⚖️ Legal resources and referrals\n- 🔒 Confidentiality and privacy\n- 📋 Filing deadlines\n\nCould you tell me a bit more about your situation?",
                'quick_replies' => ['How do I file a report?', 'What counts as discrimination?', 'Is this confidential?', 'I need legal help']
            ];
    }
}

/* ══════════════════════════════════════════════
   FORM HANDLING
══════════════════════════════════════════════ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['reset_chat'])) {
        $_SESSION['conversation'] = [];
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    $userMessage = $_POST['message'] ?? '';

    if (trim($userMessage) !== '') {
        $cleanMessage = sanitize_input($userMessage);

        $_SESSION['conversation'][] = [
            'sender' => 'user',
            'text'   => htmlspecialchars($userMessage, ENT_QUOTES, 'UTF-8')
        ];

        $intent   = detect_intent($cleanMessage);
        $response = generate_response($intent);

        $_SESSION['conversation'][] = [
            'sender'        => 'bot',
            'text'          => htmlspecialchars($response['text'], ENT_QUOTES, 'UTF-8'),
            'quick_replies' => $response['quick_replies'] ?? []
        ];
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

include("includes/header.php");
?>

<!-- Page Hero -->
<div style="background:var(--navy);padding:3rem 0 2.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 80% 50%,rgba(30,77,183,.35) 0%,transparent 70%);pointer-events:none;"></div>
    <div class="container" style="position:relative;z-index:1;">
        <div style="display:inline-flex;align-items:center;gap:.5rem;font-size:.7rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:var(--gold);background:rgba(200,146,42,.12);border:1px solid rgba(200,146,42,.3);padding:.3rem .85rem;border-radius:100px;margin-bottom:1rem;">🤖 Virtual Assistant</div>
        <h1 style="color:var(--white);font-size:clamp(1.8rem,3.5vw,2.6rem);margin-bottom:.75rem;">Discrimination Reporting Assistant</h1>
        <p style="color:rgba(255,255,255,.6);font-size:.95rem;max-width:520px;">Ask me about your rights, how to file a report, filing deadlines, or local legal resources. I'm here to help.</p>
    </div>
</div>

<div style="background:var(--cream);padding:3rem 0 5rem;">
<div class="container">

<div class="chat-outer">

    <!-- Chat Window -->
    <div class="chat-card">
        <div class="chat-header">
            <div class="chat-avatar">⚖️</div>
            <div>
                <div class="chat-name">ADAS Assistant</div>
                <div class="chat-status"><span class="status-dot"></span> Online</div>
            </div>
            <form method="post" style="margin-left:auto;">
                <button type="submit" name="reset_chat" value="1" class="reset-btn" title="Clear conversation">↺ New Chat</button>
            </form>
        </div>

        <div class="chat-messages" id="chatMessages">
            <?php if (empty($_SESSION['conversation'])): ?>
                <div class="msg-row bot-row">
                    <div class="msg-avatar">⚖️</div>
                    <div class="msg-bubble bot-bubble">
                        <p>Hello! Welcome to the <strong>Anti-Discrimination Assistance System</strong>. I'm here to help you understand your rights and guide you through the reporting process.</p>
                        <p style="margin-top:.5rem;">You can ask me about housing, employment, or public accommodation discrimination, how to file a report, evidence tips, and local resources.</p>
                        <p style="margin-top:.5rem;">How can I help you today?</p>
                    </div>
                </div>
                <div class="quick-replies-row">
                    <button class="qr-btn" onclick="sendQuickReply('How do I file a report?')">How do I file a report?</button>
                    <button class="qr-btn" onclick="sendQuickReply('What counts as discrimination?')">What counts as discrimination?</button>
                    <button class="qr-btn" onclick="sendQuickReply('Is this confidential?')">Is this confidential?</button>
                    <button class="qr-btn" onclick="sendQuickReply('I need legal help')">I need legal help</button>
                </div>
            <?php else: ?>
                <?php foreach ($_SESSION['conversation'] as $i => $msg): ?>
                    <?php if ($msg['sender'] === 'user'): ?>
                        <div class="msg-row user-row">
                            <div class="msg-bubble user-bubble"><?php echo nl2br($msg['text']); ?></div>
                            <div class="msg-avatar user-avatar">👤</div>
                        </div>
                    <?php else: ?>
                        <div class="msg-row bot-row">
                            <div class="msg-avatar">⚖️</div>
                            <div class="msg-bubble bot-bubble"><?php echo nl2br(formatBotMessage($msg['text'])); ?></div>
                        </div>
                        <?php if (!empty($msg['quick_replies']) && $i === count($_SESSION['conversation']) - 1): ?>
                            <div class="quick-replies-row">
                                <?php foreach ($msg['quick_replies'] as $qr): ?>
                                    <?php
                                    $href = null;
                                    if ($qr === 'File a Housing Report' || $qr === 'Housing Report') $href = 'housing.php';
                                    elseif ($qr === 'File an Employment Report' || $qr === 'Employment Report') $href = 'employment.php';
                                    elseif ($qr === 'File a Public Report' || $qr === 'Public Report' || $qr === 'File another report') $href = 'other.php';
                                    elseif ($qr === 'Durham Resources') $href = 'durham.php';
                                    ?>
                                    <?php if ($href): ?>
                                        <a href="<?php echo $href; ?>" class="qr-btn qr-link"><?php echo htmlspecialchars($qr); ?> →</a>
                                    <?php else: ?>
                                        <button class="qr-btn" onclick="sendQuickReply('<?php echo addslashes($qr); ?>')"><?php echo htmlspecialchars($qr); ?></button>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Input Area -->
        <form method="post" class="chat-input-form" id="chatForm">
            <textarea name="message" id="messageInput" class="chat-input" placeholder="Ask a question about discrimination or reporting..." rows="1" required></textarea>
            <button type="submit" class="send-btn" aria-label="Send">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            </button>
        </form>
    </div>

    <!-- Sidebar -->
    <aside class="chat-sidebar">
        <div class="sidebar-card">
            <h4>💬 Suggested Questions</h4>
            <ul class="suggest-list">
                <li><button onclick="sendQuickReply('How do I file a housing report?')">How do I file a housing report?</button></li>
                <li><button onclick="sendQuickReply('What is employment discrimination?')">What is employment discrimination?</button></li>
                <li><button onclick="sendQuickReply('What are the filing deadlines?')">What are the filing deadlines?</button></li>
                <li><button onclick="sendQuickReply('What evidence should I gather?')">What evidence should I gather?</button></li>
                <li><button onclick="sendQuickReply('Is retaliation illegal?')">Is retaliation illegal?</button></li>
                <li><button onclick="sendQuickReply('What happens after I submit?')">What happens after I submit?</button></li>
                <li><button onclick="sendQuickReply('I need legal help')">I need legal help</button></li>
                <li><button onclick="sendQuickReply('Tell me about Durham resources')">Durham resources</button></li>
            </ul>
        </div>
        <div class="sidebar-card" style="background:var(--navy);border-color:transparent;">
            <h4 style="color:var(--gold);">📋 File a Report</h4>
            <div style="display:flex;flex-direction:column;gap:.5rem;margin-top:.5rem;">
                <a href="housing.php" style="display:flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:.6rem .85rem;color:var(--white);font-size:.83rem;font-weight:600;text-decoration:none;transition:background .2s;">🏠 Housing Report</a>
                <a href="employment.php" style="display:flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:.6rem .85rem;color:var(--white);font-size:.83rem;font-weight:600;text-decoration:none;transition:background .2s;">💼 Employment Report</a>
                <a href="other.php" style="display:flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:.6rem .85rem;color:var(--white);font-size:.83rem;font-weight:600;text-decoration:none;transition:background .2s;">🏛️ Public Report</a>
            </div>
        </div>
        <div class="sidebar-card">
            <h4>📞 Contact Us</h4>
            <p style="font-size:.83rem;color:var(--text-muted);line-height:1.65;">
                <a href="mailto:support@antidiscrimination.org" style="color:var(--blue);font-weight:600;">support@antidiscrimination.org</a><br>
                <a href="tel:+19195551234" style="color:var(--blue);font-weight:600;">(919) 555-1234</a>
            </p>
        </div>
    </aside>

</div>
</div>
</div>

<?php
/* ══════════════════════════════════════════════
   MARKDOWN-LITE FORMATTER
══════════════════════════════════════════════ */
function formatBotMessage($text) {
    // Bold: **text**
    $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);
    // Bullet lists: lines starting with -
    $text = preg_replace('/^- (.+)$/m', '<li>$1</li>', $text);
    $text = preg_replace('/(<li>.*<\/li>)/s', '<ul>$1</ul>', $text);
    return $text;
}
?>

<style>
/* ── Chat Layout ──────────────────────────────────────── */
.chat-outer {
    display: grid;
    grid-template-columns: 1fr 280px;
    gap: 1.5rem;
    align-items: start;
}

/* ── Chat Card ────────────────────────────────────────── */
.chat-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.chat-header {
    display: flex;
    align-items: center;
    gap: .85rem;
    padding: 1.1rem 1.5rem;
    background: var(--navy);
    border-bottom: 1px solid rgba(255,255,255,.08);
}
.chat-avatar {
    width: 38px; height: 38px;
    background: linear-gradient(135deg, var(--gold), var(--gold-light));
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; flex-shrink: 0;
}
.chat-name { font-size: .9rem; font-weight: 700; color: var(--white); }
.chat-status { display: flex; align-items: center; gap: .4rem; font-size: .72rem; color: rgba(255,255,255,.5); margin-top: .15rem; }
.status-dot { width: 7px; height: 7px; background: #4ade80; border-radius: 50%; animation: pulse 2s infinite; }
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.4} }

.reset-btn {
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.2);
    color: rgba(255,255,255,.7);
    font-size: .75rem;
    font-weight: 600;
    padding: .4rem .85rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all var(--transition);
    font-family: 'DM Sans', sans-serif;
}
.reset-btn:hover { background: rgba(255,255,255,.18); color: var(--white); }

/* ── Messages ─────────────────────────────────────────── */
.chat-messages {
    flex: 1;
    padding: 1.5rem;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    min-height: 420px;
    max-height: 520px;
    background: #fafbfc;
}

.msg-row {
    display: flex;
    align-items: flex-end;
    gap: .6rem;
}
.bot-row  { justify-content: flex-start; }
.user-row { justify-content: flex-end; }

.msg-avatar {
    width: 30px; height: 30px;
    background: linear-gradient(135deg, var(--navy), var(--blue));
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: .8rem; flex-shrink: 0;
}
.user-avatar { background: linear-gradient(135deg, var(--gold), var(--gold-light)); }

.msg-bubble {
    max-width: 78%;
    padding: .85rem 1.1rem;
    border-radius: 16px;
    font-size: .88rem;
    line-height: 1.65;
}
.bot-bubble {
    background: var(--white);
    border: 1px solid var(--border);
    border-bottom-left-radius: 4px;
    color: var(--text);
    box-shadow: var(--shadow-sm);
}
.bot-bubble strong { color: var(--navy); }
.bot-bubble ul { padding-left: 1.2rem; margin: .4rem 0; }
.bot-bubble li { margin-bottom: .2rem; }

.user-bubble {
    background: var(--navy);
    color: var(--white);
    border-bottom-right-radius: 4px;
}

/* ── Quick Replies ────────────────────────────────────── */
.quick-replies-row {
    display: flex;
    flex-wrap: wrap;
    gap: .5rem;
    padding-left: 2.4rem;
    margin-top: -.25rem;
}
.qr-btn {
    background: var(--white);
    border: 1.5px solid var(--blue);
    color: var(--blue);
    font-family: 'DM Sans', sans-serif;
    font-size: .78rem;
    font-weight: 600;
    padding: .35rem .85rem;
    border-radius: 100px;
    cursor: pointer;
    transition: all var(--transition);
    text-decoration: none;
    display: inline-block;
}
.qr-btn:hover { background: var(--blue); color: var(--white); }
.qr-link { border-color: var(--gold); color: var(--gold); }
.qr-link:hover { background: var(--gold); color: var(--navy); }

/* ── Input Area ───────────────────────────────────────── */
.chat-input-form {
    display: flex;
    align-items: flex-end;
    gap: .75rem;
    padding: 1rem 1.25rem;
    border-top: 1px solid var(--border);
    background: var(--white);
}
.chat-input {
    flex: 1;
    padding: .7rem 1rem;
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    font-family: 'DM Sans', sans-serif;
    font-size: .9rem;
    color: var(--text);
    resize: none;
    outline: none;
    line-height: 1.5;
    transition: border-color var(--transition), box-shadow var(--transition);
    margin-bottom: 0;
    max-height: 120px;
    overflow-y: auto;
}
.chat-input:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(30,77,183,.1); }

.send-btn {
    width: 42px; height: 42px;
    background: var(--navy);
    border: none;
    border-radius: var(--radius);
    color: var(--white);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    flex-shrink: 0;
    padding: 0;
    transition: background var(--transition), transform var(--transition);
}
.send-btn:hover { background: var(--blue); transform: translateY(-1px); }

/* ── Sidebar ──────────────────────────────────────────── */
.chat-sidebar { display: flex; flex-direction: column; gap: 1rem; }
.sidebar-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 1.25rem;
    box-shadow: var(--shadow-sm);
}
.sidebar-card h4 {
    font-size: .75rem; font-weight: 700;
    letter-spacing: .1em; text-transform: uppercase;
    color: var(--gold); margin-bottom: .75rem;
}

.suggest-list {
    list-style: none; padding: 0;
    display: flex; flex-direction: column; gap: .3rem;
}
.suggest-list li button {
    background: none; border: none; padding: .4rem 0;
    color: var(--blue); font-family: 'DM Sans', sans-serif;
    font-size: .82rem; font-weight: 600; cursor: pointer;
    text-align: left; transition: color var(--transition);
    width: 100%;
}
.suggest-list li button:hover { color: var(--navy); }

/* ── Responsive ───────────────────────────────────────── */
@media (max-width: 860px) {
    .chat-outer { grid-template-columns: 1fr; }
    .chat-sidebar { order: -1; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
}
@media (max-width: 540px) {
    .chat-sidebar { grid-template-columns: 1fr; }
    .msg-bubble { max-width: 90%; }
}
</style>

<script>
// Auto-scroll to bottom
function scrollToBottom() {
    const chat = document.getElementById('chatMessages');
    if (chat) chat.scrollTop = chat.scrollHeight;
}
document.addEventListener('DOMContentLoaded', scrollToBottom);

// Quick reply — fills input and submits
function sendQuickReply(text) {
    const input = document.getElementById('messageInput');
    if (input) {
        input.value = text;
        document.getElementById('chatForm').submit();
    }
}

// Auto-resize textarea
const textarea = document.getElementById('messageInput');
if (textarea) {
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });
    // Submit on Enter (Shift+Enter for new line)
    textarea.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (this.value.trim()) document.getElementById('chatForm').submit();
        }
    });
}
</script>

<?php include("includes/footer.php"); ?>