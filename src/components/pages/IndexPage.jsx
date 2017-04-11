'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {Link} from 'react-router';
import {connect} from 'react-redux';
import Animation from 'react-addons-css-transition-group';
import $ from 'jquery';
import { Timeline } from 'react-twitter-widgets'
import initSlider from '../../scripts/jquery.cslider.js';
import {AlertActions} from '../../library/alerts';
import isEmpty from '../../library/utilities/isEmpty';
import Iframe from '../../library/iframe';
import BannerSlideActions from '../../actions/BannerSlideActions';
import GameSystemActions from '../../actions/GameSystemActions';
import Modal from '../../library/Modal';

const mapStateToProps = (state) => {
    return {
		'bannerSlides': state.bannerSlides,
		'gameSystems': state.gameSystems
	}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
		'getGameSystems': GameSystemActions.getAll,
		'getSlides': BannerSlideActions.getAll
	}, dispatch);
};

class IndexPage extends React.Component {
    constructor() {
        super();

        this.state = {
			'bannerSlides': [
				{
					'title': 'Play, Compete, Earn',
					'text': 'Battle-Comm is your new source for connection with the table-top gaming community. Play table-top at participating game shops, compete in tournaments, earn Reward Points, and exchange them for new merch.',
					'link': '/login',
					'actionText': 'Sign Up',
					'Files': [{
						'locationUrl': '/images/branding/logo.png'
					}]
				}
			],
			'showGameList': false
		}
    }

	componentDidMount() {
		// TODO: Uncomment setState once real slides are added
		document.title = "Battle-Comm";
		this.props.getGameSystems();
		this.props.getSlides().then((slides) => {
			let pageSlides = [];
			slides.forEach((slide) => {
				if (slide.pageName === 'home' && slide.isActive) {
					pageSlides.push(slide);
				}
			});
			pageSlides.sort((a, b) => {
				return a.priority - b.priority;
			});
			this.setState({
				'bannerSlides': this.state.bannerSlides
				// 'bannerSlides': pageSlides
			}, () => {
				initSlider($);
				// Initialize slideshow
				$(function() {
					$('#da-slider').cslider({
						current: 0, // index of current slide
					    bgincrement: 20, // increment the bg position (parallax effect) when sliding
					    autoplay: true, // slideshow on / off
					    interval: 4000 // time between transitions
					});
				});
			});
		});
	}

    // Server side rendering - sends initial data
    // static fetchData(config) {
    // 	return config.store.dispatch(ProductOrderActions.getAll());
    // }

	toggleModal(property, e) {
		if (e) {
			e.preventDefault();
		}
		this.setState({
			[property]: !this.state[property]
		});
	}

