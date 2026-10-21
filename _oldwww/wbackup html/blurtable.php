<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

/* ===================================================== */
/* SYSTEM BOOT */
/* ===================================================== */

if (file_exists(__DIR__ . '/kernel/kernel_boot.php')) {
    require_once __DIR__ . '/kernel/kernel_boot.php';
}

if (file_exists(__DIR__ . '/modules/utils/bootstrap.php')) {
    require_once __DIR__ . '/modules/utils/bootstrap.php';
}

/* ===================================================== */
/* ACTIVE MODULE */
/* ===================================================== */

$activeModule = $_GET['module'] ?? 'intelligence_dashboard';

/* ===================================================== */
/* SAFE MODULE LOADER */
/* ===================================================== */

function renderModule(string $module): string
{
    $file = __DIR__ . "/modules/{$module}_module.php";

    if (!file_exists($file)) {
        return "<div class='system-message'>Module not found</div>";
    }

    try {

        ob_start();

        $result = require $file;

        $buffer = trim(ob_get_clean());

        if (!empty($buffer)) {
            return "
            <div class='module-output'>
                {$buffer}
            </div>";
        }

        if (is_array($result)) {

            return "
            <pre class='json-output'>" .
                htmlspecialchars(
                    json_encode(
                        $result,
                        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                    )
                ) .
            "</pre>";
        }

        if (is_string($result)) {

            return "
            <div class='module-output'>
                {$result}
            </div>";
        }

        return "<div class='system-message'>Workspace Active</div>";

    } catch (Throwable $e) {

        return "
        <div class='system-error'>
            " . htmlspecialchars($e->getMessage()) . "
        </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>LEGAiSEE Intelligence Workspace</title>

<style>

/* ===================================================== */
/* RESET */
/* ===================================================== */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

/* ===================================================== */
/* ROOT */
/* ===================================================== */

:root{

    --bg-1:#070706;
    --bg-2:#0B0B0D;
    --bg-3:#181619;
    --bg-4:#181B22;
    --bg-5:#272A31;

    --gold-1:#89612B;
    --gold-2:#A76B09;
    --gold-3:#AC8B56;
    --gold-4:#CDAD69;
    --gold-5:#DDA74F;
    --gold-6:#F4E185;

    --gold-gradient:
        linear-gradient(
            135deg,
            #e6c256,
            #ce9008,
            #e7ca5d,
            #AC8B56,
            #CDAD69,
            #DDA74F
        );
}

/* ===================================================== */
/* BODY */
/* ===================================================== */

body{

    font-family:
        Inter,
        system-ui,
        sans-serif;

    background:
        url('/commandcenter/ui/images/dark-room-with-black-wall-black-wall-with-carved-design_902639-63079-upscale-4x.jpg')
        center center / cover no-repeat fixed;

    color:var(--gold-4);

    min-height:100vh;

    overflow-x:hidden;
}

body::before{

    content:"";

    position:fixed;
    inset:0;

    background:
        radial-gradient(
            circle at top center,
            rgba(244,225,133,0.08),
            rgba(0,0,0,0.85)
        );

    pointer-events:none;
}

/* ===================================================== */
/* SCROLLBAR */
/* ===================================================== */

*::-webkit-scrollbar{
    width:5px;
}

*::-webkit-scrollbar-track{
    background:transparent;
}

*::-webkit-scrollbar-thumb{

    border-radius:20px;

    background:
        linear-gradient(
            180deg,
            #e6c256,
            #ce9008,
            #CDAD69
        );
}

/* ===================================================== */
/* NAVBAR */
/* ===================================================== */

.topbar{

    position:sticky;
    top:0;

    z-index:999;

    height:84px;

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:0 34px;

    background:
        rgba(8,8,10,0.58);

    backdrop-filter:blur(20px);

    border-bottom:
        1px solid rgba(255,255,255,0.04);

    box-shadow:
        0 20px 60px rgba(0,0,0,0.5);
}

/* ===================================================== */
/* LOGO */
/* ===================================================== */

.logo-wrap{

    display:flex;
    align-items:center;
}

.logo-wrap img{

    height:42px;

    object-fit:contain;

    filter:
        drop-shadow(0 0 14px rgba(244,225,133,0.08));
}

/* ===================================================== */
/* NAV */
/* ===================================================== */

.nav{

    display:flex;
    gap:14px;
}

.nav a{

    text-decoration:none;

    color:var(--gold-4);

    font-size:11px;

    letter-spacing:2px;

    text-transform:uppercase;

    padding:11px 16px;

    border-radius:14px;

    background:
        rgba(255,255,255,0.02);

    border:
        1px solid rgba(255,255,255,0.03);

    transition:
        all 0.25s ease;
}

.nav a:hover{

    transform:
        translateY(-2px);

    border-color:
        rgba(255,220,120,0.18);

    color:
        #fff6cd;
}

/* ===================================================== */
/* COMMAND FLOOR */
/* ===================================================== */

.command-floor{

    width:100%;

    max-width:1800px;

    margin:auto;

    padding:42px;
}

/* ===================================================== */
/* EXEC SURFACE */
/* ===================================================== */

.executive-surface{

    position:relative;

    padding:42px;

    border-radius:34px;

    overflow:hidden;

    background:
        linear-gradient(
            180deg,
            rgba(22,22,26,0.76),
            rgba(10,10,12,0.94)
        );

    backdrop-filter:blur(18px);

    border:
        1px solid rgba(255,255,255,0.04);

    box-shadow:
        0 40px 120px rgba(0,0,0,0.72),
        inset 0 1px 0 rgba(255,255,255,0.04);
}

/* ===================================================== */
/* HEADER */
/* ===================================================== */

.workspace-header{

    margin-bottom:42px;
}

.workspace-label{

    color:var(--gold-2);

    font-size:11px;

    letter-spacing:4px;

    text-transform:uppercase;
}

.workspace-title{

    margin-top:16px;

    font-size:40px;

    font-weight:300;

    color:var(--gold-6);
}

.workspace-sub{

    margin-top:18px;

    max-width:860px;

    line-height:1.9;

    font-size:14px;

    color:var(--gold-3);
}

/* ===================================================== */
/* SNAPSHOT STRIP */
/* ===================================================== */

.snapshot-strip{

    display:grid;

    grid-template-columns:
        repeat(4,minmax(0,1fr));

    gap:22px;

    margin-bottom:44px;
}

/* ===================================================== */
/* SNAPSHOT */
/* ===================================================== */

.snapshot{

    position:relative;

    padding:26px;

    border-radius:22px;

    overflow:hidden;

    background:
        linear-gradient(
            180deg,
            rgba(255,255,255,0.03),
            rgba(255,255,255,0.01)
        );

    border:
        1px solid rgba(255,255,255,0.04);

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,0.03);
}

.snapshot-label{

    color:var(--gold-2);

    font-size:10px;

    letter-spacing:3px;

    text-transform:uppercase;
}

.snapshot-value{

    margin-top:16px;

    font-size:34px;

    font-weight:200;

    color:var(--gold-6);
}

.snapshot-sub{

    margin-top:10px;

    font-size:13px;

    line-height:1.7;

    color:var(--gold-3);
}

/* ===================================================== */
/* MAIN GRID */
/* ===================================================== */

.intelligence-grid{

    display:grid;

    grid-template-columns:
        minmax(0,2fr)
        minmax(340px,0.9fr);

    gap:28px;
}

/* ===================================================== */
/* PANELS */
/* ===================================================== */

.panel{

    position:relative;

    border-radius:28px;

    overflow:hidden;

    background:
        linear-gradient(
            180deg,
            rgba(18,18,22,0.95),
            rgba(10,10,12,0.98)
        );

    border:
        1px solid rgba(255,255,255,0.04);

    padding:28px;

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,0.04);
}

