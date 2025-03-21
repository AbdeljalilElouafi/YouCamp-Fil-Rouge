<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->all();
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(TagRequest $request)
    {
        $this->tagRepository->create($request->validated());
        return redirect()->route('admin.tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->find($id);
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, $id)
    {
        $this->tagRepository->update($id, $request->validated());
        return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy($id)
    {
        $this->tagRepository->delete($id);
        return redirect()->route('admin.tags.index')->with('success', 'Tag deleted successfully.');
    }
}
