import React from "react";

const Home = () => {
    return (
        <main id="Home">
            <header className="landing-banner">
                <div className="container">
                    <div className="landing-banner__intro">
                        <div className="row">
                            <div className="col-md-8 col-md-offset-2">
                                <h1>Simple Approach to Manage Tournaments!</h1>
                                <h5 className="hidden-xs">GiveTour.Com to simplify tournament management process in order to save your time. <br/>Join us now and you will love this.</h5>
                            </div>
                        </div>
                    </div>

                    <div className="row banner-statistics">
                        <div className="col-xs-6 col-sm-3">
                            <div className="home-statistics">
                                <div className="home-statistics__number" data-bind="numericText: NumLeagueCategories"></div>
                                <div className="home-statistics__type">Sport types</div>
                            </div>
                        </div>
                        <div className="col-xs-6 col-sm-3">
                            <div className="home-statistics">
                                <div className="home-statistics__number" data-bind="numericText: NumLeagues"></div>
                                <div className="home-statistics__type">Leagues</div>
                            </div>
                        </div>
                        <div className="col-xs-6 col-sm-3">
                            <div className="home-statistics">
                                <div className="home-statistics__number" data-bind="numericText: NumTeams"></div>
                                <div className="home-statistics__type">Teams</div>
                            </div>
                        </div>
                        <div className="col-xs-6 col-sm-3">
                            <div className="home-statistics">
                                <div className="home-statistics__number" data-bind="numericText: NumViews()"></div>
                                <div className="home-statistics__type">Views</div>
                            </div>
                        </div>
                    </div>

                    <div className="landing-banner__action">
                        <div className="row">
                            <div className="col-md-6 col-md-offset-3">
                                <form className="input-group input-group-lg" data-bind="submit: $root.FindLeagues">
                                    <input className="form-control" placeholder="What tournament do you participate?" data-bind="value: SearchTerm" />
                                        <span className="input-group-btn">
                                            <button className="btn btn-warning" type="button" data-bind="click: $root.FindLeagues"><i className="fa fa-search"></i></button>
                                        </span>
                                </form>
                                <div className="mt-15">

                                    <button id="btnOurSupport" className="btn btn-warning btn-lg">Video</button>
                                    <a className="btn btn-primary btn-lg" data-bind="click: $root.OnClickExplore">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <section id="SupportedTypes" className="section">
                <div className="container">
                    <div className="row">
                        <div className="col-md-8 col-md-offset-2 text-center">
                            <div className="section-intro">
                                <h2 className="section-title">Support Multiple Tournament Systems</h2>
                                <p>Share your tournaments all over the internet tubes like a real magician! Easily post your comments in a league dashboard and discuss with other followers.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="container">
                    <div className="row">
                        <div className="col-sm-6 col-md-3">
                            <div className="tournament-type">
                                <div className="tournament-type__icon">
                                    <a href=""><img src="../Content/images/icon_elimination.png" alt="elimination_icon"/></a>
                                </div>
                                <h4 className="tournament-type__name">Elimination</h4>
                                <div className="tournament-type__des">
                                    <p>Elimination or knockout where the loser of each bracket is immediately eliminated from winning the championship.</p>
                                </div>

                                <div className="tournament-type__league">
                                    <div className="competitor-members mb-20">
                                        <div className="flex flex-jus-center">
                                            {/* <!--ko foreach: LeaguesKO--> */}
                                            <div className="flex-item">
                                                <a className="competitor-members__more clickable" target="_blank" data-bind="attr: { href: Url }"
                                                    style="max-width: 40px; font-size: 11px; text-overflow: ellipsis; overflow: hidden;">
                                                    <img data-bind="attr: { title: 'Click to view the tournament: ' + Name(), alt: 'league_' + Name(), src: AvatarUrl }" width="40"/>
                                                </a>
                                            </div>
                                            {/* <!--/ko--> */}
                                            <div className="flex-item">
                                                <div className="competitor-members__more">...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="col-sm-6 col-md-3">
                            <div className="tournament-type">
                                <div className="tournament-type__icon">
                                    <a href=""><img src="../Content/images/icon_round_robin.png" alt="round_robin_icon"/></a>

                                </div>
                                <h4 className="tournament-type__name">Round robin</h4>
                                <div className="tournament-type__des">
                                    <p>Each competitor plays every other competitors under a single or multiple round-robin type. Ranking rules are configurable.</p>
                                </div>

                                <div className="tournament-type__league">
                                    <div className="competitor-members mb-20">
                                        <div className="flex flex-jus-center">
                                            {/* <!--ko foreach: LeaguesRR--> */}
                                            <a className="competitor-members__more clickable" target="_blank" data-bind="attr: { href: Url }"
                                                style="max-width: 40px; font-size: 11px; text-overflow: ellipsis; overflow: hidden;">
                                                <img data-bind="attr: { title: 'Click to view the tournament: ' + Name(), alt: 'league_' + Name(), src: AvatarUrl }" width="40"/>
                                            </a>
                                            {/* <!--/ko--> */}
                                            <div className="flex-item">
                                                <div className="competitor-members__more">...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="col-sm-6 col-md-3">
                            <div className="tournament-type">
                                <div className="tournament-type__icon">
                                    <a href=""><img src="../Content/images/icon_two_stages.png" alt="two_stages_icon"/></a>

                                </div>
                                <h4 className="tournament-type__name">Two stages</h4>
                                <div className="tournament-type__des">
                                    <p>Combination of a round-robin in the first stage and a knockout in the second stage into a two stage tournament.</p>
                                </div>

                                <div className="tournament-type__league">
                                    <div className="competitor-members mb-20">
                                        <div className="flex flex-jus-center">
                                            {/* <!--ko foreach: LeaguesCP--> */}
                                            <a className="competitor-members__more clickable" target="_blank" data-bind="attr: { href: Url }"
                                                style="max-width: 40px; font-size: 11px; text-overflow: ellipsis; overflow: hidden;">
                                                <img data-bind="attr: { title: 'Click to view the tournament: ' + Name(), alt: 'league_' + Name(), src: AvatarUrl }" width="40"/>
                                            </a>
                                            {/* <!--/ko--> */}
                                            <div className="flex-item">
                                                <div className="competitor-members__more">...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="col-sm-6 col-md-3">
                            <div className="tournament-type">
                                <div className="tournament-type__icon">
                                    <a href=""><img src="../Content/images/icon_swiss.png" alt="swiss_icon"/></a>

                                </div>
                                <h4 className="tournament-type__name">Swiss System</h4>
                                <div className="tournament-type__des">
                                    <p>Each competitor does not play every other and plays opponents with a similar running score by pairing in each round.</p>
                                </div>

                                <div className="tournament-type__league">
                                    <div className="competitor-members mb-20">
                                        <div className="flex flex-jus-center">
                                            {/* <!--ko foreach: LeaguesSS--> */}
                                            <a className="competitor-members__more clickable" target="_blank" data-bind="attr: { href: Url }"
                                                style="max-width: 40px; font-size: 11px; text-overflow: ellipsis; overflow: hidden;">
                                                <img data-bind="attr: { title: 'Click to view the tournament: ' + Name(), alt: 'league_' + Name(), src: AvatarUrl }" width="40"/>
                                            </a>
                                            {/* <!--/ko--> */}
                                            <div className="flex-item">
                                                <div className="competitor-members__more">...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="container">
                    <div className="row">
                        <div className="col-md-6 col-md-offset-3 text-center">
                            <div className="section-action mt-15">
                                <a href="/Account/Register" className="btn btn-primary btn-lg mr-15">Sign Up</a>
                                <a href="/League/Create" className="btn btn-warning btn-lg">Create a tournament</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="section section--lg section--partners">
                <div className="container">
                    <div className="row">
                        <div className="col-md-8 col-md-offset-2 text-center">
                            <div className="section-intro">
                                <h2 className="section-title">Our happy clients</h2>
                                <p>Share your tournaments all over the internet tubes like a real magician! Easily post your comments in a league dashboard and discuss with other followers.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="container">
                    <div className="row">
                        <div className="col-md-6 col-md-offset-3 text-center">
                            {/* <!-- Swiper --> */}
                            <div className="swiper-container partners-slider">
                                <div className="swiper-wrapper">
                                    <div className="swiper-slide">
                                        <a href="/Partner">
                                            <div className="partner-avatar" style="background-image: url('/Content/images/partner/linhtay/avatar.png')">

                                            </div>
                                            <div className="partner-say">
                                                Givetour helps me save more than 80% of his time for statistic. I has spend a lot of time to gather and collect result, and
                                                analyze all matches. Now, I only needs to create a league on GiveTour, update all the team and player, update
                                                a result of a match then he will have his fully desired tournament statistic.
                                            </div>

                                            <div className="partner-org">Lê Nguyễn Thanh Lâm - Director Linh Tay Stadium</div>
                                        </a>
                                    </div>
                                    <div className="swiper-slide">
                                        <a href="/Partner">
                                            <div className="partner-avatar" style="background-image: url('/Content/images/partner/fusal/avatar.png')">

                                            </div>
                                            <div className="partner-say">
                                                I'm happy that GiveTour.com has been providing the big help in scheduling tournament, improving manage tournament teams,
                                                updating result easier, and analyzing statistic is simple.
                                            </div>

                                            <div className="partner-org">Nguyễn Hùng - Head of SaigonFutsal | Saigon FanLeague | Sân bóng đá Trường Hải</div>
                                        </a>
                                    </div>
                                    <div className="swiper-slide">
                                        <a href="/Partner">
                                            <div className="partner-avatar" style="background-image: url('/Content/images/partner/ict/avatar.png')">

                                            </div>
                                            <div className="partner-say">
                                                GiveTour.com could help him in solving above problems, saving his time, simplifying tournament management process and also
                                                increasing the transparency, friendlies to all. These helps ICT Friendship becoming a friendly and united
                                                tournaments in IT community at Ho Chi Minh city.
                                            </div>

                                            <div className="partner-org">Trần Phú Khánh - Organizer of ICT Friendship Community</div>
                                        </a>
                                    </div>
                                    <div className="swiper-slide">
                                        <a href="/Partner">
                                            <div className="partner-avatar" style="background-image: url('/Content/images/partner/ngosilien/avatar.png')">

                                            </div>
                                            <div className="partner-say">
                                                They are more than happy because GiveTour.com has provided more in tournament management such as: Following up with the general
                                                information of tournament, Helping organizer to have a right decisition sooner, Providing a cleary statistic
                                                regarding to tournament : players, goals, and cards. Updating the tournament once and sharing very easily
                                                to everyone: teachers, students, facebook and GiveTour.com's users.
                                            </div>

                                            <div className="partner-org">Đặng Nhật - Organizer of Ngo Si Lien Junior High School Soccer League</div>
                                        </a>
                                    </div>
                                    <div className="swiper-slide">
                                        <a href="/Partner">
                                            <div className="partner-avatar" style="background-image: url('/Content/images/partner/tnbs/avatar.png')">

                                            </div>
                                            <div className="partner-say">
                                                From the difficulty of managing the league, I and my team have been looking for a better solution that can save us time.
                                                However, most of the sites/tools have a paidment plan and no free at all for the need of community tournaments.
                                                When I found GiveTour.com, I have surprised that this is a FREE tool that help what I am looking for. GiveTour'
                                                features are not also FREE but also helpfull like other paid sites. Furthermore, we get a lot of support
                                                from GiveTour.com."
                                            </div>

                                            <div className="partner-org">Nguyễn Quốc Huy - Head of TonyBuoiSang League (TnBS)</div>
                                        </a>
                                    </div>
                                    <div className="swiper-slide">
                                        <a href="/Partner">
                                            <div className="partner-avatar" style="background-image: url('/Content/images/partner/hadong/avatar.png')">

                                            </div>
                                            <div className="partner-say">
                                                GiveTour.com has helped me solving a lot of problem in tournament managing. He could be easy to keep track the result, to
                                                update result lively while the match ends, help the fan keeps track the tournament progress, and saving a
                                                lot of time for me.
                                            </div>

                                            <div className="partner-org">Trần Hoàng Thịnh - Organizer of Ha Dong Basketball</div>
                                        </a>
                                    </div>
                                    <div className="swiper-slide">
                                        <a href="/Partner">
                                            <div className="partner-avatar" style="background-image: url('/Content/images/partner/tranquoctuan/avatar.png')">

                                            </div>
                                            <div className="partner-say">
                                                GiveTour.com is a solution that I have been using. This tool empower my league professionally. I and my team always love
                                                all GiveTour features such as managing the result clearly and easily, analyzing statically, exporting reports,
                                                sharing to friends easily.
                                            </div>

                                            <div className="partner-org">Nguyễn Hữu Huy - Organizer of Tran Quoc Tuan High School - Quang Ngai Community</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    </section>

            <section className="section section--lg section--white section--process">
                <div className="container">
                    <div className="row">
                        <div className="col-md-5">
                            <div className="iphone-hold hidden-xs">
                                <div className="iphone-main">
                                    <div className="iphone-inner">
                                        <div className="photos" data-bind="foreach: Leagues">
                                            <div className="photos__item" style="font-size: 11px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                                <a target="_blank" data-bind="attr: { href: Url }">
                                                    <img data-bind="attr: { title: 'Click to view the tournament: ' + Name(), alt: 'league_' + Name(), src: BannerUrl }" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="iphone-sub">
                                    <div className="iphone-top"></div>
                                    <div className="iphone-mid">
                                        <div className="iphone-part"></div>
                                    </div>
                                    <div className="iphone-bot"></div>
                                </div>
                            </div>
                        </div>
                        <div className="col-md-6 col-md-offset-1">
                            <div className="section-intro">
                                <h2 className="section-title">Run tournament</h2>
                                <p>There are 3 important periods to run your tournaments</p>
                            </div>

                            <div className="section--process__step">
                                <div className="section--process__icon"><span className="step-order">1</span> <span className="fa fa-list-ul text-primary"></span></div>
                                <h4 className="section--process__title">Create a tournament</h4>

                                <ul className="check-list">
                                    <li>Elimination</li>
                                    <li>Round robin</li>
                                    <li>Two stages</li>
                                    <li>Swiss System</li>
                                </ul>
                            </div>
                            <div className="section--process__step">
                                <div className="section--process__icon"><span className="step-order">2</span> <span className="fa fa-cogs text-primary"></span></div>
                                <h4 className="section--process__title">Setting tournament</h4>

                                <ul className="check-list">
                                    <li>Input rules, logo, location</li>
                                    <li>Input teams/couples/players information</li>
                                    <li>Invite participants</li>
                                    <li>Set calendar for matches</li>
                                    <li>Customize for each stage</li>
                                </ul>
                            </div>
                            <div className="section--process__step">
                                <div className="section--process__icon"><span className="step-order">3</span> <span className="fa fa-check-square-o text-primary"></span></div>
                                <h4 className="section--process__title">Run tournament</h4>

                                <ul className="check-list">
                                    <li>Activate</li>
                                    <li>Enter results</li>
                                    <li>View statistics</li>
                                    <li>Share with friends</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <section className="section section--fit">
                <div className="creating">
                    <div className="creating__team">
                        <div className="section-intro">
                            <h2 className="section-title">Become a team manager</h2>
                            <p>As a team manager, you can create, manage your team members, interact with other teams and tracking all activities of your teams.</p>
                            <div className="section-action">
                                <a href="/Team/Create" className="btn btn-warning btn-lg">Create Team</a>
                            </div>
                        </div>
                    </div>
                    <div className="creating__org">
                        <div className="section-intro">
                            <h2 className="section-title">GiveTour for Organization</h2>
                            <p>As an organization, you can create a site to host all of your tournaments under your brand name and custom layout to attract the targetted users of your organization.</p>
                            <div className="section-action">
                                <a href="/Organization/Create" className="btn btn-info btn-lg">Create an organization</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section className="section section--primary section--lg section--sharing">
                <div className="container">
                    <div className="row">
                        <div className="col-md-8 col-md-offset-2 text-center">
                            <div className="section-intro" style={"overflow: hidden"}>
                                <h2 className="section-title">Share with friends</h2>
                                <p>Share your tournaments all over the internet tubes like a real magician! Easily post your comments in a league dashboard and discuss with other followers.</p>

                                <div className="fb-like col-md-12 text-center"
                                    style="padding-top: 5px;"
                                    data-href="https://facebook.com/givetourdotcom"
                                    data-width="300px"
                                    data-colorscheme="dark"
                                    data-layout="standard"
                                    data-action="like"
                                    data-size="large"
                                    data-show-faces="true"
                                    data-share="true"></div>
                                <div className="col-md-12" style="padding-top: 5px;">
                                    <a className="twitter-follow-button" href="https://twitter.com/givetourdotcom" data-size="large" data-show-screen-name="false"></a>
                                    <a href="https://twitter.com/share" className="twitter-share-button" data-url="http://www.givetour.com" data-text="Manage and Share your tournaments over this site" data-size="large">Tweet</a>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    )
}

export default Home;