/* ===================================================== */
/* PANEL HEADER */
/* ===================================================== */

.panel-header{

    display:flex;
    align-items:center;
    justify-content:space-between;

    margin-bottom:26px;
}

.panel-title{

    font-size:22px;

    font-weight:300;

    color:var(--gold-6);
}

.panel-label{

    color:var(--gold-2);

    font-size:10px;

    letter-spacing:3px;

    text-transform:uppercase;
}

/* ===================================================== */
/* TIMELINE */
/* ===================================================== */

.timeline{

    display:flex;
    flex-direction:column;
    gap:18px;
}

.timeline-item{

    display:flex;
    gap:18px;

    padding:18px;

    border-radius:18px;

    background:
        rgba(255,255,255,0.02);

    border:
        1px solid rgba(255,255,255,0.03);
}

.timeline-dot{

    width:10px;
    height:10px;

    border-radius:50%;

    margin-top:7px;

    background:
        linear-gradient(
            180deg,
            #e6c256,
            #ce9008
        );

    flex-shrink:0;
}

.timeline-content{

    min-width:0;
}

.timeline-title{

    color:var(--gold-6);

    font-size:15px;

    margin-bottom:8px;
}

.timeline-meta{

    color:var(--gold-3);

    font-size:13px;

    line-height:1.8;
}

