<?php
require_once ('config.inc.php');
require_once ('functions/misc.php');

putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);
bindtextdomain("tm", $localedir);
textdomain("tm");

print '<?xml version="1.0" encoding="UTF-8"?>';
?>

<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	>

<channel>
	<title><?php printf (_("%s - Random unfixed"), $prod_name); ?></title>
	<atom:link href="<?php print currentPageURL(); ?>" rel="self" type="application/rss+xml" />
	<link><?php print $base_url; ?></link>
	<description><?php print (_("Random unfixed terms")); ?></description>
	<pubDate><?php print date("r");?></pubDate>
	<language>ro</language>
<?php
$lines = file($file_glossary);
$lines_num = count($lines);
$unfixed_lines = array();

$glosslink= _("Link to glossary");
$wikilink= _("Link to wiki");
$opentranslink= _("Link to Open-tran.eu");
$terms=_("Term: ");
$trans=_("Translated: ");
$ctx=_("Context: ");

foreach ($lines as $line_num => $line) {
    if (strstr($line,'?')) {
        array_push($unfixed_lines,$line);
    }    
}
$unfixed_lines_num = count($unfixed_lines);

$line_rand = $unfixed_lines[rand(0,$unfixed_lines_num-1)];

list ( $term['name'], $term['translation'], $term['context']) = explode("\t", $line_rand, 3);
$term['name_escaped'] = str_replace(" ", "+", $term['name']);
list ( $date['year'], $date['month'], $date['day'], $date['hour'], $date['minute'], $date['second'] ) = split ('[ \:\-]',$term['date'],6);
$term['link_glosary'] = '<p><a href="'.$base_url.'index.php?keyword='.$term['name_escaped'].'">'.$glosslink.'</a></p>';
if ( $base_url_wiki && ( preg_match ('/.*\[\[(.*)\]\].*/', $term['context'], $matches) ) ){
    $term['link_wiki'] = '<p><a href="'.$base_url_wiki.$matches[1].'">'.$wikilink.'</a></p>';
} else {
    $term['link_wiki'] = "";
}

$term['link_open_trans'] = ($base_url_open_trans) ? '<p><a href="'.$base_url_open_trans.$term['name_escaped'].'">'.$opentranslink.'</a></p>' : '';

?>
	  <item>
		<title><?php print $term['name']; ?></title>
		<link><?php print $base_url; ?>index.php?keyword=<?php print $term['name_escaped']; ?></link>
		<guid><?php print $base_url; ?>index.php?keyword=<?php print $term['name_escaped']; ?></guid>
        <pubDate><?php print date("r"); ?></pubDate>
		<dc:creator>Gnome of the glossary></dc:creator>
		<description><![CDATA[
        <?php 
        print '<p>'.$terms.$term['name'].'</br></p>';
        print '<p>'.$trans.$term['translation'].'</p>';
        print '<p>'.$ctx.$term['context'].'</p>';
        print $term['link_wiki'];
        print $term['link_open_trans'];
        print $term['link_glosary'];
        ?>
        ]]></description>
	  </item>
	</channel>
</rss>


