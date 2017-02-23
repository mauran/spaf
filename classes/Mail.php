<?php
class Mail {
  public static function send($subject, $message, $to, $html=true, $cc='', $from='', $replyTo='') {
    if ($replyTo == '') {
      $replyTo = $from;
    }
    if ($from == '') {
      $from = _DEFAULT_FROM_EMAIL_;
    }
    $headers = array();
    if ($html) {
      $headers[] = 'MIME-Version: 1.0';
      $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    }
    if ($from != '')
      $headers[] = 'From: '. $from;
    if ($replyTo != '')
      $headers[] = 'Reply-To: '. $replyTo;
    if ($cc != '')
      $headers[] = 'Cc: '. $cc;
    $headers[] = 'X-Mailer: PHP/' . phpversion();
    return mail($to, utf8_decode($subject), utf8_decode($message), implode("\r\n", $headers));
  }
}
