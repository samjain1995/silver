@extends('layouts.staff')


@section('content')
    <style>
        .typeahead {
            width: 90%;
        }
    </style>
    <div class="registration-form mt-3">

        <form action="javascript:void(0);" id="LeadForm">
            <div class="form-icon">
                <img src="{{ getSiteSettings()->company_logo }}" height="50px" alt="">
            </div>
        </form>

        <form action="{{ route('staff.security-guard-daly-report') }}" id="LeadForm" class="mt-2 p-2">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <input type="date" class="form-control item" name="checkin_date_time" id="checkin_date_time"
                            value="{{ app('request')->input('checkin_date_time') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-block create-account trigger-btn" style="margin-top: 0">
                        Search
                    </button>
                </div>
                <div class="col-md-8">
                    {{ date('d-m-Y') }}
                </div>
            </div>
        </form>

        <form action="javascript:void(0);" id="LeadForm" class="mt-2 p-2">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>टैक्सी नंबर</th>
                                <th>फोन नंबर</th>
                                <th>P आने का समय: </th>
                                <th style="font: 12px;">भरी / नहीं भरी </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($customers && count($customers) > 0)
                                @foreach ($customers as $key => $item)
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0);" onclick="showModal({{ $item }})">
                                                {{ $item->taxi_number ? $item->taxi_number : $item->name }}
                                                ({{ $item->vehicle }})
                                            </a>

                                        </td>
                                        <td>
                                            <a href="tel:{{ $item->mobile }}">{{ $item->mobile }}</a>

                                        </td>

                                        <td>
                                            {{ date('H:i:s A', strtotime($item->checkin_date_time)) }}
                                        </td>

                                        <td>
                                            @if ($item->is_checkout == 0)
                                                P अभी है
                                            @else
                                                {{ $item->is_sell == 1 ? 'भरी' : 'नहीं भरी' }}
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">
                                        <center>No Data Found ..</center>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Customer Update</h5>
                        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">-->
                        <!--    X-->
                        <!--</button>-->
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0);" method="post" id="customer_update_form">
                            <div class="row">
                                <input type="hidden" name="customer_id" id="customer_id">
                                <div class="col-md-12">
                                    <label for="name " class="form-label ">Name</label>
                                    <input type="text" class="form-control mobileautocomplete" id="name"
                                        name="name">
                                </div>
                                <div class="col-md-12">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="number" class="form-control" id="mobile" name="mobile">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitCustomerUpdateForm()">Save</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
        var customer_id = 0;

        function showModal(row) {
            customer_id = row.id;
            $('#customer_id').val(customer_id)
            $('#exampleModal').modal('show');
        }

        function submitCustomerUpdateForm() {
            callPostAjax("{{ route('staff.salesman.customer-update') }}", "#customer_update_form", 0, 0, "");
            $('#exampleModal').modal('hide');
            customer_id = 0;
        }

        $('input.mobileautocomplete').typeahead({
            source: function(query, process) {
                return $.get('{{ route('staff.customer.mobile-autocomplete') }}', {
                    query: query,
                    filter: "name"
                }, function(data) {
                    return process(data);
                });
            },
            updater: function(item) {
                $("#mobile").val(item.mobile);
                return item;
            }
        });
    </script>
@endsection
