<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Customer;
class WelcomeBranch extends Mailable
{
    use Queueable, SerializesModels;



    protected $customer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer  = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('شكرا لإنضمامك لنا')->view('emails.branchWelcome')-with([
            'name' => $this->customer->name,
            'branchName' => $this->customer->branch_name,
        ]);
    }
}
