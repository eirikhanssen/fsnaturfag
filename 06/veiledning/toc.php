<?php
// toc for all pages in current folder

$self_path = $_SERVER['PHP_SELF'];
$self_filename = preg_replace('/.+?[^\/]+\/([^\/]+)$/', '\1', $self_path);
$self_folder = preg_replace('/.+?([^\/]+)\/[^\/]+$/', '\1', $self_path);
$filename_pattern = '/<li>(<a href=".*?' . $self_filename . '">[^<]+<\/a><\/li>)/';

$toc = <<<HTMLCODE
<nav id="toc">
	<ul>
		<li><a href="index.php">Om prototypen</a></li>
		<li><a href="hovedpersoner.php">Hovedpersoner</a></li>
		<li><a href="sammenheng_og_dybde.php">Sammenheng og dybde</a></li>
		<li><a href="pedagogisk_bruk.php">Pedagogisk bruk</a></li>
		<li><a href="bakgrunnsstoff.php">Bakgrunnsstoff</a></li>
		<li><a href="oppgaver_til_lareren.php">Oppgaver til læreren</a></li>
		<li><a href="utskrift.php">Utskrift</a></li>
		<li><a href="illustrasjoner.php">Illustrasjoner</a></li>
	</ul>
</nav>
HTMLCODE;

$toc = preg_replace($filename_pattern, '<li class="currentPage">$1' , $toc);

$toc = str_replace('<nav id="toc"', '<nav id="toc" data-filename="'. $self_filename .'"' . ' data-folder="' . $self_folder . '"' , $toc);

echo $toc;
?>