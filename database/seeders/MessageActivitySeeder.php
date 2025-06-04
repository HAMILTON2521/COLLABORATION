<?php

namespace Database\Seeders;

use App\Models\MessageActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageActivity::create([
            'activity' => 'Customer_Creation',
            'description' => 'Send message when customer is created'
        ]);
        MessageActivity::create([
            'activity' => 'Payment_Received',
            'description' => 'Send message when payment is received from customer'
        ]);
        MessageActivity::create([
            'activity' => 'User_Account_Created',
            'description' => 'Send message with verification OTP when user account is created'
        ]);
    }
}
