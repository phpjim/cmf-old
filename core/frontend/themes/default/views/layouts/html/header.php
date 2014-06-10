<?php
/**
 *
 * header.php layout
 *
 * @author Vadims Bucinskis <vadim.buchinsky@gmail.com>
 * @copyright 2014 MaWebSolutions team.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
?>
<header id="header">
    <nav id="nav-top">
        <div class="container">
            <ul class="contact-top">
                <li><a href="#"><i class="fa fa-envelope"></i> info@example.com </a></li>
            </ul>
            <ul class="social-top pull-right">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-flickr"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
        </div>
    </nav>
    <nav id="nav-middle">
        <nav class="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <ul class="navbar-xs pull-right  visible-xs">
                        <li><button class="btn btn-header-search" ><i class="fa fa-search"></i></button></li>
                        <li><a href="#" data-toggle="collapse" data-target="#navbar-collapse"><i class="fa fa-bars"></i></a></li>
                    </ul>
                    <a class="navbar-brand" href="#">
                        <img src="<?php echo $themeAssets; ?>/img/logo.png">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right hidden-xs" id="navigation">
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><button class="btn btn-circle btn-header-search" ><i class="fa fa-search"></i></button></li>
                    </ul>
                </div>
            </div>
            <!-- /.container -->
        </nav>
    </nav>
</header>

<div class="widget-top-search">
    <span class="icon"><a href="#" class="close-header-search"><i class="fa fa-times"></i></a></span>
    <form id="top-search">
        <h2><strong>Quick</strong> Search</h2>
        <div class="input-group">
            <input  type="text" name="q" placeholder="Find something..." class="form-control" />
							<span class="input-group-btn">
							<button class="btn" type="button" title="With Sound"><i class="fa fa-microphone"></i></button>
							<button class="btn" type="button" title="Visual Keyboard"><i class="fa fa-keyboard-o"></i></button>
							<button class="btn" type="button" title="Advance Search"><i class="fa fa-th"></i></button>
							</span>
        </div>
    </form>
</div>
<!-- //widget-top-search-->
<section id="header-space"></section>