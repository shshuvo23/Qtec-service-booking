<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data['title'] = 'Customer List';
        $data['customers'] = User::where('role', 'customer')->get(); // Assuming you have a User model with a role field
        return view('admin.customer.index', compact('data'));
    }

    // Additional methods for customer management can be added here
}
