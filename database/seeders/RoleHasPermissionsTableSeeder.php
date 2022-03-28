<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 4,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 4,
                'role_id' => 2,
            ),
            2 => 
            array (
                'permission_id' => 4,
                'role_id' => 4,
            ),
            3 => 
            array (
                'permission_id' => 4,
                'role_id' => 5,
            ),
            4 => 
            array (
                'permission_id' => 5,
                'role_id' => 1,
            ),
            5 => 
            array (
                'permission_id' => 5,
                'role_id' => 2,
            ),
            6 => 
            array (
                'permission_id' => 5,
                'role_id' => 5,
            ),
            7 => 
            array (
                'permission_id' => 6,
                'role_id' => 1,
            ),
            8 => 
            array (
                'permission_id' => 6,
                'role_id' => 2,
            ),
            9 => 
            array (
                'permission_id' => 6,
                'role_id' => 4,
            ),
            10 => 
            array (
                'permission_id' => 6,
                'role_id' => 5,
            ),
            11 => 
            array (
                'permission_id' => 7,
                'role_id' => 1,
            ),
            12 => 
            array (
                'permission_id' => 7,
                'role_id' => 2,
            ),
            13 => 
            array (
                'permission_id' => 7,
                'role_id' => 4,
            ),
            14 => 
            array (
                'permission_id' => 7,
                'role_id' => 5,
            ),
            15 => 
            array (
                'permission_id' => 8,
                'role_id' => 1,
            ),
            16 => 
            array (
                'permission_id' => 8,
                'role_id' => 2,
            ),
            17 => 
            array (
                'permission_id' => 8,
                'role_id' => 4,
            ),
            18 => 
            array (
                'permission_id' => 8,
                'role_id' => 5,
            ),
            19 => 
            array (
                'permission_id' => 9,
                'role_id' => 1,
            ),
            20 => 
            array (
                'permission_id' => 9,
                'role_id' => 2,
            ),
            21 => 
            array (
                'permission_id' => 9,
                'role_id' => 4,
            ),
            22 => 
            array (
                'permission_id' => 9,
                'role_id' => 5,
            ),
            23 => 
            array (
                'permission_id' => 10,
                'role_id' => 1,
            ),
            24 => 
            array (
                'permission_id' => 10,
                'role_id' => 2,
            ),
            25 => 
            array (
                'permission_id' => 10,
                'role_id' => 5,
            ),
            26 => 
            array (
                'permission_id' => 11,
                'role_id' => 1,
            ),
            27 => 
            array (
                'permission_id' => 11,
                'role_id' => 2,
            ),
            28 => 
            array (
                'permission_id' => 11,
                'role_id' => 5,
            ),
            29 => 
            array (
                'permission_id' => 12,
                'role_id' => 1,
            ),
            30 => 
            array (
                'permission_id' => 12,
                'role_id' => 2,
            ),
            31 => 
            array (
                'permission_id' => 12,
                'role_id' => 3,
            ),
            32 => 
            array (
                'permission_id' => 12,
                'role_id' => 4,
            ),
            33 => 
            array (
                'permission_id' => 12,
                'role_id' => 5,
            ),
            34 => 
            array (
                'permission_id' => 12,
                'role_id' => 7,
            ),
            35 => 
            array (
                'permission_id' => 13,
                'role_id' => 1,
            ),
            36 => 
            array (
                'permission_id' => 13,
                'role_id' => 2,
            ),
            37 => 
            array (
                'permission_id' => 13,
                'role_id' => 3,
            ),
            38 => 
            array (
                'permission_id' => 13,
                'role_id' => 4,
            ),
            39 => 
            array (
                'permission_id' => 13,
                'role_id' => 5,
            ),
            40 => 
            array (
                'permission_id' => 13,
                'role_id' => 7,
            ),
            41 => 
            array (
                'permission_id' => 14,
                'role_id' => 1,
            ),
            42 => 
            array (
                'permission_id' => 14,
                'role_id' => 2,
            ),
            43 => 
            array (
                'permission_id' => 14,
                'role_id' => 3,
            ),
            44 => 
            array (
                'permission_id' => 14,
                'role_id' => 5,
            ),
            45 => 
            array (
                'permission_id' => 14,
                'role_id' => 7,
            ),
            46 => 
            array (
                'permission_id' => 15,
                'role_id' => 1,
            ),
            47 => 
            array (
                'permission_id' => 15,
                'role_id' => 2,
            ),
            48 => 
            array (
                'permission_id' => 15,
                'role_id' => 3,
            ),
            49 => 
            array (
                'permission_id' => 15,
                'role_id' => 5,
            ),
            50 => 
            array (
                'permission_id' => 15,
                'role_id' => 7,
            ),
            51 => 
            array (
                'permission_id' => 16,
                'role_id' => 5,
            ),
            52 => 
            array (
                'permission_id' => 17,
                'role_id' => 5,
            ),
            53 => 
            array (
                'permission_id' => 18,
                'role_id' => 5,
            ),
            54 => 
            array (
                'permission_id' => 19,
                'role_id' => 5,
            ),
            55 => 
            array (
                'permission_id' => 20,
                'role_id' => 4,
            ),
            56 => 
            array (
                'permission_id' => 20,
                'role_id' => 5,
            ),
            57 => 
            array (
                'permission_id' => 21,
                'role_id' => 4,
            ),
            58 => 
            array (
                'permission_id' => 21,
                'role_id' => 5,
            ),
            59 => 
            array (
                'permission_id' => 22,
                'role_id' => 4,
            ),
            60 => 
            array (
                'permission_id' => 22,
                'role_id' => 5,
            ),
            61 => 
            array (
                'permission_id' => 23,
                'role_id' => 5,
            ),
            62 => 
            array (
                'permission_id' => 24,
                'role_id' => 1,
            ),
            63 => 
            array (
                'permission_id' => 24,
                'role_id' => 4,
            ),
            64 => 
            array (
                'permission_id' => 24,
                'role_id' => 5,
            ),
            65 => 
            array (
                'permission_id' => 25,
                'role_id' => 4,
            ),
            66 => 
            array (
                'permission_id' => 25,
                'role_id' => 5,
            ),
            67 => 
            array (
                'permission_id' => 26,
                'role_id' => 5,
            ),
            68 => 
            array (
                'permission_id' => 27,
                'role_id' => 5,
            ),
            69 => 
            array (
                'permission_id' => 28,
                'role_id' => 1,
            ),
            70 => 
            array (
                'permission_id' => 28,
                'role_id' => 2,
            ),
            71 => 
            array (
                'permission_id' => 28,
                'role_id' => 4,
            ),
            72 => 
            array (
                'permission_id' => 28,
                'role_id' => 5,
            ),
            73 => 
            array (
                'permission_id' => 28,
                'role_id' => 7,
            ),
            74 => 
            array (
                'permission_id' => 29,
                'role_id' => 1,
            ),
            75 => 
            array (
                'permission_id' => 29,
                'role_id' => 2,
            ),
            76 => 
            array (
                'permission_id' => 29,
                'role_id' => 4,
            ),
            77 => 
            array (
                'permission_id' => 29,
                'role_id' => 5,
            ),
            78 => 
            array (
                'permission_id' => 29,
                'role_id' => 7,
            ),
            79 => 
            array (
                'permission_id' => 30,
                'role_id' => 1,
            ),
            80 => 
            array (
                'permission_id' => 30,
                'role_id' => 2,
            ),
            81 => 
            array (
                'permission_id' => 30,
                'role_id' => 5,
            ),
            82 => 
            array (
                'permission_id' => 30,
                'role_id' => 7,
            ),
            83 => 
            array (
                'permission_id' => 31,
                'role_id' => 1,
            ),
            84 => 
            array (
                'permission_id' => 31,
                'role_id' => 2,
            ),
            85 => 
            array (
                'permission_id' => 31,
                'role_id' => 5,
            ),
            86 => 
            array (
                'permission_id' => 31,
                'role_id' => 7,
            ),
            87 => 
            array (
                'permission_id' => 32,
                'role_id' => 1,
            ),
            88 => 
            array (
                'permission_id' => 32,
                'role_id' => 2,
            ),
            89 => 
            array (
                'permission_id' => 32,
                'role_id' => 5,
            ),
            90 => 
            array (
                'permission_id' => 33,
                'role_id' => 1,
            ),
            91 => 
            array (
                'permission_id' => 33,
                'role_id' => 2,
            ),
            92 => 
            array (
                'permission_id' => 33,
                'role_id' => 5,
            ),
            93 => 
            array (
                'permission_id' => 34,
                'role_id' => 1,
            ),
            94 => 
            array (
                'permission_id' => 34,
                'role_id' => 2,
            ),
            95 => 
            array (
                'permission_id' => 34,
                'role_id' => 5,
            ),
            96 => 
            array (
                'permission_id' => 35,
                'role_id' => 1,
            ),
            97 => 
            array (
                'permission_id' => 35,
                'role_id' => 2,
            ),
            98 => 
            array (
                'permission_id' => 35,
                'role_id' => 5,
            ),
            99 => 
            array (
                'permission_id' => 36,
                'role_id' => 2,
            ),
            100 => 
            array (
                'permission_id' => 36,
                'role_id' => 5,
            ),
            101 => 
            array (
                'permission_id' => 37,
                'role_id' => 2,
            ),
            102 => 
            array (
                'permission_id' => 37,
                'role_id' => 5,
            ),
            103 => 
            array (
                'permission_id' => 38,
                'role_id' => 2,
            ),
            104 => 
            array (
                'permission_id' => 38,
                'role_id' => 5,
            ),
            105 => 
            array (
                'permission_id' => 38,
                'role_id' => 7,
            ),
            106 => 
            array (
                'permission_id' => 39,
                'role_id' => 2,
            ),
            107 => 
            array (
                'permission_id' => 39,
                'role_id' => 5,
            ),
            108 => 
            array (
                'permission_id' => 39,
                'role_id' => 7,
            ),
            109 => 
            array (
                'permission_id' => 40,
                'role_id' => 2,
            ),
            110 => 
            array (
                'permission_id' => 40,
                'role_id' => 5,
            ),
            111 => 
            array (
                'permission_id' => 41,
                'role_id' => 1,
            ),
            112 => 
            array (
                'permission_id' => 41,
                'role_id' => 2,
            ),
            113 => 
            array (
                'permission_id' => 41,
                'role_id' => 5,
            ),
            114 => 
            array (
                'permission_id' => 41,
                'role_id' => 7,
            ),
            115 => 
            array (
                'permission_id' => 42,
                'role_id' => 1,
            ),
            116 => 
            array (
                'permission_id' => 42,
                'role_id' => 2,
            ),
            117 => 
            array (
                'permission_id' => 42,
                'role_id' => 5,
            ),
            118 => 
            array (
                'permission_id' => 42,
                'role_id' => 7,
            ),
            119 => 
            array (
                'permission_id' => 43,
                'role_id' => 1,
            ),
            120 => 
            array (
                'permission_id' => 43,
                'role_id' => 2,
            ),
            121 => 
            array (
                'permission_id' => 43,
                'role_id' => 5,
            ),
            122 => 
            array (
                'permission_id' => 43,
                'role_id' => 7,
            ),
            123 => 
            array (
                'permission_id' => 44,
                'role_id' => 1,
            ),
            124 => 
            array (
                'permission_id' => 44,
                'role_id' => 2,
            ),
            125 => 
            array (
                'permission_id' => 44,
                'role_id' => 5,
            ),
            126 => 
            array (
                'permission_id' => 44,
                'role_id' => 7,
            ),
            127 => 
            array (
                'permission_id' => 45,
                'role_id' => 2,
            ),
            128 => 
            array (
                'permission_id' => 45,
                'role_id' => 5,
            ),
            129 => 
            array (
                'permission_id' => 46,
                'role_id' => 2,
            ),
            130 => 
            array (
                'permission_id' => 46,
                'role_id' => 5,
            ),
            131 => 
            array (
                'permission_id' => 47,
                'role_id' => 2,
            ),
            132 => 
            array (
                'permission_id' => 47,
                'role_id' => 5,
            ),
            133 => 
            array (
                'permission_id' => 47,
                'role_id' => 7,
            ),
            134 => 
            array (
                'permission_id' => 48,
                'role_id' => 2,
            ),
            135 => 
            array (
                'permission_id' => 48,
                'role_id' => 5,
            ),
            136 => 
            array (
                'permission_id' => 49,
                'role_id' => 2,
            ),
            137 => 
            array (
                'permission_id' => 49,
                'role_id' => 5,
            ),
            138 => 
            array (
                'permission_id' => 50,
                'role_id' => 2,
            ),
            139 => 
            array (
                'permission_id' => 50,
                'role_id' => 5,
            ),
            140 => 
            array (
                'permission_id' => 51,
                'role_id' => 2,
            ),
            141 => 
            array (
                'permission_id' => 51,
                'role_id' => 5,
            ),
            142 => 
            array (
                'permission_id' => 52,
                'role_id' => 2,
            ),
            143 => 
            array (
                'permission_id' => 52,
                'role_id' => 5,
            ),
            144 => 
            array (
                'permission_id' => 53,
                'role_id' => 2,
            ),
            145 => 
            array (
                'permission_id' => 53,
                'role_id' => 5,
            ),
            146 => 
            array (
                'permission_id' => 54,
                'role_id' => 2,
            ),
            147 => 
            array (
                'permission_id' => 54,
                'role_id' => 5,
            ),
            148 => 
            array (
                'permission_id' => 55,
                'role_id' => 2,
            ),
            149 => 
            array (
                'permission_id' => 55,
                'role_id' => 4,
            ),
            150 => 
            array (
                'permission_id' => 55,
                'role_id' => 5,
            ),
            151 => 
            array (
                'permission_id' => 56,
                'role_id' => 2,
            ),
            152 => 
            array (
                'permission_id' => 56,
                'role_id' => 4,
            ),
            153 => 
            array (
                'permission_id' => 56,
                'role_id' => 5,
            ),
            154 => 
            array (
                'permission_id' => 57,
                'role_id' => 2,
            ),
            155 => 
            array (
                'permission_id' => 57,
                'role_id' => 4,
            ),
            156 => 
            array (
                'permission_id' => 57,
                'role_id' => 5,
            ),
            157 => 
            array (
                'permission_id' => 58,
                'role_id' => 2,
            ),
            158 => 
            array (
                'permission_id' => 58,
                'role_id' => 5,
            ),
            159 => 
            array (
                'permission_id' => 59,
                'role_id' => 1,
            ),
            160 => 
            array (
                'permission_id' => 59,
                'role_id' => 2,
            ),
            161 => 
            array (
                'permission_id' => 59,
                'role_id' => 5,
            ),
            162 => 
            array (
                'permission_id' => 59,
                'role_id' => 7,
            ),
            163 => 
            array (
                'permission_id' => 60,
                'role_id' => 2,
            ),
            164 => 
            array (
                'permission_id' => 60,
                'role_id' => 5,
            ),
            165 => 
            array (
                'permission_id' => 60,
                'role_id' => 7,
            ),
            166 => 
            array (
                'permission_id' => 61,
                'role_id' => 5,
            ),
            167 => 
            array (
                'permission_id' => 61,
                'role_id' => 7,
            ),
            168 => 
            array (
                'permission_id' => 62,
                'role_id' => 5,
            ),
            169 => 
            array (
                'permission_id' => 63,
                'role_id' => 4,
            ),
            170 => 
            array (
                'permission_id' => 63,
                'role_id' => 5,
            ),
            171 => 
            array (
                'permission_id' => 64,
                'role_id' => 4,
            ),
            172 => 
            array (
                'permission_id' => 64,
                'role_id' => 5,
            ),
            173 => 
            array (
                'permission_id' => 65,
                'role_id' => 5,
            ),
            174 => 
            array (
                'permission_id' => 66,
                'role_id' => 5,
            ),
            175 => 
            array (
                'permission_id' => 67,
                'role_id' => 5,
            ),
            176 => 
            array (
                'permission_id' => 68,
                'role_id' => 2,
            ),
            177 => 
            array (
                'permission_id' => 68,
                'role_id' => 5,
            ),
            178 => 
            array (
                'permission_id' => 69,
                'role_id' => 2,
            ),
            179 => 
            array (
                'permission_id' => 69,
                'role_id' => 5,
            ),
            180 => 
            array (
                'permission_id' => 70,
                'role_id' => 5,
            ),
            181 => 
            array (
                'permission_id' => 71,
                'role_id' => 5,
            ),
            182 => 
            array (
                'permission_id' => 72,
                'role_id' => 5,
            ),
            183 => 
            array (
                'permission_id' => 73,
                'role_id' => 1,
            ),
            184 => 
            array (
                'permission_id' => 73,
                'role_id' => 2,
            ),
            185 => 
            array (
                'permission_id' => 73,
                'role_id' => 5,
            ),
            186 => 
            array (
                'permission_id' => 73,
                'role_id' => 7,
            ),
            187 => 
            array (
                'permission_id' => 74,
                'role_id' => 1,
            ),
            188 => 
            array (
                'permission_id' => 74,
                'role_id' => 2,
            ),
            189 => 
            array (
                'permission_id' => 74,
                'role_id' => 5,
            ),
            190 => 
            array (
                'permission_id' => 74,
                'role_id' => 7,
            ),
            191 => 
            array (
                'permission_id' => 75,
                'role_id' => 1,
            ),
            192 => 
            array (
                'permission_id' => 75,
                'role_id' => 2,
            ),
            193 => 
            array (
                'permission_id' => 75,
                'role_id' => 5,
            ),
            194 => 
            array (
                'permission_id' => 75,
                'role_id' => 7,
            ),
            195 => 
            array (
                'permission_id' => 76,
                'role_id' => 1,
            ),
            196 => 
            array (
                'permission_id' => 76,
                'role_id' => 2,
            ),
            197 => 
            array (
                'permission_id' => 76,
                'role_id' => 5,
            ),
            198 => 
            array (
                'permission_id' => 76,
                'role_id' => 7,
            ),
            199 => 
            array (
                'permission_id' => 77,
                'role_id' => 2,
            ),
            200 => 
            array (
                'permission_id' => 77,
                'role_id' => 5,
            ),
            201 => 
            array (
                'permission_id' => 78,
                'role_id' => 1,
            ),
            202 => 
            array (
                'permission_id' => 78,
                'role_id' => 5,
            ),
            203 => 
            array (
                'permission_id' => 79,
                'role_id' => 5,
            ),
            204 => 
            array (
                'permission_id' => 80,
                'role_id' => 2,
            ),
            205 => 
            array (
                'permission_id' => 80,
                'role_id' => 5,
            ),
            206 => 
            array (
                'permission_id' => 81,
                'role_id' => 2,
            ),
            207 => 
            array (
                'permission_id' => 81,
                'role_id' => 5,
            ),
            208 => 
            array (
                'permission_id' => 82,
                'role_id' => 2,
            ),
            209 => 
            array (
                'permission_id' => 82,
                'role_id' => 5,
            ),
            210 => 
            array (
                'permission_id' => 83,
                'role_id' => 5,
            ),
            211 => 
            array (
                'permission_id' => 84,
                'role_id' => 1,
            ),
            212 => 
            array (
                'permission_id' => 84,
                'role_id' => 2,
            ),
            213 => 
            array (
                'permission_id' => 84,
                'role_id' => 5,
            ),
            214 => 
            array (
                'permission_id' => 84,
                'role_id' => 7,
            ),
            215 => 
            array (
                'permission_id' => 85,
                'role_id' => 1,
            ),
            216 => 
            array (
                'permission_id' => 85,
                'role_id' => 2,
            ),
            217 => 
            array (
                'permission_id' => 85,
                'role_id' => 5,
            ),
            218 => 
            array (
                'permission_id' => 85,
                'role_id' => 7,
            ),
            219 => 
            array (
                'permission_id' => 86,
                'role_id' => 1,
            ),
            220 => 
            array (
                'permission_id' => 86,
                'role_id' => 2,
            ),
            221 => 
            array (
                'permission_id' => 86,
                'role_id' => 5,
            ),
            222 => 
            array (
                'permission_id' => 86,
                'role_id' => 7,
            ),
            223 => 
            array (
                'permission_id' => 87,
                'role_id' => 5,
            ),
            224 => 
            array (
                'permission_id' => 88,
                'role_id' => 2,
            ),
            225 => 
            array (
                'permission_id' => 88,
                'role_id' => 5,
            ),
            226 => 
            array (
                'permission_id' => 89,
                'role_id' => 5,
            ),
            227 => 
            array (
                'permission_id' => 90,
                'role_id' => 2,
            ),
            228 => 
            array (
                'permission_id' => 90,
                'role_id' => 5,
            ),
            229 => 
            array (
                'permission_id' => 91,
                'role_id' => 1,
            ),
            230 => 
            array (
                'permission_id' => 91,
                'role_id' => 2,
            ),
            231 => 
            array (
                'permission_id' => 91,
                'role_id' => 5,
            ),
            232 => 
            array (
                'permission_id' => 91,
                'role_id' => 7,
            ),
            233 => 
            array (
                'permission_id' => 92,
                'role_id' => 1,
            ),
            234 => 
            array (
                'permission_id' => 92,
                'role_id' => 2,
            ),
            235 => 
            array (
                'permission_id' => 92,
                'role_id' => 5,
            ),
            236 => 
            array (
                'permission_id' => 92,
                'role_id' => 7,
            ),
            237 => 
            array (
                'permission_id' => 93,
                'role_id' => 1,
            ),
            238 => 
            array (
                'permission_id' => 93,
                'role_id' => 2,
            ),
            239 => 
            array (
                'permission_id' => 93,
                'role_id' => 5,
            ),
            240 => 
            array (
                'permission_id' => 94,
                'role_id' => 1,
            ),
            241 => 
            array (
                'permission_id' => 94,
                'role_id' => 2,
            ),
            242 => 
            array (
                'permission_id' => 94,
                'role_id' => 5,
            ),
            243 => 
            array (
                'permission_id' => 95,
                'role_id' => 1,
            ),
            244 => 
            array (
                'permission_id' => 95,
                'role_id' => 2,
            ),
            245 => 
            array (
                'permission_id' => 95,
                'role_id' => 5,
            ),
            246 => 
            array (
                'permission_id' => 96,
                'role_id' => 1,
            ),
            247 => 
            array (
                'permission_id' => 96,
                'role_id' => 2,
            ),
            248 => 
            array (
                'permission_id' => 96,
                'role_id' => 5,
            ),
            249 => 
            array (
                'permission_id' => 97,
                'role_id' => 5,
            ),
            250 => 
            array (
                'permission_id' => 98,
                'role_id' => 1,
            ),
            251 => 
            array (
                'permission_id' => 98,
                'role_id' => 2,
            ),
            252 => 
            array (
                'permission_id' => 98,
                'role_id' => 5,
            ),
            253 => 
            array (
                'permission_id' => 99,
                'role_id' => 5,
            ),
            254 => 
            array (
                'permission_id' => 100,
                'role_id' => 2,
            ),
            255 => 
            array (
                'permission_id' => 100,
                'role_id' => 5,
            ),
            256 => 
            array (
                'permission_id' => 100,
                'role_id' => 7,
            ),
            257 => 
            array (
                'permission_id' => 101,
                'role_id' => 2,
            ),
            258 => 
            array (
                'permission_id' => 101,
                'role_id' => 5,
            ),
            259 => 
            array (
                'permission_id' => 102,
                'role_id' => 2,
            ),
            260 => 
            array (
                'permission_id' => 102,
                'role_id' => 5,
            ),
            261 => 
            array (
                'permission_id' => 103,
                'role_id' => 1,
            ),
            262 => 
            array (
                'permission_id' => 103,
                'role_id' => 2,
            ),
            263 => 
            array (
                'permission_id' => 103,
                'role_id' => 5,
            ),
            264 => 
            array (
                'permission_id' => 104,
                'role_id' => 5,
            ),
            265 => 
            array (
                'permission_id' => 105,
                'role_id' => 5,
            ),
            266 => 
            array (
                'permission_id' => 106,
                'role_id' => 1,
            ),
            267 => 
            array (
                'permission_id' => 107,
                'role_id' => 1,
            ),
            268 => 
            array (
                'permission_id' => 108,
                'role_id' => 1,
            ),
            269 => 
            array (
                'permission_id' => 109,
                'role_id' => 1,
            ),
            270 => 
            array (
                'permission_id' => 110,
                'role_id' => 1,
            ),
            271 => 
            array (
                'permission_id' => 111,
                'role_id' => 1,
            ),
            272 => 
            array (
                'permission_id' => 112,
                'role_id' => 1,
            ),
            273 => 
            array (
                'permission_id' => 113,
                'role_id' => 1,
            ),
            274 => 
            array (
                'permission_id' => 114,
                'role_id' => 1,
            ),
            275 => 
            array (
                'permission_id' => 115,
                'role_id' => 1,
            ),
            276 => 
            array (
                'permission_id' => 115,
                'role_id' => 2,
            ),
            277 => 
            array (
                'permission_id' => 115,
                'role_id' => 7,
            ),
            278 => 
            array (
                'permission_id' => 116,
                'role_id' => 1,
            ),
            279 => 
            array (
                'permission_id' => 116,
                'role_id' => 2,
            ),
            280 => 
            array (
                'permission_id' => 116,
                'role_id' => 7,
            ),
            281 => 
            array (
                'permission_id' => 117,
                'role_id' => 1,
            ),
            282 => 
            array (
                'permission_id' => 117,
                'role_id' => 2,
            ),
            283 => 
            array (
                'permission_id' => 117,
                'role_id' => 7,
            ),
            284 => 
            array (
                'permission_id' => 118,
                'role_id' => 1,
            ),
            285 => 
            array (
                'permission_id' => 118,
                'role_id' => 2,
            ),
            286 => 
            array (
                'permission_id' => 118,
                'role_id' => 7,
            ),
            287 => 
            array (
                'permission_id' => 119,
                'role_id' => 1,
            ),
            288 => 
            array (
                'permission_id' => 119,
                'role_id' => 2,
            ),
            289 => 
            array (
                'permission_id' => 119,
                'role_id' => 5,
            ),
            290 => 
            array (
                'permission_id' => 119,
                'role_id' => 6,
            ),
            291 => 
            array (
                'permission_id' => 120,
                'role_id' => 1,
            ),
            292 => 
            array (
                'permission_id' => 120,
                'role_id' => 2,
            ),
            293 => 
            array (
                'permission_id' => 120,
                'role_id' => 5,
            ),
            294 => 
            array (
                'permission_id' => 120,
                'role_id' => 6,
            ),
            295 => 
            array (
                'permission_id' => 121,
                'role_id' => 1,
            ),
            296 => 
            array (
                'permission_id' => 121,
                'role_id' => 2,
            ),
            297 => 
            array (
                'permission_id' => 121,
                'role_id' => 5,
            ),
            298 => 
            array (
                'permission_id' => 121,
                'role_id' => 6,
            ),
            299 => 
            array (
                'permission_id' => 122,
                'role_id' => 1,
            ),
            300 => 
            array (
                'permission_id' => 122,
                'role_id' => 2,
            ),
            301 => 
            array (
                'permission_id' => 122,
                'role_id' => 5,
            ),
            302 => 
            array (
                'permission_id' => 122,
                'role_id' => 6,
            ),
            303 => 
            array (
                'permission_id' => 125,
                'role_id' => 1,
            ),
            304 => 
            array (
                'permission_id' => 125,
                'role_id' => 6,
            ),
            305 => 
            array (
                'permission_id' => 130,
                'role_id' => 6,
            ),
            306 => 
            array (
                'permission_id' => 131,
                'role_id' => 5,
            ),
            307 => 
            array (
                'permission_id' => 131,
                'role_id' => 6,
            ),
            308 => 
            array (
                'permission_id' => 134,
                'role_id' => 5,
            ),
            309 => 
            array (
                'permission_id' => 134,
                'role_id' => 6,
            ),
            310 => 
            array (
                'permission_id' => 135,
                'role_id' => 5,
            ),
            311 => 
            array (
                'permission_id' => 135,
                'role_id' => 6,
            ),
            312 => 
            array (
                'permission_id' => 136,
                'role_id' => 1,
            ),
            313 => 
            array (
                'permission_id' => 136,
                'role_id' => 2,
            ),
            314 => 
            array (
                'permission_id' => 136,
                'role_id' => 5,
            ),
            315 => 
            array (
                'permission_id' => 136,
                'role_id' => 7,
            ),
            316 => 
            array (
                'permission_id' => 137,
                'role_id' => 1,
            ),
            317 => 
            array (
                'permission_id' => 137,
                'role_id' => 2,
            ),
            318 => 
            array (
                'permission_id' => 137,
                'role_id' => 5,
            ),
            319 => 
            array (
                'permission_id' => 137,
                'role_id' => 7,
            ),
            320 => 
            array (
                'permission_id' => 138,
                'role_id' => 1,
            ),
            321 => 
            array (
                'permission_id' => 138,
                'role_id' => 2,
            ),
            322 => 
            array (
                'permission_id' => 138,
                'role_id' => 5,
            ),
            323 => 
            array (
                'permission_id' => 138,
                'role_id' => 7,
            ),
            324 => 
            array (
                'permission_id' => 139,
                'role_id' => 1,
            ),
            325 => 
            array (
                'permission_id' => 139,
                'role_id' => 2,
            ),
            326 => 
            array (
                'permission_id' => 139,
                'role_id' => 5,
            ),
            327 => 
            array (
                'permission_id' => 139,
                'role_id' => 7,
            ),
            328 => 
            array (
                'permission_id' => 140,
                'role_id' => 1,
            ),
            329 => 
            array (
                'permission_id' => 140,
                'role_id' => 2,
            ),
            330 => 
            array (
                'permission_id' => 140,
                'role_id' => 5,
            ),
            331 => 
            array (
                'permission_id' => 141,
                'role_id' => 1,
            ),
            332 => 
            array (
                'permission_id' => 141,
                'role_id' => 2,
            ),
        ));
        
        
    }
}