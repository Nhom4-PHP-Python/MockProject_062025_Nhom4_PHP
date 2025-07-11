@extends('layouts.app')
@section('title', __('messages.crime_report_step2'))
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white px-0">
                <li class="breadcrumb-item"><a href="/">{{ __('messages.home') }}</a></li>
                <li class="breadcrumb-item">{{ __('messages.report') }}</li>
                <li class="breadcrumb-item"><a href="{{ route('report.step1') }}">{{ __('messages.step1') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.step2') }}</li>
            </ol>
        </nav>
        <h3 class="text-center fw-bold mb-4">{{ __('messages.crime_report') }}</h3>
        <div class="d-flex justify-content-center mb-4">
            <div class="stepper d-flex justify-content-between w-50">
                <div class="step">1</div>
                <div class="step-line"></div>
                <div class="step active">2</div>
                <div class="step-line"></div>
                <div class="step">3</div>
            </div>
        </div>
        <div class="step-labels d-flex justify-content-between w-50 mx-auto mb-4">
            <div>{{ __('messages.step1') }}</div>
            <div>{{ __('messages.step2') }}</div>
            <div>{{ __('messages.step3') }}</div>
        </div>
        <form method="POST" action="{{ route('report.postStep2') }}" enctype="multipart/form-data" id="reportForm">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card p-4 mx-auto" style="max-width:950px; border: 0.5px solid #ffffff;">
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-grow-1 border-top" style="height:1px;"></div>
                    <h3 class="fw-bold text-center fs-2 mx-3 mb-1">{{ __('messages.incident_information') }}</h3>
                    <div class="flex-grow-1 border-top" style="height:1px;"></div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.type_of_crime') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-select" name="type_of_crime" required>
                            <option value="">{{ __('messages.select_option') }}</option>
                            <option value="crimes_against_persons">{{ __('messages.Crimes Against Persons') }}</option>
                            <option value="crimes_against_property">{{ __('messages.Crimes Against Property') }}</option>
                            <option value="white_collar_crimes">{{ __('messages.White-Collar Crimes') }}</option>
                            <option value="cyber_crimes">{{ __('messages.Cyber Crimes') }}</option>
                            <option value="drug_related_crimes">{{ __('messages.Drug-related Crimes') }}</option>
                            <option value="public_order_crimes">{{ __('messages.Public Order Crimes') }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.severity') }} <span class="text-danger">*</span></label>
                        <select class="form-select" name="severity" required>
                            <option value="">{{ __('messages.select_option') }}</option>
                            <option value="urgent">{{ __('messages.Urgent') }}</option>
                            <option value="not_urgent">{{ __('messages.Not urgent') }}</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{ __('messages.datetime_of_occurrence') }} <span
                                class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" name="incident_datetime" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{ __('messages.detailed_address') }}</label>
                        <input type="text" class="form-control" name="detailed_address">
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('messages.description_of_incident') }}</label>
                        <textarea class="form-control" name="description" rows="2"></textarea>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-grow-1 border-top " style="height:1px;"></div>
                    <h6 class="fw-bold mt-1  text-center mx-3  fs-4">{{ __('messages.relevant_parties') }}</h6>
                    <div class="flex-grow-1 border-top" style="height:1px;"></div>
                </div>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('messages.id') }}</th>
                                <th>{{ __('messages.relevant_role') }}</th>
                                <th>{{ __('messages.name') }}</th>
                                <th>{{ __('messages.statement') }}</th>
                                <th>{{ __('messages.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $parties = session('report_parties', []); @endphp
                            @forelse($parties as $idx => $party)
                                <tr>
                                    <td>#{{ $idx + 1 }}</td>
                                    <td>{{ $party['relationship'] }}</td>
                                    <td>{{ $party['fullname'] }}</td>
                                    <td>{{ $party['statement'] ?? '' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('report.party.edit', $idx) }}" class="text-primary me-2"
                                            title="{{ __('messages.edit') }}"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('report.party.delete', $idx) }}" class="text-danger delete-icon"
                                            data-url="{{ route('report.party.delete', $idx) }}"
                                            title="{{ __('messages.delete') }}"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{ __('messages.no_relevant_parties_added') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#relevantPartyModal">{{ __('messages.add') }}</button>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4">
                    <div class="flex-grow-1 border-top " style="height:1px;"></div>
                    <h6 class="fw-bold mt-1 text-center mx-3 fs-4">{{ __('messages.initial_evidence') }}</h6>
                    <div class="flex-grow-1 border-top" style="height:1px;"></div>
                </div>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('messages.id') }}</th>
                                <th>{{ __('messages.types_of_evidence') }}</th>
                                <th>{{ __('messages.location') }}</th>
                                <th>{{ __('messages.description') }}</th>
                                <th>{{ __('messages.attachments') }}</th>
                                <th>{{ __('messages.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $evidences = session('report_evidences', []); @endphp
                            @forelse($evidences as $idx => $evi)
                                <tr>
                                    <td>#{{ $idx + 1 }}</td>
                                    <td>{{ $evi['type'] }}</td>
                                    <td>{{ $evi['location'] ?? '' }}</td>
                                    <td>{{ $evi['description'] ?? '' }}</td>
                                    <td>
                                        @if (isset($evi['attachment']) && $evi['attachment'])
                                            <a href="{{ asset('storage/' . $evi['attachment']) }}"
                                                target="_blank">{{ __('messages.file') }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('report.evidence.edit', $idx) }}" class="text-primary me-2"
                                            title="{{ __('messages.edit') }}"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('report.evidence.delete', $idx) }}"
                                            class="text-danger delete-icon"
                                            data-url="{{ route('report.evidence.delete', $idx) }}"
                                            title="{{ __('messages.delete') }}"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">{{ __('messages.no_evidence_added') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#initialEvidenceModal">{{ __('messages.add') }}</button>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('report.step1') }}"
                        class="btn btn-outline-secondary me-2">{{ __('messages.back') }}</a>
                    <button type="button" class="btn btn-dark"
                        id="confirmMainSubmit">{{ __('messages.submit') }}</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Relevant Party Modal -->
    <div class="modal fade" id="relevantPartyModal" tabindex="-1" aria-labelledby="relevantPartyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="relevantPartyModalLabel">{{ __('messages.add_relevant_party') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="partyForm" method="POST" action="{{ route('report.party.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">{{ __('messages.fullname') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="relationship" class="form-label">{{ __('messages.relationship') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="relationship" name="relationship" required>
                                        <option value="">{{ __('messages.select_option') }}</option>
                                        <option value="witness">{{ __('messages.witness') }}</option>
                                        <option value="victim">{{ __('messages.victim') }}</option>
                                        <option value="suspect">{{ __('messages.suspect') }}</option>
                                        <option value="complainant">{{ __('messages.complainant') }}</option>
                                        <option value="other">{{ __('messages.other') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">{{ __('messages.gender') }}</label>
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="">{{ __('messages.select_option') }}</option>
                                        <option value="male">{{ __('messages.male') }}</option>
                                        <option value="female">{{ __('messages.female') }}</option>
                                        <option value="other">{{ __('messages.other') }}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nationality" class="form-label">{{ __('messages.nationality') }}</label>
                                    <input type="text" class="form-control" id="nationality" name="nationality">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="statement" class="form-label">{{ __('messages.statement') }}</label>
                            <textarea class="form-control" id="statement" name="statement" rows="4"
                                placeholder="{{ __('messages.provide_detailed_statement') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Initial Evidence Modal -->
    <div class="modal fade" id="initialEvidenceModal" tabindex="-1" aria-labelledby="initialEvidenceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="initialEvidenceModalLabel">{{ __('messages.add_initial_evidence') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="evidenceForm" method="POST" action="{{ route('report.evidence.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">{{ __('messages.types_of_evidence') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="">{{ __('messages.select_option') }}</option>
                                        <option value="physical">{{ __('messages.physical_evidence') }}</option>
                                        <option value="documentary">{{ __('messages.documentary_evidence') }}</option>
                                        <option value="digital">{{ __('messages.digital_evidence') }}</option>
                                        <option value="testimonial">{{ __('messages.testimonial_evidence') }}</option>
                                        <option value="photographic">{{ __('messages.photographic_evidence') }}</option>
                                        <option value="video">{{ __('messages.video_evidence') }}</option>
                                        <option value="audio">{{ __('messages.audio_evidence') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="location" class="form-label">{{ __('messages.location') }}</label>
                                    <input type="text" class="form-control" id="location" name="location"
                                        placeholder="{{ __('messages.evidence_location_placeholder') }}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="evidence_description"
                                class="form-label">{{ __('messages.description') }}</label>
                            <textarea class="form-control" id="evidence_description" name="description" rows="4"
                                placeholder="{{ __('messages.evidence_description_placeholder') }}"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="evidence_attachment" class="form-label">{{ __('messages.attachments') }}</label>
                            <input type="file" class="form-control" id="evidence_attachment" name="attachment"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.mp4,.avi">
                            <small class="text-muted">{{ __('messages.supported_formats') }}: PDF, DOC, DOCX, JPG, JPEG,
                                PNG, MP4, AVI</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Submit Confirmation Modal -->
    <div class="modal fade" id="submitConfirmModal" tabindex="-1" aria-labelledby="submitConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; max-width: 480px; margin: auto;">
                <div class="modal-body d-flex flex-column flex-md-row align-items-center p-4" style="gap: 24px;">
                    <div class="d-flex align-items-center justify-content-center mb-3 mb-md-0" style="min-width: 48px;">
                        <div style="width: 12px; height: 100px; background: #b3d0ff; border-radius: 8px;"></div>
                    </div>
                    <div class="flex-grow-1">
                        <h3 class="fw-bold mb-3" style="font-size: 1.5rem;">Declaration & Confirmation</h3>
                        <ol class="mb-4 ps-3" style="color: #222;">
                            <li>I hereby declare that all the information provided in this report is true and accurate to
                                the best of my knowledge.</li>
                            <li>I accept full legal responsibility for any false or misleading information submitted.</li>
                        </ol>
                        <div class="d-flex justify-content-center gap-3 mt-2">
                            <button type="button" class="btn btn-outline-secondary px-4"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-dark px-4" id="finalSubmitBtn">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4 px-4">
                    <div style="font-size: 2.5rem; color: #e57373; margin-bottom: 10px;">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h4 class="mb-2 fw-bold" style="color: #222;">{{ __('messages.delete') }}</h4>
                    <p style="color: #444;">{{ __('messages.delete_confirmation_message') }}</p>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button type="button" class="btn btn-outline-secondary px-4"
                            data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="button" class="btn btn-danger px-4"
                            id="confirmDeleteBtn">{{ __('messages.confirm') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @endpush
    @push('scripts')
        <script src="{{ asset('js/submit-handler.js') }}"></script>
    @endpush
@endsection
