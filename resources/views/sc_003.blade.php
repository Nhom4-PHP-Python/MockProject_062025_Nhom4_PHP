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
        <form method="POST" action="{{ route('report.postStep2') }}" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger"></div>
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
                <label class="form-label">{{ __('messages.type_of_crime') }} <span class="text-danger">*</span></label>
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
                                <a href="{{ route('report.party.delete', $idx) }}" class="text-danger"
                                    title="{{ __('messages.delete') }}"
                                    onclick="return confirm('{{ __('messages.confirm_delete_party') }}')"><i
                                        class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">{{ __('messages.no_relevant_parties_added') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="text-end">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#relevantPartyModal">{{ __('messages.add') }}</button>
            </div>
        </div>
        <!-- Modal for Relevant Parties -->
        <div class="modal fade" id="relevantPartyModal" tabindex="-1" aria-labelledby="relevantPartyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-body">
                        <h3 class="modal-title text-center" id="relevantPartyModalLabel">
                            {{ __('messages.relevant_parties') }}</h3>
                        <p class="fst-italic mb-4 text-center">{{ __('messages.relevant_parties_desc') }}</p>
                        <form id="relevantPartyForm" method="POST" action="{{ route('report.party.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">{{ __('messages.fullname') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="fullname" name="fullname"
                                            placeholder="{{ __('messages.fullname_placeholder') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">{{ __('messages.gender') }}</label>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="">{{ __('messages.select_option') }}</option>
                                            <option value="male">{{ __('messages.male') }}</option>
                                            <option value="female">{{ __('messages.female') }}</option>
                                            <option value="other">{{ __('messages.other') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="relationship"
                                            class="form-label">{{ __('messages.relationship_to_incident') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="relationship" name="relationship" required>
                                            <option value="">{{ __('messages.select_option') }}</option>
                                            <option value="victim">{{ __('messages.victim') }}</option>
                                            <option value="suspect">{{ __('messages.suspect') }}</option>
                                            <option value="witness">{{ __('messages.witness') }}</option>
                                            <option value="other">{{ __('messages.other') }}</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nationality"
                                            class="form-label">{{ __('messages.nationality') }}</label>
                                        <input type="text" class="form-control" id="nationality" name="nationality"
                                            placeholder="{{ __('messages.nationality_placeholder') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="statement"
                                    class="form-label">{{ __('messages.statement_description') }}</label>
                                <textarea class="form-control" id="statement" name="statement" rows="4"
                                    placeholder="{{ __('messages.statement_placeholder') }}"></textarea>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="submit" class="btn btn-dark"
                            form="relevantPartyForm">{{ __('messages.create') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal for Main Submit -->
        <div class="modal fade" id="mainSubmitConfirmModal" tabindex="-1" aria-labelledby="mainSubmitConfirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mainSubmitConfirmModalLabel">
                            {{ __('messages.declaration_confirmation') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="bg-light p-3 rounded">
                            <p class="mb-2"><strong>{{ __('messages.declaration_confirmation') }}</strong></p>
                            <ol class="mb-3">
                                <li>{{ __('messages.declaration_text_1') }}</li>
                                <li>{{ __('messages.declaration_text_2') }}</li>
                            </ol>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="button" class="btn btn-dark"
                            id="confirmMainAction">{{ __('messages.yes') }}</button>
                    </div>
                </div>
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
                                <a href="{{ route('report.evidence.delete', $idx) }}" class="text-danger"
                                    title="{{ __('messages.delete') }}"
                                    onclick="return confirm('{{ __('messages.confirm_delete_evidence') }}')"><i
                                        class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">{{ __('messages.no_evidence_added') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="text-end">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#initialEvidenceModal">{{ __('messages.add') }}</button>
            </div>
        </div>
        <!-- Modal for Initial Evidence -->
        <div class="modal fade" id="initialEvidenceModal" tabindex="-1" aria-labelledby="initialEvidenceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-body">
                        <h3 class="modal-title text-center" id="initialEvidenceModalLabel">
                            {{ __('messages.initial_evidence') }}</h3>

                        <p class="fst-italic mb-4 text-center">{{ __('messages.initial_evidence_desc') }}</p>
                        <form id="initialEvidenceForm" method="POST" action="{{ route('report.evidence.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">{{ __('messages.types_of_evidence') }}
                                            <span class="text-danger">*</span></label>
                                        <select class="form-select" id="type" name="type" required>
                                            <option value="">{{ __('messages.select_option') }}</option>
                                            <option value="document">{{ __('messages.document') }}</option>
                                            <option value="photo">{{ __('messages.photo') }}</option>
                                            <option value="video">{{ __('messages.video') }}</option>
                                            <option value="other">{{ __('messages.other') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="location"
                                            class="form-label">{{ __('messages.evidence_location') }}</label>
                                        <input type="text" class="form-control" id="location" name="location"
                                            placeholder="{{ __('messages.evidence_location_placeholder') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="description"
                                    class="form-label">{{ __('messages.evidence_description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3"
                                    placeholder="{{ __('messages.evidence_description_placeholder') }}"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="attachments" class="form-label">{{ __('messages.attachments') }}</label>
                                <input type="file" id="attachments_evidence" name="attachments[]" multiple
                                    class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="submit" class="btn btn-dark"
                            form="initialEvidenceForm">{{ __('messages.create') }}</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('report.step1') }}" class="btn btn-outline-secondary"
                style="margin-right: 4px;">{{ __('messages.back') }}</a>
            <button type="button" class="btn btn-dark" id="confirmMainSubmit">{{ __('messages.submit') }}</button>
        </div>
    </div>
    </form>
    </div>
    @push('scripts')
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Confirmation for relevant party submit
                document.getElementById('confirmPartySubmit').addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Party submit button clicked');

                    const form = document.getElementById('relevantPartyForm');

                    // Check required fields manually
                    const fullname = document.getElementById('fullname').value.trim();
                    const relationship = document.getElementById('relationship').value;

                    if (!fullname) {
                        alert('{{ __('messages.fullname') }} là bắt buộc');
                        return;
                    }

                    if (!relationship) {
                        alert('{{ __('messages.relationship_to_incident') }} là bắt buộc');
                        return;
                    }

                    // Populate preview modal
                    const gender = document.getElementById('gender').value;
                    const nationality = document.getElementById('nationality').value;
                    const statement = document.getElementById('statement').value;

                    const relationshipText = document.querySelector('#relationship option:checked').textContent;
                    const genderText = gender ? document.querySelector('#gender option:checked').textContent :
                        'Không có';

                    document.getElementById('partyPreview').innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ __('messages.fullname') }}:</strong> ${fullname}</p>
                                <p><strong>{{ __('messages.gender') }}:</strong> ${genderText}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('messages.relationship_to_incident') }}:</strong> ${relationshipText}</p>
                                <p><strong>{{ __('messages.nationality') }}:</strong> ${nationality || 'Không có'}</p>
                            </div>
                        </div>
                        ${statement ? `<p><strong>{{ __('messages.statement') }}:</strong> ${statement}</p>` : ''}
                    `;

                    // Show confirmation modal
                    const partyConfirmModal = new bootstrap.Modal(document.getElementById('partyConfirmModal'));
                    partyConfirmModal.show();
                });

                // Actual submit for party
                document.getElementById('confirmPartyAction').addEventListener('click', function() {
                    document.getElementById('relevantPartyForm').submit();
                });

                // Confirmation for evidence submit
                document.getElementById('confirmEvidenceSubmit').addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Evidence submit button clicked');

                    const form = document.getElementById('initialEvidenceForm');

                    // Check required fields manually
                    const type = document.getElementById('type').value;

                    if (!type) {
                        alert('{{ __('messages.types_of_evidence') }} là bắt buộc');
                        return;
                    }

                    // Populate preview modal
                    const location = document.getElementById('location').value;
                    const description = document.getElementById('description').value;
                    const attachments = document.getElementById('attachments_evidence').files;

                    const typeText = document.querySelector('#type option:checked').textContent;

                    let attachmentsList = '';
                    if (attachments.length > 0) {
                        attachmentsList = '<p><strong>{{ __('messages.attachments') }}:</strong></p><ul>';
                        for (let i = 0; i < attachments.length; i++) {
                            attachmentsList += `<li>${attachments[i].name}</li>`;
                        }
                        attachmentsList += '</ul>';
                    }

                    document.getElementById('evidencePreview').innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>{{ __('messages.types_of_evidence') }}:</strong> ${typeText}</p>
                                <p><strong>{{ __('messages.location') }}:</strong> ${location || 'Không có'}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('messages.description') }}:</strong> ${description || 'Không có'}</p>
                            </div>
                        </div>
                        ${attachmentsList}
                    `;

                    // Show confirmation modal
                    const evidenceConfirmModal = new bootstrap.Modal(document.getElementById(
                        'evidenceConfirmModal'));
                    evidenceConfirmModal.show();
                });

                // Actual submit for evidence
                document.getElementById('confirmEvidenceAction').addEventListener('click', function() {
                    document.getElementById('initialEvidenceForm').submit();
                });

                // MAIN FORM SUBMIT - Đơn giản hóa chỉ dùng 1 modal
                document.getElementById('confirmMainSubmit').addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Main submit button clicked');

                    const form = document.querySelector('form[action="{{ route('report.postStep2') }}"]');

                    // Kiểm tra form có hợp lệ không
                    if (form.checkValidity()) {
                        // Hiển thị modal xác nhận
                        const mainSubmitConfirmModal = new bootstrap.Modal(document.getElementById(
                            'mainSubmitConfirmModal'));
                        mainSubmitConfirmModal.show();
                    } else {
                        // Hiển thị lỗi validation
                        form.reportValidity();
                    }
                });

                // Submit thật sau khi xác nhận
                document.getElementById('confirmMainAction').addEventListener('click', function() {
                    console.log('Confirmed main submit');
                    document.querySelector('form[action="{{ route('report.postStep2') }}"]').submit();
                });
            });
        </script>
    @endpush

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @endpush
@endsection
