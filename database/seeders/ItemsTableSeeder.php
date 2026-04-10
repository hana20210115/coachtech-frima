<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $items = [
            [
                'name' => '腕時計', 'price' => 15000, 'brand' => 'Rolax', 'category_id' => 1,
                'description' => 'スタイリッシュなデザインのメンズ腕時計', 'condition_id' => 1,
                'image' => 'items/watch.jpg'
            ],
            [
                'name' => 'HDD', 'price' => 5000, 'brand' => '西芝', 'category_id' => 2,
                'description' => '高速で信頼性の高いハードディスク', 'condition_id' => 2,
                'image' => 'items/hd.jpg'
            ],
            [
                'name' => '玉ねぎ3束', 'price' => 300, 'brand' => 'なし', 'category_id' => 3,
                'description' => '新鮮な玉ねぎ3束のセット', 'condition_id' => 3,
                'image' => 'items/onion.jpg'
            ],
            [
                'name' => '革靴', 'price' => 4000, 'brand' => 'なし', 'category_id' => 1,
                'description' => 'クラシックなデザインの革靴', 'condition_id' => 4,
                'image' => 'items/leathershoes.jpg'
            ],
            [
                'name' => 'ノートPC', 'price' => 45000, 'brand' => 'なし', 'category_id' => 2,
                'description' => '高性能なノートパソコン', 'condition_id' => 1,
                'image' => 'items/notepc.jpg'
            ],
            [
                'name' => 'マイク', 'price' => 8000, 'brand' => 'なし', 'category_id' => 2,
                'description' => '高音質のレコーディング用マイク', 'condition_id' => 2,
                'image' => 'items/mic.jpg'
            ],
            [
                'name' => 'ショルダーバッグ', 'price' => 3500, 'brand' => 'なし', 'category_id' => 1,
                'description' => 'おしゃれなショルダーバッグ', 'condition_id' => 3,
                'image' => 'items/shoulderbag.jpg'
            ],
            [
                'name' => 'タンブラー', 'price' => 500, 'brand' => 'なし', 'category_id' => 4,
                'description' => '使いやすいタンブラー', 'condition_id' => 4,
                'image' => 'items/tumbler.jpg'
            ],
            [
                'name' => 'コーヒーミル', 'price' => 4000, 'brand' => 'Starbacks', 'category_id' => 4,
                'description' => '手動のコーヒーミル', 'condition_id' => 1,
                'image' => 'items/coffeemill.jpg'
            ],
            [
                'name' => 'メイクセット', 'price' => 2500, 'brand' => 'なし', 'category_id' => 5,
                'description' => '便利なメイクアップセット', 'condition_id' => 2,
                'image' => 'items/makeupset.jpg'
            ],
        ];

        foreach ($items as $item) {
            Item::create([
                'user_id' => 1,
                'category_id' => $item['category_id'],
                'name' => $item['name'],
                'brand' => $item['brand'],
                'price' => $item['price'],
                'description' => $item['description'],
                'condition_id' => $item['condition_id'],
                'image' => $item['image'],
            ]);
        }
    }
}
