<?php

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
    return view('auth.login');
});

Auth::routes();



Route::group(['middleware' => 'auth'], function () {

	//route home
	Route::get('/maintenance', [App\Http\Controllers\HomeController::class, 'maint'])->name('404');
	Route::get('/home/ALL', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('home');
	Route::get('/home/{kode_area}', [App\Http\Controllers\DashboardController::class, 'dashboardArea'])->name('home.area');
	Route::get('/home/{pool}', [App\Http\Controllers\DashboardController::class, 'dashboardPool'])->name('home.pool');
	Route::get('/cari-part', [App\Http\Controllers\DashboardController::class, 'cariPart'])->name('part.search');
	Route::get('/cari-part/detail-{no_service}', [App\Http\Controllers\DashboardController::class, 'cariDetail'])->name('part.detail');

	//route service proses
	Route::get('/service/cek-nopol/{pool}', [App\Http\Controllers\RequestServiceController::class, 'cekNopol'])->name('request.cek');
	Route::get('/service/cek-nopol-urg/{pool}', [App\Http\Controllers\RequestServiceController::class, 'cekNopolUrg'])->name('request.cekurg');
	Route::get('/service/cek-nopol-part/{pool}', [App\Http\Controllers\RequestServiceController::class, 'cekNopolPart'])->name('request.cekpart');
	Route::post('/service/store-service', [App\Http\Controllers\RequestServiceController::class, 'storeService'])->name('store.service');
	Route::post('/service/store-service-urg', [App\Http\Controllers\RequestServiceController::class, 'storeServiceUrg'])->name('store.serviceurg');
	Route::post('/service/store-service-gantipart', [App\Http\Controllers\RequestServiceController::class, 'storeServicePart'])->name('store.servicepart');
	Route::get('/service/request-service', [App\Http\Controllers\RequestServiceController::class, 'formAdmin'])->name('request.formadmin');
	Route::get('/service/request-service/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'form'])->name('request.form');
	Route::get('/service/request-urg/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'formUrg'])->name('request.formurg');
	Route::get('/service/request-part/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'formPart'])->name('request.part');
	//his
	Route::get('/service/history-service', [App\Http\Controllers\RequestServiceController::class, 'history'])->name('request.history');
	Route::get('/service/history', [App\Http\Controllers\RequestServiceController::class, 'historyGsd'])->name('request.historygsd');
	Route::get('/service/detail-service/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'detailService'])->name('request.detail');
	Route::get('/service/old-detail-service/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'oldform'])->name('request.olddetail');
	Route::get('/service/detail-approval/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'detailApproval'])->name('request.detailapp');
	Route::get('/service/history-service/area{kode_area}', [App\Http\Controllers\RequestServiceController::class, 'historyArea'])->name('request.historyarea');
	Route::get('/service/history-service/pool{pool}', [App\Http\Controllers\RequestServiceController::class, 'historyPool'])->name('request.historypool');
	Route::get('/history-service/grouping', [App\Http\Controllers\RequestServiceController::class, 'historyGroup'])->name('request.historygroup');


	Route::get('/service/search-history', [App\Http\Controllers\RequestServiceController::class, 'filterHistory'])->name('search.history');
	Route::get('/service/search-history/date', [App\Http\Controllers\RequestServiceController::class, 'searchHistoryDate'])->name('search.historydate');
	Route::get('/service/search-date', [App\Http\Controllers\RequestServiceController::class, 'searchHistoryGsd'])->name('search.historygsd');
	Route::get('/invoice/search-invoice', [App\Http\Controllers\InvoiceController::class, 'filterInvoice'])->name('search.invoice');

	//bengkel
	Route::post('/service/store-bengkel/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'storeBengkel'])->name('store.bengkel');

	//approve
	Route::get('/service/approval-service', [App\Http\Controllers\RequestServiceController::class, 'approval'])->name('request.approvaladmin');
	Route::get('/service/approval-service/area{kode_area}', [App\Http\Controllers\RequestServiceController::class, 'approvalArea'])->name('request.approval');
	Route::get('/service/approve-service/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'approveService'])->name('approve.service');
	Route::get('/service/decline-service/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'declineService'])->name('decline.service');
	Route::post('/service/store-rincian/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'storeRincian'])->name('store.rincian');
	Route::post('/service/store-rincian-urg/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'storeRincianUrg'])->name('store.rincianurg');
	Route::post('/service/store-part/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'storePart'])->name('store.part');
	Route::post('/service/store-item-nonkhs/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'storeNonKhs'])->name('store.nonkhs');
	Route::get('/service/delete-rincian/{id}', [App\Http\Controllers\RequestServiceController::class, 'deleteRincian'])->name('delete.rincian');
	Route::get('/service/delete-rincian-non/{id}', [App\Http\Controllers\RequestServiceController::class, 'deleteRincianNon'])->name('delete.rincianNon');
	Route::get('/service/delete-rincian-urg/{id}', [App\Http\Controllers\RequestServiceController::class, 'deleteRincianUrg'])->name('delete.rincianurg');
	Route::get('/service/delete-request/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'deleteRequest'])->name('delete.request');
	Route::post('/service/finish-serviceorder/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'updateService'])->name('update.service');
	Route::post('/service/finish-serviceorder-urg/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'updateServiceUrg'])->name('update.serviceurg');
	Route::post('/service/finish-service-part/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'updateServicePart'])->name('update.servicepart');
	Route::get('/service/export-history/area{kode_area}/{tgl_awal}to{tgl_akhir}', [App\Http\Controllers\RequestServiceController::class, 'exportHistory'])->name('export.history');
	Route::get('/service/export-history/{tgl_awal}to{tgl_akhir}', [App\Http\Controllers\RequestServiceController::class, 'exportHistoryGsd'])->name('export.historygsd');

	Route::post('/service/update-detail/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'updateDetail'])->name('update.detail');
	//complete
	Route::get('/service/complete-service', [App\Http\Controllers\RequestServiceController::class, 'complete'])->name('complete.admin');
	Route::get('/service/complete-service/pool{pool}', [App\Http\Controllers\RequestServiceController::class, 'completePool'])->name('complete.pool');
	Route::get('/service/search-complete', [App\Http\Controllers\RequestServiceController::class, 'cariComplete'])->name('complete.searchadmin');
	Route::get('/service/search-complete/pool{pool}', [App\Http\Controllers\RequestServiceController::class, 'cariCompletePool'])->name('complete.searchpool');
	Route::post('/service/finish-service/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'finishService'])->name('finish.service');

	//cancel
	Route::get('/service/cancel-service/pool{pool}', [App\Http\Controllers\RequestServiceController::class, 'cancel'])->name('cancel.list');
	Route::get('/service/cancel-detail/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'cancelDetail'])->name('cancel.detail');
	Route::get('/service/cancel-process/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'canceled'])->name('cancel.process');
	Route::get('/service/approve-cancel/area{kode_area}', [App\Http\Controllers\RequestServiceController::class, 'approveCancel'])->name('acc.cancel');
	Route::get('/service/appcancel-detail/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'appCancelDetail'])->name('appcancel.detail');
	Route::get('/service/approve-cancel/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'appCancel'])->name('approve.cancel');
	Route::get('/service/decline-cancel/{no_service}', [App\Http\Controllers\RequestServiceController::class, 'declineCancel'])->name('decline.cancel');


	//manage
	Route::get('/manage-data/kendaraan', [App\Http\Controllers\ManageController::class, 'dataKendaraan'])->name('manage.kendaraan');
	Route::get('/manage-data/kendaraan-area{kode_area}', [App\Http\Controllers\ManageController::class, 'dataKendaraanArea'])->name('manage.kendaraanarea');
	Route::get('/manage-data/kendaraan-pool{pool1}', [App\Http\Controllers\ManageController::class, 'dataKendaraanPool'])->name('manage.kendaraanpool');
	Route::get('/manage-data/cari-kendaraan', [App\Http\Controllers\ManageController::class, 'cariKendaraan'])->name('kendaraan.search');
	Route::get('/manage-data/area', [App\Http\Controllers\ManageController::class, 'dataArea'])->name('manage.area');
	Route::get('/manage-data/bengkel', [App\Http\Controllers\ManageController::class, 'dataBengkel'])->name('manage.bengkel');
	Route::get('/manage-data/bengkel-area{kode_area}', [App\Http\Controllers\ManageController::class, 'dataBengkelArea'])->name('manage.bengkelarea');
	Route::get('/manage-data/bengkel-pool{pool}', [App\Http\Controllers\ManageController::class, 'dataBengkelPool'])->name('manage.bengkelpool');
	Route::get('/manage-data/nonkhs-area{kode_area}', [App\Http\Controllers\ManageController::class, 'dataNonkhs'])->name('manage.nonkhs');
	Route::get('/manage-data/nonkhs', [App\Http\Controllers\ManageController::class, 'nonKhsAdmin'])->name('nonkhs.admin');
	Route::get('/download-excel/nonkhs-area{kode_area}', [App\Http\Controllers\ManageController::class, 'excelNonkhs'])->name('excel.nonkhs');
	Route::get('/manage-data/cari-bengkel', [App\Http\Controllers\ManageController::class, 'cariBengkel'])->name('bengkel.search');
	Route::get('/manage-data/findKbm', [App\Http\Controllers\ManageController::class, 'findKendaraan'])->name('find.kbm');
	Route::get('manage-data/service-by-nopol/area{kode_area}', [App\Http\Controllers\ManageController::class, 'getNopolService'])->name('manage.service');
	Route::get('manage-data/service-by-nopol/{nopol}', [App\Http\Controllers\ManageController::class, 'getDetail'])->name('manage.servicedetail');

	//invoice
	Route::get('/invoice', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.index');
	Route::get('/invoice-area{kode_area}', [App\Http\Controllers\InvoiceController::class, 'indexArea'])->name('invoice.indexarea');
	Route::get('/invoice/{no_invoice}', [App\Http\Controllers\InvoiceController::class, 'invPdf'])->name('invoice.pdf');

	//sub of payment
	// Route::get('/payment-list/pool{pool}', 'InvoiceController@getlistPayment')->name('payment.list');
	Route::get('/payment-list/pool{pool}', [App\Http\Controllers\PaymentController::class, 'getlistPayment'])->name('payment.list');
	Route::get('/payment/list-approval', [App\Http\Controllers\PaymentController::class, 'getPaymentApproval'])->name('payment.approval');
	Route::get('/payment-paid/pool{pool}', [App\Http\Controllers\PaymentController::class, 'getPaidPayment'])->name('payment.paid');
	Route::get('/payment/list-accept', [App\Http\Controllers\PaymentController::class, 'getPaymentAccept'])->name('payment.accept');
	Route::get('/payment/detail-payment/{kode_bayar}', [App\Http\Controllers\PaymentController::class, 'getDetailPayment'])->name('payment.detail');
	Route::post('/payment/store', [App\Http\Controllers\PaymentController::class, 'storePayment'])->name('store.payment');
	Route::post('/payment/store-paid', [App\Http\Controllers\PaymentController::class, 'storePaid'])->name('store.paid');
	Route::get('/payment/approve-payment/{kode_bayar}', [App\Http\Controllers\PaymentController::class, 'approvePayment'])->name('payment.approve');
	Route::get('/payment/decline-payment/{kode_bayar}', [App\Http\Controllers\PaymentController::class, 'declinePayment'])->name('payment.decline');

	//setting
	Route::get('/settings/area{kode_area}', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.index');
	Route::post('/settings/store', [App\Http\Controllers\SettingController::class, 'create'])->name('setting.create');


	//budget
	//release
	Route::get('/detail-budget', [App\Http\Controllers\BudgetController::class, 'detailBudget'])->name('detailpusat.budget');
	Route::get('/rincian-budget/area{kode}', [App\Http\Controllers\BudgetController::class, 'rincianBudget'])->name('rincianpusat.budget');
	Route::get('/release-budget', [App\Http\Controllers\BudgetController::class, 'releaseBudget'])->name('release.budget');
	Route::post('/store-budget', [App\Http\Controllers\BudgetController::class, 'storeRelease'])->name('release.store');

	//distribusi
	Route::get('/distribusi-budget/area{kode_area}', [App\Http\Controllers\BudgetController::class, 'distribusiBudget'])->name('distribusi.budget');
	Route::post('/store-distribusi/area{kode_area}', [App\Http\Controllers\BudgetController::class, 'storeDistribusi'])->name('distribusi.store');

	//topup
	Route::get('/topup-budget/area{kode_area}', [App\Http\Controllers\BudgetController::class, 'topupBudget'])->name('topup.budget');
	Route::get('/history-budget/pool{pool}', [App\Http\Controllers\BudgetController::class, 'historyBudget'])->name('history.budget');
	Route::get('/detail-history/{kode}', [App\Http\Controllers\BudgetController::class, 'detailHistory'])->name('history.detail');
	Route::post('/store-topup/area{kode_area}', [App\Http\Controllers\BudgetController::class, 'storeTopup'])->name('topup.store');


	//reminder
	Route::get('/reminder-service/pool{pool}', [App\Http\Controllers\ReminderController::class, 'index'])->name('reminder.index');


	//
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

