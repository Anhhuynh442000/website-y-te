<?php

namespace App\Core\Helper;

const PREFIX_PUBLIC = '/public';

class Helper
{
    function custom_link(string $path): string
    {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $pos = strpos($requestUrl, PREFIX_PUBLIC);
        if (!$pos) {
            $pathPublic = '/public';
        } else {
            $pathPublic = substr($requestUrl, 0, $pos + strlen('/public'));
        }
        $http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        return $http . $host . $pathPublic . '/' . $path;
    }

    /**
     * @param string $path
     * @param array $params
     * @return string|void
     */
    public function redirect(string $path, array $params = []): string
    {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $pos = strpos($requestUrl, PREFIX_PUBLIC);
        if (!$pos) {
            $pathPublic = '/public' . $path;;
        } else {
            $pathPublic = substr($requestUrl, 0, $pos + strlen('/public'));
            $pathPublic = $pathPublic . $path;
        }

        if (!empty($params)) {
            $linkParam = '';
            $lastItem = end($params);
            foreach ($params as $key => $value) {
                $linkParam .= $key . '=' . $value;
                if ($value !== $lastItem) {
                    $linkParam .= '&';
                }
            }
            $pathPublic .= '?' . $linkParam;
        }

        return $pathPublic;
    }

    public function getDirectoryUpload(): string
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
        return $directory;
    }

    public function generateRandomString(int $length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
