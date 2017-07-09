'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import {Link, withRouter} from 'react-router-dom';
import {CSSTransitionGroup as Animation} from 'react-transition-group';
import ViewWrapper from '../ViewWrapper';
import AchievementActions from '../../actions/AchievementActions';
// import {PaginationControls} from '../../library/pagination';

const mapStateToProps = (state) => {
	return {
		'achievements': state.achievements
	}
};

const mapDispatchToProps = (dispatch) => {
	return bindActionCreators({
		'searchAchievements': AchievementActions.search
	}, dispatch);
}

let timer;

class Achievements extends React.Component {
    constructor() {
        super();

		this.state = {
			'pagination': {},
			'searchQuery': '',
			'orderBy': 'title'
		}

		this.handlePageChange = this.handlePageChange.bind(this);
    }

    componentDidMount() {
        document.title = "Battle-Comm | Achievements";
		this.handlePageChange(1);
    }

	componentWillReceiveProps(nextProps) {
	}

	handlePageChange(pageNumber = 1, e) {
		if (e && e.keyCode && e.keyCode !== 13) {
			return;
		}
        this.props.searchAchievements({'searchQuery': this.state.searchQuery, 'orderBy': this.state.orderBy, 'pageNumber': pageNumber, 'pageSize': 100}).then((pagination) => {
			this.setState({
				'pagination': pagination
			});
        });
    }

    render() {
        return (
            <ViewWrapper headerImage="/images/Titles/Achievements.png" headerAlt="Achievements">
				{/*<div className="row">
					<div className="small-12 medium-6 large-8 columns">
						<label>Search Query</label>
						<div className="form-group search-input">
							<input name="searchQuery" type="text" onChange={this.handleQueryChange} value={this.state.searchQuery} placeholder="Enter search terms to filter results" onKeyUp={this.handlePageChange.bind(this, 1)}/>
							<span className="search-icon fa fa-search pointer" onClick={this.handlePageChange.bind(this, 1)}></span>
						</div>
					</div>
					<div className="small-12 medium-6 large-4 columns">
						<label>Search By</label>
						<div className="form-group inline">
							<select name="searchBy" value={this.state.searchBy} onChange={this.handleSearchByChange}>
								<option value='username'>Username</option>
								<option value='firstName'>First Name</option>
								<option value='lastName'>Last Name</option>
							</select>
							<button className="button" onClick={this.handlePageChange.bind(this, 1)}>Search!</button>
						</div>
					</div>
				</div>*/}
				<hr/>
				<div className="small-12 columns achievements">
					{
						this.props.achievements.map((achievement, i) =>
							<span key={achievement.id} className="achievement">
								<div className="achievement-title">{achievement.title}</div>
								<div><img src={achievement.File ? `${achievement.File.locationUrl}100-${achievement.File.name}` : '/uploads/achievements/100-defaultAchievement.png'} alt={achievement.name} /></div>
								{
									<div className="achievement-description" key={`${i}-description`}>
										<span className="fa fa-connectdevelop"></span>
										<span>{achievement.description}</span>
										<span className="fa fa-connectdevelop"></span>
									</div>
								}
							</span>
						)
					}
					{/*<div className="small-12 columns">
						<PaginationControls pageNumber={this.state.pagination.pageNumber} pageSize={this.state.pagination.pageSize} totalPages={this.state.pagination.totalPages} totalResults={this.state.pagination.totalResults} handlePageChange={this.handlePageChange.bind(this)}></PaginationControls>
					</div>*/}
				</div>
            </ViewWrapper>
        );
    }
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(Achievements));
