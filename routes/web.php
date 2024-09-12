<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\Cart\UserCartController;   
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Cart\UserAddToCartController;
use App\Http\Controllers\Cart\UserUpdateCartController;
use App\Http\Controllers\Auth\SuperAdminLoginController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\Auth\SuperAdminRegisterController;
use App\Http\Controllers\Cart\UserRemoveFromCartController;
use App\Http\Controllers\SuperAdmin\ApproveByAdminController;

// Public Routes
Route::get('/', [ProductController::class, 'showProducts'])->name('home');
Route::get('/category/{slug}', [ProductController::class, 'showProductsByCategory'])->name('category.products');
Route::get('/category/{category_slug}/product/{product_slug}', [ProductController::class, 'showSingleProduct'])->name('single.product');

// Product Search Routes
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

// User Routes
Route::get('/register', [UserRegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [UserRegisterController::class, 'register'])->name('register');

Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login'])->name('login.submit');

Route::middleware(['auth', 'check.user.profile'])->group(function () {
    Route::get('/user_dashboard/{id}', function ($id) {
        $user = User::findOrFail($id);
        // Check if the user ID matches the authenticated user
        if (Auth::id() !== (int) $id) {
            return redirect()->route('user_dashboard')->withErrors(['access' => 'Unauthorized access.']);
        }
            return view('users.dashboard', compact('user'));
    })->name('user_dashboard');
});
        // Route::group(['middleware' => ['auth', 'check.user.profile']], function () {
        //     Route::get('/user/dashboard', [UserDashboardController::class, 'userDashboard'])->name('user_dashboard');
        // });

    Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout');
    
    // Reviews Routes
    Route::post('/reviews', [ReviewController::class, 'store'])->name('review.store');

    Route::post('/complain', [ComplainController::class, 'store'])->name('complain.submit');

    Route::get('superadmin/complain/box', [ComplainController::class, 'show'])->name('complain.show');



    // Cart routes
    Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');

    // Checkout routes
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');



    Route::get('permissions/create', [PermissionsController::class, 'createPermissions'])->name('permissions.create');
    Route::post('permissions/assign', [PermissionsController::class, 'assignPermissions'])->name('permissions.assign');
    Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions.index');
    


        



// Admin Routes with profile check middleware
Route::middleware(['auth.admin', 'check.admin.profile'])->group(function () {
    Route::get('/admin/dashboard/{id}', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Route for showing the form to create a new product
    Route::get('admin/products/create/{admin}', [ProductController::class, 'create'])->name('admin.products.create');

    // Store a newly created product
    Route::post('admin/products/store/{admin}', [ProductController::class, 'store'])->name('admin.products.store');

    // Show a specific product
    Route::get('admin/products/{admin}/{product}', [ProductController::class, 'show'])->name('admin.products.show');

    // Edit a specific product
    Route::get('admin/products/{admin}/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');

    // Update a specific product
    Route::put('admin/products/{admin}/{product}', [ProductController::class, 'update'])->name('admin.products.update');

    Route::get('admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('admin/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/admin/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // Orders routes
    // Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
    // Route::resource('orders', OrderController::class)->except(['create', 'edit', 'update', 'destroy']);
    
    // Delete a specific product
    Route::delete('admin/products/{admin}/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/admin/products/{admin}', [ProductController::class, 'index'])->name('admin.products.index');

    Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});



// Public or unauthenticated routes for admin authentication
Route::get('/admin/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register.form');
Route::post('/admin/register', [AdminRegisterController::class, 'register'])->name('admin.register');
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');

// Routes for pending or rejected profile status
Route::get('/profile/pending', function () {
    return view('profile.pending');
})->name('profile.pending');

Route::get('/profile/rejected', function () {
    return view('profile.rejected');
})->name('profile.rejected');

// SuperAdmin Routes
Route::get('superadmin/login', [SuperAdminLoginController::class, 'showLoginForm'])->name('superadmin.login.form');
Route::post('superadmin/login', [SuperAdminLoginController::class, 'login'])->name('superadmin.login');
Route::get('superadmin/register', [SuperAdminRegisterController::class, 'showRegistrationForm'])->name('superadmin.register.form');
Route::post('superadmin/register', [SuperAdminRegisterController::class, 'register'])->name('superadmin.register');
Route::post('superadmin/logout', [SuperAdminLoginController::class, 'logout'])->name('superadmin.logout');

Route::prefix('superadmin')->middleware('auth:superadmin')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/userslist', [SuperAdminController::class, 'userslist'])->name('superadmin.userslist');
    Route::get('/adminslist', [SuperAdminController::class, 'AdminList'])->name('superadmin.adminlist');
    // Route::patch('/superadmin/{id}/update-salary', [SuperAdminController::class, 'updateSalary'])->name('superadmin.updateSalary');
    Route::put('/superadmin/{id}/update-salary', [SuperAdminController::class, 'updateSalary'])->name('superadmin.updateSalary');

    // Route::get('/superadmin/admin/{id}/edit', [SuperAdminController::class, 'editAdmin'])->name('superadmin.editAdmin');
    
    Route::get('/pending-users', [SuperAdminController::class, 'users'])->name('superadmin.pending.users');
    Route::post('/users/{id}/approve', [ApproveByAdminController::class, 'approveUser'])->name('superadmin.users.approve');

    // Edit admin
    Route::get('/admin/{id}/edit', [SuperAdminController::class, 'editAdmin'])->name('superadmin.editAdmin');
    Route::put('/admin/{id}/update', [SuperAdminController::class, 'updateAdmin'])->name('superadmin.updateAdmin');

    Route::post('/users/{id}/reject', [ApproveByAdminController::class, 'rejectUser'])->name('superadmin.users.reject');
    Route::get('/pending-admins', [SuperAdminController::class, 'admins'])->name('superadmin.pending.admins');
    Route::post('/admins/{id}/approve', [ApproveByAdminController::class, 'approveAdmin'])->name('superadmin.admins.approve');
    Route::post('/admins/{id}/reject', [ApproveByAdminController::class, 'rejectAdmin'])->name('superadmin.admins.reject');
    Route::delete('/superadmin/admin/{id}', [SuperAdminController::class, 'destroyAdmin'])->name('superadmin.destroyAdmin');
    Route::delete('/superadmin/users/{id}', [SuperAdminController::class, 'destroyUser'])->name('superadmin.destroyUser');
    Route::post('/logout', [SuperAdminController::class, 'logout'])->name('superadmin.logout');
});


Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index'); // List categories
    Route::get('/create', [CategoryController::class, 'create'])->name('create'); // Show create form
    Route::post('/', [CategoryController::class, 'store'])->name('store'); // Store new category
    Route::get('/{name}/{id}', [CategoryController::class, 'show'])->name('show'); // Show a single category
    Route::get('/{name}/{id}/edit', [CategoryController::class, 'edit'])->name('edit'); // Show edit form
    Route::put('/{name}/{id}', [CategoryController::class, 'update'])->name('update'); // Update category
    Route::delete('/{name}/{id}', [CategoryController::class, 'destroy'])->name('destroy'); // Delete category
});



// Contact Route
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::get('/terms', [ContactController::class, 'terms'])->name('terms.show');
Route::get('/privacy-policy', [ContactController::class, 'policy'])->name('policy.show');
// Notification Route
// Route::get('/admin/{id}/notification', [OrderPlace_NController::class, 'show'])->name('notification');

// Unauthorized Route
Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
})->name('unauthorized');

