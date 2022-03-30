<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Actions\SendMails as ActionSendMail;
use App\Models\Post;

class SendMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription-mail:send {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mails to subscribers';

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
        $postId = $this->argument('id');

        $post = Post::findOrFail($postId);
        $send_mail = new ActionSendMail();

        return $send_mail->sendEmails($post);
    }
}
