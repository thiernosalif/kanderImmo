<aside id="sidebar_main">
    <div class="menu_section">
        <div class="sidebar_main_header">
            <div class="sidebar_logo" style="text-align: center">
                <a href="{{ route('home') }}" class="sSidebar_hide sidebar_logo_large" style="width: 100%; text-align: center; padding: 20px 0 0 0;" data-disable>
                        <img class="logo_regular" src="{{ asset('images/logo.png') }}" alt="" width="70%"  />

                </a>
            </div>
        </div>

        <ul>
            <li  title="Tableau de bord">
                <a href="{{ route('home') }}">
                    <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                    <span class="menu_title">Tableau de bord</span>
                </a>
            </li>

            <li  title="PROPRIETAIRES">
                <a href="{{ route('proprietaires.index') }}">
                    <span class="menu_icon"><i class="material-icons">&#xe7fb;</i></span>
                    <span class="menu_title">PROPRIETAIRES</span>
                </a>
            </li>

            <li  title="LOCATAIRES">
                <a href="{{ route('locataires.index') }}">
                    <span class="menu_icon"><i class="material-icons">&#xe7fb;</i></span>
                    <span class="menu_title">LOCATAIRES</span>
                </a>
            </li>

            <li  title="BIENS">
                <a href="{{ route('biens.index') }}">
                    <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                    <span class="menu_title">BIENS</span>
                </a>
            </li>

            <li  title="ARTICLES">
                <a href="{{ route('articles.index') }}">
                    <span class="menu_icon"><i class="material-icons">&#xe896;</i></span>
                    <span class="menu_title">ARTICLES</span>
                </a>
            </li>

            <li  title="RECLAMATIONS">
                <a href="{{ route('reclamations.index') }}">
                    <span class="menu_icon"><i class="material-icons">&#xe03b;</i></span>
                    <span class="menu_title">RECLAMATIONS</span>
                </a>
            </li>

            <li  title="COMPTABILITES">
                <a href="">
                    <span class="menu_icon"><i class="material-icons">&#xe149;</i></span>
                    <span class="menu_title">COMPTABILITES</span>
                </a>
                <ul>
                    <li  title="Depot">
                        <a href="{{ route('comptabilites.index', ['id' => "depot"]) }}" {{--data-uk-tooltip title="{{ $depot }}" data-uk-modal="{center:true}"--}}>
                            <span class="menu_icon"><i class="material-icons">&#xe8b9;</i></span>
                            <span class="menu_title">Depot</span>
                        </a>
                    </li>
                    <li  title="Retrait">
                        <a href="{{ route('comptabilites.index', ['id' => "retrait"]) }}" {{--data-uk-tooltip title="{{ $retrait }}" data-uk-modal="{center:true}"--}}>
                            <span class="menu_icon"><i class="material-icons">&#xe8b9;</i></span>
                            <span class="menu_title">Retrait</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li  title="REGLEMENTS">
                <a href="{{ route('reglements.index') }}">
                    <span class="menu_icon"><i class="material-icons">local_atm</i></span>
                    <span class="menu_title">REGLEMENTS</span>
                </a>
            </li>

            <li  title="SITUATIONS">
                <a href="{{ route('situations.index') }}">
                    <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                    <span class="menu_title">SITUATIONS</span>
                </a>
            </li>

            <li title="Site Ecommerce">
                <a href="#">
                    <span class="menu_icon"><i class="material-icons">&#xe8cb;</i></span>
                    <span class="menu_title">Site Web</span>
                </a>
                <ul>
                    <li  title="Thème">
                        <a href="#" data-disable>
                            <span class="menu_icon"><i class="material-icons">&#xe8b9;</i></span>
                            <span class="menu_title">Génégral</span>
                        </a>
                    </li>
                    </ul>
            </li>
         </ul>
    </div>
</aside>
