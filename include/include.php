<?php
require("bdd.php");

function tempsRestant ($heure, $minute, $seconde, $mois, $jour, $annee) {
    $timestampRestant = mktime($heure, $minute, $seconde, $mois, $jour, $annee) - time();

    $diffJour = floor($timestampRestant/60/60/24);
    $timestampRestant -= $diffJour*60*60*24;

    $diffHeure = floor($timestampRestant/60/60);
    $timestampRestant -= $diffHeure*60*60;

    $diffMinute = floor($timestampRestant/60);
    $timestampRestant -= $diffMinute*60;

    $diffSeconde = $timestampRestant;

    if ($diffJour >= 0 AND $diffHeure >= 0 AND $diffMinute >= 0 AND $diffSeconde >=0 ) {
        $dateJour = isPluriel($diffJour, "jour", "jours");
        $dateHeure = isPluriel($diffHeure, "heure", "heures");
        $dateMinute = isPluriel($diffMinute, "minute", "minutes");
        $dateSeconde = isPluriel($diffSeconde, "seconde", "secondes");

        return ($diffJour.' '.$dateJour.', '.$diffHeure.' '.$dateHeure.', '.$diffMinute.' '.$dateMinute.' et '.$diffSeconde.' '.$dateSeconde);
    }else{
        return ("C'est parti pour la dernière soutenance");
    }
}

function getDateFr ($format, $timestamp){
    $anglais = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $francais = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

    $date = date($format, $timestamp);
    $date = str_replace($anglais, $francais, $date);
    return $date;
}

function mysqlSelect ($sql, $count = "NON", $return = "OUI") {
    $req = mysql_query($sql);

    if ($count == "COUNT") {

        if ($return == "OUI") {
            $row = mysql_fetch_array($req);
        }
        $row['count'] = mysql_num_rows($req);
    }else{
        $row = mysql_fetch_array($req);
    }

    return $row;
}

function nbrPage ($table, $nbrParPage, $condition = "", $nbr = "NON") {
    if ($condition != "") {
        $where = ' WHERE '.$condition;
    }else{
        $where = "";
    }

    // Requête Sql
    $sql = 'SELECT id FROM '.$table.$where;
    $row = mysqlSelect($sql, "COUNT", "NON");

    if ($nbr == "NON") {
        $nbr = $row['count'];

        $nbrPage = ceil($nbr / $nbrParPage);
        return $nbrPage;
    }else{
        $return['nbr'] = $row['count'];

        $return['nbrPage'] = ceil($return['nbr'] / $nbrParPage);
        return $return;
    }
}

function page ($nbrPage, $pointeur = "LAST") {
    if (isset($_GET['page'])) {
        $page = intval($_GET['page']);
    }else{
        $page = 0;
    }

    if ($page < 1 OR $page > $nbrPage) {

        if ($pointeur == "FIRST") {
            $page = 1;
        }else{
            $page = $nbrPage;
        }
    }

    return $page;
}

function echoPage ($page, $nbrPage, $lien, $valeurForGET = "", $pointeur = "LAST") {
    if ($valeurForGET != "") {
        $signeIntero = "?";
        $signeAnd = "&";
    }else{
        $signeIntero = "";
        $signeAnd = "";
    }

    for ($i = 1; $i <= $nbrPage; $i++) {
        if ($i == $page){
            echo '<span class="current">'.$i.'</span> ';
        }else{

            if ($pointeur == "FIRST") {
                $finPage = 1;
            }else{
                $finPage = $nbrPage;
            }

            if ($i == $finPage) {
                echo '<a href="'.$lien.'.html'.$signeIntero.$valeurForGET.'">'.$i.'</a> ';
            }else{
                if ($valeurForGET == "")
                  echo '<a href="'.$lien.'-'.$i.'.html">'.$i.'</a> ';
                else
                  echo '<a href="'.$lien.'-'.$i.'.html?'.$valeurForGET.'">'.$i.'</a> ';
            }
        }
    }
}

$miseHTML['header'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
  <head>
    <title>AutoMap Website</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" media="screen" type="text/css" title="design" href="css/design.css" />
	 <script type="text/javascript" src="lib/jquery.min.js"></script>
	 <script type="text/javascript" src="lib/fancybox/jquery.easing-1.3.pack.js"></script>
	 <script type="text/javascript" src="lib/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	 <script type="text/javascript" src="lib/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	 <link rel="stylesheet" type="text/css" href="lib/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	 <script type="text/javascript">
	 	$(document).ready(function() {
 	 	  	$("a.fan").fancybox({
		"titleShow"     : false,
		"transitionIn"	: "elastic",
		"transitionOut"	: "elastic",
		"easingIn"      : "easeOutBack",
		"easingOut"     : "easeInBack"
 	 	  	});
 	   	});
    	 </script>
  </head>
  <body>

  <div id="container">
      <div id="header">
          <div id="pres">
	           <p>La cartographie de demain !</p>
          </div>
      </div>

      <div id="menu">
          <ul>
              <li><a href="index.html">Accueil</a></li>
              <li><a href="project.html">Projet</a></li>
              <li><a href="telechargement.html">Téléchargement</a></li>
              <li><a href="team.html">L\'équipe</a></li>
              <li><a href="contact.html">Contact</a></li>
              <li><a href="liens.html">Liens</a></li>
          </ul>
      </div>

      <div id="milieu">
          <div id="contenu">';
$miseHTML['footer'] = '</div>

          <div class="clear">
          </div>
      </div>

      <div id="footer">
          <div id="gauche">
              <p>AutoMap Copyright2011 - Tous droits réservés</p>
          </div>

          <div id="droite">
              <p>Site optimisé pour le navigateur Mozilla Firefox.</p>
          </div>
      </div>
  </div>
  </body>
</html>';
?>
