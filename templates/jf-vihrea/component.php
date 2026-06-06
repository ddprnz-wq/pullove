<?php
/*------------------------------------------------------------------------
# JF_VIHREA!! - JOOMFREAK.COM JOOMLA 2.5 TEMPLATE 
# March 2013
# ------------------------------------------------------------------------
# COPYRIGHT: (C) 2013 JOOMFREAK.COM / KREATIF MULTIMEDIA GMBH
# LICENSE: Creative Commons Attribution
# AUTHOR: JOOMFREAK.COM
# WEBSITE: http://www.joomfreak.com - http://www.kreatif-multimedia.com
# EMAIL: info@joomfreak.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

$app   = JFactory::getApplication();
$doc   = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');

// Load optional rtl Bootstrap css and Bootstrap bugfixes
JHtmlBootstrap::loadCss($includeMaincss = false, $this->direction);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<jdoc:include type="head" />
<!--[if lt IE 9]>
	<script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script>
<![endif]-->
</head>
<body class="contentpane modal">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
