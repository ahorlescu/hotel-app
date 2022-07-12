<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Service;

class ServicesController extends Controller
{
    public function index(){
        $services = Service::orderByDesc('id')->get();

        return Inertia::render('Services/Index', [
            'services' => $services,
        ]);
    }

    public function create(){
        return Inertia::render('Services/Create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|',
            'icon' => 'required',
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')->with('successMessage', 'Service was successfully created!');
    }

    public function edit(Service $service){
        
        return Inertia::render('Services/Edit',[
            'service' => $service,
        ]);
    }

    public function update(Request $request, Service $service){
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
        ]);

        // $service->update($request->all());
        $service->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return redirect()->route('services.index')->with('successMessage', 'Service was successfully updated!');

    }

    public function destroy(Service $service){
        $service->delete();

        return redirect()->route('services.index')->with('successMessage', 'Service was successfully deleted!');
        
    }
}
