<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceReminderMail;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class SendInvoiceReminders extends Command
{
    protected $signature = 'invoices:send-reminders';

    protected $description = 'Send reminders for upcoming invoices';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tenants = User::role('tenant')->get();

        foreach ($tenants as $tenant) {
            $agency = $this->changeDatabase($tenant);
            
            return $agency;
            $amountPaid = $agency->leads_count * 20;

            if (true) {
                $invoice = Payment::where('tenant_id', $tenant->id)
                    ->whereYear('paid_at', Carbon::now()->year)
                    ->whereMonth('paid_at', Carbon::now()->month)
                    ->where('payment_status', '!=', 'Paid')
                    ->first();
            } else {
                $createdAt = Carbon::parse($tenant->created_at);

                $expiryDate = $createdAt->endOfMonth()->subDays(2);

                Payment::updateOrCreate([
                    'tenant_id' => $tenant->id,
                    'amount_paid' => $amountPaid,
                    'paid_at' => null,
                    'payment_status' => "Pending"
                ]);

                if ($createdAt->endOfMonth()->subDays(2) || $createdAt->endOfMonth()->subDays(1)) {
                    $this->sendReminderEmail($tenant);
                    $this->info("Reminder sent for Invoice ID: {$tenant->id}");
                }
            }
        }

        $this->info('Invoice reminders sent successfully.');
    }

    public function changeDatabase($agency)
    {
        config([
            'database.connections.dynamic' => [
                'driver' => 'mysql',
                'host' => env('DB_HOST'),
                'database' => $agency->db_name,
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => true,
                'engine' => null,
            ]
        ]);

        DB::setDefaultConnection('dynamic');

        $leadsCount = DB::table('leads')
            ->select('leads.customer_id', 'customers.name', DB::raw('count(leads.id) as total_leads'))
            ->leftJoin('customers', 'customers.id', '=', 'leads.customer_id')
            ->groupBy('leads.customer_id', 'customers.name')
            ->get();


        DB::setDefaultConnection('mysql');

        $leadsCount->total_leads += 20;

        return $leadsCount;
    }

    public function sendReminderEmail($tenant)
    {
        Mail::to($tenant->email)
            ->send(new InvoiceReminderMail($tenant));
    }
}
