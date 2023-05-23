<?php

namespace App;

use App\Buyer;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

//transaction 
class Transaction extends Model
{
    use SoftDeletes;

    public $transformer = TransactionTransformer::class;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'quantity',
    	'buyer_id',
    	'product_id',
    ];
    // relaciones con el buyer
    public function buyer()
    {
    	return $this->belongsTo(Buyer::class);
    }
    // relaciones con el producto
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
