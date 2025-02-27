<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyReportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The report file name.
     *
     * @var string
     */
    public string $reportFileName;

    /**
     * Create a new message instance.
     */
    public function __construct(string $reportFileName)
    {
        $this->reportFileName = $reportFileName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daily Task Report',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.daily_report', // Update to your actual view name
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $filePath = storage_path('app/private/' . $this->reportFileName);

        if (!file_exists($filePath)) {
            throw new \Exception("The report file does not exist at path: {$filePath}");
        }
    
        return [
            Attachment::fromPath($filePath),
        ];
    }
}
