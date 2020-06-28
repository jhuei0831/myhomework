<?php

namespace App\Exports;

use App\Upload;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public function __construct(String $homework_id = null)
    {
        $this->homework_id = $homework_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Upload::select()->where('homework_id', $this->homework_id)->get();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    //function header in excel
     public function headings(): array
     {
         return [
             '編號',
             '學號',
             '作業題目',
             '作業檔案',
             '成績',
             '建立時間',
             '更新時間',
        ];
    }
}
