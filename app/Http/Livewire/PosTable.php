<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Post;
use App\Models\Column as columncrad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use App\Exports\PostsExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PosTable extends DataTableComponent
{
    //protected $model = Post::class;

    public function builder(): Builder
    {
        return Post::query()->orderby('id','desc');
    }

    public array $bulkActions = [
        'exportSelected' => 'Exportar',
        'AddRowPost' => 'Nueva Fila',
    ];

    public function AddRowPost(){
        $row = new post();
        $row->save();

        return redirect("posts/{$row->id}/edit");
    }

    public function exportSelected()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new PostsExport($users), 'Post.xlsx');
    }


    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {


      // $COLER= DB::SELECT("SHOW COLUMNS FROM `posts` WHERE FIELD not in ('created_at','updated_at');");
      $COLER= columncrad::where('user_id',Auth::id())->get();


       $arrayt=[];
       $arrayt[]=Column::make("id")->sortable();
       foreach($COLER as $key =>$value){
           $arrayt[]=Column::make($value->label,$value->name)->sortable()->searchable();
       }

       $arrayt[]=ButtonGroupColumn::make('Actions')
       ->attributes(function($row) {
           return [
               'class' => 'space-x-2',
           ];
       })
       ->buttons([
           LinkColumn::make('Edit')
               ->title(fn($row) => __('Edit') )
               ->location(fn($row) => route('posts.edit', $row))
               ->attributes(function($row) {
                   return [
                       'class' => 'underline text-blue-500 hover:no-underline',
                   ];
               }),
            ]);




       return $arrayt;
//       array_push($arrayt,Column::make("Id", "id")->sortable());

        return [
            $arrayt,


          /*   Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(), */

                ButtonGroupColumn::make('Actions')
            ->attributes(function($row) {
                return [
                    'class' => 'space-x-2',
                ];
            })
            ->buttons([
                LinkColumn::make('Edit')
                    ->title(fn($row) => __('Edit') )
                    ->location(fn($row) => route('users.edit', $row))
                    ->attributes(function($row) {
                        return [
                            'class' => 'underline text-blue-500 hover:no-underline',
                        ];
                    }),
            ]),

        ];
    }
}
