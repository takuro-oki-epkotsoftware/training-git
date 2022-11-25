<?php

namespace Database\Seeders;

use Database\Factories\JobFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * 
     */
    public function run()
    {
        // 開発環境のみ100レコードを追加する。
        if (app()->isLocal()) {
            // App\Models\Job
            // 全件削除
            Job::truncate();
            // JobFactoryクラスを使って100件追加
            Job::factory()
                ->count(100)
                ->create();
        }
    }
}
