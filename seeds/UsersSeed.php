<?php

declare(strict_types=1);

use App\Core\Application;

class UsersSeed
{
    public function create() {
        $database = Application::$APPLICATION->database;
        $password = password_hash('123', PASSWORD_DEFAULT);
        $query = "INSERT INTO users (email, firstname, lastname, status, password)
                    VALUES ('hieu@mail.com', 'Dang', 'Hieu', 1, '${password}'),
                            ('hieu2@mail.com', 'Dang', 'Hieu2', 0, '${password}'),
                            ('hieu3@mail.com', 'Dang', 'Hieu3', 0, '${password}')";
        return $database->mysql->query($query);
    }
}
