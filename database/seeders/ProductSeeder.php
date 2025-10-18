<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Flavor;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk mengisi data ke database.
     */
    public function run(): void
    {
        // 3. Matikan sementara pengecekan foreign key
        Schema::disableForeignKeyConstraints();

        // 4. Kosongkan tabel anak DULU, baru tabel induk
        Flavor::truncate();
        Product::truncate();

        // 5. Nyalakan lagi pengecekan foreign key
        Schema::enableForeignKeyConstraints();

        // Data Produk Dummy
        $products = [
            [
                'title' => 'Balado Pedas Manis',
                'description' => 'Keripik singkong dengan bumbu balado khas yang pedas dan manis, cocok untuk camilan sehari-hari.',
                'price' => 15000,
                'stock' => 50,
                'image' => 'images/balado.jpg',
                'alt' => 'Gambar Kripik Balado Pedas Manis',
            ],
            [
                'title' => 'Jagung Bakar Gurih',
                'description' => 'Keripik renyah dengan rasa jagung bakar yang gurih dan sedikit manis, dibuat dari jagung pilihan.',
                'price' => 14000,
                'stock' => 75,
                'image' => 'images/jagung manis.jpg',
                'alt' => 'Gambar Kripik Rasa Jagung Bakar',
            ],
            [
                'title' => 'Keju Asin Premium',
                'description' => 'Keripik kentang dengan taburan keju premium yang meleleh di mulut, rasa gurih dan creamy.',
                'price' => 18000,
                'stock' => 30,
                'image' => 'images/keju.jpg',
                'alt' => 'Gambar Kripik Keju Premium',
            ],
            [
                'title' => 'Original Rasa Bawang',
                'description' => 'Keripik singkong original dengan sentuhan rasa bawang gurih, renyah dan bikin nagih.',
                'price' => 13000,
                'stock' => 100,
                'image' => 'images/original.jpg',
                'alt' => 'Gambar Kripik Original Bawang',
            ],
            [
                'title' => 'Rumput Laut Nori',
                'description' => 'Keripik kentang tipis dengan taburan rumput laut nori dan sedikit rasa pedas yang menggugah selera.',
                'price' => 16500,
                'stock' => 45,
                'image' => 'images/rumput laut.jpg',
                'alt' => 'Gambar Kripik Rumput Laut Nori',
            ],

        ];

        // Masukkan semua data ke database
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}