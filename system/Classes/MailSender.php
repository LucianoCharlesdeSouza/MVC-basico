<?php

/**
 * Class  Mail_Sender

 * @author Luciano Charles de Souza
 * E-mail: souzacomprog@gmail.com
 * Github: https://github.com/LucianoCharlesdeSouza
 * YouTube: https://www.youtube.com/channel/UC2bpyhuQp3hWLb8rwb269ew?view_as=subscriber
 */
class MailSender
{

    private $de;
    private $para = [];
    private $emailRecusado;
    private $tipo = "text/plain";
    private $assunto;
    private $mensagem;
    private $cabecalhos;
    private $prioridade = 3;
    private $responderPara = [];
    private $msgError;

    /**
     * Mail_Sender constructor.
     */
    public function __construct()
    {
        $this->getTipoEmail();
        $this->getPrioridade();
        $this->getResponderPara();
    }

    /**
     * @return string
     */
    private function getTipoEmail()
    {
        return $this->tipo;
    }

    /**
     * Método que aplica o tipo de envio
     */
    public function comoHtml()
    {
        $this->tipo = "text/html";
    }

    /**
     * @param $de
     */
    public function setDe($de)
    {
        $this->de = $de;
    }

    /**
     * @return bool
     */
    private function getDe()
    {
        if (Helpers::isMail($this->de)) {
            return $this->de;
        }

        $this->msgError = "E-mail passado não é válido!";

        return false;
    }

    /**
     * @param $para
     */
    public function setPara($para)
    {
        foreach ($para as $email) {
            if (Helpers::isMail($email)) {
                $this->para[] =  $email;
            }
        }
    }

    public function getPara()
    {
        $para = rtrim(implode(',', $this->para), ',');
        return (!empty($para)) ? $para : false;
    }

    public function setAssunto($assunto)
    {
        $this->assunto = trim($assunto);
    }

    private function getAssunto()
    {
        return ($this->assunto) ?? false;
    }

    public function setMensagem($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    private function getMensagem()
    {
        return ($this->mensagem) ?? false;
    }

    public function setPrioridade($prioridade)
    {
        $this->prioridade = $prioridade;
    }

    private function getPrioridade()
    {
        return $this->prioridade;
    }

    public function setResponderPara($para)
    {
        foreach ($para as $email) {
            if (Helpers::isMail($email)) {
                $this->responderPara[] = $email;
            }
        }
    }

    private function getResponderPara()
    {
        return rtrim(implode(',', $this->responderPara), ',');
    }

    private function getCabecalhos()
    {
        return $this->cabecalhos = "From:" . $this->getDe() . "\r\n" .
            "Reply-To:" . $this->getResponderPara() . "\r\n" .
            "X-Mailer:PHP/" . phpversion() . "\r\n" .
            "Erros-To:" . $this->getDe() . "\r\n" .
            "Return-Path:" . $this->getDe() . "\r\n" .
            "Content-Type:" . $this->getTipoEmail() . "; charset='utf-8'" . "\r\n" .
            "Date:" . date("r(T)") . "\r\n" .
            "X-Priority:" . $this->getPrioridade() . "\r\n" .
            "MIME-Version:1.1";
    }

    public function getError()
    {
        return $this->msgError;
    }

    public function enviar()
    {
        return mail($this->getPara(), $this->getAssunto(), $this->getMensagem(), $this->getCabecalhos());
    }
}
