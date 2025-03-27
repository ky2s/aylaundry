<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     // Display a listing of the services
     public function index()
     {
         $services = Services::all();
         return view('services.index', compact('services'));
     }
 
     // Show the form for creating a new service
     public function create()
     {
         return view('services.create');
     }
 
     // Store a newly created service in storage
     public function store(Request $request)
     {
         $request->validate([
             'service_name' => 'required|string|max:50',
             'description' => 'nullable|string',
             'price_per_kg' => 'nullable|numeric',
             'price_per_item' => 'nullable|numeric',
             'estimated_time' => 'nullable|integer',
             'category_id' => 'nullable|exists:categories,id',
             'is_active' => 'boolean',
             'image_url' => 'nullable|url',
         ]);
 
         Services::create($request->all());
 
         return redirect()->route('services.index')->with('success', 'Service created successfully.');
     }
 
     // Display the specified service
     public function show(Services $service)
     {
         return view('services.show', compact('service'));
     }
 
     // Show the form for editing the specified service
     public function edit(Services $service)
     {
         return view('services.edit', compact('service'));
     }
 
     // Update the specified service in storage
     public function update(Request $request, Services $service)
     {
         $request->validate([
             'service_name' => 'required|string|max:50',
             'description' => 'nullable|string',
             'price_per_kg' => 'nullable|numeric',
             'price_per_item' => 'nullable|numeric',
             'estimated_time' => 'nullable|integer',
             'category_id' => 'nullable|exists:categories,id',
             'is_active' => 'boolean',
             'image_url' => 'nullable|url',
         ]);
 
         $service->update($request->all());
 
         return redirect()->route('services.index')->with('success', 'Service updated successfully.');
     }
 
     // Remove the specified service from storage
     public function destroy(Services $service)
     {
         $service->delete();
 
         return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
     }
}
