<?php //$this->load->library('session'); 
$user_session_info = $this->session->userdata('LOGGEDIN_USER'); 
//print_r($user_session_info);
//print_r($this->session->userdata('Language_code'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?php echo base_url()?>" />
<title>::: Booking and You :::</title>
<link  type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
<link type="text/css" rel="stylesheet" href="css/flags.css" />
<link type="text/css" rel="stylesheet" href="css/dd.css" />
<link type="text/css" rel="stylesheet" href="css/datePicker.css" />
<link type="text/css" rel="stylesheet" href="css/jquery.lightbox-0.5.css" />
<link type="text/css" rel="stylesheet" href="css/tooltip/cute-balloon.css" />
<link type="text/css" rel="stylesheet" href="css/tooltip/gris/style.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/curvycorners.src.js"></script>
<script type="text/javascript" src="js/tooltip/cute-balloon.js"></script>
<script type="text/javascript" src="js/tooltip/imagetip.js"></script>
<script type="text/javascript" src="js/jquery.dd.min.js"></script>
<script type="text/javascript" src="js/jquery.datePicker.js"></script>
<script type="text/javascript" src="js/date.js"></script>
<script src="js/ModalDialog.js" type="text/javascript"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDp_9pguk_1_31cbpzq-9Md3iTtPatUKxw&sensor=false"></script>
<script type="text/javascript">
function googleMap(lat, lan, rZoom){ 
    var map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: rZoom,
        center: new google.maps.LatLng(lat, lan),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var marker;
        marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lan),
        map: map
    });    
}
function googleMapBig(lat, lan, rZoom){ 
    var map = new google.maps.Map(document.getElementById('map_canvas_big'), {
        zoom: rZoom,
        center: new google.maps.LatLng(lat, lan),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var marker;
        marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lan),
        map: map
    });        
}
var dialog = null;
function show_dialog (id)
{
    if(!dialog) dialog = null;
    dialog = new ModalDialog ("#"+id);
    dialog.show();
}
function hide_dialog ()
{
    dialog.hide();
    if(!dialog) dialog = null;
}
$(document).ready(function() {
$("#my_account_link").click(function() {
    show_dialog ("sign_in_box");                
    return false;    
});
});
function selected_language(id){
$.post("<?=base_url()?>home/change_current_language/" + id, function(data){
        document.location.reload(true);
});    
}
function selected_currency(id){
$.post("<?=base_url()?>home/change_current_currency/"+id, function(data){
        document.location.reload(true);
});        
}
$(document).ready(function(e) {        
    //no use
    try {
        var pages = $("#pages").msDropdown({on:{change:function(data, ui) {
                                                var val = data.value;
                                                if(val!="")
                                                    window.location = val;
                                            }}}).data("dd");

        var pagename = document.location.pathname.toString();
        pagename = pagename.split("/");
        pages.setIndexByValue(pagename[pagename.length-1]);
        $("#ver").html(msBeautify.version.msDropdown);
    } catch(e) {
        //console.log(e);    
    }
    
    $("#ver").html(msBeautify.version.msDropdown);
        
    //convert
    $("#currency").msDropdown();
    $("#countries").msDropdown();
    $("#tech").data("dd");
});
function showValue(heart) {
    console.log(h.name, h.value);
}
$("#tech").change(function() {
    console.log("by jquery: ", this.value);
})
</script>
</head>
<body onload="initialize()">

    <div id="wrap">       
     <!--HEADER SECTION START-->
         <div id="header">
              <div class="left_section"><a href="<?php echo base_url()?>"><img src="images/logo.png" alt="logo" /></a></div>
               <div class="right_section">
           
                    <div class="dropdown" style="width:auto;">
                    <select name="countries" id="countries" style="width:auto;" onchange="selected_language(this.value);">
                    <?php echo language_dropdown(); ?>
                    </select>                      
                    </div>
                    <div class="dropdown" style="width:auto;">
                    <select name="currency" id="currency" style="width:auto;" onchange="selected_currency(this.value);">
                    <?php echo currency_dropdown(); ?>
                    </select>                    
                    </div>
                        <div id="fb-root"></div>
                        <script src='http://connect.facebook.net/<?=$this->session->userdata('Language_code')?>/all.js'></script>
                        <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/<?=$this->session->userdata('Language_code')?>/all.js#xfbml=1&appId=482676085102933";
                        fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="clr"></div>
                    <!--<div class="facebook_like" style="padding-left:40px;"><div class="fb-like" data-send="false" data-width="450" data-show-faces="false"></div></div>-->
                    

                              <div class="shareTheFun">
                              <span style="line-height:24px; vertical-align:top; padding-right:5px;"><?php echo $LANG['Share the fun using']== NULL?'Share the fun using':$LANG['Share the fun using'] ;?></span>
                              <a onclick='postToFeed(); return false;' style="cursor:pointer;"> <img src="images/facebook_24.png" alt="" /></a>
                              <span style="cursor:pointer; margin-left:5px;"><a href="javascript:(function(){window.twttr=window.twttr||{};var D=550,A=450,C=screen.height,B=screen.width,H=Math.round((B/2)-(D/2)),G=0,F=document,E;if(C>A){G=Math.round((C/2)-(A/2))}window.twttr.shareWin=window.open('http://twitter.com/share','','left='+H+',top='+G+',width='+D+',height='+A+',personalbar=0,toolbar=0,scrollbars=1,resizable=1');E=F.createElement('script');E.src='http://platform.twitter.com/bookmarklets/share.js?v=1';F.getElementsByTagName('head')[0].appendChild(E)}());"><img src="images/twitter_24.png" alt="" /></a></span>                    
                              </div>
                    
               </div>
               <div class="clr"></div>
               <div class="navigation">
                   <div class="nav_left">
                        <ul>
                             <li><a href="<?php echo base_url();?>" <?php if ( $this->uri->uri_string() == '' ) echo 'class="select"'; ?> ><?php echo $LANG['Home']== NULL?'Home':$LANG['Home']?></a></li>
                              <li ><a href="<?php echo base_url();?>how_it_works" <?php if ( $this->uri->uri_string() == 'how_it_works' ) echo 'class="select"'; ?> ><?php echo $LANG['How It Works']== NULL?'How It Works':$LANG['How It Works']; ?></a></li>
                              <!--<li style="background:none;"><a href="<?php echo base_url();?>about_us"><?php echo $LANG['About Us']== NULL?'About Us':$LANG['About Us']; ?></a></li>-->
                              <!-- <li>
                              <span style="color: #FFFFFF;display: block;float: left;font-size: 14px;height: 45px;line-height: 40px;text-align: center;text-decoration: none;text-transform: uppercase;"><?php echo $LANG['Share the fun using']== NULL?'Share the fun using':$LANG['Share the fun using'] ;?></span>
                              <a onclick='postToFeed(); return false;'> <img src="images/facebook_icon.png" alt="" /></a>
                              <span><a href="javascript:(function(){window.twttr=window.twttr||{};var D=550,A=450,C=screen.height,B=screen.width,H=Math.round((B/2)-(D/2)),G=0,F=document,E;if(C>A){G=Math.round((C/2)-(A/2))}window.twttr.shareWin=window.open('http://twitter.com/share','','left='+H+',top='+G+',width='+D+',height='+A+',personalbar=0,toolbar=0,scrollbars=1,resizable=1');E=F.createElement('script');E.src='http://platform.twitter.com/bookmarklets/share.js?v=1';F.getElementsByTagName('head')[0].appendChild(E)}());"><img src="images/twitter_icon.png" alt="" /></a></span>                          
                              </li>-->

                         </ul>
                    </div>
				<script> 
                  FB.init({appId: "482676085102933", status: true, cookie: true});
                  function postToFeed() {
                    // calling the API ...
                    var obj = {
                      method: 'feed',
                      redirect_uri: 'http://www.satyajitlimited.com/booking_n_you/',
                      link: 'http://www.satyajitlimited.com/booking_n_you/',
                      picture: 'http://www.satyajitlimited.com/booking_n_you/images/logo.png',
                      name: 'BookingandYou',
                      caption: 'Online Hotel Reservation',
                      description: 'Online Hotel Reservation.'
                    };
            
                    function callback(response) {
                      document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
                    }
                    FB.ui(obj, callback);
                  }
   			 </script>
