<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;

class SendReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-reminder-email:scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schduler reminder to email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mail = new PHPMailer(true);
        
        try {
            $items = Item::where('completed', '!=', true)->get();
            
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 2525;
    
            $mail->setFrom('from@example.com');
            $mail->addAddress($request->email);
            $mail->isHTML(true);
            
            $view = view('emails.incomplete_item', compact('items'));
            $mail->Subject = 'Task Reminder';
            $mail->Body = $view->render();
    
            $mail->send();
    
            return 'Email sent successfully!';
        } catch (Exception $e) {
            return 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        }
    }

    public static function sendReminderEmail(Request $request)
    {   
        $mail = new PHPMailer(true);
        
        try {
            $items = Item::where('completed', '!=', true)->get();
            
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 2525;
    
            $mail->setFrom('from@example.com');
            $mail->addAddress($request->email);
            $mail->isHTML(true);
            
            $view = view('emails.incomplete_item', compact('items'));
            $mail->Subject = 'Task Reminder';
            $mail->Body = $view->render();
    
            $mail->send();
    
            return 'Email sent successfully!';
        } catch (Exception $e) {
            return 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        }
    }
}
