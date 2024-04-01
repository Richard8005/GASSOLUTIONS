<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificarEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code=$code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content = "<html> Hola <br>";
        $content .= "¡Bienvenido/a a GasSolutions! Para completar el proceso de registro y asegurar la seguridad de tu cuenta, necesitamos verificar la autenticidad de tu dirección de correo electrónico.";
        $content .= "Para completar el registro debes ingresar el código en la aplicación. Ten en cuenta que este código es válido por un tiempo limitado, así que asegúrate de realizar la verificación lo antes posible.<br>";
        $content .= "Codigo: <b>".$this->code."</b> <br>";
        $content .= "Si no haz registrado una cuenta en GasSolutions, por favor ignora este correo electrónico.

        Gracias por confiar en GasSolutions. Si tienes alguna pregunta o necesitas asistencia, no dudes en ponerte en contacto con nuestro equipo de soporte.
        
        ¡Bienvenido/a a bordo!</html>";
        return $this
            ->subject('Verificación de Cuenta en GasSolutions')
            ->html($content);
    }
}
