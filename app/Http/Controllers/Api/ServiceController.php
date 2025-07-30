<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            $services = Service::where('status', true)->get();

            return response()->json([
                'success' => true,
                'message' => 'Services retrieved successfully',
                'data' => $services,
                'meta' => [
                    'count' => $services->count()
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve services',
                'error' =>  $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->authorizeAdmin();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'status' => 'boolean',
                // Add any additional fields as needed
            ]);

            $service = new Service();
            $service->name = $validated['name'];
            $service->description = $validated['description'] ?? '';
            $service->price = $validated['price'];
            $service->status = $validated['status'] ;
            $service->save();

            return response()->json([
                'success' => true,
                'message' => 'Service created successfully',
                'data' => $service
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->authorizeAdmin();

            $service = Service::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'status' => 'required|boolean',
                // Add any additional fields as needed
            ]);
            if(!$service) {
                return response()->json([
                    'success' => false,
                    'message' => 'Service not found'
                ], 404);
            }

            $service->update([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null, // Handle null description
                'price' => $validated['price'],
                'status' => $validated['status'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Service updated successfully',
                'data' => $service
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->authorizeAdmin();

            $service = Service::findOrFail($id);
            if($service === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Service not found'
                ], 404);
            }
            $service->delete();

            return response()->json([
                'success' => true,
                'message' => 'Service deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function authorizeAdmin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }
}
