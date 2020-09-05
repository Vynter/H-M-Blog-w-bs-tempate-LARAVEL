<?php

namespace App\Jobs;

use App\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\Newsletter as MailNewsletter;

class sendMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $articles = Article::whereDate('published_at', '<=', now()->startOfWeek())->take(10)->get();
        foreach ($this->data as $email) {

            Mail::to($email->mail)->send(new MailNewsletter($email, $articles)); // c la classe qu ise trouve dans app/mail on a du la rename pour confli
        };
    }
}