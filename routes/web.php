<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExpiredProductController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\OutStockProductController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DamageController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\OutStockPurchaseController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('pages.bashboard');
    /*
    |--------------------------------------------------------------------------
    | All User Routes
    |--------------------------------------------------------------------------
    */
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    // Route::get('user-profile', [UserController::class, 'profile'])->name('users.profile');
    Route::get('/users-fetchall', [UserController::class, 'fetchAll'])->name('users.fetchAll');
    Route::post('/users-store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users-edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users-update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users-delete', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
    /*
    |--------------------------------------------------------------------------
    | All Categories Routes
    |--------------------------------------------------------------------------
    */
    Route::get('categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/categories-fetchall', [CategoriesController::class, 'fetchAll'])->name('categories.fetchAll');
    Route::post('/categories-store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories-edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('/categories-update', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories-delete', [CategoriesController::class, 'delete'])->name('categories.delete');
    /*
    |--------------------------------------------------------------------------
    | All Supplier Routes
    |--------------------------------------------------------------------------
    */
    Route::get('supplier', [SuppliersController::class, 'index'])->name('supplier.index');
    Route::get('/supplier-fetchall', [SuppliersController::class, 'fetchAll'])->name('supplier.fetchAll');
    Route::post('/supplier-store', [SuppliersController::class, 'store'])->name('supplier.store');
    Route::get('/supplier-edit', [SuppliersController::class, 'edit'])->name('supplier.edit');
    Route::post('/supplier-update', [SuppliersController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier-delete', [SuppliersController::class, 'delete'])->name('supplier.delete');
    /*
    |--------------------------------------------------------------------------
    | All Purchase Routes
    |--------------------------------------------------------------------------
    */
    Route::get('purchase', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::get('/purchase-fetchall', [PurchaseController::class, 'fetchAll'])->name('purchase.fetchAll');
    Route::post('/purchase-store', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/purchase-edit', [PurchaseController::class, 'edit'])->name('purchase.edit');
    Route::post('/purchase-update', [PurchaseController::class, 'update'])->name('purchase.update');
    Route::delete('/purchase-delete', [PurchaseController::class, 'delete'])->name('purchase.delete');
    Route::get('/purchase-reports', [PurchaseController::class, 'reports'])->name('purchase.reports');
    Route::get('purchase/outstock', [OutStockPurchaseController::class, 'outstock'])->name('purchase.outstock');
    Route::post('/purchase-reports', [PurchaseController::class, 'generateReport'])->name('purchase.generateReport');
    /*
    |--------------------------------------------------------------------------
    | All Purchase Routes
    |--------------------------------------------------------------------------
    */
    Route::get('products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product-fetchAll', [ProductController::class, 'fetchAll'])->name('product.fetchAll');
    Route::post('/product-store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product-edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product-update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product-delete', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('products/outstock', [OutStockProductController::class, 'outstock'])->name('product.outstock');
    Route::get('products/expired', [ExpiredProductController::class, 'expired'])->name('expired');
    /*
   |--------------------------------------------------------------------------
   | All Sales Routes
   |--------------------------------------------------------------------------
   */
    Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales-fetchAll', [SaleController::class, 'fetchAll'])->name('sales.fetchAll');
    Route::post('/sales-store', [SaleController::class, 'store'])->name('sales.store');
    // Route::get('/sales-edit', [SaleController::class, 'edit'])->name('sales.edit');
    // Route::post('/sales-update/{id}', [SaleController::class, 'update'])->name('sales.update');
    Route::get('/sale_details', [SaleController::class, 'SalesDetails'])->name('sales.details');
    Route::get('/sales_fetchAllsales', [SaleController::class, 'fetchAllSales'])->name('sales.fetchAllSales');
    Route::delete('/sales-delete', [SaleController::class, 'destroy'])->name('sales.delete');
    Route::get('/sales-reports', [SaleController::class, 'reports'])->name('sales.reports');
    Route::post('/sales-reports', [SaleController::class, 'generateReport'])->name('sales.generateReport');
   /*
   |--------------------------------------------------------------------------
   | All Damage Routes
   |--------------------------------------------------------------------------
   */

   Route::get('/damage',[DamageController::class, 'index'])->name('damage.index');
   Route::get('/damage-fetchall', [DamageController::class, 'fetchAll'])->name('damage.fetchAll');
   Route::post('/damage/store', [DamageController::class, 'store'])->name('damage.store');
   Route::get('/damage/edit', [DamageController ::class, 'edit'])->name('damage.edit');
   Route::post('/damage/update', [DamageController::class, 'update'])->name('damage.update');
   Route::delete('/damage/delete', [DamageController::class, 'destroy'])->name('damage.delete');
   Route::get('/damage-reports', [DamageController::class, 'reports'])->name('damage.reports');
   Route::post('/damage-reports', [DamageController::class, 'generateReport'])->name('damage.generateReport');
 
    /*
    |--------------------------------------------------------------------------
    | All Accounts Routes
    |--------------------------------------------------------------------------
    */
    Route::get('accounts', [AccountsController::class, 'index'])->name('accounts.index');
    Route::get('accounts/search', [AccountsController::class, 'searchtransaction'])->name('accounts.search');
    Route::get('accounts-billing-history', [AccountsController::class, 'BillingHistoryindex'])->name('billinghistory.index');
    Route::get('accounts-other-transaction', [AccountsController::class, 'OtherTransactionIndex'])->name('othertransaction.index');
    Route::post('accounts-other-transaction/store', [AccountsController::class, 'store'])->name('other.transection.store');
    Route::get('accounts-other-transaction/ledger/details', [AccountsController::class, 'ledgerdetails'])->name('other.transection.ledgerdetails');
    Route::get('accounts-transaction-history', [AccountsController::class, 'TransactionHistoryIndex'])->name('transactionhistory.index');
    Route::get('cash-memo/{id}/{saleId}', [InvoiceController::class, 'index'])->name('cashmemo.index');
    Route::get('barcode-scanning', [AccountsController::class, 'BarcodeScanning'])->name('barcodescanning.index');
    /*
  |--------------------------------------------------------------------------
  | All Customer Routes
  |--------------------------------------------------------------------------
  */
    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer-fetchall', [CustomerController::class, 'fetchAll'])->name('customer.fetchAll');
    Route::post('/customer-store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer-edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/customer-update', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer-delete', [CustomerController::class, 'delete'])->name('customer.delete');



   /*
   |--------------------------------------------------------------------------
   | All Inventories Routes
   |--------------------------------------------------------------------------
   */
  Route::get('inventories', [InventoryController::class, 'index'])->name('inventory.index');
  Route::get('/inventories-fetchall', [InventoryController::class, 'fetchAll'])->name('inventory.fetchAll');
  Route::post('/inventories-store', [InventoryController::class, 'store'])->name('inventory.store');
  Route::get('/inventories-edit', [InventoryController::class, 'edit'])->name('inventory.edit');
  Route::post('/inventories-update', [InventoryController::class, 'update'])->name('inventory.update');
  Route::delete('/inventories-delete', [InventoryController::class, 'delete'])->name('inventory.delete');
});


//forget and reset password
Route::get('/forgetpassword',[ForgetPasswordManager::class, 'forgetPassword'])->name('forget.password.show');
Route::post('/forgetpassword',[ForgetPasswordManager::class, 'forgetPasswordPost'])->name('forget.post.password');
Route::get('/resetpassword/{token}',[ForgetPasswordManager::class, 'resetPassword'])->name('reset.password');
Route::post('/resetpassword',[ForgetPasswordManager::class, 'resetPasswordPost'])->name('reset.password.post'); 

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('example1');
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout'])->name('example2');

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END