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
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Software, hardware, and IT services companies',
                'color' => '#3B82F6',
                'is_active' => true,
            ],
            [
                'name' => 'Healthcare',
                'description' => 'Medical, pharmaceutical, and health services',
                'color' => '#10B981',
                'is_active' => true,
            ],
            [
                'name' => 'Finance',
                'description' => 'Banking, insurance, and financial services',
                'color' => '#F59E0B',
                'is_active' => true,
            ],
            [
                'name' => 'Manufacturing',
                'description' => 'Industrial manufacturing and production',
                'color' => '#6B7280',
                'is_active' => true,
            ],
            [
                'name' => 'Retail',
                'description' => 'Consumer goods and retail services',
                'color' => '#EC4899',
                'is_active' => true,
            ],
            [
                'name' => 'Education',
                'description' => 'Schools, universities, and training services',
                'color' => '#8B5CF6',
                'is_active' => true,
            ],
            [
                'name' => 'Real Estate',
                'description' => 'Property development and real estate services',
                'color' => '#EF4444',
                'is_active' => true,
            ],
            [
                'name' => 'Entertainment',
                'description' => 'Media, gaming, and entertainment services',
                'color' => '#F97316',
                'is_active' => true,
            ],
            [
                'name' => 'Transportation',
                'description' => 'Logistics, shipping, and transportation services',
                'color' => '#06B6D4',
                'is_active' => true,
            ],
            [
                'name' => 'Consulting',
                'description' => 'Business consulting and advisory services',
                'color' => '#84CC16',
                'is_active' => true,
            ],
            [
                'name' => 'Food & Beverage',
                'description' => 'Restaurants, food production, and beverage companies',
                'color' => '#DC2626',
                'is_active' => true,
            ],
            [
                'name' => 'Energy',
                'description' => 'Oil, gas, renewable energy, and utilities',
                'color' => '#059669',
                'is_active' => true,
            ],
            [
                'name' => 'Non-Profit',
                'description' => 'Charitable organizations and non-profit entities',
                'color' => '#7C3AED',
                'is_active' => true,
            ],
            [
                'name' => 'Legal',
                'description' => 'Law firms and legal services',
                'color' => '#1F2937',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing',
                'description' => 'Advertising, PR, and marketing services',
                'color' => '#BE185D',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