/* ===================================================== */
/* RECOMMENDATIONS */
/* ===================================================== */

.recommendation-stack{

    display:flex;
    flex-direction:column;
    gap:18px;
}

.recommendation{

    padding:20px;

    border-radius:18px;

    background:
        rgba(255,255,255,0.02);

    border:
        1px solid rgba(255,255,255,0.03);
}

.recommendation-title{

    color:var(--gold-6);

    font-size:15px;

    margin-bottom:10px;
}

.recommendation-text{

    color:var(--gold-3);

    line-height:1.8;

    font-size:13px;
}

/* ===================================================== */
/* LIVE VIEWPORT */
/* ===================================================== */

.live-viewport{

    margin-top:28px;

    border-radius:22px;

    overflow:hidden;

    background:
        rgba(255,255,255,0.015);

    border:
        1px solid rgba(255,255,255,0.03);

    min-height:340px;

    padding:24px;
}

/* ===================================================== */
/* OUTPUT */
/* ===================================================== */

.module-output,
.json-output{

    overflow:auto;

    line-height:1.8;

    word-break:break-word;

    overflow-wrap:anywhere;

    color:var(--gold-4);
}

.json-output{

    white-space:pre-wrap;

    font-size:13px;

    font-family:
        ui-monospace,
        monospace;
}

/* ===================================================== */
/* STATES */
/* ===================================================== */

.system-message{
    color:var(--gold-3);
}

.system-error{
    color:#ff7d7d;
}

/* ===================================================== */
/* MOBILE */
/* ===================================================== */

@media(max-width:1100px){

    .snapshot-strip{
        grid-template-columns:1fr;
    }

    .intelligence-grid{
        grid-template-columns:1fr;
    }

    .nav{
        display:none;
    }

    .command-floor{
        padding:18px;
    }

    .executive-surface{
        padding:24px;
    }
}

</style>
</head>

<body>

<!-- ===================================================== -->
<!-- NAV -->
<!-- ===================================================== -->

<div class="topbar">

    <div class="logo-wrap">
        <img
            src="https://www.legaisee.com/Images/Legaisee-sm-300.png"
            alt="LEGAiSEE"
        >
    </div>

    <div class="nav">

        <a href="?module=intelligence_dashboard">Lobby</a>
        <a href="?module=ingest">Ingest</a>
        <a href="?module=search">Search</a>
        <a href="?module=graph">Graph</a>
        <a href="?module=vault">Vault</a>
        <a href="?module=clients">Clients</a>

    </div>

</div>

<!-- ===================================================== -->
<!-- COMMAND FLOOR -->
<!-- ===================================================== -->

