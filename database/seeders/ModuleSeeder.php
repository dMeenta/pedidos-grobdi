<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('modules')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::statement(<<<'SQL'
INSERT INTO `modules` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1,'Administración','Gestión de vistas, roles y usuarios','2025-09-17 00:00:00','2025-09-17 00:00:00'),
(2,'Muestras','Operaciones para la gestión de muestras','2025-09-17 00:00:00','2025-09-17 00:00:00'),
(3,'Operaciones','Herramientas de soporte operativo','2025-09-17 00:00:00','2025-09-17 00:00:00'),
(4,'Doctores y Rutas','Administración de doctores y rutas','2025-09-17 00:00:00','2025-09-17 00:00:00'),
(5,'Pedidos Laboratorio','Seguimiento de órdenes de producción','2025-09-17 00:00:00','2025-09-17 00:00:00'),
(6,'Pedidos Motorizado','Control y actualización de entregas','2025-09-17 00:00:00','2025-09-17 00:00:00'),
(7,'Pedidos Contabilidad','Procesos de contabilidad de pedidos','2025-09-17 00:00:00','2025-09-17 00:00:00'),
(8,'Pedidos Counter','Carga y gestión de pedidos','2025-09-17 00:00:00','2025-09-17 00:00:00'),
(9,'Reportes','Reportes de ventas, rutas y doctores','2025-09-17 00:00:00','2025-09-17 00:00:00'),
(10,'Gerencia General','Paneles para gerencia general','2025-09-17 00:00:00','2025-09-17 00:00:00'),
(11,'Supervisor','Herramientas para supervisores','2025-09-17 00:00:00','2025-09-17 00:00:00'),
(12,'Administración Corporativa','Módulos administrativos complementarios','2025-09-17 00:00:00','2025-09-17 00:00:00');
SQL);
    }
}
