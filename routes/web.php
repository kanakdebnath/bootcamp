<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ModualController;
use App\Http\Controllers\BatchesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UnpaidUserController;
use App\Http\Controllers\BkashPaymentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LoginSecurityController;
use App\Http\Controllers\frontend\SupportController;
use App\Http\Controllers\frontend\FrontUserController;
use App\Http\Controllers\AdminServiceRequestController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\frontend\ServiceRequestController;

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

Route::get('/send-emails', [FrontendController::class, 'sendEmails']);
Route::get('/user-status-change', [FrontendController::class, 'UserStatusChange']);
Route::get('/', [FrontendController::class, 'index'])->name('userhome');
Route::get('/thank-you', [FrontendController::class, 'thanks'])->name('thanks');
Route::post('/user/register', [FrontendController::class, 'userRegister'])->name('user-register');

// Bkash Payment
Route::get('/bkash/payment', [BkashPaymentController::class, 'index'])->name('bkash.payment');
Route::get('/bkash/create', [BkashPaymentController::class, 'create'])->name('bkash.create');
Route::post('/bkash/execute', [BkashPaymentController::class, 'execute'])->name('bkash.execute');
Route::post('/bkash/query', [BkashPaymentController::class, 'query'])->name('bkash.query');
Route::get('/bkash/checkout-url/callback', [BkashPaymentController::class, 'callback'])->name('url-callback');
// Bkash Payment

