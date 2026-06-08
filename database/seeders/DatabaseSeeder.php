<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // ==========================================
        // 1. MÉDICOS
        // ==========================================
        $medicos = [
            ['nombre' => 'Carlos', 'apellido' => 'Rodríguez', 'especialidad' => 'Cardiología', 'telefono' => '987654321', 'email' => 'carlos@clinicahub.com', 'licencia' => 'MED-001', 'años_experiencia' => '12 años', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'María', 'apellido' => 'Fernández', 'especialidad' => 'Pediatría', 'telefono' => '987654322', 'email' => 'maria@clinicahub.com', 'licencia' => 'MED-002', 'años_experiencia' => '8 años', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Jorge', 'apellido' => 'Mendoza', 'especialidad' => 'Traumatología', 'telefono' => '987654323', 'email' => 'jorge@clinicahub.com', 'licencia' => 'MED-003', 'años_experiencia' => '15 años', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ana', 'apellido' => 'Quispe', 'especialidad' => 'Dermatología', 'telefono' => '987654324', 'email' => 'ana@clinicahub.com', 'licencia' => 'MED-004', 'años_experiencia' => '6 años', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Roberto', 'apellido' => 'Sánchez', 'especialidad' => 'Neurología', 'telefono' => '987654325', 'email' => 'roberto@clinicahub.com', 'licencia' => 'MED-005', 'años_experiencia' => '10 años', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('medicos')->insert($medicos);
        $this->command->info('✅ Médicos: 5');

        // ==========================================
        // 2. PACIENTES
        // ==========================================
        $nombres = ['Luis', 'Andrea', 'Miguel', 'Sofía', 'Diego', 'Valentina', 'Andrés', 'Camila', 'Javier', 'Isabella'];
        $apellidos = ['Pérez', 'Gómez', 'Luna', 'Rojas', 'Díaz', 'Torres', 'Flores', 'Vargas', 'Castro', 'Morales'];
        $tiposSangre = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $generos = ['Masculino', 'Femenino'];
        $pacientes = [];

        for ($i = 0; $i < 10; $i++) {
            $pacientes[] = [
                'nombre' => $nombres[$i],
                'apellido' => $apellidos[$i],
                'fecha_nacimiento' => Carbon::now()->subYears(rand(18, 80))->subDays(rand(1, 365)),
                'genero' => $generos[array_rand($generos)],
                'telefono' => '9' . rand(10000000, 99999999),
                'tipo_sangre' => $tiposSangre[array_rand($tiposSangre)],
                'direccion' => 'Av. ' . $apellidos[$i] . ' #' . rand(100, 999),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('pacientes')->insert($pacientes);
        $this->command->info('✅ Pacientes: 10');

        // ==========================================
        // 3. CITAS
        // ==========================================
        $estados = ['Programada', 'Completada', 'Cancelada'];
        $motivos = ['Consulta general', 'Dolor de cabeza', 'Control rutinario', 'Dolor muscular', 'Fiebre', 'Chequeo anual', 'Seguimiento', 'Emergencia'];
        $salas = ['101', '102', '103', '201', '202', '203'];
        $citas = [];

        for ($i = 0; $i < 15; $i++) {
            $citas[] = [
                'paciente_id' => rand(1, 10),
                'medico_id' => rand(1, 5),
                'fecha' => Carbon::now()->addDays(rand(-15, 30))->setTime(rand(8, 18), rand(0, 59)),
                'motivo' => $motivos[array_rand($motivos)],
                'estado' => $estados[array_rand($estados)],
                'sala' => $salas[array_rand($salas)],
                'observaciones' => 'Paciente requiere atención especial',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('citas')->insert($citas);
        $this->command->info('✅ Citas: 15');

        // ==========================================
        // 4. DIAGNÓSTICOS
        // ==========================================
        $descripciones = [
            'Hipertensión arterial diagnosticada',
            'Diabetes tipo 2 con control regular',
            'Influenza estacional con complicaciones',
            'Fractura de muñeca derecha',
            'Dermatitis atópica severa',
            'Migraña crónica con aura',
            'Bronquitis aguda',
            'Gastroenteritis viral',
            'Ansiedad generalizada',
            'Osteoartritis de rodilla'
        ];
        $gravedades = ['Leve', 'Moderado', 'Severo'];
        $tiposDiagnostico = ['Primario', 'Secundario', 'Crónico', 'Agudo'];
        $diagnosticos = [];

        for ($i = 0; $i < 20; $i++) {
            $diagnosticos[] = [
                'paciente_id' => rand(1, 10),
                'medico_id' => rand(1, 5),
                'descripcion' => $descripciones[array_rand($descripciones)],
                'fecha' => Carbon::now()->subDays(rand(1, 180))->setTime(rand(8, 17), rand(0, 59)),
                'gravedad' => $gravedades[array_rand($gravedades)],
                'recomendaciones' => 'Reposo y medicación indicada. Control en 7 días.',
                'tipo_diagnostico' => $tiposDiagnostico[array_rand($tiposDiagnostico)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('diagnosticos')->insert($diagnosticos);
        $this->command->info('✅ Diagnósticos: 20');

        // ==========================================
        // 5. TRATAMIENTOS
        // ==========================================
        $nombresTratamientos = ['Terapia farmacológica', 'Fisioterapia intensiva', 'Reposo absoluto', 'Rehabilitación física', 'Psicoterapia', 'Control nutricional'];
        $descripcionesTratamiento = [
            'Tratamiento con medicamentos antiinflamatorios',
            'Sesiones de fisioterapia 3 veces por semana',
            'Reposo en casa por 2 semanas',
            'Rehabilitación con ejercicios específicos',
            'Terapia psicológica semanal',
            'Plan nutricional personalizado'
        ];
        $estadosTratamiento = ['Activo', 'Finalizado', 'Suspendido'];
        $frecuencias = ['Cada 8 horas', 'Cada 12 horas', 'Una vez al día', 'Cada 6 horas'];
        $tratamientos = [];

        for ($i = 0; $i < 20; $i++) {
            $tratamientos[] = [
                'nombre' => $nombresTratamientos[array_rand($nombresTratamientos)],
                'descripcion' => $descripcionesTratamiento[array_rand($descripcionesTratamiento)],
                'duracion' => rand(15, 180) . ' días',
                'diagnostico_id' => rand(1, 20),
                'medico_id' => rand(1, 5),
                'estado' => $estadosTratamiento[array_rand($estadosTratamiento)],
                'frecuencia_administracion' => $frecuencias[array_rand($frecuencias)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('tratamientos')->insert($tratamientos);
        $this->command->info('✅ Tratamientos: 20');

        // ==========================================
        // 6. MEDICAMENTOS
        // ==========================================
        $nombresMedicamentos = ['Paracetamol', 'Ibuprofeno', 'Amoxicilina', 'Losartán', 'Metformina', 'Omeprazol', 'Salbutamol', 'Enalapril', 'Atorvastatina', 'Cetirizina'];
        $dosis = ['500mg', '250mg', '100mg', '50mg', '750mg'];
        $frecuenciasMed = ['Cada 8 horas', 'Cada 12 horas', 'Una vez al día', 'Cada 6 horas'];
        $duraciones = ['7 días', '14 días', '30 días', '60 días'];
        $proveedores = ['Farm Salud', 'MediCorp', 'BioFarma', 'Salud Total'];
        $efectos = ['Ninguno', 'Mareos leves', 'Somnolencia', 'Náuseas', 'Dolor de estómago'];
        $medicamentos = [];

        for ($i = 0; $i < 25; $i++) {
            $medicamentos[] = [
                'nombre' => $nombresMedicamentos[array_rand($nombresMedicamentos)],
                'dosis' => $dosis[array_rand($dosis)],
                'frecuencia' => $frecuenciasMed[array_rand($frecuenciasMed)],
                'duracion' => $duraciones[array_rand($duraciones)],
                'tratamiento_id' => rand(1, 20),
                'proveedor' => $proveedores[array_rand($proveedores)],
                'efectos_secundarios' => $efectos[array_rand($efectos)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('medicamentos')->insert($medicamentos);
        $this->command->info('✅ Medicamentos: 25');

        // ==========================================
        // RESUMEN FINAL
        // ==========================================
        $this->command->info('');
        $this->command->info('╔═══════════════════════════════════════════════════════╗');
        $this->command->info('║     🎉 95 REGISTROS DE DEMO CREADOS EXITOSAMENTE 🎉    ║');
        $this->command->info('╠═══════════════════════════════════════════════════════╣');
        $this->command->info('║  👨‍⚕️ Médicos: 5                                       ║');
        $this->command->info('║  👤 Pacientes: 10                                     ║');
        $this->command->info('║  📅 Citas: 15                                         ║');
        $this->command->info('║  📋 Diagnósticos: 20                                  ║');
        $this->command->info('║  💊 Tratamientos: 20                                  ║');
        $this->command->info('║  💊 Medicamentos: 25                                  ║');
        $this->command->info('╚═══════════════════════════════════════════════════════╝');
        $this->command->info('');
    }
}
