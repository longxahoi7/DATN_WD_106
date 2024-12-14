<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CouponCreated extends Mailable
{
    use SerializesModels;

    public $coupon;

    /**
     * Create a new message instance.
     *
     * @param  $coupon
     * @return void
     */
    public function __construct($coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Phiếu giảm giá mới của bạn!')
                    ->view('emails.coupon.created') // Đường dẫn tới view email
                    ->with(['coupon' => $this->coupon]);
    }
}