Route::group(['middleware' => ['auth','payment_check'], 'prefix' => 'user' , 'as'=>'user.'], function () {

    Route::get('/dashboard', [FrontUserController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [FrontUserController::class, 'profile'])->name('profile');
    Route::post('/profile-update', [FrontUserController::class, 'profileUpdate'])->name('profile.update');


    Route::get('/meeting', [FrontUserController::class, 'meeting'])->name('meeting');
    Route::get('/live-class', [FrontUserController::class, 'class'])->name('class');
    Route::get('/record-class', [FrontUserController::class, 'recordClass'])->name('record-class');

    Route::any('/support/reply/{id}', [SupportController::class, 'reply'])->name('support.reply');
    Route::resource('support', SupportController::class);

    Route::get('/service-details/{id}', [FrontUserController::class, 'serviceDetails'])->name('service.details');
    Route::get('/service-buy/{id}', [ServiceRequestController::class, 'serviceBuy'])->name('service.buy');
    Route::get('/services', [FrontUserController::class, 'services'])->name('services');

    Route::resource('service', ServiceRequestController::class);

});


Auth::routes();

Route::group(['middleware' => ['auth', '2fa','is_admin'], 'prefix' => 'admin'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['auth', '2fa',]);

    Route::post('/chart', [HomeController::class, 'chart'])->name('get.chart.data')->middleware(['auth',]);

    Route::get('notification', [HomeController::class, 'notification']);

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::get('members/resend/email/{id}', [MemberController::class, 'send_mail'])->name('members.send_mail');
        Route::resource('members', MemberController::class);
        Route::resource('unpaid-users', UnpaidUserController::class);
        Route::resource('permission', PermissionController::class);
        Route::resource('modules', ModualController::class);
    });

    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(['auth']);

    Route::post('/role/{id}', [RoleController::class, 'assignPermission'])->name('roles_permit')->middleware(['auth']);

    Route::group(
        ['middleware' => ['auth']],
        function () {
            Route::get('setting/email-setting', [SettingController::class, 'getmail'])->name('settings.getmail');
            Route::post('setting/email-settings_store', [SettingController::class, 'saveEmailSettings'])->name('settings.emails');
            Route::post('setting/forum-settings_store', [SettingController::class, 'saveForumSettings'])->name('settings.forums');
            Route::post('setting/support-settings_store', [SettingController::class, 'saveSupportSettings'])->name('settings.support');

            Route::get('setting/datetime', [SettingController::class, 'getdate'])->name('datetime');
            Route::post('setting/datetime-settings_store', [SettingController::class, 'saveSystemSettings'])->name('settings.datetime');

            Route::get('setting/logo', [SettingController::class, 'getlogo'])->name('getlogo');
            Route::post('setting/logo_store', [SettingController::class, 'store'])->name('settings.logo');
            Route::resource('settings', SettingController::class);

            Route::get('test-mail', [SettingController::class, 'testMail'])->name('test.mail');
            Route::post('test-mail', [SettingController::class, 'testSendMail'])->name('test.send.mail');
        }
    );

    Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware(['auth']);

    Route::post('edit-profile', [UserController::class, 'editprofile'])->name('update.profile')->middleware(['auth']);

    Route::group(
        ['middleware' => ['auth']],
        function () {
            Route::get('change-language/{lang}', [LanguageController::class, 'changeLanquage'])->name('change.language');
            Route::get('manage-language/{lang}', [LanguageController::class, 'manageLanguage'])->name('manage.language');
            Route::post('store-language-data/{lang}', [LanguageController::class, 'storeLanguageData'])->name('store.language.data');
            Route::get('create-language', [LanguageController::class, 'createLanguage'])->name('create.language');
            Route::post('store-language', [LanguageController::class, 'storeLanguage'])->name('store.language');
            Route::delete('/lang/{lang}', [LanguageController::class, 'destroyLang'])->name('lang.destroy');
            Route::get('language', [LanguageController::class, 'index'])->name('index');
        }
    );

    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder')->middleware(['auth',]);

    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template')->middleware(['auth',]);

    Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template')->middleware(['auth',]);

    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate')->middleware(['auth',]);

    Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback')->middleware(['auth',]);

    Route::post(
        'generator_builder/generate-from-file',
        '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
    )->name('io_generator_builder_generate_from_file')->middleware(['auth',]);

    Route::group(['prefix' => '2fa'], function () {
        Route::get('/', [UserController::class, 'profile'])->name('2fa')->middleware(['auth',]);
        Route::post('/generateSecret', [LoginSecurityController::class, 'generate2faSecret'])->name('generate2faSecret')->middleware(['auth',]);
        Route::post('/enable2fa', [LoginSecurityController::class, 'enable2fa'])->name('enable2fa')->middleware(['auth',]);
        Route::post('/disable2fa', [LoginSecurityController::class, 'disable2fa'])->name('disable2fa')->middleware(['auth',]);

        // 2fa middleware
        Route::post('/2faVerify', function () {
            return redirect(URL()->previous());
        })->name('2faVerify')->middleware('2fa');
    });

    Route::get('/get-user-data/{batchId}', [BatchesController::class, 'getUserData'])->name('get.user.data');
    Route::resource('batches', App\Http\Controllers\BatchesController::class);

    Route::resource('meetings', App\Http\Controllers\MeetingController::class);
    Route::resource('classes', App\Http\Controllers\ClassController::class);
    Route::resource('category', App\Http\Controllers\ServiceCategoryController::class);
    Route::resource('services', App\Http\Controllers\ServiceController::class);
    Route::resource('record-classes', App\Http\Controllers\RecordClassController::class);
    Route::any('/supports/reply/{id}', [App\Http\Controllers\AdminSupportController::class, 'reply'])->name('supports.reply');
    Route::any('/supports/status-change', [App\Http\Controllers\AdminSupportController::class, 'status_change'])->name('supports.status_change');
    Route::resource('supports', App\Http\Controllers\AdminSupportController::class);

    Route::resource('service-request', AdminServiceRequestController::class);
    Route::resource('task', App\Http\Controllers\TaskController::class);
});



Route::group(['middleware' => ['auth','is_employee'], 'prefix' => 'employee'], function () {

    Route::get('/dashboard', [EmployeeController::class, 'index'])->name('employee.dashboard');

    Route::get('/meeting', [EmployeeController::class, 'meeting'])->name('employee.meeting');
    Route::get('/meeting/show/{id}', [EmployeeController::class, 'meeting_show'])->name('employee.meeting.show');
    Route::get('/classes', [EmployeeController::class, 'class'])->name('employee.classes');
    Route::get('/task', [EmployeeController::class, 'task'])->name('employee.task');

});

Route::any('/meetings/status-change', [App\Http\Controllers\MeetingController::class, 'status_change'])->name('meetings.status_change');
Route::any('/classes/status-change', [App\Http\Controllers\ClassController::class, 'status_change'])->name('classes.status_change');
Route::any('/task/status-change', [App\Http\Controllers\TaskController::class, 'status_change'])->name('task.status_change');

