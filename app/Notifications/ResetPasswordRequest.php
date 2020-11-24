<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class ResetPasswordRequest extends Notification implements ShouldQueue
{
    use Queueable;
    protected $token;
    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct($token)
    {
        $this->token = $token;
    }
    /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['mail'];
    }
     /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
     public function toMail($notifiable)
     {
        $url = url('sitter/login/reset_password/' . $this->token);
        $data['token']=$this->token;
        $data['url']=$url;
        // return (new MailMessage)
        //     ->line('You are receiving this email because we received a password reset request for your account.')
        //     ->action('Reset Password', url($url))
        //     ->line('If you did not request a password reset, no further action is required.');
        return(Mail::send('sendMailPassReset', $data, function ($message) {
            $message->from('khoab1606808@gmail.com', 'Khoa Bui');

            $message->to('khoabuii98@yahoo.com');

            $message->subject('Khôi phục mật khẩu của bạn');
        }));
    }
}
