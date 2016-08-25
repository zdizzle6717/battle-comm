<div>
    <div class="full_width">
        <hr>
    </div>
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
        <select ng-model="pageSize" type="number" min="1" max="100" class="form-control">
            <option value="1">1 Per Page</option>
            <option value="10">10 Per Page</option>
            <option value="20">20 Per Page</option>
            <option value="50">50 Per Page</option>
            <option value="100">100 Per Page</option>
        </select>
    </div>
    <div class="full_width">
        <hr>
    </div>
    <div class="other-controller">
        <div class="center">
            <dir-pagination-controls boundary-links="true"></dir-pagination-controls>
        </div>
    </div>
    <div class="full_width">
        <hr>
    </div>
    <ul class="no_bullets no_padding" id="news_controller">
        <div dir-paginate="post in News.allPosts | filter:query | orderBy:orderProp | itemsPerPage: pageSize" class="news-listing">
            <li id="news_summary">
                <div class="two_column_1 no_padding"><a ui-sref="posts({ id: post.id })"><h5><u>{{post.title}}</u></h5></a></div>
                <div class="fill">
                    <div class="four_column_1"><strong>Author:</strong> {{post.author}}</div>
                    <div class="four_column_1"><strong>Category:</strong> {{post.category}}</div>
                    <div class="four_column_1"><strong>Date:</strong> {{post.createdAt}}</div>
                </div>
                <p class="full_width no_padding">
                    <a ui-sref="posts({ id: post.id })" class="four_column_1" style="padding-top:3px;"><img ng-src="/uploads/news/{{post.image}}" class="shadow" width="100%"></a>
                    {{post.callout}}
                </p>
                <div class="four_column_3"><strong>Tags:</strong> {{post.Tags}}</div>
                <div class="fill right">
                    <a ui-sref="posts({ id: post.id })">
                        <button type="button" class="button-link-reverse">Read More</button>
                    </a>
                </div>
            </li>
            <div class="full_width">
                <hr>
            </div>
        </div>
    </ul>
</div>

<div class="full_width right">
    <dir-pagination-controls boundary-links="true"></dir-pagination-controls>
</div>
