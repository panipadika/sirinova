<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminResetPasswordNotification extends Notification
{
    use Queueable;

    public string $token;
    public string $resetUrl;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $token, string $email)
    {
        $this->token = $token;
        $this->resetUrl = route('admin.password.reset', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $expireMinutes = config('auth.passwords.users.expire', 15);
        $namaAdmin = $notifiable->nama ?? 'Administrator';

        return (new MailMessage)
            ->subject('Permintaan Reset Kata Sandi Administrator - SI RINOVA')
            ->greeting("Halo, {$namaAdmin}")
            ->line('Kami menerima permintaan untuk mengatur ulang kata sandi akun Administrator Anda pada sistem SI RINOVA Bapperida Kota Tasikmalaya.')
            ->action('Atur Ulang Kata Sandi', $this->resetUrl)
            ->line("Tautan pemulihan kata sandi ini bersifat rahasia, hanya dapat digunakan satu kali, dan akan kedaluwarsa dalam waktu {$expireMinutes} menit.")
            ->line('Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini. Kata sandi akun Anda tidak akan berubah.')
            ->salutation("Salam hormat,\nTim Bapperida Kota Tasikmalaya");
    }
}
