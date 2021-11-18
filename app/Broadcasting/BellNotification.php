<?php

namespace App\Broadcasting;

use App\Models\User;

class BellNotification
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
     * @param  \App\Model\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {
        return true;
    }
}
