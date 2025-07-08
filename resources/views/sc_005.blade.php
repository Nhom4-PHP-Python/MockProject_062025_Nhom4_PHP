@extends("layouts.defaultLayout")
@section("content")
    <div class="container mt-5">
        <div class="row text-center mb-4">
            <h3>Initial Evidence</h3>
            <p class="fst-italic mb-4">This form used to document the initial evidence connected to the incident.</p>
        </div>
        <form method="POST" id="evidence-form">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="evidence" class="form-label">Types of Evidence</label>
                        <select class="form-select" id="evidence" name="evidence" required>
                            <option value="">Select an option</option>
                            @if (count($allReport) > 0)
                            @foreach ($allReport as $report)
                                <option value="{{$report->report_id}}">{{$report->type_report}}</option>
                             @endforeach
                            @endif
                        </select>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="evidence_location" class="form-label">Evidence location</label>
                        <input type="text" class="form-control" id="evidence_location" name="evidence_location"
                            placeholder="E.g. At the scene. in the car, ...">
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="evidence_description" class="form-label">Evidence description</label>
                <textarea class="form-control" id="evidence_description" name="evidence_description" rows="4"
                    placeholder="Provide a clear and detailed description of the evidence (shape, material, indentifying features, ...)."></textarea>
            </div>
            <div class="mb-4">
                <label for="attachments" class="form-label">Attachments</label>
                <!-- File drag and drop frame -->
                <div id="drop-area" class="border border-2 rounded-3 p-4 mb-2 text-center bg-light"
                    style="min-height:200px; position: relative;">
                    <div
                        style="border: 2px dashed #6c757d; padding: 20px; background-color: #e9ecef; border-radius: 8px; display: inline-block;">
                        <i class="fa-solid fa-cloud-arrow-up" style="font-size: 3rem;"></i>
                        <p class="text-muted mb-2 mt-4">
                            <b>Drag & drop files or </b>
                            <button type="button" class="btn btn-outline-secondary btn-sm" style="font-weight: 700"
                                id="select-files-btn">
                                Browser
                            </button>
                        </p>
                        <input type="file" id="attachments" name="attachments[]" multiple class="form-control d-none">
                        <p class="text-muted mb-2 mt-4">Supported formates: JPEG, PNG, GIF, MP4, PDF, PSD, AI, Word, PPT
                        </p>
                        <!-- show name file selected -->
                        <div id="selected-files" class="mt-2"></div>
                    </div>
                </div>
                <!-- upload button -->
                <button type="button" class="btn btn-success btn-sm mb-2" id="upload-btn">Upload file</button>
                <!-- Label Upload -->
                <div class="mb-1"><label class="form-label">Uploaded:</label></div>
                <!-- List of uploaded files -->
                <div id="uploaded-files-list" style="display: flex; flex-wrap: wrap; gap: 10px;">
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        handleAttachments();
    </script>
@endsection