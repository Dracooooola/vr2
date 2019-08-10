<?php
namespace App\Files\Model;
use Base;

class File
{
    public function getFilesList()
    {
        /** @var \PDO $db*/
        $db = new Base\DBConnection();
        $db = $db->getDB();

        $query = 'SELECT * FROM `files` ';

        $result = $db->prepare($query);
        $result->execute();
        $resultArr = $result->fetchAll();
        return $resultArr;
    }
}
