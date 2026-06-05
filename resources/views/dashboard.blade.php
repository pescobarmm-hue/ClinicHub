<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>MedFlow Dashboard | Gestión Médica del Futuro</title>
    <!-- Google Fonts & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Chart.js CDN para gráficas modernas -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f4f9;
            font-family: 'Inter', sans-serif;
            color: #1a2634;
            padding: 32px 28px;
        }

        /* contenedor principal */
        .dashboard-container {
            max-width: 1600px;
            margin: 0 auto;
        }

        /* header inspirado en diseño ultra-moderno */
        .hero-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }
        .title-section h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1C6E8F, #2A9D8F);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.3px;
        }
        .title-section p {
            color: #5b6e8c;
            font-weight: 500;
            margin-top: 6px;
        }
        .badge-stats {
            display: flex;
            gap: 24px;
            background: white;
            padding: 12px 28px;
            border-radius: 80px;
            box-shadow: 0 6px 14px rgba(0,0,0,0.02), 0 2px 4px rgba(0,0,0,0.05);
        }
        .badge-item {
            display: flex;
            align-items: baseline;
            gap: 8px;
            font-weight: 600;
        }
        .badge-item span:first-child {
            color: #2c3e66;
            font-size: 1.2rem;
        }
        .badge-item .rating {
            color: #f4b942;
            font-size: 1.3rem;
        }
        .btn-group {
            display: flex;
            gap: 14px;
        }
        .btn-primary, .btn-outline {
            padding: 10px 24px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            cursor: default;
            border: none;
        }
        .btn-primary {
            background: #1f6e8c;
            color: white;
            box-shadow: 0 4px 8px rgba(31,110,140,0.2);
        }
        .btn-outline {
            background: transparent;
            border: 1px solid #cbd5e1;
            color: #2c3e66;
        }

        /* KPI Cards (estilo "en vivo — hoy") */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 22px;
            margin-bottom: 36px;
        }
        .kpi-card {
            background: white;
            border-radius: 32px;
            padding: 20px 22px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.02), 0 2px 6px rgba(0,0,0,0.03);
            transition: transform 0.1s ease;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .kpi-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            color: #5f7f9e;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
        }
        .kpi-value {
            font-size: 2.4rem;
            font-weight: 800;
            color: #1a2c3e;
            line-height: 1.1;
        }
        .trend-up {
            color: #2a9d8f;
            font-size: 0.8rem;
            font-weight: 600;
            background: #e0f2ef;
            padding: 4px 8px;
            border-radius: 40px;
        }
        .trend-neutral {
            color: #e9c46a;
        }
        .sub-metric {
            margin-top: 12px;
            font-size: 0.75rem;
            color: #6c86a3;
        }

        /* TABLAS PRINCIPALES (gestión completa) */
        .tables-section {
            display: flex;
            flex-direction: column;
            gap: 36px;
        }
        .card-table {
            background: white;
            border-radius: 28px;
            box-shadow: 0 12px 28px rgba(0,0,0,0.04);
            overflow: hidden;
            transition: all 0.2s;
            border: 1px solid #eef2f8;
        }
        .card-header {
            padding: 20px 28px 12px 28px;
            border-bottom: 1px solid #edf2f7;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .card-header h2 {
            font-size: 1.35rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #1e3b4f;
        }
        .card-header h2 i {
            color: #2a9d8f;
            font-size: 1.4rem;
        }
        .table-wrapper {
            overflow-x: auto;
            padding: 0 0 12px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        th {
            text-align: left;
            padding: 16px 20px;
            background-color: #fafcff;
            font-weight: 600;
            color: #2c4b6e;
            border-bottom: 1px solid #e9edf2;
        }
        td {
            padding: 14px 20px;
            border-bottom: 1px solid #f0f3f8;
            color: #2c3f55;
            font-weight: 500;
        }
        .badge-status {
            background: #e6f7f2;
            color: #1f7b66;
            padding: 5px 10px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 700;
            display: inline-block;
        }
        .badge-med {
            background: #eef2ff;
            color: #3266a8;
        }
        .btn-icon-sm {
            background: none;
            border: none;
            color: #7f9bc0;
            cursor: default;
            margin: 0 4px;
        }

        /* gráfico para complementar el estilo moderno */
        .chart-row {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }
        .chart-box {
            background: white;
            border-radius: 28px;
            padding: 20px;
            flex: 1;
            min-width: 250px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.02);
            border: 1px solid #ecf3fa;
        }
        .chart-box h4 {
            font-weight: 600;
            margin-bottom: 16px;
            color: #2a4b6e;
        }

        @media (max-width: 760px) {
            body { padding: 20px 16px; }
            .hero-header { flex-direction: column; align-items: flex-start; gap: 16px; }
            .badge-stats { padding: 10px 20px; }
            .kpi-value { font-size: 1.8rem; }
        }
        footer {
            margin-top: 48px;
            text-align: center;
            font-size: 0.75rem;
            color: #8ba0bc;
            border-top: 1px solid #e2e8f0;
            padding-top: 24px;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <!-- HEADER INSPIRADO EN "Gestión Médica del Futuro" -->
    <div class="hero-header">
        <div class="title-section">
            <h1><i class="fas fa-heartbeat" style="background: none; -webkit-background-clip: unset; color: #2A9D8F;"></i> MedFlow · Gestión Médica del Futuro</h1>
            <p>Pacientes, citas, diagnósticos y tratamientos — todo en una plataforma ultra-moderna.</p>
        </div>
        <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap;">
            <div class="badge-stats">
                <div class="badge-item"><span class="rating">★</span><span>5.0</span></div>
                <div class="badge-item"><span>2,847+</span><span>reseñas</span></div>
                <div class="badge-item"><span>500+</span><span>clínicas activas</span></div>
            </div>
            <div class="btn-group">
                <button class="btn-primary" disabled><i class="fas fa-rocket"></i> Comenzar Ahora</button>
                <button class="btn-outline" disabled><i class="fas fa-play-circle"></i> Ver Demo</button>
            </div>
        </div>
    </div>

    <!-- KPIs estilo EN VIVO — HOY -->
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-title">EN VIVO — HOY <i class="fas fa-calendar-day"></i></div>
            <div class="kpi-value" id="liveCitas">42</div>
            <div class="sub-metric">citas programadas</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-title">PACIENTES ACTIVOS <i class="fas fa-user-plus"></i></div>
            <div class="kpi-value">324 <span style="font-size: 1rem;" class="trend-up"><i class="fas fa-arrow-up"></i> +12%</span></div>
            <div class="sub-metric">últimos 30 días</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-title">EFICIENCIA OPERATIVA</div>
            <div class="kpi-value">98% <span style="font-size: 1rem;" class="trend-up"><i class="fas fa-arrow-up"></i> +5%</span></div>
            <div class="sub-metric">uso óptimo de recursos</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-title">TIEMPO PROMEDIO</div>
            <div class="kpi-value">18 min</div>
            <div class="sub-metric">por atención médica</div>
        </div>
        <div class="kpi-card">
            <div class="kpi-title">OCUPACIÓN CONSULTORIOS</div>
            <div class="kpi-value">78%</div>
            <div class="sub-metric">+5% respecto a mes anterior</div>
        </div>
    </div>

    <!-- GRÁFICO de tendencias (moderno + resumen) -->
    <div class="chart-row">
        <div class="chart-box">
            <h4><i class="fas fa-chart-line"></i> Evolución citas semanales</h4>
            <canvas id="citasChart" width="400" height="200" style="max-height: 200px; width:100%"></canvas>
        </div>
        <div class="chart-box">
            <h4><i class="fas fa-pills"></i> Medicamentos más recetados</h4>
            <canvas id="medsChart" width="400" height="200" style="max-height: 200px; width:100%"></canvas>
        </div>
    </div>

    <!-- SECCIÓN DE TABLAS: CITAS, DIAGNÓSTICOS, MEDICAMENTOS, MÉDICOS, PACIENTES, TRATAMIENTOS -->
    <div class="tables-section">
        <!-- TABLA CITAS -->
        <div class="card-table">
            <div class="card-header"><h2><i class="fas fa-calendar-check"></i> Citas médicas</h2><span style="color:#54809b; font-size:0.75rem;">próximas 7 días</span></div>
            <div class="table-wrapper">
                <table>
                    <thead><tr><th>Paciente</th><th>Médico</th><th>Fecha</th><th>Hora</th><th>Estado</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Mariana López</td><td>Dra. Andrea Ríos</td><td>2026-06-10</td><td>09:30 AM</td><td><span class="badge-status">Confirmada</span></td></tr>
                        <tr><td>Javier Méndez</td><td>Dr. Carlos Peña</td><td>2026-06-10</td><td>11:15 AM</td><td><span class="badge-status">En espera</span></td></tr>
                        <tr><td>Camila Fuentes</td><td>Dra. Laura Gálvez</td><td>2026-06-11</td><td>08:45 AM</td><td><span class="badge-status">Confirmada</span></td></tr>
                        <tr><td>Luis Herrera</td><td>Dr. Ricardo Soto</td><td>2026-06-12</td><td>02:00 PM</td><td><span class="badge-status">Pendiente</span></td></tr>
                        <tr><td>Sofía Ramos</td><td>Dra. Andrea Ríos</td><td>2026-06-12</td><td>04:30 PM</td><td><span class="badge-status">Confirmada</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABLA DIAGNÓSTICOS -->
        <div class="card-table">
            <div class="card-header"><h2><i class="fas fa-stethoscope"></i> Diagnósticos recientes</h2><i class="fas fa-microscope" style="color:#92b4d4;"></i></div>
            <div class="table-wrapper">
                <table>
                    <thead><tr><th>Paciente</th><th>Diagnóstico</th><th>Fecha</th><th>Médico</th><th>CIE-10</th></tr></thead>
                    <tbody>
                        <tr><td>Mariana López</td><td>Hipertensión esencial</td><td>2026-06-05</td><td>Dra. Andrea Ríos</td><td>I10</td></tr>
                        <tr><td>Javier Méndez</td><td>Diabetes tipo 2</td><td>2026-06-03</td><td>Dr. Carlos Peña</td><td>E11</td></tr>
                        <tr><td>Camila Fuentes</td><td>Infección urinaria</td><td>2026-06-01</td><td>Dra. Laura Gálvez</td><td>N39.0</td></tr>
                        <tr><td>Luis Herrera</td><td>Lumbalgia crónica</td><td>2026-05-28</td><td>Dr. Ricardo Soto</td><td>M54.5</td></tr>
                        <tr><td>Sofía Ramos</td><td>Ansiedad generalizada</td><td>2026-05-30</td><td>Dra. Andrea Ríos</td><td>F41.1</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABLA MEDICAMENTOS -->
        <div class="card-table">
            <div class="card-header"><h2><i class="fas fa-capsules"></i> Medicamentos & stock crítico</h2><span class="trend-up"><i class="fas fa-chart-simple"></i> 92% disponibilidad</span></div>
            <div class="table-wrapper">
                <table>
                    <thead><tr><th>Nombre</th><th>Presentación</th><th>Laboratorio</th><th>Stock actual</th><th>Recetas emitidas (mes)</th></tr></thead>
                    <tbody>
                        <tr><td>Losartán 50mg</td><td>Caja 30 comp</td><td>PharmaMed</td><td>1240</td><td>87</td></tr>
                        <tr><td>Metformina 850mg</td><td>Caja 60 comp</td><td>BioSalud</td><td>980</td><td>112</td></tr>
                        <tr><td>Amoxicilina 500mg</td><td>Suspensión / cápsulas</td><td>Genéricos Unidos</td><td>540</td><td>203</td></tr>
                        <tr><td>Paracetamol 1g</td><td>Caja 20 comp</td><td>Analgésicos SA</td><td>2100</td><td>310</td></tr>
                        <tr><td>Ibuprofeno 600mg</td><td>Caja 30 comp</td><td>Farmedic</td><td>875</td><td>164</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABLA MÉDICOS -->
        <div class="card-table">
            <div class="card-header"><h2><i class="fas fa-user-md"></i> Cuerpo médico especialidades</h2><i class="fas fa-chalkboard-user"></i></div>
            <div class="table-wrapper">
                <table>
                    <thead><tr><th>Médico</th><th>Especialidad</th><th>Licencia</th><th>Consultorio</th><th>Pacientes atendidos (2026)</th></tr></thead>
                    <tbody>
                        <tr><td>Dra. Andrea Ríos</td><td>Cardiología</td><td>MED-4532</td><td>204</td><td>389</td></tr>
                        <tr><td>Dr. Carlos Peña</td><td>Endocrinología</td><td>MED-7821</td><td>107</td><td>312</td></tr>
                        <tr><td>Dra. Laura Gálvez</td><td>Medicina Interna</td><td>MED-1290</td><td>112</td><td>456</td></tr>
                        <tr><td>Dr. Ricardo Soto</td><td>Traumatología</td><td>MED-6743</td><td>310</td><td>278</td></tr>
                        <tr><td>Dra. Cecilia Mora</td><td>Pediatría</td><td>MED-9834</td><td>105</td><td>410</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABLA PACIENTES -->
        <div class="card-table">
            <div class="card-header"><h2><i class="fas fa-users"></i> Pacientes activos (últimos registros)</h2><i class="fas fa-chart-line" style="color:#2a9d8f;"></i></div>
            <div class="table-wrapper">
                <table>
                    <thead><tr><th>ID</th><th>Nombre completo</th><th>Edad</th><th>Teléfono</th><th>Última cita</th><th>Patologías base</th></tr></thead>
                    <tbody>
                        <tr><td>P001</td><td>Mariana López</td><td>58</td><td>555-1234</td><td>2026-06-05</td><td>Hipertensión</td></tr>
                        <tr><td>P002</td><td>Javier Méndez</td><td>47</td><td>555-5678</td><td>2026-06-03</td><td>Diabetes</td></tr>
                        <tr><td>P003</td><td>Camila Fuentes</td><td>32</td><td>555-9012</td><td>2026-06-01</td><td>Infecciones recurrentes</td></tr>
                        <tr><td>P004</td><td>Luis Herrera</td><td>61</td><td>555-3456</td><td>2026-05-28</td><td>Artrosis</td></tr>
                        <tr><td>P005</td><td>Sofía Ramos</td><td>29</td><td>555-7890</td><td>2026-05-30</td><td>Trastorno ansiedad</td></tr>
                        <tr><td>P006</td><td>Gabriel Torres</td><td>44</td><td>555-1122</td><td>2026-06-07</td><td>Asma</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABLA TRATAMIENTOS -->
        <div class="card-table">
            <div class="card-header"><h2><i class="fas fa-notes-medical"></i> Tratamientos activos / Planes</h2><span class="trend-up">seguimiento 2026</span></div>
            <div class="table-wrapper">
                <table>
                    <thead><tr><th>Paciente</th><th>Tratamiento</th><th>Medicamento principal</th><th>Duración</th><th>Progreso</th><th>Próxima evaluación</th></tr></thead>
                    <tbody>
                        <tr><td>Mariana López</td><td>Control HTA + Enalapril</td><td>Enalapril 20mg</td><td>6 meses</td><td><span class="badge-status">68%</span></td><td>2026-07-10</td></tr>
                        <tr><td>Javier Méndez</td><td>Metformina + dieta</td><td>Metformina</td><td>Indefinido</td><td><span class="badge-status">82%</span></td><td>2026-06-20</td></tr>
                        <tr><td>Camila Fuentes</td><td>Antibiótico + probiótico</td><td>Ciprofloxacino</td><td>10 días</td><td><span class="badge-status">100%</span></td><td>2026-06-12</td></tr>
                        <tr><td>Luis Herrera</td><td>Fisioterapia + analgesia</td><td>Naproxeno</td><td>8 semanas</td><td><span class="badge-status">45%</span></td><td>2026-07-01</td></tr>
                        <tr><td>Sofía Ramos</td><td>Terapia cognitiva + Sertralina</td><td>Sertralina 50mg</td><td>4 meses</td><td><span class="badge-status">60%</span></td><td>2026-06-25</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer>
        <i class="fas fa-chart-simple"></i> Datos actualizados en tiempo real · Plataforma ultra-moderna · Gestión integral de clínicas y hospitales
    </footer>
</div>

<script>
    // Gráfico de evolución de citas (soporte para dashboard moderno)
    const ctxCitas = document.getElementById('citasChart').getContext('2d');
    new Chart(ctxCitas, {
        type: 'line',
        data: {
            labels: ['Sem 18', 'Sem 19', 'Sem 20', 'Sem 21', 'Esta semana'],
            datasets: [{
                label: 'Citas realizadas',
                data: [38, 42, 47, 53, 48],
                borderColor: '#2A9D8F',
                backgroundColor: 'rgba(42,157,143,0.05)',
                borderWidth: 3,
                pointBackgroundColor: '#1F6E8C',
                pointBorderColor: '#fff',
                pointRadius: 5,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: { legend: { position: 'top', labels: { boxWidth:12, font:{size:11} } } }
        }
    });

    // Gráfico de medicamentos más recetados (frecuencia)
    const ctxMeds = document.getElementById('medsChart').getContext('2d');
    new Chart(ctxMeds, {
        type: 'bar',
        data: {
            labels: ['Paracetamol', 'Amoxicilina', 'Metformina', 'Losartán', 'Ibuprofeno'],
            datasets: [{
                label: 'Recetas (último mes)',
                data: [310, 203, 112, 87, 164],
                backgroundColor: '#6DACCE',
                borderRadius: 12,
                barPercentage: 0.65,
                categoryPercentage: 0.8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, grid: { color: '#e9ecef' } } }
        }
    });

    console.log("Dashboard médico futuro cargado - tablas: citas, diagnosticos, medicamentos, medicos, pacientes, tratamientos");
</script>
</body>
</html>