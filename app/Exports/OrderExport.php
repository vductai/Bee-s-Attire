<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements FromCollection, WithHeadings,
    WithStyles, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::with('user')
            ->get()
            ->map(function ($order){
                return [
                    'order_id' => $order->order_id,
                    'user_id' => $order->user->username,
                    'total_price' => number_format($order->total_price) ,
                    'final_price' => number_format($order->final_price) ,
                    'created_at' => Carbon::parse($order->created_at)->format('H:i:s d-m-Y')
                ];
            });
    }


    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Total (đ)',
            'Final (đ)',
            'Date'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Định dạng dòng 2 (header)
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => ['argb' => 'FFFF00'] // Màu vàng cho nền
                ],
            ],
            // Căn chỉnh dòng tiêu đề
            'A:E' => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
            ],
        ];

    }

    public function registerEvents(): array
    {
        return [
            /*AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Thêm tiêu đề "Danh sách đơn hàng + ngày xuất file" ở dòng 1
                $sheet->mergeCells('A1:E1');
                $sheet->setCellValue('A1', 'Danh sách đơn hàng ' . Carbon::now()->format('d-m-Y'));

                // Định dạng cho dòng 1
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 20,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFFF00'], // Nền vàng
                    ]
                ]);

                $startingRow = 3;

                // Dàn hàng tự động cho tất cả các cột
                foreach(range('A', 'E') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            }*/
        ];
    }
}
