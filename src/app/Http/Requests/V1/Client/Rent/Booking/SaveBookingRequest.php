<?php

namespace App\Http\Requests\V1\Client\Rent\Booking;

use App\Http\Requests\CommonRequest;
use App\Models\V1\Dress;
use App\Models\V1\DressComponent;
use App\Models\V1\Component;
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

            'component_id' => [
                'sometimes',
                'array',
                function ($attribute, $value, $fail) {
                    $date = $this->input('date');
                    foreach ($value as $val) {

                        $bookingComponent =
                            Component
                                ::where('component_id', $val)
                                ->withSum(
                                    ['booking_component' => function ($q) use ($date) {
                                        $q->where('date', $date);
                                    }],
                                    'quantity'
                                )
                                ->first();

                        foreach ($this->input('component_quantity') as $quantity) {
                            if ($bookingComponent->booking_component_sum_quantity + $quantity > $bookingComponent->quantity) {
                                $fail("booking_to_keep_the_number_of_components_less_than_necessary");
                            }
                            if ($quantity > $bookingComponent->quantity) {
                                $fail("invalid_component_quantity");
                            }
                        }
                    }
                },
            ],
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
            'component_quantity' => 'sometimes|array',
            'component_quantity.*' => [
                'required',
                'integer',
                'between:1,4294967296',
            ],
        ];
    }
}
