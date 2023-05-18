@extends('layouts.admin')
@section('content')
    <div class="container-fluid" ng-controller="PageController">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Email Template Edit</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" method="POST"
                            action="{{ route('admin.settings.email-templates.update', $email_template->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" placeholder="First Name"
                                            value="{{ old('name', $email_template->name) }}" name="name" required />
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Subject<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="subject" placeholder="First Name"
                                            value="{{ old('subject', $email_template->subject) }}" name="subject"
                                            required />
                                        @if ($errors->has('subject'))
                                            <span class="text-danger">{{ $errors->first('subject') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Actions<span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="action" id="email_actions">
                                            <option value="">Select</option>
                                            @foreach (email_actions as $key => $item)
                                                <option value="{{ $key }}"
                                                    {{ old('action', $email_template->action) == $key ? 'selected' : '' }}>
                                                    {{ ucfirst(str_replace('_', ' ', $key)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('action'))
                                            <span class="text-danger">{{ $errors->first('action') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Constants </label>
                                        <select class="form-control select2" id="email_actions_constants">
                                            <option value="">Select</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="body"> Body <span class="text-danger">*</span></label>
                                        <textarea class="form-control " id="ckeditor" name="body"
                                            rows="3">{{ old('body', $email_template->body) }}</textarea>
                                        @if ($errors->has('body'))
                                            <span class="text-danger">{{ $errors->first('body') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
    </div>
@endsection

@section('scripts')
    @include('layouts.ckeditor-script')
    <script type="text/javascript">
        var old_email_action = '{{ $email_template->action }}';
        if (old_email_action) {
            getEmailActionsConstants(old_email_action);
        }
        $(document).on("change", "#email_actions", function(event) {
            getEmailActionsConstants($(this).val());
        });

        function getEmailActionsConstants(action) {
            var email_actions_constants = @json(email_actions);
            var constants = email_actions_constants[action];
            $('#email_actions_constants').empty();
            $('#email_actions_constants').append($('<option></option>').attr('value', "").text("Select Constants"));
            if (constants && constants.length > 0) {
                for (row in constants) {
                    $('#email_actions_constants').append($('<option></option>').attr('value', constants[row]).text(
                        constants[row]));
                }
            }
        }

        $(document).on("change", "#email_actions_constants", function(event) {
            var strUser = $(this).val();
            if (strUser != '') {
                var newStr = '{' + strUser + '}';
                CKEDITOR.instances['ckeditor'].insertText(newStr);
            }
        });

        app.controller('PageController', function($window, $scope, $location, $http, ngDialog, toaster) {

        });
    </script>
@endsection
