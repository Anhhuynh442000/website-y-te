<?php

declare(strict_types=1);

namespace App\route;

use App\Controllers\admin\GenerateQrController;
use App\Controllers\admin\GetTotalBlogListController;
use App\Controllers\admin\GetTotalContactController;
use App\Controllers\admin\GetTotalMedicalFileController;
use App\Controllers\admin\GetTotalMedicineController;
use App\Controllers\admin\GetTotalMedicineTypeController;
use App\Controllers\admin\GetTotalUserController;
use App\Controllers\admin\SearchMedicalFileController;
use App\Controllers\admin\ViewBlogAddController;
use App\Controllers\api\AddMedicalFileApiController;
use App\Controllers\api\DeleteCalendarApiController;
use App\Controllers\api\DeleteMedicalFileApiController;
use App\Controllers\api\EditCalendarApiController;
use App\Controllers\api\EditMedicalFileApiController;
use App\Controllers\api\EditStatusCalendarApiController;
use App\Controllers\api\GetHealthController;
use App\Controllers\api\GetMedicalFileApiController;
use App\Controllers\api\GetPrescriptionApiController;
use App\Core\Application;
use App\Core\Router;
use App\Controllers\admin\AddCalendarController;
use App\Controllers\admin\AddMedicineTypeController;
use App\Controllers\admin\DeleteBlogController;
use App\Controllers\admin\DeleteMedicalFileController;
use App\Controllers\admin\EditPrescriptionController;
use App\Controllers\admin\GetPrescriptionEditView;
use App\Controllers\admin\LoginSampleController;
use App\Controllers\admin\LogoutController;
use App\Controllers\admin\MedicineTypeListController;
use App\Controllers\admin\QuickAddCalendarController;
use App\Controllers\admin\AddHealthController;
use App\Controllers\admin\AddMedicalFileController;
use App\Controllers\admin\AddMedicineController;
use App\Controllers\admin\AddPrescriptionController;
use App\Controllers\admin\BlogAddController;
use App\Controllers\admin\BlogDetailController;
use App\Controllers\admin\BlogListController;
use App\Controllers\admin\CalendarAddController;
use App\Controllers\admin\CalendarIndexController;
use App\Controllers\admin\ContactDetailController;
use App\Controllers\admin\ContactListController;
use App\Controllers\admin\DeleteCalendarController;
use App\Controllers\admin\DeleteContactController;
use App\Controllers\admin\DeleteHealthRecordController;
use App\Controllers\admin\EditBlogController;
use App\Controllers\admin\EditCalendarController;
use App\Controllers\admin\EditMedicalFileController;
use App\Controllers\admin\EditMedicineController;
use App\Controllers\admin\EditStatusCalendarController;
use App\Controllers\admin\GetCalendarController;
use App\Controllers\admin\GetDoctorController;
use App\Controllers\admin\MedicalFileController;
use App\Controllers\admin\MedicineListController;
use App\Controllers\admin\ReplyContactController;
use App\Controllers\api\AddCalendarApiController;
use App\Controllers\api\GetApiCalendarController;
use App\Controllers\api\GetAttendeesApiController;
use App\Controllers\api\GetDoctorApiController;
use App\Controllers\admin\UserController;
use App\Controllers\admin\ViewCalendarDetailController;
use App\Controllers\admin\ViewMedicineDetailController;
use App\Controllers\admin\ViewPrescriptionController;
use App\Middleware\AdminAuthMiddleware;
use App\Middleware\ApiMiddleware;

class AdminRoute
{

    private Router $router;

    public function __construct(Application $app)
    {
        $this->router = $app->router;
    }