<?php if(!empty($user_session_info)){?>

                   <div class="nav_right"><?php echo $LANG['Welcome']== NULL?'Welcome':$LANG['Welcome'] ;  echo "  ".$user_session_info['user_first_name']." ".$user_session_info['user_last_name'];?>! |  <a href="<?php echo base_url().'user/my_account_home/';?>"><?php echo $LANG['My Account']== NULL?'My Account':$LANG['My Account'] ;?></a> | <a href="<?php echo base_url().'user/sign_out/';?>"><?php echo $LANG['Sign Out']== NULL?'Sign Out':$LANG['Sign Out'] ;?></a></div>
               </div>

<?php } else {?>

                   <div class="nav_right"><?php echo $LANG['Welcome Guest']== NULL?'Welcome Guest':$LANG['Welcome Guest'] ;?>! <a href="javascript:void(0);" onclick="show_dialog('sign_in_box')" style="font-size: 14px; text-decoration:underline;"><?php echo $LANG['Sign in']== NULL?'Sign in':$LANG['Sign in'] ;?></a>&nbsp;<?php echo $LANG['or']== NULL?'or':$LANG['or'] ;?> <a href="javascript:void(0);" onclick="show_dialog('sign_up_box')" style="font-size: 14px; text-decoration:underline;"><?php echo $LANG['Sign up']== NULL?'Sign up':$LANG['Sign up'] ;?></a> <?php echo $LANG['for faster booking']== NULL?'for faster booking':$LANG['for faster booking'] ;?>  |  <a href="<?php echo base_url().'user/my_account_home/';?>" id="my_account_link" style="text-decoration:underline;"><?php echo $LANG['My Account']== NULL?'My Account':$LANG['My Account'] ;?></a></div>
               </div>
<?php } ?>               
               <div class="clr"></div>
          </div>
     <!--HEADER SECTION END-->