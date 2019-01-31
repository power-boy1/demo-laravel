<?php

namespace App\Http\Resources;

use App\Utils\FlashMessage;
use Illuminate\Http\Resources\Json\JsonResource;

class WarningResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => FlashMessage::TYPE_WARNING,
            'title' => FlashMessage::WARNING,
            'text' => $this['text']
        ];
    }
}
