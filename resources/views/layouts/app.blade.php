<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'PearlClinic') – PearlClinic OS</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:opsz,wght@9..40,300;400;500;600&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@stack('head_scripts')
<style>
/* ══ VARIABLES ══════════════════════════════════════════════ */
:root{
  --pearl-50:#fafbfc;--pearl-100:#f4f6f8;--pearl-200:#eaecf0;
  --pearl-300:#d8dde5;--pearl-400:#b0bac8;--pearl-500:#8493a8;
  --pearl-600:#5d6e85;--pearl-700:#3e4f63;--pearl-800:#2a3547;--pearl-900:#19222e;
  --plat-shine:#e8edf4;--accent-silver:#a8bbd0;--accent-ice:#c8d8e8;
  --sidebar-w:272px;--radius-card:22px;--radius-lg:16px;--radius-md:10px;
  --shadow-pearl:0 2px 24px rgba(120,140,165,.10),0 1px 4px rgba(120,140,165,.06);
  --shadow-lift:0 12px 48px rgba(80,105,135,.14),0 2px 8px rgba(80,105,135,.08);
  --shadow-deep:0 24px 80px rgba(60,85,115,.18);
  --transition:cubic-bezier(.4,0,.2,1);
  --font-display:'Cormorant Garamond',serif;
  --font-body:'DM Sans',sans-serif;
  --font-mono:'DM Mono',monospace;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:var(--font-body);background:var(--pearl-100);color:var(--pearl-800);min-height:100vh;overflow-x:hidden}

