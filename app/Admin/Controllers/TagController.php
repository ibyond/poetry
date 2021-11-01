<?php

namespace App\Admin\Controllers;

use App\Models\Tag;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class TagController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Tag(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name', '标签名');
            $grid->column('desc', '描述');
            $grid->column('status', '状态')->switch();
            $grid->column('sort', '排序')->help('数值越小越靠前');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->disableDeleteButton();
            $grid->disableBatchDelete();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name', '标签名');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Tag(), function (Show $show) {
            $show->field('id');
            $show->field('name', '标签名');
            $show->field('desc', '描述');
            $show->field('status', '状态')->using(['1' => '启用', '0' => '禁用'])->badge();
            $show->field('sort', '排序')->label();
            $show->field('created_at');
            $show->field('updated_at');

            $show->panel()
                ->tools(function ($tools) {
                    $tools->disableDelete();
                });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Tag(), function (Form $form) {
            $form->display('id');
            $form->text('name', '标签名');
            $form->text('desc', '描述');
            $form->switch('status', '状态')->default(1);
            $form->number('sort', '排序')->default(100)->min(1);

            $form->display('created_at');
            $form->display('updated_at');

            $form->disableDeleteButton();

            $form->saving(function (Form $form) {
                // 修改
                $sort = $form->input('sort');
                if ($sort <= 0) {
                    return $form->response()->error('排序必须大于0');
                }
            });
        });
    }
}
