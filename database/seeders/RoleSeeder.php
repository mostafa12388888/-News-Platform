<?php

namespace Database\Seeders;

use App\Models\Authorization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[];
        foreach(config('authorization.permissions') as $per=>$value)
        $permissions[]=$per;
        Authorization::create([
            'role'=>"Manger",
            "permission"=>json_encode($permissions),
        ]);

    }
}
