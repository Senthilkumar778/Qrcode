<?php
use App\Http\Controllers\RecordDetailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ServiceInfoController;
use App\Http\Controllers\NewEnquiryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmailConfigController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\GenerateORCodeController;


/////////////////////////  Template Routes ////////////////////////////////////////////////////////////////

Route::view('/index', 'index')->name('index');
Route::get('recordPopup/{type}/{id}', [RecordDetailController::class, 'popup'])
    ->where('type', 'serviceInfo|newEnquiry')->where('id', '[0-9]+')->name('recordPopup');

Route::get('recordDetails/{type}/{id}', [RecordDetailController::class, 'details'])
    ->where('type', 'serviceInfo|newEnquiry')->where('id', '[0-9]+')->name('recordDetails');
Route::view('/analytics', 'analytics');
Route::view('/finance', 'finance');
Route::view('/crypto', 'crypto');

Route::view('/apps/chat', 'apps.chat');
Route::view('/apps/mailbox', 'apps.mailbox');
Route::view('/apps/todolist', 'apps.todolist');
Route::view('/apps/notes', 'apps.notes');
Route::view('/apps/scrumboard', 'apps.scrumboard');
Route::view('/apps/contacts', 'apps.contacts');
Route::view('/apps/calendar', 'apps.calendar');

Route::view('/apps/invoice/list', 'apps.invoice.list');
Route::view('/apps/invoice/preview', 'apps.invoice.preview');
Route::view('/apps/invoice/add', 'apps.invoice.add');
Route::view('/apps/invoice/edit', 'apps.invoice.edit');

Route::view('/components/tabs', 'ui-components.tabs');
Route::view('/components/accordions', 'ui-components.accordions');
Route::view('/components/modals', 'ui-components.modals');
Route::view('/components/cards', 'ui-components.cards');
Route::view('/components/carousel', 'ui-components.carousel');
Route::view('/components/countdown', 'ui-components.countdown');
Route::view('/components/counter', 'ui-components.counter');
Route::view('/components/sweetalert', 'ui-components.sweetalert');
Route::view('/components/timeline', 'ui-components.timeline');
Route::view('/components/notifications', 'ui-components.notifications');
Route::view('/components/media-object', 'ui-components.media-object');
Route::view('/components/list-group', 'ui-components.list-group');
Route::view('/components/pricing-table', 'ui-components.pricing-table');
Route::view('/components/lightbox', 'ui-components.lightbox');

Route::view('/elements/alerts', 'elements.alerts');
Route::view('/elements/avatar', 'elements.avatar');
Route::view('/elements/badges', 'elements.badges');
Route::view('/elements/breadcrumbs', 'elements.breadcrumbs');
Route::view('/elements/buttons', 'elements.buttons');
Route::view('/elements/buttons-group', 'elements.buttons-group');
Route::view('/elements/color-library', 'elements.color-library');
Route::view('/elements/dropdown', 'elements.dropdown');
Route::view('/elements/infobox', 'elements.infobox');
Route::view('/elements/jumbotron', 'elements.jumbotron');
Route::view('/elements/loader', 'elements.loader');
Route::view('/elements/pagination', 'elements.pagination');
Route::view('/elements/popovers', 'elements.popovers');
Route::view('/elements/progress-bar', 'elements.progress-bar');
Route::view('/elements/search', 'elements.search');
Route::view('/elements/tooltips', 'elements.tooltips');
Route::view('/elements/treeview', 'elements.treeview');
Route::view('/elements/typography', 'elements.typography');

Route::view('/charts', 'charts');
Route::view('/widgets', 'widgets');
Route::view('/font-icons', 'font-icons');
Route::view('/dragndrop', 'dragndrop');

Route::view('/tables', 'tables');

Route::view('/datatables/advanced', 'datatables.advanced');
Route::view('/datatables/alt-pagination', 'datatables.alt-pagination');
Route::view('/datatables/basic', 'datatables.basic');
Route::view('/datatables/checkbox', 'datatables.checkbox');
Route::view('/datatables/clone-header', 'datatables.clone-header');
Route::view('/datatables/column-chooser', 'datatables.column-chooser');
Route::view('/datatables/export', 'datatables.export');
Route::view('/datatables/multi-column', 'datatables.multi-column');
Route::view('/datatables/multiple-tables', 'datatables.multiple-tables');
Route::view('/datatables/order-sorting', 'datatables.order-sorting');
Route::view('/datatables/range-search', 'datatables.range-search');
Route::view('/datatables/skin', 'datatables.skin');
Route::view('/datatables/sticky-header', 'datatables.sticky-header');

