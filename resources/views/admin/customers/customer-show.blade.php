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
        <h3> aaa </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-3">
                <strong>Name</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.name }}
            </div>
            <div class="col-xl-3">
                <strong>Mobile</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.mobile }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3">
                <strong>Taxi Number</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.name }}
            </div>
            <div class="col-xl-3">
                <strong>Vehicle</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.vehicle }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3">
                <strong>men</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.men }}
            </div>
            <div class="col-xl-3">
                <strong>Women</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.women }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3">
                <strong>Children</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.children }}
            </div>

            <div class="col-xl-3">
                <strong>Couple</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.couple }}
            </div>

            <div class="col-xl-3">
                <strong>Sales Person</strong>
            </div>
            <div class="col-xl-3">
                <a href="">
                    @{{ customer.user.first_name }} @{{ customer.user.last_name }}
                </a>

            </div>
        </div>

        <div class="row">
            <div class="col-xl-3">
                <strong>Bill Number</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.bill_number }}
            </div>
            <div class="col-xl-3">
                <strong>Amount</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.amount }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3">
                <strong>Payment mode</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.payment_mode }}
            </div>
            <div class="col-xl-3">
                <strong>Stay Time</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.stay_time }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3">
                <strong>Checkin Date Time</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.checkin_date_time }}
            </div>
            <div class="col-xl-3">
                <strong>Checkout Date Time</strong>
            </div>
            <div class="col-xl-3">
                @{{ customer.checkout_date_time }}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <strong>Description : </strong>
            </div>
            <div class="col-xl-12">
                @{{ customer.description }}
            </div>
        </div>

    </div>
</div>
