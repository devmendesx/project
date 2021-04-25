<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name','description','price'];
    protected $dates = ['updated_at', 'created_at', 'deleted_at'];

    /**
     * Search users with params request
     *
     * @param Request
     *
     * @return Collection
     */
    public static function search($request) {

        $data = Product::whereNull('deleted_at');
        if(isset($request->id)) {
            $data = $data->where('id', $request->id);
        }
        return $data->get();
    }
}
