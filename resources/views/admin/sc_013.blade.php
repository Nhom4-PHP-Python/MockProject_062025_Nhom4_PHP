<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Case List - Preliminary Investigation</title>
    <link rel="stylesheet" href="/css/global.css" />
    <link rel="stylesheet" href="/css/sc_013style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <button class="hamburger-menu" aria-label="Open menu">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
            <!-- Other sidebar items like navigation links would go here -->
        </aside>

        <div class="main-content">
            <header class="main-header">
                <button class="hamburger-menu hamburger-menu-mobile" aria-label="Open menu">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
                <div class="user-profile">
                    <div class="user-info">
                        <span class="user-name">MATTHA, JOHN</span>
                        <span class="user-role">Sheriff</span>
                    </div>
                    <img class="logout-icon" src="/images/logout-icon.jpeg" alt="Logout" />
                </div>
            </header>

            <main class="content-body">
                <h1 class="page-title">Preliminary Investigation</h1>
                <div class="table-card">
                    <div class="table-controls">
                        <div class="entries-control">
                            <form method="GET" id="entriesForm">
                                <label for="show-entries">Show</label>
                                <select id="show-entries" name="show-entries" onchange="document.getElementById('entriesForm').submit()">
                                    <option value="10" {{ request('show-entries', 10) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('show-entries') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('show-entries') == 50 ? 'selected' : '' }}>50</option>
                                </select>
                                <span>entries</span>
                            </form>
                        </div>
                        <div class="search-control">
                            <form method="GET" id="searchForm" style="display: flex; align-items: center;">
                                <img src="/images/search-icon.png" alt="Search Icon" />
                                <input type="search" name="case_id" placeholder="Search by Case ID..." value="{{ request('case_id') }}" style="margin-left: 5px;" />
                            </form>
                        </div>
                    </div>

                    <div class="table-container-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Case ID</th>
                                    <th><img src="/images/UpDown-icon.png" alt="sort" class="sort-icon" /> Type of Crime </th>
                                    <th><img src="/images/UpDown-icon.png" alt="sort" class="sort-icon" /> Level of severity</th>
                                    <th><img src="/images/UpDown-icon.png" alt="sort" class="sort-icon" /> Date</th>
                                    <th><img src="/images/UpDown-icon.png" alt="sort" class="sort-icon" /> Reporter</th>
                                    <th>Location</th>
                                    <th><img src="/images/UpDown-icon.png" alt="sort" class="sort-icon" /> Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cases as $case) 
                                <tr>
                                    <td data-label="Case ID">{{ $case->case_id }}</td>
                                    <td data-label="Type of Crime">{{ $case->type_case }}</td>
                                    <td data-label="Level of severity">{{ $case->severity }}</td>
                                    <td data-label="Date">{{ \Carbon\Carbon::parse($case->create_at)->format('d/m/Y') }}</td>
                                    <td data-label="Reporter">{{ $case->report->reporter_fullname ?? '' }}</td>
                                    <td data-label="Location">{{ $case->report->case_location ?? '' }}</td>
                                    <td data-label="Status"><span class="status
                                        @if($case->status == 'Under Investigation') status-investigation
                                        @elseif($case->status == 'Closed') status-closed
                                        @elseif($case->status == 'Awaiting Prosecution') status-prosecution
                                        @endif
                                    ">{{ $case->status }}</span></td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-controls">
                        @php
                            $currentPage = $cases->currentPage();
                            $lastPage = $cases->lastPage();
                            $prevPageUrl = $currentPage > 1 ? $cases->url($currentPage - 1) : null;
                            $nextPageUrl = $currentPage < $lastPage ? $cases->url($currentPage + 1) : null;
                        @endphp

                        <button class="pagination-btn" 
                                @if(!$prevPageUrl) disabled @else onclick="window.location='{{ $prevPageUrl }}'" @endif>
                            Previous
                        </button>

                        @for ($i = 1; $i <= $lastPage; $i++)
                            <button class="pagination-btn{{ $i == $currentPage ? ' active' : '' }}"
                                    onclick="window.location='{{ $cases->url($i) }}'">
                                {{ $i }}
                            </button>
                        @endfor

                        <button class="pagination-btn" 
                                @if(!$nextPageUrl) disabled @else onclick="window.location='{{ $nextPageUrl }}'" @endif>
                            Next
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>