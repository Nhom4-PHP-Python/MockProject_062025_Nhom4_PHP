<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witness Statement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .card {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .evidence-item {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
        }

        .statement-controls {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .btn-group {
            margin-top: 0;
        }

        .evidence-controls {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center bg-info text-white p-2 rounded-bottom">WITNESS STATEMENT DETAILS</h2>
        <form method="post">
            @csrf
            <div class="card">
                <h4>Witness information</h4>
                <div class="mb-3 col-6">
                    <label class="form-label">Witness name</label>
                    <input type="text" class="form-control" name="witness_name" value="" placeholder="e.g. Jond">
                </div>
                <div class="mb-3 col-6"">
                    <label class=" form-label">Date</label>
                    <input type="date" class="form-control" name="date" value="">
                </div>
                <div class="mb-3 col-6"">
                    <label class=" form-label">Contact information</label>
                    <input type="tel" class="form-control" name="contact_information" value="" placeholder="+1XXXXXXXXXX">
                </div>
                <div class="mb-3 col-6"">
                    <label class=" form-label">Role</label>
                    <select class="form-select" name="role">
                        <option selected>Witness</option>
                    </select>
                </div>
            </div>
            <div class="card">
                <h4>Detailed statement</h4>
                <div class="statement-controls mb-3">
                    <label class="form-label">Content of the statement</label>
                    <div class="statement_buttons">
                        <button type="button" class="btn btn-secondary mx-1">Add</button>
                        <button type="button" class="btn btn-secondary mx-1">Delete</button>
                        <button type="button" class="btn btn-secondary mx-1">Fix</button>
                    </div>
                </div>
                <textarea class="form-control" rows="5" placeholder="Write some thing ..." name="content"></textarea>
            </div>
            <div class="card">
                <h4>Evidence Link</h4>
                <div class="mb-3 evidence-controls">
                    <div></div>
                    <label for="file_input" class="btn btn-light"
                        style="background-color: #e9ecef; color: #495057; border: 1px solid #ced4da; border-radius: 4px; padding: 6px 12px; font-size: 1rem; line-height: 1.5; text-align: center; cursor: pointer;">
                        Upload file
                    </label>
                    <input type="file" class="btn btn-secondary" name="evidence_link[]" id="file_input" style="display: none;" />
                </div>
                <div class="evidence-list" style="display: flex; flex-wrap: wrap; gap: 10px;" id="evidence-list">

                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">Save</button>
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
<script src="{{asset("js/criminal.js?ver=" . rand())}}"></script>
<script>
    handleUploadFile();
</script>

</html>