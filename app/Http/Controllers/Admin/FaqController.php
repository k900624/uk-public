<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Repositories\Admin\FaqRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FaqController extends BaseController
{
    protected $faqRepo;
    
    public function __construct(FaqRepository $faqRepo)
    {
        parent::__construct();
        
        $this->faqRepo = $faqRepo;

        view()->share(['heading' => 'FAQ', 'title' => 'Список вопрос / ответов']);
    }

    public function index(Request $request)
    {
        $perPage = 20;

        $selectCatId = (int) $request->cat;

        if ( ! $selectCatId) {
            $faq = $this->faqRepo->getAllFaq($perPage);
            $countFaq = $this->faqRepo->getCountFaq();
        } else {
            $faq = $this->faqRepo->getCategoryFaq($perPage, $selectCatId);
            $countFaq = $this->faqRepo->getCountCategoryFaq($selectCatId);
        }

        foreach ($faq as $item) {
            $item->answer = \Str::limit(html_decode($item->answer), 200);
            $item->timeago = Carbon::parse($item->created_at)->diffForHumans();
        }

        $data['selectCatId'] = $selectCatId;
        $data['faq'] = $faq;
        $data['countFaq'] = $countFaq;
        $data['categories'] = $this->faqRepo->getFaqCategories();

        return view('admin.faq.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['faq'] = new Faq();

        $data['selectCatId'] = (int) $request->cat;

        $data['categories'] = $this->faqRepo->getFaqCategories();

        $data['autoIncrement'] = get_autoincrement('faq');

        $data['action'] = route('admin.faq.store');

        $data['created_at'] = date('Y-m-d H:i:s');

        return view('admin.faq.form', $data)->with(['title' => 'Создание вопроса']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FaqRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $faq = new Faq();
        $faq->question   = $request->question;
        $faq->answer     = $request->answer;
        $faq->published  = $request->published;
        $faq->cat_id     = $request->cat_id;
        $faq->name       = Auth::user()->name;
        $faq->email      = Auth::user()->email;
        $faq->save();
        
        if ($faq) {
            $this->setFeed('Добавил вопрос <a href="'. route('admin.faq.edit', $faq->id) .'">&laquo;'. trim($request->question, '&raquo; &laquo;') .'&raquo;</a>');
        }
        return $this->redirectResponse($faq, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.faq.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = $this->faqRepo->getId($id);

        $this->recordExists($faq);
        
        $data['faq'] = $faq;

        $data['categories'] = $this->faqRepo->getFaqCategories();

        $data['action'] = route('admin.faq.update', $id);

        return view('admin.faq.form', $data)->with(['title' => 'Редактирование вопроса']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FaqRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, $id)
    {
        $faq = $this->faqRepo->getId($id);

        $this->recordExists($faq);

        $data = $request->all();

        $result = $faq->update($data);
        
        if ($result) {
            $this->setFeed('Изменил вопрос <a href="'. route('admin.faq.edit', $faq->id) .'">&laquo;'. trim($request->question, '&raquo; &laquo;') .'&raquo;</a>');
        }
        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.faq.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $faq = $this->faqRepo->getId($id);

        $this->recordExists($faq);
        
        $result = Faq::destroy($id);
        
        if ($result) {
            $this->setFeed('Удалил вопрос &laquo;'. $faq->question .'&raquo;');
        }
        return $this->redirectResponse($result, ['success' => 'Вопрос удален', 'error' => 'Ошибка удаления']);
    }

    /**
     * Activate the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $faq = $this->faqRepo->getId($id);

        $this->recordExists($faq);
        
        $updateData = ['published' => '1'];

        $result = $faq->update($updateData);
        
        return $this->redirectResponse($result, ['success' => 'Вопрос включен', 'error' => 'Ошибка! Вопрос не включен']);
    }

    /**
     * Deactivate the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $faq = $this->faqRepo->getId($id);

        $this->recordExists($faq);
        
        $updateData = ['published' => '0'];

        $result = $faq->update($updateData);
        
        return $this->redirectResponse($result, ['success' => 'Вопрос отключен', 'error' => 'Ошибка! Вопрос не отключен']);
    }

}