    render() {
        return (
            <div className="content-view home-page">
                <div className="content-box-container">
                    <div className="box-12">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top"><div className="bar"></div></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
								<div className="slider-container">
									<div id="da-slider" className="da-slider">
										{
											this.state.bannerSlides.map((slide, i) =>
												<div key={i} className="da-slide">
													<h2>{slide.title}</h2>
													<p>{slide.text}</p>
													<a href={slide.link} className="da-link">{slide.actionText}</a>
													<div className="da-img"><img src={slide.Files[0].locationUrl} alt="image01" /></div>
												</div>
											)
										}
										<nav className="da-arrows">
											<span className="da-arrows-prev"></span>
											<span className="da-arrows-next"></span>
										</nav>
									</div>
								</div>
                            </div>
                            <div className="box-bar-right"></div>
                        </div>
                        <div className="box-bottom">
                            <div className="box-corner-bl"></div>
                            <div className="box-bar-bottom"><div className="bar"></div></div>
                            <div className="box-corner-br"></div>
                        </div>
                    </div>
                </div>
                <div className="content-box-container">
                    <div className="box-12">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top"><div className="bar">
								<div className="title large"><img src="images/Titles/Now_Supporting.png" alt="" /></div>
                            </div></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
								<div className="row">
									<div className="small-12 medium-3 columns text-center">
										<img src="/images/logos/dropzone-commander.png" />
									</div>
									<div className="small-12 medium-3 columns text-center">
										<img src="/images/logos/magic-the-gathering.png" />
									</div>
									<div className="small-12 medium-3 columns text-center">
										<img src="/images/logos/x-wing-fantasy-flight.png" />
									</div>
									<div className="small-12 medium-3 columns text-center">
										<img src="/images/logos/warhammer-40k.png" />
									</div>
								</div>
								<div className="small-12 columns">
									<h2 className="text-right" onClick={this.toggleModal.bind(this, 'showGameList')}><a className="underline color-white">...and many more --></a></h2>
								</div>
                            </div>
                            <div className="box-bar-right"></div>
                        </div>
                        <div className="box-bottom">
                            <div className="box-corner-bl"></div>
                            <div className="box-bar-bottom"><div className="bar"></div></div>
                            <div className="box-corner-br"></div>
                        </div>
                    </div>
                </div>
                <div className="content-box-container">
                    <div className="box-6">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top">
								<div className="bar"><div className="title small"><img src="images/Titles/BC_And_Your_Store.png" alt="" /></div></div>
							</div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
								<div className="small-12 columns">
									<p className="indent">Find access to a worldwide community of dedicated table-top gamers and hobbyists as well as tools to promote your store, events, and gaming space to a worldwide community of dedicated table-top players. Earn system packs and a reward point vault for your future customers.</p>
								</div>
								<div className="small-12 columns text-center">
									<Link to={`/news`} className="button medium center collapse">Read More</Link>
								</div>
                            </div>
                            <div className="box-bar-right"></div>
                        </div>
                        <div className="box-bottom">
                            <div className="box-corner-bl"></div>
                            <div className="box-bar-bottom"><div className="bar"></div></div>
                            <div className="box-corner-br"></div>
                        </div>
                    </div>
                    <div className="box-6">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top"><div className="bar">
								<div className="title small"><img src="images/Titles/Event_And_Tournament_Help.png" alt="" /></div>
                            </div></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
								<div className="small-12 columns">
									<p className="indent">Benefit from tools to help you organize, promote, and execute your gaming event with the ability to create game schedules on the fly, change matches as demands require, post results (and rewards) in real time, and track scoring and stats, all from a friendly, manageable online dashboard.</p>
								</div>
								<div className="small-12 columns text-center">
									<Link to={`/news`} className="button medium center collapse">Read More</Link>
								</div>
                            </div>
                            <div className="box-bar-right"></div>
                        </div>
                        <div className="box-bottom">
                            <div className="box-corner-bl"></div>
                            <div className="box-bar-bottom"><div className="bar"></div></div>
                            <div className="box-corner-br"></div>
                        </div>
                    </div>
                </div>
                <div className="content-box-container">
                    <div className="box-4">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top"><div className="bar"></div></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
								<div className="small-12 columns twitter-widget">
									<Timeline
									    dataSource={{
									      sourceType: 'profile',
									      screenName: 'battle_comm'
									    }}
									    options={{
									      username: 'battle_comm',
									      height: '420',
										  theme: 'dark'
									    }}
									/>
								</div>
                            </div>
                            <div className="box-bar-right"></div>
                        </div>
                        <div className="box-bottom">
                            <div className="box-corner-bl"></div>
                            <div className="box-bar-bottom"><div className="bar"></div></div>
                            <div className="box-corner-br"></div>
                        </div>
                    </div>
                    <div className="box-8">
                        <div className="box-top">
                            <div className="box-corner-tl"></div>
                            <div className="box-bar-top"><div className="bar"></div></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
								<div className="small-12 columns featured-video">
									<Iframe url="https://player.vimeo.com/video/22439234" width="100%" height="420px" position="relative"></Iframe>
								</div>
                            </div>
                            <div className="box-bar-right"></div>
                        </div>
                        <div className="box-bottom">
                            <div className="box-corner-bl"></div>
                            <div className="box-bar-bottom"><div className="bar"></div></div>
                            <div className="box-corner-br"></div>
                        </div>
                    </div>
                </div>
				<Modal name="gameListModal" title="Supported Game Systems" modalIsOpen={this.state.showGameList} handleClose={this.toggleModal.bind(this, 'showGameList')} showClose={true} showFooter={false}>
					<ul>
						{
							this.props.gameSystems.map((gameSystem, i) =>
								<li key={i}>{gameSystem.name}</li>
							)
						}
					</ul>
				</Modal>
            </div>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(IndexPage);
