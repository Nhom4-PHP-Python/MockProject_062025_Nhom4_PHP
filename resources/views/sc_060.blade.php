@extends("layouts.defaultLayout")
@section("content")
    <div class="container mt-5">
        <div class="row text-center mb-4">
            <h3>Add the suspect information</h3>
            <p class="fst-italic mb-4">This form is used to record the suspect information</p>
        </div>
        <form method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="TEXT">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="TEXT">
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="attachments" class="form-label">Result interviews & information about the
                    apprehension</label>
                <!-- File drag and drop frame -->
                <div id="drop-area" class="border border-2 rounded-3 p-4 mb-2 text-center bg-light"
                    style="min-height:200px; position: relative;">
                    <div style="border: 2px dashed #6c757d; padding: 20px; background-color: #e9ecef; border-radius: 8px; display: inline-block;">
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
            <div class="mb-4">
                <label for="more_information" class="form-label">More information</label>
                <textarea class="form-control" id="more_information" name="more_information" rows="4"
                    placeholder="Provide more information about suspect"></textarea>
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
