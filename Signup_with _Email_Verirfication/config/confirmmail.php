<?php
// error_reporting(E_ALL);
//   ini_set('display_errors', '1');



function htmlMail($t, $sub, $name, $teamname, $event){


    $to = $t;

    $subject = $sub;
    

    $html = "<!DOCTYPE html>
              <html>
                  <head>
                      <style>
                          li{
                              padding:10px;
                          }
                          p{
                              font-size:16px;
                          }

                          *{
                              font-family:Helvetica,Arial,sans-serif;
                          }

                          h2
                          {
                            font-size: 1.3rem;
                          }
                          html, body{
                              background-color:#f7f9fb;
                              margin: 0;
                          }
                          h3,h4
                          {
                            font-size: 1rem;
                          }
                          .context {
                              font-size: 12px;
                              padding: 40px 50px;
                              margin-left:7%;
                              margin-right: 7%;
                          }

                          .context p{
                              font-size: 12px;
                          }

                          p{
                              margin: 15px 0px;
                          }

                          @media(max-width: 600px)
                          {
                            .context{
                              padding: 0px 30px;
                              margin-left: 0;
                              margin-right: 0;
                            }
                          }

                      </style>
                  </head>
                  <body>

                      <div style='background: #0b0b0b; padding:10px 30px;'><img src='https://www.ecellvnit.org/img/logo-ecell.png'></div>

                      <div class='context'>


                          <h2><b>Greetings ".$name."!</b></h2>
                          <p>OTP:-".$event."</p>


                          <p>Thank you for  showing interest in our <b>NEO Program</b> through which we aim to extend our entrepreneurial network across the country.</p>
                          <div>
                            

                          <p>
                            Regards<br />
                            <b>Team E-Cell VNIT</b>
                          </p>
                      </div>
                  </body>
                                      </html>";

    $url = 'https://startupconclave.ecellvnit.org/send';
    $data = array('subject' => $subject, 'email' => $to, 'html' => $html, 'pass' => 'Entrepreneurs2020');

    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        $msg = 'We are facing problem in sending email. Please use this link to pay your registration fees.';
        return false;
    }else{

      return true;
     
    
   }
   
   

  }
  
?>

