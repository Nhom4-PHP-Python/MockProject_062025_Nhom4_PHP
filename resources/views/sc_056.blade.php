@extends("layouts.defaultLayout")
@section("content")
    <div class="container mt-5">
        <div class="row text-center mb-4">
            <h3>Add the digital investigation information</h3>
            <p class="fst-italic mb-4">This form is used to record the digital investigation information</p>
        </div>
        <form method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="type" class="form-label">Types of device/data analyzed</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Select an option</option>
                            @if (count($allCase) > 0)
                            @foreach ($allCase as $case)
                                <option value="{{$case->case_id}}">{{$case->type_case}}</option>
                             @endforeach
                            @endif
                            
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="plan_content" class="form-label">Analysis tools and methods</label>
                        <input type="text" class="form-control" id="plan_content" name="plan_content" placeholder="TEXT">
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="attachments" class="form-label">Analysis results</label>
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