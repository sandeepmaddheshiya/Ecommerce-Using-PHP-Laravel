<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Auth\Access\AuthorizationException;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = Str::slug($request->name); // Use Str::slug()

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($name, $id) {
        $category = Category::where('slug', $name)->where('id', $id)->firstOrFail();
        return view('categories.show', compact('category'));
    }

    public function edit($name, $id) {
        $category = Category::where('slug', $name)->where('id', $id)->firstOrFail();

        // try {
        //     $this->authorize('update', $category);
        // } catch (AuthorizationException $e) {
        //     return redirect()->route('categories.index')->withErrors(['error' => 'You are not eligible to access this page.']);
        // }

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $name, $id) {
        $category = Category::where('slug', $name)->where('id', $id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // try {
        //     $this->authorize('update', $category);
        // } catch (AuthorizationException $e) {
        //     return redirect()->route('categories.index')->withErrors(['error' => 'You are not eligible to access this page.']);
        // }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = Str::slug($request->name); // Use Str::slug()
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($name, $id) {
        $category = Category::where('slug', $name)->where('id', $id)->firstOrFail();

        // try {
        //     $this->authorize('delete', $category);
        // } catch (AuthorizationException $e) {
        //     return redirect()->route('categories.index')->withErrors(['error' => 'You are not eligible to access this page.']);
        // }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}