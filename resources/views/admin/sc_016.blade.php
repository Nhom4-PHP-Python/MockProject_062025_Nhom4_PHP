<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Medical/Rescue Support</title>
    <link rel="stylesheet" href="/css/global.css" />
    <link rel="stylesheet" href="/css/sc_016style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <div class="sidebar-section">
            <div class="sidebar-title active"><span class="sidebar-arrow">&#9660;</span> Initial Response</div>
            <ul class="sidebar-list">
                <li>Time of dispatching forces to the scene</li>
                <li>Time of arrival at the scene</li>
                <li>List of officers assigned to the scene</li>
                <li>Preliminary assessment of the scene situation</li>
                <li>Scene preservation measures taken</li>
                <li>Information on medical/rescue support provided</li>
            </ul>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-title"><span class="sidebar-arrow">&#9654;</span> Scene Information</div>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-title"><span class="sidebar-arrow">&#9654;</span> Initial Investigation Report</div>
        </div>
    </aside>
    <div class="main-content">
        <div class="patrol-container">
            <div class="patrol-header">
                <h1 class="patrol-title">ADD PATROL OFFICAL TO SENCE</h1>
                <button class="close-btn" aria-label="Close">&times;</button>
            </div>
            <div class="patrol-controls">
                
                <div class="filter-group">
                    <form method="GET" action="" style="width:100%;">
                        <div class="search-row">
                            <input type="text" class="search-input" name="fullname" placeholder="Search by Fullname..." value="{{ request('fullname') }}" />
                        </div>
                        <div class="filter-row">
                            <select class="filter-select" name="presentstatus" onchange="this.form.submit()">
                                <option value="">Present Status</option>
                                @foreach($presentStatuses as $status)
                                    <option value="{{ $status }}" {{ request('presentstatus') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            <select class="filter-select" name="zone" onchange="this.form.submit()">
                                <option value="">Zone</option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone }}" {{ request('zone') == $zone ? 'selected' : '' }}>{{ $zone }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" style="display:none"></button>
                    </form>
                </div>
            </div>
            <div class="patrol-table-section">
                <div class="patrol-table-header">
                    <span class="patrol-table-title">ADD PATROL OFFICAL TO SENCE</span>
                    <button class="add-btn">ADD <span class="add-icon">&#9432;</span></button>
                </div>
                <table class="patrol-table">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Select</th>
                            <th>Full Name</th>
                            <th>Present Status</th>
                            <th>Role</th>
                            <th>Phone Number</th>
                            <th>Zone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td data-label="Serial">1</td>
                            <td data-label="Select"><input type="checkbox" /></td>
                            <td data-label="Full Name">{{ $user->fullname}}</td>
                            <td data-label="Present Status" class="status 
                            @if($user->presentstatus == 'On Above Case') on-above-case
                            @elseif($user->presentstatus == 'Idle') idle
                            @elseif($user->presentstatus == 'On Call') on-call
                            @endif
                            ">{{ $user->presentstatus }}</td>

                        
                            <td data-label="Role">Patrol Officer</td>
                            <td data-label="Phone Number">{{ $user->phonenumber}}</td>
                            <td data-label="Zone">Sector 5, District 2</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                <div class="patrol-pagination">
                    @php
                        $currentPage = $users->currentPage();
                        $lastPage = $users->lastPage();
                        $prevPageUrl = $currentPage > 1 ? $users->url($currentPage - 1) : null;
                        $nextPageUrl = $currentPage < $lastPage ? $users->url($currentPage + 1) : null;
                    @endphp
                    <div class="pagination-btns">
                        <button class="pagination-btn" 
                                @if(!$prevPageUrl) disabled @else onclick="window.location='{{ $prevPageUrl }}'" @endif>
                            Previous
                        </button>
                        @for ($i = 1; $i <= $lastPage; $i++)
                            <button class="pagination-btn{{ $i == $currentPage ? ' active' : '' }}"
                                    onclick="window.location='{{ $users->url($i) }}'">
                                {{ $i }}
                            </button>
                        @endfor
                        <button class="pagination-btn" 
                                @if(!$nextPageUrl) disabled @else onclick="window.location='{{ $nextPageUrl }}'" @endif>
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>