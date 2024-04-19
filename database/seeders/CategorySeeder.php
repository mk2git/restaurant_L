<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = array(
            array('id' => '9','name' => '前菜','created_at' => '2024-04-07 15:32:04','updated_at' => '2024-04-07 15:32:04'),
            array('id' => '11','name' => 'メイン','created_at' => '2024-04-07 15:45:35','updated_at' => '2024-04-08 10:19:47'),
            array('id' => '13','name' => 'スープ','created_at' => '2024-04-07 15:48:34','updated_at' => '2024-04-07 15:48:34'),
            array('id' => '14','name' => 'デザート','created_at' => '2024-04-07 15:48:40','updated_at' => '2024-04-15 09:14:29'),
            array('id' => '16','name' => 'ドリンク','created_at' => '2024-04-08 10:20:19','updated_at' => '2024-04-08 10:20:19'),
            array('id' => '18','name' => '酒類','created_at' => '2024-04-15 09:14:39','updated_at' => '2024-04-15 09:14:39')
        );
        foreach ($categories as $category) {
            Category::insert($category);
        }
    }
}
