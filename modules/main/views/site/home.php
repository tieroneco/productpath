<div class="get-idea">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<h1>Get product ideas direct from your users</h1>
                    <p>Our lightweight feature request platform is perfect for early stage and growing<br> startups. Simple, lightweight and extremely powerful.</p>
                    <?php $form = yii\widgets\ActiveForm::begin([
                        'id'=>'create-site-header',
                        'method'=>'get',
                        'action'=>'/site/register'
                    ])?> 
                        <div class="ghost-text-wrap create-site-wrap">
                    	   <input class="top-create-site" type="text" value="" name="site" placeholder="yourproduct.hirewpexpert.com">
                        </div>
                        <input type="submit" value="Create Site" class="btn custom-btn creat-btn">
                    <?php yii\widgets\ActiveForm::end()?>
                    <div class="screen-short"><img src="images/screen-short.png"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="features">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
                	<div class="features-left">
                        <p>Make FeatureTrack look like your brand by adding logos and changing colours</p> 
                        <a class="btn small-btn">Sign Up</a>                
                    </div>
                </div>
                <div class="col-lg-7 col-md-8 col-sm-8 col-xs-12">
                    <div class="features-list">
                    	<ul class="clearfix">
                        	<li><a href="#">Submit Features</a></li>
                        	<li><a href="#">User Comments</a></li>
                        	<li><a href="#">Action or Reject Ideas</a></li>
                        	<li><a href="#">Idea Voting</a></li>
                        	<li><a href="#">Shareable Pages</a></li>
                        	<li><a href="#">Your own logo</a></li>
                        	<li><a href="#">Reply to Ideas</a></li>
                        	<li><a href="#">Customizable colors</a></li>
                        	<li><a href="#">Free while in beta</a></li>
                        </ul>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
    <div class="body-content">
    	<div class="container">
        	<div class="row main-content">
            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                	<div class="vote-box">
                        <div class="vote-count"><em class="vote">284</em>votes</div>
                         <div class="like"><a href="#">I need this! <i class="fa fa-thumbs-o-up"></i></a></div>           
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                	<div class="content-box">
                    	<h2>GET FEATURE REQUESTS FROM YOUR USERS</h2>
                        <p>FeatureTrack is a hosted feature request site that enables you to gain feedback from your users. Signing in to add an idea is as simple as adding their email which limits the walls users need to jump through to submit content. Ideas are voted on with the best content rising to the top.</p>                
                    </div>
                </div>
            </div>
        	<div class="row main-content">
            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">
                	<div class="vote-picbox pull-right"><a href="#"><img src="images/client-logo.png"></a></div> 
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                	<div class="content-box">
                    	<h2>CUSTOMIZE THE LOOK OF YOUR SITE</h2>
                        <p>Start by securing your own subdomain and then continue into the admin area to customize your site. Add a logo to the header, change colours and make our product feel like your own. We will be adding new ways to customize FeatureTrack in the coming months.</p>                
                    </div>
                </div>
            </div>
        	<div class="row main-content">
            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                	<div class="vote-picbox"><img src="images/text-pic.png"> </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                	<div class="content-box">
                    	<h2>DIRECTLY REPLY TO IDEAS</h2>
                        <p>When you get feature requests and ideas that stand out you can post a status update on the item. These are designed to stand out from the regular comments and give your users your thoughts on their ideas. Users who gave opted in can receieve updates via email.</p>                
                    </div>
                </div>
            </div>
        </div>
    </div>

     </div>
    </div>

    <div id="footer-wrap">
    <div class="footer">
    	<div class="container">
        	<div class="row get-idea home-serch">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<?php $form = yii\widgets\ActiveForm::begin([
                        'id'=>'create-site-footer',
                        'method'=>'get',
                        'action'=>'/site/register'
                        ])?> 
                       <div class="ghost-text-wrap create-site-wrap bottom-create-site-wrap"> 
                    	<input class="bottom-create-site" type="text" value="" name="site" placeholder="yourproduct.hirewpexpert.com">
                        </div>
                        <input type="submit" value="Create Site" class="btn custom-btn creat-btn">
                        <?php yii\widgets\ActiveForm::end()?>
                </div>
            </div>
        </div>
    </div>