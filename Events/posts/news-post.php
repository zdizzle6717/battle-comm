<script type="text/javascript">
    $(document).ready(function () {

        $(window).scrollTop(0);
        return false;

    });
</script>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10">
      <!--Body content-->

      <div ng-repeat="x in news" class="no_bullets no_padding" id="news_controller">
      <div class="full_width">
      	<h1>{{x.Title}}</h1>
      </div>
        <li id="news_summary">
          <h3>Author: {{x.Author}}</h3>
          <div class="fill">
            <p class="four_column_1"><strong>Category:</strong> {{x.Category}}</p>
            <p class="four_column_1"><strong>Game:</strong> {{x.GameSystem}}</p>
          </div>
          <p class="full_width">Posted: {{x.Posted}}</p>
          <a href="{{x.ImageUrl}}" class="four_column_1"><img ng-src="{{x.ImageUrl}}" class="shadow"></a>
          <p class="four_column_3">{{x.Body}}</p>
          <div class="four_column_3">
            <p class="full_width"><strong>Tags:</strong> {{x.Tags}}</p>
          </div>
        </li>
      </div>

    </div>
  </div>
</div>