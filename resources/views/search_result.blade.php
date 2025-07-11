@extends('layouts.app')
@section('title', 'Search Results')
@section('content')
    <div class="container mt-4">
        <h3>Search results for: <strong>{{ $query }}</strong></h3>
        @if (isset($results['total']) && $results['total'] > 0)
            <h5>Reports</h5>
            @if ($results['reports']->count())
                <ul>
                    @foreach ($results['reports'] as $report)
                        <li>
                            <a href="{{ route('report.confirm', $report->report_id) }}">
                                {{ $report->case_id }} - {{ $report->type_report }} - {{ $report->reporter_fullname }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No reports found.</p>
            @endif
            <h5>Evidence</h5>
            @if ($results['evidence']->count())
                <ul>
                    @foreach ($results['evidence'] as $evi)
                        <li>
                            {{ $evi->evidence_type ?? '' }} - {{ $evi->description ?? '' }} - {{ $evi->location ?? '' }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No evidence found.</p>
            @endif
        @else
            <p>No results found.</p>
        @endif
    </div>
@endsection
