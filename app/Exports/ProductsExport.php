<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;


class ProductsExport implements FromQuery, WithHeadings/*, Responsable, ShouldQueue*/

{
    use Exportable;

    public function __construct(string $category)
    {
        $this->category = $category;
    }

//    private $fileName = 'invoices.xlsx';
//
//    private $writerType = Excel::XLSX;
//
//    private $headers = [
//        'Content-Type' => 'text/csv',
//    ];


    public function query()
    {
        if ($this->category = 'all') {
            return Product::query();
        }
        else {
            return Product::query()->where('category', $this->category);
        }
    }

    public function headings(): array
    {
        return [

            'reference',
            'category',
            'name',
            'brand',
            'description',
            'price',
            'is_active',
            'stock',
            'available'
        ];
    }
}
