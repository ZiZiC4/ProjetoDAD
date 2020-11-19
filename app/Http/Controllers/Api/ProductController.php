<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Products as ProductsResource;
use App\Models\Products;

class ProductsController extends Controller
{
    public function index()
    {
        return ProductsResource::collection(Products::all());
    }
}
