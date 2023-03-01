<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Column as columncrad;
use App\Models\TemploraryFile;
use App\Traits\ToolsCrad;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;


final class PostPowerGrid extends PowerGridComponent
{
    use ActionButton, ToolsCrad;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        //$this->showCheckBox();
        $this->persist(['columns', 'filters']);
        return [

            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),

            Header::make()->showSearchInput(),
            //->showToggleColumns(),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Post>
     */
    public function datasource(): Builder
    {

        //  dd(Post::query()->with('tempfile')->orderby('id','desc')->first());
        return Post::query()->with('tempfile')
            ->orderby('id', 'desc');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
        */
    public function ImagInCell($dish)
    {

        $collection = collect($dish->tempfile);
        $filtered = $collection->filter(function ($value, $key) {
            if (str::contains($value->filename, ['.png', '.jpg'])) {
                return $value;
            }
        });

        $modal2 = "";
        $dd = '<button data-modal-target="staticModal" data-modal-toggle="staticModal" type="button"><div class="flex flex-row">';

        foreach ($filtered->flatten()->slice(0, 3) as $key => $value) {

            if (str::contains($value->filename, ['.png', '.jpg', 'gif'])) {
                $codebase64 = base64_encode(Storage::get('avatars/tmp/' . $value->folder . '/small_' . $value->filename));
                $codebase642 = base64_encode(Storage::get('avatars/tmp/' . $value->folder . '/' . $value->filename));

                $modal2 = $modal2 . '
                <div class="hidden duration-200 ease-linear" data-carousel-item="active">
                    <img src="data:image/jpeg;base64,' . $codebase642 . '" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>';

                //    $dd = $dd . '<div class="mr-1"><img class="rounded-full w-10 h-10" src="data:image/jpeg;base64,' . $codebase64 . '" alt="---"></div>';
                $dd = $dd . '<img class="rounded-full w-10 h-10 " src="data:image/jpeg;base64,' . $codebase64 . '" alt="---"> ';
            }
        }

        $ImagenesContainer = '
<div id="animation-carousel" class="relative" data-carousel="static">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
    ' . $modal2 . '
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>';

        $modal = '
<!-- Main modal -->
<div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">

                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
           ' . $ImagenesContainer . '
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="staticModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cerrar</button>
            </div>
        </div>
    </div>
</div>
';

        //   Cache::put($dish->id, $dd . '</button> ' . $modal);
        //  Cache::put($dish->id.'_edit', $dd . '</div>');



        return $dd  . '</button> ' . $modal;
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            /*  ->addColumn('timeline', function (Post $model) {
            return '<button
                            data-drawer-target="drawer-right-'. e($model->id) .'"
                            data-drawer-show="drawer-right-'. e($model->id) .'" data-drawer-placement="right"
                            aria-controls="drawer-right-'. e($model->id) .'"
                            >'. e($model->id) .'</button>


                            <div id="drawer-right-'. e($model->id) .'"
                            class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-96 dark:bg-gray-800"
                            tabindex="-1" aria-labelledby="drawer-right-label">
                            <h5 id="drawer-right-label"
                                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                                <svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                sdsd
                            </h5>
                            <button type="button" data-drawer-hide="drawer-right-'. e($model->id) .'" aria-controls="drawer-right-'. e($model->id) .'"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">sdsd</span>
                            </button>

asass

                        </div> '; }) */
            ->addColumn('created_at_formatted', function (Post $dish) {

                return $this->ImagInCell($dish);

                if (Cache::has($dish->id)) {
                    return Cache::get($dish->id);
                } else {
                    return $this->ImagInCell($dish);
                }
                // return '<img class="h-10" src="data:image/jpeg;base64,'.$dd.'" alt="---">';
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {


        // $COLER= DB::SELECT("SHOW COLUMNS FROM `posts` WHERE FIELD not in ('created_at','updated_at');");
        $COLER = columncrad::where('user_id', Auth::id())->get();

        $arrayt = [];

        //$arrayt[] = Column::make("id at", "id")->sortable();

        foreach ($COLER as $key => $value) {
            $arrayt[] = $this->columncrad($value->label, $value->name, $value->type, $value->hiddentable);
        }

        $arrayt[] = Column::add()->field('timeline', 'created_at');
        return $arrayt;
    }

    public function columncrad($label, $name, $type,$hidden)
    {
        if ($type === "IMAGE") {
            return Column::add()->title($label)->field('created_at_formatted', 'created_at')->sortable();
        }

        if ($hidden ) {
            return Column::make($label, $name)->sortable()->searchable()->makeInputText(dataField: $name)->hidden();
         }
        else{
            if($type==="LIST"){

              $datacol=$this->get_enum_values_query('Posts',$name);


              return Column::make($label, $name)->sortable()->searchable()->makeInputText(dataField: $name);

            //  return Column::make($label, $name)->makeInputSelect($datacol,'label',  $name, ['live-search' => true]);

              //->makeBooleanFilter(dataField: 'in_stock', trueLabel: 'yes', falseLabel: 'no');
                 //->makeInputSelect(Dish::codes(), $label, 'code');

            }
            return Column::make($label, $name)->sortable()->searchable()->makeInputText(dataField: $name);
        }

      /*   if ($type === "INT") {
            return Column::make($label, $name)->sortable()->searchable()->makeInputText(dataField: $name);
        } else {
            return Column::make($label, $name)->sortable()->searchable()->makeInputText(dataField: $name);
        } */
    }




    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Post Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [


            //Button::make('edit', 'Edit')
               // ->class('underline text-blue-500 hover:no-underline')
                //->route('posts.edit', ['post' => 'id']),

                Button::add('Edit')
                ->bladeComponent('my-custom-button', ['dishId' => 'id','module'=>'posts']),

            /*    Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('posts.destroy', ['post' => 'id'])
               ->method('delete') */
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Post Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($post) => $post->id === 1)
                ->hide(),
        ];
    }
    */
}
