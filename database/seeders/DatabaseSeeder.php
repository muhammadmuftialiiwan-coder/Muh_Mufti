<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
public function run()
{
    \App\Models\Produk::create([
        'nama' => 'Contoh Produk',
        'harga' => 10000,
        'deskripsi' => 'Ini adalah data percobaan'
    ]);
}
}