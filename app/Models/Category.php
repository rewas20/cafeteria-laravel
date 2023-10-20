<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name'];
    public function products() {
      return $this->hasMany(Product::class,'category_id','id');
    }
}
// git checkout -b  CrudAdminProducts
// git add . 
//git commit -m "crud_products"
//git push origin CrudAdminProducts
