<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PesertaResetPasswordNotification extends Notification
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
        $this->resetUrl = route('peserta.password.reset', [
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
        $expireMinutes = config('auth.passwords.peserta.expire', 15);
        $namaPeserta = $notifiable->name ?? 'Peserta Lomba';

        return (new MailMessage)
            ->subject('Permintaan Reset Kata Sandi Akun Peserta - SI RINOVA')
            ->greeting("Halo, {$namaPeserta}")
            ->line('Kami menerima permintaan untuk mengatur ulang kata sandi akun Peserta Lomba TTG Anda pada sistem SI RINOVA Kota Tasikmalaya.')
            ->action('Atur Ulang Kata Sandi', $this->resetUrl)
            ->line("Tautan pemulihan kata sandi ini bersifat rahasia, hanya dapat digunakan satu kali, dan akan kedaluwarsa dalam waktu {$expireMinutes} menit.")
            ->line('Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini. Kata sandi akun Anda tidak akan berubah.')
            ->salutation("Salam hormat,\nTim Panitia Lomba TTG Bapperida Kota Tasikmalaya");
    }
}
