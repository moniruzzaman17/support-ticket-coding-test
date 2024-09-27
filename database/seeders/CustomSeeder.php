<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;
use App\Models\Category;

class CustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert Admin User
        User::create([
            'name' => 'Admin Moniruzzaman',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        // Insert Customer User
        Customer::create([
            'name' => 'Customer Moniruzzaman',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        // Insert Categories
        Category::create(['name' => 'Support', 'description' => 'General support inquiries']);
        Category::create(['name' => 'Technical', 'description' => 'Technical assistance inquiries']);
        Category::create(['name' => 'Billing', 'description' => 'Billing and payment inquiries']);
        Category::create(['name' => 'General Inquiry', 'description' => 'General questions or comments']);
    }
}
