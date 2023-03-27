<?php

namespace App\Http\Requests\V1\Client\Rent\Booking;

use App\Http\Requests\CommonRequest;
use App\Models\V1\Dress;
use App\Models\V1\DressComponent;
use Carbon\Carbon;

class SaveBookingRequest extends CommonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => [
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
            'dress_id' => [
                'bail',
                'required',
                'integer',
                'between:1,4294967296',
                'exists:App\Models\V1\Dress,dress_id',
                function ($attribute, $value, $fail) {
                    $date = $this->input('date');

                    $bookingDress =
                        Dress
                            ::where('dress_id', $value)
                            ->withSum(
                                ['booking' => function ($q) use ($date) {
                                    $q->where('date', $date);
                                }],
                                'quantity'
                            )
                            ->first();

                    if ($bookingDress->booking_sum_quantity + $this->input('quantity') > $bookingDress->quantity) {
                        $fail("booking_save_dress_quantity_less_then_needed");
                    }
                    if ($this->input('quantity') > $bookingDress->quantity) {
                        $fail("invalid_quantity");
                    }
                },
            ],
            'email' => 'required|email:rfc,dns',
            'phone_number' => 'required|regex:/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/',
            'quantity' => 'integer|between:1, 1000',

            'component_id' => 'sometimes|array',
            'component_id.*' => [
                'required',
                'integer',
                'between:1,4294967296',
                function ($attribute, $value, $fail) {
                    $component = DressComponent::find($value);

                    if (!$component || $component->dress_id != $this->input('dress_id')) {
                        $fail("invalid_component_for_dress");
                    }
                },
            ],
        ];
    }
}
