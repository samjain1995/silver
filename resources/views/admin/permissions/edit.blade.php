<style type="text/css" media="screen">
    .ngdialog.ngdialog-theme-default .ngdialog-content {
        width: 60%;
        background: #FFFFFF;
        padding: 0;
        border-radius: 2px;
    }

    .ngdialog,
    .ngdialog-overlay {
        position: fixed;
        top: -88px;
        right: 0;
        bottom: 0;
        left: 0;
    }

</style>
<div class="card">
    <div class="card-header">
        <h3> Edit Permission </h3>
    </div>
    <div class="card-body">
        <form class="needs-validation" method="POST" action="{{ route('admin.permissions.update', $permission->id) }}"
            enctype="multipart/form-data" id="edit_form">
            @csrf
            @method('PATCH')
            <input type="hidden" id="module_id" ng-model="edit_form_filds.permission_id" name="permission_id"
                value="{{ $permission->id }}" init-from-form>
            <div class="row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                            ng-model="edit_form_filds.name" value="{{ $permission->name }}" init-from-form required />
                        <span class="text-danger error-span pt-2">@{{ edit_validation_errors.name }}</span>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="permission_key">Permission Key <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="permission_key" placeholder="Permission Key"
                            name="permission_key" ng-model="edit_form_filds.permission_key" value="{{ $permission->permission_key }}" init-from-form required />
                        <span class="text-danger error-span pt-2">@{{ edit_validation_errors.permission_key }}</span>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="url">Url <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="url" placeholder="Url" name="url"
                            ng-model="edit_form_filds.url" value="{{ $permission->url }}"  init-from-form required />
                        <span class="text-danger error-span pt-2">@{{ edit_validation_errors.url }}</span>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="rank">Rank <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="rank" placeholder="Rank" name="rank"
                            ng-model="edit_form_filds.rank"  value="{{ $permission->rank }}" init-from-form required />
                        <span class="text-danger error-span pt-2">@{{ edit_validation_errors.rank }}</span>
                    </div>
                </div>


                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="name">Icon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="icon" placeholder="Icon" name="icon"
                            ng-model="edit_form_filds.icon" value="{{ $permission->icon }}" init-from-form required />
                        <span class="text-danger error-span pt-2">@{{ edit_validation_errors.icon }}</span>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="name">Image <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image"
                                ng-model="edit_form_filds.image"
                                ng-files="getTheFiles($files,'edit_form_filds','image')"
                                accept="image/png, image/gif, image/jpeg" />
                            <label class="custom-file-label" for="customFile">Choose Image</label>
                        </div>
                        <img src="{{ $permission->image }}" alt="" style="width: 100px;height: 100px;">
                        <span class="text-danger error-span pt-2">@{{ edit_validation_errors.image }}</span>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input form-control" id="view_sidebar"
                                name="view_sidebar" ng-model="edit_form_filds.view_sidebar" value="1"
                                {{ $permission->view_sidebar == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="view_sidebar">View Sidebar</label>
                        </div>
                        <span class="text-danger error-span pt-2">@{{ edit_validation_errors.view_sidebar }}</span>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="button"
                ng-click="submitEditForm('#edit_form','{{ route('admin.permissions.update', $permission->id) }}')">
                Submit
            </button>
        </form>
    </div>
</div>
