<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Recruitment</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ Route::is('admin.dashboard*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle fas fa-dashboard"></i> <span
                        class="align-middle">Dashboard</span>
                </a>
            </li>
            @role('Admin')
            <li class="sidebar-header">
                Master Data
            </li>
            <li class="sidebar-item {{ Route::is('admin.departement*','admin.position*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.departement') }}">
                    <i class="align-middle fas fa-building"></i> 
                    <span class="align-middle">Department</span>
                </a>
            </li>

            <li class="sidebar-item {{ Route::is('admin.account*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.account') }}">
                    <i class="align-middle fas fa-user"></i> 
                    <span class="align-middle">Account</span>
                </a>
            </li>
            @endrole

            @hasanyrole('HR|Admin|Manager')
            <li class="sidebar-header">
                Menu
            </li>

            <li class="sidebar-item {{ Route::is('admin.job*','admin.application*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.job') }}">
                    <i class="align-middle fas fa-clipboard-question"></i> <span
                        class="align-middle">Job Vacancy</span>
                </a>
            </li>
            
            <li class="sidebar-item {{ Route::is('admin.interview*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.interview') }}">
                    <i class="align-middle fas fa-clipboard-question"></i> <span
                        class="align-middle">Interview</span>
                </a>
            </li>
            @endhasanyrole

            @role('Admin')
            <li class="sidebar-header">
                Configuration
            </li>

            <li class="sidebar-item {{ Route::is('admin.question*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.question') }}">
                    <i class="align-middle fas fa-clipboard-question"></i> <span
                        class="align-middle">Question</span>
                </a>
            </li>
            @endrole
        </ul>
    </div>
</nav>