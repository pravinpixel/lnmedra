<?php

use Database\Seeders\AccountsTableSeeder;
use Database\Seeders\BillersTableSeeder;
use Database\Seeders\BrandsTableSeeder;
use Database\Seeders\CategoriesTableSeeder;
use Database\Seeders\CurrenciesTableSeeder;
use Database\Seeders\CustomerGroupsTableSeeder;
use Database\Seeders\CustomersTableSeeder;
use Database\Seeders\GeneralSettingsTableSeeder;
use Database\Seeders\HrmSettingsTableSeeder;
use Database\Seeders\MailTemplateSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\PosSettingTableSeeder;
use Database\Seeders\ProductsTableSeeder;
use Database\Seeders\ProductTypesTableSeeder;
use Database\Seeders\RewardPointSettingsTableSeeder;
use Database\Seeders\RoleHasPermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\TaxesTableSeeder;
use Database\Seeders\UnitsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\WarehousesTableSeeder;
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
        $this->call(MailTemplateSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PosSettingTableSeeder::class);
        $this->call(BillersTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(GeneralSettingsTableSeeder::class);
        $this->call(HrmSettingsTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(WarehousesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RewardPointSettingsTableSeeder::class);
        $this->call(ProductTypesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CustomerGroupsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(TaxesTableSeeder::class);
    }
}