Route::view('/forms/basic', 'forms.basic');
Route::view('/forms/input-group', 'forms.input-group');
Route::view('/forms/layouts', 'forms.layouts');
Route::view('/forms/validation', 'forms.validation');
Route::view('/forms/input-mask', 'forms.input-mask');
Route::view('/forms/select2', 'forms.select2');
Route::view('/forms/touchspin', 'forms.touchspin');
Route::view('/forms/checkbox-radio', 'forms.checkbox-radio');
Route::view('/forms/switches', 'forms.switches');
Route::view('/forms/wizards', 'forms.wizards');
Route::view('/forms/file-upload', 'forms.file-upload');
Route::view('/forms/quill-editor', 'forms.quill-editor');
Route::view('/forms/markdown-editor', 'forms.markdown-editor');
Route::view('/forms/date-picker', 'forms.date-picker');
Route::view('/forms/clipboard', 'forms.clipboard');

// Route::view('/users/profile', 'users.profile');
// Route::view('/users/user-account-settings', 'users.user-account-settings');

Route::view('/pages/knowledge-base', 'pages.knowledge-base');
Route::view('/pages/contact-us-boxed', 'pages.contact-us-boxed');
Route::view('/pages/contact-us-cover', 'pages.contact-us-cover');
Route::view('/pages/faq', 'pages.faq');
Route::view('/pages/coming-soon-boxed', 'pages.coming-soon-boxed');
Route::view('/pages/coming-soon-cover', 'pages.coming-soon-cover');
Route::view('/pages/error404', 'pages.error404');
Route::view('/pages/error500', 'pages.error500');
Route::view('/pages/error503', 'pages.error503');
Route::view('/pages/maintenence', 'pages.maintenence');

Route::view('/auth/boxed-lockscreen', 'auth.boxed-lockscreen');
Route::view('/auth/boxed-signin', 'auth.boxed-signin');
Route::view('/auth/boxed-signup', 'auth.boxed-signup');
Route::view('/auth/boxed-password-reset', 'auth.boxed-password-reset');
Route::view('/auth/cover-login', 'auth.cover-login');
Route::view('/auth/cover-register', 'auth.cover-register');
Route::view('/auth/cover-lockscreen', 'auth.cover-lockscreen');
Route::view('/auth/cover-password-reset', 'auth.cover-password-reset');

////////////////////////////////////////  Template Routes End ///////////////////////////////////////////////////////////////////

