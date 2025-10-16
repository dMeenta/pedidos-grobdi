<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleModuleSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles_modules')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::statement(<<<'SQL'
INSERT INTO `roles_modules` (`id`, `module_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1,1,1,NULL,NULL),
(2,6,2,NULL,NULL),
(3,6,4,NULL,NULL),
(4,2,8,NULL,NULL),
(5,5,6,NULL,NULL),
(6,11,4,NULL,NULL),
(7,4,5,NULL,NULL),
(8,11,2,NULL,NULL),
(9,3,2,NULL,NULL),
(10,3,7,NULL,NULL),
(11,8,2,NULL,NULL),
(12,7,2,NULL,NULL),
(13,4,2,NULL,NULL),
(14,12,8,NULL,NULL),
(15,1,2,NULL,NULL),
(16,1,9,NULL,NULL),
(17,1,8,NULL,NULL),
(18,3,9,NULL,NULL);
SQL);
    }
}
