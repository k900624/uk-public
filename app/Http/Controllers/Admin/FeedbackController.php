<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use App\Repositories\Admin\FeedbackRepository;
use App\Services\CurrentUser;
use Carbon\Carbon;
use App\Services\ResponseLib;
use Illuminate\Http\Request;
use YoHang88\LetterAvatar\LetterAvatar;
use Mail;
use App\Mail\FeedbackMail;

class FeedbackController extends BaseController
{
    protected $feedbackRepo;
    
    public function __construct(FeedbackRepository $feedbackRepo)
    {
        parent::__construct();
        
        $this->feedbackRepo = $feedbackRepo;

        view()->share(['heading' => 'Сообщения обратной связи', 'title' => 'Список сообщений']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = 20;

        $selectStatus = $request->status;
        
        $buttons = [
          'reply'       => true,
          'restore'     => false,
          'spam'        => true,
          'delete'      => true,
          'forceDelete' => false,
        ];

        switch ($selectStatus) {
            case 'new':
                $messages = $this->feedbackRepo->getAllMessages($perPage, 'new');
                break;
                
            case 'answer':
                $messages = $this->feedbackRepo->getAllMessages($perPage, 'answer');
                break;
                
            case 'no_answer':
                $messages = $this->feedbackRepo->getAllMessages($perPage, 'no_answer');
                break;
    
            case 'spam':
                $messages = $this->feedbackRepo->getAllMessages($perPage, 'spam');
                $buttons['restore'] = true;
                $buttons['spam'] = false;
                break;

            case 'deleted':
                $messages = $this->feedbackRepo->getAllMessages($perPage, 'deleted');
                $buttons['reply'] = false;
                $buttons['delete'] = false;
                $buttons['forceDelete'] = true;
                $buttons['restore'] = true;
                $buttons['spam'] = false;
                break;

            default:
                $messages = $this->feedbackRepo->getAllMessages($perPage);
                break;
        }

        foreach ($messages as $message) {
            $message->subject = strip_tags(html_decode($message->subject));
            $message->message = \Str::limit(strip_tags(html_decode($message->message)), 50);
            $message->timeago = Carbon::parse($message->created_at)->diffForHumans();

            if ($message->user_id) {
                $message->avatar = url('storage/'. $message->avatar);
            } else {
                $message->avatar = new LetterAvatar($message->name, 'circle', 32);
            }
            
            if ($message->attach) {
              $message->attach = ( ! empty(json_decode($message->attach))) ? : false;
            }
            
            if ($message->status == 'deleted') {
                $message->status_label = 'Удалено';
                $message->status_class = 'danger';
            } elseif ($message->status == 'spam') {
                $message->status_label = 'Спам';
                $message->status_class = 'warning';
            } elseif ($message->answer) {
                $message->status_label = 'Ответили';
                $message->status_class = 'success';
            } else {
                $message->status_label = 'Без ответа';
                $message->status_class = 'grey';
            }
        }

        $countMessages = $this->feedbackRepo->getCountMessages();
        
        $data['selectStatus'] = $selectStatus;
        $data['messages'] = $messages;
        $data['countMessages'] = $countMessages;
        $data['buttons'] = $buttons;

        return view('admin.feedback.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function show($id)
    {
        if (request()->ajax()) {

            $message = $this->feedbackRepo->getMessage($id);

            if ($message) {

                $this->feedbackRepo->changeStatusOnView($id);

                $message->name = ($message->name) ? html_decode($message->name) : 'deleted';
                $message->message = nl2br(html_decode($message->message));
                $message->date = Carbon::parse($message->created_at)->isoFormat('DD MMMM YYYY в HH:mm');
                
                if ($message->status == 'deleted') {
                    $message->status_label = 'Удалено';
                    $message->status_class = 'danger';
                } elseif ($message->status == 'spam') {
                    $message->status_label = 'Спам';
                    $message->status_class = 'warning';
                } elseif ($message->answer) {
                    $message->status_label = 'Ответили';
                    $message->status_class = 'success';
                } else {
                    $message->status_label = 'Без ответа';
                    $message->status_class = 'grey';
                }

                if ($message->attach) {
                    $message->attach = ( ! empty(json_decode($message->attach))) ? json_decode($message->attach) : false;
                }

                $data['message'] = $message;

                $response = new ResponseLib();

                $response->dialog([
                    "title" => "Просмотр сообщения",
                    "body" => view("admin.feedback.modal_details", $data)->render(),
                    "size" => "default",
                ]);
                $response->send();

            } else {
                $this->notify->error('Такого сообщения не существует');
            }

        } else {
            return response()->json('error', 404);
        }
    }

     /**
     * Restore the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $result = Feedback::withTrashed()
            ->where('id', $id)->restore();

        $this->feedbackRepo->changeStatus($id, 'on');

        return $this->redirectResponse($result, ['success' => 'Сообщение восстановлено', 'error' => 'Ошибка! Сообщение не восстановлено']);
    }

     /**
     * ЕщTo spam
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function spam($id)
    {
        $result = Feedback::withTrashed()
            ->where('id', $id)->restore();

        $this->feedbackRepo->changeStatus($id, 'spam');

        return $this->redirectResponse($result, ['success' => 'Сообщению присвоен статус "Спам"', 'error' => 'Ошибка! Сообщение не перемещено']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->feedbackRepo->changeStatus($id, 'deleted');

        $result = Feedback::destroy($id);

        return $this->redirectResponse($result, ['success' => 'Сообщению присвоен статус "Удалено"', 'error' => 'Ошибка удаления']);
    }

    /**
     * Remove from DB the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $result = Feedback::withTrashed()
            ->where('id', $id)->forceDelete();
        
        if ($result) {
            $this->setFeed('Удалил cooбщение #'. $id .' из базы данных');
        }
        return $this->redirectResponse($result, ['success' => 'Сообщение удалено из БД', 'error' => 'Ошибка! Сообщение не удалено из БД']);
    }

    public function ajaxSendEmail(Request $request)
    {
        $response = new ResponseLib();

        $data['message_id'] = $request->id;
        $data['email'] = $request->email;
        $data['subject'] = $request->subject;

        $response->dialog([
            "title" => "Отправить Email",
            "body" => view("admin.feedback.modal_form", $data)->render(),
            "size" => "default",
        ]);
        $response->send();
    }

    public function store(Request $request)
    {
        $rules = [
            'email'      => 'required|email',
            'subject'    => 'required|string|min:2|max:255',
            'message'    => 'required|string|min:5|max:800',
        ];

        // Валидация с ajax
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $feedback = new Feedback();

        if ($request->message_id) {
            // Ответ
            $feedback = Feedback::find($request->message_id);

            $feedback->answer = $request->message;
            $feedback->status = 'on';
            $feedback->save();

        } else {
            // Новое письмо
            $feedback->name = CurrentUser::name();
            $feedback->email = $request->email;
            $feedback->subject = filter_title($request->subject);
            $feedback->message = filter_intro($request->message);
            $feedback->user_id = CurrentUser::id();
            $feedback->ip_address = $request->ip();
            $feedback->save();
        }

        // Send email
        $mailResult = Mail::to($request->email)
            ->send(new FeedbackMail($feedback));

        if ($mailResult) {
            $result = [
                'type'    => 'success',
                'message' => 'Ваше сообщение успешно отправлено!'
            ];
            
            $this->setFeed('Отправил сообщение на email '. $request->email);

        } else {
            $result = [
                'type'    => 'danger',
                'message' => 'Ваше сообщение не отправлено! Попробуйте снова!'
            ];
        }

        return response()->json($result);
    }
}
