<?php

declare(strict_types=1);

namespace App\Core\Helper;

class UploadFile
{
    private array $fileInput;
    private string $fileName = '';

    public function __construct(array $fileInput)
    {
        $this->fileInput = $fileInput;
    }

    public function setFileName(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function getFileName(): string
    {
        return empty($this->fileName) ? $this->fileInput['name'] : $this->fileName;
    }

    public function upload($path): bool
    {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $ipServer = $_SERVER['REMOTE_ADDR'];
        $pos = strpos($requestUrl, PREFIX_PUBLIC);
        if ($ipServer !== '127.0.0.1' && $ipServer !== '::1') {
            $directory = 'upload/';
        } else {
            if ($pos) {
                $directory = 'upload/';
            } else {
                $directory = 'public/upload/';
            }
        }
        $fileName = empty($this->fileName) ? $this->fileInput['name'] : $this->fileName;
        $directory = $directory . $path;

        return move_uploaded_file($this->fileInput['tmp_name'], $directory . $fileName);
    }
    public function uploadAvatar($path): bool
    {
        //Thư mục bạn sẽ lưu file upload
        $_FILES["fileupload"] = $this->fileInput['name'];
        $target_dir    = "public/upload/avatars";
        //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
        $target_file   = $target_dir . basename($_FILES["fileupload"]["name"]);

        $allowUpload   = true;

        //Lấy phần mở rộng của file (jpg, png, ...)
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Cỡ lớn nhất được upload (bytes)
        $maxfilesize   = 800000;

        ////Những loại file được phép upload
        $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');


        if (isset($_POST["submit"])) {
            //Kiểm tra xem có phải là ảnh bằng hàm getimagesize
            $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
            if ($check !== false) {
                echo "Đây là file ảnh - " . $check["mime"] . ".";
                $allowUpload = true;
            } else {
                echo "Không phải file ảnh.";
                $allowUpload = false;
            }
        }

        // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
        // Bạn có thể phát triển code để lưu thành một tên file khác
        if (file_exists($target_file)) {
            echo "Tên file đã tồn tại trên server, không được ghi đè";
            $allowUpload = false;
        }
        // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
        if ($_FILES["fileupload"]["size"] > $maxfilesize) {
            echo "Không được upload ảnh lớn hơn $maxfilesize (bytes).";
            $allowUpload = false;
        }


        // Kiểm tra kiểu file
        if (!in_array($imageFileType, $allowtypes)) {
            echo "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
            $allowUpload = false;
        }


        if ($allowUpload) {
            // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
            if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)) {
                echo "File " . basename($_FILES["fileupload"]["name"]) .
                    " Đã upload thành công.";

                echo "File lưu tại " . $target_file;
            } else {
                echo "Có lỗi xảy ra khi upload file.";
            }
        } else {
            echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
        }
    }
}
