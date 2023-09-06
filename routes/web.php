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

//$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::middleware(['guest'])->group(function () {
    Route::get('/','App\Http\Controllers\authentications\LoginBasic@index')->name('login-basics');
    Route::post('/','App\Http\Controllers\authentications\LoginBasic@login')->name('login-baasics');
    //Route::get('/auth/login-basic', 'App\Http\Controllers\authentications\LoginBasic@index')->name('auth-login-basic');
   
});
    
    

    
    
Route::middleware(['web'])->group(function () {
    //Dashboard
    Route::get('/dashboard/dashboards-analytics', 'App\Http\Controllers\dashboard\Analytics@index')->name('dashboards-analytics');
    //logout
    Route::post('/logout', 'App\Http\Controllers\authentications\LoginBasic@logout')->name('logout');
    // layout
    Route::get('/layouts/without-menu', 'App\Http\Controllers\layouts\WithoutMenu@index')->name('layouts-without-menu');
    Route::get('/layouts/without-navbar', 'App\Http\Controllers\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
    Route::get('/layouts/fluid',  'App\Http\Controllers\layouts\Fluid@index')->name('layouts-fluid');
    Route::get('/layouts/container', 'App\Http\Controllers\layouts\Container@index')->name('layouts-container');
    Route::get('/layouts/blank',  'App\Http\Controllers\layouts\Blank@index')->name('layouts-blank');

    // pages
    Route::get('/pages/account-settings-account',  'App\Http\Controllers\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
    Route::get('/pages/account-settings-notifications', 'App\Http\Controllers\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
    Route::get('/pages/account-settings-connections',  'App\Http\Controllers\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
    Route::get('/pages/misc-error',  'App\Http\Controllers\pages\MiscError@index')->name('pages-misc-error');
    Route::get('/pages/misc-under-maintenance',  'App\Http\Controllers\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

    // authentication
    
    Route::get('/auth/register-basic', 'App\Http\Controllers\authentications\RegisterBasic@index')->name('auth-register-basic');
    Route::post('/auth/register-basic','App\Http\Controllers\authentications\RegisterBasic@register')->name('register-basics');
    Route::post('/form/layouts-vertical',  'App\Http\Controllers\authentications\RegisterBasic@store')->name('form-layouts-vertical');
    Route::get('/auth/forgot-password-basic',  'App\Http\Controllers\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

    // cards
    Route::get('/cards/basic',  'App\Http\Controllers\cards\CardBasic@index')->name('cards-basic');

    // User Interface
    Route::get('/ui/accordion', 'App\Http\Controllers\user_interface\Accordion@index')->name('ui-accordion');
    Route::get('/ui/alerts', 'App\Http\Controllers\user_interface\Alerts@index')->name('ui-alerts');
    Route::get('/ui/badges', 'App\Http\Controllers\user_interface\Badges@index')->name('ui-badges');
    Route::get('/ui/buttons', 'App\Http\Controllers\user_interface\Buttons@index')->name('ui-buttons');
    Route::get('/ui/carousel', 'App\Http\Controllers\user_interface\Carousel@index')->name('ui-carousel');
    Route::get('/ui/collapse', 'App\Http\Controllers\user_interface\Collapse@index')->name('ui-collapse');
    Route::get('/ui/dropdowns', 'App\Http\Controllers\user_interface\Dropdowns@index')->name('ui-dropdowns');
    Route::get('/ui/footer', 'App\Http\Controllers\user_interface\Footer@index')->name('ui-footer');
    Route::get('/ui/list-groups', 'App\Http\Controllers\user_interface\ListGroups@index')->name('ui-list-groups');
    Route::get('/ui/modals', 'App\Http\Controllers\user_interface\Modals@index')->name('ui-modals');
    Route::get('/ui/navbar', 'App\Http\Controllers\user_interface\Navbar@index')->name('ui-navbar');
    Route::get('/ui/offcanvas','App\Http\Controllers\user_interface\Offcanvas@index')->name('ui-offcanvas');
    Route::get('/ui/pagination-breadcrumbs', 'App\Http\Controllers\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
    Route::get('/ui/progress', 'App\Http\Controllers\user_interface\Progress@index')->name('ui-progress');
    Route::get('/ui/spinners',  'App\Http\Controllers\user_interface\Spinners@index')->name('ui-spinners');
    Route::get('/ui/tabs-pills',  'App\Http\Controllers\user_interface\TabsPills@index')->name('ui-tabs-pills');
    Route::get('/ui/toasts',  'App\Http\Controllers\user_interface\Toasts@index')->name('ui-toasts');
    Route::get('/ui/tooltips-popovers',  'App\Http\Controllers\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
    Route::get('/ui/typography',  'App\Http\Controllers\user_interface\Typography@index')->name('ui-typography');

    // extended ui
    Route::get('/extended/ui-perfect-scrollbar',  'App\Http\Controllers\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
    Route::get('/extended/ui-text-divider',  'App\Http\Controllers\extended_ui\TextDivider@index')->name('extended-ui-text-divider');

    // icons
    Route::get('/icons/boxicons',  'App\Http\Controllers\icons\Boxicons@index')->name('icons-boxicons');

    // form elements
    Route::get('/forms/basic-inputs',  'App\Http\Controllers\form_elements\BasicInput@index')->name('forms-basic-inputs');
    Route::get('/forms/input-groups',  'App\Http\Controllers\form_elements\InputGroups@index')->name('forms-input-groups');

    // form layouts
    Route::get('/form/layouts-vertical',  'App\Http\Controllers\form_layouts\VerticalForm@index')->name('form-layouts-verticali');
   
    Route::get('/form/layouts-horizontal',  'App\Http\Controllers\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');
    Route::post('/form/layouts-horizontal',  'App\Http\Controllers\form_layouts\HorizontalForm@store')->name('form-layouts-horizontal');
    // tables
    Route::get('/tables/basic',  'App\Http\Controllers\tables\Basic@index')->name('tables-basic');
    Route::get('/tables/basic/manager',  'App\Http\Controllers\tables\Basic@manager')->name('manager-table');
    Route::get('/tables/basic/teacher',  'App\Http\Controllers\tables\Basic@teacher')->name('teacher-table');
    Route::get('/tables/basic/student',  'App\Http\Controllers\tables\Basic@student')->name('student-table');
    Route::get('/tables/workshop',  'App\Http\Controllers\tables\workshopController@index')->name('tables-workshop');
    Route::post('/tables/basic/{id}',  'App\Http\Controllers\authentications\RegisterBasic@update')->name('tables-basic');
    Route::post('/tables/workshop/{id}',  'App\Http\Controllers\tables\workshopController@update')->name('tables-workshop');
    
    Route::get('/tables/workshop/manager/api/{id}',  'App\Http\Controllers\tables\workshopController@managerWorkshops')->name('tables-workshop-manager');
    Route::get('/tables/workshop/teacher/api/{id}',  'App\Http\Controllers\tables\workshopController@teacherWorkshops')->name('tables-workshop-teacher');
    Route::get('/tables/workshop/student/api/{id}',  'App\Http\Controllers\tables\workshopController@studentWorkshops')->name('tables-workshop-student');

    Route::get('/tables/workshop/view/{id}',  'App\Http\Controllers\tables\workshopController@view')->name('tables-workshop');
    Route::get('/tables/workshop/edit/{id}',  'App\Http\Controllers\tables\workshopController@edit')->name('tables-workshop');
    Route::post('/tables/workshop/edit/{id}',  'App\Http\Controllers\tables\workshopController@update')->name('tables-workshop');
    Route::post('/tables/workshop/rem/{id}',  'App\Http\Controllers\tables\workshopController@remove')->name('tables-workshop');
});
    
