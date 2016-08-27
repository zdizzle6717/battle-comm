<form action="../SiteAdmin/news-updated.php" id="news_edit_form" method="post">
    <div class="fill"><div class="four_column_1 left">
        <label class="float_left">* Your Name (Author):</label>
        <input type="text" name="news_author" />
    </div></div>
    <div class="form_row left">
        <label class="float_left">* Title:</label>
        <input type="text" name="news_title" />
    </div>
    <div class="form_row left float_left">
        <input type="hidden" name="news_date_submitted" />
    </div>
    <div class="fill"><div class="four_column_1 left">
        <label class="float_left">* Game System:</label>
        <select name="game_system">
            <option value="">Select...</option>
            <option value="Chess">Chess</option>
            <option value="Magic The Gathering">Magic The Gathering</option>
            <option value="Warhammer">Warhammer</option>
        </select>
    </div>
    <div class="four_column_1 left">
        <label class="float_left">* News Category:</label>
        <select name="parent">
            <option value="">Select...</option>
            <option value="Announcement">Announcement</option>
            <option value="New Products">New Products</option>
            <option value="Tournament">Tournament</option>
            <option value="Upcoming Events">Upcoming Events</option>
        </select>
    </div>
    <div class="four_column_1 left">
        <label class="float_left">* News Callout:</label>
        <input type="text" name="news_callout" />
    </div></div>
    <div class="form_row left">
        <label class="float_left">* Article:</label>
        <textarea placeholder="Start typing news here..." name="news_body" class="news_article"></textarea>
    </div>
    <div class="form_row left">
        <label class="float_left">* Tags:</label>
        <textarea name="tags"></textarea>
    </div>
    <div class="fill"><div class="four_column_1 left">
        <label class="float_left">* Publish now?</label>
        <select name="publish">
            <option value="">Select...</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div></div>
    <div class="center">
    	<input type="submit">
    </div>
    <br class="clear" /> 
</form>