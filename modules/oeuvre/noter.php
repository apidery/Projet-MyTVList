<?php

  	$connexion = new PDO("mysql:host=localhost;dbname=mtvlist" , "Pidery" , "projetmontreuil");

    $note = $_POST['note'];
    $oeuvre = $_POST['oeuvre'];
    $votant = $_POST['votant'];

    $insert_note = $connexion->prepare("INSERT INTO mtvlist.notes(idoeuvre,iduser,note) VALUES ($oeuvre,$votant,$note)");
    $insert_note->execute();


?>