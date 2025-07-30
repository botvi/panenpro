<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ asset('admin') }}/dashboard/index.html" class="b-brand text-primary">
                <img src="{{ asset('env') }}/logo_text.png" alt="Logo" style="height: 40px;">
            </a>
        </div>
        @if (Auth::user()->role == 'asisten')
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="/dashboard-asisten" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Data Panenpro</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('datamandor.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user"></i></span>
                            <span class="pc-mtext">Data Mandor</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('asisten.akp.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">AKP</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('asisten.grafikkepatuhan.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-activity"></i></span>
                            <span class="pc-mtext">Grafik Kepatuhan</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('asisten.absensipemanen.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-calendar-event"></i></span>
                            <span class="pc-mtext">Absensi Pemanen</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('asisten.absensiberkala.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-calendar-event"></i></span>
                            <span class="pc-mtext">Absensi Berkala</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('asisten.datapanen.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Data Panen</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="#" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Rekap AKP Aktual</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('datablok.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Data Blok</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif

        @if (Auth::user()->role == 'mandor')
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="/dashboard-mandor" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Data Panenpro</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('datapemanen.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user"></i></span>
                            <span class="pc-mtext">Data Pemanen</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('akp.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">AKP</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('grafikkepatuhan.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-activity"></i></span>
                            <span class="pc-mtext">Grafik Kepatuhan</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('absensipemanen.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-calendar-event"></i></span>
                            <span class="pc-mtext">Absensi Pemanen</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('absensiberkala.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-calendar-event"></i></span>
                            <span class="pc-mtext">Absensi Berkala</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif

        @if (Auth::user()->role == 'pemanen')
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="/dashboard-pemanen" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Data Panenpro</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('datapanen.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                            <span class="pc-mtext">Data Panen</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>
