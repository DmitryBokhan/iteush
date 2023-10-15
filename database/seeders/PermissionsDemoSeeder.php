<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'редактировать тикеты']);
        Permission::create(['name' => 'просматривать тикеты других пользователей']);
        Permission::create(['name' => 'создавать тикеты']);
        Permission::create(['name' => 'брать тикет в работу']);
        Permission::create(['name' => 'назначать тикет исполнителю']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Инициатор']);
        $role1->givePermissionTo('создавать тикеты');
        $role1->givePermissionTo('редактировать тикеты');

        $role2 = Role::create(['name' => 'Исполнитель']);
        $role2->givePermissionTo('редактировать тикеты');
        $role2->givePermissionTo('брать тикет в работу');

        $role3 = Role::create(['name' => 'Руководитель группы']);
        $role3->givePermissionTo('создавать тикеты');
        $role3->givePermissionTo('редактировать тикеты');
        $role3->givePermissionTo('просматривать тикеты других пользователей');
        $role3->givePermissionTo('брать тикет в работу');
        $role3->givePermissionTo('назначать тикет исполнителю');

        $role4 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Инициатор',
            'email' => 'test@example.com',
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user->assignRole($role1);

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Исполнитель',
            'email' => 'test2@example.com',
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Руководитель группы',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user->assignRole($role4);
    }
}
