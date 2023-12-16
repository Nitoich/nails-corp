<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TextSendMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $params = http_build_query([
            'user' => '79011132487',
            'password' => '&C2Bn0id',
            'action' => 'post_sms',
            'gzip' => 'none',
            'target' => '+79011132487',
            'message' => 'Я тебя люблю!',
        ]);
        $response = Http::post("https://a2p-sms-https.beeline.ru/proto/http/rest", [
            'user' => '+79011132487',
            'password' => '&C2Bn0id',
            'action' => 'post_sms',
            'gzip' => 'none',
            'target' => '+79011132487',
            'message' => 'Я тебя люблю!',
        ]);
        var_dump($response->status());
        var_dump($response->json());
        return Command::SUCCESS;
    }
}
