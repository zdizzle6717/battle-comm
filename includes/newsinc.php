<style type="text/css">
.newsWrapper {
	height: auto;
	width: 100%;
	margin-right: auto;
	margin-left: auto;
	padding-top: 15px;
	padding-right: 10px;
	padding-left: 10px;
}
</style>

<script type="text/javascript">
  /* dmxDataSet name "news" */
       jQuery.dmxDataSet(
         {"id": "news", "url": "../dmxDatabaseSources/news.php", "data": {"sort": "news_date_published", "dir": "desc", "limit": "3"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "news" */
</script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<div class="newsWrapper" id="newsWrapper">
  <div data-binding-id="repeat1" data-binding-repeat="{{news.data}}"><img src="../News/Uploads/news/chess.jpg" alt="" width="120" height="81" align="top"/><strong>{{news_title}}</strong> -{{news_date_published.formatDate( "mm/dd/yy" )}}-{{news_callout.trunc( 40, true, "…" )}} -<a href="#">Read More...</a>-</div>
</div>