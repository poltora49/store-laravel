@extends('layouts.admin')
@section('header')
    @include('layouts.parts.header-admin')
@endsection

@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
                Validation
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard-default.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Validation</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">jQuery Validation</h5>
                    </div>
                    <div class="card-body">
                        <form id="validation-form">
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="validation-email" placeholder="Email">
                                <small class="form-text d-block text-muted">Example block-level help text here.</small>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="validation-password" placeholder="Password">
                                <small class="form-text d-block text-muted">Example block-level help text here.</small>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Confirm password</label>
                                <input type="password" class="form-control" name="validation-password-confirmation" placeholder="Confirm password">
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Required</label>
                                <input type="text" class="form-control" name="validation-required" placeholder="Required">
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">URL</label>
                                <input type="text" class="form-control" name="validation-url" placeholder="URL">
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Select</label>
                                <select class="form-control" name="validation-select">
                                    <option value>Select gear...</option>
                                    <optgroup label="Climbing">
                                        <option value="pitons">Pitons</option>
                                        <option value="cams">Cams</option>
                                        <option value="nuts">Nuts</option>
                                        <option value="bolts">Bolts</option>
                                        <option value="stoppers">Stoppers</option>
                                        <option value="sling">Sling</option>
                                    </optgroup>
                                    <optgroup label="Skiing">
                                        <option value="skis">Skis</option>
                                        <option value="skins">Skins</option>
                                        <option value="poles">Poles</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Multiselect</label>
                                <select class="form-control" name="validation-multiselect" multiple>
                                    <optgroup label="Climbing">
                                        <option value="pitons">Pitons</option>
                                        <option value="cams">Cams</option>
                                        <option value="nuts">Nuts</option>
                                        <option value="bolts">Bolts</option>
                                        <option value="stoppers">Stoppers</option>
                                        <option value="sling">Sling</option>
                                    </optgroup>
                                    <optgroup label="Skiing">
                                        <option value="skis">Skis</option>
                                        <option value="skins">Skins</option>
                                        <option value="poles">Poles</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Select2</label>
                                <div class="d-flex">
                                    <select class="form-control" name="validation-select2" style="width: 100%">
                                        <option value>Select gear...</option>
                                        <optgroup label="Climbing">
                                            <option value="pitons">Pitons</option>
                                            <option value="cams">Cams</option>
                                            <option value="nuts">Nuts</option>
                                            <option value="bolts">Bolts</option>
                                            <option value="stoppers">Stoppers</option>
                                            <option value="sling">Sling</option>
                                        </optgroup>
                                        <optgroup label="Skiing">
                                            <option value="skis">Skis</option>
                                            <option value="skins">Skins</option>
                                            <option value="poles">Poles</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Select2 Multiple</label>
                                <div class="d-flex">
                                    <select class="form-control" name="validation-select2-multi" multiple style="width: 100%">
                                        <optgroup label="Climbing">
                                            <option value="pitons">Pitons</option>
                                            <option value="cams">Cams</option>
                                            <option value="nuts">Nuts</option>
                                            <option value="bolts">Bolts</option>
                                            <option value="stoppers">Stoppers</option>
                                            <option value="sling">Sling</option>
                                        </optgroup>
                                        <optgroup label="Skiing">
                                            <option value="skis">Skis</option>
                                            <option value="skins">Skins</option>
                                            <option value="poles">Poles</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Text</label>
                                <textarea class="form-control" name="validation-text"></textarea>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">File</label>
                                <div>
                                    <input type="file" class="validation-file" name="validation-file">
                                </div>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Radios</label>
                                <label class="form-check">
                                    <input name="validation-radios" type="radio" class="form-check-input">
                                    <span class="form-check-label">Option one is this and that—be sure to include why it's great</span>
                                </label>
                                <label class="form-check">
                                    <input name="validation-radios" type="radio" class="form-check-input">
                                    <span class="form-check-label">Option two can be something else and selecting it will deselect option one</span>
                                </label>
                                <label class="form-check">
                                    <input name="validation-radios" type="radio" class="form-check-input">
                                    <span class="form-check-label">Option three is disabled</span>
                                </label>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Checkbox</label>
                                <br>
                                <label class="form-check d-block">
                                    <input type="checkbox" class="form-check-input" name="validation-checkbox">
                                    <span class="form-check-label">Check me</span>
                                </label>
                            </div>
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Checkbox group</label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" name="validation-checkbox-group-1">
                                    <span class="form-check-label">One</span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" name="validation-checkbox-group-2">
                                    <span class="form-check-label">Two</span>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push()
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize Select2 select box
        $("select[name=\"validation-select2\"]").select2({
            allowClear: true,
            placeholder: "Select gear...",
        }).change(function() {
            $(this).valid();
        });
        // Initialize Select2 multiselect box
        $("select[name=\"validation-select2-multi\"]").select2({
            placeholder: "Select gear...",
        }).change(function() {
            $(this).valid();
        });
        // Trigger validation on tagsinput change
        $("input[name=\"validation-bs-tagsinput\"]").on("itemAdded itemRemoved", function() {
            $(this).valid();
        });
        // Initialize validation
        $("#validation-form").validate({
            ignore: ".ignore, .select2-input",
            focusInvalid: false,
            rules: {
                "validation-email": {
                    required: true,
                    email: true
                },
                "validation-password": {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                "validation-password-confirmation": {
                    required: true,
                    minlength: 6,
                    equalTo: "input[name=\"validation-password\"]"
                },
                "validation-required": {
                    required: true
                },
                "validation-url": {
                    required: true,
                    url: true
                },
                "validation-select": {
                    required: true
                },
                "validation-multiselect": {
                    required: true,
                    minlength: 2
                },
                "validation-select2": {
                    required: true
                },
                "validation-select2-multi": {
                    required: true,
                    minlength: 2
                },
                "validation-text": {
                    required: true
                },
                "validation-file": {
                    required: true
                },
                "validation-radios": {
                    required: true
                },
                "validation-checkbox": {
                    required: true
                },
                "validation-checkbox-group-1": {
                    require_from_group: [1, "input[name=\"validation-checkbox-group-1\"], input[name=\"validation-checkbox-group-2\"]"]
                },
                "validation-checkbox-group-2": {
                    require_from_group: [1, "input[name=\"validation-checkbox-group-1\"], input[name=\"validation-checkbox-group-2\"]"]
                },
                "validation-checkbox-group-1": {
                    require_from_group: [1, "input[name=\"validation-checkbox-group-1\"], input[name=\"validation-checkbox-group-2\"]"]
                },
                "validation-checkbox-group-2": {
                    require_from_group: [1, "input[name=\"validation-checkbox-group-1\"], input[name=\"validation-checkbox-group-2\"]"]
                }
            },
            // Errors
            errorPlacement: function errorPlacement(error, element) {
                var $parent = $(element).parents(".error-placeholder");
                // Do not duplicate errors
                if ($parent.find(".jquery-validation-error").length) {
                    return;
                }
                $parent.append(
                    error.addClass("jquery-validation-error small form-text invalid-feedback")
                );
            },
            highlight: function(element) {
                var $el = $(element);
                var $parent = $el.parents(".error-placeholder");
                $el.addClass("is-invalid");
                // Select2 and Tagsinput
                if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") === "tagsinput") {
                    $el.parent().addClass("is-invalid");
                }
            },
            unhighlight: function(element) {
                $(element).parents(".error-placeholder").find(".is-invalid").removeClass("is-invalid");
            }
        });
    });
</script>
@endpush
