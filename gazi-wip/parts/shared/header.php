<?php
$categories     = get_the_category();
$category_id    = $categories[0]->cat_ID;

$news_class     = ($category_id == 3)   ? "selected" : "";
$features_class = ($category_id == 4)   ? "selected" : "";
$arts_class     = ($category_id == 6)   ? "selected" : "";
$voices_class   = ($category_id == 17)  ? "selected" : "";
$opinion_class  = ($category_id == 16)  ? "selected" : "";
$sports_class   = ($category_id == 5)   ? "selected" : "";
$food_class	= ($category_id == 75)	? "selected" : "";
$wespeaks_class = ($category_id == 13)  ? "selected" : "";

if (is_home()) {
  $home_class = "selected";
  $news_class = "";
  $features_class = "";
  $arts_class = "";
  $voices_class = "";
  $opinion_class = "";
  $sports_class = "";
  $food_class = "";
  $wespeaks_class = "";

} else {
  $home_class = "";
}
?>
    <div class="container">
      <div id="logo">
        <a class="header" href="/">
        <div class="header">
          <h1>
            <span class="the">the</span> Wesleyan <span class="argus">Argus</span>
          </h1>
        </div>
        </a>
        <!-- navigation -->
        <div class="navbar navbar-inverse navbar-first" role="navigation">
          <div class="container">
            <div class="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="<?=$home_class ?>"><a href="/">Home</a></li>

                <li class="<?=$food_class ?>"><a href="/section/news">News</a></li>
                <li class="<?=$food_class ?>"><a href="/section/features">Features</a></li>
                <li class="<?=$food_class ?>"><a href="/section/arts">Arts & Culture</a></li>
                <li class="<?=$opinion_class ?>"><a href="/section/opinion">Opinion</a></li>
                <li class="<?=$sports_class ?>"><a href="/section/sports">Sports</a></li>
		<li class="<?=$food_class ?>"><a href="/section/food">Food</a></li>
                <li class="<?=$food_class ?>"><a href="/section/wespeaks">Letters to the Editor</a></li>

                <li><a id="search"><i class="fa fa-search"></i><input></a></li>
              </ul>
            </div><!--/.navbar-collapse -->
          </div>
        </div>
      </div>
          <div class="row" style = "padding-bottom: 10px;">
        <div class="col-md-2 date"></div>
        <div class="col-md-9">
          <div class="navbar navbar-second" role="navigation">
              <div class="container">
                <div class="navbar-collapse">
                <ul class="nav navbar-nav" style = "margin-left: -70px">
                    <li><a href="/about-the-argus">About</a></li>
                    <li><a href="/staff">Staff</a></li>
                    <li><a href="/donate">Donate</a></li>
                    <li><a href="/submit-a-wespeak">Submit a Letter</a></li>
                    <li><a href="/submit-a-tip">Submit a tip</a></li>
                    <li><a href="/wesceleb-nomination">Nominate a WesCeleb</a></li>
                  </ul>
                </div><!--/.navbar-collapse -->
              </div>
          </div>
        </div>
        <div class="social-icons">
<a href="http://www.instagram.com/wesleyan.argus" target="_blank"><i class="fa fa-instagram"> </i></a>
          <a href="http://www.facebook.com/wesleyanargus" target="_blank"><i class="fa fa-facebook"></i></a>
          <a href="http://twitter.com/wesleyanargus" target="_blank"><i class="fa fa-twitter"></i></a>
        </div>
      </div>
