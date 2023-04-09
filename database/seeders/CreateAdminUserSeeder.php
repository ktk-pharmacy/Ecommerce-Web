<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Tayzar',
            'email' => 'tayzar.job@gmail.com',
            'password' => bcrypt('tayzar123')
        ]);

        $role = Role::create(['name' => 'Superadmin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->syncRoles([$role->id]);
    }
}
