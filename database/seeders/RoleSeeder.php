<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::statement(<<<'SQL'
INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1,'admin','rol de administrador de sistemas','2025-04-21 21:33:04','2025-09-17 15:22:45'),
(2,'counter','rol de counter','2025-04-21 21:33:04','2025-04-21 21:33:04'),
(3,'contabilidad','rol de contabilidad','2025-04-21 21:33:04','2025-04-21 21:33:04'),
(4,'laboratorio','rol de laboratorio','2025-04-21 21:33:04','2025-04-21 21:33:04'),
(5,'motorizado','rol de motorizado','2025-04-21 21:33:04','2025-04-21 21:33:04'),
(6,'visitador','rol de visitador medico','2025-04-21 21:33:04','2025-04-21 21:33:04'),
(7,'jefe-operaciones','rol de jefe de operaciones','2025-04-21 21:33:04','2025-04-21 21:33:04'),
(8,'jefe-comercial','rol de jefe comercial','2025-04-21 21:33:04','2025-04-21 21:33:04'),
(9,'coordinador-lineas','rol de coordinador de lineas','2025-04-21 21:33:04','2025-04-21 21:33:04'),
(10,'gerencia-general','rol de gerencia general','2025-04-21 21:33:04','2025-04-21 21:33:04'),
(11,'supervisor','rol de supervisor','2025-04-21 21:33:04','2025-04-21 21:33:04'),
(12,'Administracion','Rol de administración ','2025-07-08 18:25:54','2025-07-08 18:26:00'),
(13,'tecnico_produccion','Técnico de produccion de laboratorio','2025-06-04 17:10:17','2025-06-04 17:10:17');
SQL);
    }
}
