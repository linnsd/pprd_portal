<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SentMailContact;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   protected $user;
  
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
   
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SentMailContact();
        // Mail::to($this->user['email'])->send($email);
        $user = $this->user;
        Mail::send('emails.contactEmail', ['user' => $user], function ($m) use ($user) {
                    $m->from($user->email, $user->name);
                    $m->to('office@myanmarmia.org', 'MMIA')
                      ->subject('Receiving  Mail From Contact : ' . $user->name);
                }); 
    }
}
