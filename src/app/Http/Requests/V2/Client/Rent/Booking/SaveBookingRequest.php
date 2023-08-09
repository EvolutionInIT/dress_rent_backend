<?php

namespace App\Http\Requests\V2\Client\Rent\Booking;

use App\Http\Requests\CommonRequest;
use App\Models\V1\Dress;
use App\Models\V1\DressComponent;
use App\Models\V1\Component;
use App\Models\V1\DressColor;
use App\Models\V1\DressSize;
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
            'color_id' => [
                'required',
                'integer',
                'exists:App\Models\V1\Color,color_id',
                function ($attribute, $value, $fail) {
                    $color =
                        DressColor
                            ::where('color_id', $value)
                            ->pluck('dress_id');

                    $validColor = false;
                    foreach ($color as $id) {
                        if ($id == $this->input('dress_id')) {
                            $validColor = true;
                            break;
                        }
                    }
                    if (!$validColor) {
                        $fail("invalid_color_for_dress");
                    }
                },

                function ($attribute, $value, $fail) {
                    $date = $this->input('date');

                    $dressColor =
                        DressColor
                            ::where('color_id', $value)
                            ->withSum(
                                ['booking_color_size' => function ($q) use ($date) {
                                    $q->where('date', $date);
                                }],
                                'quantity'
                            )
                            ->first();

                    if ($dressColor->booking_color_size_sum_quantity + $this->input('quantity') > $dressColor->quantity) {
                        $fail("booking_to_keep_the_number_of_color_less_than_necessary");
                    }
                    if ($this->input('quantity') > $dressColor->quantity) {
                        $fail("invalid_quantity");
                    }
                },
            ],
            'size_id' => [
                'required',
                'integer',
                'exists:App\Models\V1\Size,size_id',
                function ($attribute, $value, $fail) {
                    $size =
                        DressSize
                            ::where('size_id', $value)
                            ->pluck('dress_id');

                    $validSize = false;
                    foreach ($size as $id) {
                        if ($id == $this->input('dress_id')) {
                            $validSize = true;
                            break;
                        }
                    }
                    if (!$validSize) {
                        $fail("invalid_size_for_dress");
                    }
                },

                function ($attribute, $value, $fail) {
                    $date = $this->input('date');

                    $dressSize =
                        DressSize
                            ::where('size_id', $value)
                            ->withSum(
                                ['booking_color_size' => function ($q) use ($date) {
                                    $q->where('date', $date);
                                }],
                                'quantity'
                            )
                            ->first();

                    if ($dressSize->booking_color_size_sum_quantity + $this->input('quantity') > $dressSize->quantity) {
                        $fail("booking_to_keep_the_number_of_size_less_than_necessary");
                    }
                    if ($this->input('quantity') > $dressSize->quantity) {
                        $fail("invalid_quantity");
                    }
                },


            ],
        ];
    }
}
