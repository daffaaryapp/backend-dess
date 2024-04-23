<?php

namespace App\Http\Controllers\Api\Public;

use App\Models\Product;
use App\Http\Resources\ProuductResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(9);

        return new ProuductResource(true,'List Data Products', $products);
    }


    public function show($slug)
    {
        $product = Product::where('slug',$slug)->first();

        if ($product){

            return new ProuductResource(true,'Detail Data Product',$product);
        }
        return new ProuductResource(false,'Detail Data Product Tidak Ditemukan',null);
    }


    public function HomePage()
    {
        $product = Product::latest()->take(6)->get();

        return new ProuductResource(true,'List Data Product HomePage', $product);
    }
}
