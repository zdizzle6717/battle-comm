<div ng-app="formExample" ng-controller="NewsController" >
  <form name="form" ng-submit="form.$valid && submitData(news, 'ajaxSubmitResult')" id="css-form" novalidate>
	<div class="fill">
		<div class="four_column_1 left">
			<label class="float_left">*Author (Your Name):</label>
			<input type="text" name="news_author" ng-model="news.news_author" required />
			<br />
			<div ng-show="form.$submitted || form.news_author.$touched" >
			  <div ng-show="form.news_author.$error.required" class="note">*This is a required field.</div>
			</div>
		</div>
	</div>
	
	<div class="form_row full_width left">
        <label class="float_left">*Title:</label>
        <input type="text" name="news_title" ng-model="news.news_title" required />
		<br />
		<div ng-show="form.$submitted || form.news_title.$touched" >
		  <div ng-show="form.news_title.$error.required" class="note">*This is a required field.</div>
		</div>
    </div>
	
	<!-- Automatically sets the current date for submission date. -->
	<div class="form_row left float_left">
        <input type="hidden" name="news_date_submitted" ng-model="news.news_date_submitted" />
    </div>
	
    <div class="fill">
		<div class="four_column_1 left">
			<label class="float_left">Game System:</label>
			<select name="game_system" ng-model="news.game_system">
				<option value="N/A">Select...</option>
				<option value="Chess">Chess</option>
				<option value="Magic The Gathering">Magic The Gathering</option>
				<option value="Warhammer">Warhammer</option>
			</select>
		</div>
		<div class="four_column_1 left">
			<label class="float_left">News Category:</label>
			<select name="parent" ng-model="news.parent">
				<option value="Miscellaneous">Select...</option>
				<option value="Announcement">Announcement</option>
				<option value="New Products">New Products</option>
				<option value="Tournament">Tournament</option>
				<option value="Upcoming Events">Upcoming Events</option>
			</select>
            <br />
		</div>
    </div>
	
	<div class="form_row full_width left">
		<label class="float_left">*News Callout (Teaser/Summary):</label>
		<textarea name="news_callout" ng-model="news.news_callout" type="text" required></textarea>
        <br/>
        <div ng-show="form.$submitted || form.news_callout.$touched" >
          <div ng-show="form.news_callout.$error.required" class="note">*This is a required field.</div>
        </div>
	</div>

    <div class="form_row full_width left">
        <label class="float_left">*Article:</label>
        <br/>
        <textarea name="news_body" ng-model="news.news_body" placeholder="Start typing news here..." class="news_article"></textarea>
    	<script>
			// Replace the <textarea id="editor1"> with a CKEditor
			// instance, using default configuration.
			CKEDITOR.replace( 'news_body' );
		</script>
        <div ng-show="form.$submitted || form.news_body.$touched" >
          <div ng-show="form.news_body.$error.required" class="note">*This is a required field.</div>
        </div>
    </div>

    <div class="form_row full_width left">
        <label class="float_left">Tags:</label>
        <textarea name="tags" ng-model="news.tags"></textarea>
    </div>

    <div class="fill">
		<div class="four_column_1 left">
			<label class="float_left">* Publish now?</label>
			<select name="publish" ng-model="news.publish" 
            ng-options="c.code as c.name for c in options"
            required>
				<option value="">Select...</option>
			</select>
            <div ng-show="form.$submitted || form.publish.$touched" >
              <div ng-show="form.publish.$error.required" class="note">*Publish now?</div>
            </div>
		</div>
	</div>
	
	<div class="full_width" >
		<div class="center">
			<input type="submit" ng-disabled="newsForm.$invalid" value="Submit News">
		</div>
	</div>
    <br class="clear" /> 
	
  </form>
  <br />
    {{ajaxSubmitResult | json}}
  <br />
</div>

