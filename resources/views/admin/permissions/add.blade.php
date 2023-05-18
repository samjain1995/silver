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
        <h3> Add Permission </h3>
    </div>
    <div class="card-body">
        <form class="needs-validation" method="POST" action="{{ route('admin.modules.store') }}"
            enctype="multipart/form-data" id="create_form">
            @csrf
            <div class="row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                            ng-model="form_filds.name" required />
                        <span class="text-danger error-span pt-2">@{{ add_validation_errors.name }}</span>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="permission_key">Permission Key <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="permission_key" placeholder="Permission Key"
                            name="permission_key" ng-model="form_filds.permission_key" required />
                        <span class="text-danger error-span pt-2">@{{ add_validation_errors.permission_key }}</span>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="url">Url <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="url" placeholder="Url" name="url"
                            ng-model="form_filds.url" required />
                        <span class="text-danger error-span pt-2">@{{ add_validation_errors.url }}</span>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="rank">Rank <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="rank" placeholder="Rank" name="rank"
                            ng-model="form_filds.rank" required />
                        <span class="text-danger error-span pt-2">@{{ add_validation_errors.rank }}</span>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="name">Icon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="icon" placeholder="Icon" name="icon"
                            ng-model="form_filds.icon" required />
                        <span class="text-danger error-span pt-2">@{{ add_validation_errors.icon }}</span>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="name">Image <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image"
                                ng-model="form_filds.image" ng-files="getTheFiles($files,'form_filds','image')"
                                accept="image/png, image/gif, image/jpeg" />
                            <label class="custom-file-label" for="customFile">Choose Image</label>
                        </div>
                        <span class="text-danger error-span pt-2">@{{ add_validation_errors.image }}</span>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input form-control" id="view_sidebar"
                                name="view_sidebar" ng-model="form_filds.view_sidebar" value="1">
                            <label class="custom-control-label" for="view_sidebar">View Sidebar</label>
                        </div>
                        <span class="text-danger error-span pt-2">@{{ add_validation_errors.view_sidebar }}</span>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="button" ng-click="submitAddForm('#create_form')"> Submit</button>
        </form>
    </div>
</div>
