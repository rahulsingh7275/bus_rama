<!DOCTYPE html>
<html lang="hi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<title>Rama Travels | Site Under Maintenance</title>
<style>
  :root{
    --bg:#0f2a3d; --bg2:#173f5a; --card:#ffffff; --ink:#14232e; --muted:#5b6b77;
    --accent:#f5a623; --accent-dark:#c97f00; --wa:#1fa855; --road:#22313d;
  }
  *{box-sizing:border-box;margin:0;padding:0}
  body{
    min-height:100vh; display:flex; align-items:center; justify-content:center;
    padding:24px 16px; color:var(--ink);
    font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Noto Sans Devanagari","Mangal",sans-serif;
    background:linear-gradient(160deg,var(--bg) 0%,var(--bg2) 100%);
  }
  .card{
    width:100%; max-width:620px; background:var(--card); border-radius:20px; overflow:hidden;
    box-shadow:0 20px 50px rgba(0,0,0,.35);
  }
  .scene{position:relative; height:150px; background:linear-gradient(#cfe9f7,#eaf6fc); overflow:hidden}
  .sun{position:absolute; top:22px; right:36px; width:46px; height:46px; border-radius:50%; background:var(--accent); box-shadow:0 0 0 10px rgba(245,166,35,.25)}
  .road{position:absolute; left:0; right:0; bottom:0; height:34px; background:var(--road)}
  .road::before{content:""; position:absolute; left:0; right:0; top:15px; height:4px;
    background:repeating-linear-gradient(90deg,#fff 0 28px,transparent 28px 56px); animation:dash 1.2s linear infinite}
  .bus{position:absolute; bottom:26px; left:-120px; width:110px; animation:drive 7s linear infinite}
  @keyframes drive{from{left:-120px}to{left:100%}}
  @keyframes dash{from{background-position:0 0}to{background-position:-56px 0}}
  .body{padding:28px 26px 30px; text-align:center}
  .badge{display:inline-block; font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
    color:var(--accent-dark); background:#fff3dc; padding:6px 12px; border-radius:999px; margin-bottom:14px}
  h1{font-size:26px; line-height:1.25; margin-bottom:8px}
  .sub{color:var(--muted); font-size:15.5px; line-height:1.6}
  .en{margin-top:18px; padding-top:18px; border-top:1px dashed #d6dee4}
  .en h2{font-size:20px; margin-bottom:6px}
  .help{margin-top:24px; padding:16px; border-radius:14px; background:#f3f7fa; text-align:left}
  .help strong{display:block; margin-bottom:4px; font-size:15px}
  .help p{font-size:14.5px; color:var(--muted); line-height:1.6}
  .btns{display:flex; flex-wrap:wrap; gap:10px; margin-top:14px}
  .btn{flex:1 1 180px; text-align:center; text-decoration:none; font-weight:700; font-size:15px;
    padding:12px 16px; border-radius:12px; color:#fff}
  .btn.wa{background:var(--wa)} .btn.call{background:var(--bg)}
  .btn:focus-visible{outline:3px solid var(--accent); outline-offset:2px}
  .foot{margin-top:18px; font-size:13px; color:var(--muted)}
  @media (max-width:480px){ h1{font-size:22px} .body{padding:24px 18px 26px} }
  @media (prefers-reduced-motion:reduce){ .bus,.road::before{animation:none} .bus{left:30%} }
</style>
</head>
<body>
  <main class="card">
    <div class="scene" aria-hidden="true">
      <div class="sun"></div>
      <svg class="bus" viewBox="0 0 110 52" xmlns="http://www.w3.org/2000/svg">
        <rect x="2" y="6" width="104" height="36" rx="8" fill="#f5a623"/>
        <rect x="10" y="12" width="14" height="12" rx="2" fill="#dff1fb"/>
        <rect x="28" y="12" width="14" height="12" rx="2" fill="#dff1fb"/>
        <rect x="46" y="12" width="14" height="12" rx="2" fill="#dff1fb"/>
        <rect x="64" y="12" width="14" height="12" rx="2" fill="#dff1fb"/>
        <rect x="84" y="12" width="18" height="16" rx="3" fill="#dff1fb"/>
        <rect x="2" y="30" width="104" height="4" fill="#c97f00"/>
        <circle cx="28" cy="42" r="8" fill="#14232e"/><circle cx="28" cy="42" r="3" fill="#cfd8de"/>
        <circle cx="84" cy="42" r="8" fill="#14232e"/><circle cx="84" cy="42" r="3" fill="#cfd8de"/>
      </svg>
      <div class="road"></div>
    </div>

    <div class="body">
      <span class="badge">🛠 Maintenance</span>

      <h1>साइट अभी रखरखाव (Maintenance) में है</h1>
      <p class="sub">हम अपनी सेवा को बेहतर बना रहे हैं। कुछ समय बाद दोबारा आइए।<br>असुविधा के लिए हमें खेद है।</p>

      <div class="en">
        <h2>We'll be back soon</h2>
        <p class="sub">Our website is under maintenance while we make things better. Thank you for your patience.</p>
      </div>

     <!-- <div class="help">
        <strong>टिकट बुक करना है? / Need to book a ticket?</strong>
        <p>सीट बुक करने के लिए हमें WhatsApp या फोन करें।<br>Contact us on WhatsApp or call to book your seat.</p>
        <div class="btns">
          <a class="btn wa" href="https://wa.me/91XXXXXXXXXX" target="_blank" rel="noopener">WhatsApp: +91 XXXXX XXXXX</a>
          <a class="btn call" href="tel:+91XXXXXXXXXX">Call: +91 XXXXX XXXXX</a>
        </div>
      </div>-->

      <p class="foot">— Rama Travels</p>
    </div>
  </main>
</body>
</html>