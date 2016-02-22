<?php
require("include/include.php");

echo $miseHTML['header'];
?>
<h1>Présentation du projet</h1>
<p>AutoMap a été réalisé en Objective Caml en utilisant les bibliothèques OcamlSDL, glMLite et LablGTK par l'équipe <a href="team.php">UMAD</a>.</p>

<p>AutoMap est capable de transformer n'importe quelle image représentant un relief (tel que des cartes topologiques), en couleurs ou en niveaux de gris, en une représentation tridimensionnelle beaucoup plus visuelle et intuitive qu'une simple image ! Cela vous permettra de vous déplacer dans l'espace et de visualiser plus facilement le relief de votre image.</p>

<p>AutoMap génère un fichier Wavefront (.obj) standard compatible avec Blender entre autres ce qui vous permettra d'exporter votre modèle pour votre logiciel de modélisation 3D favori pouvant lire les fichiers Wavefront (.obj) !</p>

<p>Il y a plusieurs étapes avant la génération du modèle 3D : 

<table>
<tbody>
<tr><td>&bull; Élimination du bruit</td><td><a rel="proj" class="fan" href="images/bruit.png"><img alt="" width="250px" src="images/bruit.png" /></a></td>
<tr><td>&bull; Détection des contours</td><td><a rel="proj" class="fan" href="images/border.png"><img alt="" width="250px" src="images/border.png" /></a></td>
<tr><td>&bull; Génération de la grille</td><td><a rel="proj" class="fan" href="images/quadri.png"><img alt="" width="250px" src="images/quadri.png" /></a></td>
<tr><td>&bull; Précalcul des normales et des ombres</td><td><a rel="proj" class="fan" href="images/pre.png"><img alt="" width="250px" src="images/pre.png" /></a></td>
</tr>
</tbody>
</table>

<p>Après avoir passé ces étapes, vous serez en mesure d'afficher le terrain généré via une interface utilisant OpenGL (un moteur 3D) et de vous mouvoir dans l'espace. </p>

<p>AutoMap gère plusieurs modes d'affichages :
<table>
<tbody>
<tr><td>&bull; Vue fil de fer</td><td><a rel="proj" class="fan" href="images/wireframe.png"><img alt="" width="250px" src="images/wireframe.png" /></a></td></tr>
<tr><td>&bull; Vue fil de fer texturé</td><td><a rel="proj" class="fan" href="images/textured_wireframe.png"><img alt="" width="250px" src="images/textured_wireframe.png" /></a></td></tr>
<tr><td>&bull; Vue solide texturée</td><td><a rel="proj" class="fan" href="images/textured_solid.png"><img alt="" width="250px" src="images/textured_solid.png" /></a></td></tr>

</tbody>
</table>
</p>
<?php
echo $miseHTML['footer'];
?>