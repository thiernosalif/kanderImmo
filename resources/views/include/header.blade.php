<header id="header_main">
    <div class="header_main_content">
        <nav class="uk-navbar">

            <!-- main sidebar switch -->
            <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                <span class="sSwitchIcon"></span>
            </a>

            <!-- secondary sidebar switch -->
            <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                <span class="sSwitchIcon"></span>
            </a>
            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav user_actions">
                    {{--<li data-uk-dropdown="{mode:'click',pos:'bottom-right'}" style="background-color: #F3F3F3">--}}
                    {{--<a href="#" class="user_action_icon">--}}
                    {{--<i class="material-icons md-24">&#xE7F4;</i>--}}
                    {{--<span class="uk-badge"></span>--}}
                    {{--</a>--}}
                    {{--<div class="uk-dropdown uk-dropdown-xlarge">--}}
                    {{--<div class="md-card-content">--}}
                    {{--<ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#header_alerts',animation:'slide-horizontal'}">--}}
                    {{--<li class="uk-width-1-1"><a href="#" class="js-uk-prevent uk-text-small">Messages envoyés</a></li>--}}
                    {{--</ul>--}}
                    {{--<ul id="header_alerts" class="uk-switcher uk-margin">--}}
                    {{--<li>--}}
                    {{--<ul class="md-list md-list-addon">--}}
                    {{--<li>--}}
                    {{--<div class="md-list-addon-element">--}}
                    {{--<i class="md-list-addon-icon material-icons uk-text-warning">&#xE8B2;</i>--}}
                    {{--</div>--}}
                    {{--<div class="md-list-content">--}}
                    {{--<span class="md-list-heading">Quibusdam harum rerum.</span>--}}
                    {{--<span class="uk-text-small uk-text-muted uk-text-truncate">Quidem error fuga nulla perspiciatis.</span>--}}
                    {{--</div>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</li>--}}

                    <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}" style="background-color: #F3F3F3">
                        <a href="#" class="user_action_image">
                            <span style="color: #000;">{{ auth()->user()->nom ?? '' }}</span> &nbsp;
                            <img class="md-user-image" src="{{ asset('public/images/user.jpg') }}" alt=""/>
                        </a>
                        <div class="uk-dropdown uk-dropdown-small">
                            <ul class="uk-nav js-uk-prevent">
                                <li><a href="">Mon profil</a></li>
                                <li>
                                    <a href=""
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Déconnexion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>