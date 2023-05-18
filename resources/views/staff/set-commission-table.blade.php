<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Bill Number</th>
                    <th>Bill Amount</th>
                    <th>Commission (छबी %)</th>
                    <th>Commission Amount</th>
                </tr>
            </thead>
            <tbody>
                @if ($customers && count($customers) > 0)
                    @foreach ($customers as $key => $item)
                        <tr>
                            <td>{{ $item->bill_number }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->commission }}</td>
                            <td>
                                <input type="hidden" name="customers[{{ $key }}][id]"
                                    value="{{ $item->id }}">
                                <input type="number" class="commission" name="customers[{{ $key }}][commission]"
                                    value="{{ $item->commission_amount ? $item->commission_amount : '' }}">
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="col-md-12 mt-3">
        {{-- <div class="form-group">
                <input type="text" class="form-control item" name="commission_amount" id="commission_amount"
                    style="padding-left: 40px;" placeholder="Commission Amount" disabled>
                <span class="text-danger error-span pt-2" id="error_commission_amount"></span>
            </div> --}}
        <button type="button" class="btn btn-block create-account trigger-btn" onclick="SubmitDetails()">
            Submit Details
        </button>

    </div>
</div>
