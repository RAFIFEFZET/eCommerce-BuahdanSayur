<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductCategories;
use App\Models\ProductReviews;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve products data from the database
        $products = Products::all();
        
        // Pass the products data to the view
        return view('dashboard.home', compact('products'));
    }


    public function productDetail($id)
    {
        // Retrieve the product data from the database
        $product = Products::find($id);
        $review = ProductReviews::all();
        // Check if the product was found
        if ($product) {
            // Pass the product data to the view
            $review = $product->productReviews;
            return view('shopdetail.index', compact('product', 'review'));
        } else {
            // Redirect to a 404 page or another error page
            return abort(404, 'Product not found.');
        }
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
