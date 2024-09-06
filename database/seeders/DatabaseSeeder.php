<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Employee;
use App\Models\Order;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RingleSoft\LaravelProcessApproval\Enums\ApprovalTypeEnum;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Employee::factory(10)->create();
        Driver::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@mail.com',
            'password' => '123'
        ]);

        $chief = User::factory()->create([
            'name' => 'Ketua Peminjaman',
            'email' => 'ketua@mail.com',
            'password' => '123'
        ]);

        $supervisor = User::factory()->create([
            'name' => 'Supervisor',
            'email' => 'supervisor@mail.com',
            'password' => '123'
        ]);
        $adminRole = Role::create(['name' => 'Admin']);
        $chiefRole = Role::create(['name' => 'Chief']);
        $supervisorRole = Role::create(['name' => 'Supervisor']);

        $admin->assignRole($adminRole);
        $chief->assignRole($chiefRole);
        $supervisor->assignRole($supervisorRole);


        Order::makeApprovable([
            $supervisor->id => ApprovalTypeEnum::APPROVE->value,
            $chiefRole->id => ApprovalTypeEnum::APPROVE->value,
        ], 'OrderApproval');


    }
}
