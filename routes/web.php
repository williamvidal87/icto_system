<?php

use App\Http\Livewire\AdminPanel\Extra\ServiceType;
use App\Http\Livewire\AdminPanel\ManageInventory\InventoryEquipment;
use App\Http\Livewire\AdminPanel\ManageInventory\ServicesEquipment;
use App\Http\Livewire\AdminPanel\ManageRecords\AccomplishmentsReport;
use App\Http\Livewire\AdminPanel\ManageRecords\InventoryReport;
use App\Http\Livewire\AdminPanel\ManageRequest\BorrowRequest;
use App\Http\Livewire\AdminPanel\ManageRequest\SupportRequest;
use App\Http\Livewire\AdminPanel\ManageRequest\TechinicalRequest;
use App\Http\Livewire\AdminPanel\ManageUsers\AdminTable;
use App\Http\Livewire\AdminPanel\ManageUsers\ClientTable;
use App\Http\Livewire\AdminPanel\ManageUsers\PersonnelTable;
use App\Http\Livewire\AdminPanel\PrintReports\AccomplishmentPrint;
use App\Http\Livewire\AdminPanel\PrintReports\InventoryPrint;
use App\Http\Livewire\AdminPanel\WorkTicket;
use App\Http\Livewire\Chat\ChatBox;
use App\Http\Livewire\ClientPanel\Logs\ActivityLogs;
use App\Http\Livewire\ClientPanel\RequestBorrow\BorrowEquipment;
use App\Http\Livewire\ClientPanel\RequestTechServices\ITSupportServices;
use App\Http\Livewire\ClientPanel\RequestTechServices\Technical;
use App\Http\Livewire\DashBoard\DashBoard;
use App\Http\Livewire\PersonnelPanel\PersonnelWorkTicket;
use App\Http\Livewire\Profile\EditProfileForm;
use App\Http\Livewire\Profile\PasswordUpdate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {   
    // return view('welcome');   
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    
    Route::get('/dashboard', DashBoard::class)->name('dashboard');
    Route::get('/editprofileform', EditProfileForm::class)->name('editprofileform');
    Route::get('/passwordupdate', PasswordUpdate::class)->name('passwordupdate');
    
    // Client Panel
    Route::get('/technical-request', Technical::class)->name('technical-request')->middleware('checkRulepermissionclient');
    Route::get('/it-support-services', ITSupportServices::class)->name('it-support-services')->middleware('checkRulepermissionclient');
    Route::get('/request-borrow-equipment', BorrowEquipment::class)->name('request-borrow-equipment')->middleware('checkRulepermissionclient');
    Route::get('/activity-logs', ActivityLogs::class)->name('activity-logs');
    
    
    // Admin Panel
    Route::get('/admin-technical-request', TechinicalRequest::class)->name('admin-technical-request')->middleware('checkRulepermissionadmin');
    Route::get('/admin-support-request', SupportRequest::class)->name('admin-support-request')->middleware('checkRulepermissionadmin');
    Route::get('/admin-borrow-request', BorrowRequest::class)->name('admin-borrow-request')->middleware('checkRulepermissionadmin');
    Route::get('/admin-work-ticket', WorkTicket::class)->name('admin-work-ticket')->middleware('checkRulepermissionadmin');
    Route::get('/admin-equipment', ServicesEquipment::class)->name('admin-equipment')->middleware('checkRulepermissionadmin');
    Route::get('/admin-client-table', ClientTable::class)->name('admin-client-table')->middleware('checkRulepermissionadmin');
    Route::get('/admin-admin-table', AdminTable::class)->name('admin-admin-table')->middleware('checkRulepermissionadmin');
    Route::get('/admin-personnel-table', PersonnelTable::class)->name('admin-personnel-table')->middleware('checkRulepermissionadmin');
    Route::get('/service-type', ServiceType::class)->name('service-type')->middleware('checkRulepermissionadmin');
    Route::get('/inventory-equipment', InventoryEquipment::class)->name('inventory-equipment')->middleware('checkRulepermissionadmin');
    Route::get('/inventory-report', InventoryReport::class)->name('inventory-report')->middleware('checkRulepermissionadmin');
    Route::get('/accomplishment-report', AccomplishmentsReport::class)->name('accomplishment-report')->middleware('checkRulepermissionadmin');
    Route::get('/accomplishment-print', AccomplishmentPrint::class)->name('accomplishment-print')->middleware('checkRulepermissionadmin');
    
    // Personnel Panel
    Route::get('/personnel-work-ticket', PersonnelWorkTicket::class)->name('personnel-work-ticket')->middleware('checkRulepermissionpersonnel');
    Route::get('/personnel-equipment', ServicesEquipment::class)->name('personnel-equipment')->middleware('checkRulepermissionpersonnel');
    Route::get('/personnel-service-type', ServiceType::class)->name('personnel-service-type')->middleware('checkRulepermissionpersonnel');
    Route::get('/personnel-inventory-equipment', InventoryEquipment::class)->name('personnel-inventory-equipment')->middleware('checkRulepermissionpersonnel');
});
