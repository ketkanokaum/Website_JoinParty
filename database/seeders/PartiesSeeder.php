<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parties')->insert([
            [
                'party_name' => 'Concert Night',
                'start_date' => '2024-10-01',
                'end_date' => '2024-10-01',
                'start_time' => '18:00:00',
                'end_time' => '22:00:00',
                'location' => 'Bangkok',
                'detail' => 'ค่ำคืนแห่งดนตรีและความบันเทิง.',
                'province' => 'กรุงเทพมหานคร',
                'numpeople' => 50,
                'img' => 'concert_night.jpg',
                'party_type_id' => 1, //
                'contact' => 'สามารถติดต่อมาได้ที่ email : contact@concert.com หรือแอดไลน์พูดคุยทางคิวอาร์โค้ดด้านล่างได้เลยครับ' ,
                'img_contact' => 'contact_img.jpg',
            ],
            [
                'party_name' => 'Food Festival',
                'start_date' => '2024-11-15',
                'end_date' => '2024-11-17',
                'start_time' => '10:00:00',
                'end_time' => '21:00:00',
                'location' => 'เชียงใหม่',
                'detail' => 'เข้าร่วมสุดสัปดาห์แห่งความอร่อยจากทั่วโลก.',
                'province' => 'เชียงใหม่',
                'numpeople' => 10,
                'img' => 'food_festival.jpg',
                'party_type_id' => 2, // ต้องมั่นใจว่า ID นี้ตรงกับประเภทปาร์ตี้ที่มีอยู่
                'contact' => 'info@foodfestival.com',
                'img_contact' => 'food_contact_img.jpg',
            ],
            // คุณสามารถเพิ่มเรคคอร์ดเพิ่มเติมได้ตามต้องการ
        ]);
    }
    }