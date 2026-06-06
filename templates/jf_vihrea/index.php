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



// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');
$latitude           = (float)$this->params->get( 'latitude', '' );
$longitude          = (float)$this->params->get( 'longitude', '' );
$markerdescription  = $this->params->get('markerdescription', '');

// Add JavaScript Frameworks
//JHtml::_('bootstrap.framework');
JHtml::_('behavior.modal');

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/fonts/stylesheet.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/k2.css');

// Load optional rtl Bootstrap css and Bootstrap bugfixes
JHtmlBootstrap::loadCss($includeMaincss = false, $this->direction);

// Add current user information
$user = JFactory::getUser();

// Logo file or site title param
if ($this->params->get('logoas') == 1 && $this->params->get('logoFile'))
{
	$logo = '<img src="'. JURI::root() . $this->params->get('logoFile') .'" alt="'. $sitename .'" />';
}

elseif ($this->params->get('logoas') == 2 && $this->params->get('sitetitle'))
{
	$logo = '<span class="site-title">'. htmlspecialchars($this->params->get('sitetitle')) .'</span>';
}
else
{
	$logo = '<span class="site-title">'. $sitename .'</span>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="http:///ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">jQuery.noConflict();</script>
	<jdoc:include type="head" />
	<!--[if lt IE 9]>
		<script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script>
	<![endif]-->
    
    <!--[if IE 7]>
		<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie7only.css" rel="stylesheet" type="text/css" />
	<![endif]-->

    <script type="text/javascript" src="<?php echo $this->baseurl.'/templates/'.$this->template.'/scripts/js/md_stylechanger.js' ?>"></script>
	<script type="text/javascript" src="<?php echo $this->baseurl.'/templates/'.$this->template.'/scripts/js/jquery.isotope.min.js' ?>"></script>
    <script type="text/javascript">
    jQuery(document).ready(function() {
        callIsotope();
        jQuery('#navcollapse').click(function(){
            jQuery('.navigation ul.menu').slideToggle("slow");;
        });
        jQuery('#back-top').click(function() {
            jQuery('body,html').animate({scrollTop:0},800);
        });
    })
    </script>
    
    <?php if (JRequest::getVar('option') == 'com_contact' && $this->params->get('map')) : ?>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDqEFJTjKx6L-RpoT-nPiqTi1KJVJimH3I&sensor=false"></script>
    
    <script>
        var map;
        var myCenter=new google.maps.LatLng('<?php echo $latitude ?>', '<?php echo $longitude ?>');
        
        function initialize()
        {
            var mapProp = {
                center:myCenter,
                zoom:13,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
        
            map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
          
            var marker=new google.maps.Marker({
                position:myCenter
            });
        
            <?php if ($this->params->get('marker')) : ?>
            marker.setMap(map);
            <?php endif; ?>
        
            var infowindow = new google.maps.InfoWindow({
                content:"<?php echo $markerdescription; ?>"
            });
        
            infowindow.open(map,marker);
        }
    
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <?php endif; ?>
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '');
?> fluid">

	<!-- Body -->
	<div class="body">
		<div class="container-fluid">
			<!-- Header -->
			<div class="header">
				<div class="header-inner clearfix">
                	<h1 id="logo">
					<a class="brand pull-left" href="<?php echo $this->baseurl; ?>" title="<?php echo $sitename; ?>">
						<?php echo $logo;?>
					</a>
                    </h1>
                    <?php if (($this->params->get('social') && ($this->params->get('facebookicon') || $this->params->get('twittericon') || $this->params->get('rssicon'))) || $this->countModules('social')) : ?>
                    <div class="header-social pull-right">
                    	
                        <ul>
                            <?php if ($this->params->get('facebookicon') && $this->params->get('facebooklink') != '') : ?>
                            <li><a class="button-facebook" href="<?php echo $this->params->get('facebooklink'); ?>" target="_blank"></a></li>
                            <?php endif; ?>
                            <?php if ($this->params->get('twittericon') && $this->params->get('twitterlink') != '') : ?>
                            <li><a class="button-twitter" href="<?php echo $this->params->get('twitterlink'); ?>" target="_blank"></a></li>
                            <?php endif; ?>
                            <?php if ($this->params->get('rssicon') && $this->params->get('rsslink') != '') : ?>
                            <li><a class="button-rss" href="<?php echo $this->params->get('rsslink'); ?>" target="_blank"></a></li>
                            <?php endif; ?>
                        </ul>
                        <jdoc:include type="modules" name="social" style="xhtml" />
                    </div>
                    <?php endif; ?>
				</div>
			</div>
			<div class="navigation">
            	<div class="navigation-inner clearfix">
                	<div id="navbutton">
                        <a id="navcollapse">Menu</a>
                    </div>
                    <jdoc:include type="modules" name="mainmenu" style="none" />
                    <?php if ($this->countModules('fontresize') || $this->params->get('fontresizer')) : ?>
                    <div class="pull-right">
						<?php if ($this->params->get('fontresizer')) : ?>
                        <div id="fontsize"></div>
                        <?php endif; ?>
                        <?php if ($this->countModules('fontresize')) : ?>
                            <jdoc:include type="modules" name="fontresize" />
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
			</div>
			<div class="row-fluid">
				<div id="content">
					<!-- Begin Content -->
                    <jdoc:include type="message" />
                    <?php if(JRequest::getVar('option') != 'com_contact') : ?>
                        <jdoc:include type="component" />
                    <?php endif; ?>
                    <?php if(JRequest::getVar('option') == 'com_contact') : ?>
                    <div id="isotope">
                        <div id="form-contact" class="<?php echo $this->params->get('map') ? 'width4' : 'width10'; ?>">
                            <div class="contactInner">
                                <jdoc:include type="component" />
                            </div>
                        </div>
                        <?php if ($this->params->get('map')) : ?>
                            <div id="map" class="width6">
                                <div id="googleMap" style="height: 604px;">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
					<!-- End Content -->
				</div>
			</div>
		</div>
	</div>
    
    <!-- Bottom -->
    <div class="bottom">
    	<div class="bottom-inner clearfix">
    		<jdoc:include type="modules" name="bottom" style="jfcustom" />
        </div>
    </div>
	<!-- Footer -->
	<div class="footer">
		<div class="container-fluid">
        	<div class="footer-inner clearfix">
            	<div id="copyright">
                    <jdoc:include type="modules" name="copyright" />
                    <ul class="menu">
                    <!--
                    <li><a title="" target="_blank" href=""></a></li>
                    <li class="last"><a title="" target="_blank" href=""></a></li>
                    -->
                </ul>
                </div>
				<p class="pull-right"><a id="back-top"><?php echo JText::_('TPL_JF_VIHREA_BACKTOTOP'); ?></a></p>
            </div>
		</div>
	</div>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