    public function register()
    {
        $this->router->get('/admin/user-list', [UserController::class, 'getViewUserList'], AdminAuthMiddleware::class);
        $this->router->get(
            '/admin/user-detail',
            [UserController::class, 'getViewUserDetail'],
            AdminAuthMiddleware::class
        );
        $this->router->get('/admin/user-add', [UserController::class, 'getViewUserAdd'], AdminAuthMiddleware::class);
        $this->router->post('/admin/post-user-add', [UserController::class, 'addUser'], AdminAuthMiddleware::class);
        $this->router->post(
            '/admin/post-user-update',
            [UserController::class, 'updateUser'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-reset-password',
            [UserController::class, 'resetPassword'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-delete-user',
            [UserController::class, 'deleteUser'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-update-avatar',
            [UserController::class, 'updateAvatar'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/medical-file-add',
            [MedicalFileController::class, 'getViewMedicalFileAdd'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/medical-file-list',
            [MedicalFileController::class, 'getViewMedicalFileList'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/medical-file-detail',
            [MedicalFileController::class, 'getViewMedicalFileDetail'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/ajax-medical-file-health',
            [MedicalFileController::class, 'getHealthDetail'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/ajax-get-prescription',
            [ViewPrescriptionController::class, 'getPrescription'],
            AdminAuthMiddleware::class
        );
        $this->router->get('/admin/prescription-edit', [GetPrescriptionEditView::class, 'get']);
        $this->router->post('/admin/post-edit-prescription', [EditPrescriptionController::class, 'editPrescription']);
        $this->router->post(
            '/admin/post-medical-file-add',
            [AddMedicalFileController::class, 'addMedicalFile'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-medical-file-edit',
            [EditMedicalFileController::class, 'editMedicalFile'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-medical-file-delete',
            [DeleteMedicalFileController::class, 'delete'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-medical-health-add',
            [AddHealthController::class, 'addHealth'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-medical-health-edit',
            [MedicalFileController::class, 'editHealth'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-prescription-add',
            [AddPrescriptionController::class, 'addPrescription'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-delete-health',
            [DeleteHealthRecordController::class, 'deleteHealth'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/medicine-list',
            [MedicineListController::class, 'getViewMedicineList'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/medicine-type-list',
            [MedicineTypeListController::class, 'getView'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-add-medicine-type',
            [AddMedicineTypeController::class, 'add'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-add-medicine',
            [AddMedicineController::class, 'addMedicine'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/medicine-detail',
            [ViewMedicineDetailController::class, 'getViewMedicineDetail'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-edit-medicine',
            [EditMedicineController::class, 'editMedicine'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/blog-list',
            [BlogListController::class, 'getViewBlogList'],
            AdminAuthMiddleware::class
        );
        $this->router->get('/admin/blog-add', [ViewBlogAddController::class, 'getViewBlogAdd'], AdminAuthMiddleware::class);
        $this->router->post('/admin/post-blog-add', [BlogAddController::class, 'addBlog'], AdminAuthMiddleware::class);
        $this->router->get(
            '/admin/blog-detail',
            [BlogDetailController::class, 'getViewBlogDetail'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-edit-blog',
            [EditBlogController::class, 'editBlog'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-edit-delete',
            [DeleteBlogController::class, 'delete'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/contact-list',
            [ContactListController::class, 'getViewContactList'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/contact-detail',
            [ContactDetailController::class, 'getViewContactDetail'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-reply-contact',
            [ReplyContactController::class, 'replyContact'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-delete-contact',
            [DeleteContactController::class, 'deleteContact'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/calendar',
            [CalendarIndexController::class, 'getViewCalendarIndex'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/calendar-detail',
            [ViewCalendarDetailController::class, 'getView'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-calendar-edit-status',
            [EditStatusCalendarController::class, 'editStatus'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-calendar-edit',
            [EditCalendarController::class, 'edit'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-calendar-delete',
            [DeleteCalendarController::class, 'delete'],
            AdminAuthMiddleware::class
        );
        $this->router->get(
            '/admin/calendar-add',
            [CalendarAddController::class, 'getView'],
            AdminAuthMiddleware::class
        );
        $this->router->post(
            '/admin/post-calendar-add',
            [AddCalendarController::class, 'add'],
            AdminAuthMiddleware::class
        );
        $this->router->post('/admin/logout', [LogoutController::class, 'logout'], AdminAuthMiddleware::class);
        $this->router->post('/admin/re-generate-qr', [GenerateQrController::class, 'generate'], AdminAuthMiddleware::class);

// Test
        $this->router->get('/admin/login', [LoginSampleController::class, 'getView']);
        $this->router->post('/admin/post-login', [LoginSampleController::class, 'login']);


// Internal API
        $this->router->post('/admin/ajax/add-calendar', [QuickAddCalendarController::class, 'addCalendar']);
        $this->router->get('/admin/ajax/get-doctor', [GetDoctorController::class, 'getDoctor']);
        $this->router->get('/admin/ajax/get-calendar', [GetCalendarController::class, 'getCalendar']);
        $this->router->get('/admin/ajax/get-calendar-edit', [GetCalendarController::class, 'getCalendar']);
        $this->router->get('/admin/ajax/search-medical-file', [SearchMedicalFileController::class, 'search']);
        $this->router->get('/admin/ajax/get-total-users', [GetTotalUserController::class, 'get']);
        $this->router->get('/admin/ajax/get-total-medical-files', [GetTotalMedicalFileController::class, 'get']);
        $this->router->get('/admin/ajax/get-total-medicines', [GetTotalMedicineController::class, 'get']);
        $this->router->get('/admin/ajax/get-total-medicines-types', [GetTotalMedicineTypeController::class, 'get']);
        $this->router->get('/admin/ajax/get-total-blog', [GetTotalBlogListController::class, 'get']);
        $this->router->get('/admin/ajax/get-total-contact', [GetTotalContactController::class, 'get']);

// External Api
        $this->router->get(
            '/api/v1/get-calendar',
            [GetApiCalendarController::class, 'getCalendar'],
            ApiMiddleware::class
        );
        $this->router->post('/api/v1/add-calendar', [AddCalendarApiController::class, 'add'], ApiMiddleware::class);
        $this->router->post('/api/v1/edit-calendar', [EditCalendarApiController::class, 'edit'], ApiMiddleware::class);
        $this->router->post(
            '/api/v1/delete-calendar',
            [DeleteCalendarApiController::class, 'delete'],
            ApiMiddleware::class
        );
        $this->router->post(
            '/api/v1/edit-status-calendar',
            [EditStatusCalendarApiController::class, 'edit'],
            ApiMiddleware::class
        );
        $this->router->get('/api/v1/get-attendees', [GetAttendeesApiController::class, 'get'], ApiMiddleware::class);
        $this->router->get('/api/v1/get-doctors', [GetDoctorApiController::class, 'get'], ApiMiddleware::class);
        $this->router->get(
            '/api/v1/get-medical-file',
            [GetMedicalFileApiController::class, 'get'],
            ApiMiddleware::class
        );
        $this->router->post(
            '/api/v1/add-medical-file',
            [AddMedicalFileApiController::class, 'add'],
            ApiMiddleware::class
        );
        $this->router->post(
            '/api/v1/edit-medical-file',
            [EditMedicalFileApiController::class, 'edit'],
            ApiMiddleware::class
        );
        $this->router->post(
            '/api/v1/delete-medical-file',
            [DeleteMedicalFileApiController::class, 'delete'],
            ApiMiddleware::class
        );
        $this->router->get('/api/v1/get-health', [GetHealthController::class, 'get'], ApiMiddleware::class);
        $this->router->get(
            '/api/v1/get-prescription',
            [GetPrescriptionApiController::class, 'get'],
            ApiMiddleware::class
        );
    }
}
