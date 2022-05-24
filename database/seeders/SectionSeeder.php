<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();

        $sections = [
            "الراتب" => 'الدخل',
            "المكافآت" => 'الدخل',
            "الهدايا" => 'الدخل',
            "المبيعات" => 'الدخل',
            "اخرى" => 'الدخل',

            "فواتير" => 'المصروف',
            "تحويل رصيد" => 'المصروف',
            "المواصلات" => 'المصروف',
            "التسويق" => 'المصروف',
        ];


        foreach ($sections as $name => $type) {
            Section::create([
                'name' => $name,
                'type' => $type
            ]);
        }
    }
}
