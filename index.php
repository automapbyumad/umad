<?php
require("include/include.php");

// Pagination
$nbrMessageParPage = 3;
$nbrPage = nbrPage("news", $nbrMessageParPage);
                         
// $_GET pagination
$page = page($nbrPage, "FIRST");

echo $miseHTML['header'];
?>
<h1>Présentation du programme</h1>
<p>AutoMap est un logiciel de cartographie 3D <b>intuitif</b>, <b>puissant</b> et <b>multiplateforme</b> ! 
Grâce à AutoMap vous pourrez très aisément convertir vos relevés topologiques en une <b>magnifique</b> représentation tridimensionnelle.</p>
<p>AutoMap a été codé en Objective Caml et utilise les bibliothèques <b>glMLite</b>, <b>LablGTK</b> et <b>OcamlSDL</b> pour fonctionner.</p>

<p>AutoMap a été réalisé dans le cadre du projet du 1<sup>er</sup> semestre de deuxième année à l'<b>EPITA</b>.</p>

<h1>News</h1>

<?php
// Requête Sql
$sql = 'SELECT news, UNIX_TIMESTAMP(date) FROM news ORDER BY date DESC LIMIT '.($page-1)*$nbrMessageParPage.','.$nbrMessageParPage;
$req = mysql_query($sql);

while ($row = mysql_fetch_array($req)) {
    echo '<p class="date">'.getDateFr("l j F Y à G:i", intval($row['UNIX_TIMESTAMP(date)'])).',</p> ';
    echo '<div class="news"><div class="newscontent">'.utf8_encode($row['news']).'<div style="clear:both;"></div></div></div>';
}
                
// Pagination
echo '<div class="pagination">Page : ';
echo echoPage($page, $nbrPage, "index", "", "FIRST");
echo '</div>';
  
echo $miseHTML['footer'];
?>
