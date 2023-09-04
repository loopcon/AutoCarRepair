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
        $processedImageUrl = $this->processImageURL($url);

        return new CarBrand([
            'title' => $row[0],
            'image' => $processedImageUrl,
            'slug' => strtolower($row[0]),
            'is_archive' => 1,
            'status' => 1,
        ]);
    }

    protected function processImageURL($url)
    {
        if (preg_match('/\/d\/(.*?)\//', $url, $matches)) {
            $fileId = $matches[1];
            $directImageLink = "https://drive.google.com/uc?export=download&id={$fileId}";
            return $directImageLink;
        } else {
            // If it's not a Google Drive link, use it as is
            return $url;
        }
    }

}
