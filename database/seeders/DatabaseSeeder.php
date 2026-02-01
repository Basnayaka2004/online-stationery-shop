<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test admin
        $testAdmin = Admin::create([
            'admin_name' => 'Admin User',
            'email' => 'admin@shop.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Create categories
        $categories = [
            'Pens & Pencils' => Category::create(['category_name' => 'Pens & Pencils', 'admin_id' => $testAdmin->id]),
            'Notebooks' => Category::create(['category_name' => 'Notebooks', 'admin_id' => $testAdmin->id]),
            'Planners' => Category::create(['category_name' => 'Planners', 'admin_id' => $testAdmin->id]),
            'Office Supplies' => Category::create(['category_name' => 'Office Supplies', 'admin_id' => $testAdmin->id]),
            'Art Supplies' => Category::create(['category_name' => 'Art Supplies', 'admin_id' => $testAdmin->id]),
        ];

        // Create products with beautiful images
        $products = [
            [
                'name' => 'Premium Blue Ballpoint Pen',
                'desc' => 'Smooth writing experience with premium ink. Perfect for daily use and professional settings.',
                'price' => 2.99,
                'stock' => 150,
                'category' => 'Pens & Pencils',
                'image' => 'https://images.unsplash.com/photo-1586040140378-d0b11ebce6eb?w=400&h=300&fit=crop',
            ],
            [
                'name' => 'A4 Ruled Notebook - 200 Pages',
                'desc' => 'High-quality ruled notebook with durable binding. Ideal for note-taking and journaling.',
                'price' => 5.99,
                'stock' => 80,
                'category' => 'Notebooks',
                'image' => 'https://images.unsplash.com/photo-1544716278-e513176f20a5?w=400&h=300&fit=crop',
            ],
            [
                'name' => '2026 Weekly Planner',
                'desc' => 'Organize your life with this beautifully designed weekly planner. Includes goal setting pages.',
                'price' => 14.99,
                'stock' => 40,
                'category' => 'Planners',
                'image' => 'https://images.unsplash.com/photo-1606761568499-6d2451b23c66?w=400&h=300&fit=crop',
            ],
            [
                'name' => 'Highlighter Set - 6 Colors',
                'desc' => 'Vibrant colors for effective highlighting. Includes yellow, pink, green, blue, orange, and purple.',
                'price' => 6.99,
                'stock' => 60,
                'category' => 'Office Supplies',
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop',
            ],
            [
                'name' => 'Heavy Duty Stapler',
                'desc' => 'Professional stapler for all your binding needs. Holds up to 50 sheets at once.',
                'price' => 12.99,
                'stock' => 35,
                'category' => 'Office Supplies',
                'image' => 'https://images.unsplash.com/photo-1628277856681-9dc5d4edf5c5?w=400&h=300&fit=crop',
            ],
            [
                'name' => 'Sticky Notes Pack - Assorted',
                'desc' => '6 pads of colorful sticky notes. 100 sheets per pad. Perfect for reminders and quick notes.',
                'price' => 4.49,
                'stock' => 100,
                'category' => 'Office Supplies',
                'image' => 'https://images.unsplash.com/photo-1564694647756-86fd18c0f8f7?w=400&h=300&fit=crop',
            ],
            [
                'name' => 'Professional Pencil Set',
                'desc' => 'Set of 12 HB pencils with eraser. Premium wood construction for smooth writing.',
                'price' => 7.99,
                'stock' => 70,
                'category' => 'Pens & Pencils',
                'image' => 'https://images.unsplash.com/photo-1560363199-5b2b21e32f34?w=400&h=300&fit=crop',
            ],
            [
                'name' => 'Bamboo Desk Organizer',
                'desc' => 'Eco-friendly desk organizer with multiple compartments. Keep your workspace tidy and stylish.',
                'price' => 18.99,
                'stock' => 25,
                'category' => 'Office Supplies',
                'image' => 'https://images.unsplash.com/photo-1586769852044-692d6e3703f0?w=400&h=300&fit=crop',
            ],
            [
                'name' => 'Watercolor Paint Set',
                'desc' => '24 vibrant watercolor paints with brush. Perfect for artists and hobbyists.',
                'price' => 16.99,
                'stock' => 45,
                'category' => 'Art Supplies',
                'image' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=400&h=300&fit=crop',
            ],
            [
                'name' => 'Leather Journal - A5',
                'desc' => 'Handcrafted leather journal with 180 cream pages. Classic and timeless design.',
                'price' => 24.99,
                'stock' => 20,
                'category' => 'Notebooks',
                'image' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=400&h=300&fit=crop',
            ],
            [
                'name' => 'Gel Pen Set - 12 Colors',
                'desc' => 'Smooth gel pens in brilliant colors. Great for bullet journaling and creative writing.',
                'price' => 9.99,
                'stock' => 55,
                'category' => 'Pens & Pencils',
                'image' => 'https://images.unsplash.com/photo-1605035015554-9c45e5b6e46d?w=400&h=300&fit=crop',
            ],
            [
                'name' => 'Daily Planner 2026',
                'desc' => 'Day-per-page planner with hourly scheduling. Includes monthly overview and goal tracking.',
                'price' => 19.99,
                'stock' => 30,
                'category' => 'Planners',
                'image' => 'https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=400&h=300&fit=crop',
            ],
        ];

        foreach ($products as $p) {
            Product::create([
                'product_name' => $p['name'],
                'description' => $p['desc'],
                'price' => $p['price'],
                'stock_quantity' => $p['stock'],
                'image_url' => $p['image'],
                'category_id' => $categories[$p['category']]->id,
                'admin_id' => $testAdmin->id,
            ]);
        }

        // Create test customer
        Customer::create([
            'name' => 'Test Customer',
            'email' => 'customer@test.com',
            'username' => 'testcustomer',
            'password' => Hash::make('password'),
            'phone' => '1234567890',
            'street' => '123 Test Street',
            'city' => 'London',
            'state' => 'England',
            'Zip' => 'SW1A 1AA',
        ]);

        // Create additional customers
        Customer::factory(3)->create();

        // Create carts for all customers
        $customers = Customer::all();
        foreach ($customers as $customer) {
            Cart::create(['customer_id' => $customer->id]);
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📧 Admin: admin@shop.com / password');
        $this->command->info('📧 Customer: customer@test.com / password');
        $this->command->info('📦 ' . Product::count() . ' products created with images');
    }
}
