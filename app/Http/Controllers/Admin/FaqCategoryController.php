<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminFaqRequest;
use App\Models\FaqCategory;
use App\Repositories\Admin\FaqRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\ResponseLib;

class FaqCategoryController extends BaseController
{
    public function create()
    {
        if (request()->ajax()) {

            $data['category'] = new FaqCategory();
            $data['action'] = route('admin.faq.category.store');

            $response = new ResponseLib();

            $response->dialog([
                "title" => "Создание категории",
                "body" => view("admin.faq.categories.modal_form", $data)->render(),
                "size" => "default",
            ]);
            $response->send();
            
        } else {
            return response()->json('error', 404);
        }
    }

    public function store(Request $request, FaqRepository $faqRepository)
    {
        $title = $faqRepository->checkUniqueCategoryTitle($request->title);

        if ($title) {
            $this->notify->error('Такая категория уже существует, введите другое название!');
            return back()
                ->withInput();
        }

        $category = new FaqCategory();
        $category->title = $request->title;
        $category->save();
        
        if ($category) {
            $this->setFeed('Добавил категорию FAQ &laquo;'. $request->title .'&raquo;');
        }
        return $this->redirectResponse($category, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении']);
    }

    public function edit(FaqRepository $faqRepository, $id)
    {
        $category = $faqRepository->getCategoryId($id);

        $this->recordExists($category);

        if (request()->ajax()) {
            
            $data['category'] = $category;
            $data['action'] = route('admin.faq.category.update', $id);

            $response = new ResponseLib();

            $response->dialog([
                "title" => "Редактирование категории",
                "body" => view("admin..faq.categories.modal_form", $data)->render(),
                "size" => "default",
            ]);
            $response->send();
            
        } else {
            return response()->json('error', 404);
        }
    }

    public function update(Request $request, $id)
    {
        $category = FaqCategory::find($id);

        $this->recordExists($category);

        $category->title = $request->title;

        $result = $category->save();
        
        if ($result) {
            $this->setFeed('Изменил категорию FAQ &laquo;'. $request->title .'&raquo;');
        }
        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении']);
    }

    public function delete($id)
    {
        $category = FaqCategory::find($id);

        $this->recordExists($category);
        
        $result = FaqCategory::destroy($id);
        
        if ($result) {
            $this->setFeed('Удалил категорию FAQ &laquo;'. $category->title .'&raquo;');
        }
        return $this->redirectResponse($result, ['success' => 'Категория удалена', 'error' => 'Ошибка удаления']);
    }

}
