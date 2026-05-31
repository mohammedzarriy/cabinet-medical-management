<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($search = $request->input('search')) {
            $query->where('nom', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $services = $query->orderByDesc('created_at')->paginate(10);
        return view('services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'         => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix'        => 'nullable|numeric|min:0',
        ]);

        Service::create($request->only('nom', 'description', 'prix'));

        return redirect()->route('services.index')->with('success', __('Service créé avec succès.'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nom'         => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix'        => 'nullable|numeric|min:0',
        ]);

        $service->update($request->only('nom', 'description', 'prix'));

        return redirect()->route('services.index')->with('success', __('Service modifié avec succès.'));
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', __('Service supprimé.'));
    }
}
