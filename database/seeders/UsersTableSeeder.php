<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'test_user',
            'email' => 'test@example.com',
            'password' => \Hash::make('password'),
        ]);

    Profile::create([
            'user_id' => $user->id,
            'postcode' => '123-4567',
            'address' => '東京都',
            'building' => 'オフィスビル',
            'image' => null, // 最初は画像なし
        ]);
    }
    }
