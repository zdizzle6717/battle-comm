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
			'post': {
				'User': {}
			}
		}
    }

    componentDidMount() {
        document.title = "Battle-Comm | News Post";
		NewsPostService.get(this.props.params.postId).then((post) => {
			this.setState({
				'post': post
			})
		})
    }

    render() {
		let post = this.state.post;
        return (
            <ViewWrapper>
                <div className="row">
					<div className="small-12 columns">
						<h1>{post.title}</h1>
						<hr />
					</div>
                </div>
				<div className="row">
					<div className="small-12 columns">
						<div className="news-post">
							<div className="row">
								<div className="small-6 medium-3 columns"><strong>Author:</strong> {post.User.firstName} {post.User.lastName}</div>
								<div className="small-6 medium-3 columns"><strong>Date:</strong> {formatJSONDate(post.updated_at)}</div>
								<div className="small-6 medium-3 columns"><strong>Category:</strong> {post.category}</div>
							</div>
							<div className="summary push-top">
								<img src="/uploads/news/missing.jpg" />
								{post.body}
							</div>
							<div className="row push-top">
								<div className="small-12 columns"><strong>Tags:</strong> {post.tags}</div>
							</div>
							<div className="row">
								<div className="small-12 columns text-right">
									<Link to={`/news`} className="button small medium white right collapse">Back to News List</Link>
								</div>
							</div>
						</div>
					</div>
				</div>
            </ViewWrapper>
        );
    }
}
