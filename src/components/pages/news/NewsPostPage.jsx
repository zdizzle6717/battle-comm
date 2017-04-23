'use strict';

import React from 'react';
import {browserHistory, Link} from 'react-router';
import ViewWrapper from '../../ViewWrapper';
import NewsPostService from '../../../services/NewsPostService';
import {formatJSONDate} from '../../../library/utilities';

export default class NewsPostPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'post': {
				'User': {},
				'Files': []
			}
		}
    }

    componentDidMount() {
        document.title = "Battle-Comm | News Post";
		NewsPostService.get(this.props.params.postId).then((post) => {
			if (!post.published) {
				browserHistory.push('/news');
			} else {
				this.setState({
					'post': post
				});
			}
		})
    }

    render() {
		let post = this.state.post;
        return (
            <ViewWrapper headerImage="/images/Titles/News.png" alt="News">
				<div className="row">
					<div className="small-12 columns">
						<div className="news-post">
							<div className="row">
								<div className="small-6 medium-3 columns"><strong>Author:</strong> {post.User.firstName} {post.User.lastName}</div>
								<div className="small-6 medium-3 columns"><strong>Date:</strong> {formatJSONDate(post.updatedAt)}</div>
								<div className="small-6 medium-3 columns"><strong>Category:</strong> {post.category}</div>
							</div>
							<div className="summary push-top">
								{
									post.Files.length > 0 &&
									<img src={`/uploads/${post.Files[0].locationUrl}${post.Files[0].name}`} />
								}
								{post.body}
							</div>
							<div className="row push-top">
								<div className="small-12 columns text-center"><strong>Tags:</strong> {post.tags}</div>
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
