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

        $cantidadUsuarios = 1000;
        $cantidadCategorias = 30;
        $cantidadProductos = 1000;
        $cantidadTransacciones = 1000;

        DB::table('users')->insert([
            'name'  => 'Juan Perdomo',
            'email'     => 'perdomov.j07@gmail.com',
            'password'  => bcrypt('1234'),
            'remember_token' => 'bl5rsu3R8c',
            'verified'=> 0,
            'verification_token'=>'',
            'admin' => false,
        ]);

        factory(User::class, $cantidadUsuarios)->create();
        factory(Category::class, $cantidadCategorias)->create();

		factory(Product::class, $cantidadTransacciones)->create()->each(
			function ($producto) {
				$categorias = Category::all()->random(mt_rand(1, 5))->pluck('id');

				$producto->categories()->attach($categorias);
			}
		);        

        factory(Transaction::class, $cantidadTransacciones)->create();
    }
}
