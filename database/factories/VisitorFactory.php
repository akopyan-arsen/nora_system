<?php

namespace Database\Factories;

use App\Enums\PaymentMethods;
use App\Helpers\SettingsHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    /**
     * @return array|mixed[]
     */
    public function definition(): array
    {
        $paymentMethods = PaymentMethods::getValues();
        $notes = [null, fake()->sentence];
        $isPaid = (bool) rand(0, 1);

        return [
            // TODO set time
//            'start_time',
//            'end_time',
            'uah_per_hour' => SettingsHelper::getPricePerHour(),
            'paid_amount' => $isPaid ? 100 : null, // TODO calculate amount
            'discount_amount' => null,
            'discount_unit' => null,
            'is_paid' => $isPaid,
            'payment_method' => $isPaid ? $paymentMethods[rand(0, count($paymentMethods) - 1)] : null,
            'note' => $isPaid ? $notes[rand(0, count($notes) - 1)] : null,
        ];
    }

    /**
     * @return \Database\Factories\VisitFactory
     */
    public function fresh(): VisitorFactory
    {
        return $this->state(function (array $attributes) {
            return [
//                'start_time' => now()->setHour(rand(10, 20))->setMinute(rand(0, 59)),
                'end_time' => null,
                'is_paid' => false,
                'paid_amount' => null,
                'payment_method' => null,
            ];
        });
    }

    /**
     * @return \Database\Factories\VisitFactory
     */
    public function freshClosed(): VisitorFactory
    {
        return $this->state(function (array $attributes) {
            $startTime = now()->setHour(rand(10, 20))->setMinute(rand(0, 59));

            return [
                'start_time' => $startTime,
                'end_time' => $startTime->clone()->addHours(rand(1, 4))->setMinute(rand(0, 59)),
            ];
        });
    }

    /**
     * @return \Database\Factories\VisitFactory
     */
    public function oldClosed(): VisitorFactory
    {
        return $this->state(function (array $attributes) {
            $startTime = now()->addDays(rand(-10, -1))->setHour(rand(10, 20))->setMinute(rand(0, 59));
            $endTime = $startTime->clone();

            return [
                'start_time' => $startTime,
                'end_time' => $endTime->addHours(rand(1, 4))->setMinute(rand(0, 59)),
            ];
        });
    }
}
