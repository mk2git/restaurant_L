<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = array(
            array('id' => '4','name' => 'パスタ','price' => '2000','category_id' => '11','description' => '和風seafoodパスタ','photo' => '1713162344.png','created_at' => '2024-04-07 16:14:31','updated_at' => '2024-04-15 06:25:44'),
            array('id' => '14','name' => 'コーヒー','price' => '800','category_id' => '16','description' => 'ブレンドコーヒー','photo' => '1712671293.jpg','created_at' => '2024-04-08 10:21:49','updated_at' => '2024-04-09 15:01:33'),
            array('id' => '15','name' => 'クラムチャウダー','price' => '1000','category_id' => '13','description' => 'クラムチャウダー','photo' => '1712586210.jpg','created_at' => '2024-04-08 15:23:30','updated_at' => '2024-04-08 15:23:30'),
            array('id' => '16','name' => 'コーンスープ','price' => '800','category_id' => '13','description' => 'コーンスープ','photo' => '1712589399.jpg','created_at' => '2024-04-08 15:24:29','updated_at' => '2024-04-08 16:16:39'),
            array('id' => '20','name' => 'チーズケーキ','price' => '900','category_id' => '14','description' => '濃厚チーズケーキ','photo' => '1713168945.jpg','created_at' => '2024-04-09 15:02:50','updated_at' => '2024-04-15 08:15:45'),
            array('id' => '21','name' => 'ティラミス','price' => '950','category_id' => '14','description' => 'ティラミス','photo' => '1712671389.jpg','created_at' => '2024-04-09 15:03:09','updated_at' => '2024-04-09 15:03:09'),
            array('id' => '22','name' => '鴨肉ソテー','price' => '4500','category_id' => '11','description' => 'フランス産鴨肉使用','photo' => '1713162892.png','created_at' => '2024-04-15 06:33:21','updated_at' => '2024-04-15 06:34:52'),
            array('id' => '23','name' => 'オレンジジュース','price' => '650','category_id' => '16','description' => 'オレンジジュース','photo' => '1713339368.png','created_at' => '2024-04-17 07:36:08','updated_at' => '2024-04-17 07:36:08'),
            array('id' => '24','name' => '明太子パスタ','price' => '1200','category_id' => '11','description' => '明太子のパスタ','photo' => '1713339399.png','created_at' => '2024-04-17 07:36:39','updated_at' => '2024-04-17 07:36:39')
          );

        foreach ($menus as $menu) {
            Menu::insert($menu);
        }
    }
}
