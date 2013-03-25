 <!--CONTENT SECTION START-->
     	<div id="content">
        	<div class="page_nav">
               	<p><?php echo $LANG['You are here']== NULL?'You are here':$LANG['You are here'] ;?>:&nbsp;&nbsp;<a href="<?php echo base_url();?>"><?php echo $LANG['Home']== NULL?'Home':$LANG['Home'] ;?></a></p>
               </div>
               <div class="clr"></div>
 		<div class="how_it_works">
               <h2><?php echo ucfirst($LANG['destinations'])== NULL?'destinations':ucfirst($LANG['destinations']) ;?>:&nbsp;&nbsp;</h2>
               <p class="top_margin"> </p>
                  <div style="font-size:0; height:0; line-height:0; clear:both;"></div>
                  <div class="clr"></div>
            <div>
  			  <div>
            <h4 style="color:#057DD7;">Europe</h4>
            <div class="clr"></div>
            <div>
			<?php 
              $continent = 6022967;
			  $s_where  = " WHERE n.continent_id = ".$continent;
			  $this->load->model('CountryList_model');
			  $all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where);
              if(count($all_country_lists_by_continent) > 0) { 
              ?>
              <div class="country_box">
                
                <?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") {
                ?>
                    <span style=" font-size:13px; font-weight:bold; color: #0896FF;"><a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'.str_replace(" ","-",mb_strtolower($Country_From_Hotel['country_name'], 'UTF-8'));?>"><?php echo $Country_From_Hotel['country_name'];?></a> |</span>
                <?php 
                 } } 
                ?>        
              </div>
              <?php } ?>
            </div>
        	<div style="font-size:0; height:0; line-height:0; clear:both;"></div>
            <h4 style="color:#057DD7;">North America</h4>
            <div class="clr"></div>
            <div>
                 <?php 
				  $continent = 500001;
				  $s_where  = " WHERE n.continent_id = ".$continent;
			 	  $this->load->model('CountryList_model');
			  	  $all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where);
				  if(count($all_country_lists_by_continent) > 0) { 
					  $tr = 0;
					  $td = 0;
					  $i = 0;
					  
				  ?>
				  <div class="country_box">
					
					<?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") {
					?>
						<span style=" font-size:13px; font-weight:bold; color: #0896FF;"><a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'.str_replace(" ","-",mb_strtolower($Country_From_Hotel['country_name'], 'UTF-8'));?>"><?php echo $Country_From_Hotel['country_name'];?></a> |</span>
					<?php 
					 } } 
					?>        
				  </div>
				  <?php } ?>
            </div>
         <div style="font-size:0; height:0; line-height:0; clear:both;"></div>
           <h4 style="color:#057DD7;">South America</h4>
           <div class="clr"></div>
            <div>
                 <?php 
				  $continent = 6023117;
				  $s_where  = " WHERE n.continent_id = ".$continent;
				  $this->load->model('CountryList_model');
				  $all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where);
				  if(count($all_country_lists_by_continent) > 0) { 
					  $tr = 0;
					  $td = 0;
					  $i = 0;
					  
				  ?>
				  <div class="country_box">
					
					<?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") {
					?>
						<span style=" font-size:13px; font-weight:bold; color: #0896FF;"><a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'. str_replace(" ","-",mb_strtolower($Country_From_Hotel['country_name'], 'UTF-8'));?>"><?php echo $Country_From_Hotel['country_name'];?></a> |</span>
					<?php 
					 } } 
					?>        
				  </div>
				  <?php } ?>
            </div>
        	<div style="font-size:0; height:0; line-height:0; clear:both;"></div>
            <h4 style="color:#057DD7;">Asia</h4>
            <div class="clr"></div>
            <div>
                <?php 
				  $continent = 6023099;
				  $s_where  = " WHERE n.continent_id = ".$continent;
				  $this->load->model('CountryList_model');
				  $all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where);
				  if(count($all_country_lists_by_continent) > 0) { 
					  $tr = 0;
					  $td = 0;
					  $i = 0;
					  
				  ?>
				  <div class="country_box">
					
					<?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") {
					?>
						<span style=" font-size:13px; font-weight:bold; color: #0896FF;"><a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'.str_replace(" ","-",mb_strtolower($Country_From_Hotel['country_name'], 'UTF-8'));?>"><?php echo $Country_From_Hotel['country_name'];?></a> |</span>
					<?php 
					 } } 
					?>        
				  </div>
				  <?php } ?> 
            </div>
        	<div style="font-size:0; height:0; line-height:0; clear:both;"></div>
            <h4 style="color:#057DD7;">Oceania</h4>
            <div class="clr"></div>
            <div>
                 <?php 
				  $continent = 6023180;
				  $s_where  = " WHERE n.continent_id = ".$continent;
				  $this->load->model('CountryList_model');
				  $all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where);
				  if(count($all_country_lists_by_continent) > 0) { 
					  $tr = 0;
					  $td = 0;
					  $i = 0;
					  
				  ?>
				  <div class="country_box">
					
					<?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") {
					?>
						<span style=" font-size:13px; font-weight:bold; color: #0896FF;"><a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'.str_replace(" ","-",mb_strtolower($Country_From_Hotel['country_name'], 'UTF-8'));?>"><?php echo $Country_From_Hotel['country_name'];?></a> |</span>
					<?php 
					 } } 
					?>        
				  </div>
				  <?php } ?>
            </div>
            <div style="font-size:0; height:0; line-height:0; clear:both;"></div>
            <h4 style="color:#057DD7;">Africa</h4>
            <div class="clr"></div>
            <div>
                
                <?php 
					  $continent = 6023185;
					  $s_where  = " WHERE n.continent_id = ".$continent;
					  $this->load->model('CountryList_model');
					  $all_country_lists_by_continent = $this->CountryList_model->fetch_multi($s_where);
					  if(count($all_country_lists_by_continent) > 0) { 
						  $tr = 0;
						  $td = 0;
						  $i = 0;
				?>
							  <div class="country_box">
                              	
								<?php foreach($all_country_lists_by_continent as $Country_From_Hotel) { if($Country_From_Hotel['country_name'] != "") {
								?>
                                   	<span style=" font-size:13px; font-weight:bold; color: #0896FF;"><a href="<?php echo base_url().'hotelsummaries/search_by_country/'.$Country_From_Hotel['country_code'].'/'.str_replace(" ","-",mb_strtolower($Country_From_Hotel['country_name'], 'UTF-8'));?>"><?php echo $Country_From_Hotel['country_name'];?></a> |</span>
                                <?php 
								 } } 
								?>        
                              </div>
							  <?php } ?>
                
           	 </div>
                </div>
            </div>
               </div>
               </div>
               
               
