'use strict';

import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
import Animation from 'react-addons-css-transition-group';
import $ from 'jquery';
import initSlider from '../../scripts/jquery.cslider.js';
import {AlertActions} from '../../library/alerts';
import isEmpty from '../../library/utilities/isEmpty';
import Iframe from '../../library/iframe';
import BannerSlideActions from '../../actions/BannerSlideActions';

const mapStateToProps = (state) => {
    return {
		'bannerSlides': state.bannerSlides
	}
};

const mapDispatchToProps = (dispatch) => {
    return bindActionCreators({
		'getSlides': BannerSlideActions.getAll
	}, dispatch);
};

class IndexPage extends React.Component {
    constructor() {
        super();

        this.state = {
			'bannerSlides': [
				{
					'title': 'Easy management',
					'text': 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.',
					'link': '#',
					'Files': [{
						'locationUrl': '/images/2.png'
					}]
				},
				{
					'title': 'Revolution',
					'text': 'A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.',
					'link': '#',
					'Files': [{
						'locationUrl': '/images/3.png'
					}]
				},
				{
					'title': 'Warm welcome',
					'text': 'When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.',
					'link': '#',
					'Files': [{
						'locationUrl': '/images/1.png'
					}]
				},
				{
					'title': 'Quality Control',
					'text': 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.',
					'link': '#',
					'Files': [{
						'locationUrl': '/images/4.png'
					}]
				}
			]
		}
    }

	componentDidMount() {
		// TODO: Uncomment setState once real slides are added
		document.title = "Battle-Comm";
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
					    interval: 3000 // time between transitions
					});
				});
			});
		});
	}

    // Server side rendering - sends initial data
    // static fetchData(config) {
    // 	return config.store.dispatch(ProductOrderActions.getAll());
    // }

    render() {
        return (
            <div className="content-view">
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
                                <h2 className="text-center">
									<div className="slider-container">
										<div id="da-slider" className="da-slider">
											{
												this.state.bannerSlides.map((slide, i) =>
													<div key={i} className="da-slide">
														<h2>{slide.title}</h2>
														<p>{slide.text}</p>
														<a href={slide.link} className="da-link">Read more</a>
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
                                </h2>
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
                            <div className="box-bar-top"><div className="bar"></div></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
                                <h2 className="text-center">Supported Game Systems</h2>
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
                            <div className="box-bar-top"><div className="bar"></div></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
								<div className="small-12 columns">
									<p className="indent">Find access to a worldwide community of dedicated table-top gamers and hobbyists as well as tools to promote your store, events, and gaming space to a worldwide community of dedicated table-top players. Earn system packs and a reward point vault for your future customers.</p>
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
                            <div className="box-bar-top"><div className="bar"></div></div>
                            <div className="box-corner-tr"></div>
                        </div>
                        <div className="box-middle">
                            <div className="box-bar-left"></div>
                            <div className="box-content">
								<div className="small-12 columns">
									<p className="indent">Benefit from tools to help you organize, promote, and execute your gaming event with the ability to create game schedules on the fly, change matches as demands require, post results (and rewards) in real time, and track scoring and stats, all from a friendly, manageable online dashboard.</p>
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
								<div className="small-12 columns">
									<h2 className="text-center">Twitter Stream</h2>
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
								<div className="small-12 columns">
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
            </div>
        );
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(IndexPage);
