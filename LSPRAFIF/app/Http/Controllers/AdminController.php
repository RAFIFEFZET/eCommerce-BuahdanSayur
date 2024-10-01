<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Render the sidebar
        $sidebarData = $this->renderSidebar();

        // Pass sidebar data and other necessary data to the view
        return view('admin.home', $sidebarData);
    }

    /**
     * Render the sidebar based on user's level.
     */
    private function renderSidebar()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Initialize an empty array to store sidebar items
        $sidebarItems = [];

        // Check if the user is authenticated and has a level property
        if ($user && $user->level) {
            // Determine sidebar items based on user's level
            if ($user->level === 'Admin') {
                $sidebarItems = [
                    'Dashboard',
                    'Deliveries',
                    'Discounts',
                    'Products',
                    'Product Categories',
                    'Product Reviews',
                    'Wishlists',
                ];
            } elseif ($user->level === 'Manager') {
                $sidebarItems = [
                    'Dashboard',
                    'Customers',
                    'Payments',
                    'Orders',
                    'Order Details',
                ];
            }
        }

        // Return the sidebar items
        return ['sidebarItems' => $sidebarItems];
    }
}
