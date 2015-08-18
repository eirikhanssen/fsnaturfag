<?php
$self_path = $_SERVER['PHP_SELF'];
$self_filename = preg_replace('/.+?[^\/]+\/([^\/]+)$/', '\1', $self_path);
$self_folder = preg_replace('/.+?([^\/]+)\/[^\/]+$/', '\1', $self_path);

$toc = <<<HTMLCODE
<nav id="toc">
	<ul>
		<li><a href="index.php"><strong>Oppgaver</strong></a></li>
		<li><a href="kviss.php">Kviss</a></li>
		<li><a href="studer.php">Studer</a></li>
		<li><a href="snakke.php">Snakk sammen</a></li>
		<li><a href="observer.php">Observer</a></li>
		<li><a href="tegne.php">Tegn</a></li>
		<li><a href="fantasi.php">Fantasi</a></li>
	</ul>
</nav>
HTMLCODE;

$toc = str_replace('<nav id="toc"', '<nav id="toc" data-filename="'. $self_filename .'"' . ' data-folder="' . $self_folder . '"' , $toc);

echo $toc;

?>