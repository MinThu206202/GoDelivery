<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


class Mail
{

  public static function sendOTP($email, $otp)
  {

    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'min123kit@gmail.com';     // 🔁 Replace with your email
      $mail->Password   = 'wbyjmpsibxpqxlhe';         // 🔁 Use App Password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      $mail->setFrom('min123kit@gmail.com', 'GoDelivery');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'Your GoDelivery OTP Code';
      $mail->Body = '
        <html>
        <head>
          <style>
            body {
              font-family: "Poppins", sans-serif;
              background-color: #f6f6f6;
              padding: 0;
              margin: 0;
            }
            .container {
              max-width: 600px;
              margin: auto;
              background-color: #ffffff;
              padding: 30px;
              border-radius: 8px;
              box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            }
            .logo {
              font-size: 28px;
              font-weight: bold;
              color: #FFA500;
              margin-bottom: 20px;
            }
            .otp-box {
              font-size: 32px;
              letter-spacing: 8px;
              font-weight: 600;
              text-align: center;
              color: #333;
              background-color: #f1f1f1;
              padding: 15px;
              border-radius: 8px;
              margin: 20px 0;
            }
            .footer {
              font-size: 13px;
              color: #888;
              text-align: center;
              margin-top: 30px;
            }
          </style>
        </head>
        <body>
          <div class="container">
            <div class="logo">GO<span style="color:#333;">DELIVERY</span></div>
            <p>Hello,</p>
            <p>Your One-Time Password (OTP) for verifying your identity is below. This code is valid for <strong>5 minutes</strong>.</p>
        
            <div class="otp-box">' . $otp . '</div>
        
            <p>If you didn’t request this code, please ignore this email.</p>
        
            <div class="footer">
              &copy; ' . date('Y') . ' GoDelivery. All rights reserved.
            </div>
          </div>
        </body>
        </html>';
      $mail->send();
      return true;
    } catch (Exception $e) {
      error_log("Mail Error: " . $mail->ErrorInfo);
      return false;
    }
  }

  //sent welcome page for agent
  public static function welcomeamil($email, $name) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'min123kit@gmail.com';     // 🔁 Replace with your email
        $mail->Password   = 'wbyjmpsibxpqxlhe';         // 🔁 Use App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('min123kit@gmail.com', 'GoDelivery');            
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to GoDelivery - Registration Successful';

          $mail->Body = '
          <html>
          <head>
            <style>
              body {
                font-family: "Poppins", sans-serif;
                background-color: #f6f6f6;
                margin: 0;
                padding: 0;
              }
              .container {
                max-width: 600px;
                margin: 30px auto;
                background-color: #ffffff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
              }
              .logo {
                font-size: 28px;
                font-weight: bold;
                color: #FFA500;
                margin-bottom: 20px;
              }
              .message {
                font-size: 16px;
                color: #333;
                line-height: 1.6;
              }
              .footer {
                font-size: 13px;
                color: #888;
                text-align: center;
                margin-top: 30px;
              }
            </style>
          </head>
          <body>
            <div class="container">
              <div class="logo">GO<span style="color:#333;">DELIVERY</span></div>

              <p class="message">Hello <strong>' . htmlspecialchars($name) . '</strong>,</p>

              <p class="message">
                🎉 Thank you for registering and partnering with <strong>GoDelivery</strong>!
              </p>

              <p class="message">
                We appreciate your interest in becoming an agent. Our team will review your request, and you will receive a follow-up email soon with next steps.
              </p>

              <p class="message">
                In the meantime, if you have any questions, feel free to reply to this email.
              </p>

              <div class="footer">
                &copy; ' . date('Y') . ' GoDelivery. All rights reserved.
              </div>
            </div>
          </body>
          </html>';
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mail Error: " . $mail->ErrorInfo);
        return false;
    }
}


  //success 
  public static function activeagent($email, $name)
  {
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'min123kit@gmail.com';     // 🔁 Replace with your email
      $mail->Password   = 'wbyjmpsibxpqxlhe';         // 🔁 Use App Password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      $mail->setFrom('min123kit@gmail.com', 'GoDelivery');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'GoDelivery - Account Deactivated';
      $mail->Body = '
<html>
<head>
  <style>
    body { font-family: "Poppins", sans-serif; background: #f6f6f6; margin: 0; padding: 0; }
    .container { max-width: 600px; margin: 30px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .logo { font-size: 28px; font-weight: bold; color: #FF4D4D; margin-bottom: 20px; }
    .message { font-size: 16px; color: #333; line-height: 1.6; }
    .footer { font-size: 13px; color: #888; text-align: center; margin-top: 30px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">GO<span style="color:#333;">DELIVERY</span></div>
    <p class="message">Hi <strong>' . htmlspecialchars($name) . '</strong>,</p>
    <p class="message" style="color:#D8000C;">Your agent account has been deactivated. You can no longer access the system.</p>
    <p class="message">If this was a mistake, reply to this email for assistance.</p>
    <div class="footer">&copy; ' . date('Y') . ' GoDelivery</div>
  </div>
</body>
</html>';
      $mail->send();
      return true;
    } catch (Exception $e) {
      error_log("Mail Error: " . $mail->ErrorInfo);
      return false;
    }
  }


  public static function dectivateagent($email, $name)
  {
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'min123kit@gmail.com';     // 🔁 Replace with your email
      $mail->Password   = 'wbyjmpsibxpqxlhe';         // 🔁 Use App Password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      $mail->setFrom('min123kit@gmail.com', 'GoDelivery');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'GoDelivery - Account Reactivated';
      $mail->Body = '
      <html>
      <head>
        <style>
          body { font-family: "Poppins", sans-serif; background: #f6f6f6; margin: 0; padding: 0; }
          .container { max-width: 600px; margin: 30px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
          .logo { font-size: 28px; font-weight: bold; color: #28a745; margin-bottom: 20px; }
          .message { font-size: 16px; color: #333; line-height: 1.6; }
          .footer { font-size: 13px; color: #888; text-align: center; margin-top: 30px; }
        </style>
      </head>
      <body>
        <div class="container">
          <div class="logo">GO<span style="color:#333;">DELIVERY</span></div>
          <p class="message">Hi <strong>' . htmlspecialchars($name) . '</strong>,</p>
          <p class="message" style="color:#28a745;">Your agent account has been reactivated. You can now log in and start delivering again.</p>
          <p class="message">Welcome back!</p>
          <div class="footer">&copy; ' . date('Y') . ' GoDelivery</div>
        </div>
      </body>
      </html>';
      $mail->send();
      return true;
    } catch (Exception $e) {
      error_log("Mail Error: " . $mail->ErrorInfo);
      return false;
    }
  }



  //success 
  public static function acceptagent($email, $name,$security_code)
  {
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'min123kit@gmail.com';     // 🔁 Replace with your email
      $mail->Password   = 'wbyjmpsibxpqxlhe';         // 🔁 Use App Password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      $mail->setFrom('min123kit@gmail.com', 'GoDelivery');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'GoDelivery - Account Deactivated';
      $mail->Body = $body = '
                              <html>
                              <head>
                                <style>
                                  body { font-family: "Poppins", sans-serif; background: #f6f6f6; margin: 0; padding: 0; }
                                  .container {
                                    max-width: 600px;
                                    margin: 30px auto;
                                    background: #fff;
                                    padding: 30px;
                                    border-radius: 10px;
                                    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
                                  }
                                  .logo {
                                    font-size: 28px;
                                    font-weight: bold;
                                    color: #FF4D4D;
                                    margin-bottom: 20px;
                                  }
                                  .message {
                                    font-size: 16px;
                                    color: #333;
                                    line-height: 1.6;
                                    margin-bottom: 15px;
                                  }
                                  .code-box {
                                    font-size: 20px;
                                    font-weight: bold;
                                    color: #1F265B;
                                    background: #f0f0f0;
                                    padding: 12px 20px;
                                    border-radius: 8px;
                                    text-align: center;
                                    letter-spacing: 2px;
                                    margin: 20px 0;
                                  }
                                  .footer {
                                    font-size: 13px;
                                    color: #888;
                                    text-align: center;
                                    margin-top: 30px;
                                  }
                                </style>
                              </head>
                              <body>
                                <div class="container">
                                  <div class="logo">GO<span style="color:#333;">DELIVERY</span></div>
                                  <p class="message">Hi <strong>' . htmlspecialchars($name) . '</strong>,</p>
                                  <p class="message">Welcome aboard! You’ve been added as a GoDelivery agent.</p>
                                  <p class="message">Use the following security code to log into your agent panel:</p>
                                  
                                  <div class="code-box">' . htmlspecialchars($security_code) . '</div>
                                  
                                  <p class="message">Please keep this code confidential. You can now access the GoDelivery agent system.</p>
                                  <div class="footer">&copy; ' . date('Y') . ' GoDelivery. All rights reserved.</div>
                                </div>
                              </body>
                              </html>';
      $mail->send();
      return true;
    } catch (Exception $e) {
      error_log("Mail Error: " . $mail->ErrorInfo);
      return false;
    }
  }






}




?>