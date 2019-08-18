<?php
namespace App\Files\Model;
use Base;
use Base\Eloquent\File as FileDB;

class File
{
    public function getFilesList()
    {
        $files = FileDB::all();
        $resultArr = $files->toArray();
        return $resultArr;
    }
}
