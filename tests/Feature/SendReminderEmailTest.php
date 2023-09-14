<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use Illuminate\Support\Facades\Mail;
use App\Mail\IncompleteItemMail;

class SendReminderEmailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_send_reminder_email()
    {
        $response = $this->get('/send-reminder-email');

        $response->assertStatus(200);
    }
}
