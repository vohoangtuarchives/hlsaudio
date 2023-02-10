<?php
namespace App\Datatables;

use App\Models\Video;
use App\Modules\Datatables\Services\DatatablesService;

class VideoTables extends DatatablesService{

    public function query()
    {
        $query = Video::query();
        return $query->orderBy('id', 'desc');
    }

    public function columns()
    {
        $this->addColumn([
            'data' => 'checkbox',
            'class' => 'text-center dt-id',
            'searchable' => false,
            'orderable' => false,
            'title' => '<div class="form-check text-center">
                                <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                            </div>',
            'render' => function($value){
                return '<div class="custom-control custom-checkbox text-center">
                        <input type="checkbox" name="chk_child" value="'.$value->id.'" class="dataTable-checkbox">
                        </div>';
            },
            'raw' => true
        ]);
        $this->addColumn([
            'data' => 'id',
            'name' => 'id',
            'title' => 'Id',
            'searchable' => false,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'text-center dt-id'
        ]);
        $this->addColumn([
            'data' => 'title',
            'name' => 'title',
            'title' => 'Title',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-medium'
        ]);
        $this->addColumn([
            'data' => 'slug',
            'name' => 'slug',
            'title' => 'Slug',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
        ]);

        $this->addColumn([
            'data' => 'category',
            'name' => 'category',
            'title' => 'Category',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-date',
            'render' => function($value){
                return $value->category->title;
            },
        ]);

        $this->addColumn([
            'data' => 'customer',
            'name' => 'customer',
            'title' => 'Customer',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-date',
            'render' => function($value){
                return $value->customer->name;
            },
        ]);

        $this->addColumn([
            'data' => 'created_at',
            'name' => 'created_at',
            'title' => 'Created at',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-date',
            'render' => function($value){
                return date('d-m-Y H:i:s', strtotime($value->created_at));
            },
        ]);

        $this->addColumn([
            'data' => 'action',
            'class' => 'text-center dt-id',
            'title' => 'Action',
            'raw' => true,
            'render' => function($value){
                return view('dashboard.pages.videos.partials.action', [
                    'value' => $value,
                    'entity' => "videos"
                ]);
            },
        ]);
    }
}