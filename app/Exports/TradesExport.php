<?php

namespace App\Exports;

use App\Models\Trade;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TradesExport implements
    FromQuery,
    ShouldAutoSize,
    WithHeadings,
    WithMapping,
    WithEvents
{
    use Exportable;

    public function __construct($portfolio)
    {
        $this->portfolio = $portfolio;
    }

    public function query()
    {
        return Trade::query()->where('portfolio_id', $this->portfolio);
    }

    public function headings(): array
    {
        return [
            'Symbol',
            'Type side',
            'Quantity',
            'Entry price',
            'Exit price',
            'Sl price',
            'Risk reward',
            'Time Frame',
            'Entry date',
            'Exit date',
            'Profit currency',
            'Profit pips',
            'Return',
            'Fees',
            'Commentar',
        ];
    }

    public function map($trade): array
    {
        return [
            $trade->symbol,
            $trade->type_side,
            $trade->quantity,
            $trade->entry_price,
            $trade->exit_price,
            $trade->stop_loss_price,
            $trade->tradePerformance->ratio,
            $trade->time_frame,
            $trade->entry_date,
            $trade->exit_date,
            $trade->pl_currency,
            $trade->pl_pips,
            $trade->tradePerformance->trade_return,
            $trade->fees,
            $trade->trade_notes,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:O1')->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
                $event->sheet->getStyle('A1:O1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A1:O1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A1:O1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ]
                ]);
            }
        ];
    }
}