<div class="command-floor">

    <div class="executive-surface">

        <!-- ============================================= -->
        <!-- HEADER -->
        <!-- ============================================= -->

        <div class="workspace-header">

            <div class="workspace-label">
                Executive Intelligence Workspace
            </div>

            <div class="workspace-title">
                Intelligence Workspace V1
            </div>

            <div class="workspace-sub">

                Executive intelligence monitoring for authority extraction,
                dormant signal recovery, archaeological analysis,
                strategic memory preservation, and operational positioning.

            </div>

        </div>

        <!-- ============================================= -->
        <!-- SNAPSHOT -->
        <!-- ============================================= -->

        <div class="snapshot-strip">

            <div class="snapshot">

                <div class="snapshot-label">
                    Active Signals
                </div>

                <div class="snapshot-value">
                    12
                </div>

                <div class="snapshot-sub">
                    Emerging authority indicators detected
                </div>

            </div>

            <div class="snapshot">

                <div class="snapshot-label">
                    Excavations
                </div>

                <div class="snapshot-value">
                    4
                </div>

                <div class="snapshot-sub">
                    Active business archaeology investigations
                </div>

            </div>

            <div class="snapshot">

                <div class="snapshot-label">
                    Artifacts
                </div>

                <div class="snapshot-value">
                    148
                </div>

                <div class="snapshot-sub">
                    Historical marketing assets preserved
                </div>

            </div>

            <div class="snapshot">

                <div class="snapshot-label">
                    Recommendations
                </div>

                <div class="snapshot-value">
                    9
                </div>

                <div class="snapshot-sub">
                    Strategic authority opportunities identified
                </div>

            </div>

        </div>

        <!-- ============================================= -->
        <!-- GRID -->
        <!-- ============================================= -->

        <div class="intelligence-grid">

            <!-- ========================================= -->
            <!-- LEFT -->
            <!-- ========================================= -->

            <div>

                <!-- TIMELINE -->

                <div class="panel">

                    <div class="panel-header">

                        <div>

                            <div class="panel-label">
                                Live Activity
                            </div>

                            <div class="panel-title">
                                Intelligence Timeline
                            </div>

                        </div>

                    </div>

                    <div class="timeline">

                        <div class="timeline-item">

                            <div class="timeline-dot"></div>

                            <div class="timeline-content">

                                <div class="timeline-title">
                                    Dormant Authority Sequence Identified
                                </div>

                                <div class="timeline-meta">
                                    Historical construction marketing campaign
                                    recovered from 2014 archive cluster.
                                </div>

                            </div>

                        </div>

                        <div class="timeline-item">

                            <div class="timeline-dot"></div>

                            <div class="timeline-content">

                                <div class="timeline-title">
                                    Relationship Graph Mutation
                                </div>

                                <div class="timeline-meta">
                                    Executive node connections expanded
                                    across client portfolio lineage.
                                </div>

                            </div>

                        </div>

                        <div class="timeline-item">

                            <div class="timeline-dot"></div>

                            <div class="timeline-content">

                                <div class="timeline-title">
                                    Excavation Pipeline Expanded
                                </div>

                                <div class="timeline-meta">
                                    Additional artifact ingestion paths
                                    initialized from archive memory vault.
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- LIVE VIEWPORT -->

                <div class="live-viewport">

                    <div class="panel-label">
                        Active Intelligence Viewport
                    </div>

                    <div style="height:18px;"></div>

                    <?= renderModule($activeModule); ?>

                </div>

            </div>

            <!-- ========================================= -->
            <!-- RIGHT -->
            <!-- ========================================= -->

            <div>

                <div class="panel">

                    <div class="panel-header">

                        <div>

                            <div class="panel-label">
                                Strategic Intelligence
                            </div>

                            <div class="panel-title">
                                Recommendation Rail
                            </div>

                        </div>

                    </div>

                    <div class="recommendation-stack">

                        <div class="recommendation">

                            <div class="recommendation-title">
                                Recover Dormant Brand Authority
                            </div>

                            <div class="recommendation-text">
                                Historical educational content cluster
                                indicates high-value authority positioning
                                opportunity for executive republishing.
                            </div>

                        </div>

                        <div class="recommendation">

                            <div class="recommendation-title">
                                Cross-Case Relationship Expansion
                            </div>

                            <div class="recommendation-text">
                                Similar authority structures detected
                                across multiple business archaeology cases.
                            </div>

                        </div>

                        <div class="recommendation">

                            <div class="recommendation-title">
                                Graph Signal Escalation
                            </div>

                            <div class="recommendation-text">
                                Executive relationship density increased
                                within strategic influence clusters.
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>