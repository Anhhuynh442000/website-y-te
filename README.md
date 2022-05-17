# How to use framework
## 1. Các kĩ thuật được sử dụng

* PHP
* Template engine (Twig)
* ReactJs
* Typescript
* Webpack
## 2. Cấu hình framework

- Cấu hình của framework được config trong file `.env`
```dotenv
DB_HOST = localhost     #Host
DB_USER = root          #Username database
DB_PASSWORD = password  #Password user database
DB_DATABASE = phpmvc    #Tên Database

APP_DEBUG=true
```
## 3. Cách chạy
### 3.1 Chạy framework với server page
* Mở terminal trong thư mục `phpmvc`, chạy lệnh `composer install` sau đó chạy băng 1 trong 2 cách dưới đây
    * Cách 1: Mở terminal trong thư mục `phpmvc` chạy lệnh `php -S 127.0.0.1:8888`. Sau đó truy cập vào đường dẫn trên trình duyệt `localhost:8888`
    * Cách 2: Copy thư mục phpmvc vào thư mục xampp sau đó truy cập trên url `http://[host]/phpmvc/public`
### 3.2 Chạy framework với Reactjs 

* B1: Mở terminal trong thư mục `phpmvc`, chạy lệnh `npm install`
* B2: Chạy lệnh compile `npm run watch`. Nếu môi trường production thì chạy lệnh `npm run build`
* B3: Chạy web bình thường, chọn 1 trong 2 cách ở 3.1

## 4. Cấu trúc Server

- Route được định nghĩa trong `public/index.php`

Ex:
```php
<?php
// TODO: Code here
$app->router->get('/', [SampleController::class, 'index']);
$app->router->get('/api/users', [ApiController::class, 'getUser']);
```
- Controller được định nghĩa trong `app/Controllers`

Ex: `SampleController.php`
```php
<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller\BaseController;

class SampleController extends BaseController {
    public function index (): string
    {
        return $this->twig->render('welcome');
    }
}
```
- Model được định nghĩa trong `app/Model`

Ex: `SampleModel.php`
```php
<?php
declare(strict_types=1);

use App\Core\Database\DBModel;

class SampleModel extends DBModel
{

    public function rules(): array
    {
        // TODO: Implement rules() method.
    }

   public function tableName(): string
   {
      return 'users';
   }
};
```
- View được định nghĩa trong `views`

Ex: `welcome.twig`
```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>Welcome!!!!!</h2>
</body>
</html>
```
- File js được định nghĩ trong thư mục `public/js`
- File css được định nghĩ trong thư mục `public/css`
- Image được định nghĩ trong thư mục `public/image`

## 5. Cấu trúc client

ReactJs được viết trong thư mục `public/src` và sẽ được compile ra thư mục `public/dist`

Để chạy được React thì cần 1 file template và nhúng file JS đã compile vào file template

Ex: `index.twig`
```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>Hello World!</h2>
<script src="{{ helper.custom_link('js/dist/index.js')}}"></script>
</body>
</html>
```

Vì sử dụng typescript nên extension là `.tsx` hoặc `.ts`

- Component react được lưu trong `public/src/components`
  
  - Trong mỗi component có thể chứa file css. File css có dạng `.scss`
 hoặc là `.sass`
  - Trong mỗi component cũng có thể chứa file image, các loại image được hỗ trợ `png|jpeg|ipg|gif`
  - Trong mỗi component cũng có thể chứa file `svg`
  - Image được import khi runtime sẽ được compile vào thư mục `dist/images`
- Pages react được lưu trong `public/src/pages`
- Service call API được lưu trong `public/src/services`
- `public/src/index.js` là entry file
