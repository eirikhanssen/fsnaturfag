<?php
//$folder_level should be set on file that includes this menu if required.
if (!isset($folder_level)) {
	$folder_level = 0;
}
$pfx="../"; // url prefix
if (isset($folder_level) && $folder_level > 0) {
   for ($i=0; $i<$folder_level; $i++) {
      $pfx = $pfx . "../";
   }
}

$self_path = $_SERVER['PHP_SELF'];
$self_tail = preg_replace('/.+?([^\/]+\/[^\/]+)$/', '\1', $self_path);
$self_tail_pattern = preg_replace('/\//' , '\\\/' , $self_tail);
$tail_pattern = '/<li>(<a href=".*?' . $self_tail_pattern . '">[^<]+<\/a><\/li>)/';

//$tail_pattern = '/<li>(<a href=".*?'.$self_tail_pattern.'">.+<\/a>)/';
$self_folder = preg_replace('/.+?([^\/]+)\/[^\/]+$/', '\1', $self_path);
$folder_pattern = '/<li>(<a href=".*?' . $self_folder . '.*?">[^<]+<\/a><\/li>)/';

$chapmenu = <<<HTMLCODE
<nav id="chapmenu">
		<section>
			<h3>Kapittel 6</h3>
			<ul>
				<li><a href="06/index.php">kort tekst</a></li>
				<li><a href="06/fortelling.php">lang tekst</a></li>
				<li><a href="06/ordliste.php">ordliste</a></li>
				<li><a href="06/oppgaver/index.php">oppgaver</a></li>
				<li><a href="06/film.php">film</a></li>
			</ul>
		</section>

		<section>
			<h3>Info</h3>
			<ul>
				<li><a href="06/veiledning/index.php">Til læreren</a></li>
				<li><a href="06/foreldre.php">Til foreldre</a></li>
			</ul>
		</section>
	</nav>
HTMLCODE;

// use regex on $chapmenu insert $pfx immediately after href="

$chapmenu = str_replace('<nav id="chapmenu"', '<nav id="chapmenu" data-tail="'. $self_tail .'"' . ' data-folder-level="' . $folder_level . '"' . ' data-folder="' . $self_folder . '"' , $chapmenu);
switch ($folder_level) {
	case 0:
		// same folder
		$chapmenu = preg_replace($tail_pattern, '<li class="currentPage">$1' , $chapmenu);
		break;
	case 1:
		// parent folder
		$chapmenu = preg_replace($folder_pattern, '<li class="currentPage">$1' , $chapmenu);
		break;
	case 2:
		break;
	default:
		break;
}

$chapmenu = str_replace('href="' , 'href="' . $pfx , $chapmenu);

echo $chapmenu;
?>
