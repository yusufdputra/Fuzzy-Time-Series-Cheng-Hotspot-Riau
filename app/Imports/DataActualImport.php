<?php

namespace App\Imports;

use App\DatasetModel;
use App\KabupatenModel;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;

class DataActualImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DatasetModel([
            'lintang' => $row[0],
            'bujur' => $row[1],
            'tanggal' => $this->transformDate($row[2]),
            'jam' => $row[3],
            'kepercayaan' => $row[4],
            'satelit' => $row[5],
            'kecamatan' => $row[6],
            'id_kabupaten' => $this->RelasiKabupaten($row[7]),
        ]);
        
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    //set kabupaten menjadi relasi dengan tabel kabupaten
    public function RelasiKabupaten($value)
    {
        try {
            //data kabupaten
            $kabupaten_row = KabupatenModel::all();
            foreach ($kabupaten_row as $kb) {
                if ((strpos(strtolower($value), strtolower($kb->kabupaten))) !== false) {
                    return $kb->id;
                }
            }
        } catch (\ErrorException $e) {
            return $value;
        }
    }

}
