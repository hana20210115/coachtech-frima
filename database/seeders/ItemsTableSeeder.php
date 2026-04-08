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
                'description' => 'スタイリッシュなデザインのメンズ腕時計', 'condition' => '良好',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Watch.jpg'
            ],
            [
                'name' => 'HDD', 'price' => 5000, 'brand' => '西芝', 'category_id' => 2,
                'description' => '高速で信頼性の高いハードディスク', 'condition' => '目立った傷や汚れなし',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD.jpg'
            ],
            [
                'name' => '玉ねぎ3束', 'price' => 300, 'brand' => 'なし', 'category_id' => 3,
                'description' => '新鮮な玉ねぎ3束のセット', 'condition' => 'やや傷や汚れあり',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Onion.jpg'
            ],
            [
                'name' => '革靴', 'price' => 4000, 'brand' => 'なし', 'category_id' => 1,
                'description' => 'クラシックなデザインの革靴', 'condition' => '状態が悪い',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather_Shoes.jpg'
            ],
            [
                'name' => 'ノートPC', 'price' => 45000, 'brand' => 'なし', 'category_id' => 2,
                'description' => '高性能なノートパソコン', 'condition' => '良好',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Laptop.jpg'
            ],
            [
                'name' => 'マイク', 'price' => 8000, 'brand' => 'なし', 'category_id' => 2,
                'description' => '高音質のレコーディング用マイク', 'condition' => '目立った傷や汚れなし',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Microphone.jpg'
            ],
            [
                'name' => 'ショルダーバッグ', 'price' => 3500, 'brand' => 'なし', 'category_id' => 1,
                'description' => 'おしゃれなショルダーバッグ', 'condition' => 'やや傷や汚れあり',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Shoulder_Bag.jpg'
            ],
            [
                'name' => 'タンブラー', 'price' => 500, 'brand' => 'なし', 'category_id' => 4,
                'description' => '使いやすいタンブラー', 'condition' => '状態が悪い',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler.jpg'
            ],
            [
                'name' => 'コーヒーミル', 'price' => 4000, 'brand' => 'Starbacks', 'category_id' => 4,
                'description' => '手動のコーヒーミル', 'condition' => '良好',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Coffee_Grinder.jpg'
            ],
            [
                'name' => 'メイクセット', 'price' => 2500, 'brand' => 'なし', 'category_id' => 5,
                'description' => '便利なメイクアップセット', 'condition' => '目立った傷や汚れなし',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Make_up_Set.jpg'
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
                'condition' => $item['condition'],
                'image' => $item['image'],
            ]);
        }
    }
}
