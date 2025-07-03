<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container mt-5">
        <div class="row text-center mb-4">
            <h3>Relevant Parties</h3>
            <p class="fst-italic mb-4">This form used to document the roles as identities of all parites connected to
                the incident.</p>
        </div>
        <form method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            placeholder="E.g. John Doe">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="">Select an option</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="relationship" class="form-label">Relationship to the incident</label>
                        <select class="form-select" id="relationship" name="relationship">
                            <option value="">Select an option</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nation" class="form-label">Nation</label>
                        <input type="text" class="form-control" id="nation" name="nation" placeholder="E.g. America">
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="statement" class="form-label">Statement/description</label>
                <textarea class="form-control" id="statement" name="statement" rows="4"
                    placeholder="Provide a clear and detailed description of what happened, including dates, time, locations, and people involved."></textarea>
            </div>
            <div class="mb-4">
                <label for="attachments" class="form-label">Attachments</label>
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
                <div id="uploaded-files-list" class="row"></div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset("js/criminal.js?ver=".rand())}}"></script>
<script>
    handleAttachments();
</script>
</html>