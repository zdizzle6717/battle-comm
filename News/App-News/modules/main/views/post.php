<div class="container-fluid">
  <div class="row">
    <div class="col-md-10">
      <!--Body content-->

      <div ng-repeat="field in post" class="no_bullets no_padding" id="news_controller">
        <li id="news_summary">
          <div class="two_column_1 no_padding"><h1>{{field.Title}}</h1></div>
          <div class="fill">
            <div class="four_column_1"><strong>Author:</strong> {{field.Author}}</div>
            <div class="four_column_1"><strong>Game:</strong> {{field.GameSystem}}</div>
            <div class="four_column_1"><strong>Category:</strong> {{field.Category}}</div>
            <div class="four_column_1"><strong>Date:</strong> {{field.Posted}}</div>
          </div>
          <div class="full_width no_padding">
          <a href="#/posts/{{field.ID}}" class="four_column_1" style="padding-top:3px;"><img ng-src="{{field.ImageUrl}}" class="shadow" width="100%"></a>
          <div ng-bind-html="getHtml(field.Body)"> </div>
          </div>
          <div class="four_column_3"><strong>Tags:</strong> {{field.Tags}}</div>
          <div class="fill right" >
            <h3><a href="/News">Back to News</a></h3>
          </div>
        </li>
      </div>

    </div>
  </div>
</div>
