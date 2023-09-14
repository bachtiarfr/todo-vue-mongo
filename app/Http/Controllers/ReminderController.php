<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ReminderController extends Controller
{
    public function sendReminderEmail()
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
            $mail->addAddress('to@example.com');
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
