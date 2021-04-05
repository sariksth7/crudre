<?php

namespace App\Exports;

use App\Posts;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PostExport implements FromCollection, Responsable, ShouldAutoSize, WithMapping, WithHeadings
{
    use Exportable;
    private $fileName = "hero.xls";

    public function collection(){
        return Posts::with('comments')->get();
    }

    public function map($post) : array
    {

        return[
            $post->id,
            $post->title,
            $post->description,
            $post->comments->pluck('comment')->implode(','),
            $post->created_at,
            $post->updated_at
        ] ;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Description',
            'Comment',
            'Created At',
            'Updated At'
        ];
    }
}




/*protected $post;

//from View Exporting Excel
public function __construct()
{
    $this->post = Posts::get()->map(function ($item) {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'description' => $item->description,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });
}

public function view(): View
{
    return view('post.exportpost', [
        'availablePost' => $this->post
    ]);
}*/


