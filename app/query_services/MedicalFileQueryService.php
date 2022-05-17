<?php

declare(strict_types=1);

namespace App\query_services;

use App\Core\Database\Query;
use App\dto\api\MedicalFileForApiDto;
use App\dto\MedicalFileForSearchDto;

class MedicalFileQueryService implements MedicalFileQueryServiceInterface
{
    /**
     * @var false|\mysqli|null
     */
    private $db;

    public function __construct()
    {
        $query = new Query();
        $this->db = $query->getDatabase()->mysql;
    }

    public function getMedicalFile($id): MedicalFileForApiDto
    {
        $sql = "SELECT MR.id, MR.first_name, MR.last_name, MR.gender, MR.birthday, MR.identity_card, MR.email, MR.phone, MR.way, MR.district, MR.wards, MR.province, MR.covid_vaccination, MR.user_id, MI.health_insurance, MI.health_insurance_number, MI.expiration_date
            FROM medical_medical_records AS MR INNER JOIN medical_medical_insurances AS MI ON MR.id = MI.id_medical_records
            WHERE MR.id = %s";
        $query = sprintf($sql, $id);
        $result = $this->db->query($query);
        if ($result->num_rows === 0) {
            return new MedicalFileForApiDto(null);
        }
        $row = $result->fetch_assoc();
        return new MedicalFileForApiDto(
            (int)$row['id'],
            $row['first_name'],
            $row['last_name'],
            $row['gender'],
            $row['identity_card'],
            $row['birthday'],
            $row['email'],
            $row['phone'],
            $row['way'],
            $row['district'],
            $row['wards'],
            $row['province'],
            $row['covid_vaccination'],
            (int)$row['user_id'],
            $row['health_insurance'],
            $row['health_insurance_number'],
            $row['expiration_date']
        );
    }

    public function getMedicalFileForSearch(string $key_word): array
    {
        $query = "SELECT * FROM `medical_medical_records`
                WHERE last_name LIKE '%$key_word%' OR first_name LIKE '%$key_word%' OR email LIKE '%%s%' OR phone LIKE '%$key_word%';";
        $result = $this->db->query($query);
        $data = [];
        if ($result->num_rows === 0) {
            return $data;
        }
        while ($row = $result->fetch_assoc()) {
            $data[(int)$row['id']] = new MedicalFileForSearchDto(
                (int)$row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['phone']
            );
        }
        return $data;
    }

    public function getTotalMedicalFile(): int {
        $query = "SELECT count(*) AS total_medical_files FROM medical_medical_records;";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        return (int)$row['total_medical_files'];
    }
}
