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
  public static function welcomeamil($email, $name)
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
  public static function acceptagent($email, $name, $security_code)
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

  public static function acceptagentbytownshhip($email, $name, $township, $security_code)
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
      $mail->Subject = 'GoDelivery - Agent Account Activated';

      $mail->Body = '
<html>
<head>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

    body {
      font-family: "Poppins", sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .header {
      font-size: 24px;
      font-weight: 600;
      color: #1F265B;
      margin-bottom: 20px;
      text-align: center;
    }

    .subheader {
      font-size: 16px;
      font-weight: 500;
      color: #333;
      margin-bottom: 10px;
      text-align: center;
    }

    .message {
      font-size: 15px;
      color: #555;
      line-height: 1.7;
      margin-bottom: 20px;
    }

    .highlight {
      font-weight: bold;
      color: #1F265B;
    }

    .code-box {
      font-size: 20px;
      font-weight: 600;
      color: #ffffff;
      background-color: #1F265B;
      padding: 15px;
      text-align: center;
      border-radius: 8px;
      letter-spacing: 1px;
      margin: 20px 0;
    }

    .footer {
      font-size: 13px;
      color: #999;
      text-align: center;
      margin-top: 30px;
    }

    .logo {
      text-align: center;
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #FF4D4D;
    }

    .logo span {
      color: #1F265B;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">GO<span>DELIVERY</span></div>
    <div class="header">Agent Account Activated</div>
    <div class="subheader">Welcome, ' . htmlspecialchars($name) . '</div>
    <p class="message">
      You have been successfully assigned as a <span class="highlight">GoDelivery agent</span> for your region.
    </p>
    <p class="message">
      You are now responsible for delivering to <span class="highlight">' . htmlspecialchars($township) . '</span>. Your access to the GoDelivery agent system has been enabled.
    </p>
    <p class="message">Use the security code below to log in to your dashboard:</p>
    <div class="code-box">' . htmlspecialchars($security_code) . '</div>
    <p class="message">Please keep this code confidential and secure.</p>
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

  public static function agentchangestatusbytownship($email, $name, $township)
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
      $mail->Subject = 'GoDelivery - Township Access Denied';

      $mail->Body = '
<html>
<head>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

    body {
      font-family: "Poppins", sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .logo {
      text-align: center;
      font-size: 28px;
      font-weight: bold;
      color: #FF4D4D;
      margin-bottom: 20px;
    }

    .logo span {
      color: #1F265B;
    }

    .header {
      font-size: 22px;
      color: #1F265B;
      text-align: center;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .message {
      font-size: 16px;
      color: #444;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .highlight {
      font-weight: bold;
      color: #FF4D4D;
    }

    .footer {
      font-size: 13px;
      color: #999;
      text-align: center;
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">GO<span>DELIVERY</span></div>
    <div class="header">Access Denied - Inactive Township</div>
    <p class="message">Dear <strong>' . htmlspecialchars($name) . '</strong>,</p>
    <p class="message">
      We regret to inform you that you cannot use our <strong>GoDelivery Agent System</strong> at this time because your current assigned township — 
      <span class="highlight">' . htmlspecialchars($township) . '</span> — has been <strong>deactivated</strong>.
    </p>
    <p class="message">
      Please contact the system administrator or support team for more details regarding your access status.
    </p>
    <p class="message">
      We apologize for the inconvenience and appreciate your understanding.
    </p>
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

  public static function agentchangestatusbytownshipactive($email, $name, $township)
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
      $mail->Subject = 'GoDelivery - Welcome Back! Township Reactivated';

      $mail->Body = '
<html>
<head>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

    body {
      font-family: "Poppins", sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .logo {
      font-size: 26px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 25px;
      color: #1F265B;
    }

    .logo span {
      color: #FF4D4D;
    }

    .header {
      font-size: 22px;
      color: #1F265B;
      font-weight: 600;
      text-align: center;
      margin-bottom: 20px;
    }

    .message {
      font-size: 16px;
      color: #333;
      line-height: 1.7;
      margin-bottom: 20px;
    }

    .highlight {
      font-weight: 600;
      color: #1F265B;
    }

    .township {
      color: #FF4D4D;
      font-weight: 600;
    }

    .footer {
      font-size: 13px;
      color: #aaa;
      text-align: center;
      margin-top: 30px;
    }

    .button {
      display: inline-block;
      background-color: #1F265B;
      color: #ffffff;
      padding: 12px 24px;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      margin-top: 15px;
      text-align: center;
    }

    .button:hover {
      background-color: #151a42;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">GO<span>DELIVERY</span></div>
    <div class="header">Welcome Back!</div>
    <p class="message">
      Dear <span class="highlight">' . htmlspecialchars($name) . '</span>,
    </p>
    <p class="message">
      Great news! Your assigned township — <span class="township">' . htmlspecialchars($township) . '</span> — has been <strong>reactivated</strong>. You now have full access to use our <strong>GoDelivery Agent System</strong> again.
    </p>
    <p class="message">
      We’re excited to have you back on board! You can now log in and continue managing your deliveries, customers, and tasks as usual.
    </p>
    <p class="message">
      If you have any questions or need assistance, feel free to reach out to our support team.
    </p>
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

  public static function deliverysuccess($email, $name, $tracking_code, $township)
  {
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'min123kit@gmail.com';     // 🔁 Replace with your email
      $mail->Password   = 'wbyjmpsibxpqxlhe';        // 🔁 Use App Password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      $mail->setFrom('min123kit@gmail.com', 'GoDelivery');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'GoDelivery - Your Delivery Has Been Successfully Completed';

      $mail->Body = '
<html>
<head>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

    body {
      font-family: "Poppins", sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .logo {
      font-size: 28px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 25px;
      color: #FFA500; /* Orange */
    }

    .header {
      font-size: 22px;
      color: #1F265B;
      font-weight: 600;
      text-align: center;
      margin-bottom: 20px;
    }

    .message {
      font-size: 16px;
      color: #333;
      line-height: 1.7;
      margin-bottom: 20px;
    }

    .highlight {
      font-weight: 600;
      color: #1F265B;
    }

    .tracking {
      background-color: #f1f1f1;
      padding: 12px 20px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      color: #333;
      text-align: center;
      margin: 20px 0;
    }

    .footer {
      font-size: 13px;
      color: #aaa;
      text-align: center;
      margin-top: 30px;
    }

    .button {
      display: inline-block;
      background-color: #1F265B;
      color: #ffffff;
      padding: 12px 24px;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      margin-top: 15px;
      text-align: center;
    }

    .button:hover {
      background-color: #151a42;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">GO<span style="color:#333;">DELIVERY</span></div>
    <div class="header">Your Delivery Was Successful</div>
    <p class="message">
      Dear <span class="highlight">' . htmlspecialchars($name) . '</span>,
    </p>
    <p class="message">
      We are pleased to inform you that your delivery has <span class="highlight">arrived at your delivery address in ' . htmlspecialchars($township) . '</span>.
    </p>
    <p class="message">
      Below is your tracking code for reference:
    </p>
    <div class="tracking">' . htmlspecialchars($tracking_code) . '</div>
    <p class="message">
      Thank you for using <strong>GoDelivery</strong>. We appreciate your trust and hope to serve you again soon!
    </p>
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


  public static function deliverysuccessforreceiver($email, $name, $tracking_code, $township)
  {
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'min123kit@gmail.com';   // 🔁 Replace with your email
      $mail->Password   = 'wbyjmpsibxpqxlhe';       // 🔁 Use App Password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      $mail->setFrom('min123kit@gmail.com', 'GoDelivery');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'GoDelivery - Your Parcel Has Been Delivered';

      $mail->Body = '
        <html>
        <head>
          <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");
            body {
              font-family: "Poppins", sans-serif;
              background-color: #f9f9f9;
              margin: 0;
              padding: 0;
            }
            .container {
              max-width: 600px;
              margin: 40px auto;
              background-color: #ffffff;
              padding: 30px;
              border-radius: 12px;
              box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            }
            .logo {
              font-size: 28px;
              font-weight: bold;
              text-align: center;
              margin-bottom: 25px;
              color: #FFA500; /* Orange for GO */
            }
            .header {
              font-size: 22px;
              font-weight: 600;
              color: #1F265B;
              text-align: center;
              margin-bottom: 20px;
            }
            .message {
              font-size: 16px;
              color: #333;
              line-height: 1.7;
              margin-bottom: 20px;
            }
            .highlight {
              font-weight: 600;
              color: #1F265B;
            }
            .tracking {
              background-color: #f1f1f1;
              padding: 12px 20px;
              border-radius: 8px;
              font-size: 16px;
              font-weight: 600;
              color: #333;
              text-align: center;
              margin: 20px 0;
            }
            .button {
              display: inline-block;
              background-color: #1F265B;
              color: #ffffff;
              padding: 12px 24px;
              border-radius: 8px;
              font-size: 15px;
              font-weight: 600;
              text-decoration: none;
              margin-top: 15px;
              text-align: center;
            }
            .button:hover {
              background-color: #151a42;
            }
            .footer {
              font-size: 13px;
              color: #aaa;
              text-align: center;
              margin-top: 30px;
            }
          </style>
        </head>
        <body>
          <div class="container">
            <div class="logo">GO<span style="color:#333;">DELIVERY</span></div>
            <div class="header">Your Parcel Has Been Delivered</div>
            <p class="message">
              Dear <span class="highlight">' . htmlspecialchars($name) . '</span>,
            </p>
            <p class="message">
              We are pleased to inform you that your parcel with tracking code 
              <span class="highlight">' . htmlspecialchars($tracking_code) . '</span> 
              has been successfully delivered to your address in 
              <span class="highlight">' . htmlspecialchars($township) . '</span>.
            </p>
            <div class="tracking">Tracking Code: ' . htmlspecialchars($tracking_code) . '</div>
            <p class="message">
              If you notice any issue with your delivery, please don’t hesitate to contact our support team immediately.  
            </p>
            <a href="mailto:support@godelivery.com" class="button">Contact Support</a>
            <p class="message">
              Thank you for choosing <strong>GoDelivery</strong>. We’re always here to serve you better!
            </p>
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



  public static function deliveryreturn($email, $name, $tracking_code, $township, $from_township)
  {
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'min123kit@gmail.com';   // 🔁 Replace with your email
      $mail->Password   = 'wbyjmpsibxpqxlhe';       // 🔁 Use App Password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      $mail->setFrom('min123kit@gmail.com', 'GoDelivery');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'GoDelivery - Your Parcel Has Been Returned';

      $mail->Body = '
        <html>
        <head>
          <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");
            body {
              font-family: "Poppins", sans-serif;
              background-color: #f9f9f9;
              margin: 0;
              padding: 0;
            }
            .container {
              max-width: 600px;
              margin: 40px auto;
              background-color: #ffffff;
              padding: 30px;
              border-radius: 12px;
              box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            }
            .logo {
              font-size: 28px;
              font-weight: bold;
              text-align: center;
              margin-bottom: 25px;
              color: #FFA500; /* Orange for GO */
            }
            .header {
              font-size: 22px;
              font-weight: 600;
              color: #1F265B;
              text-align: center;
              margin-bottom: 20px;
            }
            .message {
              font-size: 16px;
              color: #333;
              line-height: 1.7;
              margin-bottom: 20px;
            }
            .highlight {
              font-weight: 600;
              color: #1F265B;
            }
            .code-box {
              font-size: 18px;
              background-color: #FFF3F3;
              padding: 12px 20px;
              border-radius: 8px;
              text-align: center;
              font-weight: bold;
              color: #FF4D4D;
              letter-spacing: 1px;
              margin: 20px 0;
            }
            .footer {
              font-size: 13px;
              color: #aaa;
              text-align: center;
              margin-top: 30px;
            }
            .button {
              display: inline-block;
              background-color: #1F265B;
              color: #ffffff;
              padding: 12px 24px;
              border-radius: 8px;
              font-size: 15px;
              font-weight: 600;
              text-decoration: none;
              margin-top: 15px;
              text-align: center;
            }
            .button:hover {
              background-color: #151a42;
            }
          </style>
        </head>
        <body>
          <div class="container">
            <div class="logo">GO<span style="color:#333;">DELIVERY</span></div>
            <div class="header">Delivery Attempt Unsuccessful</div>
            <p class="message">Dear <span class="highlight">' . htmlspecialchars($name) . '</span>,</p>
            <p class="message">
              We regret to inform you that we were unable to deliver your parcel with tracking code 
              <span class="highlight">' . htmlspecialchars($tracking_code) . '</span> to the recipient in 
              <span class="highlight">' . htmlspecialchars($township) . '</span>.
            </p>
            <p class="message">
              After multiple attempts, the receiver could not be reached. As a result, your parcel has been 
              <span class="highlight">returned to our office in ' . htmlspecialchars($from_township) . '</span>.
            </p>
            <div class="code-box">Tracking Code: ' . htmlspecialchars($tracking_code) . '</div>
            <p class="message">
              You may collect the parcel from our office during business hours. Please bring the tracking code or sender ID for verification.
            </p>
            <p class="message">
              If you need assistance, feel free to contact our support team.
            </p>
            <a href="mailto:support@godelivery.com" class="button">Contact Support</a>
            <p class="message">We apologize for the inconvenience and appreciate your understanding.</p>
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

  public static function pickupAgentActivated($email, $name, $security_code)
  {
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'min123kit@gmail.com';   // 🔁 Replace with your email
      $mail->Password   = 'wbyjmpsibxpqxlhe';      // 🔁 App Password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      $mail->setFrom('min123kit@gmail.com', 'GoDelivery');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'GoDelivery - Your Agent Account Has Been Activated';

      $mail->Body = '
<html>
<head>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 25px;
            color: #FFA500; /* Orange */
        }
        .logo span {
            color: #1F265B;
        }
        .header {
            font-size: 22px;
            font-weight: 600;
            color: #1F265B;
            text-align: center;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #333;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .highlight {
            font-weight: 600;
            color: #1F265B;
        }
        .code-box {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            padding: 12px 20px;
            border-radius: 8px;
            background-color: #f1f1f1;
            color: #1F265B;
            letter-spacing: 2px;
            margin-bottom: 25px;
        }
        .button {
            display: inline-block;
            background-color: #1F265B;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            margin-top: 15px;
            text-align: center;
        }
        .button:hover {
            background-color: #151a42;
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
        <div class="logo">GO<span>DELIVERY</span></div>
        <div class="header">Your Agent Account Is Now Active</div>
        <p class="message">
            Hello <span class="highlight">' . htmlspecialchars($name) . '</span>,
        </p>
        <p class="message">
            Your Pickup Agent account with <strong>GoDelivery</strong> has been successfully activated.
            You can now log in using the temporary security code below.
        </p>
        <div class="code-box">Security Code: ' . htmlspecialchars($security_code) . '</div>
        <p class="message">
            Click the button below to log in. Use the security code for your first login, and then set your own password.
        </p>
        <p class="message">
            If you did not expect this email or face any issues, please contact our support immediately.
        </p>
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

  public static function pickupAgentDeactivated($email, $name)
  {
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'min123kit@gmail.com';   // 🔁 Replace with your email
      $mail->Password   = 'wbyjmpsibxpqxlhe';      // 🔁 App Password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      $mail->setFrom('min123kit@gmail.com', 'GoDelivery');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'GoDelivery - Your Agent Account Has Been Deactivated';

      $mail->Body = '
<html>
<head>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 25px;
            color: #FFA500; /* Orange for Go */
        }
        .logo span {
            color: #1F265B; /* Blue for DELIVERY */
        }
        .header {
            font-size: 22px;
            font-weight: 600;
            color: #1F265B;
            text-align: center;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #333;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        .highlight {
            font-weight: 600;
            color: #1F265B;
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
        <div class="logo">GO<span>DELIVERY</span></div>
        <div class="header">Your Agent Account Has Been Deactivated</div>
        <p class="message">
            Hello <span class="highlight">' . htmlspecialchars($name) . '</span>,
        </p>
        <p class="message">
            Your Pickup Agent account with <strong>GoDelivery</strong> has been <span class="highlight">deactivated</span> 
            and you will no longer be able to access the system.
        </p>
        <p class="message">
            If you believe this is an error or need assistance, please contact our support team immediately.
        </p>
        <p class="message">
            We appreciate your time and efforts as part of GoDelivery.
        </p>
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
