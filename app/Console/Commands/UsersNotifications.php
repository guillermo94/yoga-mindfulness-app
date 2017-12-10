<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Usuario;
use LaravelFCM\Message\Topics;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class UsersNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {

        $usuarios = Usuario::where('notif_activas','=',1)->get();
        foreach ($usuarios as $usuario){
                $notificationBuilder = new PayloadNotificationBuilder('¡Hora de prácticar!');
                $notificationBuilder->setBody('Realiza uno o varios ejercicios como te has propuesto y te sentirtás mejor.')
                    ->setSound('default');//->setIcon('http://'.$_SERVER['SERVER_ADDR'].$newEjercicio->miniatura);

                $notification = $notificationBuilder->build();

                $topic = new Topics();
                $topic->topic('notification_16');

                $topicResponse = FCM::sendToTopic($topic, null, $notification, null);

                $topicResponse->isSuccess();
                $topicResponse->shouldRetry();
                $topicResponse->error();
       }


    }
}
