<?php include 'Templates/parts/head.php'; ?>
    <?php include 'Templates/parts/header.php'; ?>
        <?php include 'Templates/parts/container-top.php'; ?>
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "flgsDetails" */
       jQuery.dmxDataSet(
         {"id": "flgsDetails", "url": "dmxDatabaseSources/flgs_details.php", "data": {"locga": "{{$URL.locga}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "flgsDetails" */
</script>
			<h2>{{flgsDetails.data[0].venue_Name}}</h2>
            <p><div style="width:49%; float:left;">{{flgsDetails.data[0].venue_Street_Address}} <br>
              {{flgsDetails.data[0].venue_city}}{{flgsDetails.data[0].venue_state}}, {{flgsDetails.data[0].venue_zip_cc_code}}
<p> Phone: {{flgsDetails.data[0].venue_phone}}<br>
Fax: {{flgsDetails.data[0].venue_fax}}<br>
Email: <a href="mailto:{{flgsDetails.data[0].venue_email}}">{{flgsDetails.data[0].venue_email}}</a><br>
Contact: {{flgsDetails.data[0].venue_contact_name}}</p>
<p><a href="{{flgsDetails.data[0].venue_website}}">{{flgsDetails.data[0].venue_website}}</a><br>

  <a href="{{flgsDetails.data[0].venue_facebook}}">{{flgsDetails.data[0].venue_facebook}}</a>
    </div>
    <div style="width:49%; float:right;">
    	 <img src="uploads/venue/{{flgsDetails.data[0].venue_logo_icon}}" width="302" height="74" alt=""/><br>
Hours: {{flgsDetails.data[0].venue_hours}}<br>

    </div>
   
    <div style="clear:both;"></div></p>
            
           <p>{{flgsDetails.data[0].venue_about}}</p>
            
		<?php include 'Templates/parts/container-bottom.php'; ?>
<?php include 'Templates/parts/footer.php'; ?>