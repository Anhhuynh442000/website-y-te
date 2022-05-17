<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\BlogController;
use App\Controllers\LoginFacebookController;
use App\Controllers\SearchController;
use App\Controllers\MedicalHealthsController;
use App\Controllers\MedicineController;
use App\Controllers\user\GetDoctorCalendarController;
use App\Controllers\UserController;
use App\Controllers\ApiController;
use App\Controllers\SampleController;
use App\Core\Application;
use App\Core\View\Twig;
use App\Middleware\UserAuthMiddleware;
use App\Model\User;
use App\route\AdminRoute;


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => User::class,
    'db' => [
        'host' => $_ENV['DB_HOST'],
        'username' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'database' => $_ENV['DB_DATABASE'],
    ]
];

$pathViews = dirname(__DIR__) . '/views';
$pathCache = dirname(__DIR__) . '/cache';

$options = [
    'cache' => $pathCache,
    'debug' => $_ENV['APP_DEBUG'],
];

$twig = new Twig($pathViews, $options);

$app = new Application(dirname(__DIR__), $config);
$app->setTwigTemplate($twig);
$app->twig->addGlobalFunction('session', Application::$APPLICATION->session);

//$app->on(Application::EVENT_BEFORE_REQUEST, function() {
//    echo 'Before request';
//});

$app->router->get('/', [SampleController::class, 'index'], UserAuthMiddleware::class);
$app->router->get('/about', [SampleController::class, 'about'], UserAuthMiddleware::class);
$app->router->get('/doctor', [UserController::class, 'getListDoctor'], UserAuthMiddleware::class);
$app->router->get('/doctor/detail-doctor', [UserController::class, 'getDetailDoctor'], UserAuthMiddleware::class);

$app->router->get('/doctor/book-clinic', [SampleController::class, 'bookClinic'], UserAuthMiddleware::class);
$app->router->get('/user/book-list-clinic', [SampleController::class, 'getListBookClinic'], UserAuthMiddleware::class);
$app->router->post('/doctor/post-book-clinic', [SampleController::class, 'postBookClinic'], UserAuthMiddleware::class);
$app->router->get('/doctor/show-calendar', [MedicineController::class, 'showCalander'], UserAuthMiddleware::class);

$app->router->get('/contact', [SampleController::class, 'contact'], UserAuthMiddleware::class);
$app->router->post('/post-contact', [SampleController::class, 'postContact'], UserAuthMiddleware::class);
$app->router->get('/statistic-covid', [SampleController::class, 'StatisticCovid'], UserAuthMiddleware::class);

$app->router->get('/api/users', [ApiController::class, 'getUser'], UserAuthMiddleware::class);

$app->router->post('/api/login', [ApiController::class, 'login']);
$app->router->get('/user/blog', [BlogController::class, 'getAllBlogList'], UserAuthMiddleware::class);
$app->router->get('/user/detail-blog', [BlogController::class, 'getViewBlogByUser'], UserAuthMiddleware::class);
// Phần User
$app->router->get('/user/login', [UserController::class, 'login']);
$app->router->post('/user/post-login', [UserController::class, 'postLogin']);
$app->router->get('/user/logout', [UserController::class, 'logout']);

// Login facebook
$app->router->get('/user/facebook-redirect', [LoginFacebookController::class, 'store']);

$app->router->get('/user/profile', [UserController::class, 'getViewProfile']);
$app->router->post('/user/post-profile', [UserController::class, 'postProfile']);

$app->router->get('/user/register', [UserController::class, 'getViewRegister']);
$app->router->post('/user/post-add-user', [UserController::class, 'postAddUser']);

$app->router->get('/user/forgot-password', [UserController::class, 'getViewForgotPassWord']);

$app->router->get('/user/reset-password', [UserController::class, 'resetPassWord']);

$app->router->get('/verify', [UserController::class, 'VerifyAccount']);

$app->router->get('/user/medican-record', [MedicineController::class, 'getViewMedicanRecord'], UserAuthMiddleware::class);

$app->router->post('/user/post-medican-record', [MedicineController::class, 'postMedicanRecord'], UserAuthMiddleware::class);
$app->router->post('/user/update-medican-record', [MedicineController::class, 'updateMedicanRecord'], UserAuthMiddleware::class);

// Khai báo y te
$app->router->get('/user/medical-healths', [MedicalHealthsController::class, 'index'], UserAuthMiddleware::class);
$app->router->post('/user/post-medical-healths',  [MedicalHealthsController::class, 'store'], UserAuthMiddleware::class);
$app->router->get('/user/search-doctor', [SearchController::class, 'SearchDoctor'], UserAuthMiddleware::class);
// Calendar user
$app->router->get('/user/ajax/get-doctor-calendar', [GetDoctorCalendarController::class, 'get'], UserAuthMiddleware::class);

$adminRoute = new AdminRoute($app);
$adminRoute->register();
$app->run();
