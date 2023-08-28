<?php

namespace App\Imports;

use App\Models\CarBrand;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCarBrand implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    { 
        $url = $row[1];
        // Get the filename with extension from the URL
        $filename = pathinfo($url, PATHINFO_BASENAME);

        //get public path of you project
        $dir = public_path().'\uploads\carbrand';
        // Combine the target folder and filename to get the full path
        $destinationPath = $dir . '/' . $filename;
        //print_r($destinationPath);exit;

        
        // Download the file from the URL and save it to the destination folder
        $fileContent = file_get_contents($url);
        file_put_contents($destinationPath, $fileContent);
        //print_r($fileContent);exit;

        return new CarBrand([
            'title' => $row[0],
            'image' => $filename ,
            'slug' => strtolower($row[0]),
            'is_archive' => 1,
            'status' => 1,
        ]);

    }
}
