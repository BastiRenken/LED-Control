<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8" name="viewport" content="width=device-width"/>
  <title>LED Control</title>
  <link href="style.css" rel="stylesheet">
  <?php
  $gpios  = array(2, 3, 4);
  $andere_gpios = array(17, 27, 22, 10, 9);
  foreach($gpios as $pin){
    shell_exec(sprintf("/usr/local/bin/gpio -g mode %d out", $pin));
  }
  foreach($andere_gpios as $pin){
    shell_exec(sprintf("/usr/local/bin/gpio -g mode %d out", $pin));
    shell_exec(sprintf("/usr/local/bin/gpio -g write %d 1", $pin));
  }
  shell_exec("/usr/local/bin/gpio -g mode 11 out");

  if(isset($_GET["off"])){
    foreach($gpios as $pin){
      shell_exec(sprintf("/usr/local/bin/gpio -g write %d 1", $pin));
      file_put_contents("farbe.txt", "lavender");
      file_put_contents("status.txt", "0");
    }
  }
  else if(isset($_GET["white"])){
    foreach($gpios as $pin){
      shell_exec(sprintf("/usr/local/bin/gpio -g write %d 0", $pin));
      file_put_contents("farbe.txt", "lightyellow");
    }
  }
  else if(isset($_GET["green"])){
    shell_exec("/usr/local/bin/gpio -g write 2 0");
    shell_exec("/usr/local/bin/gpio -g write 3 1");
    shell_exec("/usr/local/bin/gpio -g write 4 1");
    file_put_contents("farbe.txt", "limegreen");
  }
  else if(isset($_GET["red"])){
    shell_exec("/usr/local/bin/gpio -g write 2 1");
    shell_exec("/usr/local/bin/gpio -g write 3 0");
    shell_exec("/usr/local/bin/gpio -g write 4 1");
    file_put_contents("farbe.txt", "red");
  }
  else if(isset($_GET["blue"])){
    shell_exec("/usr/local/bin/gpio -g write 2 1");
    shell_exec("/usr/local/bin/gpio -g write 3 1");
    shell_exec("/usr/local/bin/gpio -g write 4 0");
    file_put_contents("farbe.txt", "blue");
  }
  else if(isset($_GET["yellow"])){
    shell_exec("/usr/local/bin/gpio -g write 2 0");
    shell_exec("/usr/local/bin/gpio -g write 3 0");
    shell_exec("/usr/local/bin/gpio -g write 4 1");
    file_put_contents("farbe.txt", "gold");
  }
  else if(isset($_GET["turquoise"])){
    shell_exec("/usr/local/bin/gpio -g write 2 0");
    shell_exec("/usr/local/bin/gpio -g write 3 1");
    shell_exec("/usr/local/bin/gpio -g write 4 0");
    file_put_contents("farbe.txt", "cyan");
  }
  else if(isset($_GET["pink"])){
    shell_exec("/usr/local/bin/gpio -g write 2 1");
    shell_exec("/usr/local/bin/gpio -g write 3 0");
    shell_exec("/usr/local/bin/gpio -g write 4 0");
    file_put_contents("farbe.txt", "hotpink");
  }
  else if(isset($_GET["strobo"])){
    shell_exec("sudo /usr/bin/python3 /var/www/html/strobo.py &");
  }
  else if(isset($_GET["party"])){
    shell_exec("sudo /usr/bin/python3 /var/www/html/party.py &");
  }
  else if(isset($_GET["wecker"])){
    file_put_contents("wecker.txt", $_GET["zeit"]);
  }
  /*
  else if(isset($_GET["shuffle"])){
    while($_GET = "shuffle"){
      $pin = rand(2, 4);
      $modus = rand(0, 1);
      shell_exec(sprintf("/usr/local/bin/gpio -g write %d %d", $pin, $modus));
      sleep(1);
    }
  }
  else if(isset($_GET["wecker"])){
    shell_exec("sudo /usr/bin/python3 /var/www/html/wecker.py");
    echo("Wecker an");
  }
  */
  else if(isset($_GET["buzzer"])){
    shell_exec("/usr/local/bin/gpio -g write 11 1");
    sleep(1);
    shell_exec("/usr/local/bin/gpio -g write 11 0");
  }
  ?>
</head>
<?php $farbe = file_get_contents("farbe.txt"); ?>
<?php echo"<body style=\"background-color:$farbe\">";?>
  <h1><a href="index.php">LED Control</a></h1>
  <div id=menu>
  <form method="get" action="index.php">
    <input class="button" type="submit" value="Aus" name="off">
    <p/>
    <input class="button" type="submit" value="Weiss" name="white">
    <p/>
    <input class="button" type="submit" value="Rot" name="red">
    <p/>
    <input class="button" type="submit" value="Grün" name="green">
    <p/>
    <input class="button" type="submit" value="Blau" name="blue">
    <p/>
    <input class="button" type="submit" value="Gelb" name="yellow">
    <p/>
    <input class="button" type="submit" value="Türkis" name="turquoise">
    <p/>
    <input class="button" type="submit" value="Pink" name="pink">
    <p/>
    <!-- <input class="button" type="submit" value="Shuffle" name="shuffle">
    <p/> -->
    <!--<input class="button" type="submit" value="Wecker" name="wecker">
    <p/> -->
    <input class="button" type="submit" value="Buzzer" name="buzzer">
    <p/>
    <input class="button" type="submit" value="Strobo" name="strobo">
    <p/>
    <input class="button" type="submit" value="Party" name="party">
    <p/>
  </form>
  <form action="index.php">
    <p>
      Weckzeit:
      <input type="text" name="zeit">
      <input type="submit" name="wecker">
    </p>
  </form>
  </div>
</body>
</html>
