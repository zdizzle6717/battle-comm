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
            <ViewWrapper>
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
								<div className="news-posts">
									<h3>{post.title}</h3>
									<h4>Author: {post.User.username} | {formatJSONDate(post.updated_at)}</h4>
									<div className="summary">
										<img src="/uploads/news/missing.jpg" />
										{post.summary} <Link to={`/news/post/${post.id}`}>...</Link>
									</div>
									<Link to={`/news/post/${post.id}`}>Read More</Link>
								</div>
							)
						}
					</div>
				</div>
            </ViewWrapper>
        );
    }
}
