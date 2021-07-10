<?php

namespace App\Imports;

use App\Models\Trade;
use App\Models\User;
use App\Notifications\ImportTradesNotification;
use App\Rules\CheckExcelDate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use App\Rules\PortfolioDateOverlapping;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\ImportFailed;


HeadingRowFormatter::default('none');

class TradesImport implements WithValidation, ToCollection, WithHeadingRow, WithEvents, SkipsEmptyRows, WithChunkReading, ShouldQueue
{
    use SkipsFailures, SkipsErrors, RegistersEventListeners, Importable;

    protected $row = 0;
    protected $validator;

    public function __construct(int $portfolio_id, User $user)
    {
        $this->portfolio_id = $portfolio_id;
        $this->user = $user->allowed_amount_trades['max_amount'];
        $this->user_id = $user->id;
        $this->importedBy = $user;
    }

    public function collection(Collection $rows)
    {
        $max_trades = $this->user;

        if (Trade::where('user_id', $this->user_id)->count() + $rows->count() <= $max_trades) {

            $validator = Validator::make($rows->toArray(), [
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
                'required' => 'The row :attribute is empty or has a invalid data.',
                'exists' => 'The used symbol on row :attribute is invalid.',
                'in' => 'The row :attribute is incorrect. Use the following values :values',
            ])->validate();

            $this->row = $rows->count();

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
                    'trade_img' => 'noimage.jpg',
                    'portfolio_id' => $this->portfolio_id,
                    'user_id' => $this->user_id,
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
            $this->importedBy->notify(new ImportTradesNotification(array('success', 'You have ' . $this->getRowCount() . ' trades successfully imported')));
        } else {
            throw \Illuminate\Validation\ValidationException::withMessages(['This uploading will exceed the maximum number of trades (' . $max_trades . ' trades) for this subscription. Please upgrade your plan.']);
        }
    }

    public function rules(): array
    {
        return [
            '*.Symbol' => [
                'required',
            ],
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function getRowCount(): int
    {
        return $this->row;
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {
                if (!empty($event->getException())) {
                    $this->importedBy->notify(new ImportTradesNotification($event->getException()->validator->errors()->all()));
                }
            },
        ];
    }
}
