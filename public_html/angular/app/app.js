var app = angular.module('EcommerceApp', ['ngDialog', 'ngAnimate', 'toaster'])
    .directive('ngFiles', ['$parse', function ($parse) {
        function fn_link(scope, element, attrs) {
            var onChange = $parse(attrs.ngFiles);
            element.on('change', function (event) {
                onChange(scope, { $files: event.target.files });
            });
        };
        return {
            link: fn_link
        }
    }]);

app.directive("initFromForm", function ($parse) {
    return {
        link: function (scope, element, attrs) {
            var attr = attrs.initFromForm || attrs.ngModel || element.attrs('name'),
                val = attrs.value;
            if (attrs.type === "number") { val = parseInt(val) }
            $parse(attr).assign(scope, val);
        }
    };
});

app.run(function ($rootScope) {
    $rootScope.post_request_headers = {
        transformRequest: angular.identity,
        headers: {
            'Content-Type': undefined
        }
    };

    $rootScope.makejsonToFormData = function (form_filds) {
        var formdata = new FormData();
        $.each(form_filds, function (index, value) {
            if (Array.isArray(value)) {
                $.each(value, function (key, data) {
                    formdata.append(index + '[' + key + ']', data);
                });
            } else {
                formdata.append(index, value);
            }

        });
        return formdata;
    }
});
