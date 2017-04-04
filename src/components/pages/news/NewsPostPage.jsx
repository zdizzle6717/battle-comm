'use strict';

import React from 'react';
import {Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import NewsPostService from '../../../services/NewsPostService';
import {formatJSONDate} from '../../../library/utilities';

export default class NewsPostPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'post': {}
		}
    }

    componentDidMount() {
        document.title = "Battle-Comm | News Post";
		NewsPostService.get(this.props.postId).then((post) => {
			this.setState({
				'post': post
			})
		})
    }

    render() {
        return (
            <ViewWrapper>
                <div className="row">
					<div className="small-12 columns">
						<h1>News Post</h1>
						<hr />
					</div>
                </div>
				<div className="row">
					<div className="small-12 columns">
						<div className="news-posts">
							<h3>{post.title}</h3>
							<h4>Author: {post.User.username} | {formatJSONDate(post.updated_at)}</h4>
							<div className="summary">
								<img src="/uploads/news/missing.jpg" />
								{post.summary}
							</div>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}
