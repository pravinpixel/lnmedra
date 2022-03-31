<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 4,
                'name' => 'products-edit',
                'guard_name' => 'web',
                'created_at' => '2018-06-03 06:30:09',
                'updated_at' => '2018-06-03 06:30:09',
            ),
            1 => 
            array (
                'id' => 5,
                'name' => 'products-delete',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 04:24:22',
                'updated_at' => '2018-06-04 04:24:22',
            ),
            2 => 
            array (
                'id' => 6,
                'name' => 'products-add',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 06:04:14',
                'updated_at' => '2018-06-04 06:04:14',
            ),
            3 => 
            array (
                'id' => 7,
                'name' => 'products-index',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 09:04:27',
                'updated_at' => '2018-06-04 09:04:27',
            ),
            4 => 
            array (
                'id' => 8,
                'name' => 'purchases-index',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 13:33:19',
                'updated_at' => '2018-06-04 13:33:19',
            ),
            5 => 
            array (
                'id' => 9,
                'name' => 'purchases-add',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 13:42:25',
                'updated_at' => '2018-06-04 13:42:25',
            ),
            6 => 
            array (
                'id' => 10,
                'name' => 'purchases-edit',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 15:17:36',
                'updated_at' => '2018-06-04 15:17:36',
            ),
            7 => 
            array (
                'id' => 11,
                'name' => 'purchases-delete',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 15:17:36',
                'updated_at' => '2018-06-04 15:17:36',
            ),
            8 => 
            array (
                'id' => 12,
                'name' => 'sales-index',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 16:19:08',
                'updated_at' => '2018-06-04 16:19:08',
            ),
            9 => 
            array (
                'id' => 13,
                'name' => 'sales-add',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 16:19:52',
                'updated_at' => '2018-06-04 16:19:52',
            ),
            10 => 
            array (
                'id' => 14,
                'name' => 'sales-edit',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 16:19:52',
                'updated_at' => '2018-06-04 16:19:52',
            ),
            11 => 
            array (
                'id' => 15,
                'name' => 'sales-delete',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 16:19:53',
                'updated_at' => '2018-06-04 16:19:53',
            ),
            12 => 
            array (
                'id' => 16,
                'name' => 'quotes-index',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 03:35:10',
                'updated_at' => '2018-06-05 03:35:10',
            ),
            13 => 
            array (
                'id' => 17,
                'name' => 'quotes-add',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 03:35:10',
                'updated_at' => '2018-06-05 03:35:10',
            ),
            14 => 
            array (
                'id' => 18,
                'name' => 'quotes-edit',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 03:35:10',
                'updated_at' => '2018-06-05 03:35:10',
            ),
            15 => 
            array (
                'id' => 19,
                'name' => 'quotes-delete',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 03:35:10',
                'updated_at' => '2018-06-05 03:35:10',
            ),
            16 => 
            array (
                'id' => 20,
                'name' => 'transfers-index',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:00:03',
                'updated_at' => '2018-06-05 04:00:03',
            ),
            17 => 
            array (
                'id' => 21,
                'name' => 'transfers-add',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:00:03',
                'updated_at' => '2018-06-05 04:00:03',
            ),
            18 => 
            array (
                'id' => 22,
                'name' => 'transfers-edit',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:00:03',
                'updated_at' => '2018-06-05 04:00:03',
            ),
            19 => 
            array (
                'id' => 23,
                'name' => 'transfers-delete',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:00:03',
                'updated_at' => '2018-06-05 04:00:03',
            ),
            20 => 
            array (
                'id' => 24,
                'name' => 'returns-index',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:20:24',
                'updated_at' => '2018-06-05 04:20:24',
            ),
            21 => 
            array (
                'id' => 25,
                'name' => 'returns-add',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:20:24',
                'updated_at' => '2018-06-05 04:20:24',
            ),
            22 => 
            array (
                'id' => 26,
                'name' => 'returns-edit',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:20:25',
                'updated_at' => '2018-06-05 04:20:25',
            ),
            23 => 
            array (
                'id' => 27,
                'name' => 'returns-delete',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:20:25',
                'updated_at' => '2018-06-05 04:20:25',
            ),
            24 => 
            array (
                'id' => 28,
                'name' => 'customers-index',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:45:54',
                'updated_at' => '2018-06-05 04:45:54',
            ),
            25 => 
            array (
                'id' => 29,
                'name' => 'customers-add',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:45:55',
                'updated_at' => '2018-06-05 04:45:55',
            ),
            26 => 
            array (
                'id' => 30,
                'name' => 'customers-edit',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:45:55',
                'updated_at' => '2018-06-05 04:45:55',
            ),
            27 => 
            array (
                'id' => 31,
                'name' => 'customers-delete',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 04:45:55',
                'updated_at' => '2018-06-05 04:45:55',
            ),
            28 => 
            array (
                'id' => 32,
                'name' => 'suppliers-index',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 05:10:12',
                'updated_at' => '2018-06-05 05:10:12',
            ),
            29 => 
            array (
                'id' => 33,
                'name' => 'suppliers-add',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 05:10:12',
                'updated_at' => '2018-06-05 05:10:12',
            ),
            30 => 
            array (
                'id' => 34,
                'name' => 'suppliers-edit',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 05:10:12',
                'updated_at' => '2018-06-05 05:10:12',
            ),
            31 => 
            array (
                'id' => 35,
                'name' => 'suppliers-delete',
                'guard_name' => 'web',
                'created_at' => '2018-06-05 05:10:12',
                'updated_at' => '2018-06-05 05:10:12',
            ),
            32 => 
            array (
                'id' => 36,
                'name' => 'product-report',
                'guard_name' => 'web',
                'created_at' => '2018-06-25 04:35:33',
                'updated_at' => '2018-06-25 04:35:33',
            ),
            33 => 
            array (
                'id' => 37,
                'name' => 'purchase-report',
                'guard_name' => 'web',
                'created_at' => '2018-06-25 04:54:56',
                'updated_at' => '2018-06-25 04:54:56',
            ),
            34 => 
            array (
                'id' => 38,
                'name' => 'sale-report',
                'guard_name' => 'web',
                'created_at' => '2018-06-25 05:03:13',
                'updated_at' => '2018-06-25 05:03:13',
            ),
            35 => 
            array (
                'id' => 39,
                'name' => 'customer-report',
                'guard_name' => 'web',
                'created_at' => '2018-06-25 05:06:51',
                'updated_at' => '2018-06-25 05:06:51',
            ),
            36 => 
            array (
                'id' => 40,
                'name' => 'due-report',
                'guard_name' => 'web',
                'created_at' => '2018-06-25 05:09:52',
                'updated_at' => '2018-06-25 05:09:52',
            ),
            37 => 
            array (
                'id' => 41,
                'name' => 'users-index',
                'guard_name' => 'web',
                'created_at' => '2018-06-25 05:30:10',
                'updated_at' => '2018-06-25 05:30:10',
            ),
            38 => 
            array (
                'id' => 42,
                'name' => 'users-add',
                'guard_name' => 'web',
                'created_at' => '2018-06-25 05:30:10',
                'updated_at' => '2018-06-25 05:30:10',
            ),
            39 => 
            array (
                'id' => 43,
                'name' => 'users-edit',
                'guard_name' => 'web',
                'created_at' => '2018-06-25 05:31:30',
                'updated_at' => '2018-06-25 05:31:30',
            ),
            40 => 
            array (
                'id' => 44,
                'name' => 'users-delete',
                'guard_name' => 'web',
                'created_at' => '2018-06-25 05:31:30',
                'updated_at' => '2018-06-25 05:31:30',
            ),
            41 => 
            array (
                'id' => 45,
                'name' => 'profit-loss',
                'guard_name' => 'web',
                'created_at' => '2018-07-15 03:20:05',
                'updated_at' => '2018-07-15 03:20:05',
            ),
            42 => 
            array (
                'id' => 46,
                'name' => 'best-seller',
                'guard_name' => 'web',
                'created_at' => '2018-07-15 03:31:38',
                'updated_at' => '2018-07-15 03:31:38',
            ),
            43 => 
            array (
                'id' => 47,
                'name' => 'daily-sale',
                'guard_name' => 'web',
                'created_at' => '2018-07-15 03:54:21',
                'updated_at' => '2018-07-15 03:54:21',
            ),
            44 => 
            array (
                'id' => 48,
                'name' => 'monthly-sale',
                'guard_name' => 'web',
                'created_at' => '2018-07-15 04:00:41',
                'updated_at' => '2018-07-15 04:00:41',
            ),
            45 => 
            array (
                'id' => 49,
                'name' => 'daily-purchase',
                'guard_name' => 'web',
                'created_at' => '2018-07-15 04:06:46',
                'updated_at' => '2018-07-15 04:06:46',
            ),
            46 => 
            array (
                'id' => 50,
                'name' => 'monthly-purchase',
                'guard_name' => 'web',
                'created_at' => '2018-07-15 04:18:17',
                'updated_at' => '2018-07-15 04:18:17',
            ),
            47 => 
            array (
                'id' => 51,
                'name' => 'payment-report',
                'guard_name' => 'web',
                'created_at' => '2018-07-15 04:40:41',
                'updated_at' => '2018-07-15 04:40:41',
            ),
            48 => 
            array (
                'id' => 52,
                'name' => 'warehouse-stock-report',
                'guard_name' => 'web',
                'created_at' => '2018-07-15 04:46:55',
                'updated_at' => '2018-07-15 04:46:55',
            ),
            49 => 
            array (
                'id' => 53,
                'name' => 'product-qty-alert',
                'guard_name' => 'web',
                'created_at' => '2018-07-15 05:03:21',
                'updated_at' => '2018-07-15 05:03:21',
            ),
            50 => 
            array (
                'id' => 54,
                'name' => 'supplier-report',
                'guard_name' => 'web',
                'created_at' => '2018-07-30 08:30:01',
                'updated_at' => '2018-07-30 08:30:01',
            ),
            51 => 
            array (
                'id' => 55,
                'name' => 'expenses-index',
                'guard_name' => 'web',
                'created_at' => '2018-09-05 06:37:10',
                'updated_at' => '2018-09-05 06:37:10',
            ),
            52 => 
            array (
                'id' => 56,
                'name' => 'expenses-add',
                'guard_name' => 'web',
                'created_at' => '2018-09-05 06:37:10',
                'updated_at' => '2018-09-05 06:37:10',
            ),
            53 => 
            array (
                'id' => 57,
                'name' => 'expenses-edit',
                'guard_name' => 'web',
                'created_at' => '2018-09-05 06:37:10',
                'updated_at' => '2018-09-05 06:37:10',
            ),
            54 => 
            array (
                'id' => 58,
                'name' => 'expenses-delete',
                'guard_name' => 'web',
                'created_at' => '2018-09-05 06:37:11',
                'updated_at' => '2018-09-05 06:37:11',
            ),
            55 => 
            array (
                'id' => 59,
                'name' => 'general_setting',
                'guard_name' => 'web',
                'created_at' => '2018-10-20 04:40:04',
                'updated_at' => '2018-10-20 04:40:04',
            ),
            56 => 
            array (
                'id' => 60,
                'name' => 'mail_setting',
                'guard_name' => 'web',
                'created_at' => '2018-10-20 04:40:04',
                'updated_at' => '2018-10-20 04:40:04',
            ),
            57 => 
            array (
                'id' => 61,
                'name' => 'pos_setting',
                'guard_name' => 'web',
                'created_at' => '2018-10-20 04:40:04',
                'updated_at' => '2018-10-20 04:40:04',
            ),
            58 => 
            array (
                'id' => 62,
                'name' => 'hrm_setting',
                'guard_name' => 'web',
                'created_at' => '2019-01-02 16:00:23',
                'updated_at' => '2019-01-02 16:00:23',
            ),
            59 => 
            array (
                'id' => 63,
                'name' => 'purchase-return-index',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 03:15:14',
                'updated_at' => '2019-01-03 03:15:14',
            ),
            60 => 
            array (
                'id' => 64,
                'name' => 'purchase-return-add',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 03:15:14',
                'updated_at' => '2019-01-03 03:15:14',
            ),
            61 => 
            array (
                'id' => 65,
                'name' => 'purchase-return-edit',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 03:15:14',
                'updated_at' => '2019-01-03 03:15:14',
            ),
            62 => 
            array (
                'id' => 66,
                'name' => 'purchase-return-delete',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 03:15:14',
                'updated_at' => '2019-01-03 03:15:14',
            ),
            63 => 
            array (
                'id' => 67,
                'name' => 'account-index',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 03:36:13',
                'updated_at' => '2019-01-03 03:36:13',
            ),
            64 => 
            array (
                'id' => 68,
                'name' => 'balance-sheet',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 03:36:14',
                'updated_at' => '2019-01-03 03:36:14',
            ),
            65 => 
            array (
                'id' => 69,
                'name' => 'account-statement',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 03:36:14',
                'updated_at' => '2019-01-03 03:36:14',
            ),
            66 => 
            array (
                'id' => 70,
                'name' => 'department',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 04:00:01',
                'updated_at' => '2019-01-03 04:00:01',
            ),
            67 => 
            array (
                'id' => 71,
                'name' => 'attendance',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 04:00:01',
                'updated_at' => '2019-01-03 04:00:01',
            ),
            68 => 
            array (
                'id' => 72,
                'name' => 'payroll',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 04:00:01',
                'updated_at' => '2019-01-03 04:00:01',
            ),
            69 => 
            array (
                'id' => 73,
                'name' => 'employees-index',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 04:22:19',
                'updated_at' => '2019-01-03 04:22:19',
            ),
            70 => 
            array (
                'id' => 74,
                'name' => 'employees-add',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 04:22:19',
                'updated_at' => '2019-01-03 04:22:19',
            ),
            71 => 
            array (
                'id' => 75,
                'name' => 'employees-edit',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 04:22:19',
                'updated_at' => '2019-01-03 04:22:19',
            ),
            72 => 
            array (
                'id' => 76,
                'name' => 'employees-delete',
                'guard_name' => 'web',
                'created_at' => '2019-01-03 04:22:19',
                'updated_at' => '2019-01-03 04:22:19',
            ),
            73 => 
            array (
                'id' => 77,
                'name' => 'user-report',
                'guard_name' => 'web',
                'created_at' => '2019-01-16 12:18:18',
                'updated_at' => '2019-01-16 12:18:18',
            ),
            74 => 
            array (
                'id' => 78,
                'name' => 'stock_count',
                'guard_name' => 'web',
                'created_at' => '2019-02-17 16:02:01',
                'updated_at' => '2019-02-17 16:02:01',
            ),
            75 => 
            array (
                'id' => 79,
                'name' => 'adjustment',
                'guard_name' => 'web',
                'created_at' => '2019-02-17 16:02:02',
                'updated_at' => '2019-02-17 16:02:02',
            ),
            76 => 
            array (
                'id' => 80,
                'name' => 'sms_setting',
                'guard_name' => 'web',
                'created_at' => '2019-02-22 10:48:03',
                'updated_at' => '2019-02-22 10:48:03',
            ),
            77 => 
            array (
                'id' => 81,
                'name' => 'create_sms',
                'guard_name' => 'web',
                'created_at' => '2019-02-22 10:48:03',
                'updated_at' => '2019-02-22 10:48:03',
            ),
            78 => 
            array (
                'id' => 82,
                'name' => 'print_barcode',
                'guard_name' => 'web',
                'created_at' => '2019-03-07 10:32:19',
                'updated_at' => '2019-03-07 10:32:19',
            ),
            79 => 
            array (
                'id' => 83,
                'name' => 'empty_database',
                'guard_name' => 'web',
                'created_at' => '2019-03-07 10:32:19',
                'updated_at' => '2019-03-07 10:32:19',
            ),
            80 => 
            array (
                'id' => 84,
                'name' => 'customer_group',
                'guard_name' => 'web',
                'created_at' => '2019-03-07 11:07:15',
                'updated_at' => '2019-03-07 11:07:15',
            ),
            81 => 
            array (
                'id' => 85,
                'name' => 'unit',
                'guard_name' => 'web',
                'created_at' => '2019-03-07 11:07:15',
                'updated_at' => '2019-03-07 11:07:15',
            ),
            82 => 
            array (
                'id' => 86,
                'name' => 'tax',
                'guard_name' => 'web',
                'created_at' => '2019-03-07 11:07:15',
                'updated_at' => '2019-03-07 11:07:15',
            ),
            83 => 
            array (
                'id' => 87,
                'name' => 'gift_card',
                'guard_name' => 'web',
                'created_at' => '2019-03-07 11:59:38',
                'updated_at' => '2019-03-07 11:59:38',
            ),
            84 => 
            array (
                'id' => 88,
                'name' => 'coupon',
                'guard_name' => 'web',
                'created_at' => '2019-03-07 11:59:38',
                'updated_at' => '2019-03-07 11:59:38',
            ),
            85 => 
            array (
                'id' => 89,
                'name' => 'holiday',
                'guard_name' => 'web',
                'created_at' => '2019-10-19 14:27:15',
                'updated_at' => '2019-10-19 14:27:15',
            ),
            86 => 
            array (
                'id' => 90,
                'name' => 'warehouse-report',
                'guard_name' => 'web',
                'created_at' => '2019-10-22 11:30:23',
                'updated_at' => '2019-10-22 11:30:23',
            ),
            87 => 
            array (
                'id' => 91,
                'name' => 'warehouse',
                'guard_name' => 'web',
                'created_at' => '2020-02-26 12:17:32',
                'updated_at' => '2020-02-26 12:17:32',
            ),
            88 => 
            array (
                'id' => 92,
                'name' => 'brand',
                'guard_name' => 'web',
                'created_at' => '2020-02-26 12:29:59',
                'updated_at' => '2020-02-26 12:29:59',
            ),
            89 => 
            array (
                'id' => 93,
                'name' => 'billers-index',
                'guard_name' => 'web',
                'created_at' => '2020-02-26 12:41:15',
                'updated_at' => '2020-02-26 12:41:15',
            ),
            90 => 
            array (
                'id' => 94,
                'name' => 'billers-add',
                'guard_name' => 'web',
                'created_at' => '2020-02-26 12:41:15',
                'updated_at' => '2020-02-26 12:41:15',
            ),
            91 => 
            array (
                'id' => 95,
                'name' => 'billers-edit',
                'guard_name' => 'web',
                'created_at' => '2020-02-26 12:41:15',
                'updated_at' => '2020-02-26 12:41:15',
            ),
            92 => 
            array (
                'id' => 96,
                'name' => 'billers-delete',
                'guard_name' => 'web',
                'created_at' => '2020-02-26 12:41:15',
                'updated_at' => '2020-02-26 12:41:15',
            ),
            93 => 
            array (
                'id' => 97,
                'name' => 'money-transfer',
                'guard_name' => 'web',
                'created_at' => '2020-03-02 11:11:48',
                'updated_at' => '2020-03-02 11:11:48',
            ),
            94 => 
            array (
                'id' => 98,
                'name' => 'category',
                'guard_name' => 'web',
                'created_at' => '2020-07-13 17:43:16',
                'updated_at' => '2020-07-13 17:43:16',
            ),
            95 => 
            array (
                'id' => 99,
                'name' => 'delivery',
                'guard_name' => 'web',
                'created_at' => '2020-07-13 17:43:16',
                'updated_at' => '2020-07-13 17:43:16',
            ),
            96 => 
            array (
                'id' => 100,
                'name' => 'send_notification',
                'guard_name' => 'web',
                'created_at' => '2020-10-31 11:51:31',
                'updated_at' => '2020-10-31 11:51:31',
            ),
            97 => 
            array (
                'id' => 101,
                'name' => 'today_sale',
                'guard_name' => 'web',
                'created_at' => '2020-10-31 12:27:04',
                'updated_at' => '2020-10-31 12:27:04',
            ),
            98 => 
            array (
                'id' => 102,
                'name' => 'today_profit',
                'guard_name' => 'web',
                'created_at' => '2020-10-31 12:27:04',
                'updated_at' => '2020-10-31 12:27:04',
            ),
            99 => 
            array (
                'id' => 103,
                'name' => 'currency',
                'guard_name' => 'web',
                'created_at' => '2020-11-09 05:53:11',
                'updated_at' => '2020-11-09 05:53:11',
            ),
            100 => 
            array (
                'id' => 104,
                'name' => 'backup_database',
                'guard_name' => 'web',
                'created_at' => '2020-11-15 05:46:55',
                'updated_at' => '2020-11-15 05:46:55',
            ),
            101 => 
            array (
                'id' => 105,
                'name' => 'reward_point_setting',
                'guard_name' => 'web',
                'created_at' => '2021-06-27 10:04:42',
                'updated_at' => '2021-06-27 10:04:42',
            ),
            102 => 
            array (
                'id' => 106,
                'name' => 'store-outlet-index',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            103 => 
            array (
                'id' => 107,
                'name' => 'store-outlet-edit',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'id' => 108,
                'name' => 'outlet-setup',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'id' => 109,
                'name' => 'user-management',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            106 => 
            array (
                'id' => 110,
                'name' => 'vendor-login',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            107 => 
            array (
                'id' => 111,
                'name' => 'secure-login',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            108 => 
            array (
                'id' => 112,
                'name' => 'enquiry-management',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            109 => 
            array (
                'id' => 113,
                'name' => 'add-enquiry',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            110 => 
            array (
                'id' => 114,
                'name' => 'customer-management',
                'guard_name' => 'web
',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'id' => 115,
                'name' => 'enquiry-index',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'id' => 116,
                'name' => 'enquiry-add',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            113 => 
            array (
                'id' => 117,
                'name' => 'enquiry-edit',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            114 => 
            array (
                'id' => 118,
                'name' => 'enquiry-delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            115 => 
            array (
                'id' => 119,
                'name' => 'vendorproducts-edit',
                'guard_name' => 'web',
                'created_at' => '2018-06-03 06:30:09',
                'updated_at' => '2018-06-03 06:30:09',
            ),
            116 => 
            array (
                'id' => 120,
                'name' => 'vendorproducts-delete',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 04:24:22',
                'updated_at' => '2018-06-04 04:24:22',
            ),
            117 => 
            array (
                'id' => 121,
                'name' => 'vendorproducts-add',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 06:04:14',
                'updated_at' => '2018-06-04 06:04:14',
            ),
            118 => 
            array (
                'id' => 122,
                'name' => 'vendorproducts-index',
                'guard_name' => 'web',
                'created_at' => '2018-06-04 09:04:27',
                'updated_at' => '2018-06-04 09:04:27',
            ),
            119 => 
            array (
                'id' => 123,
                'name' => 'vendorproduct-report',
                'guard_name' => 'web',
                'created_at' => '2018-06-25 04:35:33',
                'updated_at' => '2018-06-25 04:35:33',
            ),
            120 => 
            array (
                'id' => 124,
                'name' => 'vendorproduct-qty-alert',
                'guard_name' => 'web',
                'created_at' => '2018-07-15 05:03:21',
                'updated_at' => '2018-07-15 05:03:21',
            ),
            121 => 
            array (
                'id' => 125,
                'name' => 'allvendorproductslist-index',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            122 => 
            array (
                'id' => 130,
                'name' => 'vendor-dashboard-index',
                'guard_name' => 'web',
                'created_at' => '2022-03-05 19:09:10',
                'updated_at' => '2022-03-05 19:09:10',
            ),
            123 => 
            array (
                'id' => 131,
                'name' => 'vendor-dashboard-add',
                'guard_name' => 'web',
                'created_at' => '2022-03-05 19:09:11',
                'updated_at' => '2022-03-05 19:09:11',
            ),
            124 => 
            array (
                'id' => 133,
                'name' => 'vendor-dashboard-add',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            125 => 
            array (
                'id' => 134,
                'name' => 'vendor-dashboard-edit',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            126 => 
            array (
                'id' => 135,
                'name' => 'vendor-dashboard-delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            127 => 
            array (
                'id' => 136,
                'name' => 'attribute-index',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            128 => 
            array (
                'id' => 137,
                'name' => 'attribute-add',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            129 => 
            array (
                'id' => 138,
                'name' => 'attribute-edit',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            130 => 
            array (
                'id' => 139,
                'name' => 'attribute-delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            131 => 
            array (
                'id' => 140,
                'name' => 'user-profile',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            132 => 
            array (
                'id' => 141,
                'name' => 'vendor-approval-index',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
           
            133 => 
            array (
                'id' => 142,
                'name' => 'accounts-date-index',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            134 => 
            array (
                'id' => 143,
                'name' => 'accounts-date-add',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            135 => 
            array (
                'id' => 144,
                'name' => 'accounts-date-edit',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            136 => 
            array (
                'id' => 145,
                'name' => 'accounts-date-delete',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            137 => 
            array (
                'id' => 146,
                'name' => 'role_permission',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            138 => 
            array (
                'id' => 147,
                'name' => 'customer_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            139 => 
            array (
                'id' => 148,
                'name' => 'sale_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            140 => 
            array (
                'id' => 149,
                'name' => 'category_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            141 => 
            array (
                'id' => 150,
                'name' => 'product_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            142 => 
            array (
                'id' => 151,
                'name' => 'supplier_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            143 => 
            array (
                'id' => 152,
                'name' => 'purchases_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            144 => 
            array (
                'id' => 153,
                'name' => 'transfers_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            145 => 
            array (
                'id' => 154,
                'name' => 'biller_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            146 => 
            array (
                'id' => 155,
                'name' => 'outlet_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            147 => 
            array (
                'id' => 156,
                'name' => 'customer_group_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),

            148 => 
            array (
                'id' => 157,
                'name' => 'brand_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            149 => 
            array (
                'id' => 158,
                'name' => 'unit_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            150 => 
            array (
                'id' => 159,
                'name' => 'tax_import',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            
            
            

            
    ));
    }
}