<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show products on the home page
    public function showProducts()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('home', compact('products', 'categories'));
    }

    // Show products by category
    public function showProductsByCategory(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();
        $categories = Category::all();

        return view('home', compact('products', 'categories'));
    }

    // Search products
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Fetch products that match the search query
        $products = Product::where('title', 'LIKE', "%$query%")
                            ->orWhere('description', 'LIKE', "%$query%")
                            ->get();
        
        // Get all categories for the sidebar
        $categories = Category::all();

        return view('products.search', compact('products', 'categories'));
    }

    // Show single product details
    // public function showSingleProduct(string $category_slug, string $product_slug)
    // {
    //     $category = Category::where('slug', $category_slug)->firstOrFail();
    //     $product = Product::where('slug', $product_slug)
    //                        ->where('category_id', $category->id)
    //                        ->firstOrFail();
    //     $review = Review::where('product_id', $product)->first();     
    //     return view('single_item', compact('product', 'review'));
    // }

    public function showSingleProduct(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $product = Product::where('slug', $product_slug)
                        ->where('category_id', $category->id)
                        ->firstOrFail();
        $reviews = Review::where('product_id', $product->id)->get(); // Fetch all reviews
        return view('single_item', compact('product', 'reviews'));
    }



    // Show products for the admin dashboard
    public function index(int $adminId)
    {
        // Check if the authenticated admin is trying to access their own products
        if (auth()->guard('admin')->user()->id !== $adminId) {
            abort(403, 'Unauthorized access.');
        }

        // Retrieve products for the given admin ID
        $products = Product::where('admin_id', $adminId)->get();

        return view('admin.products.index', compact('products', 'adminId'));
    }

    // Show a single product based on its title
    public function showProductByTitle(string $title)
    {
        $product = Product::where('title', $title)->firstOrFail();
        return view('single_item', compact('product'));
    }

    // Show create product form
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Store a new product
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new Product instance
        $product = new Product();
        $product->title = $request->title;
        
        // Generate slug from title with spaces replaced by plus signs
        $product->slug = str_replace(' ', '+', $request->title);

        $product->price = $request->price;
        $product->description = $request->description;
        $product->address = $request->address;
        $product->category_id = $request->category_id;
        $product->admin_id = auth()->guard('admin')->user()->id;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('products');

            // Ensure the directory exists
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move the uploaded image to the public/products directory
            $image->move($destinationPath, $imageName);

            // Store the image path in the database
            $product->image = 'products/' . $imageName;
        }

        // Save the product
        $product->save();

        // Redirect to the product index route with a success message
        return redirect()->route('admin.products.index', ['admin' => auth()->guard('admin')->user()->id])
                        ->with('success', 'Product created successfully.');
    }


    // Show a single product
    public function show(int $adminId, int $id)
    {
        $product = Product::where('id', $id)->where('admin_id', $adminId)->firstOrFail();
        return view('products.show', compact('product'));
    }

    // Show edit product form
    public function edit(int $adminId, int $id)
    {
        $product = Product::where('id', $id)->where('admin_id', $adminId)->firstOrFail();
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Update an existing product
    public function update(Request $request, int $adminId, int $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::where('id', $id)->where('admin_id', $adminId)->firstOrFail();
        $product->title = $request->title;
        
        $product->slug = str_replace(' ', '+', $request->title);

        // $product->slug = Str::slug($request->title);
        $product->price = $request->price;
        $product->description = $request->description;
        $product->address = $request->address;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('products');

            // Ensure the directory exists
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move the uploaded image to the public/products directory
            $image->move($destinationPath, $imageName);

            // Store the image path in the database
            $product->image = 'products/' . $imageName;
        }

        $product->save();

        return redirect()->route('admin.products.index', $adminId)->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy(int $adminId, int $id)
    {
        $product = Product::where('id', $id)->where('admin_id', $adminId)->firstOrFail();
        $product->delete();

        return redirect()->route('admin.products.index', $adminId)->with('success', 'Product deleted successfully.');
    }
}
