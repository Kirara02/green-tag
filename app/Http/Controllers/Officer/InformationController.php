<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    public function index()
    {
        $articles = Information::with('author')->latest()->paginate(10);
        return view('officer.informations.index', compact('articles'));
    }

    public function create()
    {
        return view('officer.informations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // --- PERUBAHAN DI SINI ---
            'title' => ['required', 'string', 'max:255', 'unique:informations,title'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'category' => ['required', Rule::in(['education', 'news', 'announcement'])],
            'status' => ['required', Rule::in(['published', 'draft'])],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('information-images', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author_id'] = Auth::id();

        Information::create($validated);

        return redirect()
            ->route('officer.informations.index')
            ->with('success', 'Article created successfully.');
    }

    public function edit(Information $information)
    {
        return view('officer.informations.edit', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        $validated = $request->validate([
            // --- PERUBAHAN DI SINI ---
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('informations')->ignore($information->id),
            ],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'category' => ['required', Rule::in(['education', 'news', 'announcement'])],
            'status' => ['required', Rule::in(['published', 'draft'])],
        ]);

        if ($request->hasFile('image')) {
            if ($information->image) {
                Storage::disk('public')->delete($information->image);
            }
            $validated['image'] = $request->file('image')->store('information-images', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);

        $information->update($validated);

        return redirect()
            ->route('officer.informations.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Information $information)
    {
        if ($information->image) {
            Storage::disk('public')->delete($information->image);
        }

        $information->delete();

        return redirect()
            ->route('officer.informations.index')
            ->with('success', 'Article deleted successfully.');
    }
}
