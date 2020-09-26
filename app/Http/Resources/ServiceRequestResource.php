<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        switch ($this->status) {
            case 0:
                $status = '<p class="badge badge-info" style="font-size: 100%;font-weight: normal;">Новая заявка</p>';
                $status_title = 'Заявка еще не рассмотрена';
                break;
            case 1:
                $status = '<p class="badge badge-secondary" style="font-size: 100%;font-weight: normal;">Передана на исполнение</p>';
                $status_title = 'Заявка передана в подрядную организацию';
                break;
            case 2:
                $status = '<p class="badge badge-warning" style="font-size: 100%;font-weight: normal;">Принята на исполнение</p>';
                $status_title = 'Заявка находится в стадии выполнения';
                break;
            case 3:
                $status = '<p class="badge badge-success" style="font-size: 100%;font-weight: normal;">Выполнена</p>';
                $status_title = 'Заявка выполнена';
                break;
        }

        return [
            'type'       => 'serviceRequest',
            'id'         => $this->id,
            'attributes' => [
                'description'  => $this->description,
                'created_at'   => $this->created_at,
                'status'       => $status,
                'status_title' => $status_title,
            ],
        ];
    }
}
