<?php
//$folder_level = 5; 
//$folder_level should be set on file that includes this menu if required.
$pfx=""; // url prefix
if (isset($folder_level) && $folder_level > 0) {
   for ($i=0; $i<$folder_level; $i++) {
      $pfx = $pfx . "../";
   }
}
$chapmenu = <<<HTMLCODE
<nav id="chapmenu">
		<h2 id="chapmenuheading">Meny</h2>
		<section>
			<h3>kapittel 6</h3>
			<ul>
				<li><a href="index.php">kort tekst</a>
				</li>
				<li><a href="fortelling.php">lang tekst</a>
				</li>
				<li><a href="ordliste.php">ordliste</a>
				</li>
				<li><a href="oppgaver">oppgaver</a>
				</li>
				<li><a href="film.php">film</a>
				</li>
			</ul>
		</section>

		<section>
			<h3>Info</h3>
			<ul>
				<li><a href="veiledning/">Til læreren</a>
				</li>
				<li><a href="foreldre.php">Til foreldre</a>
				</li>
			</ul>
		</section>
	</nav>
HTMLCODE;

// use regex on $chapmenu insert $pfx immediately after href="

$chapmenu = str_replace('href="', 'href="' . $pfx , $chapmenu);

echo $chapmenu;
?>
