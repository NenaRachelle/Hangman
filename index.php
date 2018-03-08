<html>
    <head>
      <body>

<h1>Galgje</h1>
        </body>  
    </head>
    <body>
        <style>
           h1,p {
        text-align: center;
        font-family: verdana;
        } 
        body {
    background-color: lightblue;
}
            
        </style>
        <button onclick="myFunction()".alfabet; </button>

        <script>
            //function myFunction() {
            //alert("FOUT! Je hebt nog maar 9 levens over!");
}
        </script>
    </body>
    
</html>


<?php

session_start();
?>


<html>
<head>

<style type="text/css">

fieldset
{
    width: 25%;
}

</style>

  <title></title>
</head>

<body>
<?php

if ( !isset($_SESSION['word']) )
{
    
    $aWords = array(
        'cake', 
        'school',
        'fruit'
    );

    
    $_SESSION['word'] = strtolower($aWords[array_rand($aWords)]);
    
    
    $_SESSION['guesses'] = array();
        
   
    $_SESSION['lives'] = 10;
} 

if ( isset($_POST['guess']) )
{  
    $_POST['guess'] = strtolower($_POST['guess']);

    if ( in_array($_POST['guess'], range('a', 'z')) )
    {
        if ( !in_array($_POST['guess'], $_SESSION['guesses']) )
        {
            if ( strpos($_SESSION['word'], $_POST['guess']) === FALSE )
            {
                --$_SESSION['lives'];    
            }
            
            $_SESSION['guesses'][] = $_POST['guess'];
        } 
    }
} 

if ( $_SESSION['lives'] == 0 )
{
    echo '  <p>The word was "' . $_SESSION['word'] . '"</p>' . "\n\n";    
        
    echo '  <p><a href="hangman.php">Unlucky, new game?</a></p>';     
    
    unset($_SESSION['word']);
}
else
{
    $iLeft = 0;
     
    $sShow = '';
    
    for($i = 0; $i < strlen($_SESSION['word']); ++$i)
    {
        if ( in_array($_SESSION['word'][$i], $_SESSION['guesses']) )
        {
            $sShow .= $_SESSION['word'][$i];   
        } 
        else
        {
            $sShow .= '_';
                
            ++$iLeft;
        }
        $sShow .= ' ';
    }
    $sShow = trim($sShow);
        
    echo '  <p>' . $sShow . '</p>' . "\n";
    echo '  <p>' . $_SESSION['lives'] . ' live(s) left</p>';   
    
    if ( $iLeft == 0 )
    {
        echo "\n\n" . '  <p><a href="hangman.php">Congratulations, new game?</a></p>';  
     
        unset($_SESSION['word']);
    } 
}
?>


  <form method="post" action="hangman.php">
    <fieldset>
      <legend>Make a Guess</legend>

      <table>
        <tr>
          <td><label for="guess">Letter</label></td>

          <td><select name="guess" id="guess">
<?php 
foreach(range('A', 'Z') as $cLetter) 
{ 
    echo '<option value="' . strtolower($cLetter) . '">' . $cLetter . '</option>'; 
}
?>
          </select></td>
        </tr>

        <tr>
          <td colspan="2"><input type="submit" name="submit" id="submit" value=
          "Guess!" /></td>
        </tr>
      </table>
    </fieldset>
  </form>
</body>
</html>