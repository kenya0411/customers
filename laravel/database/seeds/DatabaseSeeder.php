<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PersonTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ProductOptionTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(FortuneTableSeeder::class);
        $this->call(ReserveTableSeeder::class);
        $this->call(ShipTableSeeder::class);
    }
}
