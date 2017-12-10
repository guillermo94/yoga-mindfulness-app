<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Usuario;
use LaravelFCM\Message\Topics;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class Kernel extends ConsoleKernel
{

    private $idUsuario;
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
       $usuarios = Usuario::where('notif_activas','=',1)->get();
       foreach ($usuarios as $usuario){
           $this->idUsuario = $usuario->Id;
           $horaArray = explode(':' ,$usuario->hora_notif);
           if($usuario->dias_semana->lunes==1){
               $schedule->call(function () {
                   $notificationBuilder = new PayloadNotificationBuilder('¡Hora de prácticar!');
                   $notificationBuilder->setBody('Realiza uno o varios ejercicios como te has propuesto y te sentirtás mejor.')
                       ->setSound('default');
                   $notification = $notificationBuilder->build();
                   $topic = new Topics();
                   $topic->topic('notification_'.$this->idUsuario);
                   $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
                   $topicResponse->isSuccess();
                   $topicResponse->shouldRetry();
                   $topicResponse->error();
               })->weekly()->mondays()->at(($horaArray[0]+$horaArray[2]).':'.$horaArray[1]);
           }
           if($usuario->dias_semana->martes==1){
               $schedule->call(function () {
                   $notificationBuilder = new PayloadNotificationBuilder('¡Hora de prácticar!');
                   $notificationBuilder->setBody('Realiza uno o varios ejercicios como te has propuesto y te sentirtás mejor.')
                       ->setSound('default');
                   $notification = $notificationBuilder->build();
                   $topic = new Topics();
                   $topic->topic('notification_'.$this->idUsuario);
                   $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
                   $topicResponse->isSuccess();
                   $topicResponse->shouldRetry();
                   $topicResponse->error();
               })->weekly()->tuesdays()->at(($horaArray[0]+$horaArray[2]).':'.$horaArray[1]);
           }
           if($usuario->dias_semana->miercoles==1){
               $schedule->call(function () {
                   $notificationBuilder = new PayloadNotificationBuilder('¡Hora de prácticar!');
                   $notificationBuilder->setBody('Realiza uno o varios ejercicios como te has propuesto y te sentirtás mejor.')
                       ->setSound('default');
                   $notification = $notificationBuilder->build();
                   $topic = new Topics();
                   $topic->topic('notification_'.$this->idUsuario);
                   $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
                   $topicResponse->isSuccess();
                   $topicResponse->shouldRetry();
                   $topicResponse->error();
               })->weekly()->wednesdays()->at(($horaArray[0]+$horaArray[2]).':'.$horaArray[1]);
           }
           if($usuario->dias_semana->jueves==1){
               $schedule->call(function () {
                   $notificationBuilder = new PayloadNotificationBuilder('¡Hora de prácticar!');
                   $notificationBuilder->setBody('Realiza uno o varios ejercicios como te has propuesto y te sentirtás mejor.')
                       ->setSound('default');
                   $notification = $notificationBuilder->build();
                   $topic = new Topics();
                   $topic->topic('notification_'.$this->idUsuario);
                   $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
                   $topicResponse->isSuccess();
                   $topicResponse->shouldRetry();
                   $topicResponse->error();
               })->weekly()->thursdays()->at(($horaArray[0]+$horaArray[2]).':'.$horaArray[1]);
           }
           if($usuario->dias_semana->viernes==1){
               $schedule->call(function () {
                   $notificationBuilder = new PayloadNotificationBuilder('¡Hora de prácticar!');
                   $notificationBuilder->setBody('Realiza uno o varios ejercicios como te has propuesto y te sentirtás mejor.')
                       ->setSound('default');
                   $notification = $notificationBuilder->build();
                   $topic = new Topics();
                   $topic->topic('notification_'.$this->idUsuario);
                   $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
                   $topicResponse->isSuccess();
                   $topicResponse->shouldRetry();
                   $topicResponse->error();
               })->weekly()->fridays()->at(($horaArray[0]+$horaArray[2]).':'.$horaArray[1]);
           }
           if($usuario->dias_semana->sabado==1){
               $schedule->call(function () {
                   $notificationBuilder = new PayloadNotificationBuilder('¡Hora de prácticar!');
                   $notificationBuilder->setBody('Realiza uno o varios ejercicios como te has propuesto y te sentirtás mejor.')
                       ->setSound('default');
                   $notification = $notificationBuilder->build();
                   $topic = new Topics();
                   $topic->topic('notification_'.$this->idUsuario);
                   $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
                   $topicResponse->isSuccess();
                   $topicResponse->shouldRetry();
                   $topicResponse->error();
               })->weekly()->saturdays()->at(($horaArray[0]+$horaArray[2]).':'.$horaArray[1]);
           }
           if($usuario->dias_semana->domingo==1){
               $schedule->call(function () {
                   $notificationBuilder = new PayloadNotificationBuilder('¡Hora de prácticar!');
                   $notificationBuilder->setBody('Realiza uno o varios ejercicios como te has propuesto y te sentirtás mejor.')
                       ->setSound('default');
                   $notification = $notificationBuilder->build();
                   $topic = new Topics();
                   $topic->topic('notification_'.$this->idUsuario);
                   $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
                   $topicResponse->isSuccess();
                   $topicResponse->shouldRetry();
                   $topicResponse->error();
               })->weekly()->sundays()->at(($horaArray[0]+$horaArray[2]).':'.$horaArray[1]);
           }





        }
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
