<?php
// LEGAiSEE — index.php
// True Scrollytelling Architecture
// Pinned sections, 5-layer depth system, scroll-scrubbed morphs
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LEGAiSEE — Business Archaeology & Authority Systems</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Cinzel:wght@400;600&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
  <script src="https://unpkg.com/lenis@1.3.23/dist/lenis.min.js"></script>

  <style>
    :root {
      --obsidian: #0C0C10;
      --obsidian-mid: #111116;
      --obsidian-light: #15151a;
      --gold: #C9A961;
      --gold-bright: #D4B978;
      --gold-dim: rgba(201,170,97,0.35);
      --gold-border: rgba(201,169,97,0.15);
      --platinum: #E8E4DC;
      --silver: #B8B4AC;
      --pewter: #8A8680;
      --font-display: 'Cinzel Decorative', 'Cinzel', serif;
      --font-serif: 'Cinzel', serif;
      --font-ui: 'Inter', sans-serif;
      --ease-luxury: cubic-bezier(0.65, 0, 0.35, 1);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html.lenis, html.lenis body { height: auto; }
    .lenis.lenis-smooth { scroll-behavior: auto !important; }

    body {
      font-family: var(--font-ui);
      background: var(--obsidian);
      color: var(--silver);
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }

    /* ═══════════════════════════════════════════════════════════════
       NAVIGATION
       ═══════════════════════════════════════════════════════════════ */
    .site-nav {
      position: fixed; top: 0; left: 0; right: 0; height: 72px;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 48px; z-index: 1000;
      transition: background 0.6s, backdrop-filter 0.6s;
    }
    .site-nav.scrolled {
      background: rgba(12,12,16,0.9);
      backdrop-filter: blur(16px);
      border-bottom: 1px solid rgba(201,169,97,0.06);
    }
    .nav-logo-wrap img { height: 32px; opacity: 0.9; transition: opacity 0.3s; }
    .nav-logo-wrap img:hover { opacity: 1; }
    .nav-links { display: flex; gap: 32px; }
    .nav-links a {
      font-size: 0.68rem; letter-spacing: 0.14em; text-transform: uppercase;
      color: var(--silver); transition: color 0.3s; position: relative;
    }
    .nav-links a::after {
      content: ''; position: absolute; bottom: -4px; left: 0;
      width: 0; height: 1px; background: var(--gold); transition: width 0.4s;
    }
    .nav-links a:hover, .nav-links a.is-active { color: var(--gold); }
    .nav-links a:hover::after { width: 100%; }
    .nav-cta {
      padding: 10px 22px; border: 1px solid var(--gold-border);
      color: var(--gold) !important; transition: all 0.4s !important;
    }
    .nav-cta:hover { background: rgba(201,169,97,0.08); }
    .nav-cta::after { display: none !important; }
    .nav-hamburger { display: none; flex-direction: column; gap: 5px; background: none; border: none; cursor: pointer; }
    .nav-hamburger span { display: block; width: 24px; height: 1px; background: var(--gold); }
    .nav-mobile {
      position: fixed; top: 0; right: 0; width: 300px; height: 100vh;
      background: rgba(12,12,16,0.98); backdrop-filter: blur(20px);
      padding: 100px 36px; display: flex; flex-direction: column; gap: 20px;
      transform: translateX(100%); transition: transform 0.5s;
      z-index: 999; border-left: 1px solid var(--gold-border);
    }
    .nav-mobile.is-open { transform: translateX(0); }
    .nav-mobile a { font-size: 0.8rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--silver); padding: 8px 0; border-bottom: 1px solid rgba(201,169,97,0.06); }
    .nav-mobile a:hover { color: var(--gold); }

    /* ═══════════════════════════════════════════════════════════════
       GLOBAL PROGRESS INDICATOR
       ═══════════════════════════════════════════════════════════════ */
    .progress-rail {
      position: fixed; top: 0; left: 0; right: 0; height: 1px;
      background: rgba(201,169,97,0.08); z-index: 1001;
    }
    .progress-fill {
      height: 100%; width: 0%; background: var(--gold);
      box-shadow: 0 0 10px rgba(201,169,97,0.3);
    }
    .chapter-indicator {
      position: fixed; bottom: 36px; left: 48px; z-index: 998;
      font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase;
      color: var(--pewter); opacity: 0; transition: opacity 0.6s;
      mix-blend-mode: difference;
    }
    .chapter-indicator.visible { opacity: 1; }
    .chapter-indicator .num { color: var(--gold); font-family: var(--font-serif); font-size: 1.1rem; }

    /* ═══════════════════════════════════════════════════════════════
       PINNED SECTION SYSTEM
       Every section is a viewport-locked scene
       ═══════════════════════════════════════════════════════════════ */
    .scene {
      position: relative;
      width: 100%;
      height: 100vh;
      overflow: hidden;
      background: var(--obsidian);
    }

    /* Layer architecture: 5 depths */
    .layer {
      position: absolute; inset: 0;
      display: flex; align-items: center; justify-content: center;
      will-change: transform;
    }
    .layer-bg     { z-index: 1; pointer-events: none; }
    .layer-atmo   { z-index: 2; pointer-events: none; }
    .layer-depth  { z-index: 3; pointer-events: none; }
    .layer-content{ z-index: 10; position: relative; pointer-events: auto; }
    .layer-fore   { z-index: 20; pointer-events: none; }

    /* Atmospheric orbs */
    .atmo-orb {
      position: absolute; border-radius: 50%;
      filter: blur(100px); opacity: 0;
      will-change: transform, opacity;
    }
    .orb-gold {
      width: 50vw; height: 50vw; max-width: 600px; max-height: 600px;
      background: radial-gradient(circle, rgba(201,169,97,0.15) 0%, transparent 70%);
    }
    .orb-cool {
      width: 40vw; height: 40vw; max-width: 500px; max-height: 500px;
      background: radial-gradient(circle, rgba(180,190,210,0.08) 0%, transparent 70%);
    }

    /* Background image treatment */
    .bg-image {
      position: absolute; inset: -10%;
      background-size: cover; background-position: center;
      will-change: transform;
    }
    .bg-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(to bottom, var(--obsidian) 0%, transparent 25%, transparent 75%, var(--obsidian) 100%);
    }

    /* ═══════════════════════════════════════════════════════════════
       TYPOGRAPHY SYSTEM
       ═══════════════════════════════════════════════════════════════ */
    .display-xl {
      font-family: var(--font-display); font-weight: 400;
      font-size: clamp(2.8rem, 6vw, 6rem); line-height: 1.05;
      letter-spacing: 0.04em; text-transform: uppercase; color: var(--platinum);
    }
    .display-lg {
      font-family: var(--font-display); font-weight: 400;
      font-size: clamp(2rem, 4vw, 3.5rem); line-height: 1.1;
      letter-spacing: 0.04em; text-transform: uppercase; color: var(--platinum);
    }
    .display-md {
      font-family: var(--font-serif); font-weight: 400;
      font-size: clamp(1.4rem, 2.5vw, 2rem); line-height: 1.2;
      letter-spacing: 0.06em; text-transform: uppercase; color: var(--platinum);
    }
    .body-xl {
      font-family: var(--font-ui); font-weight: 300;
      font-size: clamp(1.1rem, 1.6vw, 1.4rem); line-height: 1.8;
      color: var(--silver);
    }
    .body-lg {
      font-family: var(--font-ui); font-weight: 300;
      font-size: clamp(1rem, 1.3vw, 1.15rem); line-height: 1.75;
      color: var(--pewter);
    }
    .eyebrow {
      font-family: var(--font-ui); font-size: 0.7rem;
      letter-spacing: 0.35em; text-transform: uppercase; color: var(--gold-dim);
    }
    .gold-text { color: var(--gold); }
    .italic-gold {
      font-style: italic; color: var(--gold-bright);
    }

    /* Line mask reveal system */
    .line-wrap { overflow: hidden; display: block; }
    .line-inner { display: block; transform: translateY(110%); }

    /* ═══════════════════════════════════════════════════════════════
       HERO SCENE
       ═══════════════════════════════════════════════════════════════ */
    .hero-center {
      text-align: center; max-width: 900px; padding: 0 40px;
      display: flex; flex-direction: column; align-items: center;
    }
    .seal-ring {
      width: 80px; height: 80px; border-radius: 50%;
      border: 1px solid rgba(201,169,97,0.35);
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 32px; position: relative;
    }
    .seal-ring::before {
      content: ''; position: absolute; inset: 8px;
      border-radius: 50%; border: 1px solid rgba(201,169,97,0.12);
    }
    .seal-letter { font-family: var(--font-display); font-size: 1.4rem; color: var(--gold); }
    .hero-logo { height: 40px; opacity: 0.85; margin-bottom: 36px; }
    .hero-divider {
      width: 100px; height: 1px;
      background: linear-gradient(to right, transparent, var(--gold), transparent);
      margin: 28px 0;
    }
    .hero-meta-row {
      display: flex; gap: 32px; align-items: center; margin-top: 48px;
      font-size: 0.68rem; letter-spacing: 0.2em; text-transform: uppercase;
      color: rgba(168,168,168,0.4);
    }
    .meta-dot { width: 4px; height: 4px; border-radius: 50%; background: var(--gold); opacity: 0.4; }

    /* ═══════════════════════════════════════════════════════════════
       VELVET ROPE SCENE
       ═══════════════════════════════════════════════════════════════ */
    .velvet-frame {
      max-width: 820px; padding: 0 40px; text-align: center;
    }
    .velvet-text {
      font-family: var(--font-ui); font-weight: 300;
      font-size: clamp(1.3rem, 2.2vw, 1.8rem); line-height: 1.85;
      color: var(--platinum);
    }
    .condition-box {
      margin-top: 48px; padding: 36px 40px;
      background: rgba(201,169,97,0.03);
      border-left: 1px solid var(--gold-border);
      text-align: left; max-width: 700px;
    }

    /* ═══════════════════════════════════════════════════════════════
       AUTHORITY STRIP SCENE
       ═══════════════════════════════════════════════════════════════ */
    .authority-scene { background: var(--obsidian-mid); }
    .authority-grid {
      display: grid; grid-template-columns: repeat(5, 1fr);
      gap: 0; width: 100%; max-width: 1200px;
    }
    .auth-cell {
      padding: 48px 24px; text-align: center;
      border-right: 1px solid rgba(201,169,97,0.06);
    }
    .auth-cell:last-child { border-right: none; }
    .auth-number {
      font-family: var(--font-serif); font-size: clamp(2rem, 3.5vw, 3rem);
      color: var(--gold); margin-bottom: 8px; line-height: 1;
    }
    .auth-label {
      font-size: 0.65rem; letter-spacing: 0.18em; text-transform: uppercase;
      color: var(--pewter);
    }

    /* ═══════════════════════════════════════════════════════════════
       THESIS SCENE — Split screen with parallax depth
       ═══════════════════════════════════════════════════════════════ */
    .split-scene {
      display: grid; grid-template-columns: 1fr 1fr;
      width: 100%; height: 100%; align-items: center;
    }
    .split-left { padding: 0 80px; max-width: 640px; justify-self: end; }
    .split-right {
      height: 100%; position: relative; overflow: hidden;
      display: flex; align-items: center; justify-content: center;
    }
    .split-image {
      position: absolute; width: 120%; height: 120%;
      background-size: cover; background-position: center;
    }
    .diagnosis-card {
      position: absolute; bottom: 80px; left: -60px;
      background: var(--obsidian-mid); border: 1px solid var(--gold-border);
      padding: 32px; width: 320px; z-index: 10;
    }

    /* ═══════════════════════════════════════════════════════════════
       FIVE STAGES — Horizontal scroll within vertical
       ═══════════════════════════════════════════════════════════════ */
    .stages-track {
      display: flex; gap: 0; width: 500vw; height: 100vh;
    }
    .stage-panel {
      width: 100vw; height: 100vh; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center;
      position: relative; overflow: hidden;
    }
    .stage-bg { position: absolute; inset: 0; background: var(--obsidian); }
    .stage-content {
      position: relative; z-index: 10; text-align: center; max-width: 600px; padding: 0 40px;
    }
    .stage-number {
      font-family: var(--font-serif); font-size: clamp(4rem, 10vw, 8rem);
      color: rgba(201,169,97,0.08); line-height: 1; margin-bottom: 16px;
    }
    .stage-visual {
      width: 280px; height: 380px; margin: 0 auto 32px;
      border: 1px solid var(--gold-border); position: relative;
      background: linear-gradient(180deg, rgba(201,169,97,0.05) 0%, transparent 100%);
      display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    .stage-cat {
      font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase;
      color: rgba(201,169,97,0.25); margin-bottom: 16px;
    }

    /* ═══════════════════════════════════════════════════════════════
       BEDROCK SCENE
       ═══════════════════════════════════════════════════════════════ */
    .bedrock-scene { background: var(--obsidian); }
    .pillars-row {
      display: grid; grid-template-columns: repeat(3, 1fr);
      gap: 32px; max-width: 1100px; width: 100%; padding: 0 40px;
    }
    .pillar {
      background: var(--obsidian-mid); border: 1px solid rgba(201,169,97,0.08);
      padding: 48px 36px; text-align: center;
    }
    .pillar-num {
      width: 48px; height: 48px; border: 1px solid var(--gold-border);
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 24px; font-family: var(--font-display);
      font-size: 1rem; color: var(--gold);
    }

    /* ═══════════════════════════════════════════════════════════════
       FRAMEWORKS SCENE
       ═══════════════════════════════════════════════════════════════ */
    .frameworks-scene { background: var(--obsidian-light); }
    .fw-grid {
      display: grid; grid-template-columns: repeat(5, 1fr);
      gap: 12px; max-width: 1100px; width: 100%; padding: 0 40px;
    }
    .fw-tile {
      aspect-ratio: 1; background: var(--obsidian);
      border: 1px solid rgba(201,169,97,0.08);
      display: flex; flex-direction: column; align-items: center; justify-content: center;
      padding: 20px; text-align: center; position: relative; overflow: hidden;
    }
    .fw-tile::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0;
      height: 2px; background: var(--gold); opacity: 0; transition: opacity 0.4s;
    }
    .fw-tile:hover::before { opacity: 0.5; }
    .fw-roman {
      font-family: var(--font-display); font-size: 2rem;
      color: rgba(201,169,97,0.15); margin-bottom: 12px;
    }
    .fw-name {
      font-size: 0.6rem; letter-spacing: 0.12em; text-transform: uppercase;
      color: var(--silver); line-height: 1.5;
    }

    /* ═══════════════════════════════════════════════════════════════
       SIGNAL SCENE
       ═══════════════════════════════════════════════════════════════ */
    .signal-scene { background: var(--obsidian); }
    .signal-center {
      text-align: center; max-width: 800px; padding: 0 40px;
    }
    .mounted-gem {
      width: 320px; height: 320px; margin: 0 auto 48px;
      border-radius: 24px; border: 1px solid var(--gold-border);
      background: linear-gradient(135deg, rgba(201,169,97,0.06) 0%, transparent 60%);
      position: relative; overflow: hidden;
    }
    .mounted-gem::before {
      content: ''; position: absolute; inset: 12px;
      border-radius: 16px; border: 1px solid rgba(201,169,97,0.08);
    }

    /* ═══════════════════════════════════════════════════════════════
       REGISTRY SCENE
       ═══════════════════════════════════════════════════════════════ */
    .registry-scene { background: var(--obsidian); }
    .registry-center {
      text-align: center; max-width: 700px; padding: 0 40px;
    }
    .registry-gem {
      width: 480px; height: 280px; margin: 0 auto 48px;
      border-radius: 8px; border: 1px solid var(--gold-border);
      background: linear-gradient(180deg, rgba(201,169,97,0.04) 0%, transparent 100%);
      position: relative;
    }
    .gate-seal {
      display: inline-flex; flex-direction: column; align-items: center; gap: 6px;
      padding: 20px 32px; border: 1px solid var(--gold-border);
      background: rgba(5,5,5,0.4); margin-top: 40px;
    }
    .seal-line {
      font-size: 0.62rem; letter-spacing: 0.22em; text-transform: uppercase; color: var(--pewter);
    }

    /* ═══════════════════════════════════════════════════════════════
       CONTINUITY ARROW
       ═══════════════════════════════════════════════════════════════ */
    .continuity {
      position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%);
      display: flex; flex-direction: column; align-items: center; gap: 8px;
      font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase;
      color: var(--gold-dim); z-index: 50;
    }
    .continuity-line { width: 1px; height: 40px; background: linear-gradient(to bottom, var(--gold-dim), transparent); }

    /* ═══════════════════════════════════════════════════════════════
       FOOTER
       ═══════════════════════════════════════════════════════════════ */
    .site-footer {
      background: var(--obsidian); border-top: 1px solid rgba(201,169,97,0.06);
      padding: 80px 48px 40px; position: relative; z-index: 10;
    }
    .footer-grid {
      max-width: 1200px; margin: 0 auto;
      display: grid; grid-template-columns: 1.5fr 1fr 1fr 1.2fr; gap: 48px;
      margin-bottom: 60px;
    }
    .footer-tagline {
      font-size: 0.85rem; line-height: 1.7; color: var(--pewter); margin: 16px 0;
    }
    .footer-col-title {
      font-size: 0.68rem; font-weight: 500; letter-spacing: 0.2em;
      text-transform: uppercase; color: var(--silver); margin-bottom: 20px;
    }
    .footer-links { list-style: none; }
    .footer-links li { margin-bottom: 10px; }
    .footer-links a { font-size: 0.8rem; color: var(--pewter); transition: color 0.3s; }
    .footer-links a:hover { color: var(--gold); }
    .footer-bottom {
      max-width: 1200px; margin: 0 auto; padding-top: 32px;
      border-top: 1px solid rgba(201,169,97,0.06);
      display: flex; justify-content: space-between;
      font-size: 0.7rem; color: var(--pewter);
    }

    /* ═══════════════════════════════════════════════════════════════
       RESPONSIVE
       ═══════════════════════════════════════════════════════════════ */
    @media (max-width: 1024px) {
      .nav-links { display: none; }
      .nav-hamburger { display: flex; }
      .split-scene { grid-template-columns: 1fr; }
      .split-left { padding: 40px; max-width: 100%; justify-self: center; }
      .split-right { display: none; }
      .pillars-row { grid-template-columns: 1fr; }
      .fw-grid { grid-template-columns: repeat(2, 1fr); }
      .authority-grid { grid-template-columns: repeat(3, 1fr); }
      .auth-cell:nth-child(3) { border-right: none; }
      .auth-cell:nth-child(4), .auth-cell:nth-child(5) { border-top: 1px solid rgba(201,169,97,0.06); }
      .footer-grid { grid-template-columns: 1fr 1fr; }
      .chapter-indicator { left: 24px; bottom: 24px; }
    }
    @media (max-width: 640px) {
      .site-nav { padding: 0 24px; }
      .display-xl { font-size: clamp(2rem, 8vw, 3rem); }
      .authority-grid { grid-template-columns: 1fr; }
      .auth-cell { border-right: none; border-bottom: 1px solid rgba(201,169,97,0.06); }
      .fw-grid { grid-template-columns: 1fr; }
      .footer-grid { grid-template-columns: 1fr; }
      .footer-bottom { flex-direction: column; gap: 12px; text-align: center; }
      .registry-gem { width: 100%; max-width: 320px; }
    }

    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {
      .line-inner { transform: translateY(0) !important; }
      .atmo-orb { display: none; }
    }
  </style>
