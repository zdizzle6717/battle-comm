'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import NewsPostService from '../../../services/NewsPostService';
import {formatJSONDate} from '../../../library/utilities';

export default class NewsPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'newsPosts': []
		}
    }

    componentDidMount() {
        document.title = "Battle-Comm | News";
		NewsPostService.getAll().then((newsPosts) => {
			this.setState({
				'newsPosts': newsPosts
			})
		});
    }

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/News.png" alt="News">
                <div className="row">
					<div className="small-12 columns">
						<h1>News</h1>
						<hr />
					</div>
                </div>
				<div className="row">
					<div className="small-12 columns">
						{
							this.state.newsPosts.map((post, i) =>
								<div key={i} className="news-post">
									<h3><Link to={`/news/post/${post.id}`} className="underline">{post.title}</Link></h3>
									<div className="row">
										<div className="small-6 medium-3 columns"><strong>Author:</strong> {post.User.firstName} {post.User.lastName}</div>
										<div className="small-6 medium-3 columns"><strong>Date:</strong> {formatJSONDate(post.updated_at)}</div>
										<div className="small-6 medium-3 columns"><strong>Category:</strong> {post.category}</div>
									</div>
									<div className="summary push-top">
										<img src="/uploads/news/missing.jpg" />
										{post.callout} <Link to={`/news/post/${post.id}`}>...</Link>
									</div>
									<div className="row push-top">
										<div className="small-12 columns"><strong>Tags:</strong> {post.tags}</div>
									</div>
									<div className="row">
										<div className="small-12 columns text-right">
											<Link to={`/news/post/${post.id}`} className="button small white right collapse">Read More</Link>
										</div>
									</div>
								</div>
							)
						}
					</div>
				</div>
            </ViewWrapper>
        );
    }
}
