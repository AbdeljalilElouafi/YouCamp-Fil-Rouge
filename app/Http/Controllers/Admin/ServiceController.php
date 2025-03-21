<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $services = $this->serviceRepository->all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(ServiceRequest $request)
    {
        $this->serviceRepository->create($request->validated());
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $service = $this->serviceRepository->find($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, $id)
    {
        $this->serviceRepository->update($id, $request->validated());
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $this->serviceRepository->delete($id);
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
