<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'products',
                'guard_name' => 'web',
            ],
            [
                'name' => 'posts',
                'guard_name' => 'web',
            ],    
        ]);
    }
}
