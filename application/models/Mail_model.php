<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail_model extends CI_Model 
{

    public function sendMail($para, $assunto, $corpo, $from){

        $this->load->library('mail/phpmailer');
        $this->phpmailer->IsSMTP();
        
        // $this->phpmailer->Host = "smtp.umbler.com";
        // $this->phpmailer->SMTPAuth = true;
        // $this->phpmailer->Username = 'sender@strutech.com.br';
        // $this->phpmailer->Password = 'ca4547@#124qui';

        $this->phpmailer->Host = "smtp.righirighi.com.br";
        $this->phpmailer->SMTPAuth = true;
        $this->phpmailer->Username = 'sender@righirighi.com.br';
        $this->phpmailer->Password = '#JE#S#U#SRei7';
        $this->phpmailer->Port = 587;
        
        $emails = explode(';',$para);

        foreach ($emails as $v) if($v) $this->phpmailer->addAddress(trim($v), $from);
        
        
        $this->phpmailer->IsHTML();
        $this->phpmailer->CharSet = 'UTF-8';
        $this->phpmailer->From = "sender@righirighi.com.br";
        $this->phpmailer->FromName = $from;
        $this->phpmailer->Subject  = $assunto;
        $this->phpmailer->Body = utf8_decode($corpo);

        if(!$this->phpmailer->Send()){
          return false;
        }else{
          return true;
        }        
    }

    public function setEmailHomeBody($Array){

       $post = (object) $Array;

        $html = '<table >
            <tr style="background: #413689;color: #fff;">
                <td colspan="2" style="padding: 5px;text-align: center;"> Mensagem via formulário Web Site: Righi & Righi</td>
            </tr>
            <tr>
                <td style="padding: 5px;"><strong>Nome:</strong></td>
                <td style="padding: 5px;">'.$post->name.'</td>
            </tr>
            <tr>
                <td style="padding: 5px;"><strong>E-mail:</strong></td>
                <td style="padding: 5px;">' . $post->mail . '</td>
            </tr>
            <tr>
                <td style="padding: 5px;"><strong>Telefone:</strong></td>
                <td style="padding: 5px;">' . $post->phone . '</td>
            </tr>';

            if (isset($post->area)) {
                $html .= '<tr>
                            <td style="padding: 5px;"><strong>Área de atuação:</strong></td>
                            <td style="padding: 5px;">' . $post->area . '</td>
                        </tr>
                ';
            }

            if (isset($Array['file_name'])) {
                $html .= '<tr>
                            <td style="padding: 5px;"><strong>Arquivo:</strong></td>
                            <td style="padding: 5px;"><a href="' . $Array['file_name'] . '" > Clique aqui para visualizar o aquivo. </a></td>
                        </tr>
                ';
            }

        $html .= '<tr>
                <td style="padding: 5px;"><strong>Mensagem:</strong></td>
                <td style="padding: 5px;"><p>' . $post->message . '</p></td>
            </tr>
        </table>';

        return utf8_encode($html);


    }
    public function setCartBody($produtos, $cliente){
        $user = (Object) $cliente;

        $html = '
            <div style="padding:5px; margin-bottom:7px; background: #413689;color: #fff;" >
                Mensagem via formulário Web Site: Strutech 
                Lista de Orçamento
            </div>
            <table >
                <tr style="background: #413689;color: #fff;">
                    <td colspan="2" style="padding: 5px;text-align: center;"> Dados do Usuário que solicitou o orçamento </td>
                </tr>

                <tr>
                    <td style="padding: 5px;"><strong>Nome:</strong></td>
                    <td style="padding: 5px;">'.$user->name.'</td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><strong>Email:</strong></td>
                    <td style="padding: 5px;">' . $user->email . '</td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><strong>Telefone:</strong></td>
                    <td style="padding: 5px;">' . $user->phone . '</td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><strong>Mensagem:</strong></td>
                    <td style="padding: 5px;">' . $user->message . '</td>
                </tr>
            </table>
        ';
        foreach($produtos as  $product){

            $html .= ' 
                <table >
                    <tr style="background: #413689;color: #fff;">
                        <td colspan="2" style="padding: 5px;text-align: center;"> PRODUTO </td>
                    </tr>

                    <tr>
                        <td style="padding: 5px;"><strong>Produto:</strong></td>
                        <td style="padding: 5px;">'.$product['link'].'</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px;"><strong>Nome:</strong></td>
                        <td style="padding: 5px;">' . $product['name'] . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px;"><strong>Quantidade:</strong></td>
                        <td style="padding: 5px;">' . $product['qtd'] . '</td>
                    </tr>
                </table>

            ';
        }
        
        return utf8_encode($html);
    }
  }
