<?php

namespace App\Console\Commands;

use App\Article;
use App\Newsletter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Newsletter as MailNewsletter;
use Carbon\Carbon;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:send-newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending email for all subscribed users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //récupération des mail
        $users = Newsletter::pluck('mail');
        //récupération des articles qui ont été crée cette semaine
        $articles = Article::whereDate('published_at', '<=', now()->startOfWeek())->take(10)->get();

        foreach ($users as $email) {

            Mail::to($email)->send(new MailNewsletter($email, $articles)); // c la classe qu ise trouve dans app/mail on a du la rename pour confli
        };

        $this->info('job finished');
        return 0;
    }
}