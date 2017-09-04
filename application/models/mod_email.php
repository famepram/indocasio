<?php
class Mod_email extends CI_Model {
    
    var $emailReceiver;
    
    var $emailOrder;    // Pengirim Email (Server)
        
    var $emailAdmin;         // Pengerim Email (can reply-to)

    var $emailAdmin2;                  // BCC To Jakweb

    var $emailOrderName;

    var $emailReceiverName;

    var $emailAdminName;

    var $EmailAdmName           = 'Administrator Indocasio.co.id'; 

    var $EmailWebmasterName     = 'Indocasio';                 // Nama Email Pengirim
    
    var $SMTP_Port              = '25';
    
    var $SMTP_Host              = 'mail.indocasio.co.id';
    
    var $SMTP_User              = 'mail@indocasio.co.id';
    
    var $SMTP_Pass              = 'mail123';
    
    var $lib                     = '';
    
    var $API_key                = '12b-YVqn-Iah8-CxKw-iBur-cULI';

    function __construct($lib='ci') {
        parent::__construct();
        $this->load->library('email');
        $this->lib          = $lib;
        $this->init_account();
    }

    function init_account(){
        $this->emailOrder           = get_meta('email_order');
        $this->emailReceiver        = get_meta('email_receiver');
        $this->emailAdmin           = get_meta('email_admin');
        $this->emailAdmin2          = get_meta('email_admin2');
        $this->emailOrderName       = 'indocasio.co.id';
        $this->emailReceiverName    = 'indocasio.co.id';
    }

    function initialize(){
        $config = array();
        $config['protocol']  = 'smtp';
        $config['smtp_port'] = $this->SMTP_Port;
        $config['smtp_user'] = $this->SMTP_User;
        $config['smtp_pass'] = $this->SMTP_Pass;
        $config['smtp_host'] = $this->SMTP_Host;
        $config['smtp_timeout']='30'; 
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html'; 
        $config['charset']='utf-8';  
        $config['newline']="\r\n";
        $config['crlf'] = "\r\n";   
        $this->email->initialize($config);
    }
    
    // Email Registration Member
    function set_email_contact($conten){
        //$return = "";
        //$return
        return $conten;
    }
    
    function set_email_after_quiz($data){
        $return = '';
        if(!empty($data))
        {
            $return = $this->load->view('email/responds_quiz',$data,true);
        }
        return $return;
    }
    
    
    function before_send_ss($content='',$to='',$subject=''){
        $this->load->library('sendersuite');
        $this->sendersuite->SetAPIKey($this->API_key);
        $this->sendersuite->SetSender($this->EmailWebmasterSystem, $this->EmailWebmasterName);
        $this->sendersuite->SetReplyTo($this->EmailWebMasterReply, $this->EmailWebmasterName);
        $this->sendersuite->SetRecipient($to);
        $this->sendersuite->SetMessage($subject, $content);
        $result = $this->sendersuite->SendMessage();            
        return $result;
    }
    
    function before_send_ci($content='',$to='',$to_name='',$subject=''){
        $return = true;
        $this->initialize();
        $this->email->from($this->emailReceiver,$this->emailReceiverName);
        $this->email->reply_to($this->emailOrder);
        $this->email->to($to,$to_name);
        $this->email->subject($subject);
        $this->email->message($content);
        if (!$this->email->send()){
            die($this->email->print_debugger());
            $return = false;
        }
        return $return;
    }
    
    function before_send_from_ci($content='',$from='',$from_name='',$subject=''){
        $return = true;
        $this->initialize();
        $this->email->clear();
        $this->email->from($from,$from_name);
        $this->email->reply_to($from,$from_name);
        $this->email->bcc($this->EmailBCC);
        $this->email->to($this->testing_rec);
        $this->email->subject($subject);
        $this->email->message($content);
        if (!$this->email->send())
        {
            echo $this->email->print_debugger();
            die();
            $return = false;
        }
        return $return;
    }
    
    function send($content='',$to='',$to_name='',$subject=''){
       $return = false;
       if($this->lib== 'ci')
       {
           $return = $this->before_send_ci($content, $to, $to_name, $subject);
       }
       elseif($this->lib=='ss')
       {
           $return = $this->before_send_ss($content, $to, $subject);
       }
       return $return;
    }    
    
    function send_from($content='',$from='',$from_name='',$subject=''){
       $return = false;
       
       if($this->lib== 'ci')
       {
           $return = $this->before_send_from_ci($content, $from, $from_name, $subject);
       }
       elseif($this->lib=='ss')
       {
           $return = $this->before_send_ss($content, $from, $subject);
       }
       return $return;
    } 

    function set_email_order($_order_id){

    }
    
        
    function send_email_contact($id='0',$content=''){
        $return = false;
        if( !empty($id))
        {
            $this->load->model('mod_message','msg',true,$id);
            $content = $this->set_email_contact($content);
            $subject = 'Re : '.$this->msg->subject;
            $return = $this->send($content, $this->msg->email, $this->msg->name, $subject);
        }
        return $return;
    }
    
    function send_email_user_contact($id='0'){
        die("herererer");
        if( !empty($id))
        {
            $this->load->model('mod_message','msg',true,$id);
            $data_email = $this->msg->data;
            $name = $data_email['name'];
            $content = $data_email['content'];
            $subject = $data_email['subject'];
            $return = $this->send_from($content, $data_email['email'], $name, $subject);

        }
        return $return;
    }

    function send_email_order($_order_id='0'){
        if( !empty($_order_id))
        {
            $this->load->model('mod_order','_order',true,$_order_id);
            $name = $this->_order->fname.' '.$this->_order->lname;
            $content = $this->load->view('admin/order-email',array(),true);
            $status_txt = get_status_order($this->_order->status);
            $subject = 'Order Information No : '.$this->_order->get_no_order().' ('.$status_txt.')';
            $this->send($content, $this->_order->email, $name, $subject);
            $content = $this->load->view('admin/order-email-adm',array(),true);
            $list = array($this->emailOrder, $this->emailAdmin, $this->emailAdmin2);
            $this->send($content, $list, $this->emailReceiverName, $subject);

        }
        //return $return;
    }

    function send_email_payment($_payment_id='0',$to_admin=false){
        if( !empty($_payment_id)){
            $this->load->model('mod_payment','_payment',true,$_payment_id);
            $this->load->model('mod_order','_order',true,$this->_payment->order_id);
            $name = 'Indocasio Administrator';
            $data['to_admin'] = $to_admin;
            $content = $this->load->view('admin/payment-email',$data,true);
            $subject = 'Payment Information - Order No : '.$this->_order->get_no_order();
            if($to_admin){
                $to = array($this->emailOrder, $this->emailAdmin, $this->emailAdmin2);
            } else {
                $to = $this->_order->email;
            }
            $return = $this->send($content, $to, $this->emailReceiverName, $subject);
        }
        return $return;
    }

    function send_email_fp($_cust_id='0'){
        if( !empty($_cust_id)){
            $this->load->model('mod_customer','_customer',true,$_cust_id);
            $name = 'Indocasio Administrator';
            $content = $this->load->view('admin/fp-email',array('token'=>$this->_customer->fp_token),true);
            //die($content);
            $subject = 'Reset Password Request';
            $return = $this->send($content, $this->_customer->email, $this->_customer->fname.' '.$this->_customer->lname, $subject);
        }
        return $return;
    }
    
}