</head>

<body data-page="home">

  <!-- Progress -->
  <div class="progress-rail"><div class="progress-fill" id="progressFill"></div></div>
  <div class="chapter-indicator" id="chapterInd">
    <span class="num" id="chNum">01</span><span style="opacity:0.3;margin:0 8px;">/</span><span>11</span>
    <span style="margin-left:12px;opacity:0.5;" id="chName">The Vault</span>
  </div>

  <!-- Nav -->
  <nav class="site-nav" id="siteNav">
    <a href="index.php" class="nav-logo-wrap"><img src="https://www.legaisee.com/Images/Legaisee-sm-300.png" alt="LEGAiSEE"></a>
    <div class="nav-links">
      <a href="index.php" class="is-active">Home</a>
      <a href="archaeology.php">The Archaeology</a>
      <a href="method.php">The Method</a>
      <a href="serve.php">Who We Serve</a>
      <a href="architect.php">The Architect</a>
      <a href="practitioner.php">The Practitioner</a>
      <a href="career.php">Career</a>
      <a href="commissions.php">Commissions</a>
      <a href="registry.php" class="nav-cta">Enter the Registry</a>
    </div>
    <button class="nav-hamburger" id="hamburger" aria-label="Menu"><span></span><span></span><span></span></button>
  </nav>
  <div class="nav-mobile" id="mobileNav">
    <a href="index.php">Home</a><a href="archaeology.php">The Archaeology</a><a href="method.php">The Method</a>
    <a href="serve.php">Who We Serve</a><a href="architect.php">The Architect</a><a href="practitioner.php">The Practitioner</a>
    <a href="career.php">Career</a><a href="commissions.php">Commissions</a><a href="registry.php">Enter the Registry</a>
  </div>


  <!-- ═══════════════════════════════════════════════════════════════
       SCENE 01 — THE VAULT ENTRANCE
       ═══════════════════════════════════════════════════════════════ -->
  <section class="scene" id="scene-01" data-ch="01" data-ch-name="The Vault">
    <div class="layer layer-bg">
      <div class="bg-image" style="background-image:url('https://www.legaisee.com/Images/Building-Hero.png'); filter:blur(2px) brightness(0.5);"></div>
      <div class="bg-overlay"></div>
    </div>
    <div class="layer layer-atmo">
      <div class="atmo-orb orb-gold" style="top:20%;left:50%;transform:translateX(-50%);"></div>
    </div>
    <div class="layer layer-content">
      <div class="hero-center">
        <div class="seal-ring hero-seal"><span class="seal-letter">L</span></div>
        <img src="https://www.legaisee.com/Images/Legaisee-sm-300.PNG" alt="LEGAiSEE" class="hero-logo hero-logo-el">
        <div class="eyebrow hero-eyebrow">Business Archaeology · Authority Systems</div>
        <h1 class="display-xl hero-title">
          <span class="line-wrap"><span class="line-inner">The Restoration of</span></span>
          <span class="line-wrap"><span class="line-inner gold-text">Asymmetric Authority</span></span>
        </h1>
        <div class="hero-divider hero-div"></div>
        <p class="body-xl hero-tagline" style="max-width:680px;">
          Forensic excavation of the strategic structure that once made you unmistakable — and the disciplined reconstruction of that signal for the market that exists today.
        </p>
        <div class="hero-meta-row hero-meta">
          <span>San Antonio</span><span class="meta-dot"></span><span>Austin</span>
          <span class="meta-dot"></span><span>I-35 Corridor</span><span class="meta-dot"></span><span>By Invitation</span>
        </div>
      </div>
    </div>
    <div class="layer layer-fore">
      <div class="continuity hero-hint"><span>Descend</span><div class="continuity-line"></div></div>
    </div>
  </section>


  <!-- ═══════════════════════════════════════════════════════════════
       SCENE 02 — THE SIGNAL
       ═══════════════════════════════════════════════════════════════ -->
  <section class="scene" id="scene-02" data-ch="02" data-ch-name="The Signal">
    <div class="layer layer-bg">
      <div class="bg-image" style="background-image:url('http://www.legaisee.com/Images/HeroLightsWide.png'); opacity:0.2; filter:brightness(0.4);"></div>
    </div>
    <div class="layer layer-atmo">
      <div class="atmo-orb orb-gold" style="bottom:-10%;left:-10%;"></div>
      <div class="atmo-orb orb-cool" style="top:-10%;right:-10%;"></div>
    </div>
    <div class="layer layer-content">
      <div class="velvet-frame">
        <div class="eyebrow velvet-eyebrow" style="margin-bottom:32px;">The Private Record</div>
        <p class="velvet-text velvet-line1">Sit down. Let the door close behind you. Pour a glass of something that took twenty years to reach its peak.</p>
        <p class="velvet-text velvet-line2" style="margin-top:24px; color:var(--silver);">You and I are here because you have built an enterprise that has stood the test of time. Not a startup. Not a venture. A real business.</p>
        <div class="condition-box velvet-condition">
          <div class="eyebrow" style="margin-bottom:16px;">The Condition</div>
          <p class="body-xl italic-gold" style="font-size:1.15rem;">
            And yet, somewhere along the way, the signal that once made you unmistakable began to fade. Not dramatically. Not catastrophically. But quietly.
          </p>
        </div>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════════════════════════════════════════
       SCENE 03 — THE CONDITION
       ═══════════════════════════════════════════════════════════════ -->
  <section class="scene authority-scene" id="scene-03" data-ch="03" data-ch-name="The Condition">
    <div class="layer layer-atmo">
      <div class="atmo-orb orb-gold" style="top:50%;left:50%;transform:translate(-50%,-50%);"></div>
    </div>
    <div class="layer layer-content">
      <div class="authority-grid">
        <div class="auth-cell auth-item"><div class="auth-number" data-value="40">0</div><div class="auth-label">Channels Excavated</div></div>
        <div class="auth-cell auth-item"><div class="auth-number" data-value="10">0</div><div class="auth-label">Interlocking Frameworks</div></div>
        <div class="auth-cell auth-item"><div class="auth-number" data-value="30">0</div><div class="auth-label">Years of Signal Craft</div></div>
        <div class="auth-cell auth-item"><div class="auth-number" data-value="3">0</div><div class="auth-label">Clients at a Time</div></div>
        <div class="auth-cell auth-item"><div class="auth-number" data-value="130">0</div><div class="auth-label">Years of History Mapped</div></div>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════════════════════════════════════════
       SCENE 04 — NARRATIVE DRIFT
       ═══════════════════════════════════════════════════════════════ -->
  <section class="scene" id="scene-04" data-ch="04" data-ch-name="Narrative Drift">
    <div class="layer layer-bg">
      <div class="bg-image" style="background-image:url('http://www.legaisee.com/Images/DigWfloor1.png'); opacity:0.12; filter:brightness(0.5);"></div>
    </div>
    <div class="layer layer-atmo">
      <div class="atmo-orb orb-cool" style="top:-15%;right:10%;"></div>
    </div>
    <div class="layer layer-content">
      <div class="split-scene">
        <div class="split-left">
          <div class="eyebrow thesis-eyebrow" style="margin-bottom:28px;">The Philosophy of Strategic Continuity</div>
          <h2 class="display-lg thesis-headline">
            <span class="line-wrap"><span class="line-inner">What was lost,</span></span>
            <span class="line-wrap"><span class="line-inner">and Why It Matters</span></span>
          </h2>
          <div style="width:80px;height:1px;background:var(--gold-border);margin:28px 0;" class="thesis-divider"></div>
          <p class="body-lg thesis-p1">Every enterprise that has operated for more than a decade carries within it the residue of a <strong class="gold-text">precise strategic structure</strong> — a configuration that once produced <strong class="gold-text">quiet, persistent recognition</strong>.</p>
          <p class="body-lg thesis-p2" style="margin-top:16px;">Then something happened. A generational shift. A pivot toward digital that discarded analog wisdom. A rebrand that smoothed away the edges. The slow erosion of attention — the <strong class="gold-text">drift</strong>.</p>
          <p class="body-lg thesis-p3" style="margin-top:16px;">We call this <strong class="gold-text">Narrative Drift</strong>. It is a structural blind spot. And it will <strong class="gold-text">leak revenue</strong> until someone maps the gap and closes it.</p>
        </div>
        <div class="split-right">
          <div class="split-image" style="background-image:url('http://www.legaisee.com/Images/DigWfloor1.png');"></div>
          <div class="diagnosis-card thesis-card">
            <div class="eyebrow" style="margin-bottom:12px;">The Diagnosis</div>
            <div class="body-lg" style="font-size:0.85rem; line-height:1.8;">
              Quiet recognition — lost.<br>
              Absolute clarity — faded.<br>
              Unreplicable weight — invisible.<br>
              Narrative Drift — structural.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════════════════════════════════════════
       SCENE 05 — THE PRIVATE RECORD
       ═══════════════════════════════════════════════════════════════ -->
  <section class="scene" id="scene-05" data-ch="05" data-ch-name="The Private Record">
    <div class="layer layer-atmo">
      <div class="atmo-orb orb-gold" style="bottom:-20%;left:30%;"></div>
    </div>
    <div class="layer layer-content">
      <div class="split-scene" style="direction:rtl;">
        <div class="split-left" style="direction:ltr;">
          <div class="eyebrow arch-eyebrow" style="margin-bottom:28px;">The Practice</div>
          <h2 class="display-lg arch-headline">
            <span class="line-wrap"><span class="line-inner">We do not</span></span>
            <span class="line-wrap"><span class="line-inner">"Create" Marketing Here</span></span>
          </h2>
          <div style="width:80px;height:1px;background:var(--gold-border);margin:28px 0;" class="arch-divider"></div>
          <p class="body-lg arch-p1">We practice <strong class="gold-text">Business Archaeology</strong> — the forensic excavation of the precise strategic structure that once produced your most profitable era.</p>
          <p class="body-lg arch-p2" style="margin-top:16px;">Scaling an unstable narrative only accelerates failure. We do not build on sand. <strong class="gold-text">We bedrock.</strong></p>
          <p class="body-lg arch-p3" style="margin-top:16px;">The Architect excavates. The Architect listens to the silence between what you say and what your market hears. The Architect builds systems that produce <strong class="gold-text">Signal</strong> — the kind that carries its own <strong class="gold-text">Unavoidable Logic</strong>.</p>
        </div>
        <div class="split-right" style="direction:ltr;">
          <div style="display:flex;flex-direction:column;gap:20px;align-items:center;padding:40px;">
            <div style="width:240px;height:180px;border:1px solid var(--gold-border);background:linear-gradient(180deg,rgba(201,169,97,0.05) 0%,transparent 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;">
              <span style="font-size:0.6rem;letter-spacing:0.3em;text-transform:uppercase;color:rgba(201,169,97,0.3);">CAT-RAW-001</span>
              <span style="font-family:var(--font-display);font-size:0.9rem;color:var(--silver);margin-top:8px;">Raw Stone</span>
            </div>
            <div style="width:280px;height:160px;border:1px solid var(--gold-border);background:linear-gradient(180deg,rgba(201,169,97,0.05) 0%,transparent 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;">
              <span style="font-size:0.6rem;letter-spacing:0.3em;text-transform:uppercase;color:rgba(201,169,97,0.3);">CAT-CUT-001</span>
              <span style="font-family:var(--font-display);font-size:0.9rem;color:var(--silver);margin-top:8px;">Cut &amp; Shaped</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════════════════════════════════════════
       SCENE 06 — THE FIVE STAGES
       Horizontal scroll container
       ═══════════════════════════════════════════════════════════════ -->
  <section class="scene" id="scene-06" data-ch="06" data-ch-name="The Five Stages" style="overflow:hidden;">
    <div class="layer layer-bg">
      <div class="bg-image" style="background-image:url('http://www.legaisee.com/Images/Library2Diamond.png'); opacity:0.08;"></div>
    </div>
    <div class="layer layer-atmo">
      <div class="atmo-orb orb-amber" style="top:50%;left:50%;transform:translate(-50%,-50%);"></div>
    </div>
    <div class="layer layer-content" style="align-items:flex-start;justify-content:flex-start;">
      <div class="stages-track" id="stagesTrack">
        <div class="stage-panel">
          <div class="stage-bg" style="background:var(--obsidian);"></div>
          <div class="stage-content">
            <div class="eyebrow" style="margin-bottom:20px;">The Transformation Metaphor</div>
            <div class="stage-number">00</div>
            <h3 class="display-md">Natural Habitat</h3>
            <p class="body-lg" style="margin-top:16px;">The gem in earth — your institutional memory in its natural, unexcavated state.</p>
          </div>
        </div>
        <div class="stage-panel">
          <div class="stage-bg" style="background:var(--obsidian-mid);"></div>
          <div class="stage-content">
            <div class="stage-number">01</div>
            <div class="stage-visual"><span class="stage-cat">CAT-RAW-00</span><span style="font-family:var(--font-display);color:var(--silver);">Raw Stone</span></div>
            <h3 class="display-md">Discovery</h3>
            <p class="body-lg" style="margin-top:16px;">Excavated from your archives — uncut, unpolished, and potentially priceless.</p>
          </div>
        </div>
        <div class="stage-panel">
          <div class="stage-bg" style="background:var(--obsidian);"></div>
          <div class="stage-content">
            <div class="stage-number">02</div>
            <div class="stage-visual"><span class="stage-cat">CAT-CUT-00</span><span style="font-family:var(--font-display);color:var(--silver);">Cut &amp; Shaped</span></div>
            <h3 class="display-md">Refinement</h3>
            <p class="body-lg" style="margin-top:16px;">The Lapidary phase — raw findings faceted into strategic instruments of precision.</p>
          </div>
        </div>
        <div class="stage-panel">
          <div class="stage-bg" style="background:var(--obsidian-mid);"></div>
          <div class="stage-content">
            <div class="stage-number">03</div>
            <div class="stage-visual"><span class="stage-cat">CAT-MNT-00</span><span style="font-family:var(--font-display);color:var(--silver);">Mounted</span></div>
            <h3 class="display-md">The Setting</h3>
            <p class="body-lg" style="margin-top:16px;">Set in the squircle case of authority — your signal mounted for deployment.</p>
          </div>
        </div>
        <div class="stage-panel">
          <div class="stage-bg" style="background:var(--obsidian);"></div>
          <div class="stage-content">
            <div class="stage-number">04</div>
            <div class="stage-visual"><span class="stage-cat">CAT-DSP-00</span><span style="font-family:var(--font-display);color:var(--silver);">Museum Display</span></div>
            <h3 class="display-md">The Exhibition</h3>
            <p class="body-lg" style="margin-top:16px;">Presented under museum light — your restored authority, undeniable and visible.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════════════════════════════════════════
       SCENE 07 — THE PHILOSOPHY
       ═══════════════════════════════════════════════════════════════ -->
  <section class="scene bedrock-scene" id="scene-07" data-ch="07" data-ch-name="The Philosophy">
    <div class="layer layer-atmo">
      <div class="atmo-orb orb-gold" style="top:-10%;right:20%;"></div>
    </div>
    <div class="layer layer-content">
      <div style="text-align:center;max-width:700px;margin-bottom:60px;padding:0 40px;">
        <div class="eyebrow bedrock-eyebrow" style="margin-bottom:24px;">The Foundation</div>
        <h2 class="display-lg bedrock-headline">
          <span class="line-wrap"><span class="line-inner">The Bedrock of</span></span>
          <span class="line-wrap"><span class="line-inner">Forensic Truth</span></span>
        </h2>
      </div>
      <div class="pillars-row">
        <div class="pillar bedrock-pillar">
          <div class="pillar-num">I</div>
          <div class="display-md" style="font-size:1rem;margin-bottom:16px;">Every Word Is Sacred</div>
          <p class="body-lg" style="font-size:0.9rem;">No copy is generated. No claims invented. Every word is excavated from your historical record or synthesized through rigorous triangulation.</p>
        </div>
        <div class="pillar bedrock-pillar" style="margin-top:24px;">
          <div class="pillar-num">II</div>
          <div class="display-md" style="font-size:1rem;margin-bottom:16px;">The 3-Source Rule</div>
          <p class="body-lg" style="font-size:0.9rem;">No significant claim enters your report without a minimum of two independent sources, ideally three or more converging.</p>
        </div>
        <div class="pillar bedrock-pillar">
          <div class="pillar-num">III</div>
          <div class="display-md" style="font-size:1rem;margin-bottom:16px;">Continuous Verification</div>
          <p class="body-lg" style="font-size:0.9rem;">The excavation does not end at delivery. New artifacts emerge. Our model allows for addendums without compromising what is established.</p>
        </div>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════════════════════════════════════════
       SCENE 08 — THE BEDROCK
       Geography strip
       ═══════════════════════════════════════════════════════════════ -->
  <section class="scene authority-scene" id="scene-08" data-ch="08" data-ch-name="The Bedrock" style="min-height: auto; height: auto; padding: 60px 0;">
    <div class="layer layer-content" style="position:relative;">
      <div style="display:flex;align-items:center;gap:48px;max-width:1200px;width:100%;padding:0 40px;flex-wrap:wrap;">
        <div class="eyebrow">Service Territory</div>
        <div style="width:1px;height:40px;background:var(--gold-border);"></div>
        <div style="flex:1;min-width:280px;">
          <div class="display-md" style="font-size:1.1rem;">San Antonio · Austin · The I-35 Corridor</div>
          <p class="body-lg" style="margin-top:4px;font-size:0.85rem;">Serving enterprises with 5–10+ years of operating history, generationally owned businesses, and the $30M+ giants who built this corridor.</p>
        </div>
        <a href="serve.php" class="nav-cta" style="flex-shrink:0;">Who We Serve</a>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════════════════════════════════════════
       SCENE 09 — THE TEN FRAMEWORKS
       ═══════════════════════════════════════════════════════════════ -->
  <section class="scene frameworks-scene" id="scene-09" data-ch="09" data-ch-name="The Ten Frameworks">
    <div class="layer layer-bg">
      <div class="bg-image" style="background-image:url('http://www.legaisee.com/Images/LapidaryVerticleBlue.png'); opacity:0.1;"></div>
    </div>
    <div class="layer layer-atmo">
      <div class="atmo-orb orb-cool" style="bottom:-10%;left:-5%;"></div>
    </div>
    <div class="layer layer-content">
      <div style="text-align:center;max-width:700px;margin-bottom:48px;padding:0 40px;">
        <div class="eyebrow fw-eyebrow" style="margin-bottom:24px;">The Methodology</div>
        <h2 class="display-lg fw-headline">
          <span class="line-wrap"><span class="line-inner">The Ten Interlocking</span></span>
          <span class="line-wrap"><span class="line-inner">Frameworks</span></span>
        </h2>
      </div>
      <div class="fw-grid">
        <div class="fw-tile"><div class="fw-roman">I</div><div class="fw-name">40+ Channel<br>Taxonomy</div></div>
        <div class="fw-tile"><div class="fw-roman">II</div><div class="fw-name">Hierarchy<br>of Truth</div></div>
        <div class="fw-tile"><div class="fw-roman">III</div><div class="fw-name">Triangulation<br>Protocol</div></div>
        <div class="fw-tile"><div class="fw-roman">IV</div><div class="fw-name">Eight Classes<br>of Evidence</div></div>
        <div class="fw-tile"><div class="fw-roman">V</div><div class="fw-name">8-Dimension<br>Voice Profile</div></div>
        <div class="fw-tile"><div class="fw-roman">VI</div><div class="fw-name">ROI Trigger<br>Mapping</div></div>
        <div class="fw-tile"><div class="fw-roman">VII</div><div class="fw-name">Competitive<br>Asymmetry</div></div>
        <div class="fw-tile"><div class="fw-roman">VIII</div><div class="fw-name">Private<br>Archaeology</div></div>
        <div class="fw-tile"><div class="fw-roman">IX</div><div class="fw-name">Master<br>Operations</div></div>
        <div class="fw-tile"><div class="fw-roman">X</div><div class="fw-name">CAMERA<br>Authority</div></div>
      </div>
      <div style="text-align:center;margin-top:48px;">
        <a href="method.php" class="nav-cta">Study the Full Methodology</a>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════════════════════════════════════════
       SCENE 10 — THE RESTORED SIGNAL
       ═══════════════════════════════════════════════════════════════ -->
  <section class="scene signal-scene" id="scene-10" data-ch="10" data-ch-name="The Restored Signal">
    <div class="layer layer-atmo">
      <div class="atmo-orb orb-gold" style="top:30%;right:-10%;"></div>
    </div>
    <div class="layer layer-content">
      <div class="signal-center">
        <div class="eyebrow signal-eyebrow" style="margin-bottom:28px;">The Mounted Specimen</div>
        <div class="mounted-gem signal-gem"></div>
        <h2 class="display-lg signal-headline">
          <span class="line-wrap"><span class="line-inner">The Signal,</span></span>
          <span class="line-wrap"><span class="line-inner">Restored</span></span>
        </h2>
        <div style="width:80px;height:1px;background:var(--gold-border);margin:28px auto;" class="signal-divider"></div>
        <p class="body-xl signal-text">These ten frameworks interlock. They cross-reference. They create a web of verification so dense that by the time we present our findings, there is no room for doubt. Only clarity. Only the <strong class="gold-text">absolute clarity it once possessed</strong>.</p>
        <p class="body-lg signal-text2" style="margin-top:20px;">You will not find case studies on a public website. The work is private. The results are documented in boardrooms, not blog posts.</p>
        <div style="margin-top:40px;display:flex;gap:16px;justify-content:center;">
          <a href="commissions.php" style="padding:12px 28px;background:var(--gold);color:var(--obsidian);font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;">View Commissions</a>
          <a href="architect.php" style="padding:12px 28px;border:1px solid var(--gold-border);color:var(--gold);font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;">The Architect</a>
        </div>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════════════════════════════════════════
       SCENE 11 — THE PRIVATE REGISTRY
       ═══════════════════════════════════════════════════════════════ -->
  <section class="scene registry-scene" id="scene-11" data-ch="11" data-ch-name="The Registry">
    <div class="layer layer-bg">
      <div class="bg-image" style="background-image:url('http://www.legaisee.com/Images/PolishCaseMask.png'); opacity:0.1; filter:brightness(0.5);"></div>
      <div class="bg-overlay"></div>
    </div>
    <div class="layer layer-atmo">
      <div class="atmo-orb orb-gold" style="top:50%;left:50%;transform:translate(-50%,-50%);"></div>
    </div>
    <div class="layer layer-content">
      <div class="registry-center">
        <div class="eyebrow registry-eyebrow" style="margin-bottom:32px;">The Private Registry</div>
        <p class="body-xl italic-gold registry-quote" style="font-size:clamp(1.2rem,2vw,1.6rem);margin-bottom:48px;">
          "There is a version of your business that worked better than this one. It is not gone. It is buried. And we know exactly where to dig."
        </p>
        <div class="registry-gem registry-visual"></div>
        <div style="display:flex;gap:16px;justify-content:center;margin-bottom:40px;">
          <a href="registry.php" style="padding:14px 32px;background:var(--gold);color:var(--obsidian);font-size:0.7rem;letter-spacing:0.18em;text-transform:uppercase;font-weight:500;">Enter the Private Registry</a>
          <a href="commissions.php" style="padding:14px 32px;border:1px solid var(--gold-border);color:var(--gold);font-size:0.7rem;letter-spacing:0.18em;text-transform:uppercase;">View Commissions</a>
        </div>
        <div class="gate-seal registry-seal">
          <span class="seal-line">Invitation Only</span>
          <span class="seal-line">No Public Registry</span>
          <span class="seal-line">San Antonio · Austin · I-35 Corridor</span>
        </div>
      </div>
    </div>
  </section>


  <!-- ═══════════════════════════════════════════════════════════════
       FOOTER
       ═══════════════════════════════════════════════════════════════ -->
  <footer class="site-footer">
    <div class="footer-grid">
      <div>
        <img src="https://www.legaisee.com/Images/Legaisee-sm-300.png" alt="LEGAiSEE" style="height:28px;opacity:0.9;">
        <p class="footer-tagline">Business Archaeology &amp; Authority Systems.<br>We excavate the signal. We restore the clarity.<br>We do not build on sand. We bedrock.</p>
        <div class="eyebrow">San Antonio · Austin · The I-35 Corridor</div>
      </div>
      <div>
        <div class="footer-col-title">The Practice</div>
        <ul class="footer-links">
          <li><a href="archaeology.php">The Archaeology</a></li>
          <li><a href="method.php">The Ten Frameworks</a></li>
          <li><a href="serve.php">Who We Serve</a></li>
          <li><a href="architect.php">The Architect</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Commissions</div>
        <ul class="footer-links">
          <li><a href="commissions.php">The Excavation</a></li>
          <li><a href="commissions.php">Authority Systems</a></li>
          <li><a href="commissions.php">The Bedrock Pledge</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">The Registry</div>
        <ul class="footer-links">
          <li><a href="registry.php">Request Entry</a></li>
          <li><a href="registry.php">Confidentiality Protocol</a></li>
          <li><a href="registry.php">Current Availability</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>&copy; LEGAiSEE &middot; All Rights Reserved</span>
      <span style="font-family:var(--font-display);font-size:0.7rem;color:var(--gold-dim);">The Signal, Restored</span>
    </div>
  </footer>


  <!-- ═══════════════════════════════════════════════════════════════
       SCROLLYTELLING ENGINE
       ═══════════════════════════════════════════════════════════════ -->
  <script>
    /* ── Lenis ─────────────────────────────────────────────────── */
    const lenis = new Lenis({ duration: 1.2, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => lenis.raf(time * 1000));
    gsap.ticker.lagSmoothing(0);

    /* ── Nav ───────────────────────────────────────────────────── */
    const nav = document.getElementById('siteNav');
    window.addEventListener('scroll', () => nav.classList.toggle('scrolled', window.scrollY > 40), { passive: true });
    const hamburger = document.getElementById('hamburger');
    const mobileNav = document.getElementById('mobileNav');
    hamburger.addEventListener('click', () => mobileNav.classList.toggle('is-open'));
    mobileNav.querySelectorAll('a').forEach(a => a.addEventListener('click', () => mobileNav.classList.remove('is-open')));

    /* ── Progress & Chapter ────────────────────────────────────── */
    const progressFill = document.getElementById('progressFill');
    const chNum = document.getElementById('chNum');
    const chName = document.getElementById('chName');
    const chapterInd = document.getElementById('chapterInd');

    gsap.to(progressFill, {
      width: '100%',
      ease: 'none',
      scrollTrigger: { trigger: document.body, start: 'top top', end: 'bottom bottom', scrub: true }
    });

    document.querySelectorAll('.scene[data-ch]').forEach(scene => {
      ScrollTrigger.create({
        trigger: scene,
        start: 'top center',
        end: 'bottom center',
        onEnter: () => { chNum.textContent = scene.dataset.ch; chName.textContent = scene.dataset.chName; chapterInd.classList.add('visible'); },
        onEnterBack: () => { chNum.textContent = scene.dataset.ch; chName.textContent = scene.dataset.chName; chapterInd.classList.add('visible'); }
      });
    });

    /* ── GSAP Defaults ───────────────────────────────────────── */
    gsap.registerPlugin(ScrollTrigger);
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced) {
      document.querySelectorAll('.line-inner').forEach(el => el.style.transform = 'translateY(0)');
    }

    /* ═══════════════════════════════════════════════════════════════
       SCENE 01 — HERO
       Enter: 0-30% | Settle: 30-70% | Exit: 70-100%
       ═══════════════════════════════════════════════════════════════ */
    if (!reduced) {
      const tl01 = gsap.timeline({
        scrollTrigger: {
          trigger: '#scene-01', start: 'top top', end: '+=130%',
          pin: true, scrub: 0.5, snap: { snapTo: [0, 0.5, 1], duration: { min: 0.2, max: 0.5 }, ease: 'power2.inOut' }
        }
      });

      tl01
        .fromTo('.hero-seal', { scale: 0.5, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.15 }, 0)
        .fromTo('.hero-logo-el', { y: 40, opacity: 0 }, { y: 0, opacity: 0.85, duration: 0.12 }, 0.03)
        .fromTo('.hero-eyebrow', { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.1 }, 0.06)
        .fromTo('.hero-title .line-inner', { y: '110%' }, { y: '0%', duration: 0.15, stagger: 0.03 }, 0.08)
        .fromTo('.hero-div', { scaleX: 0 }, { scaleX: 1, duration: 0.08 }, 0.18)
        .fromTo('.hero-tagline', { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.12 }, 0.2)
        .fromTo('.hero-meta', { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.1 }, 0.26)
        .fromTo('.hero-hint', { opacity: 0 }, { opacity: 1, duration: 0.08 }, 0.3)
        .fromTo('#scene-01 .layer-bg', { y: 0 }, { y: 80, duration: 1 }, 0)
        // EXIT
        .to('.hero-center', { y: -80, opacity: 0, duration: 0.25 }, 0.7)
        .to('.hero-hint', { opacity: 0, duration: 0.1 }, 0.7)
        .to('#scene-01 .orb-gold', { scale: 1.5, opacity: 0, duration: 0.3 }, 0.7);

      /* ── SCENE 02 — VELVET ROPE ─────────────────────────────── */
      const tl02 = gsap.timeline({
        scrollTrigger: {
          trigger: '#scene-02', start: 'top top', end: '+=120%',
          pin: true, scrub: 0.5
        }
      });

      tl02
        .fromTo('#scene-02 .bg-image', { y: -40 }, { y: 40, duration: 1 }, 0)
        .fromTo('#scene-02 .orb-gold', { x: -50, opacity: 0 }, { x: 0, opacity: 0.6, duration: 0.3 }, 0)
        .fromTo('#scene-02 .orb-cool', { x: 50, opacity: 0 }, { x: 0, opacity: 0.4, duration: 0.3 }, 0)
        .fromTo('.velvet-eyebrow', { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.15 }, 0.05)
        .fromTo('.velvet-line1', { y: 50, opacity: 0 }, { y: 0, opacity: 1, duration: 0.2 }, 0.1)
        .fromTo('.velvet-line2', { y: 50, opacity: 0 }, { y: 0, opacity: 1, duration: 0.2 }, 0.2)
        .fromTo('.velvet-condition', { y: 40, opacity: 0 }, { y: 0, opacity: 1, duration: 0.2 }, 0.35)
        .to('.velvet-frame', { y: -60, opacity: 0, duration: 0.25 }, 0.75);

      /* ── SCENE 03 — AUTHORITY STRIP ─────────────────────────── */
      const tl03 = gsap.timeline({
        scrollTrigger: {
          trigger: '#scene-03', start: 'top top', end: '+=100%',
          pin: true, scrub: 0.5
        }
      });

      document.querySelectorAll('.auth-number').forEach((el, i) => {
        const target = parseInt(el.dataset.value);
        tl03.fromTo(el, { textContent: 0 }, {
          textContent: target, duration: 0.25, ease: 'power1.out',
          snap: { textContent: 1 },
          onUpdate: function() { el.textContent = Math.round(this.targets()[0].textContent) + (target === 40 ? '+' : ''); }
        }, 0.1 + i * 0.04);
      });

      tl03
        .fromTo('.auth-item', { y: 60, opacity: 0 }, { y: 0, opacity: 1, duration: 0.2, stagger: 0.04 }, 0.05)
        .to('.auth-item', { y: -40, opacity: 0, duration: 0.2, stagger: 0.03 }, 0.75);

      /* ── SCENE 04 — THESIS ──────────────────────────────────── */
      const tl04 = gsap.timeline({
        scrollTrigger: {
          trigger: '#scene-04', start: 'top top', end: '+=140%',
          pin: true, scrub: 0.5
        }
      });

      tl04
        .fromTo('#scene-04 .bg-image', { y: -60 }, { y: 60, duration: 1 }, 0)
        .fromTo('#scene-04 .split-image', { y: 80, scale: 1.1 }, { y: -80, scale: 1, duration: 1 }, 0)
        .fromTo('.thesis-eyebrow', { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.12 }, 0.05)
        .fromTo('.thesis-headline .line-inner', { y: '110%' }, { y: '0%', duration: 0.15, stagger: 0.03 }, 0.08)
        .fromTo('.thesis-divider', { scaleX: 0 }, { scaleX: 1, duration: 0.1 }, 0.15)
        .fromTo('.thesis-p1', { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.15 }, 0.18)
        .fromTo('.thesis-p2', { y: 30, opacity: 0 }, { y:        .fromTo('.thesis-p2', { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.15 }, 0.25)
        .fromTo('.thesis-p3', { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.15 }, 0.32)
        .fromTo('.thesis-card', { x: 80, opacity: 0 }, { x: 0, opacity: 1, duration: 0.2 }, 0.28)
        // EXIT
        .to('.split-left', { x: -60, opacity: 0, duration: 0.25 }, 0.75)
        .to('.split-right', { x: 60, opacity: 0, duration: 0.25 }, 0.75);

      /* ── SCENE 05 — PRIVATE RECORD ──────────────────────────── */
      const tl05 = gsap.timeline({
        scrollTrigger: {
          trigger: '#scene-05', start: 'top top', end: '+=130%',
          pin: true, scrub: 0.5
        }
      });

      tl05
        .fromTo('#scene-05 .orb-gold', { scale: 0.8, opacity: 0 }, { scale: 1, opacity: 0.5, duration: 0.3 }, 0)
        .fromTo('.arch-eyebrow', { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.12 }, 0.05)
        .fromTo('.arch-headline .line-inner', { y: '110%' }, { y: '0%', duration: 0.15, stagger: 0.03 }, 0.08)
        .fromTo('.arch-divider', { scaleX: 0 }, { scaleX: 1, duration: 0.1 }, 0.15)
        .fromTo('.arch-p1', { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.15 }, 0.18)
        .fromTo('.arch-p2', { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.15 }, 0.25)
        .fromTo('.arch-p3', { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.15 }, 0.32)
        .fromTo('#scene-05 .split-right', { x: 80, opacity: 0 }, { x: 0, opacity: 1, duration: 0.25 }, 0.1)
        // EXIT
        .to('#scene-05 .split-scene', { y: -60, opacity: 0, duration: 0.25 }, 0.75);

      /* ── SCENE 06 — FIVE STAGES (Horizontal Scroll) ───────── */
      const tl06 = gsap.timeline({
        scrollTrigger: {
          trigger: '#scene-06', start: 'top top', end: '+=350%',
          pin: true, scrub: 0.6,
          snap: { snapTo: [0, 0.25, 0.5, 0.75, 1], duration: { min: 0.2, max: 0.4 }, ease: 'power2.inOut' }
        }
      });

      tl06
        .fromTo('#stagesTrack', { x: '0%' }, { x: '-80%', duration: 1, ease: 'none' }, 0)
        .fromTo('#scene-06 .bg-image', { x: 0 }, { x: 60, duration: 1, ease: 'none' }, 0);

      /* ── SCENE 07 — PHILOSOPHY ──────────────────────────────── */
      const tl07 = gsap.timeline({
        scrollTrigger: {
          trigger: '#scene-07', start: 'top top', end: '+=120%',
          pin: true, scrub: 0.5
        }
      });

      tl07
        .fromTo('#scene-07 .orb-gold', { y: 30, opacity: 0 }, { y: 0, opacity: 0.5, duration: 0.3 }, 0)
        .fromTo('.bedrock-eyebrow', { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.12 }, 0.05)
        .fromTo('.bedrock-headline .line-inner', { y: '110%' }, { y: '0%', duration: 0.15, stagger: 0.03 }, 0.08)
        .fromTo('.bedrock-pillar', { y: 60, opacity: 0 }, { y: 0, opacity: 1, duration: 0.2, stagger: 0.08 }, 0.2)
        // EXIT
        .to('.bedrock-pillar', { y: -40, opacity: 0, duration: 0.2, stagger: 0.05 }, 0.75)
        .to('.bedrock-headline, .bedrock-eyebrow', { y: -30, opacity: 0, duration: 0.2 }, 0.75);

      /* ── SCENE 09 — FRAMEWORKS ──────────────────────────────── */
      const tl09 = gsap.timeline({
        scrollTrigger: {
          trigger: '#scene-09', start: 'top top', end: '+=130%',
          pin: true, scrub: 0.5
        }
      });

      tl09
        .fromTo('#scene-09 .bg-image', { y: -40 }, { y: 40, duration: 1 }, 0)
        .fromTo('#scene-09 .orb-cool', { x: -40, opacity: 0 }, { x: 0, opacity: 0.4, duration: 0.3 }, 0)
        .fromTo('.fw-eyebrow', { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.12 }, 0.05)
        .fromTo('.fw-headline .line-inner', { y: '110%' }, { y: '0%', duration: 0.15, stagger: 0.03 }, 0.08)
        .fromTo('.fw-tile', { y: 40, opacity: 0, scale: 0.95 }, { y: 0, opacity: 1, scale: 1, duration: 0.15, stagger: 0.02 }, 0.2)
        // EXIT
        .to('.fw-grid', { y: -50, opacity: 0, duration: 0.25 }, 0.75);

      /* ── SCENE 10 — RESTORED SIGNAL ─────────────────────────── */
      const tl10 = gsap.timeline({
        scrollTrigger: {
          trigger: '#scene-10', start: 'top top', end: '+=120%',
          pin: true, scrub: 0.5
        }
      });

      tl10
        .fromTo('#scene-10 .orb-gold', { scale: 0.8, opacity: 0 }, { scale: 1, opacity: 0.5, duration: 0.3 }, 0)
        .fromTo('.signal-eyebrow', { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.12 }, 0.05)
        .fromTo('.signal-gem', { y: 60, opacity: 0, scale: 0.9 }, { y: 0, opacity: 1, scale: 1, duration: 0.2 }, 0.08)
        .fromTo('.signal-headline .line-inner', { y: '110%' }, { y: '0%', duration: 0.15, stagger: 0.03 }, 0.12)
        .fromTo('.signal-divider', { scaleX: 0 }, { scaleX: 1, duration: 0.1 }, 0.2)
        .fromTo('.signal-text', { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.15 }, 0.22)
        .fromTo('.signal-text2', { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.15 }, 0.3)
        // EXIT
        .to('.signal-center', { y: -60, opacity: 0, duration: 0.25 }, 0.75);

      /* ── SCENE 11 — REGISTRY ────────────────────────────────── */
      const tl11 = gsap.timeline({
        scrollTrigger: {
          trigger: '#scene-11', start: 'top top', end: '+=100%',
          pin: true, scrub: 0.5
        }
      });

      tl11
        .fromTo('#scene-11 .bg-image', { y: -30 }, { y: 30, duration: 1 }, 0)
        .fromTo('#scene-11 .orb-gold', { scale: 0.8, opacity: 0 }, { scale: 1, opacity: 0.6, duration: 0.3 }, 0)
        .fromTo('.registry-eyebrow', { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.12 }, 0.05)
        .fromTo('.registry-quote', { y: 40, opacity: 0 }, { y: 0, opacity: 1, duration: 0.2 }, 0.1)
        .fromTo('.registry-visual', { y: 50, opacity: 0, scale: 0.95 }, { y: 0, opacity: 1, scale: 1, duration: 0.2 }, 0.2)
        .fromTo('.registry-seal', { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.15 }, 0.4);

    } else {
      document.querySelectorAll('.line-inner').forEach(el => el.style.transform = 'translateY(0)');
    }
  </script>
</body>
</html>