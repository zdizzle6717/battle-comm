<?php
// --- Smart Mailer -------------------------------------------------------------
// Copyright 2003-2012 (c) DMXzone
//
// Version: 1.0.10
// ------------------------------------------------------------------------------
session_start();

include(dirname(__FILE__) . "/htmlMimeMail.php");

class SmartMailer
{
  // Set version
  var $version = "1.10";
  var $debugger = false;

  // Define variables
  var $embedImages = false;
  var $to;
  var $attFiles;
  var $tmpFolder;
  var $component;
  var $current_mail;
  var $total_mail;
  var $progressBar;
  var $ignore_errors;
  var $progressFilePath;
  var $timer;

  // Init (Use debug if global parameter is set)
  function SmartMailer() {
    global $DMX_debug;
    $this->mail = new htmlMimeMail();
    $this->to = array();
    $this->attFiles = array();
    $this->debugger = $DMX_debug;
    $this->current_mail = 0;
    $this->timer = time();
    $this->debug("<br/><font color=\"#009900\"><b>Smart Mailer version ".$this->version."</b></font><br/><br/>");
  }

  // Check if version is uptodate
  function checkVersion($version) {
    if ($version > $this->version) {
      $this->error('version');
    }
  }

  // Set from:
  function setFrom($name, $email) {
    if ($email != "") {
      if ($this->component == "SMTP") {
        if ($name != "")
          $this->mail->setFrom("\"".$name."\" <".$email.">");
        else
          $this->mail->setFrom($email);
      } else
        $this->mail->setFrom($email);
    }
  }

  // Set to:
  function setTo($name, $email) {
    if ($email != "") {
      if ($this->component == "SMTP") {
        if ($name != "")
          array_push($this->to, "\"".$name."\" <".$email.">");
        else
          array_push($this->to, $email);
      } else
        array_push($this->to, $email);
    }

  }

  // Set cc:
  function setCc($name, $email) {
    if ($email != "") {
      if ($this->component == "SMTP") {
        if ($name != "")
          $this->mail->setCc("\"".$name."\" <".$email.">");
        else
          $this->mail->setCc($email);
      } else
        $this->mail->setCc($email);
    }
  }

  // Set bcc:
  function setBcc($name, $email) {
    if ($email != "") {
      if ($this->component == "SMTP") {
        if ($name != "")
          $this->mail->setBcc("\"".$name."\" <".$email.">");
        else
          $this->mail->setBcc($email);
      } else
      $this->mail->setBcc($email);
    }
  }

  // Set subject
  function setSubject($subject) {
    $this->mail->setSubject($subject);
  }

