<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
            <!--Body content-->

            <div class="no_bullets no_padding">
                <li id="news_summary">
                    <div class="two_column_1 no_padding">
                        <h1>{{News.post.title}}</h1></div>
                    <div class="fill">
                        <div class="four_column_1"><strong>Author:</strong> {{News.post.author}}</div>
                        <div class="four_column_1"><strong>Game:</strong> {{News.post.gameSystem}}</div>
                        <div class="four_column_1"><strong>Category:</strong> {{News.post.category}}</div>
                        <div class="four_column_1"><strong>Date:</strong> {{News.post.posted}}</div>
                    </div>
                    <p class="full_width no_padding">
                        <a ng-href="/uploads/news/{{News.post.image}}"><img ng-src="/uploads/news/{{News.post.image}}" class="shadow" width="100%"></a>
                        {{post.callout}}
                    </p>
            </div>
            <div class="four_column_3"><strong>Tags:</strong> {{News.post.tags}}</div>
            <div class="fill right">
                <h3><a href="/News">Back to News</a></h3>
            </div>
            </li>
        </div>

    </div>
</div>
</div>
