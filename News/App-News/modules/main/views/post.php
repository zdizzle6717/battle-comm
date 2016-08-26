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
                        <!-- <div class="four_column_1"><strong>Game:</strong> {{News.post.gameSystem}}</div> -->
                        <div class="four_column_1"><strong>Category:</strong> {{News.post.category}}</div>
                        <div class="four_column_1"><strong>Date:</strong> {{News.post.createdAt | jsonDate | date: 'medium'}}</div>
                    </div>
                    <p class="full_width no_padding">
                        <a class="three_column_1" style="padding-top:0;margin-top:0;"><img ng-src="/uploads/news/{{News.post.image}}" class="shadow" width="100%"></a>
                        {{News.post.body}}
                    </p>
                    <div class="full_width"><strong>Tags:</strong> {{News.post.tags}}</div>
            </div>
            <div class="fill right">
                <h3><a href="/News">Back to News</a></h3>
            </div>
            </li>
        </div>

    </div>
</div>
</div>
