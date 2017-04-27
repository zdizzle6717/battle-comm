'use strict';

import React from 'react';
import {Link} from 'react-router';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {PaginationControls} from '../../../library/pagination';
import {formatJSONDate} from '../../../library/utilities';
import NewsPostActions from '../../../actions/NewsPostActions';
import ViewWrapper from '../../ViewWrapper';


const mapStateToProps = (state) => {
	return {
		'posts': state.newsPosts
	}
}

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'searchNews': NewsPostActions.search
	}, dispatch);
}

class NewsPage extends React.Component {
    constructor() {
        super();

		this.state = {
			'pagination': {},
			'pageSize': 10,
			'orderBy': 'updatedAt',
			'searchQuery': ''
		}

		this.handlePageChange = this.handlePageChange.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | News";
		this.handlePageChange(1);
    }

	handlePageChange(pageNumber = 1) {
        this.props.searchNews({'pageNumber': pageNumber, 'searchQuery': this.state.searchQuery, 'orderBy': this.state.orderBy, 'pageSize': this.state.pageSize, 'published': true}).then((pagination) => {
			this.setState({
				'pagination': pagination
			});
        });
    }

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/News.png" alt="News">
				<div className="row">
					<div className="small-12 columns">
						{
							this.props.posts.map((post, i) =>
								<div key={post.id} className="news-post">
									<h3><Link to={`/news/post/${post.id}`} className="underline">{post.title}</Link></h3>
									<div className="row">
										<div className="small-6 medium-3 columns"><strong>Author:</strong> {post.User.firstName} {post.User.lastName}</div>
										<div className="small-6 medium-3 columns"><strong>Date:</strong> {formatJSONDate(post.updatedAt)}</div>
										<div className="small-6 medium-3 columns"><strong>Category:</strong> {post.category}</div>
									</div>
									<div className="summary push-top">
										<img src={`/uploads/${post.Files[0].locationUrl}${post.Files[0].name}`} />
										{post.callout} <Link to={`/news/post/${post.id}`}>...</Link>
									</div>
									<div className="row push-top text-center">
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
				<hr/>
				<div className="small-12 columns">
					<PaginationControls pageNumber={this.state.pagination.pageNumber} pageSize={this.state.pagination.pageSize} totalPages={this.state.pagination.totalPages} totalResults={this.state.pagination.totalResults} handlePageChange={this.handlePageChange.bind(this)}></PaginationControls>
				</div>
            </ViewWrapper>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(NewsPage);
