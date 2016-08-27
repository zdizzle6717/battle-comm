<?php include 'Templates/parts/head.php'; ?>
<?php include 'Templates/parts/header.php'; ?>
  <?php include 'Templates/parts/container-top.php'; ?>
          <!-- DataSet Scripts --> 
          <script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script> 
          <script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script> 
          <script type="text/javascript">
              /* dmxDataSet name "FLGSList" */
                   jQuery.dmxDataSet(
                     {"id": "FLGSList", "url": "dmxDatabaseSources/FLGSList.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
                   );
              /* END dmxDataSet name "FLGSList" */
            </script>
          <h2>Game Stores &amp; Game Cafes'</h2>
          <ul style="list-style:none;">
          <div data-binding-id="repeat1" data-binding-repeat-children="{{FLGSList.data}}">
            <li><img src="uploads/venue/thumbs/{{venue_logo_icon}}" width="100" height="" alt=""/> <strong>{{venue_Name}}</strong> {{venue_city}} <a href="flgs-detail.php?locga={{venue_id}}">[View Details]</a></li>
          </div></ul>
<?php include 'Templates/parts/container-bottom.php'; ?>
  <?php include 'Templates/parts/footer.php'; ?>