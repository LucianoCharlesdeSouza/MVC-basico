<?php

/**
 * Class Email
 *
 * @author Luciano Charles de Souza
 * E-mail: souzacomprog@gmail.com
 * Github: https://github.com/LucianoCharlesdeSouza
 * YouTube: https://www.youtube.com/channel/UC2bpyhuQp3hWLb8rwb269ew?view_as=subscriber
 */
class Email
{

    use EmailTemplates;

    /** @var PHPMailer */
    public $Mail;

    /** EMAIL DATA */
    private $Data;

    /** CORPO DO E-MAIL */
    private $Assunto;
    private $Mensagem;

    /** REMETENTE */
    private $RemetenteNome;
    private $RemetenteEmail;

    /** DESTINO */
    private $DestinoNome;
    private $DestinoEmail;

    /** ERROR */
    private $error;

    /**
     * Email constructor.
     */
    public function __construct()
    {
        $this->Mail = new PHPMailer();
        $this->Mail->Host = mailer('mail_host');
        $this->Mail->Port = mailer('mail_port');
        $this->Mail->Username = mailer('mail_username');
        $this->Mail->Password = mailer('mail_password');
        $this->Mail->SMTPAuth = mailer('mail_smtpauth');

        if (!empty(mailer('mail_smtpsecure'))):
            $this->Mail->SMTPSecure = mailer('mail_smtpsecure');
        endif;
    }

    /**
     * <b>Enviar E-mail SMTP:</b> Envelope os dados do e-mail em um array atribuitivo para povoar o método.
     * Com isso execute este para ter toda a validação de envio do e-mail feita automaticamente.
     *
     * <b>REQUER DADOS ESPECÍFICOS:</b> Para enviar o e-mail você deve montar um array associativo com os
     * seguintes índices corretamente povoados:<br><br>
     * <i>
     * &raquo; Assunto<br>
     * &raquo; Mensagem<br>
     * &raquo; RemetenteNome<br>
     * &raquo; RemetenteEmail<br>
     * &raquo; DestinoNome<br>
     * &raquo; DestinoEmail
     * </i>
     */
    private function send_(array $Data)
    {
        $this->Data = $Data;
        $this->clear();

        $Data['RemetenteNome'] = ($Data['RemetenteNome'] != 'null' ? $Data['RemetenteNome'] : null);
        $this->setMail();
        $this->config();
    }

    /**
     * <b>Montar e Enviar:</b> Execute este método para facilitar o envio.
     * Informando os parâmetros solicitados para montar os dados!
     */
    public function createEmail($Assunto, $Mensagem, $RemetenteNome, $RemetenteEmail, $DestinoNome = null, $DestinoEmail = null)
    {
        $Data['Assunto'] = $Assunto;
        $Data['Mensagem'] = $Mensagem;
        $Data['RemetenteNome'] = $RemetenteNome;
        $Data['RemetenteEmail'] = $RemetenteEmail;
        $Data['DestinoNome'] = ($DestinoNome != null) ? $DestinoNome : mailer('mail_nomedestinatario');
        $Data['DestinoEmail'] = ($DestinoEmail != null) ? $DestinoEmail : mailer('mail_emaildestinatario');
        $this->send_($Data);
    }

    /**
     * Faz o envio do E-mail
     * @return bool
     */
    public function sendMail()
    {
        try {
            if ($this->Mail->Send()) {
                $this->Mail->clearAddresses();
                return true;
            }
            $this->error = $this->Mail->ErrorInfo;
        } catch (Exception $e) {
            die($this->Mail->ErrorInfo);
        }
    }

    /**
     * Faz o anexo ao E-mail
     * @param $File
     */
    public function addFile($File)
    {
        $this->Mail->addAttachment($File);
    }

    /**
     * Retorna o erro caso não envie o email
     * @return msg
     */
    public function error()
    {
        return $this->error;
    }

    /**
     * Higieniza os dados para o envio
     */
    private function clear()
    {
        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);
    }

    /**
     * Recupera e separa os atributos pelo Array Data.
     */
    private function setMail()
    {
        $this->Assunto = $this->Data['Assunto'];
        $this->Mensagem = $this->Data['Mensagem'];
        $this->RemetenteNome = $this->Data['RemetenteNome'];
        $this->RemetenteEmail = $this->Data['RemetenteEmail'];
        $this->DestinoNome = $this->Data['DestinoNome'];
        $this->DestinoEmail = $this->Data['DestinoEmail'];
        $this->Data = null;
    }

    /**
     * Configura o PHPMailer e valida o e-mail!
     */
    private function config()
    {
        //SMTP AUTH
        $this->Mail->SMTPOptions = mailer('mail_smtpoptions');
        $this->Mail->CharSet = mailer('mail_charset');
        $this->Mail->setLanguage('pt');
        $this->Mail->IsSMTP();
        $this->Mail->SMTPDebug = mailer('mail_smtpdebug');
        $this->Mail->IsHTML(true);


        //REMETENTE E RETORNO
        $this->Mail->From = mailer('mail_username'); /* email de quem envia */
        $this->Mail->FromName = mailer('mail_enviado_por'); /* Nome do remetente de e-mail */
        $this->Mail->AddReplyTo($this->RemetenteEmail, $this->RemetenteNome);

        //ASSUNTO, MENSAGEM E DESTINO
        $this->Mail->Subject = $this->Assunto;
        $this->Mail->msgHTML($this->Mensagem);
        $this->Mail->AddAddress($this->DestinoEmail, $this->DestinoNome);
    }

}
