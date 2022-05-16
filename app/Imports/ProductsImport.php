<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\ImportFailed;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class ProductsImport
    implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading,
    ShouldQueue,
    WithEvents,
    SkipsOnError,
    WithUpserts
{
    use Importable, SkipsFailures, SkipsErrors;

//    public function __construct(User $importedBy)
//    {
//        $this->importedBy = $importedBy;
//    }


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([

            'reference' => $row['reference'],
            'category' => $row['category'],
            'name' => $row['name'],
            'brand' => $row['brand'],
            'description' => $row['description'],
            'price' => $row['price'],
            'isActive' => $row['is_active'],
            'stock' => $row['stock'],
            'available' => $row['available'],

        ]);
    }

    public function rules(): array
    {

        return [
            'reference' => 'required|string|unique:products,reference',
            'category' => ['required', Rule::in(['food', 'cleaning', 'health&pc'])],
            'name' => 'required|string|max:50',
            'brand' => 'required|string|max:50',
            'description' => 'required|string|max:250',
            'price' => 'required|gt:0',
            'isActive' => 'boolean',
            'stock' => 'required|integer|gte:0',
            'available' => 'required|integer|gte:0',

        ];
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }



    public function registerEvents(): array
    {

        return [
            ImportFailed::class => function(ImportFailed $event) {



            },
        ];
    }


    public function uniqueBy()
    {
        return 'reference';
    }

}