Route::get('/',[LoginController::class, 'loginView'])->name('loginView');
Route::get('/recoverPassword',[LoginController::class, 'recoverView'])->name('recoverPassword');
Route::post('sendResetPasswordMail', [LoginController::class,'sendResetPasswordMail'])->name('sendResetPasswordMail');
Route::get('resetPassword/{token}',[LoginController::class, 'resetPassword'])->name('resetPassword');
Route::post('resetUserPassword',[LoginController::class,'resetUserPassword'])->name('resetUserPassword');

Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::middleware(['authenticatedUser' , 'web'])->group( function () {

Route::get('index',[DashboardController::class,'index'])->name('index');

Route::get('/user',[UserController::class,'index'])->name('users');
Route::get('/addUser',[UserController::class,'add'])->name('userAdd');
Route::post('/storeUser',[UserController::class,'store'])->name('storeUser');
Route::get('/editUser/{id}',[UserController::class,'edit'])->name('editUser');
Route::put('/updateUser/{id}',[UserController::class,'update'])->name('updateUser');
Route::get('deleteUser/{id}',[UserController::class,'destroy'])->name('deleteUser');

Route::get('/changePassword',[UserController::class,'changePassword'])->name('changePassword');
Route::put('/updatePassword/{id}',[UserController::class,'updatePassword'])->name('updatePassword');

Route::get('/locations',[LocationController::class,'index'])->name('locations');
Route::get('/addLocation',[LocationController::class,'add'])->name('locationAdd');
Route::post('/storeLocation',[LocationController::class,'store'])->name('storeLocation');
Route::get('/editLocation/{id}',[LocationController::class,'edit'])->name('editLocation');
Route::put('/updateLocation/{id}',[LocationController::class,'update'])->name('updateLocation');
Route::get('/deleteLocation/{id}',[LocationController::class,'destroy'])->name('deleteLocation');

Route::get('/regions',[RegionController::class,'index'])->name('regions');
Route::get('/addRegion',[RegionController::class,'add'])->name('regionAdd');
Route::post('/storeRegion',[RegionController::class,'store'])->name('storeRegion');
Route::get('/editRegion/{id}',[RegionController::class,'edit'])->name('editRegion');
Route::put('/updateRegion/{id}',[RegionController::class,'update'])->name('updateRegion');
Route::get('/deleteRegion/{id}',[RegionController::class,'destroy'])->name('deleteRegion');

Route::get('serviceInfo',[ServiceInfoController::class, 'index'])->name('serviceInfo');
Route::get('newEnquiries', [NewEnquiryController::class , 'index'])->name('newEnquiries');

Route::post('updateserviceInfoStatus',[ServiceInfoController::class,'updateserviceInfoStatus'])->name('updateserviceInfoStatus');

Route::post('updateNewEnquiryStatus', [NewEnquiryController::class,'updateNewEnquiryStatus'])->name('updateNewEnquiryStatus');


Route::get('/editServiceInfo/{id}',[ServiceInfoController::class,'edit'])->name('editServiceInfo');
Route::put('/updateServiceInfo/{id}',[ServiceInfoController::class,'update'])->name('updateServiceInfo');
Route::get('/deleteServiceInfo/{id}',[ServiceInfoController::class,'destroy'])->name('deleteServiceInfo');

Route::get('/editNewEnquiry/{id}',[NewEnquiryController::class,'edit'])->name('editNewEnquiry');
Route::put('/updateNewEnquiry/{id}',[NewEnquiryController::class,'update'])->name('updateNewEnquiry');
Route::get('/deleteNewEnquiry/{id}',[NewEnquiryController::class,'destroy'])->name('deleteNewEnquiry');



Route::get('/products',[ProductController::class,'index'])->name('products');
Route::get('/addProducts',[ProductController::class,'add'])->name('productsAdd');
Route::post('/storeProducts',[ProductController::class,'store'])->name('storeProducts');
Route::get('/editProduct/{id}',[ProductController::class,'edit'])->name('editProduct');
Route::put('/updateProduct/{id}',[ProductController::class,'update'])->name('updateProduct');
Route::get('/deleteProduct/{id}',[ProductController::class,'destroy'])->name('deleteProduct');

Route::get('emailConfig',[EmailConfigController::class, 'index'])->name('emailConfig');
Route::get('/addEmailConfig',[EmailConfigController::class,'add'])->name('addEmailConfig');
Route::post('/storeEmailConfig', [EmailConfigController::class,'store'])->name('storeEmailConfig');
Route::get('/editEmailConfig/{id}',[EmailConfigController::class,'edit'])->name('editEmailConfig');
Route::put('/updateEmailConfig/{id}',[EmailConfigController::class,'update'])->name('updateEmailConfig');
Route::get('/deleteEmailConfig/{id}',[EmailConfigController::class,'destroy'])->name('deleteEmailConfig');

Route::get('subcategories',[SubCategoryController::class, 'index'])->name('subcategories');
Route::get('/addSubcategory',[SubCategoryController::class,'add'])->name('addSubcategory');
Route::post('/storeSubcategory', [SubCategoryController::class, 'store'])->name('storeSubcategory');
Route::get('/editSubcategory/{id}',[SubCategoryController::class,'edit'])->name('editSubcategory');
Route::put('/updateSubcategory/{id}',[SubCategoryController::class,'update'])->name('updateSubcategory');
Route::get('/deleteSubcategory/{id}',[SubCategoryController::class,'destroy'])->name('deleteSubcategory');

Route::get('serviceInfoHistory/{id}', [ServiceInfoController::class, 'serviceInfoHistory'])->name('serviceInfoHistory');
Route::get('newEnquiryHistory/{id}', [NewEnquiryController::class, 'newEnquiryHistory'])->name('newEnquiryHistory');

});

Route::get('/addQRCode',[GenerateORCodeController::class,'addQRCode'])->name('addQRCode');
Route::get('/generateQRCode/{type}',[GenerateORCodeController::class,'generateQRCode'])->name('generateQRCode');
Route::get('/listQRCode/{type?}',[GenerateORCodeController::class,'listQRCode'])->name('listQRCode');

Route::get('/allSession', function () {
    $allSessionData = Session::all();
    echo'<pre>';
    var_dump($allSessionData);
    exit;
});

Route::get('/unsetSession', function () {
    Session::flush();
    return 'All session data has been unset.';
});

Route::prefix('qr')->group(function () {
    Route::get('/', [QRController::class, 'index'])->name('qr_index');
    Route::prefix('{region}')->group(function () {
        Route::get('support_for', [QRController::class, 'support_for'])->name('qr_support_for');
        Route::get('new_enquiry', [QRController::class, 'new_enquiry'])->name('qr_new_enquiry');
    });
    Route::post('add/{type}', [QRController::class, 'add_service'])->name('qr_add_service');
});

