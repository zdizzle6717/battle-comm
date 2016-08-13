<div ng-controller="NewsListCtrl" class="">
    <div class="full_width"><hr></div>
    <div class="two_column_1">
        <h3>Search: </h3>
        <input ng-model="query" id="search" placeholder="Enter a search filter...">
    </div>
    <div class="four_column_1">
        <h3>Sort Search By:</h3>
        <select ng-model="orderProp">
          <option value="Posted">Newest</option>
          <option value="Title">Title</option>
          <option value="Author">Author</option>
          <option value="GameSystem">Game System</option>
          <option value="Category">News Category</option>
        </select>
    </div>
    <div class="four_column_1">
        <h3>Display:</h3>
        <select ng-model="pageSize" type="number" min="1" max="100" class="form-control" >
          <option value="1">1 Per Page</option>
          <option value="10">10 Per Page</option>
          <option value="20">20 Per Page</option>
          <option value="50">50 Per Page</option>
          <option value="100">100 Per Page</option>
        </select>
    </div>
    <div class="full_width"><hr></div>
    <div ng-controller="PageController" class="other-controller">
      <div class="center">
      <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="includes/dirPagnation.tpl.html"></dir-pagination-controls>
      </div>
    </div>
    <div class="full_width"><hr></div>
    <ul class="no_bullets no_padding" id="news_controller">
        <div dir-paginate="x in news | filter:query | orderBy:orderProp | itemsPerPage: pageSize" current-page="currentPage" class="news-listing">
        <li id="news_summary">
          <div class="two_column_1 no_padding"><a href="#/posts/[[x.ID]]"><h5><u>[[x.Title]]</u></h5></a></div>
          <div class="fill">
            <div class="four_column_1"><strong>Author:</strong> [[x.Author]]</div>
            <div class="four_column_1"><strong>Game:</strong> [[x.GameSystem]]</div>
            <div class="four_column_1"><strong>Category:</strong> [[x.Category]]</div>
            <div class="four_column_1"><strong>Date:</strong> [[x.Posted]]</div>
          </div>
          <p class="full_width no_padding">
          <a href="#/posts/[[x.ID]]" class="four_column_1" style="padding-top:3px;"><img ng-src="[[x.ImageUrl]]" class="shadow" width="100%"></a>
          [[x.Summary]]
          </p>
          <div class="four_column_3"><strong>Tags:</strong> [[x.Tags]]</div>
          <div class="fill right" >
            <a href="#/posts/[[x.ID]]" ><button type="button" class="button-link-reverse" >Read More</button></a>
          </div>
        </li>
          <div class="full_width"><hr></div>
        </div>
    </ul>
</div>

<div id="totop" ng-controller="PageController" class="other-controller">
  <div class="full_width"><hr></div>
  <div class="center">
  <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="includes/dirPagnation.tpl.html"></dir-pagination-controls>
  </div>
  <div class="full_width"><hr></div>
</div>