  // Get current path
  function getCurrentPath() {
    $url = "http://".$_SERVER['HTTP_HOST'];
    if ($_SERVER['SERVER_PORT'] != '80') {
      $url .= ':'.$_SERVER['SERVER_PORT'];
    }
    $url .= substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], "/")+1);
    $url = str_replace(" ", "%20", $url);
    $this->debug("CurrentPath = <font color=\"#000099\"><b>".$url."</b></font><br/>");
    return $url;
  }

  // Set template body
  function setBody_Template_html($body) {
    // Use file as body
    $content = "";
    if (!strpos($body, "://")) {
      $body = $this->getCurrentPath().$body;
    }
    //Get the base Path
    $basePath = $body;
    $queryStart = strpos($basePath, "?");
    if ($queryStart) $basePath = substr($basePath, 0, $queryStart-1);
    $protStart = strpos($basePath,"://");
    $lastSlash = strrpos($basePath,"/");
    if ($lastSlash <= $protStart+3) $lastSlash = FALSE;
    if (!$lastSlash) {
      $basePath .= "/";
    } else {
      if (!strpos($basePath,".",$lastSlash+1))
      $basePath .= "/";
    else
    $basePath = substr($basePath, 0, $lastSlash+1);
    }

    $this->debug("Body = <font color=\"#000099\"><b>".$body."</b></font><br/>");
    $this->debug("Base Path = <font color=\"#000099\"><b>".$basePath."</b></font><br/>");
    ini_set("allow_url_fopen", 1);
    $handle = fopen ($body, "r");
    if (!$handle) {
      $this->error("open");
    }
    while (!feof($handle)) {
      $content .= fgets ($handle, 1024);
    }
    fclose ($handle);

    $num = preg_match_all('/[="]\/?([^"\s]*(\.gif|\.jpg|\.jpeg|\.png|\.css|\.js))["\s]/i', $content, $matches);
    if ($num > 0) {
      $unique_matches = array_unique($matches[1]);
      foreach ($unique_matches as $match) {
        if (!strpos($match, "://")) {
          //if (substr($match, 0, 1) == "/") { $match = substr($match, 1); }
          $content = str_replace($match, $basePath.$match, $content);
          $content = str_replace('/'.$basePath.$match, $basePath.$match, $content);
          $this->debug($match." => ".$basePath.$match."<br/>");
          $match = $basePath.$match;
        }
        if ($this->embedImages) {
          $image = @$this->mail->getfile($match);
          if ($image) {
            $this->mail->addHtmlImage($image, $match);
          }
        }
      }
    }

    $num = preg_match_all('/href\s*=\s*"\/?([^"]*)"/i', $content, $matches);
    if ($num > 0) {
      $unique_matches = array_unique($matches[1]);
      foreach ($unique_matches as $match) {
        if (!strpos($match, "://") && !stristr($match, "mailto:") && !stristr($match, "javascript:")) {
          //if (substr($match, 0, 1) == "/") { $match = substr($match, 1); }
          $content = str_replace('"'.$match.'"', '"'.$basePath.$match.'"', $content);
          $content = str_replace('"/'.$match.'"', '"'.$basePath.$match.'"', $content);
          $this->debug($match." => ".$basePath.$match."<br/>");
        }
      }
    }
    $this->mail->is_built = false;
    $this->mail->setHtml($content);
  }

  // Set template body
  function setBody_Template_text($body) {
    // Use file as body
    $content = "";
    if (strpos("://", $body) == 0) {
      $body = $this->getCurrentPath().$body;
    }
    ini_set("allow_url_fopen", 1);
    $handle = fopen ($body, "r");
    while (!feof($handle)) {
      $content .= fgets ($handle, 1024);
    }
    fclose ($handle);
    $this->mail->is_built = false;
    $this->mail->setText($content);
  }

  // Set static body
  function setBody_Static_html($body) {
    $this->mail->is_built = false;
    $this->mail->setHtml(nl2br($body));
  }

  // Set static body
  function setBody_Static_text($body) {
    $this->mail->is_built = false;
    $this->mail->setText($body);
  }

  // Setup attachments (Using a recordset)
  function setAttRecord($record, $field) {
    eval("global \$".$record.", \$row_".$record.";");
    eval("\$sm_att = \$".$record.";");
    eval("\$row_sm_att = \$row_".$record.";");
    do {
      $this->attFiles[] = $row_sm_att[$field];
    } while ($row_sm_att = mysql_fetch_assoc($sm_att));
  }

  // Setup attachments (With a list)
  function setAttList($files) {
    $this->attFiles = explode(",", $files);
  }

  // Add the attachments to the mail
  function setAttFolder($theFolder) {
    if ($theFolder == "") $theFolder = ".";
    if (substr($theFolder,-1) != "/") $theFolder .= "/";
    $this->debug("Attach folder: ".$theFolder."<br/>");
    $handle=opendir($theFolder);
    while (false!==($file = readdir($handle))) {
      if ($file != "." && $file != ".." && !is_dir($file)) {
        if ($theFolder != "./")
          $this->attFiles[] = $theFolder.$file;
        else
          $this->attFiles[] = $file;
      }
    }
    closedir($handle);
  }

  // Setup smtp
  function smtpSetup($server, $port, $user, $pass) {
    $auth = ($user != "") ? true : false;
    $port = ($port == "") ? 25 : $port;
		$server = ($server == "") ? "localhost" : $server;
    $this->mail->setSMTPParams($server, $port, NULL, $auth, $user, $pass);
  }

  // Return the progress file location
  function getProgressFile() {
    $progressFilePath = '.';

    if ($this->tmpFolder != "") {
      $progressFilePath = $this->tmpFolder;
    }

    return $progressFilePath.'/sm_'.session_id().'.txt';
  }

  // The actually sending of the e-mail
  function sendMail($multiple = "") {
    $this->debug("PHP version(<font color=\"#990000\">".phpversion()."</font>)<br/>");
    $this->debug("component(<font color=\"#990000\">".$this->component."</font>)<br/>");
    $this->debug("attFiles(<font color=\"#990000\">".$this->attFiles."</font>)<br/>");

    // Add attachments
    foreach ($this->attFiles as $attFile) {
      if ($attFile != "") {
        $attachment = $this->mail->getfile($attFile);
        if (strchr($attFile, "/")) {
          $fileName = substr(strrchr($attFile, "/"),1);
        } else {
          $fileName = $attFile;
        }
        $this->mail->addAttachment($attachment, $fileName);
      }
    }

    if (strtolower($this->component) == "smtp") {
      if ($this->ignore_errors) {
        $result = @$this->mail->send($this->to, "smtp");
      } else {
        $result = $this->mail->send($this->to, "smtp");
        if (!$result) {
          $this->error("smtp");
        }
      }
    } else {
      if ($this->ignore_errors) {
        $result = @$this->mail->send($this->to);
      } else {
        $result = $this->mail->send($this->to);
        if (!$result) {
          $this->error("sendmail");
        }
      }
    }

    if ($multiple == "multiple" && $this->progressBar != "") {
      $this->current_mail++;
      if ($this->timer < time()) {
        $handle = @fopen($this->getProgressFile(), "w");
        if ($handle) {
          @flock($handle, 2);
          fwrite($handle, "total=".$this->total_mail."&current=".$this->current_mail);
		  @flock($handle, 3);
          fclose($handle);
        } else {
          $this->error("progress");
        }
        $this->timer = time();
      }
    }

    $this->to = Array();
    $this->attFiles = Array();
    $this->mail->attachments = Array();
  }

  // Reset will empty attachments and html_images
  function reset() {
    $this->mail->reset();
  }

  // Done
  function done() {
    if ($this->progressBar != "")
      @unlink($this->getProgressFile());
  }

  // Debugger
  function debug($info) {
    if ($this->debugger) {
      echo "<font face=\"verdana\" size=\"2\">".$info."</font>";
    }
  }

  // Display error
  function error($error) {
    echo "<b>Error sending e-mail</b><br/><br/>";

    switch ($error) {
    // Can not write progress info
      case "progress":
        echo "Could not write progress file information.<br/>Please make sure you have a write access to the folder that is specified as temp Folder<br/>";
      break;
    // Not correct version
    case "open":
      echo "<br>Could not open the URL to the template<br/>";
      break;
    // Not correct version
    case "version":
      echo "Please upload the latest version of incSmartMailer.php<br/>";
      break;
    // Error sending e-mail thru smtp
    case "smtp":
      foreach ($this->mail->errors as $smtperror) {
        echo $smtperror."<br/>";
      }
      break;
    // Error sending email thru sendmail
    case "sendmail";
      echo "An error occured when trying to send the e-mail<br/>";
      break;
    }

    // Allow to go back and stop the script
    echo "Please correct and <a href=\"javascript:history.back(1)\">try again</a>";
    exit;
  }

}

function getMailAction() {
  $retMailAction = $_SERVER['PHP_SELF'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $retMailAction .= "?" . $_SERVER['QUERY_STRING'];
  }
  return $retMailAction;
}
?>