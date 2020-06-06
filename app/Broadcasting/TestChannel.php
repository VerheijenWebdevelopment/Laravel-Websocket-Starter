<?php

namespace App\Broadcasting;

use App\Models\User;

class TestChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
        ];
    }
}
