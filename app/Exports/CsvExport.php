<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Excel;

class CsvExport implements  WithHeadings, WithStrictNullComparison, Responsable, FromArray
{
    /**
    * @return Collection
    */
    use Exportable;
    /**
     * Optional Writer Type
     */
    private $writerType = Excel::CSV;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    protected $products;

    public function __construct(array $cate)
    {
        $this->cate = $cate;
    }

    public function array(): array
    {
        return $this->cate;
    }

    public function headings(): array
    {
        return [
            'idea_title',
            'description',
            'department',
            'created_at',
            'views',
            'like',
            'dislike',
            'author',
            'file',
            'comment',
        ];
    }
}
