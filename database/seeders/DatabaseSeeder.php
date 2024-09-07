<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Employee;
use App\Models\Order;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleOwner;
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

        $employess = Employee::factory(10)->create();
        $drivers = Driver::factory(10)->create();

        $owner1 = VehicleOwner::factory()->create([
            'company_name' => 'Kantor Cabang',
            'address' => 'Jakarta'
        ]);
        $owner2 = VehicleOwner::factory()->create([
            'company_name' => 'Kantor Pusat',
            'address' => 'Sumatra'
        ]);

        $vehicle1 = Vehicle::factory()->create([
            'name' => 'Suzuki Mobil',
            'vehicle_owner_id' => $owner1->id,
        ]);


        $vehicle2 = Vehicle::factory()->create([
            'name' => 'Kawasaki',
            'vehicle_owner_id' => $owner2->id,
        ]);

        // for($i = 0; $i<10 ; $i++){
        //     Order::factory()->create([
        //         'employee_id' => $employess[$i]->id,
        //         'vehicle_id' => $i % 2 ? $vehicle1->id : $vehicle2 ,
        //         'driver_id' => $drivers[$i]->id,
        //     ]);
        // }




        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
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
