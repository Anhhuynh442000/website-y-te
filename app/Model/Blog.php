<?php
namespace App\Model;

use App\Core\Database\DBModel;
use App\Core\Database\Query;
class Blog extends DBModel
{
    public function rules(): array
    {
        return [
            'title' => [self::RULE_REQUIRED],
            'content' => [self::RULE_REQUIRED],
        ];
    }
    public function getAllBlog()
    {
        $query = "SELECT mb.id, mb.created_at, mb.content,mp.first_name, mp.last_name FROM medical_blogs mb join medical_users mu 
                    on mb.user_id = mu.id join medical_user_profiles mp
                    on mu.id = mp.user_id";
        $result = $this->getDatabase()->mysql->query($query);
        $numRows = $result->num_rows;
                if ($numRows > 0) {
                    return $result->fetch_all(MYSQLI_ASSOC);
                }
    }
    public function getBlogById($id)
    {
        $query = "SELECT mb.id, mb.title, mb.created_at, mb.content,mp.first_name, mp.last_name FROM medical_blogs mb join medical_users mu 
                    on mb.user_id = mu.id join medical_user_profiles mp
                    on mu.id = mp.user_id where mb.id= ".$id;
        $result = $this->getDatabase()->mysql->query($query);
        $numRows = $result->num_rows;
                if ($numRows > 0) {
                    return $result->fetch_all(MYSQLI_ASSOC);
                }
    }
}