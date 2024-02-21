<?php
namespace App\Traits;

use Illuminate\Auth\MustVerifyPhone as MustVerifyPhoneContract;

trait MustVerifyPhoneTrait
{
    /**
     * Determine if the user has verified their phone number.
     *
     * @return bool
     */
    public function hasVerifiedPhone()
    {
        return !is_null($this->phone_verified_at);
    }

    /**
     * Mark the given user's phone number as verified.
     *
     * @return bool
     */
    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the phone number verification notification.
     *
     * @return void
     */
    public function sendPhoneVerificationNotification()
    {
        // Add code to send the verification code to the user (e.g., via SMS)
    }
}
