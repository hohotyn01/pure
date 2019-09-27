<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;


class UserService extends BaseService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findByEmailOrCreate(string $email)
    {
        return (
            $this->userRepository->firstOrCreate([
                'email' => $email
            ])
        );
    }

    public function sendOrderShippedEmail(
        User $user,
        Order $order
    ) {
        Mail::to($user->email)->send(
            new OrderShipped($order, $user)
        );
    }
}