/* ══ SPLASH ══════════════════════════════════════════════════ */
#splashScreen{position:fixed;inset:0;z-index:99999;background:linear-gradient(160deg,#f8f9fb 0%,#edf1f7 40%,#e4ecf5 100%);display:flex;align-items:center;justify-content:center;transition:opacity 1.2s var(--transition),transform 1.2s var(--transition);overflow:hidden}
#splashScreen.fade-out{opacity:0;transform:scale(1.04);pointer-events:none}
.splash-bg-rings{position:absolute;inset:0;overflow:hidden}
.splash-ring{position:absolute;border-radius:50%;border:1px solid rgba(168,187,208,.25);animation:ringExpand 4s ease-out infinite}
.splash-ring:nth-child(1){width:300px;height:300px;left:50%;top:50%;transform:translate(-50%,-50%);animation-delay:0s}
.splash-ring:nth-child(2){width:500px;height:500px;left:50%;top:50%;transform:translate(-50%,-50%);animation-delay:.6s}
.splash-ring:nth-child(3){width:720px;height:720px;left:50%;top:50%;transform:translate(-50%,-50%);animation-delay:1.2s}
.splash-ring:nth-child(4){width:960px;height:960px;left:50%;top:50%;transform:translate(-50%,-50%);animation-delay:1.8s}
@keyframes ringExpand{0%{opacity:.7;transform:translate(-50%,-50%) scale(.8)}100%{opacity:0;transform:translate(-50%,-50%) scale(1.3)}}
.splash-particle{position:absolute;width:3px;height:3px;border-radius:50%;background:var(--accent-silver);opacity:0;animation:particleDrift 5s ease-in-out infinite}
@keyframes particleDrift{0%{opacity:0;transform:translateY(0) scale(0)}20%{opacity:.6;transform:translateY(-20px) scale(1)}80%{opacity:.3;transform:translateY(-80px) scale(.8)}100%{opacity:0;transform:translateY(-120px) scale(0)}}
.splash-center{position:relative;text-align:center;z-index:1;animation:splashReveal 1.4s var(--transition) forwards;opacity:0}
@keyframes splashReveal{0%{opacity:0;transform:translateY(24px)}100%{opacity:1;transform:translateY(0)}}
.splash-emblem{width:88px;height:88px;margin:0 auto 2rem;position:relative}
.splash-emblem-ring{position:absolute;inset:0;border-radius:50%;border:1.5px solid var(--accent-silver);animation:emblemSpin 8s linear infinite}
.splash-emblem-ring:nth-child(2){inset:8px;border-color:var(--accent-ice);animation-direction:reverse;animation-duration:6s}
@keyframes emblemSpin{to{transform:rotate(360deg)}}
.splash-emblem-inner{position:absolute;inset:16px;background:linear-gradient(145deg,#fff,var(--plat-shine));border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 20px rgba(120,148,180,.2)}
.splash-emblem-inner i{font-size:22px;color:var(--pearl-600)}
.splash-title{font-family:var(--font-display);font-size:3.8rem;font-weight:300;letter-spacing:.12em;color:var(--pearl-800);line-height:1}
.splash-title span{font-weight:600}
.splash-sub{font-size:.72rem;letter-spacing:.35em;color:var(--pearl-500);margin-top:.5rem;text-transform:uppercase}
.splash-divider{width:48px;height:1px;background:var(--accent-silver);margin:1.8rem auto}
.splash-greeting{font-size:1.1rem;color:var(--pearl-600);font-weight:300}
.splash-greeting strong{font-weight:500;color:var(--pearl-700)}
.splash-loader{margin-top:2.5rem;display:flex;align-items:center;justify-content:center;gap:6px}
.splash-dot{width:6px;height:6px;border-radius:50%;background:var(--accent-silver);animation:dotPulse 1.4s ease-in-out infinite}
.splash-dot:nth-child(2){animation-delay:.2s}.splash-dot:nth-child(3){animation-delay:.4s}
@keyframes dotPulse{0%,80%,100%{transform:scale(.6);opacity:.4}40%{transform:scale(1);opacity:1}}

/* ══ SHELL ═══════════════════════════════════════════════════ */
#appShell{display:flex;min-height:100vh;opacity:0;animation:appReveal .8s var(--transition) forwards}
@keyframes appReveal{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}

/* ══ SIDEBAR ═════════════════════════════════════════════════ */
#sidebar{width:var(--sidebar-w);min-height:100vh;background:#fff;border-right:1px solid var(--pearl-200);display:flex;flex-direction:column;position:sticky;top:0;height:100vh;overflow-y:auto;flex-shrink:0;box-shadow:2px 0 20px rgba(100,120,150,.06)}
.sidebar-brand{padding:2rem 1.5rem 1.5rem;border-bottom:1px solid var(--pearl-200)}
.brand-mark{display:flex;align-items:center;gap:.75rem}
.brand-icon{width:40px;height:40px;border-radius:12px;background:linear-gradient(145deg,var(--pearl-100),var(--plat-shine));border:1px solid var(--pearl-300);display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(100,120,150,.12)}
.brand-icon i{font-size:18px;color:var(--pearl-600)}
.brand-text h1{font-family:var(--font-display);font-size:1.35rem;font-weight:600;color:var(--pearl-800);letter-spacing:.01em;line-height:1.1}
.brand-text p{font-size:.65rem;color:var(--pearl-400);letter-spacing:.15em;text-transform:uppercase;margin-top:1px}
.sidebar-section-label{padding:1.4rem 1.5rem .5rem;font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;color:var(--pearl-400);font-weight:500}
.nav-item{display:flex;align-items:center;gap:.75rem;padding:.7rem 1.2rem;margin:.15rem .7rem;border-radius:var(--radius-md);color:var(--pearl-600);font-size:.875rem;font-weight:400;cursor:pointer;transition:all .2s var(--transition);position:relative;user-select:none;text-decoration:none}
.nav-item i{width:20px;font-size:1rem;text-align:center;flex-shrink:0}
.nav-item .nav-badge{margin-left:auto;background:var(--pearl-100);border:1px solid var(--pearl-200);color:var(--pearl-500);font-size:.65rem;padding:1px 7px;border-radius:20px;font-variant-numeric:tabular-nums}
.nav-item:hover{background:var(--pearl-50);color:var(--pearl-800)}
.nav-item.active{background:linear-gradient(135deg,var(--pearl-100),var(--plat-shine));color:var(--pearl-800);font-weight:500;border:1px solid var(--pearl-200);box-shadow:0 1px 6px rgba(100,120,150,.08)}
.nav-item.active::before{content:'';position:absolute;left:0;top:20%;bottom:20%;width:3px;border-radius:0 3px 3px 0;background:linear-gradient(to bottom,var(--pearl-600),var(--pearl-400));margin-left:-.7rem}
.sidebar-spacer{flex:1}
.sidebar-footer{padding:1rem .7rem;border-top:1px solid var(--pearl-200)}
.user-chip{display:flex;align-items:center;gap:.65rem;padding:.65rem .9rem;background:var(--pearl-50);border:1px solid var(--pearl-200);border-radius:var(--radius-md)}
.user-avatar{width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--pearl-300),var(--pearl-400));display:flex;align-items:center;justify-content:center;font-size:.75rem;color:var(--pearl-800);font-weight:500;flex-shrink:0}
.user-info{flex:1;min-width:0}
.user-info .name{font-size:.82rem;font-weight:500;color:var(--pearl-800);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.user-info .role{font-size:.67rem;color:var(--pearl-400)}
.logout-btn{width:100%;margin-top:.5rem;display:flex;align-items:center;gap:.6rem;padding:.55rem .9rem;background:transparent;border:none;border-radius:var(--radius-md);color:var(--pearl-500);font-size:.82rem;cursor:pointer;font-family:var(--font-body);transition:all .18s;text-align:left}
.logout-btn:hover{background:#fff4f4;color:#b91c1c}

/* ══ MAIN PANEL ══════════════════════════════════════════════ */
#mainPanel{flex:1;min-width:0;display:flex;flex-direction:column;background:var(--pearl-100)}
.topbar{background:rgba(255,255,255,.9);backdrop-filter:blur(16px);border-bottom:1px solid var(--pearl-200);padding:1rem 2rem;display:flex;align-items:center;gap:1.5rem;position:sticky;top:0;z-index:100}
.topbar-title{flex:1}
.topbar-title h2{font-family:var(--font-display);font-size:1.55rem;font-weight:600;color:var(--pearl-800);line-height:1.1}
.topbar-title p{font-size:.75rem;color:var(--pearl-400);margin-top:2px;letter-spacing:.04em}
.topbar-search{display:flex;align-items:center;gap:.6rem;background:var(--pearl-50);border:1px solid var(--pearl-200);border-radius:50px;padding:.5rem 1rem;width:280px;transition:all .2s}
.topbar-search:focus-within{border-color:var(--pearl-400);background:#fff;box-shadow:0 0 0 3px rgba(168,187,208,.15);width:340px}
.topbar-search i{color:var(--pearl-400);font-size:.9rem;flex-shrink:0}
.topbar-search input{border:none;background:transparent;outline:none;font-family:var(--font-body);font-size:.85rem;color:var(--pearl-800);width:100%}
.topbar-search input::placeholder{color:var(--pearl-400)}
.topbar-actions{display:flex;align-items:center;gap:.5rem}
.icon-btn{width:36px;height:36px;border-radius:50%;background:var(--pearl-50);border:1px solid var(--pearl-200);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--pearl-500);font-size:.9rem;transition:all .18s}
.icon-btn:hover{background:#fff;border-color:var(--pearl-300);color:var(--pearl-700);box-shadow:var(--shadow-pearl)}
.notif-dot{position:relative}
.notif-dot::after{content:'';position:absolute;top:6px;right:6px;width:7px;height:7px;background:#e74c3c;border-radius:50%;border:1.5px solid var(--pearl-50)}
#contentArea{flex:1;padding:2rem;overflow-y:auto}

/* ══ PAGE HEADER (módulos) ═══════════════════════════════════ */
.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem}
.page-header h2{font-family:var(--font-display);font-size:1.8rem;font-weight:600;color:var(--pearl-800)}
.page-header p{font-size:.78rem;color:var(--pearl-400);margin-top:2px}

/* ══ BOTONES ════════════════════════════════════════════════ */
.btn-primary{display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1.4rem;background:var(--pearl-800);color:#fff;border:none;border-radius:50px;font-size:.85rem;font-weight:500;cursor:pointer;font-family:var(--font-body);transition:all .2s;box-shadow:0 2px 12px rgba(50,70,100,.2);text-decoration:none}
.btn-primary:hover{background:var(--pearl-900);transform:translateY(-1px);box-shadow:0 4px 20px rgba(50,70,100,.28);color:#fff}
.btn-secondary{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.2rem;background:var(--pearl-100);color:var(--pearl-700);border:1px solid var(--pearl-200);border-radius:50px;font-size:.85rem;font-weight:500;cursor:pointer;font-family:var(--font-body);transition:all .2s;text-decoration:none}
.btn-secondary:hover{background:var(--pearl-200);color:var(--pearl-800)}
.btn-danger{display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.2rem;background:#fff1f2;color:#e11d48;border:1px solid #fecdd3;border-radius:50px;font-size:.85rem;font-weight:500;cursor:pointer;font-family:var(--font-body);transition:all .2s;text-decoration:none}
.btn-danger:hover{background:#ffe4e6;border-color:#fda4af}

/* ══ TABLAS ═════════════════════════════════════════════════ */
.table-wrap{background:#fff;border:1px solid var(--pearl-200);border-radius:var(--radius-card);overflow:hidden;box-shadow:var(--shadow-pearl)}
.table-toolbar{display:flex;align-items:center;gap:1rem;padding:1rem 1.5rem;border-bottom:1px solid var(--pearl-100)}
.t-search{display:flex;align-items:center;gap:.5rem;background:var(--pearl-50);border:1px solid var(--pearl-200);border-radius:50px;padding:.4rem .9rem;flex:1;max-width:360px}
.t-search input{border:none;background:transparent;outline:none;font-size:.83rem;font-family:var(--font-body);color:var(--pearl-800);width:100%}
.t-search i{color:var(--pearl-400);font-size:.85rem}
.t-count{font-size:.78rem;color:var(--pearl-400);font-variant-numeric:tabular-nums;margin-left:auto}
.data-table{width:100%;border-collapse:collapse}
.data-table thead th{background:var(--pearl-50);padding:.85rem 1.2rem;text-align:left;font-size:.72rem;font-weight:500;letter-spacing:.08em;text-transform:uppercase;color:var(--pearl-500);border-bottom:1px solid var(--pearl-100);white-space:nowrap}
.data-table tbody tr{border-bottom:1px solid var(--pearl-50);transition:background .15s}
.data-table tbody tr:last-child{border-bottom:none}
.data-table tbody tr:hover{background:var(--pearl-50)}
.data-table tbody td{padding:.9rem 1.2rem;font-size:.84rem;color:var(--pearl-700)}
.data-table tbody td.mono{font-family:var(--font-mono);font-size:.75rem;color:var(--pearl-400)}
.tbl-actions{display:flex;align-items:center;gap:.4rem}
.act-btn{width:30px;height:30px;border-radius:8px;border:1px solid var(--pearl-200);background:transparent;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.8rem;color:var(--pearl-500);transition:all .15s;text-decoration:none}
.act-btn:hover{background:var(--pearl-100);color:var(--pearl-800)}
.act-btn.del:hover{background:#fff1f2;color:#e11d48;border-color:#fecdd3}
.tbl-empty{text-align:center;padding:3rem;color:var(--pearl-400);font-size:.88rem}
.tbl-empty i{font-size:2.5rem;color:var(--pearl-300);display:block;margin-bottom:1rem}

/* ══ FORMULARIOS ════════════════════════════════════════════ */
.form-card{background:#fff;border:1px solid var(--pearl-200);border-radius:var(--radius-card);overflow:hidden;box-shadow:var(--shadow-pearl);max-width:680px}
.form-header{padding:1.5rem 2rem 1rem;border-bottom:1px solid var(--pearl-100)}
.form-header h3{font-family:var(--font-display);font-size:1.5rem;font-weight:600;color:var(--pearl-800)}
.form-header p{font-size:.8rem;color:var(--pearl-400);margin-top:.25rem}
.form-body{padding:1.5rem 2rem}
.form-footer{padding:1rem 2rem 1.5rem;display:flex;justify-content:flex-end;gap:.75rem;border-top:1px solid var(--pearl-100)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:.75rem}
.form-group{display:flex;flex-direction:column;gap:.35rem;margin-bottom:.75rem}
.form-label{font-size:.78rem;font-weight:500;color:var(--pearl-600);letter-spacing:.02em}
.form-label .req{color:#e11d48}
.form-input,.form-select,.form-textarea{padding:.6rem .9rem;border:1px solid var(--pearl-200);border-radius:var(--radius-md);font-family:var(--font-body);font-size:.85rem;color:var(--pearl-800);background:#fff;transition:all .18s;outline:none;width:100%}
.form-input:focus,.form-select:focus,.form-textarea:focus{border-color:var(--pearl-400);box-shadow:0 0 0 3px rgba(168,187,208,.15)}
.form-input.is-invalid,.form-select.is-invalid{border-color:#e11d48}
.form-textarea{min-height:80px;resize:vertical}
.invalid-feedback{color:#e11d48;font-size:.75rem;margin-top:.2rem}

/* ══ DETALLE (SHOW) ══════════════════════════════════════════ */
.card{background:#fff;border:1px solid var(--pearl-200);border-radius:var(--radius-card);padding:1.5rem;transition:box-shadow .3s;margin-bottom:1.5rem}
.card:hover{box-shadow:var(--shadow-pearl)}
.card-title{font-family:var(--font-display);font-size:1.1rem;font-weight:600;color:var(--pearl-800);margin-bottom:1rem;display:flex;align-items:center;gap:.5rem}
.card-title i{color:var(--pearl-400);font-size:1rem}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem}
.appt-list{display:flex;flex-direction:column;gap:.65rem}
.appt-item{display:flex;align-items:center;gap:.9rem;padding:.75rem 1rem;background:var(--pearl-50);border:1px solid var(--pearl-100);border-radius:var(--radius-md);transition:all .2s}
.appt-item:hover{background:var(--pearl-100);border-color:var(--pearl-200)}
.appt-info{flex:1;min-width:0}
.appt-name{font-size:.85rem;font-weight:500;color:var(--pearl-800)}
.appt-meta{font-size:.73rem;color:var(--pearl-500)}

/* ══ BADGES ═════════════════════════════════════════════════ */
.badge{display:inline-flex;align-items:center;font-size:.7rem;font-weight:500;padding:3px 10px;border-radius:20px}
.badge-active{background:#f0fdf8;color:#059669}
.badge-pending{background:#fffbeb;color:#d97706}
.badge-done{background:#f5f3ff;color:#7c3aed}
.badge-cancel{background:#fff1f2;color:#e11d48}

/* ══ WELCOME BANNER ════════════════════════════════════════ */
.welcome-banner{background:linear-gradient(135deg,var(--pearl-800) 0%,var(--pearl-700) 50%,var(--pearl-600) 100%);border-radius:var(--radius-card);padding:2rem 2.5rem;margin-bottom:2rem;position:relative;overflow:hidden;animation:statReveal .5s var(--transition) both}
.welcome-banner::before{content:'';position:absolute;width:400px;height:400px;border-radius:50%;background:rgba(255,255,255,.04);top:-120px;right:-80px}
.welcome-banner::after{content:'';position:absolute;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,.03);bottom:-60px;right:200px}
.welcome-banner h2{font-family:var(--font-display);font-size:2rem;font-weight:300;color:#fff;line-height:1.2;position:relative;z-index:1}
.welcome-banner h2 span{font-weight:600}
.welcome-banner p{color:rgba(255,255,255,.6);margin-top:.5rem;font-size:.85rem;position:relative;z-index:1}
.welcome-banner .banner-stats{display:flex;gap:2rem;margin-top:1.5rem;position:relative;z-index:1}
.banner-stat .n{font-family:var(--font-display);font-size:1.8rem;font-weight:600;color:#fff}
.banner-stat .l{font-size:.72rem;color:rgba(255,255,255,.5);letter-spacing:.06em}

/* ══ STAT CARDS ════════════════════════════════════════════ */
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:1.2rem;margin-bottom:2rem}
.stat-card{background:#fff;border:1px solid var(--pearl-200);border-radius:var(--radius-card);padding:1.4rem 1.5rem;position:relative;overflow:hidden;transition:all .3s var(--transition);animation:statReveal .6s var(--transition) both}
@keyframes statReveal{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
.stat-card:nth-child(1){animation-delay:.05s}.stat-card:nth-child(2){animation-delay:.10s}
.stat-card:nth-child(3){animation-delay:.15s}.stat-card:nth-child(4){animation-delay:.20s}
.stat-card:nth-child(5){animation-delay:.25s}.stat-card:nth-child(6){animation-delay:.30s}
.stat-card:hover{box-shadow:var(--shadow-lift);transform:translateY(-2px)}
.stat-card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem}
.stat-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1rem}
.stat-icon.blue{background:#eff6ff;color:#2563eb}.stat-icon.teal{background:#f0fdf8;color:#0d9488}
.stat-icon.purple{background:#f5f3ff;color:#7c3aed}.stat-icon.rose{background:#fff1f2;color:#e11d48}
.stat-icon.amber{background:#fffbeb;color:#d97706}.stat-icon.sky{background:#f0f9ff;color:#0284c7}
.stat-trend{font-size:.72rem;font-weight:500;padding:3px 8px;border-radius:20px}
.stat-trend.up{background:#f0fdf8;color:#059669}.stat-trend.down{background:#fff1f2;color:#e11d48}
.stat-trend.neutral{background:var(--pearl-100);color:var(--pearl-500)}
.stat-num{font-family:var(--font-display);font-size:2.4rem;font-weight:600;color:var(--pearl-800);line-height:1;letter-spacing:-.02em;margin-bottom:.25rem}
.stat-label{font-size:.78rem;color:var(--pearl-500);font-weight:400}
.grid-charts{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:2rem}
.grid-bottom{display:grid;grid-template-columns:2fr 1fr;gap:1.5rem}
.chart-wrap{height:220px;position:relative}
.quick-stat-row{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-bottom:.75rem}
.quick-stat{background:var(--pearl-50);border:1px solid var(--pearl-100);border-radius:var(--radius-md);padding:.9rem;text-align:center}
.quick-stat .num{font-family:var(--font-display);font-size:1.8rem;font-weight:600;color:var(--pearl-800)}
.quick-stat .lbl{font-size:.72rem;color:var(--pearl-400);margin-top:.15rem}

/* ══ TOAST ══════════════════════════════════════════════════ */
#toastContainer{position:fixed;bottom:2rem;right:2rem;z-index:99998;display:flex;flex-direction:column;gap:.6rem}
.toast{display:flex;align-items:center;gap:.6rem;padding:.75rem 1.2rem;border-radius:50px;font-size:.84rem;font-weight:500;box-shadow:var(--shadow-lift);animation:toastIn .3s var(--transition);white-space:nowrap}
.toast.success{background:var(--pearl-800);color:#fff}
.toast.error{background:#fff;color:#e11d48;border:1px solid #fecdd3}
@keyframes toastIn{from{opacity:0;transform:translateY(12px) scale(.96)}to{opacity:1;transform:translateY(0) scale(1)}}
@keyframes toastOut{from{opacity:1}to{opacity:0;transform:translateY(12px) scale(.96)}}

/* ══ SCROLLBAR ══════════════════════════════════════════════ */
::-webkit-scrollbar{width:5px}::-webkit-scrollbar-track{background:transparent}
::-webkit-scrollbar-thumb{background:var(--pearl-300);border-radius:5px}
::-webkit-scrollbar-thumb:hover{background:var(--pearl-400)}

/* ══ PAGINACIÓN LARAVEL ═════════════════════════════════════ */
.pagination{display:flex;gap:.4rem;list-style:none;flex-wrap:wrap}
.pagination .page-item .page-link{display:flex;align-items:center;justify-content:center;min-width:32px;height:32px;padding:0 .6rem;border-radius:8px;border:1px solid var(--pearl-200);background:#fff;color:var(--pearl-600);font-size:.82rem;text-decoration:none;transition:all .15s}
.pagination .page-item.active .page-link{background:var(--pearl-800);color:#fff;border-color:var(--pearl-800)}
.pagination .page-item.disabled .page-link{opacity:.4;pointer-events:none}
.pagination .page-item .page-link:hover:not(.disabled){background:var(--pearl-100);border-color:var(--pearl-300)}

/* ══ RESPONSIVE ═════════════════════════════════════════════ */
@media(max-width:900px){
  :root{--sidebar-w:60px}
  .nav-item span,.brand-text,.user-info,.sidebar-section-label,.nav-badge{display:none}
  .nav-item{justify-content:center}
  .nav-item.active::before{display:none}
  .brand-mark{justify-content:center}
  .grid-2,.grid-charts,.grid-bottom{grid-template-columns:1fr}
  .form-row{grid-template-columns:1fr}
}
@media(max-width:600px){
  #contentArea{padding:1rem}.topbar{padding:.75rem 1rem}
  .stats-grid{grid-template-columns:1fr 1fr}
}
</style>
</head>
<body>

{{-- ── SPLASH ───────────────────────────────────────────────── --}}
<div id="splashScreen">
  <div class="splash-bg-rings">
    <div class="splash-ring"></div><div class="splash-ring"></div>
    <div class="splash-ring"></div><div class="splash-ring"></div>
  </div>
  <div class="splash-center">
    <div class="splash-emblem">
      <div class="splash-emblem-ring"></div>
      <div class="splash-emblem-ring"></div>
      <div class="splash-emblem-inner"><i class="fas fa-heartbeat"></i></div>
    </div>
    <div class="splash-title">PEARL<span>OS</span></div>
    <div class="splash-sub">Clinical Management System</div>
    <div class="splash-divider"></div>
    <div class="splash-greeting">Bienvenido, <strong id="splashName">Dr.</strong></div>
    <div class="splash-loader">
      <div class="splash-dot"></div><div class="splash-dot"></div><div class="splash-dot"></div>
    </div>
  </div>
</div>

{{-- ── APP SHELL ────────────────────────────────────────────── --}}
<div id="appShell" style="display:none;">

  {{-- SIDEBAR --}}
  <nav id="sidebar">
    <div class="sidebar-brand">
      <div class="brand-mark">
        <div class="brand-icon"><i class="fas fa-heartbeat"></i></div>
        <div class="brand-text"><h1>PearlClinic</h1><p>Medical OS · v2.0</p></div>
      </div>
    </div>

    <div class="sidebar-section-label">General</div>
    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <i class="fas fa-chart-pie"></i><span>Panel Principal</span>
    </a>

    <div class="sidebar-section-label">Gestión Clínica</div>
    <a href="{{ route('pacientes.index') }}" class="nav-item {{ request()->routeIs('pacientes.*') ? 'active' : '' }}">
      <i class="fas fa-users"></i><span>Pacientes</span>
      <span class="nav-badge">{{ \App\Models\Paciente::count() }}</span>
    </a>
    <a href="{{ route('medicos.index') }}" class="nav-item {{ request()->routeIs('medicos.*') ? 'active' : '' }}">
      <i class="fas fa-user-md"></i><span>Médicos</span>
      <span class="nav-badge">{{ \App\Models\Medico::count() }}</span>
    </a>
    <a href="{{ route('citas.index') }}" class="nav-item {{ request()->routeIs('citas.*') ? 'active' : '' }}">
      <i class="fas fa-calendar-check"></i><span>Citas</span>
      <span class="nav-badge">{{ \App\Models\Cita::count() }}</span>
    </a>

    <div class="sidebar-section-label">Clínica</div>
    <a href="{{ route('diagnosticos.index') }}" class="nav-item {{ request()->routeIs('diagnosticos.*') ? 'active' : '' }}">
      <i class="fas fa-stethoscope"></i><span>Diagnósticos</span>
    </a>
    <a href="{{ route('tratamientos.index') }}" class="nav-item {{ request()->routeIs('tratamientos.*') ? 'active' : '' }}">
      <i class="fas fa-notes-medical"></i><span>Tratamientos</span>
    </a>
    <a href="{{ route('medicamentos.index') }}" class="nav-item {{ request()->routeIs('medicamentos.*') ? 'active' : '' }}">
      <i class="fas fa-capsules"></i><span>Medicamentos</span>
    </a>

    <div class="sidebar-spacer"></div>
    <div class="sidebar-footer">
      <div class="user-chip">
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}</div>
        <div class="user-info">
          <div class="name">{{ Auth::user()->name ?? 'Usuario' }}</div>
          <div class="role">Administrador</div>
        </div>
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">
          <i class="fas fa-sign-out-alt"></i> Cerrar sesión
        </button>
      </form>
    </div>
  </nav>

  {{-- MAIN PANEL --}}
  <div id="mainPanel">
    <header class="topbar">
      <div class="topbar-title">
        <h2>@yield('page_title', 'Panel Principal')</h2>
        <p>@yield('page_sub', 'Vista general del sistema')</p>
      </div>
      <div class="topbar-search">
        <i class="fas fa-search"></i>
        <input type="text" id="topbarSearch" placeholder="Buscar en este módulo...">
      </div>
      <div class="topbar-actions">
        <div class="icon-btn notif-dot"><i class="fas fa-bell"></i></div>
        <div class="icon-btn"><i class="fas fa-cog"></i></div>
      </div>
    </header>

    <div id="contentArea">
      @yield('content')
    </div>
  </div>
</div>

{{-- TOAST CONTAINER --}}
<div id="toastContainer"></div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

// ── TOAST ──────────────────────────────────────────────────────
function toast(msg, type = 'success') {
  const el = document.createElement('div');
  el.className = `toast ${type}`;
  el.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${msg}`;
  document.getElementById('toastContainer').appendChild(el);
  setTimeout(() => {
    el.style.animation = 'toastOut .3s forwards';
    setTimeout(() => el.remove(), 300);
  }, 3000);
}

// ── ANIMCOUNT ──────────────────────────────────────────────────
function animCount(id, target, duration = 900) {
  const el = document.getElementById(id);
  if (!el) return;
  const start = performance.now();
  (function step(now) {
    const p = Math.min((now - start) / duration, 1);
    el.textContent = Math.round((1 - Math.pow(1 - p, 3)) * target);
    if (p < 1) requestAnimationFrame(step);
  })(performance.now());
}

// ── SPLASH + SHOW APP ──────────────────────────────────────────
window.addEventListener('DOMContentLoaded', () => {
  const userName = "{{ Auth::user()->name ?? 'Administrador' }}";
  const el = document.getElementById('splashName');
  if (el) el.textContent = userName;

  // Partículas
  const bg = document.querySelector('.splash-bg-rings');
  if (bg) for (let i = 0; i < 16; i++) {
    const d = document.createElement('div');
    d.className = 'splash-particle';
    d.style.cssText = `left:${10+Math.random()*80}%;top:${20+Math.random()*60}%;animation-delay:${Math.random()*4}s;animation-duration:${3+Math.random()*4}s`;
    bg.appendChild(d);
  }

  setTimeout(() => {
    document.getElementById('splashScreen').classList.add('fade-out');
    document.getElementById('appShell').style.display = 'flex';
    setTimeout(() => {
      document.getElementById('splashScreen').style.display = 'none';
      if (typeof onAppReady === 'function') onAppReady();
    }, 1200);
  }, 2000);

  // ── Flash messages desde Laravel ──────────────────────────
  @if(session('success'))
    setTimeout(() => toast("{{ addslashes(session('success')) }}", 'success'), 2200);
  @endif
  @if(session('error'))
    setTimeout(() => toast("{{ addslashes(session('error')) }}", 'error'), 2200);
  @endif
});
</script>

@stack('scripts')
</body>
</html>
