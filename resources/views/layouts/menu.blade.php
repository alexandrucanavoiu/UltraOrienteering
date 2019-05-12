<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/images/logo.png" alt="User Image">
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ \App\Helpers\Navigation::isActiveRoute(['dashboard']) }}">
                <a href="/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li class="{{ \App\Helpers\Navigation::isActiveRoute(['settings']) }}">
                <a href="/settings">
                    <i class="fa fa-cogs fa-fw"></i> SETTINGS</a>
            </li>
            <li class="{{ \App\Helpers\Navigation::isActiveRoute(['uuid-cards']) }}">
                <a href="/uuid-cards"><i class="fa fa-folder-open fa-fw"></i> UUID CARDS</a>
            </li>
            <li class="{{ \App\Helpers\Navigation::isActiveRoute(['stages']) }}">
                <a href="/stages"><i class="fa fa-rocket fa-fw"></i> STAGES</a>
            </li>
            <li class="{{ \App\Helpers\Navigation::isActiveRoute(['routes']) }}">
                <a href="/routes"><i class="fa fa-map-signs fa-fw"></i> ROUTES</a>
            </li>
            <li class="{{ \App\Helpers\Navigation::isActiveRoute(['categories']) }}">
                <a href="/categories"><i class="fa fa-list fa-fw"></i> CATEGORIES</a>
            </li>
            <li class="{{ \App\Helpers\Navigation::isActiveRoute(['clubs']) }}">
                <a href="/clubs"><i class="fa fa-shield fa-fw"></i> CLUBS</a>
            </li>
            <li class="{{ \App\Helpers\Navigation::isActiveRoute(['participants', 'participants.stages']) }}">
                <a href="/participants"><i class="fa fa-group fa-fw"></i> PARTICIPANTS</a>
            </li>
            <li class="{{ \App\Helpers\Navigation::isActiveRoute(['import-log', 'import-log.import']) }}">
                <a href="/import-log"><i class="fa fa-download fa-fw"></i> IMPORT LOG</a>
            </li>
            <li class="{{ \App\Helpers\Navigation::isActiveRoute(['rankings', 'rankings.categories', 'rankings.categories.ranks']) }}">
                <a href="/rankings"><i class="fa fa-cubes fa-fw"></i> RANKINGS</a>
            </li>
        </ul>
    </section>
    <div class="center"><a rel="license" target="_blank" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/">Creative Commons Attribution-NonCommercial 4.0 International License</a>.</div>
    <!-- /.sidebar -->
</aside>
