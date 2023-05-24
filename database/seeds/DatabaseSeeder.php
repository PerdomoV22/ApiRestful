<?php

use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Product::flushEventListeners();
        Transaction::flushEventListeners();

        $cantidadUsuarios = 100;
        $cantidadCategorias = 30;
        $cantidadProductos = 100;
        $cantidadTransacciones = 100;

        $contraseña = "matiasjuan";
        $user = new User([
            "email" => "perdomov.j07@gmail.com",
            "password" => Hash::make($contraseña),
            "name" => "Juan Perdomo",
            'remember_token' => 'bl5rsu3R8c',
            'verified'=> 0,
            'verification_token'=>'',
            'admin' => false,
        ]);
        $user->saveOrFail();

    }
}
