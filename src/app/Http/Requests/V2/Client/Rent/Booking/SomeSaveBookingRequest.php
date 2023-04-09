<?php

namespace App\Http\Requests\V2\Client\Rent\Booking;

use App\Http\Requests\CommonRequest;
use Carbon\Carbon;

class SomeSaveBookingRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date_start' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    try {
                        Carbon::createFromFormat('Y-m-d', $value);
                    } catch (\Exception) {
                        $fail("invalid_date");
                    }
                },
                'after_or_equal:today',
                'before_or_equal:' . now()->addWeeks(2)->toDateString(),
            ],
            'date_end' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    try {
                        Carbon::createFromFormat('Y-m-d', $value);
                    } catch (\Exception) {
                        $fail("invalid_date");
                    }
                },
                'after_or_equal:today',
                'before_or_equal:' . now()->addWeeks(2)->toDateString(),
            ],

            'booking' => ['array', 'min:1'],

            'booking.*.dress_id' => [
                'bail',
                'required',
                'integer',
                'between:1,4294967296',
                'exists:App\Models\V1\Dress,dress_id',
            ],

            'booking.*.quantity' =>
                [
                    'integer',
                    'between:1, 1000'
                ],

            'booking.*.color_id' =>
                [
                    'required',
                    'integer',
                    'exists:App\Models\V1\Color,color_id',
                ],

            'booking.*.size_id' =>
                [
                    'required',
                    'integer',
                    'exists:App\Models\V1\Size,size_id',
                ],

            'booking.*.components' => ['array'],
            'booking.*.components.*.component_id' =>
                [
                    'sometimes',
                    'integer',
                    'between:1,4294967296',
                ],

            'booking.*.components.*.quantity' =>
                [
                    'sometimes',
                    'integer',
                    'between:1,4294967296',
                ],

            'email' => [
                'required',
                'email:rfc,dns',
            ],

            'phone_number' => [
                'required',
                'regex:/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/',
            ],
        ];
    }
}
