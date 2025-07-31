<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $data['title'] = 'Customer List';
        $data['services'] = Service::orderBy('id', 'desc')->get(); // Assuming you have a User model with a role field
        return view('admin.service.index', compact('data'));
    }

    public function bookingsList()
    {
        // Logic for fetching bookings can be added here
        $data['title'] = 'Bookings List';
        $data['bookings'] = Booking::with('service', 'user')->get();
        return view('admin.service.booking_list', compact('data'));
    }
}
