<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8" name="viewport" content="width=device-width"/>
  <title> Smart Home </title>
  <link href="style.css" rel="stylesheet">
  <?php
  $gpios  = array(2, 3, 4);
  $farbe = "white"
  foreach($gpios as $pin){
    shell_exec(sprintf("/usr/local/bin/gpio -g mode %d out", $pin));
  }
  if(isset($_GET["off"])){
    foreach($gpios as $pin){
      shell_exec(sprintf("/usr/local/bin/gpio -g write %d 1", $pin));
    }
  }
  else if(isset($_GET["white"])){
    foreach($gpios as $pin){
      shell_exec(sprintf("/usr/local/bin/gpio -g write %d 0", $pin));
    }
  }
  else if(isset($_GET["green"])){
    shell_exec("/usr/local/bin/gpio -g write 2 0");
    shell_exec("/usr/local/bin/gpio -g write 3 1");
    shell_exec("/usr/local/bin/gpio -g write 4 1");
  }
  else if(isset($_GET["red"])){
    shell_exec("/usr/local/bin/gpio -g write 2 1");
    shell_exec("/usr/local/bin/gpio -g write 3 0");
    shell_exec("/usr/local/bin/gpio -g write 4 1");
  }
  else if(isset($_GET["blue"])){
    shell_exec("/usr/local/bin/gpio -g write 2 1");
    shell_exec("/usr/local/bin/gpio -g write 3 1");
    shell_exec("/usr/local/bin/gpio -g write 4 0");
  }
  else if(isset($_GET["yellow"])){
    shell_exec("/usr/local/bin/gpio -g write 2 0");
    shell_exec("/usr/local/bin/gpio -g write 3 0");
    shell_exec("/usr/local/bin/gpio -g write 4 1");
  }
  else if(isset($_GET["turquoise"])){
    shell_exec("/usr/local/bin/gpio -g write 2 0");
    shell_exec("/usr/local/bin/gpio -g write 3 1");
    shell_exec("/usr/local/bin/gpio -g write 4 0");
  }
  else if(isset($_GET["pink"])){
    shell_exec("/usr/local/bin/gpio -g write 2 1");
    shell_exec("/usr/local/bin/gpio -g write 3 0");
    shell_exec("/usr/local/bin/gpio -g write 4 0");
  }
  ?>
</head>
<?php echo"<body style="background-color: $farbe">"?>
  <h1>LED Control</h1>
  <div id=menu>
  <form method="get" action="index.php">
    <input type="submit" value="Aus" name="off">
    <p/>
    <input type="submit" value="Weiss" name="white">
    <p/>
    <input type="submit" value="Rot" name="red">
    <p/>
    <input type="submit" value="Grün" name="green">
    <p/>
    <input type="submit" value="Blau" name="blue">
    <p/>
    <input type="submit" value="Gelb" name="yellow">
    <p/>
    <input type="submit" value="Türkis" name="turquoise">
    <p/>
    <input type="submit" value="Pink" name="pink">
  </form>
  </div>
</body>
</html>
