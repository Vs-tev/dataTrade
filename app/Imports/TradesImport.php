<?php

namespace App\Imports;

use App\Models\Trade;
use App\Rules\CheckExcelDate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Rules\PortfolioDateOverlapping;

HeadingRowFormatter::default('none');

class TradesImport implements ToCollection, WithHeadingRow
{
    use SkipsFailures;

    public function __construct(int $portfolio_id)
    {
        $this->portfolio_id = $portfolio_id;
    }

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.Type side' => ['required', Rule::in(['buy', 'sell'])],
            '*.Quantity' => ['required', 'numeric', 'min:0', 'max:99999999999'],
            '*.Symbol' => ['required', 'exists:App\Models\Symbol,symbol'],
            '*.Entry price' => ['required', 'numeric', 'min:0', 'max:99999999999'],
            '*.Exit price' => ['required', 'numeric', 'min:0', 'max:99999999999'],
            '*.Sl price' => ['required', 'numeric', 'min:0', 'max:99999999999'],
            '*.Time Frame' => Rule::in(['1 min', '5 min', '15 min', '30 min', '1 hour', '2 hours', '4 hours', '1 day', '1 week', '1 month']),
            '*.Entry date' => ['required', 'bail', new CheckExcelDate, new PortfolioDateOverlapping],
            '*.Exit date' => ['required', 'bail', new CheckExcelDate, new PortfolioDateOverlapping],
            '*.Profit currency' => ['required', 'numeric', 'min:-99999999999', 'max:99999999999'],
            '*.Profit pips' => ['required', 'numeric', 'min:-99999999', 'max:99999999'],
            '*.Fees' => ['nullable', 'numeric', 'min:-99999999', 'max:99999999'],
        ], [
            'numeric' => 'Check row :attribute if is numeric.',
            'required' => 'The row :attribute is empty or has a valid data.',
            'exists' => 'The used symbol on row :attribute is invalid.',
            'in' => 'The row :attribute is incorrect. Use "buy" or "sell"',
        ])->validate();

        foreach ($rows as $row) {
            $trade = Trade::create([
                'symbol' => $row['Symbol'],
                'type_side' => $row['Type side'],
                'time_frame' => $row['Time Frame'],
                'quantity' => $row['Quantity'],
                'entry_price' => $row['Entry price'],
                'exit_price' => $row['Exit price'],
                'stop_loss_price' => $row['Sl price'],
                'time_frame' => $row['Time Frame'],
                'entry_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['Entry date']),
                'exit_date' => $row['Exit date'],
                'pl_currency' => $row['Profit currency'] - $row['Fees'],
                'pl_pips' => $row['Profit pips'],
                'fees' => $row['Fees'],
                'trade_notes' => $row['Commentar'],
                'trade_img' => 'noimage.png',
                'portfolio_id' => $this->portfolio_id,
                'user_id' => auth()->id(),

            ]);

            $trade->balance()->create([
                'amount' => $row['Profit currency'] - $row['Fees'],
                'action_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['Entry date']),
                'action_type' => 'trade',
                'portfolio_id' => $this->portfolio_id,
                'trade_id' => $trade->id,
            ]);
            // dd($row["Risk reward"]);
            $trade->tradePerformance()->create([
                'trade_return' => $row["Return"] ? $row["Return"] : 0,
                'trade_id' => $trade->id,
                'ratio' => !$row["Risk reward"] ? ($trade->entry_price - $trade->exit_price) / ($trade->stop_loss_price - $trade->entry_price) : $row["Risk reward"],
                /* 'pow_2' => pow(($return_avg - $trade["trade_return"]), 2), */
                'portfolio_id' => $this->portfolio_id,
            ]);
        }
    }

    public function customValidationMessages()
    {
        return [
            '*.numeric' => 'Custom message for :attribute.',
        ];
    }
}
